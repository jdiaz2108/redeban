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
        //
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

    public function liquidation()
    {
        $collection = Fulfillment::doesntHave('point')->where('value', '!=' , null)->get();

        $validation = $collection->isNotEmpty();

        if ($validation) {

            $date = Carbon::now();

            $collectHeader = ['event', 'value', 'user_id', 'fulfillment_id', 'month', 'year', 'created_at','updated_at'];
            $add = [intval($date->format('m')), intval($date->format('Y')), $date, $date];

            $collectionMix = $collection->map(function ($item, $key) use ($collectHeader, $add, $date) {

                $value = ($item['value'] >= $item['goal']) ? $item['points'] : 0 ;
                $array = ['Cumplimiento meta: '.$item['event'],$value, $item['user_id'], $item['id']];
                $arrayUp = Arr::collapse([$array, $add]);

                return collect($collectHeader)->combine($arrayUp)->all();

            })->filter()->values()->all();

            foreach (array_chunk($collectionMix, 5000) as $t) {
                DB::table('points')->insert($t);
            }

            return back()->with('status', 'Se ha realizado la liquidación de '.count($collectionMix).' usuarios.');

        } else {

            return back()->with('status', 'No hay liquidaciones pendientes');

        }
    }

}
