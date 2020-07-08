@extends('layout.out')
@section('isi2')
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a style="zoom:75%" class="navbar-brand brand-logo" href="Home">
            SMP IT Plus Bazma Brilliant </a>
        <a style="zoom:75%" class="navbar-brand brand-logo-mini" href="Home">
            SMP IT Plus Bazma Brilliant
            </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <form class="mr-auto search-form d-none d-md-block" action="Menu-Set">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" value="{{session()->get('thn')}}" class="form-control" placeholder="Set Tahun" name="thn" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary btn-sm" type="submit" id="button-addon2">Proses</button>
                    </div>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle mr-1" src="scan/{{session()->get('admin')->foto}}" alt="Profile image"> {{session()->get('admin')->nama}} </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="scan/{{session()->get('admin')->foto}}" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold">{{session()->get('admin')->nama}}</p>
                        <p class="font-weight-light text-muted mb-0">{{session()->get('admin')->user}}</p>
                    </div>
                    <a href="Menu-Profil" class="dropdown-item">My Profile <i class="dropdown-item-icon ti-dashboard"></i></a>
                    <a href="logout" class="dropdown-item">Log Out<i class="dropdown-item-icon ti-power-off"></i></a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="profile-image">
                        <img class="img-xs rounded-circle" src="scan/{{session()->get('admin')->foto}}" alt="profile image">
                        <div class="dot-indicator bg-success"></div>
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{session()->get('admin')->nama}}</p>
                    </div>
                </a>
            </li>
            <li class="nav-item nav-category">Menu Utama</li>
            <li class="nav-item">
                <a class="nav-link" href="Home">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Menu-Guru">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Data Guru</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="Menu-Kuisoner">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Hasil Kuisoner</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon typcn typcn-coffee"></i>
                    <span class="menu-title">Proses Penilaian</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="Menu-Tahap1">Aspek Penilaian dan Bobot Nilai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Menu-Tahap2">Mengitung GAP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Menu-Tahap3">Pemetaan & Konversi Nilai GAP</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="Menu-Tahap4">Pengelompokkan CF & SF</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="Menu-Tahap5">Menghitung Nilai Total (NT)</a>
                        </li>

                    </ul>
                </div>
            </li>
             <li class="nav-item ">
                <a class="nav-link " href="Menu-Laporan">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Laporan Hasil Penilaian</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper appx">
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title">{{$data['judul']}}</h4>
                        {{--
                        <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                            <ul class="quick-links">
                                <li><a href="#">ICE Market data</a></li>
                                <li><a href="#">Own analysis</a></li>
                                <li><a href="#">Historic market data</a></li>
                            </ul>
                            <ul class="quick-links ml-auto">
                                <li><a href="#">Settings</a></li>
                                <li><a href="#">Analytics</a></li>
                                <li><a href="#">Watchlist</a></li>
                            </ul>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
            @yield('isi')
            @yield('modal')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Template Copyright © 2019 <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
                </span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
@endsection
@section('js2')
<script src="mine/vue.js"> </script>
<script src="mine/datatables.min.js"> </script>
<script src="mine/jQuery.print.js"> </script>
<script src="mine/Chart.min.js"> </script>
<script type="text/javascript">
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})

</script>
<script type="text/javascript">
var aneh;
$(document).ready(function() {
    aneh = $('.tb').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: 'column',
                renderer: function(api, rowIdx, columns) {
                    var data = $.map(columns, function(col, i) {
                        return col.hidden ?
                            '<li  class="" data-dtr-index="1" data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                            '<div class="d-flex justify-content-between" >' +

                            '<span class="dtr-title">' + col.title + ':' + '</span> ' +
                            '<span class="dtr-data text-right text-break text-wrap">' + col.data + '</span>' +
                            '</li></div>' :
                            '';
                    }).join('');

                    return data ?
                        $('<ul style="display:block;" class="dtr-details" />').append(data) :
                        false;
                }
            }
        },
        "dom": '<"p-2 d-flex justify-content-between" f>t<"card-body" p>',
        "lengthMenu": [
            [5, 10, -1],
            [5, 10, "All"]
        ],
        /*
        "language": {
            "paginate": {
                "previous": "<",
                "next": ">",
            }
        }
        */
    });


});

</script>
@yield('js')
@endsection
