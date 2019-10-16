<?php

namespace App\Http\Controllers;

use App\Models\FulfillmentResult;
use App\Models\Fulfillment;
use Auth;
use App\Models\Point;
use App\Models\PrizeCategory;
use App\Models\Shop;
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
        $points = Point::with('shop')->orderBy('value', 'desc')->paginate();
      } else {
        $points = Point::whereHas('shop', function ($query) use ($name) {
            $query->where('code', 'LIKE', "%$name%");
        })->paginate();
      }

      return view('pages.admin.points.index',compact('points'));
    }

    public function gettingPoints(Request $request)
    {

            // Get all fulfillments where the requested week
        //    $points = Point::with('shop.user.category')->orderBy('value', 'desc')->paginate();
        $date = Carbon::now();
        $model = Shop::has('points')->with('user')->get();

           if ($model->isNotEmpty()) {
               // Define download file name
               $fileDir = '../storage/app/download/'.$date->format('Y-m-d_H-i-s').'download.csv';

               // Open file to insert the csv file
               $fp = fopen($fileDir, 'w');

               // Define the headers and insert into the csv file
               $headers = array('Codigo unico', 'Nit', 'Nombre', 'Email', 'Telefono', 'Categoria', 'Puntos');

               fputcsv($fp, $headers);

               foreach ($model->chunk(50000) as $t) {
                   // Mapping the array and inserting data inside the csv file
                   $t->map(function ($item, $key) use ($fp) {

                         $var = [$item['code'], $item->user['identification'], $item->user['name_company'], $item->user['email'], $item->user['phone'], $item->user['category_id'], $item['totalpoints']];
                        //  $collection = collect($var)->except(['created_at', 'updated_at'])->push([null, $item['shopidentification']]);
                        //  $flattened = Arr::flatten($collection);
                         fputcsv($fp, $var);

                         return $var;

                     })->filter()->values()->all();
                }

                // Closing the csv file
                fclose($fp);

                // Downloading the csv generated
                return response()->download($fileDir)->deleteFileAfterSend();

           } else {

                return back()->with('status', 'No hay metas pendientes por actualizar');
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

    public function liquidation()
    {
        ini_set('memory_limit', '-1');
        // Define the collection with fulfillment relationship, liquidation has to be false and get uniques fulfillments id
        $collection = FulfillmentResult::whereLiquidated(false)->with('fulfillment')->get()->unique('fulfillment_id');

        // Validate if the collection is not empty and have data to liquidate
        if ($collection->isNotEmpty()) {

            $date = Carbon::now();

            // Define the headers
            $collectHeader = ['event', 'value', 'shop_id', 'fulfillment_results_id', 'month', 'year', 'created_at','updated_at'];
            $add = [intval($date->format('m')), intval($date->format('Y')), $date, $date];

            // Mixing the collection with headers and data to generate points collection
            $collectionMix = $collection->map(function ($item, $key) use ($collectHeader, $add) {
                // Validate if the user can get points
                if (($item['fulfillment']['valueliquidated'] + $item['transactions']) > $item['fulfillment']['goal']) {

                    $diferencial = ($item['fulfillment']['goal'] > $item['fulfillment']['valueliquidated']) ? $item['fulfillment']['goal'] : $item['fulfillment']['valueliquidated'];
                    $finaltransactions = ($item['fulfillment']['valueliquidated'] + $item['transactions']) - $diferencial ;

                    $value = $finaltransactions * $item['fulfillment']['points'];

                    $array = ["Cumplimiento meta semanal: {$item['fulfillment']['month']} - {$item['fulfillment']['year']}", $value, $item['fulfillment']['shop_id'], $item['id'],];
                    $arrayUp = Arr::collapse([$array, $add]);

                    return collect($collectHeader)->combine($arrayUp)->all();
                }

            })->filter()->values()->all();

            // Collection to get all the ids and update the state to liquidated true
            $collectionIdRes = $collection->map(function ($item, $key) {

                return collect(['id'])->combine([$item['id']])->all();

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


