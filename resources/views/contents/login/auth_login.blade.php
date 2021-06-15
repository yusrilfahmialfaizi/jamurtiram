@include('parts.login.header')
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <form action="{{ action('AuthController@auth')}}" method="POST"
                accept-charset="UTF-8" class="md-float-material form-material">
                {{-- <form class="md-float-material form-material"> --}}
                    <div class="text-center">
                        {{-- <img src="{{asset('assets\assets\images\logo.png')}}" alt="logo.png"> --}}
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Sign In</h3>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group form-primary">
                                <input type="text" name="username" id="username" class="form-control" required=""
                                    placeholder="Username Anda">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" id="password" class="form-control" required=""
                                    placeholder="Password Anda">
                                <span class="form-bar"></span>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                        <input type="submit" value="Login" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                                    {{-- <a href="\dashboard"
                                        class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign</a> --}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                                    <p class="text-inverse text-left"><a href="index-1.htm"><b class="f-w-600"></b></a></p>
                                </div>
                                <div class="col-md-2">
                                    {{-- <img src="{{asset('assets\assets\images\auth\Logo')}}-small-bottom.png"
                                    alt="small-logo.png"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
@include('parts.login.footer')