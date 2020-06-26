@extends('layout.index') @section('js')
<script type="text/javascript">
$(document).ready(function() {
    $('.tb').DataTable({
        "responsive": true,
        "lengthMenu": [
            [5, 10, -1],
            [5, 10, "All"]
        ]

    });






});

</script>
<script type="text/javascript">
var app = new Vue({
    el: '.app',
    data: {
        kd: null,


    },
    methods: {
        uang(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        getall: function(primary, key, table) {
            var queryString;
            queryString = 'primary=' + primary + '&key=' + key + '&table=' + table;

            jQuery.ajax({

                url: 'getall',
                data: queryString,
                type: "GET",
                success: function(data) {

                    var mydata = JSON.parse(data);
                    app[table] = mydata;
                    $(".load").hide('slow', function() {
                        $('.isi').show('slow');
                    });






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
<br>
<br>
<br>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-3 col-12 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Tambah Paramater</h4>
                </div>
                <div class="card-body table-responsive">
                    <form action="upload" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="form-grup col-12 mb-3">
                                <label class="form-control-label">File</label>
                                <input type="file" required="" step="any" maxlength="50" min="0" required="" name="file" class="form-control">
                            </div>
                            <div class="form-grup col-6 mb-3">
                            </div>
                            <div class="form-grup col-6 mb-3">
                                <input type="hidden" name="table" value="paramater">
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
