@php
	$e=$isi['e'];
@endphp
@foreach ($isi['form'] as $e1)
@if ($e1['tb'])
@php
$b=$e1['name'];
@endphp
@if ($e1['type']=='number')
<td class="text-wrap">@isset ($e1['pre']) {{$e1['pre']}} @endisset{{number_format($e->$b)}}</td>
@elseif($e1['type']=='date')
@if (!is_null($e->$b))
<td class="text-wrap">{{date_format(date_create($e->$b),'d/m/Y')}}</td>
@else
<td class="text-wrap">-</td>

@endif

@else
<td class="text-wrap">@isset ($e1['pre']) {{$e1['pre']}} @endisset{{$e->$b}}</td>

@endif
@endif
@endforeach
