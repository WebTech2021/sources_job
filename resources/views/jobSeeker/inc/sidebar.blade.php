<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <img style="height:35px; margin: 20px 20px;"
                     src="{{ asset('admin/app-assets/images/ico/sources1.png') }}"
                />
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"
                    ></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                            data-feather="disc" data-ticon="disc"
             ></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="{{ Route::currentRouteName()=='jobSeeker.home' ? 'active':'' }} nav-item"><a
                    class="d-flex align-items-center" href="{{route('jobSeeker.home')}}"
                ><i class="fas fa-tachometer-alt"></i><span class="menu-title text-truncate"
                                                            data-i18n="Home"
                    >{{__('Dashboard')}}</span></a>
            </li>
            <li class="{{ Route::currentRouteName()=='jobSeeker.profileInfo.edit' ? 'active':'' }} nav-item"><a
                    class="d-flex align-items-center" href="{{route('jobSeeker.profileInfo.edit')}}"
                ><i class="fas fa-info-circle"></i><span class="menu-title text-truncate"
                                                         data-i18n="Home"
                    >{{__('Personal Info')}}</span></a>
            </li>
            <li class="{{ Route::currentRouteName()=='jobSeeker.education.index' ? 'active':'' }} nav-item"><a
                    class="d-flex align-items-center" href="{{route('jobSeeker.education.index')}}"
                ><i class="fas fa-user-graduate"></i><span class="menu-title text-truncate"
                                                           data-i18n="Home"
                    >{{__('Education')}}</span></a>
            </li>
            <li class="{{ Route::currentRouteName()=='jobSeeker.experience.index' ? 'active':'' }} nav-item"><a
                    class="d-flex align-items-center" href="{{route('jobSeeker.experience.index')}}"
                ><i class="fas fa-user-tie"></i><span class="menu-title text-truncate"
                                                      data-i18n="Home"
                    >{{__('Experience')}}</span></a>
            </li>
            @if(\Request::is('jobSeeker/career/info/create'))
                <li class="{{ Route::currentRouteName()=='jobSeeker.career-info' ? 'active':'' }} nav-item">
                    <a class="d-flex align-items-center" href="{{route('jobSeeker.career-info')}}"><i
                            data-feather="home"
                        ></i><span class="menu-title text-truncate" data-i18n="Home"
                        >{{__('career Info')}}</span></a>
                </li>
            @else
                <li class="{{ Route::currentRouteName()=='jobSeeker.info-edit' ? 'active':'' }} nav-item">
                    <a class="d-flex align-items-center" href="{{route('jobSeeker.info-edit')}}">
                        <i class="fa fa-edit"></i><span class="menu-title text-truncate" data-i18n="Home"
                        >{{__('Update career Info')}}</span></a>
                </li>
            @endif
            <li class="{{ Route::currentRouteName()=='jobSeeker.reference.index' ? 'active':'' }} nav-item">
                <a
                    class="d-flex align-items-center" href="{{route('jobSeeker.reference.index')}}"
                ><i class="fa fa-users"></i> <span class="menu-title text-truncate"
                                                 data-i18n="Home"
                    >{{__('Reference')}}</span></a>
            </li>
            <li class="{{ Route::currentRouteName()=='jobSeeker.profileInfo.preview' ? 'active':'' }} nav-item">
                <a
                    class="d-flex align-items-center" href="{{route('jobSeeker.profileInfo.preview')}}"
                ><i class="fas fa-eye"></i><span class="menu-title text-truncate"
                                                 data-i18n="Home"
                    >{{__('Info Preview')}}</span></a>
            </li>
{{--            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-user-shield"--}}
{{--                    ></i> <span class="menu-title text-truncate" data-i18n="User"--}}
{{--                    > {{__('Cv Information')}}</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    --}}
{{--                </ul>--}}
{{--            </li>--}}
            @if(auth('jobSeeker')->user()->status == 'active'|| auth('jobSeeker')->user()->status != 'inactive')
                <li class="{{ request()->segment(2)=='portfolio' ? 'active' :'' }} nav-item">
                    <a class="d-flex align-items-center" href="{{route('jobSeeker.portfolio.index')}}"><i class="fad fa-file-word"></i> <span class="menu-title text-truncate" data-i18n="Home">{{__('My WorkPack')}}</span></a>
                </li>
{{--                <li class="{{ Route::currentRouteName()=='jobSeeker.application.status' ? 'active':'' }} nav-item">--}}
{{--                    <a class="d-flex align-items-center" href="{{route('jobSeeker.application.status')}}"><i class="fad fa-badge-check"></i> <span--}}
{{--                            class="menu-title text-truncate" data-i18n="Home"--}}
{{--                        >{{__('job status')}}</span></a>--}}
{{--                </li>--}}
                <li class="{{ request()->segment(2)=='' ? 'active' :'' }} nav-item">
                    <a class="d-flex align-items-center" href="#"><i class="fab fa-invision"></i><span
                            class="menu-title text-truncate" data-i18n="Home"
                        >{{__('Job Invite')}}</span></a>
                </li>
{{--                <li class="{{ Route::currentRouteName()=='jobSeeker.jobs.list' ? 'active':'' }} nav-item">--}}
{{--                    <a class="d-flex align-items-center" href="{{route('jobSeeker.jobs.list')}}">--}}
{{--                        <i class="fal fa-list-ul"></i> <span class="menu-title text-truncate" data-i18n="Home">{{__('Job List')}}</span></a>--}}
{{--                </li>--}}
            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
