<?php

namespace App\Http\Controllers;

use App\Models\LoadHistory;
use App\Models\Fulfillment;
use Illuminate\Http\Request;
use App\Http\Requests\DataFileRequest;
// Revisar
use Excel;
use Response;
use App\Models\Register;
use App\Models\InvalidRegister;
use Carbon\Carbon;

class DataController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function index()
    {
        $registers = Register::orderBy('id', 'desc')->paginate(15);
        return view('admin.data.index')->with('registers',$registers);
    }

    public function showUpdate()
    {
        return view('admin.data.update');
    }

    public function create()
    {
        return view('pages.admin.data.index');
    }

    public function showHistory()
    {
        $history = LoadHistory::orderBy('id','desc')->paginate(100);

        return view('pages.admin.data.history', compact('history'));
    }

    public function downloadCSV($history)
    {
        $records = InvalidRegister::where('load_id', $history)->get();
        $now = date('Y-m-d_H-i-s');
        $filename = $now.'_datos_invalidos.csv';

        return Excel::create($filename, function($excel) use ($records) {
            $excel->sheet('RUTS invalidos', function($sheet) use ($records) {
                $sheet->setStyle(array(
                    'font' => array(
                        'name' =>  'Arial',
                        'size' =>  11,
                    )
                ));

                $sheet->row(1, array(
                    'NOMBRE', 'APELLIDO', 'NOMBRECOMPLETO', 'RUT', 'CONCESIONARIO', 'CELULAR', 'CORREO',
                    'MODELO', 'CAMPAÑA', 'OBSERVACIONES DEL PLAN', 'GANCHO COMERCIAL', 'MES', 'INVALIDO POR', 'NRO CRÉDITO'
                ));

                $sheet->cells('A1:N1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });

                foreach ($records as $record) {
                    $sheet->appendRow(array(
                        $record->first_name,
                        $record->last_name,
                        $record->full_name,
                        $record->rut,
                        $record->dealer,
                        $record->cellphone,
                        $record->email,
                        $record->model,
                        $record->bell,
                        $record->observations,
                        $record->commercial,
                        $record->month,
                        'RUT con formato incorrecto',
                        $record->credit_number
                    ));
                }
            });
        })->export('xlsx');
    }

    public function store(DataFileRequest $request)
    {
        $file = $request->file('data');

        // Call a Controller and use the processCVSFile method
        $importer = new CsvFileImporter;
        $loadHistory = $importer->processCSVFile($file);

        // if is necessary add the date of every row in fulfillment model
        /* $now = date('Y-m-d H:i:s');
            $date = Carbon::now();
            Fulfillment::whereCreated_at(null)->update(['created_at' => $date, 'updated_at' => $now]); */
        return redirect()->route('data.history')->with('status', 'Se han cargado los registros correctamente');
    }

    public function download()
    {
      $now = date('Y-m-d_H-i-s');
      $filename = $now.'_registros.csv';

      $headers = [
        'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
        'Content-type'        => 'text/csv',
        'Content-Disposition' => 'attachment; filename='.$filename,
        'Expires'             => '0',
        'Pragma'              => 'public'
      ];

      $records = Register::all()->toArray();
      # add headers for each column in the CSV download
      array_unshift($records, array_keys($records[0]));

      $callback = function() use ($records)
      {
          $FH = fopen('php://output', 'w');
          foreach ($records as $row) {
              fputcsv($FH, $row);
          }
          fclose($FH);
      };

      return Response::stream($callback, 200, $headers);
    }
}