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
        kd2: null,

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
<div class="modal fade " id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog mb-5  ">
        <form action="update" v-if="kd!=null" method="post" enctype="multipart/form-data">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                {{ csrf_field() }}
                <div class="modal-body py-1 bg-2">
                    <div class="card card-body ">
                        <table style="zoom:90%" width="100%" class="table table-hover table-striped ">
                            <thead class=" ">
                                <th>
                                    No
                                </th>
                                <th>
                                    Kompetensi
                                </th>
                                <th>
                                    Nilai Standar
                                </th>
                                <th class="text-right">
                                    Opsi
                                </th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="text" :value="kd.kompetensi" class="form-control" name="input[]">
                                        <input type="hidden" name="tb[]" value="kompetensi">
                                    </td>
                                    <td>
                                        <input type="number" :value="kd.nilai" class="form-control" name="input[]">
                                        <input type="hidden" name="tb[]" value="nilai">
                                    </td>
                                    <td>
                                        <input type="hidden" name="primary" value="idkompetensi">
                                        <input type="hidden" name="key" :value="kd.idkompetensi">
                                        <button type="submit" name="table" value="kompetensi" class="btn btn-sm btn-primary">Simpan</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade " id="modal-edit2" tabindex="-1" role="dialog">
    <div class="modal-dialog mb-5  ">
        <form action="update" v-if="kd2!=null" method="post" enctype="multipart/form-data">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                {{ csrf_field() }}
                <div class="modal-body py-1 bg-2">
                    <div class="card card-body ">
                        <table style="zoom:90%" width="100%" class="table table-hover table-striped ">
                            <thead class=" ">
                                <th>
                                    No
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th>
                                    Bobot Nilai
                                </th>
                                <th class="text-right">
                                    Opsi
                                </th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="text" :value="kd.bobot" class="form-control" name="input[]">
                                        <input type="hidden" name="tb[]" value="bobot">
                                    </td>
                                    <td>
                                        <input type="number" :value="kd.nilai" class="form-control" name="input[]">
                                        <input type="hidden" name="tb[]" value="nilai">
                                    </td>
                                    <td>
                                        <input type="hidden" name="primary" value="idbobot">
                                        <input type="hidden" name="key" :value="kd.idbobot">
                                        <button type="submit" name="table" value="kompetensi" class="btn btn-sm btn-primary">Simpan</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('isi')
<div class="row">
    <div class="col-lg-6 col-12">
        <div class="card" style="zoom:85%">
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Kompetensi</h4>
                </div>
                <p class="card-category"></p>
            </div>
            <form action="create" method="post">
                {{ csrf_field() }}
                <table style="zoom:90%" width="100%" class="table table-hover table-striped tb">
                    <thead class=" ">
                        <th>
                            No
                        </th>
                        <th>
                            Kompetensi
                        </th>
                        <th>
                            Nilai Standar
                        </th>
                        <th class="text-right">
                            Opsi
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($data['kompetensi'] as $v=>$e)
                        <tr>
                            <td>{{$v+1}}</td>
                            <td>{{$e->kompetensi}}</td>
                            <td>{{$e->nilai}}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <span style="display: none" id="data-{{$e->idkompetensi}}">{{json_encode($e)}}</span>
                                    <a class="mr-1 text-info" onclick="app.kd=JSON.parse($('#data-{{$e->idkompetensi}}').html())" data-toggle="modal" data-target="#modal-edit" href="javascript:void(0)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="mr-1 text-danger" onclick="return confirm('Apakah anda yakin ingin hapus data ini?');" href="delete?table=kompetensi&primary=idkompetensi&key={{$e->idkompetensi}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" class="form-control" name="input[]">
                                <input type="hidden" name="tb[]" value="kompetensi">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="input[]">
                                <input type="hidden" name="tb[]" value="nilai">
                            </td>
                            <td>
                                <button type="submit" name="table" value="kompetensi" class="btn btn-sm btn-primary">Tambah</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="card" style="zoom:85%">
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Kategori Penilaian</h4>
                </div>
                <p class="card-category"></p>
            </div>
            <form action="create" method="post">
                {{ csrf_field() }}
                <table style="zoom:90%" width="100%" class="table table-hover table-striped tb">
                    <thead class=" ">
                        <th>
                            No
                        </th>
                        <th>
                            Ketegori
                        </th>
                        <th>
                            Bobot Nilai
                        </th>
                        <th class="text-right">
                            Opsi
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($data['bobot'] as $v=>$e)
                        <tr>
                            <td>{{$v+1}}</td>
                            <td>{{$e->bobot}}</td>
                            <td>{{$e->nilai}}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <span style="display: none" id="data-{{$e->idbobot}}">{{json_encode($e)}}</span>
                                    <a class="mr-1 text-info" onclick="app.kd2=JSON.parse($('#data-{{$e->idbobot}}').html())" data-toggle="modal" data-target="#modal-edit2" href="javascript:void(0)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="mr-1 text-danger" onclick="return confirm('Apakah anda yakin ingin hapus data ini?');" href="delete?table=bobot&primary=idbobot&key={{$e->idbobot}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" class="form-control" name="input[]">
                                <input type="hidden" name="tb[]" value="bobot">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="input[]">
                                <input type="hidden" name="tb[]" value="nilai">
                            </td>
                            <td>
                                <button type="submit" name="table" value="bobot" class="btn btn-sm btn-primary">Tambah</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection
