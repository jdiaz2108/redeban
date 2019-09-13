<?php

namespace App\Http\Controllers;

use App\Models\FulfillmentResult;
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
    public function index(Request $request)
    {
      $name = $request['query'];
      if(is_null($name))
      {
        $points = Point::with('user')->paginate();
      } else {
        $points = Point::whereHas('user', function ($query) use ($name) {
            $query->where('name_company', 'LIKE', "%$name%")->orWhere('identification', 'LIKE', "%$name%");
        })->paginate();
      }

      return view('pages.admin.points.index',compact('points'));
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
        $collection = Fulfillment::has('fulfillmentResults', '<', 4)->with('fulResSameMonth')->get();

       $collection = FulfillmentResult::whereLiquidated(false)->with('fulfillment')->get() ;

        // dd($collection);

        // Old code

        if ($collection->isNotEmpty()) {

            $date = Carbon::now();

            $collectHeader = ['event', 'value', 'user_id', 'fulfillment_results_id', 'month', 'year', 'created_at','updated_at'];
            $add = [intval($date->format('m')), intval($date->format('Y')), $date, $date];

            $collectionIdRes = $collection->map(function ($item, $key) use ($collectHeader, $add) {
                return collect(['id'])->combine([$item['id']])->all();

            })->filter()->values()->all();

            dd($collectionIdRes);
            $collectionMix = $collection->map(function ($item, $key) use ($collectHeader, $add) {

                if ($item['goal'] < $item['MaxNoLiq']) {


                    $value = ($item['MaxNoLiq'] - $item['MaxLiq']) * $item['points'];
                    $array = ["Cumplimiento meta semanal: {$item['month']} - {$item['year']}", $value, $item['user_id'], $item['idfulres']->id,];
                    $arrayUp = Arr::collapse([$array, $add]);

                    return collect($collectHeader)->combine($arrayUp)->all();
                }
                // if ($item['value'] >= $item['goal'] && $item['points']) {
                //     $value = $item['points'];
                //     $array = ['Cumplimiento meta: '.$item['event'],$value, $item['user_id'], $item['id']];
                //     $arrayUp = Arr::collapse([$array, $add]);

                //     return collect($collectHeader)->combine($arrayUp)->all();
                // }

            })->filter()->values()->all();


            foreach (array_chunk($collectionIdRes, 5000) as $t) {
                $ids = collect($t)->pluck('id');
                DB::table('fulfillment_results')->whereIn('id', $ids)->update(['liquidated' => true]);
            }

                foreach (array_chunk($collectionMix, 5000) as $t) {
                    DB::table('points')->insert($t);
                }


                return back()->with('status', 'Se ha realizado la liquidación de '.count($collectionIdRes).' usuarios.');


        } else {

            return back()->with('status', 'No hay liquidaciones pendientes');

        }
    }

}


