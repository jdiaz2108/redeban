<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Shop;
use App\Models\City;
use App\Models\Prize;
use App\Models\Coupon;
use App\Models\AccessLog;
use App\Models\Department;
use App\Models\Fulfillment;
use App\Models\PrizeCategory;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            $shops = Shop::count();
            $coupons = Coupon::count();
            $userDataCount = count(UserData::get());
            $prizes_categories = PrizeCategory::get();

            return view('pages.admin.home',compact('users','shops','coupons','prizes_categories', 'userDataCount'));

        } else {

            return view('auth.change-password');
        }

    }

    public function catalog(Request $request)
    {
        $user = Auth::user();
        $prizes = PrizeCategory::whereCategoryId($user->category_id)->where('stock','>',0)->has('prize')->with('prize')->get();
        $colors = ['boxred','boxgreen','boxblue','boxred','boxgreen','boxblue'];
        AccessLog::accessSection($request,'Catalogo');

        return view('pages.home.prize.catalog', compact('prizes','user','colors'));
    }

    public function showPrize(Request $request,$id)
    {
        $user = Auth::user();
        $shop = Shop::whereCode(session('current_shop'))->first();
        $prize = PrizeCategory::whereCategoryId($user->category_id)->whereCode($id)->first();
        if ($prize) {
            $departments = Department::orderBy('name')->get();
            $city = ($user->userData) ? City::find($user->userData->city_id)->name : null ;

            $activeredeem = Shop::whereCode(session('current_shop'))->first()->ActiveRedeem ?? null;
            $redeem = (($activeredeem->prize_category_id ?? '') == $prize->id && ($activeredeem->active ?? '')) ? true : false ;
            AccessLog::accessSection($request,'Premio '.$prize->prize->name.' - Categoria '.$prize->category_id);
            if ($redeem) {
                $carbon = Carbon::now('America/Bogota')->subMinutes(10);
                $tenMinutesValidation = $carbon <= $activeredeem->created_at;
                $redeem = ($tenMinutesValidation) ? true : false ;
            }

            return view('pages.home.prize.show', compact('prize', 'redeem','user', 'departments', 'city', 'shop'));
        } else {
            return back()->with('status', 'No permitido');
        }


    }

    public function points(Request $request)
    {
        $user = Auth::user();
        $test = $user->with('shops');
        AccessLog::accessSection($request,'Historial de puntos');
        $historyPoints = Shop::whereUserId($user->id)->whereCode(session('current_shop'))->with('points')->first();

        return view('pages.home.history-points', compact('historyPoints','user'));
    }

    public function transactions(Request $request)
    {
        $user = Auth::user();
        $shop = Shop::whereCode(session('current_shop'))->first();
        $historyFulfillment = Fulfillment::whereShopId($shop->id)->get();
        AccessLog::accessSection($request,'Historial de transacciones');

        return view('pages.home.history-transactions', compact('historyFulfillment','user'));
    }

    public function Redeem(Request $request)
    {
        $user = Auth::user();
        $shop = Shop::whereCode(session('current_shop'))->first();
        $coupons = Coupon::whereShopId($shop->id)->with('prizeCategory.prize')->get();

        AccessLog::accessSection($request,'Historial de redenciones');

        return view('pages.home.history-coupons', compact('coupons','user'));
    }

    public function about(Request $request)
    {
        AccessLog::accessSection($request,'¿Que es?');

        return view('pages.home.about');
    }

    public function terms(Request $request)
    {
        AccessLog::accessSection($request,'Terminos y condiciones');

        return view('pages.home.terms');
    }


    public function JsonCities($id)
    {
        $cities = City::where('department_id',$id)->orderBy('name')->get();

        return response()->json(['cities' => $cities]);
    }

    public function showShops(Request $request)
    {
        $user = Auth::user();
        $shops = $user->shops();

        if ($shops->count() == 1) {
            Session::put('current_shop', $shops->first()->code);
        }


        $shop = Shop::whereCode(session('current_shop'))->first() ?? null;
        AccessLog::accessSection($request,'Seleccionar codigo unico');

        return view('pages.home.shop', compact('user', 'shops', 'shop'));
    }

    public function selectShop($id)
    {
        $user = Auth::user();

        $shop = Shop::whereCode($id)->whereUserId($user->id)->firstOrFail();
        Session::put('current_shop', $shop->code);

        return back()->with('status', 'Haz seleccionado correctamente el Código Único: '.$shop->code);
    }

}
