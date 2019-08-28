<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prizes = Prize::whereActive(true)->get();
        return view('pages.home.prize.catalog', compact('prizes'));
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
    public function show(Prize $prize)
    {
        $user = Auth::user();
   
        $redeem = ($user->activeredeem->prize_id == $prize->id) ? true : false ;
        if ($redeem) {

            $carbon = Carbon::now('America/Bogota')->subMinutes(10);
            $tenMinutesValidation = $carbon <= $user->activeredeem->created_at;
            
            $redeem = ($tenMinutesValidation) ? true : false ;
        }

        return view('pages.home.prize.show', compact('prize', 'redeem'));
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
}
