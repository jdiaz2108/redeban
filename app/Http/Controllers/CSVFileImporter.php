<?php

namespace App\Http\Controllers;

use DB;
use App\Models\LoadHistory;
use App\Models\Fulfillment;
use Illuminate\Support\Arr;

class CsvFileImporter
{
    public function processCSVFile($file)
    {
        $now = date('Y-m-d_H-i-s');
        $filename = $now.'_data.csv';
        $originalFilename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename);

        // Convert csv file in array variable called $array and convert that variable into a collection
        $array = array_map("str_getcsv", file($file));
        $collection = collect($array);

        // Get the body of the collection, that means the body contain the rows of the table
        $collectBody = $collection->splice(1);

        // Get the header of the collection, that means the header is the columns of the table
        $collectHeader = $collection->first();

        // Transform between the Body and Header to combinate and make the references columns and rows content
        $collectionMix = $collectBody->map(function ($item, $key) use ($collectHeader) {
            if (count($item) == 3 and !in_array("",$item)) {
                return collect($collectHeader)->combine($item)->all();
            } else {
                $fakeitem = [0,0,0];
                return collect($collectHeader)->combine($fakeitem)->all();
            }
        });

        // Define a $final variable to contain all the return of the mixed collections
        $final = $collectionMix->values()->all();

        // for with array chunk to ejecute 10000 petitions at time
        foreach (array_chunk($final,10000) as $t) {
            DB::table('fulfillments')->insert($t);
         }

        // Register a history of the file loads
        $history = new LoadHistory([
            'original_file_name' => $originalFilename,
            'records_count' => count($final)
        ]);
        $history->save();

        // Returning the $history of file loaded
        return $history;
    }
}
