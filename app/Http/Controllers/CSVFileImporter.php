<?php

namespace App\Http\Controllers;

use App\Models\LoadHistory;
use DB;
use Storage;

class CsvFileImporter
{
    public function processCSVFile($file,$rut)
    {
        $now = date('Y-m-d_H-i-s');
        $filename = $now.'_datos.csv';
        $originalFilename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename);
        $normalized = $this->normalize($path);
        $this->importFileContents($normalized);

        $history = new LoadHistory;
        $history->original_file_name = $originalFilename;
        $history->records_count = DB::table('temp_registers')->count();
        $history->rut = $rut == "on" ? 1 : 0;
        $history->save();

        return $history;
    }

    private function normalize($file_path)
    {
        $string = Storage::get($file_path);

        if (!$string) {
            return $file_path;
        }

        //Convert all line-endings using regular expression
        $string = preg_replace('~\r\n?~', "\n", $string);

        Storage::put($file_path, $string);

        return $file_path;
    }

    private function getDelimiter($file_path)
    {
        $delimiters = array(
            ';' => 0,
            ',' => 0,
            "\t" => 0,
            "|" => 0
        );

        $handle = fopen(base_path('public/storage/'.$file_path), "r");
        $firstLine = fgets($handle);
        fclose($handle);
        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($firstLine, $delimiter));
        }

        return array_search(max($delimiters), $delimiters);
    }

    private function importFileContents($file_path)
    {
        $query = sprintf("LOAD DATA LOCAL INFILE '%s' INTO TABLE temp_registers FIELDS TERMINATED BY '".$this->getDelimiter($file_path)."' LINES TERMINATED BY '\n'  IGNORE 1 LINES (`month`,`dealer`,`first_name`,`last_name`,`full_name`,`rut`,`cellphone`,`email`,`model`,`observations`,`bell`,`commercial`, `credit_number`)", addslashes(storage_path('app/public/'.$file_path)));

        return DB::connection()->getpdo()->exec($query);
    }
}
