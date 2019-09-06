<?php

namespace App\Http\Controllers;

use App\Models\Fulfillment;
use Auth;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Fulfillment::where('value', '!=' , null)->get();

        $date = Carbon::now();



        $collectBody = $collection->splice(1);

        $collectHeader = ['event', 'value', 'user_id', 'month', 'year', 'created_at','updated_at'];
            $add = [intval($date->format('m')), intval($date->format('Y')), $date, $date];

            $collectionMix = $collectBody->map(function ($item, $key) use ($collectHeader, $add, $date) {
                $value = ($item['value'] - $item['goal']);
                $array = ['Puntos '.$item['event'],$value, $item['user_id']];
                $arrayUp = Arr::collapse([$array, $add]);
                // if (count($item) == count($collectHeader) and !in_array("",$item)) {

                    return collect($collectHeader)->combine($arrayUp)->all();
                // }
            })->filter()->values()->all();


            foreach (array_chunk($collectionMix, 5000) as $t) {
                DB::table('points')->insert($t);
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
    public function store(Request $request)
    {
        //
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
        //
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
}
