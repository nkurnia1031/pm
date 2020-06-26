<?php

namespace App\Http\Controllers;

use App\Exports\Export;
use App\Http\Controllers\Controller;
use App\Imports\Import;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class crud extends Controller
{

    public function upload(Request $Request)
    {
        $data = new Import;
        Excel::import($data, $Request->file('file'));
        $date = new Date;
        $link = url()->previous();
        $input = $data->data->splice(1)->toArray();
        $key = $data->data[0]->toArray();
        //  $key = ['kdkriteria', 'atribut', 'bobot'];
        //  $key = ['nik', 'nama', 'level', 'posisi'];

        $insert = [];
        //$kriteria = DB::table('kriteria')->get();
        //array_pop($key);

        foreach ($input as $k) {
            //$k[6] = date_format($date::excelToDateTimeObject($k[6]), 'Y-m-d');
            // dd($k[0]);
            //array_pop($k);

            $x = array_combine($key, $k);
            // $x['akses'] = json_encode(array('Orang Tua'));
            /*
            $penilaian = array();
            foreach ($kriteria as $k) {
            $penilaian[$k->kdkriteria] = $x[$k->kdkriteria];
            }
            $x = ['nik' => $x['nik'], 'tahun' => $x['tahun'], 'penilaian' => json_encode($penilaian)];
             */
            array_push($insert, $x);

        }
        dd(json_encode($insert));
        $cek = DB::table('data_training')->insert($insert);

        if ($cek) {
            echo "<script>alert('Berhasil')</script>";
            echo "<script>location.href='$link'</script>";
        }
    }
    public function export(Request $Request)
    {
        $c = new Export;

        if ($Request->table == "transaksi") {
            $c->data = DB::table($Request->table)->join('detail', 'detail.kdtran', '=', 'transaksi.kdtran')->selectRaw('detail.kdtran,DATE_FORMAT(transaksi.tgl, "%d/%m/%Y") as tgl,detail.kditem')->take(1)->get();

        } else {
            $c->data = DB::table($Request->table)->take(1)->get();

        }
        $c->head = collect($c->data->first())->keys()->toArray();

        return Excel::download($c, $Request->table . ".xlsx");
    }
    public function create(Request $Request)
    {
        $table = $Request->table;
        $tb = $Request->tb;
        $input = $Request->input;
        $link = url()->previous();
        if ($table == 'barang') {
            $input[0] = str_replace(" ", "", $input[0]);
            $cek = DB::table($table)->where($tb[0], $input[0])->get()->count();
            if ($cek > 0) {
                echo "<script>alert('Primary Key sudah di gunakan')</script>";
                echo "<script>location.href='$link'</script>";
                exit();
            }
        }

        $bon = $Request->file('file');
        $bon2 = isset($bon);
        if ($bon2) {
            $file = Storage::disk('scan')->put("/", $bon);
            array_push($input, $file);
            array_push($tb, 'url');
        }
        if ($table == 'kuisoner') {
            DB::table('kuisoner')->where('thn', session()->get('thn'))->where('idguru', $Request->idguru)->delete();
            DB::table('kuisoner')->insert($Request->kuisoner);
            echo "<script>alert('Berhasil')</script>";
            echo "<script>location.href='$link'</script>";
            die();
        }

        $id = add($tb, $input, $table);

        echo "<script>alert('Data berhasil ditambahkan')</script>";
        echo "<script>location.href='$link'</script>";

    }

    public function delete(Request $Request)
    {

        $key = $Request->key;
        $primary = $Request->primary;
        $table = $Request->table;
        $link = url()->previous();

        if ($table == "harian") {
            DB::table('detail')->where($primary, $key)->delete();

        }
        hapus($table, $primary, $key);

        echo "<script>alert('Data telah berhasil di Hapus')</script>";
        echo "<script>location.href='$link'</script>";

    }

    public function update(Request $Request)
    {

        $tb = $Request->tb;
        $input = $Request->input;
        $table = $Request->table;
        $key = $Request->key;
        $primary = $Request->primary;

        $link = url()->previous();
        if (isset($Request->link)) {
            $link = $Request->link;
        }

        $bon = $Request->file('file');
        $bon2 = isset($bon);
        if ($bon2) {
            $file = Storage::disk('scan')->put("/", $bon);
            array_push($input, $file);
            if ($table == 'user') {
                array_push($tb, 'foto');

            } else {
                array_push($tb, 'url');

            }

        }
        if (isset($Request->factor)) {
            DB::table('faktor')->delete();
            DB::table('faktor')->insert($Request->factor);
            echo "<script>alert('Data telah berhasil di Edit')</script>";
            echo "<script>location.href='$link'</script>";
            die();
        }
        if (isset($Request->kompetensi)) {
            foreach ($Request->kompetensi as $k => $v) {
                DB::table('kompetensi')->where('idkompetensi', $k)->update(['kelompok' => $v]);
            }

            echo "<script>alert('Data telah berhasil di Edit')</script>";
            echo "<script>location.href='$link'</script>";
            die();
        }

        edit($tb, $input, $key, $primary, $table);

        echo "<script>alert('Data telah berhasil di Edit')</script>";
        echo "<script>location.href='$link'</script>";

    }
    public function up(Request $Request)
    {

        $file = $Request->filex;
        Storage::disk('scan')->delete($file);
        $bon = $Request->file('file');

        $file = Storage::disk('scan')->put("/", $bon);
        $tb = $Request->tb;
        $input = [$file];
        $table = $Request->table;
        $key = $Request->key;
        $primary = $Request->primary;
        $link = url()->previous();

        edit($tb, $input, $key, $primary, $table);
        echo "<script>alert('Data Primary Key $key telah berhasil di Edit')</script>";
        echo "<script>location.href='$link'</script>";

    }

}
function add($tb, $input, $table)
{
    $tes = collect($tb);
    $ar = $tes->combine($input)->toArray();
    return DB::table($table)->insertGetId($ar);
}
function edit($tb, $input, $key, $primary, $table)
{
    $tes = collect($tb);
    $ar = $tes->combine($input)->toArray();
    DB::table($table)->where($primary, $key)->update($ar);

}
function hapus($table, $primary, $key)
{
    DB::table($table)->where($primary, $key)->delete();
}
