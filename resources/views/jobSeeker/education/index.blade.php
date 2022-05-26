@extends('layouts.job_seeker')
@section('page-title','Employee Education')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Education')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Education')}}</li>
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
                            <h4 class="mb-0">{{__('Education')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="#" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#default2">
                                    <span>{{__('Add Education')}} <i class="fas fa-plus"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                                <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Level of Education</th>
                                    <th>Degree Title</th>
                                    <th>Board</th>
                                    <th>Group</th>
                                    <th>Institute Name</th>
                                    <th>Result(GPA)</th>
                                    <th>Passing Year</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($educations as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($data->education_level == 'secondary')
                                                <p>Secondary</p>
                                            @elseif($data->education_level == 'higher_secondary')
                                                <p>Higher Secondary</p>
                                            @elseif($data->education_level == 'diploma')
                                                <p>Diploma</p>
                                            @elseif($data->education_level == 'bachelor/honors')
                                                <p>Bachelor/Honors</p>
                                            @elseif($data->education_level == 'masters')
                                                <p>Masters</p>
                                            @elseif($data->education_level == 'phd')
                                                <p>PHD</p>
                                            @else
                                                <p>-</p>
                                            @endif

                                        </td>
                                        <td>{{$data->degree_title}}</td>
                                        <td>
                                            @if($data->education_board == 'dhaka')
                                                <p>Dhaka</p>
                                            @elseif($data->education_board == 'barishal')
                                                <p>Barishal</p>
                                            @elseif($data->education_board == 'chattogram')
                                                <p>Chattogram</p>
                                            @elseif($data->education_board == 'comilla')
                                                <p>Comilla</p>
                                            @elseif($data->education_board == 'dinajpur')
                                                <p>Dinajpur</p>
                                            @elseif($data->education_board == 'jashore')
                                                <p>jashore</p>
                                            @elseif($data->education_board == 'mymensingh')
                                                <p>Mymensingh</p>
                                            @elseif($data->education_board == 'rajshahi')
                                                <p>Rajshahi</p>
                                            @elseif($data->education_board == 'sylhet')
                                                <p>Sylhet</p>
                                            @elseif($data->education_board == 'madrasah')
                                                <p>Madrasah</p>
                                            @elseif($data->education_board == 'technical')
                                                <p>Technical</p>
                                            @elseif($data->education_board == 'bou')
                                                <p>BOU</p>
                                            @else
                                                <p>-</p>
                                            @endif

                                        </td>
                                        <td>{{$data->group}}</td>
                                        <td>{{$data->institute_name}}</td>
                                        <td>{{$data->result}}</td>
                                        <td>{{$data->passing_year}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="mr-1">
                                                    <a href="{{route('jobSeeker.education.edit',encrypt($data->id))}}" class="btn btn-sm btn-primary" >
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                </div>

                                                <div>
                                                    <form action="{{ route('jobSeeker.education.destroy', encrypt($data->id))}}" method="POST" >
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
    <!-- add education -->
    <div class="modal fade text-left" id="default2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">Add Educational Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('jobSeeker.education.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="position-relative" data-select2-id="64">
                                    <label for="degree_title">Level of Education:</label><span class="text-danger">*</span>
                                    <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_level" required="">
                                        <option value="" data-select2-id="2" selected disabled>Select One</option>
                                        <option value="secondary">Secondary</option>
                                        <option value="higher_secondary">Higher Secondary</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="bachelor/honors">Bachelor/Honors</option>
                                        <option value="masters">Masters</option>
{{--                                        <option value="phd">PhD (Doctor of Philosophy)</option>--}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="degree_title">Degree Title:</label><span class="text-danger">*</span>
                                <input class="form-control" name="degree_title" type="text" id="degree_title" required="">
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="position-relative" data-select2-id="64">
                                    <label for="degree_title">Board:</label><span class="text-danger">*</span>
                                    <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_board" required="" >
                                        <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                        <option value="barishal">Barishal</option>
                                        <option value="chattogram">Chattogram</option>
                                        <option value="cumilla">Cumilla</option>
                                        <option value="dhaka">Dhaka</option>
                                        <option value="dinajpur">Dinajpur</option>
                                        <option value="jashore">Jashore</option>
                                        <option value="mymensingh">Mymensingh</option>
                                        <option value="rajshahi">Rajshahi</option>
                                        <option value="sylhet">Sylhet</option>
                                        <option value="madrasah">Madrasah</option>
                                        <option value="technical">Technical</option>
                                        <option value="bou">BOU(Bangladesh Open University)</option>
                                        <option value="foreign_institute">Foreign Institute</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="country">Concentration/Major/Group:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="group" type="text" id="group">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="institute">Institute Name:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="institute_name" type="text" id="institute_name">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="result">Result:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="result" type="text" id="result">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="year">Passing Year:</label><span class="text-danger">*</span>
                                <select class="form-control" id="yearpicker" name="passing_year" required="">
                                    <option value="" data-select2-id="2" selected disabled>Select Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="btnEducationSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Save</button>
                            <input class="btn btn-light ml-1 text-dark" type="reset" value="Reset">
                            <button type="button" id="btnEducationCancel" class="btn btn-light ml-1 text-dark" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="default3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">Update Educational Details</h4>
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
                                <div class="position-relative" data-select2-id="64">
                                    <label for="degree_title">Level of Education:</label><span class="text-danger">*</span>
                                    <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_level" >
                                        <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                        <option value="secondary" selected="">Secondary</option>
                                        <option value="higher_secondary">Higher Secondary</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="bachelor/honors">Bachelor/Honors</option>
                                        <option value="masters">Masters</option>
                                        <option value="phd">PhD (Doctor of Philosophy)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="degree_title">Degree Title:</label><span class="text-danger">*</span>
                                <input class="form-control" name="degree_title" type="text" id="degree_title" value="">
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="position-relative" data-select2-id="64">
                                    <label for="degree_title">Board:</label><span class="text-danger">*</span>
                                    <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_board" >
                                        <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                        <option value="barishal">Barishal</option>
                                        <option value="chattogram">Chattogram</option>
                                        <option value="cumilla">Cumilla</option>
                                        <option value="dhaka">Dhaka</option>
                                        <option value="dinajpur">Dinajpur</option>
                                        <option value="jashore">Jashore</option>
                                        <option value="mymensingh">Mymensingh</option>
                                        <option value="rajshahi">Rajshahi</option>
                                        <option value="sylhet">Sylhet</option>
                                        <option value="madrasah">Madrasah</option>
                                        <option value="technical">Technical</option>
                                        <option value="bou">BOU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="country">Concentration/Major/Group:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="group" type="text" id="group">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="institute">Institute Name:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="institute_name" type="text" id="institute_name">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="result">Result:</label><span class="text-danger">*</span>
                                <input class="form-control" required="" name="result" type="text" id="result">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="year">Year:</label><span class="text-danger">*</span>
                                <select class="form-control" id="yearpicker" name="passing_year">
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="btnEducationSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Save</button>
                            <input class="btn btn-light ml-1 text-dark" type="reset" value="Reset">
                            <button type="button" id="btnEducationCancel" class="btn btn-light ml-1 text-dark" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic trigger modal end -->
@endsection
@push('scripts')
    <script type="text/javascript">
        let startYear = 1900;
        let endYear = new Date().getFullYear();
        for (i = endYear; i > startYear; i--)
        {
            $('#yearpicker').append($('<option />').val(i).html(i));
        }
    </script>
@endpush

