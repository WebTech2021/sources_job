<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="" href="{{url('/')}}">
                    <img style="height:40px; margin: 20px 20px;"
                         src="{{ asset('admin/app-assets/images/ico/sources1.png') }}"
                     alt=""/>
                </a>
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
{{--            <li class="{{ request()->segment(1)==' ' ? 'active' :'' }} nav-item">--}}
{{--                @php--}}
{{--                    $s_wallet = \App\Models\Wallet::all();--}}
{{--                @endphp--}}
{{--                <a class="d-flex align-items-center" href="{{ route('wallet.index') }}" style="place-content: center; font-weight: bold">--}}
{{--                    <span class="menu-title text-truncate text-center">Total Wallet: <br>{{ number_format(array_sum($s_wallet->pluck('balance')->toArray())+array_sum($s_wallet->pluck('other_balance')->toArray()), 2, '.', ',') }} BDT</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="{{ Route::currentRouteName()=='jobSeeker.list'?'active':'' }} nav-item"><a
                    class="d-flex align-items-center" href="#"
                ><i class="fas fa-user-tag"></i><span class="menu-title text-truncate" data-i18n="Home"
                    >{{__('Job Seeker')}}</span></a>
            </li>
        </ul>
    </div>
</div><!-- END: Main Menu-->
