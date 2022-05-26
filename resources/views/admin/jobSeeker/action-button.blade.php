<div class="dropdown">
    <button type="button"
            class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
            data-toggle="dropdown">
        <div style="font-size:14px;"><i class="fas fa-ellipsis-v"></i></div>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#"><div><i class="fas fa-eye"></i>&nbsp;&nbsp; {{__('Details')}}</div></a>
        @if($job_seeker->status == 'active' || $job_seeker->status == 'inactive' )
        <form action="{{route('jobSeeker.activeInactiveBlocked',encrypt($job_seeker->id))}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="blocked">
            <button class="dropdown-item" type="submit" style="width: 100%; border: none; outline:none;">
                <div>
                    <i class="fas fa-pause-circle"></i>&nbsp;&nbsp; {{__('Blocked it')}}
                </div>
            </button>
        </form>
        @endif
        @if($job_seeker->status == 'blocked' || $job_seeker->status == 'inactive' )
        <form action="{{route('jobSeeker.activeInactiveBlocked',encrypt($job_seeker->id))}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="active">
            <button class="dropdown-item" type="submit" style="width: 100%; border: none; outline:none;">
                <div>
                    <i class="fas fa-pause-circle"></i>&nbsp;&nbsp; {{__('Active')}}
                </div>
            </button>
        </form>
        @endif
        @if($job_seeker->status == 'blocked' || $job_seeker->status == 'active' )
            <form action="{{route('jobSeeker.activeInactiveBlocked',encrypt($job_seeker->id))}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="status" value="inactive">
                <button class="dropdown-item" type="submit" style="width: 100%; border: none; outline:none;">
                    <div>
                        <i class="fas fa-pause-circle"></i>&nbsp;&nbsp; {{__('In-Active')}}
                    </div>
                </button>
            </form>
        @endif
        <form action="{{route('login.as.jobSeeker')}}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{ $job_seeker->id }}">
            <button class="dropdown-item" type="submit" style="width: 100%; border: none; outline:none;">
                <div>
                    <i class="fas fa-pause-circle"></i>&nbsp;&nbsp; {{__('Login As JobSeeker')}}
                </div>
            </button>
        </form>
    </div>
</div>

