<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl" >

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>ِAuto Souq | Login Admin</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
 
    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{asset('assets/app/custom/login/login-v4.default.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->


    @include('backend.templates.head')


    <style>

.kt-login__btn-primary{
background-color: #00bcd4 !important;


}

    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(../assets/media/bg/bg-2.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                            <img src="{{asset('assets/media/logos/logo-autosouq.png')}}">
                            </a>
                        </div>



                        <div class="">

                            <div class="kt-login__head">
                                <h3 class="kt-login__title">إعادة تعيين كلمة المرور</h3>

                                <div class="kt-login__desc">قٌم بادخال البريد الإلكتروني لاسترداد كلمة المرور.</div>

                            </div>
                            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                            <form class="kt-form" method="POST" action="{{ route('password.email') }}">
                                 @csrf
                                <div class="input-group">
                                    <input class="form-control  @error('email') is-invalid @enderror" type="email" placeholder="البريد الالكتروني " name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="kt-login__actions">
                                <button  id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary"> إعادة تعيين كلمة المرور</button>&nbsp;&nbsp;

                                <button id="kt_login_forgot_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">رجوع</button>&nbsp;&nbsp;

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->





    @include('backend.templates.foot')

    <!--begin::Page Scripts(used by this page) -->
    <!-- <script src="{{asset('assets/app/custom/login/login-general.js')}}" type="text/javascript"></script> -->
    <script>
$("#owl-demo").owlCarousel({
    navigation : true
  });

    </script>


    <!--end::Page Scripts -->


</body>

<!-- end::Body -->

</html>
