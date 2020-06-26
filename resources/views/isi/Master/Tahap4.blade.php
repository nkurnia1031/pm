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
        <div class="card mb-3" style="zoom:85%">
            <form action="update" method="post">
                {{ csrf_field() }}
                <div class="card-body ">
                    <div class="row">
                        <div class="form-grup col-12 mb-2 input-group-sm">
                            <label class="form-control-label text-dark">Core Factor (CF)</label>
                            <div class="input-group mb-3">
                                <input type="number" id="cfp" step="any" value="{{$data['faktor'][0]->persen}}" onchange="$('#sfp').val(100-$('#cfp').val())" name="factor[0][persen]" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <input type="hidden" name="factor[0][faktor]" value="Core">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-grup col-12 mb-2 input-group-sm">
                            <label class="form-control-label text-dark">Secondary Factor (SF)</label>
                            <div class="input-group mb-3">
                                <input type="number" step="any" id="sfp" value="{{$data['faktor'][1]->persen}}" name="factor[1][persen]" readonly="" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <input type="hidden" name="factor[1][faktor]" value="Secondary">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-outline-success ">Update</button>
                </div>
            </form>
        </div>
        <div class="card" style="zoom:85%">
            <form action="update" method="post">
                {{ csrf_field() }}
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Core Factor ({{$data['faktor'][0]->persen}}%)</th>
                            <th>Secondary Factor ({{$data['faktor'][1]->persen}}%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['kompetensi'] as $v=>$e)
                        <tr>
                            <td>{{$e->kompetensi}}</td>
                            <td>
                                <input type="radio" @if ($e->kelompok=='Core') checked="" @endif value="Core" name="kompetensi[{{$e->idkompetensi}}]">
                            </td>
                            <td>
                                <input type="radio" @if ($e->kelompok=='Secondary') checked="" @endif value="Secondary" name="kompetensi[{{$e->idkompetensi}}]">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-outline-success ">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8 col-12">
        <div class="card" style="zoom:85%">
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Menghitung Core Factor (CF) dan Secondary Factor (SF)</h4>
                </div>
            </div>
            <table style="zoom:90%" width="100%" class="table  table-hover table-striped ">
               <thead class=" ">
                    <tr>
                        <th rowspan="2">
                            Ranking
                        </th>
                        <th rowspan="2">Guru</th>
                        @if ($data['kompetensi']->where('kelompok','Core')->isNotEmpty())
                        <th class="text-center" colspan="{{$data['kompetensi']->where('kelompok','Core')->count()}}">Core Factor ({{$data['faktor'][0]->persen}}%)</th>

                        <th rowspan="2">NCF</th>
                        @endif
                        @if ($data['kompetensi']->where('kelompok','Secondary')->isNotEmpty())

                        <th class="text-center" colspan="{{$data['kompetensi']->where('kelompok','Secondary')->count()}}">Secondary Factor ({{$data['faktor'][1]->persen}}%)</th>
                        <th rowspan="2">NSF</th>
                        @endif


                    </tr>
                    <tr>
                        @foreach ($data['kompetensi']->where('kelompok','Core') as $v=>$e)
                        <th>{{$e->kompetensi}}</th>
                        @endforeach
                        @foreach ($data['kompetensi']->where('kelompok','Secondary') as $v=>$e)
                        <th>{{$e->kompetensi}}</th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>

                    @foreach ($data['guru']->sortByDesc('nt')->values() as $v=>$e)

                    <tr>
                        <td>{{$v+1}}</td>
                        <td>
                            {{$e->nama}}
                            <div class="text-muted">NIP.{{$e->nip}}</div>
                        </td>
                        @if ($data['kompetensi']->where('kelompok','Core')->isNotEmpty())


                        @foreach ($data['kompetensi']->where('kelompok','Core') as $v1=>$e1)
                        <td>
                            @php
                                $b=$e1->kompetensi;
                            @endphp
                            {{$e->$b}}
                        </td>
                        @endforeach
                        <td>{{$e->ncf}}</td>
                        @endif
                        @if ($data['kompetensi']->where('kelompok','Secondary')->isNotEmpty())


                        @foreach ($data['kompetensi']->where('kelompok','Secondary') as $v1=>$e1)
                            <td>
                            @php
                                $b=$e1->kompetensi;
                            @endphp
                            {{$e->$b}}
                        </td>
                        @endforeach
                        <td>{{$e->nsf}}</td>

                        @endif



                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
