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
        <form action="create" v-if="kd!=null" method="post" enctype="multipart/form-data">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                {{ csrf_field() }}
                <div class="modal-body  bg-2">
                    <div class="card card-body ">
                        <div class="row">
                            @foreach ($data['kompetensi'] as $e)
                                <div class="form-grup col-12 mb-2 input-group-sm">
                                    <label class="form-control-label text-dark">{{$e->kompetensi}}</label>
                                    <select style="zoom:110%" class="form-control" name="kuisoner[{{$e->idkompetensi}}][nilai]" :value="kd[{{$e->idkompetensi}}]" >
                                        @foreach (  $data['bobot'] as $e1)
                                        <option  value="{{$e1->nilai}}">{{$e1->bobot}}[{{$e1->nilai}}]</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden"  name="kuisoner[{{$e->idkompetensi}}][idkompetensi]" value="{{$e->idkompetensi}}">
                                    <input type="hidden"  name="kuisoner[{{$e->idkompetensi}}][thn]" value="{{session()->get('thn')}}">
                                    <input type="hidden"  name="kuisoner[{{$e->idkompetensi}}][idguru]" :value="kd.idguru">
                                </div>
                            @endforeach

                                <div class="modal-footer col-12  py-1">

                                    <input type="hidden" name="idguru" :value="kd.idguru">

                                    <input type="hidden" name="table" value="kuisoner">
                                    <button type="button" class="btn shadow-sm btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn shadow-sm btn-sm btn-info">Simpan</button>
                                </div>
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
    @if (!session()->has('thn'))
    <div class="col-lg-12 col-12">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Peringatan</h4>
            <p>Silahkan set tahun terlebih dahulu</p>
        </div>
    </div>
    @else
    <div class="col-lg-12 col-12">
        <div class="card" style="zoom:85%">
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Data Hasil Kuisoner</h4>
                </div>
                <p class="card-category"></p>
            </div>
            <table style="zoom:90%" width="100%" class="table table-hover table-striped tb">
                <thead class=" ">
                    <th>
                        No
                    </th>
                    <th>Guru</th>
                    @foreach ($data['kompetensi'] as $v=>$e)
                    <th>{{$e->kompetensi}}</th>
                    @endforeach
                    <th class="text-right">
                        Opsi
                    </th>
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
                            @php
                            $e->kuisoner2[$e1->idkompetensi]=$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')
                            @endphp
                            {{$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')}}
                        </td>
                        @endforeach
                        <td>
                            <div class="d-flex justify-content-end">
                                <span style="display: none" id="data-{{$e->idguru}}">
                                    {{json_encode($e->kuisoner2)}}
                                </span>
                                <a class="mr-1 btn btn-sm btn-info" onclick="app.kd=JSON.parse($('#data-{{$e->idguru}}').html())" data-toggle="modal" data-target="#modal-edit" href="javascript:void(0)">
                                  Isi Hasil Kuisoner
                                </a>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
