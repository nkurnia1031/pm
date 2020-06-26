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
                            @php
                            $e->kuisoner2[$e1->idkompetensi]=$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')
                            @endphp
                            {{$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')}}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    <tr class="table-primary">
                        <td colspan="2">Standar Nilai Sekolah</td>
                        @foreach ($data['kompetensi'] as $v=>$e1)
                        <td>{{$e1->nilai}}</td>
                        @endforeach
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
                            @php
                            $e->kuisoner2[$e1->idkompetensi]=$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')
                            @endphp
                            {{$e->kuisoner->where('idkompetensi',$e1->idkompetensi)->sum('nilai')-$e1->nilai}}
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
