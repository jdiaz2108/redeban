<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use App\Models\redeemValidateMail;
use Illuminate\Http\Request;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Requests\RedeemCodeRequest;

class RedeemValidateMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $prize = Prize::whereCode($data['code'])->firstOrFail();
        $user = $request->user();
        // Validate if User has more points that the cost of the prize
        if ($user->sumpoints >= $prize['point']) {

            $data['user_id'] = $user->id;
            $data['prize_id'] = $prize['id'];
            $data['code'] = strtoupper(Str::random(10));
            $redeemValidateMail = new redeemValidateMail($data);
            $redeemValidateMail->save();
            // use SendEmailController to send an email to the user with the code of redeem
            SendEmailController::redeem_prize($redeemValidateMail);

            return back()->with('status', 'revisa el correo');

        } else {

            return back()->with('status', 'no alcanza');

        }
        
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
    public function update(RedeemCodeRequest $request, Prize $prize)
    {
        return $request;

        $redeem = ($user->activeredeem->prize_id == $prize->id) ? true : false ;
        if ($redeem) {
            $carbon = Carbon::now('America/Bogota')->subMinutes(10);
            $tenMinutesValidation = $carbon <= $user->activeredeem->created_at;
            
            $redeem = ($tenMinutesValidation) ? true : false ;

            if(!$tenMinutesValidation) {
                $errors->add('your_custom_error', 'Your custom error message!');
            }
        }
        $errors = new MessageBag;
        return view('pages.home.prize.show', compact('prize', 'redeem'))->withErrors($errors);
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
