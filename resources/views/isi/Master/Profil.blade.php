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
        getall: function() {
            var queryString;
            queryString = 'json=1';

            jQuery.ajax({

                url: 'Menu-RS',
                data: queryString,
                type: "GET",
                success: function(data) {

                    var mydata = JSON.parse(data);
                    Vue.set(app.data, 'jalan', mydata);







                },
                error: function() { alert('koneksi gagal') }
            });

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
<div class="row align-items-center">
    <div class="col-lg-4 col-12 border-primary border-right">
        <div class="card shadow" style="zoom:85%">
            <div class="card-header card-header-success">
                <div class="d-flex  justify-content-between">
                    <h4 class="card-title ">Edit Data</h4>
                </div>
                <p class="card-category"></p>
            </div>
            <form action="update" method="post" enctype="multipart/form-data">
                <div class="card-body ">
                    {{ csrf_field() }}
                    <div class="row">
                        @foreach ($data['user.form'] as $e)
                        @if ($e['name']=='foto')
                        <div class="form-grup col-12 mb-2 input-group-sm">
                            <label class="form-control-label text-dark">Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                            <div class="input-group mb-3">
                            </div>
                        </div>
                        @else
                        @php
                        $b=$e['name'];
                        $e['val']=$data['user']->$b;
                        @endphp
                        <x-komponen :isi="$e" type="input" />
                        @endif
                        @endforeach
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <input type="hidden" name="table" value="user">
                        <button type="submit" class="btn btn-sm btn-outline-success ">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8 col-12 border-primary border-left">
        <div class="card" >
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="scan/{{$data['user']->foto}}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body ">
                        <h5 class="card-title">{{$data['user']->nama}}</h5>
                        <p class="card-text">Hi, Semoga hari mu menyenangkan. Pastikan double check pekerjaan mu agar menghindari human error.</p>
                        <p class="card-text mb-0"><small class="text-muted">Selamat Bekerja :)</small></p>
                        <p  class="card-text mb-0 text-right"><small class="text-muted"><strong><q>{{$data['quote']->quoteText}}</q></strong></small></p>
                          <footer class="blockquote-footer text-right">{{$data['quote']->quoteAuthor}}</footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
