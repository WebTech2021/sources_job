<div class="dropdown">
    <button type="button"
            class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
            data-toggle="dropdown">
        <div style="font-size:20px;"><i class="fas fa-ellipsis-v fa-xs"></i></div>
    </button>

    <div class="dropdown-menu">
            <a class="dropdown-item "
               href="{{ route('category.edit',encrypt($category->id)) }}">
                <div><i class="fas fa-pen"></i>&nbsp;&nbsp; {{__('Edit')}}</div>
            </a>

            <form action="{{route('category.destroy', encrypt($category->id))}}" method="post">
                @csrf
                @method('DELETE')
                <button class="confirm-text dropdown-item" type="submit"
                        style="width: 100%; border: none; outline:none;">
                    <div><i class="far fa-trash-alt"></i>&nbsp;&nbsp; {{__('Delete')}}</div>
                </button>
            </form>
    </div>
</div>
