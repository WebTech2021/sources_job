@extends('layouts.employee')
@section('page-title','Employee portfolio')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Portfolio')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('employee.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('create portfolio')}}</li>
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
                            <form action="{{route('employee.portfolio.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row col-lg-12 mt-1">
                                    <div class="form-group col-sm-4">
                                        <label for="title">Title:</label><span class="text-danger">*</span>
                                        <input class="form-control" name="title" type="text" id="title" value="{{old('title')}}" value="{{old('title')}}" required="">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="image">Image:</label><span class="text-danger">*</span>
                                        <input class="form-control imgInp" name="image" id="change-picture" type="file"  value="{{old('image')}}" required="">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="portfolio_status">Status:</label><span class="text-danger">*</span>
                                        <select class="form-control"  tabindex="-1" aria-hidden="true" name="status" required>
                                            <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                            <option value="active" {{'active'==old('status')?'selected':''}}>Active</option>
                                            <option value="inactive" {{'inactive'==old('status')?'selected':''}}>InActive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label" for="modern-last-name">Description:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="3" name="description" cols="50" id="description" style="height: 100px; width: 100%" required=""> {{old('description')}}</textarea>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="portfolio_status">Image Preview:</label>
                                        <div>
                                            <img src="{{asset('images/dummy.jpg')}}" id="blah" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-2">
                                    <button type="submit" class="btn btn-primary" id="btnEducationSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Submit</button>
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


