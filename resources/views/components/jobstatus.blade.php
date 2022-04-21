<div>

    @if(!auth()->user()->career)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="alert-body text-center">
                To get Job Offer You have to fill all the information including <a href="{{route('jobSeeker.key.features')}}"><b style="color: #0C1D2F">KEY FEATURES</b></a> as well as <a href="{{route('jobSeeker.profileInfo.edit')}}"><b style="color: #0C1D2F">CV DETAILS</b></a>
            </div>
        </div>
    @else
        @php
            $jobs =\auth()->user()->career->category->activeJobs;
        @endphp
        <ul class="nav justify-content-center">
            <li class="nav-item active_mini_menu">
                <a class="nav-link" href="{{route('jobSeeker.jobs.list')}}">{{__('All')}}</a>
            </li>
            <li class="nav-item active_mini_menu">
                <a class="nav-link"
                   href="{{route('jobSeeker.jobs.list', ['employment_status'=>'full_time'])}}">{{__('Full time')}}
                    ({{$jobs->where('employment_status', 'full_time')->count()}})</a>
            </li>
            <li class="nav-item active_mini_menu">
                <a class="nav-link"
                   href="{{route('jobSeeker.jobs.list', ['employment_status'=>'part_time'])}}">{{__('part time')}}
                    ({{$jobs->where('employment_status', 'part_time')->count()}})</a>
            </li>
            <li class="nav-item active_mini_menu">
                <a class="nav-link"
                   href="{{route('jobSeeker.jobs.list', ['employment_status'=>'contract'])}}">{{__('contract')}}
                    ({{$jobs->where('employment_status', 'contract')->count()}})</a>
            </li>
            <li class="nav-item active_mini_menu">
                <a class="nav-link"
                   href="{{route('jobSeeker.jobs.list', ['employment_status'=>'internship'])}}">{{__('internship')}}
                    ({{$jobs->where('employment_status', 'internship')->count()}})</a>
            </li>
            <li class="nav-item active_mini_menu">
                <a class="nav-link"
                   href="{{route('jobSeeker.jobs.list', ['employment_status'=>'freelance'])}}">{{__('freelance')}}
                    ({{$jobs->where('employment_status', 'freelance')->count()}})</a>
            </li>
        </ul>
    @endif
</div>
