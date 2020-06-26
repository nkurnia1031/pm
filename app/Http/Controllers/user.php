<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class user extends Controller
{

    public function login(Request $Request)
    {
        session()->put('user', null);
        session()->put('pass', null);
        $data['judul'] = "Halaman Login";
        return view('layout/login', [
            'data' => $data,

        ]);
    }
    public function layout(Request $Request)
    {

        $data['link'] = "Dashboard";
        $data['judul'] = "judul";
        $data['icon'] = "";

        return view('layout/index', [
            'data' => $data,

        ]);
    }

    public function loginp(Request $Request)
    {
        $user = $Request->user;
        $pass = $Request->pass;

        session()->put('user', $user);
        session()->put('pass', $pass);
        session()->put('ta', $Request->ta);

        return redirect('cek');
    }
    public function LoginM(Request $Request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Max-Age: 1000');
        if (isset($Request->input)) {
            $data['input'] = json_decode($Request->input);
            if (!isset($data['input']->pass)) {
                $data['input']->pass = null;
            }
            if (!isset($data['input']->user)) {
                $data['input']->user = null;
            }
        }

        $cek = DB::table('user')->where('user', $data['input']->user)->where('pass', $data['input']->pass)->get();
        if ($cek->count() === 1) {
            $data['token'] = Str::random(25);
            session()->put('user', $data['input']->user);
            session()->put('pass', $data['input']->pass);
            DB::table('user')->where('user', $data['input']->user)->update(['token' => $data['token']]);
            $hasil = ['token' => $data['token'], 'error' => null];

        } else {
            $hasil = ['error' => 'Username atau Password tidak cocok, silahkan cek kembali', 'token' => null];

        }
        echo $_GET['callback'] . '(' . json_encode($hasil) . ')';
        die();
    }

}
