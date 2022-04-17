@extends('layouts.admin')
@section('page-title','job Seeker Category')
@push('styles')

@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Category</a>
                </li>
                <li class="breadcrumb-item active">Category list
                </li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Create Category')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a class="btn btn-primary" href="{{route('category.index')}}">Category List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="POST">
                            @csrf
                            <div class="row col-lg-12 mt-1">
                                <div class="form-group col-sm-6">
                                    <label for="name">Category Name:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="name" type="text" id="name" value="{{old('name')}}" placeholder="category name" required="">
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

@endpush



