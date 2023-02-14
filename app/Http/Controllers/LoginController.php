<?php 

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\CmsMultiversityUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator, Hash};
use Illuminate\Http\Response;
use App\Http\Controllers\CookieController;
use Illuminate\Support\Facades\Cookie;
use \DateTime;
use Firebase\JWT\{Key, JWT, ExpiredException};


class LoginController extends Controller
{
    public function login(){
        return view('pages.login')->with('message', false);
    }

    public function checkPassword(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return view('pages.login')->with('message', 'Errore validazione');
        }

        $user = CmsMultiversityUser::where('email', $request->email)->first();
        if(!$user){
            return view('pages.login')->with('message', 'Utente non trovato');
        }


        $password = $user->password;


        if ($user && Hash::check($request->password, $user->password)){

            
            /* GENERAZIONE DEL TOKEN CON https://github.com/firebase/php-jwt */
            $today = date('Y-m-d');
            $datetime = DateTime::createFromformat('Y-m-d', $today);
            $datetime->modify('+1 month');
            $expiration = $datetime->gettimestamp();
            $secret_key = 'davidecesarano';
            
            $payload = [ 
                "iss"  => 'Multiversity',
                "name" => $request['email'],
                "iat"  => time(),
                'exp'  => $expiration
            ];

            $jwt = JWT::encode($payload, $secret_key, 'HS256');

            /* GENERAZIONE DEL COOKIE */
            $date = (new DateTime(date('Y-m-d H:i:s')))->modify('+1 month');
            $expiration = $date->format('D, d M Y H:i:s').' GMT';
            $cookie_name = "cookie_cms_multiversity";
            $cookie_value = $jwt;
            $cookie_exp = $expiration;
            $cookie_path = '/';     
            $response = redirect()->route('user-index');

            $cookie = cookie($cookie_name, $cookie_value, strtotime($cookie_exp), $cookie_path);
            $response->withCookie($cookie);

            return $response;
        } else {
            return 'Credenziali errate';
        }
        
    }
}