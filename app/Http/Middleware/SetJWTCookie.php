<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Middleware\Middleware;
use Firebase\JWT\{Key, JWT, ExpiredException};
use App\Models\CmsMultiversityUser;


class SetJWTCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        if (!$request->hasCookie('cookie_cms_multiversity')) {
            // redirect login
            return redirect()->route('login')->with('renewCookie', 'Effettua nuovamente l\'accesso per continuare');
        }

        // validità token
        $cookie = $request->cookie('cookie_cms_multiversity');
        $key = 'davidecesarano';
        try {
            $decoded = JWT::decode($cookie, new Key($key, 'HS256'));
        } catch (ExpiredException $e) {
            // cancellare cookie guarda doc laravel
            setcookie('cookie_cms_multiversity', null, -1, '/');
            
            // redirect login
            return redirect()->route('login')->with('renewCookie', 'Effettua nuovamente l\'accesso per continuare');
        }

        // esistenza utente
        $user = CmsMultiversityUser::where('email', $decoded->name)->get();
        if (!$user) {
            return redirect()->route('login')->with('renewCookie', 'Utente non trovato');
        }
            
        $response = $next($request);
        return $response;
    }
}
