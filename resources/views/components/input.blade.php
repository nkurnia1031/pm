@if ($isi['input'])
@php
$name = $isi['name'];
$type = $isi['type'];
$label = $isi['label'];
$pnj = $isi['pnj'];
$val = $isi['val'];
$red = $isi['red'];
$max = $isi['max'];
$var='input[]';
$tb='tb[]';
@endphp
@if ($type == "textarea")
<div class="form-grup col-{{$pnj}} mb-2 input-group-sm">
    <label class="form-control-label text-dark">{{$label}}</label>
    <textarea  maxlength="{{$max}}" {{$red}} autocomplete=off name="{{$var}}" class="form-control">{{ $val }}</textarea>
    <input type="hidden" name="{{ $tb }}" value="{{ $name }}">
</div>
@elseif($type == "textarea2")
<div class="form-grup col-{{ $pnj }} mb-2 input-group-sm">
    <label class="form-control-label text-dark">{{ $label }}</label>
    <textarea maxlength="{{ $max }}" {{ $red }} autocomplete=off name="{{ $var }}" class="form-control summernote">{{ $val }}</textarea>
    <input type="hidden" name="{{ $tb }}" value="{{ $name }}">
</div>
@else
<div class="form-grup col-{{ $pnj }} mb-2 input-group-sm">
    <label class="form-control-label text-dark">{{ $label }}</label>
    <input maxlength="{{ $max }}" autocomplete=off type="{{ $type }}" {{ $red }} step="any" min="0" value="{{ $val }}" name="{{ $var }}" class="form-control">
    <input type="hidden" name="{{ $tb }}" value="{{ $name }}">
</div>
@endif
@endif
