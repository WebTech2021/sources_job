@extends('layouts.employee')
@section('page-title','Employee portfolio')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Portfolio')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('employee.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Edit portfolio')}}</li>
        </ol>
    </div>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Create portfolio')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a class="btn btn-primary" href="{{route('employee.portfolio.index')}}">Portfolio List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('employee.portfolio.update',encrypt($portfolio->id))}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row col-lg-12 mt-1">
                                <div class="form-group col-sm-4">
                                    <label for="portfolio_title">Title:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="title" type="text" id="title" value="{{old('title',$portfolio->title)}}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="image">Image:</label><span class="text-danger">*</span>
                                    <input class="form-control imgInp" name="image" id="change-picture" type="file"  value="">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="portfolio_status">Status:</label><span class="text-danger">*</span>
                                    <select class="form-control"  tabindex="-1" aria-hidden="true" name="status">
                                        <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                        <option value="active" {{old('active',$portfolio->status == 'active')? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{old('inactive',$portfolio->status == 'inactive')? 'selected' : ''}}>InActive</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label" for="modern-last-name">Description:<span style="color:red">*</span></label>
                                    <textarea class="form-control address-height" rows="3" name="description" cols="50" style="height: 100px; width: 100%">{{old('description',$portfolio->description)}}</textarea>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="portfolio_status">Image Preview:</label>
                                    <div>
                                        @if($portfolio ->image)
                                            <img src="{{asset(config('imagepath.portfolio').$portfolio->image)}}" id="blah" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">
                                        @else
                                            <img src="{{asset('images/default.png')}}" id="blah" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-2">
                                <button type="submit" class="btn btn-primary" id="btnEducationSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        //image preview
        $("#change-picture").change(function () {
            readURL(this);
        });

        //image input
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    </script>
@endpush



