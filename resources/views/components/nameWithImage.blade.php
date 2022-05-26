<span class="text-nowrap">
    <span class="b-avatar">
        <span class="b-avatar-img">
            <img src="{{$image}}" style="width: 40px; height: 40px; border-radius: 50%; @if(isset($is_user) && $is_user) border: 2px solid green; @endif" class="img-thumbnail">
        </span>
    </span>
    <span class="text-nowrap"><a href="{{$route}}" target="_blank">{{$name}}</a></span>
</span>

