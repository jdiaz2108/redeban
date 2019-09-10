<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
	public function welcome()
	{
		$name = 'Test';
		$identification = 123456789;
		$pass = 'redeban123456789';

		//Pinta variables en template.
		return view('emails.welcome', compact('name', 'identification', 'pass'));
	}

  public function sendCode()
	{
		$name = 'Test';
		$image = "https://latransaccionganadora.com/images/logo-redeban.png";
		$prize = "Prize Test";
		$code = 123456789;

		//Pinta variables en template.
		return view('emails.send-code', compact('name', 'image', 'prize', 'code'));
	}

	public function redeemPrize()
	{
		$name = 'Test';
		$prize = "Prize Test";
		$points = 100;

		//Pinta variables en template.
		return view('emails.redeem-prize', compact('name', 'prize', 'points'));
	}

}
