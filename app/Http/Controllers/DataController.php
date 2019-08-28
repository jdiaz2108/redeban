<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Revisar
use DB;
use Excel;
use Response;
use Validator;
use App\Models\Register;
use App\Models\LoadHistory;
use App\Models\TempRegister;
use App\Models\InvalidRegister;
use Carbon\Carbon;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

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
        return view('admin.data.create');
    }

    public function showHistory()
    {
        $history = LoadHistory::orderBy('id','desc')->paginate(10);

        return view('admin.data.history', compact('history'));
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|file',
            'creation_date' => 'required|date_format:"d/m/Y"'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $file = $request->file('data');
        $rut = $request->rut;
        $importer = new CsvFileImporter;
        $loadHistory = $importer->processCSVFile($file,$rut);

        $now = date('Y-m-d H:i:s');
        $date = Carbon::createFromFormat('d/m/Y', $request->creation_date);

        DB::update('update temp_registers set rut = TRIM(rut)');
        DB::update('update temp_registers set created_at ="'.$date.'", updated_at ="'.$now.'"');

        $this->filterTempRegisters($loadHistory,$rut);
        DB::table('temp_registers')->truncate();

        return redirect()->route('data.history')->with('status', 'Se han cargado los registros correctamente');
    }

    public function filterTempRegisters($loadHistory,$rut)
    {
        if($rut == "on") {
          $structureValidRegisters = DB::insert("INSERT INTO registers (first_name, last_name, full_name, rut, dealer, cellphone, email, model, bell, observations, commercial, `month`, credit_number, created_at, updated_at) SELECT first_name, last_name, full_name, rut, dealer, cellphone, email, model, bell, observations, commercial, `month`, credit_number, created_at, updated_at FROM temp_registers WHERE rut REGEXP '[0-9]{8}-[0-9kK]{1}'");
        } else {
          $structureValidRegisters = DB::insert("INSERT INTO registers (first_name, last_name, full_name, rut, dealer, cellphone, email, model, bell, observations, commercial, `month`, credit_number, created_at, updated_at) SELECT first_name, last_name, full_name, rut, dealer, cellphone, email, model, bell, observations, commercial, `month`, credit_number, created_at, updated_at FROM temp_registers");
        }


        $notValidRegisters = DB::select("SELECT * FROM temp_registers WHERE NOT rut REGEXP '[0-9]{8}-[0-9kK]{1}'");

        $this->storeWrongResults($loadHistory->id, $notValidRegisters);

        $loadHistory->invalid_records =  DB::table('invalid_registers')->where('load_id', $loadHistory->id)->count();
        $loadHistory->save();
    }

    private function storeWrongResults($loadId, $records)
    {
        $register = new InvalidRegister;
        foreach ($records as $record) {
            $register->first_name = $record->first_name;
            $register->last_name = $record->last_name;
            $register->full_name = $record->full_name;
            $register->rut = $record->rut;
            $register->dealer = $record->dealer;
            $register->cellphone = $record->cellphone;
            $register->email = $record->email;
            $register->model = $record->model;
            $register->bell = $record->bell;
            $register->observations = $record->observations;
            $register->commercial = $record->commercial;
            $register->month = $record->month;
            $register->credit_number = $record->credit_number;
            $register->wrong_reason = 'Formato de RUT incorrecto';
            $register->load_id = $loadId;
            $register->save();
        }
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