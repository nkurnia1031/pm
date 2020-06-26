@extends('layout.index') @section('js')
@if (session()->has('thn'))
@if ($data['hasil']->where('thn', session()->get('thn'))->isNotEmpty())
<script type="text/javascript">
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: [{!!$data['grf']['guru']!!}],
        datasets: [{
            label: 'Peringkat pada tahun {{session()->get('thn')}}',
            backgroundColor: '#5768f3',
            borderColor: '#5768f3',
            data: [{{ $data['grf']['nilai']}}]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>
@endif
@endif
@endsection
@section('modal')
@endsection
@section('isi')
@if (!session()->has('thn'))
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Peringatan</h4>
            <p>Silahkan set tahun terlebih dahulu</p>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-lg-4 col-12 mb-2">
        <div class="card" style="zoom:85%">
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">History Peringkat</h4>
                </div>
            </div>
            <ul class="list-group">
                @foreach ($data['hasil'] as $e)
                <li class="list-group-item"><strong>{{$e->thn}}:</strong> {{collect($e->hasiljson)->sortByDesc('nt')->first()->nama}} Peringkat 1 dengan total nilai {{collect($e->hasiljson)->sortByDesc('nt')->first()->nt}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-8 col-12">
        @if ($data['hasil']->where('thn', session()->get('thn'))->isNotEmpty())
        <canvas id="myChart"></canvas>
        @else
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Peringatan</h4>
            <p>Tidak ditemukan penilaian pada tahun {{session()->get('thn')}}</p>
        </div>
        @endif
    </div>
</div>
@endif
@endsection
