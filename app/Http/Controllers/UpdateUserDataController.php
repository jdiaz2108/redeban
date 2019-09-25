<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Point;
use App\Models\UserData;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateDataRequest;
use App\Models\Shop;

class UpdateUserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->changedPassword) {

            $departments = Department::orderBy('name')->get();
            $updatedData = ($user->updated) ? $user->userData : $user ;
            $city = ($user->userData) ? City::find($user->userData->city_id)->name : null ;
            $action = $user->updated ? '/update-data/'.$updatedData['id'] : '/update-data';
            $shops = Shop::whereUserId($user->id);

            return view('pages.home.update-data', compact('updatedData', 'user','action','departments','city', 'shops'));

        } else {

            return view('auth.change-password');

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateDataRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $userData = new UserData($data);
        $userData->save();

        return back()->with('status', 'SE HAN ACTUALIZADO LOS DATOS CORRECTAMENTE');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userData = UserData::find($id)->update($request->all());

        return back()->with('status', 'SE HAN ACTUALIZADO LOS DATOS CORRECTAMENTE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addPoints(Request $request)
    {
        $user = $request->user();
        $code = $request['code'];
        $date = Carbon::now();
        $pointsUpdateData = $user->PointsUpdateData;

        if ($code === 'allShops') {
            $shops = Shop::whereUserId($user['id'])->get();
            $numberShops = count($shops);
            $poinstDivided = ($pointsUpdateData / $numberShops);

            foreach ($shops as $key => $shop) {
                $points = new Point([
                    'event' => 'Actualización de datos',
                    'value' => (integer) $poinstDivided,
                    'shop_id' => $shop->id,
                    'month' => $date->month,
                    'year' => $date->year
                ]);

                $points->save();
            }

        } else {
            $shop = Shop::whereUserId($user['id'])->whereCode($code)->first();
            $points = new Point([
                'event' => 'Actualización de datos',
                'value' => $pointsUpdateData,
                'shop_id' => $shop->id,
                'month' => $date->month,
                'year' => $date->year
            ]);

            $points->save();
        }


            return redirect('/home')->with('status', 'SE HAN ACTUALIZADO LOS DATOS CORRECTAMENTE');
        }
}
