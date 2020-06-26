@extends('layout.out')
@section('isi2')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="auto-form-wrapper">
                    <form role="form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="label">Username</label>
                            <div class="input-group">
                                <input type="text" name="user" class="form-control" placeholder="Username">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="input-group">
                                <input type="password" name="pass" class="form-control" placeholder="*********">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                        </div>
                    </form>
                </div>
                <p class="footer-text text-center">Template copyright © 2018 Bootstrapdash. All rights reserved.</p>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
@endsection
