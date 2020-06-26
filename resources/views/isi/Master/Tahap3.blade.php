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
                                    GAP
                                </th>
                                <th>
                                    Bobot Nilai
                                </th>
                                <th>
                                    Keterangan
                                </th>
                                <th class="text-right">
                                    Opsi
                                </th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <input type="number" autocomplete="off" :value="kd.gap" class="form-control" name="input[]">
                                        <input type="hidden" name="tb[]" value="gap">
                                    </td>
                                    <td>
                                        <input type="number" autocomplete="off" :value="kd.bobot" class="form-control" name="input[]">
                                        <input type="hidden" name="tb[]" value="bobot">
                                    </td>
                                     <td>
                                        <input type="text" autocomplete="off" :value="kd.ket" class="form-control" name="input[]">
                                        <input type="hidden" name="tb[]" value="ket">
                                    </td>
                                    <td>
                                        <input type="hidden" name="primary" value="idgap">
                                        <input type="hidden" name="key" :value="kd.idgap">
                                        <button type="submit" name="table" value="gap" class="btn btn-sm btn-primary">Simpan</button>
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
    @if (!session()->has('thn'))
    <div class="col-lg-12 col-12">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Peringatan</h4>
            <p>Silahkan set tahun terlebih dahulu</p>
        </div>
    </div>
    @else
    <div class="col-lg-4 mb-2 col-12">
        <div class="card" style="zoom:85%">
             <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Pemetaan GAP</h4>
                </div>
            </div>
            <form action="create" method="post">
                {{ csrf_field() }}
                <table style="zoom:90%" width="100%" class="table table-hover table-striped ">
                    <thead class=" ">
                        <th>
                            No
                        </th>
                        <th>
                            GAP
                        </th>
                        <th>
                            Bobot Nilai
                        </th>
                        <th>
                            Keterangan
                        </th>
                        <th class="text-right">
                            Opsi
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($data['gap'] as $v=>$e)
                        <tr>
                            <td>{{$v+1}}</td>
                            <td>{{$e->gap}}</td>
                            <td>{{$e->bobot}}</td>
                            <td>{{$e->ket}}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <span style="display: none" id="data-{{$e->idgap}}">{{json_encode($e)}}</span>
                                    <a class="mr-1 text-info" onclick="app.kd=JSON.parse($('#data-{{$e->idgap}}').html())" data-toggle="modal" data-target="#modal-edit" href="javascript:void(0)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="mr-1 text-danger" onclick="return confirm('Apakah anda yakin ingin hapus data ini?');" href="delete?table=gap&primary=idgap&key={{$e->idgap}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="2">
                                <input type="number" autocomplete="off" class="form-control" name="input[]">
                                <input type="hidden" name="tb[]" value="gap">
                            </td>
                            <td>
                                <input type="number" autocomplete="off" step="any" class="form-control" name="input[]">
                                <input type="hidden" name="tb[]" value="bobot">
                            </td>
                            <td>
                                <input type="text" autocomplete="off" class="form-control" name="input[]">
                                <input type="hidden" name="tb[]" value="ket">
                            </td>
                            <td>
                                <button type="submit" name="table" value="gap" class="btn btn-sm btn-primary">Tambah</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <div class="col-lg-8 col-12">
        <div class="card" style="zoom:85%">
             <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Konversi GAP</h4>
                </div>
            </div>
            <table style="zoom:90%" width="100%" class="table table-hover table-striped ">
                <thead class=" ">
                    <th>
                        No
                    </th>
                    <th>Guru</th>
                    @foreach ($data['kompetensi'] as $v=>$e)
                    <th>{{$e->kompetensi}}</th>
                    @endforeach
                </thead>
                <tbody>
                    @foreach ($data['guru'] as $v=>$e)
                    <tr>
                        <td>{{$v+1}}</td>
                        <td>
                            {{$e->nama}}
                            <div class="text-muted">NIP.{{$e->nip}}</div>
                        </td>
                        @foreach ($data['kompetensi'] as $v=>$e1)
                        <td>

                            {{$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')-$e1->nilai}}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                     <tr class="table-primary">
                        <td class="text-center" colspan="{{2+$data['kompetensi']->count()}}">Konversi Bobot</td>

                    </tr>
                    @foreach ($data['guru'] as $v=>$e)
                    <tr>
                        <td>{{$v+1}}</td>
                        <td>
                            {{$e->nama}}
                            <div class="text-muted">NIP.{{$e->nip}}</div>
                        </td>
                        @foreach ($data['kompetensi'] as $v=>$e1)
                        <td>

                            {{$data['gap']->where('gap',$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')-$e1->nilai)->sum('bobot')}}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
