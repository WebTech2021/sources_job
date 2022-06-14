@extends('layouts.job_seeker')
@section('page-title','jobSeeker Experience')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Experience')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Experience')}}</li>
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
                            <h4 class="mb-0">{{__('Experience')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('jobSeeker.experience.create')}}" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button">
                                    <span>{{__('Add Experience')}} <i class="fas fa-plus"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Company_name</th>
                                <th>Experience</th>
                                <th>Company Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Currently Working</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($experiences as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$data->designation}}</td>
                                    <td>{{$data->department}}</td>
                                    <td>{{$data->company_name}}</td>
                                    <td>{{$data->experience}}</td>
                                    <td>{{$data->company_location}}</td>
                                    <td>{{$data->start_date != null ? \Carbon\Carbon::parse($data->start_date)->format('d M Y'):'no date issue'}}</td>
                                    <td>{{$data->end_date != null ? \Carbon\Carbon::parse($data->end_date)->format('d M Y'): 'no date issue'}}</td>
                                    <td>{{$data->currently_working ?? '-'}}</td>
                                    <td>{{$data->description}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div class="mr-1">
                                                <a href="{{route('jobSeeker.experience.edit',encrypt($data->id))}}" class="btn btn-sm btn-primary" title="Edit it">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('jobSeeker.experience.destroy', encrypt($data->id)) }}" method="POST" >
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

