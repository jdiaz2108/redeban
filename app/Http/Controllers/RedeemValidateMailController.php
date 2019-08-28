<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Point;
use App\Models\Prize;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\redeemValidateMail;
use Illuminate\Support\MessageBag;
use App\Http\Requests\RedeemCodeRequest;
use App\Http\Controllers\SendEmailController;

class RedeemValidateMailController extends Controller
{
        /**
     * The user repository instance.
     */
    protected $errors;

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
    public function update(RedeemCodeRequest $request, $id)
    {
        $prize = Prize::whereCode($id)->firstOrFail();
        $user = $request->user();
        $activeredeem = $user->activeredeem;

        // initialize MessageBag model and is used to redirect with $errors
        $errors = new MessageBag;

        
        // Verifying if the code generate is relationated with the prize that is redeeming
        if (($activeredeem->prize_id ?? '') == $prize->id && ($activeredeem->active ?? '')) {
            
            // Validation if the code has no more than 10 minutes to use generating a boolean variable $redeem
            $carbon = Carbon::now('America/Bogota')->subMinutes(10);
            $redeem = $carbon <= $user->activeredeem->created_at;
            
            // Validate if the boolean variable $redeem generated by 10 minutes verification is correct
            if($redeem) {
                
                // Validate if the code is correct
                if (($activeredeem->code ?? '') == $request['code']) {
                    $date = Carbon::now();

                   $coupon = new Coupon([
                       'code' => strtoupper(Str::random(10)),
                       'user_id' => $user->id,
                       'prize_id' => $prize->id,
                       ]);
                       
                       redeemValidateMail::whereCode($request['code'])->update(['active' => false]);
                       
                       $points = new Point([
                            'event' => 'Actualización de datos',
                            'value' => -$prize['point'],
                            'user_id' => $request->user()->id,
                            'month' => $date->month,
                            'year' => $date->year
                        ]);

                        $prize->update(['stock' => ($prize['stock'] - 1)]);

                        $points->save();

                        $coupon->save();

                        return back()->with('status', 'Haz generado el cupon');

                } else {
                    // Redirect back with the error that explain the code is invalid
                    $errors->add('code', 'El Código es incorrecto!');
                    return back()->withErrors($errors);
                }

            } else {

                // Redirect back if has passed the estimated time
                $errors->add('error_tiempo', 'El codigo ya no es válido, genere uno nuevamente');
                return back()->withErrors($errors);
            }

        } else {

            $errors->add('error', 'Hemos detectado un problema y no se ha podido completar la tarea');
            return back()->withErrors($errors);

        }
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
