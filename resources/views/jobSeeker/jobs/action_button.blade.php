<div class="btn-group">
    <div class="mr-1">
{{--        <a href="#" class="btn btn-sm btn-primary" title="Edit it">--}}
{{--            Interested--}}
{{--        </a>--}}
        @if($job_data->checkApplication())
            <p class="badge badge-glow badge-danger">Already Applied</p>
        @else
         <a href="{{route('jobSeeker.jobs.details',$job_data->id)}}" class="btn btn-sm btn-primary" title="Apply">
           Apply Now
        </a>
        @endif
    </div>
    <div>
    </div>
</div>
