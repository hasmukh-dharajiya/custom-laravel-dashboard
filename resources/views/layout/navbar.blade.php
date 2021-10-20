<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->
    <div class="nav-header">
        <a href="/dashboard" class="brand-logo">
            User Dashboard
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>

    <!--**********************************
Chat box start
***********************************-->

    <!--**********************************
      Chat box End
    ***********************************-->        <!--**********************************
            Chat box End
        ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->

    <!--**********************************
Header start
***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">

                    </div>

                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                {!! Avatar::create($avatar ?? '')->setFontSize(12)->setDimension(35,45)->toSvg() !!}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <p href="/profile" class="dropdown-item">
                                    <span class="ml-2">{{ $email_id ?? '' }}</span>
                                </p>
                                <a href="/profile" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" style="stroke-dasharray: 25, 45; stroke-dashoffset: 0;"></path><path d="M8,7A4,4 0,1,1 16,7A4,4 0,1,1 8,7" style="stroke-dasharray: 26, 46; stroke-dashoffset: 0;"></path></svg>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="/logout" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" style="stroke-dasharray: 29, 49; stroke-dashoffset: 0;"></path><path d="M16,17L21,12L16,7" style="stroke-dasharray: 15, 35; stroke-dashoffset: 0;"></path><path d="M21,12L9,12" style="stroke-dasharray: 12, 32; stroke-dashoffset: 0;"></path></svg>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

    </div>
    <!--**********************************
      Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
      Sidebar start
    ***********************************-->
