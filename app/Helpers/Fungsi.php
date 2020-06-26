<?php

namespace App\Helpers;

/**
 *
 */
use Illuminate\Support\Facades\DB;

class Fungsi
{
    static $type = [
        'varchar' => 'text',
        'text' => 'text',
        'json' => 'text',
        'longtext' => 'text',
        'int' => 'number',
        'decimal' => 'number',
        'tinyint' => 'number',
        'date' => 'date',
        'time' => 'time',
        'year' => 'year',
        'enum' => 'text',
    ];
    static $tindakan = [
        ['min' => 1, 'max' => 16, 'aksi' => 'Pembinaan kepada siswa secara lisan'],
        ['min' => 16, 'max' => 26, 'aksi' => 'Pembinaan kepada siswa secara tertulis dengan membuat perjanjian'],
        ['min' => 26, 'max' => 41, 'aksi' => 'Panggilan Orang Tua, Surat Peringatan I'],
        ['min' => 41, 'max' => 61, 'aksi' => 'Panggilan Orang Tua, Surat Peringatan II'],
        ['min' => 61, 'max' => 76, 'aksi' => 'Panggilan Orang Tua untuk menandatangani surat Skorsing selama 6 (enam) Hari, Peringatan III'],
        ['min' => 76, 'max' => 101, 'aksi' => 'Panggilan Orang Tua , Siswa dikembalikan kepada Orang Tua'],
    ]
    ;

    static $hari = [
        1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu',

    ];
    static $bulan = array(
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    static $jurusan = array(
        'AKUNTANSI',
        'TEKNIK PENGOLAHANMIGAS DAN  PETROKIMIA',
        'TEKNIK KENDARAAN RINGAN',
        'KIMIA ANALISIS',
        'KIMIA INDUSTRI',
        'MULTIMEDIA',
        'TEKNIK OTOMASI INDUSTRI',
    );
    static $akses = array(
        'Kurikulum',
        'Pengajar',
        'BK',
        'Wali Kelas',

    );

    public static function table($tb)
    {

        return DB::table($tb)->get();
    }
    public static function getFields($tb, $db)
    {
        $hasil = [];
        $tes = collect(DB::select("SELECT * FROM information_schema.columns where TABLE_NAME='$tb' and table_schema='$db'  "));

        foreach ($tes as $k) {
            $x = [];
            $x['name'] = $k->COLUMN_NAME;
            $x['label'] = $k->COLUMN_COMMENT;
            $x['type'] = self::$type[$k->DATA_TYPE];
            $x['max'] = $k->CHARACTER_MAXIMUM_LENGTH;

            $x['pnj'] = 12;
            $x['val'] = null;
            $x['red'] = "";
            $x['input'] = true;
            $x['up'] = true;
            $x['tb'] = true;

            array_push($hasil, $x);
        }
        return $hasil;
    }
    public static function buatInput($isi, $var = "input[]", $tb = "tb[]")
    {
        $val = null;
        $red = null;

        if ($isi['input']) {
            $name = $isi['name'];
            $type = $isi['type'];
            $label = $isi['label'];
            $pnj = $isi['pnj'];
            $val = $isi['val'];
            $red = $isi['red'];
            $max = $isi['max'];
            if ($type == "textarea") {
                return ' <div class="form-grup col-' . $pnj . ' mb-2 input-group-sm">
                                <label class="form-control-label">' . $label . '</label>
                                <textarea maxlength="' . $max . '"  ' . $red . ' autocomplete=off   name="' . $var . '" class="form-control">' . $val . '</textarea>
                                <input type="hidden" name="' . $tb . '" value="' . $name . '">
                            </div>';
            } elseif ($type == "textarea2") {
                return ' <div class="form-grup col-' . $pnj . ' mb-2 input-group-sm">
                                <label class="form-control-label">' . $label . '</label>
                                <textarea  maxlength="' . $max . '" ' . $red . ' autocomplete=off   name="' . $var . '" class="form-control summernote">' . $val . '</textarea>
                                <input type="hidden" name="' . $tb . '" value="' . $name . '">
                            </div>';

            } else {
                return ' <div class="form-grup col-' . $pnj . ' mb-2 input-group-sm">
                                <label class="form-control-label">' . $label . '</label>
                                <input  maxlength="' . $max . '" autocomplete=off type="' . $type . '"  ' . $red . '  step="any" min="0"  value="' . $val . '" name="' . $var . '" class="form-control">
                                <input type="hidden" name="' . $tb . '" value="' . $name . '">
                            </div>';
            }
        } else {
            return null;
        }
    }
    public static function buatInpute($isi)
    {
        $red = null;

        if ($isi['up']) {
            $name = $isi['name'];
            $type = $isi['type'];
            $label = $isi['label'];
            $pnj = $isi['pnj'];
            $red = $isi['red'];
            $max = $isi['max'];

            if ($type == "textarea") {
                return ' <div class="form-grup col-' . $pnj . ' mb-3 input-group-sm">
                                <label class="form-control-label">' . $label . '</label>
                                <textarea  maxlength="' . $max . '" autocomplete=off ' . $red . '   v-html="all[kd].' . $name . '"   name="input[]" class="form-control"></textarea>

                                <input type="hidden" name="tb[]" value="' . $name . '">
                            </div>';
            } elseif ($type == "textarea2") {
                return ' <div class="form-grup col-' . $pnj . ' mb-3 input-group-sm">
                                <label class="form-control-label">' . $label . '</label>
                                <textarea  maxlength="' . $max . '" autocomplete=off ' . $red . '   v-html="all[kd].' . $name . '"   name="input[]" class="form-control summernote"></textarea>

                                <input type="hidden" name="tb[]" value="' . $name . '">
                            </div>';
            } else {
                return ' <div class="form-grup col-' . $pnj . ' mb-3 input-group-sm">
                                <label class="form-control-label">' . $label . '</label>
                                <input maxlength="' . $max . '" autocomplete=off type="' . $type . '" ' . $red . '  step="any" :value="all[kd].' . $name . '" min="0" name="input[]" class="form-control">
                                <input type="hidden" name="tb[]" value="' . $name . '">
                            </div>';
            }
        } else {
            return null;
        }
    }

}
