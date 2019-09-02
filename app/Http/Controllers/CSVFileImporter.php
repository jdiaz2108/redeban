<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\LoadHistory;
use App\Models\Fulfillment;
use App\Models\InvalidFulfillment;
use Illuminate\Support\Arr;

class CsvFileImporter
{
    public function processCSVFile($file, $type)
    {
        $date = Carbon::now();

        $filename = $date->format('Y-m-d_H-i-s').'_data.csv';
        $originalFilename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename);

        // Convert csv file in array variable called $array and convert that variable into a collection
        $array = array_map("str_getcsv", file($file));
        $collection = collect($array);

        // Get the body of the collection, that means the body contain the rows of the table
        $collectBody = $collection->splice(1);

        // Get the header of the collection, that means the header is the columns of the table
        $collectHeader = $collection->push(['created_at','updated_at'])->flatten()->all();

        // Transform between the Body and Header to combinate and make the references columns and rows content
        $collectionMix = $collectBody->map(function ($item, $key) use ($collectHeader, $date) {
            array_push($item, $date, $date);
            if (count($item) == count($collectHeader) and !in_array("",$item)) {
                return collect($collectHeader)->combine($item)->all();
            }
        })->filter()->values()->all();

       
        // for with array chunk to ejecute 10000 petitions at time with the $collectionMix variable to push directrly to database
        foreach (array_chunk($collectionMix,10000) as $t) {
            DB::table($type)->insert($t);
        }

        
        // Register a history of the file loads
        $history = new LoadHistory([
            'original_file_name' => $originalFilename,
            'records_count' => count($collectionMix),
        ]);
        $history->save();

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
                $f = count($collectHeader);
                for ($i=$a; $i < $f; $i++) {
                    array_push($item, 0);
                }
                array_push($item, $date, $date, $history->id);
                return collect($collectHeader)->combine($item)->all();
            }
        })->filter()->values()->all();
        
        foreach (array_chunk($collectionError,10000) as $t) {
            InvalidFulfillment::insert($t);
        }

        $history->invalid_records = count($collectionError);
        $history->save();

        // Returning the $history of file loaded
        return $history;
    }
}
