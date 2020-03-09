<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MyCrypt;

class Transaction extends Model
{
	private function generateTestPayment()
	{
		$this->sum=mt_rand(10,500);
		$this->commision=round(mt_rand(5,20)/10,2);
		$this->order_number=mt_rand(1,20);
		$this->save();
		
		
	}
	public function sendTestPayment($url)
	{
		
		$this->generateTestPayment();
		$data=json_encode([
		"id"=>$this->id,
		"commision"=>$this->commision,
		"sum"=>$this->sum,
		"order_number"=>$this->order_number
		]);
		$crypt=new MyCrypt; 
		$signature=$crypt->encrypt("vodolei");
		$curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url.$data,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTPHEADER => array(
        "Cache-Control: no-cache",
        "Content-Type: application/json",
        "X-Signature: {$signature}"
		),
		));
		$response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
		sleep(20);
		//composer create-project --prefer-dist laravel/laravel recievertest "6.*"
		//php artisan make:controller testPaymentController
	}
}
