<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
	<div class="navbar-container d-flex content">
		<div class="bookmark-wrapper d-flex align-items-center">
			<ul class="nav navbar-nav d-xl-none">
				<li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
			</ul>
		</div>
		<ul class="nav navbar-nav align-items-center ml-auto">
            @if(session('loggedIn-from-admin'))
                <div class="p-1">
                    <li class="nav-item nav-search">
                        <a class="nav-link text-danger" href="{{ route('admin.login') }}">Back To Admin</a>
                    </li>
                </div>
            @endif

{{--            @if(auth('jobSeeker')->user()->status == 'active')--}}
{{--                <div style="padding-right: 10px;">Account Status: <span class="badge badge-light-success">Active</span></div>--}}
{{--            @elseif(auth('jobSeeker')->user()->status == 'inactive')--}}
{{--                <div style="padding-right: 10px;">Account Status: <span class="badge badge-light-secondary">In-Active</span></div>--}}
{{--            @else--}}
{{--                <div style="padding-right: 10px;">Account Status: <span class="badge badge-light-danger">Blocked</span></div>--}}
{{--            @endif--}}

			<li class="nav-item dropdown dropdown-language">
				<a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="flag-icon flag-icon-{{ app()->getLocale() == 'en' ?'us':'bd' }}"></i>
					<span class="selected-language">{{ app()->getLocale() == 'en' ?'English':'বাংলা' }}</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
					<a class="dropdown-item" href="#" data-language="en">
						<i class="flag-icon flag-icon-us"></i> English
					</a>
					<a class="dropdown-item" href="#" data-language="fr">
						<i class="flag-icon flag-icon-bd"></i> বাংলা
					</a>
				</div>
			</li>
{{--			<li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>--}}
{{--				<div class="search-input">--}}
{{--					<div class="search-input-icon"><i data-feather="search"></i></div>--}}
{{--					<input class="form-control input" type="text" placeholder="Search everywhere..." tabindex="-1" >--}}
{{--					<div class="search-input-close"><i data-feather="x"></i></div>--}}
{{--					<ul class="search-list search-list-main"></ul>--}}
{{--				</div>--}}
{{--			</li>--}}

{{--			<li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">{{auth('jobSeeker')->user()->unreadNotifications->count()}}</span></a>--}}
{{--				<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">--}}
{{--					<li class="dropdown-menu-header">--}}
{{--						<div class="dropdown-header d-flex">--}}
{{--							<h4 class="notification-title mb-0 mr-auto">Notifications</h4>--}}
{{--							<div class="badge badge-pill badge-light-primary">{{auth('jobSeeker')->user()->unreadNotifications->count()}} New</div>--}}
{{--						</div>--}}
{{--					</li>--}}
{{--					@foreach(auth('jobSeeker')->user()->unreadNotifications->take(5) as $notification)--}}
{{--						<li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">--}}
{{--								<div class="media d-flex align-items-start">--}}
{{--									<div class="media-left">--}}
{{--										                                    avatar goes here--}}
{{--										                                    <div class="avatar"><img src="#" alt="avatar" width="32" height="32"></div>--}}
{{--									</div>--}}
{{--									<div class="media-body">--}}
{{--										<a href="{{ route('mark-as-read',[$notification->id, $notification->data['route_name'], $notification->data['product_id']??"null"]) }}" ><p class="media-heading"><span class="font-weight-bolder"> {{$notification->data['notificationOn']}}  </span> {{$notification->data['data']}}  </p><small class="notification-text"> {{$notification->created_at->diffForHumans()}}</small></a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--							</a>--}}
{{--						</li>--}}
{{--					@endforeach--}}
{{--					<li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="#">Read all notifications</a></li>--}}
{{--				</ul>--}}
{{--			</li>--}}

			<li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--					<div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"></span><span class="user-status">{{ ucfirst(Auth::user()->first_name) }} {{ ucfirst(Auth::user()->last_name) }}</span></div><span class="avatar"><img class="round" src="{{asset(config('imagepath.profile').auth()->user()->image)}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>--}}
                <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ ucfirst(Auth::user()->first_name) }} {{ ucfirst(Auth::user()->last_name) }}</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="{{asset(config('imagepath.profile').auth()->user()->image)}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
					<a class="dropdown-item" href="{{route('jobSeeker.view.profile')}}"><i class="mr-50" data-feather="user"></i> Profile</a>
{{--					<a class="dropdown-item" href="javascript:void(0);"><i class="mr-50" data-feather="mail"></i> Inbox</a>--}}
{{--					<div class="dropdown-divider"></div>--}}
{{--					<a class="dropdown-item" href="javascript:void(0);"><i class="mr-50" data-feather="settings"></i> Settings</a>--}}
					<a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="mr-50" data-feather="power"></i> Logout</a>
					<form id="logout-form" action="{{ route('jobSeeker.logout') }}" method="POST" class="d-none">
						@csrf
					</form>
				</div>
			</li>
		</ul>
	</div>
</nav>
<!-- END: Header-->
