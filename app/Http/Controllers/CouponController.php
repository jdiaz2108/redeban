<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate();

        return view('pages.admin.coupons.index', compact('coupons'));
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

    public function toggleState(Coupon $coupon)
    {
        if ($coupon) {
            $coupon->redeem = !$coupon->redeem;
            $coupon->save();

            return back()->with('status', 'Se ha actualizado el estado del cupon correctamente.');
        }
    }

    public function download()
    {
        $date = Carbon::now();

        // Get all fulfillments where the requested week

        $cupons = Coupon::whereRedeem(0)->with('shop.user.userData', 'prizecategory.prize')->get();

        if ($cupons->isNotEmpty()) {

            // Define download file name
            $fileDir = '../storage/app/download/'.$date->format('Y-m-d_H-i-s').'cupones.csv';

            // Open file to insert the csv file
            $fp = fopen($fileDir, 'w');

            // Define the headers and insert into the csv file
            $headers =   [
                            'Codigo redencion',
                            'Fecha redencion',
                            'Nombre premio',
                            'Categoria',
                            'Nombre codigo unico',
                            'Codigo unico',
                            'Nit usuario',
                            'Nombre usuario',
                            'Correo electronico',
                            'Telefono',
                            'Direccion',
                            'Nombre usuario Actualizado',
                            'Correo electronico Actualizado',
                            'Telefono Actualizado',
                            'Direccion Actualizada',
                            'Departamento Actualizado',
                            'Ciudad Actualizada'
                        ];

           fputcsv($fp, $headers);

            foreach ($cupons->chunk(50000) as $t) {

               // Mapping the array and inserting data inside the csv file
                $t->map(function ($item, $key) use ($fp) {
                     // Eliminate period and updated_at column from the object
                    $array = [
                                $item['code'],
                                $item['created_at'],
                                $item['prizecategory']['prize']['name'],
                                $item['user']['category']['name'],
                                $item['shop']['name'],
                                $item['shop']['code'],
                                $item['user']['identification'],
                                $item['user']['name_company'],
                                $item['user']['email'],
                                $item['user']['phone'],
                                $item['user']['address'],
                                $item['user']['userData']['name'],
                                $item['user']['userData']['email'],
                                $item['user']['userData']['phone'],
                                $item['user']['userData']['address'],
                                $item['user']['userData']['cityname'],
                                $item['user']['userData']['departmentname']
                            ];

                     fputcsv($fp, $array);

                     return $array;

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
}
