<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Prize;
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
        return view('home');
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

}
