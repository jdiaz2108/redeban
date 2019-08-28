<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailjetController;

class SendEmailController extends Controller
{
	public static function register_user($user,$password)
	{
		$name = $user->first_name;
		$identification = $user->identification;
		//Pinta variables en template.
		$template = view('emails.register-user', compact('name','identification','password'))->render();
		//Carga variables pára envio de email.
		$data['user_email'] = $user->email;
		$data['user_name'] = $name;
		$data['email_subject'] = 'Bienvenido a una nueva experiencia.';
		$data['email_description'] = 'Test.';
		$data['email_template'] = $template;

		//Ejecuta el envío.
		$res = MailjetController::sendEmail($data);
	}

    // public static function redeem_prize($user,$prize,$code_num)
	public static function redeem_prize($redeemValidateMail)
	{
	/* 	$name =  $user->first_name;
		$prize_name = $prize->name;
		$code = $code_num;
		$place = $prize->place_receive; */

        //Pinta variables en template.
        // $template = view('emails.redeem-prize', compact('name','prize_name','code','place'))->render();
		$template = view('emails.redeem-prize', compact('redeemValidateMail'))->render();
        //Carga variables pára envio de email.
        

		/* $data['user_email'] = $user->email;
		$data['user_name'] = $name;
		$data['email_subject'] = 'Redención de CentralCoins.';
        $data['email_description'] = 'Test.';
 */
        $data['user_email'] = 'john.diaz@inxaitcorp.com';
		$data['user_name'] = 'john';
		$data['email_subject'] = 'Redención de CentralCoins.';
        $data['email_description'] = 'Test.';
        

		$data['email_template'] = $template;

		//Ejecuta el envío.
		$res = MailjetController::sendEmail($data);
	}

	public static function refer_user($full_name,$email)
	{
		$name = $full_name;

		//Pinta variables en template.
		$template = view('emails.refer-user')->render();
		//Carga variables pára envio de email.
		$data['user_email'] = $email;
		$data['user_name'] = 'Test';
		$data['email_subject'] = 'Te invitaron a conocer nuevas experiencias.';
		$data['email_description'] = 'Test.';
		$data['email_template'] = $template;

		//Ejecuta el envío.
		$res = MailjetController::sendEmail($data);
	}

	public static function points_refer($user)
	{
		$name = $user->first_name;

		//Pinta variables en template.
		$template = view('emails.points-refer', compact('name'))->render();
		//Carga variables pára envio de email.
		$data['user_email'] = $user->email;
		$data['user_name'] = 'Test';
		$data['email_subject'] = 'Ganaste CentralCoins por referir a un amigo.';
		$data['email_description'] = 'Test.';
		$data['email_template'] = $template;

		//Ejecuta el envío.
		$res = MailjetController::sendEmail($data);
	}

	public static function aprove_bill($user)
	{
		$name = $user->first_name;

		//Pinta variables en template.
		$template = view('emails.aprove-bill', compact('name'))->render();

		//Carga variables pára envio de email.
		$data['user_email'] = $user->email;
		$data['user_name'] = 'Test';
		$data['email_subject'] = 'Ganaste CentralCoins por el registro de factura.';
		$data['email_description'] = 'Test.';
		$data['email_template'] = $template;

		//Ejecuta el envío.
		$res = MailjetController::sendEmail($data);
	}


}
