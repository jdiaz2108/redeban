<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Prize;
use App\Models\Coupon;
use App\Models\Fulfillment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->changedPassword) {

            $users = User::count();
            $fulfillments = Fulfillment::count();
            $prizes = Prize::count();
            $coupons = Coupon::count();

            return view('home',compact('users','fulfillments','prizes','coupons'));

        } else {

            return view('auth.change-password');

        }

    }

    public function catalog()
    {
        $user = Auth::user();
        $prizes = Prize::whereActive(true)->get();
        $colors = ['boxred','boxgreen','boxblue','boxred','boxgreen','boxblue'];

        return view('pages.home.prize.catalog', compact('prizes','user','colors'));
    }

    public function showPrize($id)
    {
        $user = Auth::user();
        $prize = Prize::find($id);
        $activeredeem = $user->activeredeem;

        $redeem = (($activeredeem->prize_id ?? '') == $prize->id && ($activeredeem->active ?? '')) ? true : false ;
        if ($redeem) {

            $carbon = Carbon::now('America/Bogota')->subMinutes(10);
            $tenMinutesValidation = $carbon <= $activeredeem->created_at;

            $redeem = ($tenMinutesValidation) ? true : false ;
        }

        return view('pages.home.prize.show', compact('prize', 'redeem','user'));
    }

    public function points()
    {
        $user = Auth::user();
        $historyPoints = Auth::user()->points()->get()->sortByDesc('created_at');

        return view('pages.home.history-points', compact('historyPoints','user'));
    }

    public function transactions()
    {
        $user = Auth::user();
        $historyFulfillment = Auth::user()->fulfillmentAll();

        return view('pages.home.history-transactions', compact('historyFulfillment','user'));
    }

    public function about()
    {

        return view('pages.home.about');
    }

    public function terms()
    {

        return view('pages.home.terms');
    }

    public function JsonCities($id)
    {
      $cities = City::where('department_id',$id)->orderBy('name')->get();

      return response()->json(['cities' => $cities]);
    }

}
