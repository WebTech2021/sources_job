@if($list_data->status != 'reject')
<div class="dropdown">
    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
            data-toggle="dropdown">
        <div style="font-size:20px;"><i class="fas fa-ellipsis-v fa-xs"></i></div>
    </button>
    <div class="dropdown-menu">
        @if($list_data->status == 'pending')
            <form action="{{route('jobSeeker.acceptReject',encrypt($list_data->id))}}" method="post">
                @csrf
                @method('put')
                <input type="text" name="status" hidden value="accept">
                <button class="confirm-text dropdown-item" type="submit"
                        style="width: 100%; border: none; outline:none;">
                    <div><i class="far fa-check"></i>&nbsp;&nbsp; {{__('Accept')}}</div>
                </button>
            </form>
            <form action="{{route('jobSeeker.acceptReject',encrypt($list_data->id))}}" method="post">
                @csrf
                @method('put')
                <input type="text" name="status" hidden value="reject">
                <button class="confirm-text dropdown-item" type="submit"
                        style="width: 100%; border: none; outline:none;">
                    <div><i class="far fa-crosshairs"></i>&nbsp;&nbsp; {{__('Reject')}}</div>
                </button>
            </form>
        @endif
          @if($list_data->status == 'accept')
           <form action="{{route('jobSeeker.acceptReject',encrypt($list_data->id))}}" method="post">
            @csrf
            @method('put')
            <input type="text" name="status" hidden value="reject">
            <button class="confirm-text dropdown-item" type="submit"
                    style="width: 100%; border: none; outline:none;">
                <div><i class="far fa-crosshairs"></i>&nbsp;&nbsp; {{__('Reject')}}</div>
            </button>
           </form>
         @endif
    </div>
</div>
@endif

