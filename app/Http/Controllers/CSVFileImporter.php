<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Fulfillment;
use App\Models\LoadHistory;
use App\Models\InvalidFulfillment;
use App\User;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Request;

class CSVFileImporter
{

    public function index()
    {
        $history = LoadHistory::orderBy('id','desc')->paginate();

        return view('pages.admin.history', compact('history'));
    }

    public static function processCSVFile($file, $type, $update = false, $chunk = 1000, $event = null)
    {
        $date = Carbon::now();

        $filename = $date->format('Y-m-d_H-i-s').'_data.csv';
        $originalFilename = $file->getClientOriginalName();
        $file->storeAs('uploads', $filename);

        // Convert csv file in array variable called $array and convert that variable into a collection
        $array = array_map("str_getcsv", file($file));
        $collection = collect($array);

        // Get the body of the collection, that means the body contain the rows of the table
        $collectBody = $collection->splice(1);

        // Get the header of the collection, that means the header is the columns of the table
        if ($event) {
            $collectHeader = $collection->push(['event','created_at','updated_at'])->flatten()->all();
            $add = [$event, $date, $date];
        } elseif ($update) {
            $collectHeader = $collection->push(['updated_at'])->flatten()->all();
            $add = [$date];
        } else {
            $collectHeader = $collection->push(['created_at','updated_at'])->flatten()->all();
            $add = [$date, $date];
        }

        // Transform between the Body and Header to combinate and make the references columns and rows content
        $collectionMix = $collectBody->map(function ($item, $key) use ($collectHeader, $add) {
            $item = Arr::collapse([$item, $add]);
            if (count($item) == count($collectHeader) and !in_array("",$item)) {
                return collect($collectHeader)->combine($item)->all();
            }
        })->filter()->values()->all();

        if ($update) {
            foreach (array_chunk($collectionMix, $chunk) as $t) {
                $ids = collect($t)->pluck('id');
                DB::table($type)->whereIn('id', $ids)->delete();
            }
        }


        // for with array chunk to ejecute 10000 petitions at time with the $collectionMix variable to push directrly to database
        foreach (array_chunk($collectionMix, $chunk) as $t) {
            DB::table($type)->insert($t);
        }

         if ($type = 'users') {

            User::wherePassword('password')->update(['password' => bcrypt('redeban2019')]);

         }

        // Register a history of the file loads
        $history = new LoadHistory([
            'original_file_name' => $originalFilename,
            'records_count' => count($collectionMix),
        ]);
        $history->save();

        // error for fulfillments
        if ($type == 'fulfillmentss') {
            $this->InvalidFulfillments($collection, $collectBody, $add, $history);
        }

        // Returning the $history of file loaded
        return $history;
    }

    public function InvalidFulfillments($collection, $collectBody, $date, $history)
    {
        $collectHeader = $collection->push(['load_historie_id'])->flatten()->all();

        $collectionError = $collectBody->map(function ($item, $key) use ($collectHeader, $date, $history) {
            array_push($item, $date, $date, $history->id);
            if (count($item) == ($collectHeader) or in_array("",$item)) {
                return collect($collectHeader)->combine($item)->all();
            } elseif (count($item) != count($collectHeader) or in_array("",$item)) {
                array_pop($item);
                array_pop($item);
                array_pop($item);
                $a = count($item) +3;
                $j = count($collectHeader);
                for ($i=$a; $i < $j; $i++) {
                    array_push($item, 0);
                }
                array_push($item, $date, $date, $history->id);
                return collect($collectHeader)->combine($item)->all();
            }
        })->filter()->values()->all();

        foreach (array_chunk($collectionError,10000) as $t) {
            InvalidFulfillment::insert($t);
        }

        $history->update(['invalid_records' => count($collectionError)]);
    }

    public function download(Request $request)
    {

        $date = Carbon::now();

        // Get all fulfillments where value hasn't loaded yet
       $fulfillments = Fulfillment::whereValue(null)->whereEvent($request['event'])->get();

       if ($fulfillments->isNotEmpty()) {
           // Define download file name
           $fileDir = '../storage/app/download/'.$date->format('Y-m-d_H-i-s').'download.csv';

           // Open file to insert the csv file
           $fp = fopen($fileDir, 'w');

           // Define the headers and insert into the csv file
           $headers = array('id', 'event' ,'goal', 'value', 'user_id', 'created_at', 'identification');
           fputcsv($fp, $headers);

           foreach ($fulfillments->chunk(50000) as $t) {

               // Mapping the array and inserting data inside the csv file
               $t->map(function ($item, $key) use ($fp) {
                     // Eliminate period and updated_at column from the object
                     $collection = collect($item)->forget('period')->forget('updated_at')->push($item['useridentification']);
                     $flattened = Arr::flatten($collection);
                     fputcsv($fp, $flattened);

                     return $flattened;

                 })->filter()->values()->all();
            }

            // Closing the csv file
            fclose($fp);

            // Downloading the csv generated
            return response()->download($fileDir)->deleteFileAfterSend();
       } else {
            return back()->with('status', 'No hay metas pendientes por actualizar con el evento '.$request['event']);
       }


    }

    public function fulfillmentsBase()
    {
        $date = Carbon::now();

        $user = User::all();

       if ($user->isNotEmpty()) {
           // Define download file name
           $fileDir = '../storage/app/download/'.$date->format('Y-m-d_H-i-s').'fulfillment-base.csv';

           // Open file to insert the csv file
           $fp = fopen($fileDir, 'w');

           // Define the headers and insert into the csv file
           $headers = array('goal', 'user_id' ,'identification');
           fputcsv($fp, $headers);

           foreach ($user->chunk(50000) as $t) {

               // Mapping the array and inserting data inside the csv file
               $t->map(function ($item, $key) use ($fp) {
                     // Eliminate period and updated_at column from the object
                     $array = array('', $item['id'], $item['identification']);
                     fputcsv($fp, $array);

                     return $array;

                 })->filter()->values()->all();
            }

            // Closing the csv file
            fclose($fp);

            // Downloading the csv generated
            return response()->download($fileDir)->deleteFileAfterSend();
       } else {
            return back()->with('status', 'No hay registros base para descargar');
       }

    }

    public function userBase()
    {
        $date = Carbon::now();

        // Define download file name
        $fileDir = '../storage/app/download/'.$date->format('Y-m-d_H-i-s').'users-base.csv';

        // Open file to insert the csv file
        $fp = fopen($fileDir, 'w');

        // Define the headers and insert into the csv file
        $headers = array('identification', 'name_company', 'code', 'email', 'phone', 'password', 'name', 'address', 'email', 'category_id');
        fputcsv($fp, $headers);

        // Closing the csv file
        fclose($fp);

        // Downloading the csv generated
        return response()->download($fileDir)->deleteFileAfterSend();

    }

}
