<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class form extends Controller
{

    public function tb($tb)
    {
        return json_encode(Fungsi::getFields($tb, DB::connection()->getDatabaseName()));
    }

    public function Dashboard(Request $Request)
    {

        $data['judul'] = "Home";
        $data['icon'] = "mdi mdi-home";
        $blade = "Dashboard";
        $data['link'] = "Home";
        $data['induk'] = "Dashboard";
        $data['hasil'] = DB::table('hasil')->get()->map(function ($item, $key) use ($data) {
            $item->hasiljson = json_decode($item->hasiljson);
            return $item;
        });
        if (session()->has('thn')):
            if ($data['hasil']->where('thn', session()->get('thn'))->isNotEmpty()) {

                $data['grf']['all'] = collect($data['hasil']->where('thn', session()->get('thn'))->first()->hasiljson)->sortByDesc('nt');
                $data['grf']['guru'] = $data['grf']['all']->pluck('nama')->map(function ($item, $key) use ($data) {
                    return '"' . $item . '"';
                })->implode(',');
                $data['grf']['nilai'] = $data['grf']['all']->pluck('nt')->implode(',');
            }

        endif;
        return view("isi.$blade", [
            'Request' => $Request,
            'data' => $data,
        ]);

    }
    public function Master(Request $Request, $hal)
    {
        $link = url()->previous();

        $Request->hal = $hal;

        $menu = [
            'Guru' => ['judul' => 'Data Guru', 'blade' => 'Guru', 'icon' => "fa fa-users"],
            'Profil' => ['judul' => 'Profil User', 'blade' => 'Profil', 'icon' => "fa fa-users"],
            'Kuisoner' => ['judul' => 'Data Hasil Kuisoner', 'blade' => 'Kuisoner', 'icon' => "fa fa-users"],
            'Tahap1' => ['judul' => 'Menentukan aspek penilaian dan bobot nilai standar kompetensi', 'blade' => 'Tahap1', 'icon' => "fa fa-users"],
            'Tahap2' => ['judul' => 'Mengitung GAP', 'blade' => 'Tahap2', 'icon' => "fa fa-users"],
            'Tahap3' => ['judul' => 'Pemetaan & Konversi Nilai GAP', 'blade' => 'Tahap3', 'icon' => "fa fa-users"],
            'Tahap4' => ['judul' => 'Pengelompokkan Core Factor (CF) dan Secondary Factor (SF)', 'blade' => 'Tahap4', 'icon' => "fa fa-users"],
            'Tahap5' => ['judul' => 'Menghitung Nilai Total (NT)', 'blade' => 'Tahap5', 'icon' => "fa fa-users"],
            'Laporan' => ['judul' => 'Laporan Tahunan', 'blade' => 'Tahun', 'icon' => "fa fa-users"],

            'Upload' => ['judul' => 'Upload', 'blade' => 'Upload', 'icon' => "fa fa-boxes"],
            'Set' => ['judul' => 'Set', 'blade' => 'Upload', 'icon' => "fa fa-boxes"],

        ];
        $data['judul'] = $menu[$hal]['judul'];
        $data['link'] = $hal;
        $data['icon'] = $menu[$hal]['icon'];
        $data['induk'] = "Master";
        $blade = $menu[$hal]['blade'];
        if ($hal == 'Laporan') {
            $data['induk'] = "Laporan";
            $hal = 'Tahap5';

        }

        switch ($hal) {
            case 'Upload':

                break;
            case 'Set':
                session()->put('thn', $Request->thn);
                echo "<script>location.href='$link'</script>";
                break;
            case 'Profil':
                //  dd($this->tb('user'));

                $fields1 = '[
                {"name":"user","label":"Username","type":"text","max":10,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"pass","label":"Password","type":"password","max":10,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":false},
                {"name":"nama","label":"Nama","type":"text","max":30,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"foto","label":"Foto","type":"text","max":30,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true}

                ]';
                $data['user.form'] = json_decode($fields1, true);
                $data['user'] = session()->get('admin');
/*
$curl = curl_init();

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, "https://gist.githubusercontent.com/nasrulhazim/54b659e43b1035215cd0ba1d4577ee80/raw/e3c6895ce42069f0ee7e991229064f167fe8ccdc/quotes.json");
$result = curl_exec($curl);
 */
                $result = file_get_contents("mine/quotes.json");

                $data['quote'] = collect(json_decode($result)->quotes)->random();

                break;

            case 'Guru':
                //dd($this->tb('guru'));

                $fields1 = '[
                {"name":"nip","label":"NIP","type":"text","max":15,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"nama","label":"Nama","type":"text","max":25,"pnj":12,"val":null,"red":"required","input":true,"up":true,"tb":true},
                {"name":"alamat","label":"Alamat","type":"textarea","max":100,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"ttl","label":"Tempat, Tanggal Lahir","type":"text","max":40,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"agama","label":"Agama","type":"text","max":15,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"jk","label":"Jenis Kelamin","type":"text","max":10,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true}

                ]';
                $data['guru.form'] = json_decode($fields1, true);
                $fields1 = '[

                {"name":"jabatan","label":"Jabatan","type":"text","max":50,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"tgl_awal","label":"Tanggal Awal Mengajar","type":"date","max":null,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"nosk","label":"No SK Mengajar","type":"text","max":25,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true}

                ]';
                $data['guru.form1'] = json_decode($fields1, true);

                $data['guru'] = DB::table('guru')->get();

                break;
            case 'Kuisoner':
                //dd($this->tb('guru'));

                $fields1 = '[
                {"name":"nip","label":"NIP","type":"text","max":15,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"nama","label":"Nama","type":"text","max":25,"pnj":12,"val":null,"red":"required","input":true,"up":true,"tb":true},
                {"name":"alamat","label":"Alamat","type":"textarea","max":100,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"ttl","label":"Tempat, Tanggal Lahir","type":"text","max":40,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"agama","label":"Agama","type":"text","max":15,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"jk","label":"Jenis Kelamin","type":"text","max":10,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true}

                ]';
                $data['guru.form'] = json_decode($fields1, true);
                $fields1 = '[

                {"name":"jabatan","label":"Jabatan","type":"text","max":50,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"tgl_awal","label":"Tanggal Awal Mengajar","type":"date","max":null,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true},
                {"name":"nosk","label":"No SK Mengajar","type":"text","max":25,"pnj":12,"val":null,"red":"","input":true,"up":true,"tb":true}

                ]';
                $data['guru.form1'] = json_decode($fields1, true);
                $data['kuisoner'] = DB::table('kuisoner')->where('thn', session()->get('thn'))->get();

                $data['guru'] = DB::table('guru')->get()->map(function ($item, $key) use ($data) {
                    $item->kuisoner = $data['kuisoner']->where('idguru', $item->idguru);
                    $item->kuisoner2 = ['idguru' => $item->idguru];
                    return $item;
                });

                $data['kompetensi'] = DB::table('kompetensi')->get();

                $data['bobot'] = DB::table('bobot')->get();

                break;
            case 'Tahap1':
                //dd($this->tb('guru'));

                $data['kompetensi'] = DB::table('kompetensi')->get();
                $data['bobot'] = DB::table('bobot')->get();

                break;
            case 'Tahap2':
                $data['kuisoner'] = DB::table('kuisoner')->where('thn', session()->get('thn'))->get();

                $data['guru'] = DB::table('guru')->get()->map(function ($item, $key) use ($data) {
                    $item->kuisoner = $data['kuisoner']->where('idguru', $item->idguru);
                    $item->kuisoner2 = ['idguru' => $item->idguru];
                    return $item;
                });

                $data['kompetensi'] = DB::table('kompetensi')->get();
                $data['bobot'] = DB::table('bobot')->get();

                break;
            case 'Tahap3':
                $data['kuisoner'] = DB::table('kuisoner')->where('thn', session()->get('thn'))->get();

                $data['guru'] = DB::table('guru')->get()->map(function ($item, $key) use ($data) {
                    $item->kuisoner = $data['kuisoner']->where('idguru', $item->idguru);
                    $item->kuisoner2 = ['idguru' => $item->idguru];
                    return $item;
                });

                $data['kompetensi'] = DB::table('kompetensi')->get();
                $data['bobot'] = DB::table('bobot')->get();
                $data['gap'] = DB::table('gap')->get();

                break;
            case 'Tahap4':
                $data['kuisoner'] = DB::table('kuisoner')->where('thn', session()->get('thn'))->get();
                $data['kompetensi'] = DB::table('kompetensi')->get();
                $data['bobot'] = DB::table('bobot')->get();
                $data['gap'] = DB::table('gap')->get();
                $data['faktor'] = DB::table('faktor')->get();
                $data['guru'] = DB::table('guru')->get()->map(function ($item, $key) use ($data) {
                    $item->kuisoner = $data['kuisoner']->where('idguru', $item->idguru);
                    $item->kuisoner2 = ['idguru' => $item->idguru];
                    $item->ncf = 0;
                    $item->nsf = 0;
                    if ($data['kompetensi']->where('kelompok', 'Core')->isNotEmpty()):
                        $b = 0;
                        foreach ($data['kompetensi']->where('kelompok', 'Core') as $v1 => $e1):
                            $h = $e1->kompetensi;

                            $item->$h = $data['gap']->where('gap', $item->kuisoner->where('idkompetensi', $e1->idkompetensi)->sum('nilai') - $e1->nilai)->sum('bobot');
                            $b += $item->$h;

                        endforeach;
                        $item->ncf = $b / $data['kompetensi']->where('kelompok', 'Core')->count();
                    endif;
                    if ($data['kompetensi']->where('kelompok', 'Secondary')->isNotEmpty()):
                        $b = 0;
                        foreach ($data['kompetensi']->where('kelompok', 'Secondary') as $v1 => $e1):
                            $h = $e1->kompetensi;

                            $item->$h = $data['gap']->where('gap', $item->kuisoner->where('idkompetensi', $e1->idkompetensi)->sum('nilai') - $e1->nilai)->sum('bobot');
                            $b += $item->$h;

                        endforeach;
                        $item->nsf = $b / $data['kompetensi']->where('kelompok', 'Secondary')->count();
                    endif;
                    $item->nt = (($data['faktor'][0]->persen / 100) * $item->ncf) + (($data['faktor'][1]->persen / 100) * $item->nsf);

                    return $item;
                });
                DB::table('hasil')->where('thn', session()->get('thn'))->delete();
                DB::table('hasil')->insert([
                    'thn' => session()->get('thn'),
                    'hasiljson' => $data['guru']->toJson(),

                ]);

                break;
            case 'Tahap5':
                $data['kuisoner'] = DB::table('kuisoner')->where('thn', session()->get('thn'))->get();
                $data['kompetensi'] = DB::table('kompetensi')->get();
                $data['bobot'] = DB::table('bobot')->get();
                $data['gap'] = DB::table('gap')->get();
                $data['faktor'] = DB::table('faktor')->get();
                $data['guru'] = DB::table('guru')->get()->map(function ($item, $key) use ($data) {
                    $item->kuisoner = $data['kuisoner']->where('idguru', $item->idguru);
                    $item->kuisoner2 = ['idguru' => $item->idguru];
                    $item->ncf = 0;
                    $item->nsf = 0;
                    if ($data['kompetensi']->where('kelompok', 'Core')->isNotEmpty()):
                        $b = 0;
                        foreach ($data['kompetensi']->where('kelompok', 'Core') as $v1 => $e1):
                            $h = $e1->kompetensi;

                            $item->$h = $data['gap']->where('gap', $item->kuisoner->where('idkompetensi', $e1->idkompetensi)->sum('nilai') - $e1->nilai)->sum('bobot');
                            $b += $item->$h;

                        endforeach;
                        $item->ncf = $b / $data['kompetensi']->where('kelompok', 'Core')->count();
                    endif;
                    if ($data['kompetensi']->where('kelompok', 'Secondary')->isNotEmpty()):
                        $b = 0;
                        foreach ($data['kompetensi']->where('kelompok', 'Secondary') as $v1 => $e1):
                            $h = $e1->kompetensi;

                            $item->$h = $data['gap']->where('gap', $item->kuisoner->where('idkompetensi', $e1->idkompetensi)->sum('nilai') - $e1->nilai)->sum('bobot');
                            $b += $item->$h;

                        endforeach;
                        $item->nsf = $b / $data['kompetensi']->where('kelompok', 'Secondary')->count();
                    endif;
                    $item->nt = (($data['faktor'][0]->persen / 100) * $item->ncf) + (($data['faktor'][1]->persen / 100) * $item->nsf);

                    return $item;
                });
                if ($data['link'] == 'Tahap5') {
                    DB::table('hasil')->where('thn', session()->get('thn'))->delete();
                    DB::table('hasil')->insert([
                        'thn' => session()->get('thn'),
                        'hasiljson' => $data['guru']->toJson(),

                    ]);
                }

                break;

        }

        return view("isi.$data[induk].$blade", [
            'Request' => $Request,
            'data' => $data,
        ]);

    }

}
