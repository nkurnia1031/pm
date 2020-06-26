@extends('layout.index') @section('js')
<script type="text/javascript">
$(document).ready(function() {



    //app.getall();




});

</script>
<script type="text/javascript">
var app = new Vue({
    el: '.appx',
    data: {
        kd: null,

    },
    methods: {
        uang(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },



    },
    updated: function() {

    },
    mounted: function() {

    }

});

</script>
@endsection
@section('modal')
<div class="modal fade " id="modal-input" tabindex="-1" role="dialog">
    <div class="modal-dialog mb-5  ">
        <form action="create" method="post" enctype="multipart/form-data">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                {{ csrf_field() }}
                <div class="modal-body  bg-1">
                    <div class="card card-body ">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="row">
                                    @foreach ($data['guru.form'] as $e)
                                    @if ($e['name']=='jk')
                                    <div class="form-grup col-12 mb-2 input-group-sm">
                                        <label class="form-control-label text-dark">{{$e['label']}}</label>
                                        <select class="form-control" name="input[]">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        <input type="hidden" name="tb[]" value="{{$e['name']}}">
                                    </div>
                                    @elseif($e['name']=='agama')
                                    <div class="form-grup col-12 mb-2 input-group-sm">
                                        <label class="form-control-label text-dark">{{$e['label']}}</label>
                                        <select class="form-control" name="input[]">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                                        </select>
                                        <input type="hidden" name="tb[]" value="{{$e['name']}}">
                                    </div>
                                    @else
                                    <x-komponen :isi="$e" type="input" />
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="row">
                                    @foreach ($data['guru.form1'] as $e)
                                    <x-komponen :isi="$e" type="input" />
                                    @endforeach
                                    <div class="modal-footer col-12  py-1">
                                        <input type="hidden" name="table" value="guru">
                                        <button type="button" class="btn shadow-sm btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn shadow-sm btn-sm btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade " id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog mb-5  ">
        <form action="update" v-if="kd!=null" method="post" enctype="multipart/form-data">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" >Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                {{ csrf_field() }}
                <div class="modal-body  bg-2">
                    <div class="card card-body ">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                @foreach ($data['guru.form'] as $e)
                                @if ($e['name']=='jk')
                                <div class="form-grup col-12 mb-2 input-group-sm">
                                    <label class="form-control-label text-dark">{{$e['label']}}</label>
                                    <select :value='kd.{{$e['name']}}' name="input[]" class="form-control">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <input type="hidden" name="tb[]" value="{{$e['name']}}">
                                </div>
                                @elseif($e['name']=='agama')
                                    <div class="form-grup col-12 mb-2 input-group-sm">
                                        <label class="form-control-label text-dark">{{$e['label']}}</label>
                                        <select :value='kd.{{$e['name']}}' class="form-control" name="input[]">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                                        </select>
                                        <input type="hidden" name="tb[]" value="{{$e['name']}}">
                                    </div>
                                    @else
                                <x-komponen :isi="$e" type="edit" />
                                @endif
                                @endforeach
                            </div>
                            <div class="col-lg-6 col-12">
                                @foreach ($data['guru.form1'] as $e)
                                <x-komponen :isi="$e" type="edit" />
                                @endforeach
                                <div class="modal-footer col-12  py-1">
                                    <input type="hidden" name="table" value="guru">
                                    <input type="hidden" name="primary" value="idguru">
                                    <input type="hidden" name="key" :value="kd.idguru">
                                    <button type="button" class="btn shadow-sm btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn shadow-sm btn-sm btn-info">Simpan</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('isi')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card" style="zoom:85%">
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Data Guru</h4>
                    <span>
                        <a href="#modal-input" data-toggle="modal" class="btn btn-primary btn-sm ">Tambah Guru</a>
                    </span>
                </div>
                <p class="card-category"></p>
            </div>
            <table style="zoom:90%" width="100%" class="table table-hover table-striped tb">
                <thead class=" ">
                    <th>
                        No
                    </th>
                    <x-komponen :isi="$data['guru.form']" type="th" />
                    <x-komponen :isi="$data['guru.form1']" type="th" />
                    <th class="text-right">
                        Opsi
                    </th>
                </thead>
                <tbody>
                    @foreach ($data['guru'] as $v=>$e)
                    <tr>
                        <td>{{$v+1}}</td>
                        @php
                        $isi=array('form'=>$data['guru.form'],'e'=>$e);
                        @endphp
                        <x-komponen :isi="$isi" type="td" />
                        @php
                        $isi=array('form'=>$data['guru.form1'],'e'=>$e);
                        @endphp
                        <x-komponen :isi="$isi" type="td" />
                        <td>
                            <div class="d-flex justify-content-end">
                                <span style="display: none" id="data-{{$e->idguru}}">{{json_encode($e)}}</span>
                                <a class="mr-1 text-info" onclick="app.kd=JSON.parse($('#data-{{$e->idguru}}').html())" data-toggle="modal" data-target="#modal-edit" href="javascript:void(0)">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="mr-1 text-danger" onclick="return confirm('Apakah anda yakin ingin hapus data ini?');" href="delete?table=guru&primary=idguru&key={{$e->idguru}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
