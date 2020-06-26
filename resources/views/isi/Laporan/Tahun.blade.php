@extends('layout.index') @section('js')
<script type="text/javascript">
$(document).ready(function() {



    //app.getall();




});

</script>
<script type="text/javascript">
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
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Preview Laporan</h4>
                    <button type="button" class="btn btn-outline-dark btn-sm  " onclick="$('#print22').print();">Catak</button>
                </div>
            </div>
            <div class="" style="zoom:100%" id="print22">
                @include('isi.komponen.kop')
                <div class="row ">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <br>
                        <h4 class="text-center"><b><u>{{$data['judul']}}</u></b></h4>
                        <div class="row">
                            <div class="col-6">
                                <table width="50%">
                                    <tr>
                                        <td>Tahun</td>
                                        <td>:</td>
                                        <td>{{session()->get('thn')}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <table style="zoom:90%" width="100%" class="table table-bordered table-hover table-striped ">
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
                                    <th rowspan="2">NT</th>
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
                                    <td>{{$e->nt}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                @include('isi.komponen.ttd')
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
