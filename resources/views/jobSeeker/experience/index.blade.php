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
                                <a href="#" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#default">
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
    <!-- experience Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Add Experience Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('jobSeeker.experience.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="experience_title">Designation: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="designation" type="text" id="designation">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="experience_title">Department: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="department" type="text" id="department">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="company">Company Name:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="company_name" type="text" id="company_name">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="location">Company Location: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="company_location" type="text" id="location">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="experience">Area of Experiences: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="experience" type="text" id="experience">
                            </div>
                            <div class="form-group col-sm-12">Employment Period: </div>
                            <div class="form-group col-sm-6">
                                <label for="start_date">start Date:</label><span class="text-danger">*</span>
                                <input class="form-control" id="startDate" autocomplete="off" required="" name="start_date" type="date">
                            </div>
                            <div class="form-group col-sm-6" id="demo">
                                <label for="end_date">End Date:</label><span class="text-danger" id="requiredText">*</span>
                                <input class="form-control" id="endDate" autocomplete="off" required="" name="end_date" type="date">
                            </div>
                            <div class="form-group col-sm-6">
                                <label><strong>{{__('Currently Working')}} <span style="color: red;">*</span></strong></label>
                                <div class="custom-control custom-radio">
                                    <input  onclick='document.getElementById("demo").innerHTML = "<h4>Currently Working</h4>"' type="radio" id="customRadio5" name="currently_working" class="custom-control-input" value="yes">
                                    <label class="custom-control-label" for="customRadio5">{{__('Currently Working')}}</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="description">Responsibilities:</label>
                                <textarea class="form-control textarea-sizing" rows="5" name="description" cols="50" id="description"></textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="btnExperienceSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Save</button>
                            <input class="btn btn-light ml-1 text-dark" type="reset" value="Reset">
                            <button type="button" id="btnCancel" class="btn btn-light ml-1 text-dark" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="default1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Update Experience Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="experience_title">Designation: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="designation" type="text" id="designation">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="experience_title">Department: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="department" type="text" id="department">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="company">Company Name:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="company_name" type="text" id="company_name">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="location">Company Location: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="company_location" type="text" id="location">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="experience">Area of Experiences: </label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="experience" type="text" id="experience">
                            </div>
                            <div class="form-group col-sm-12">Employment Period: </div>
                            <div class="form-group col-sm-6">
                                <label for="start_date">start Date:</label><span class="text-danger">*</span>
                                <input class="form-control" id="startDate" autocomplete="off" required="" name="start_date" type="date">
                            </div>
                            <div class="form-group col-sm-6" id="demo">
                                <label for="end_date">End Date:</label><span class="text-danger" id="requiredText">*</span>
                                <input class="form-control" id="endDate" autocomplete="off" required="" name="end_date" type="date">
                            </div>
                            <div class="form-group col-sm-6">
                                <label><strong>{{__('Currently Working')}} <span style="color: red;">*</span></strong></label>
                                <div class="custom-control custom-radio">
                                    <input  onclick='document.getElementById("demo").innerHTML = "<h3>Currently Working</h3>"' type="radio" id="customRadio5" name="currently_working" class="custom-control-input" value="yes">
                                    <label class="custom-control-label" for="customRadio5">{{__('Currently Working')}}</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="description">Responsibilities:</label>
                                <textarea class="form-control textarea-sizing" rows="5" name="description" cols="50" id="description"></textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="btnExperienceSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Save</button>
                            <input class="btn btn-light ml-1 text-dark" type="reset" value="Reset">
                            <button type="button" id="btnCancel" class="btn btn-light ml-1 text-dark" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic trigger modal end -->
@endsection
@push('scripts')

@endpush

