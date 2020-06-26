<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class admincek
{
    /**
     * Handle an incoming request.
     *
     * @param
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->get('user') == null) {
            echo "<script>alert('Anda belum login, Silahkan Login')</script>";

            echo "<script>location.href='login'</script>";
            die();
        }
        $admin = DB::table('user')->where('user', session()->get('user'))->where('pass', session()->get('pass'))->get();

        if (count($admin) == 1) {
            session()->put('admin', $admin->first());

            return $next($request);
        } else {
            echo "<script>alert('Username Atau Password Salah, Silahkan Login Ulang')</script>";

            echo "<script>location.href='login'</script>";
            die();
        }

    }
}
