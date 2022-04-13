@extends('layouts.job_seeker')
@section('page-title','job Seeker Portfolio')
@push('styles')

@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">My Portfolio</a>
                </li>
                <li class="breadcrumb-item active">Portfolio list
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
                            <h4 class="mb-0">{{__('Portfolio')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a class="btn btn-primary" href="{{route('jobSeeker.portfolio.create')}}"><i class="fas fa-plus"></i> Add Portfolio</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Project Name</th>
                                <th>Project Link</th>
                                <th>Project Info</th>
                                <th>My Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($portfolios as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->link}}</td>
                                    <td>{{$data->short_info}}</td>
                                    <td>{{$data->role}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div class="mr-1">
                                                <a href="{{route('jobSeeker.portfolio.edit',encrypt($data->id))}}" class="btn btn-sm btn-primary" >
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('jobSeeker.portfolio.destroy', encrypt($data->id))}}" method="POST" >
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

