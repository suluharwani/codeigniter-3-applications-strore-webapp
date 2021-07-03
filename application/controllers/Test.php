<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
		$password = 'hunter2';
		$hash = $this->bcrypt->hash_password($password);
		echo($hash);

		if ($this->bcrypt->check_password($password, $hash))
		{
		echo('correct password');
		}
		else
		{
	// Password does not match stored password.
		}

	}
	public function captcha(){
		// use Gregwar\Captcha\CaptchaBuilder;
		include APPPATH . 'third_party/Gregwar/Captcha/CaptchaBuilder.php';
		$builder = new CaptchaBuilder;
		header('Content-type: image/jpeg');
		$builder->output();
	}
}
