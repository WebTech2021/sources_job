@extends('layouts.admin')
@section('page-title','job Seeker Education')
@push('styles')

@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Education</a>
                </li>
                <li class="breadcrumb-item active">Education level
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
                            <h4 class="mb-0">{{__('Create Education level')}}</h4>
                        </div>
                        {{--                        <div class="dt-action-buttons text-right">--}}
                        {{--                            <div class="dt-buttons d-inline-flex">--}}
                        {{--                                <a class="btn btn-primary" href="#">Skill List</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('education.store')}}" method="POST">
                            @csrf
                            <div class="row col-lg-12 mt-1">
                                <div class="form-group col-sm-6">
                                    <label for="title">Education Level:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="name" type="text" id="name" value="{{old('name')}}" placeholder="education level" required="">
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

    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Education Level')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                {{--<a class="btn btn-primary" href="{{route('jobSeeker.skill.create')}}"><i class="fas fa-plus"></i> Add Skill</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Education Level</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($educations as $education)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$education->name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div>
                                                <form action="{{route('education.destroy',encrypt($education->id))}}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm confirm-text" type="submit" title="Delete Now">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush



