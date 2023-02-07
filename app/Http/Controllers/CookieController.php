<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \DateTime;
use Carbon\Carbon;

class CookieController extends Controller {
   public function setCookie(Request $request) {
      $date = Carbon::now();
      $daysToAdd = 30;
      $expirationDate = $date->addMonth();

      $newDate = $expirationDate->getTimestamp();
      /* return $newDate; */
      
      $response = new Response('Hello World');
      $response->withCookie(cookie('name', 'prova', $newDate));
      return $response;
   }


   public function getCookie(Request $request) {
      $value = $request->cookie('name');
      echo $value;
   }
}