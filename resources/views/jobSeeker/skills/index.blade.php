@extends('layouts.job_seeker')
@section('page-title','job Seeker Skills')
@push('styles')

@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">My Skills</a>
                </li>
                <li class="breadcrumb-item active">Skills list
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
                            <h4 class="mb-0">{{__('Create Skill')}}</h4>
                        </div>
{{--                        <div class="dt-action-buttons text-right">--}}
{{--                            <div class="dt-buttons d-inline-flex">--}}
{{--                                <a class="btn btn-primary" href="#">Skill List</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('jobSeeker.skill.store')}}" method="POST">
                            @csrf
                            <div class="row col-lg-12 mt-1">
                                <div class="form-group col-sm-6">
                                    <label for="title">Skill Name:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="skill" type="text" id="skill" value="{{old('skill')}}" placeholder="skill" required="">
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
                            <h4 class="mb-0">{{__('Skills List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
{{--                                <a class="btn btn-primary" href="{{route('jobSeeker.skill.create')}}"><i class="fas fa-plus"></i> Add Skill</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Skill Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skills as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$data->skill}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div>
                                                <form action="{{route('jobSeeker.skill.destroy',encrypt($data->id))}}" method="POST" >
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


