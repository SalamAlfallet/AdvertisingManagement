<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin:: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">

        </div>
    </div>
    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-flip="false" data-offset="0px,0px">
                <!-- -->
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">مرحبا ,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile"> {{Auth::user()->fname}} {{Auth::user()->lname}} </span>
                    <img class="kt-hidden" alt="Pic" src="{{asset('assets/media/users/300_25.jpg')}}" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"> {{mb_substr(Auth::user()->fname, 0, 1, 'utf8')}}</span>
                </div>

            </div>
            <a href="#">

                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                  
            </a>
            <!--end: Head -->

            <!--begin: Navigation -->

            <!--end: Navigation -->
        </div>
    </div>

    <!--end: User Bar -->
</div>

<!-- end:: Header Topbar -->
</div>