<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailjetController;

class SendEmailController extends Controller
{
	public static function register_user($user,$password)
	{
		$name = $user->name_company;
		$identification = $user->identification;
		$pass = 'redeban'.$identification;

		//Pinta variables en template.
		$template = view('emails.welcome', compact('name','identification','pass'))->render();
		//Carga variables pára envio de email.
		$data['user_email'] = $user->email;
		$data['user_name'] = $name;
		$data['email_subject'] = 'Bienvenido a la transacción ganadora.';
		$data['email_description'] = 'Test.';
		$data['email_template'] = $template;

		//Ejecuta el envío.
		$res = MailjetController::sendEmail($data);

		return $res;
	}

  public static function send_code($user,$prize,$code_row)
	{
	  $name = $user->name_company;
		$image = ($prize->image) ? $prize->image : url('/images/image.png');
		$prize = $prize->name;
		$code = $code_row->code;

    //Pinta variables en template.
		$template = view('emails.send-code', compact('name','image','prize','code'))->render();
    //Carga variables pára envio de email.
		$data['user_email'] = $user->email;
		$data['user_name'] = $name;
		$data['email_subject'] = 'Codigo de verificación.';
        $data['email_description'] = 'Test.';
		$data['email_template'] = $template;

		//Ejecuta el envío.
        $res = MailjetController::sendEmail($data);

		return $res;
	}

	public static function redeem_prize($user,$prize)
	{
        $name = $user->name_company;
        $image = ($prize->image) ? $prize->image : url('/images/image.png');
		$points = $prize->point;
        $prize = $prize->name;

		//Pinta variables en template.
		$template = view('emails.redeem-prize',compact('name','image','prize','points'))->render();
		//Carga variables pára envio de email.
		$data['user_email'] = $user->email;
		$data['user_name'] = $name;
		$data['email_subject'] = 'Redención exitosa.';
		$data['email_description'] = 'Test.';
		$data['email_template'] = $template;

		//Ejecuta el envío.
		$res = MailjetController::sendEmail($data);

		return $res;
	}


}
