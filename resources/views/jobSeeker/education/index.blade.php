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
                                <a href="{{route('jobSeeker.education.create')}}" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button">
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
                                    <th>Result</th>
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
                                                <div>Secondary</div>
                                            @elseif($data->education_level == 'higher_secondary')
                                                <div>Higher Secondary</div>
                                            @elseif($data->education_level == 'psc')
                                                <div>PSC/5 pass</div>
                                            @elseif($data->education_level == 'jsc')
                                                <div>JSC/JDC/8 pass</div>
                                            @elseif($data->education_level == 'diploma')
                                                <div>Diploma</div>
                                            @elseif($data->education_level == 'bachelor_honors')
                                                <div>Bachelor/Honors</div>
                                            @elseif($data->education_level == 'masters')
                                                <div>Masters</div>
                                            @elseif($data->education_level == 'phd')
                                                <div>PHD</div>
                                            @else
                                                <div>-</div>
                                            @endif

                                        </td>
                                        <td>{{$data->degree_title}}</td>
                                        <td>
                                            @if($data->education_board == 'Dhaka')
                                                <div>Dhaka</div>
                                            @elseif($data->education_board == 'Barishal')
                                                <div>Barishal</div>
                                            @elseif($data->education_board == 'Chattogram')
                                                <div>Chattogram</div>
                                            @elseif($data->education_board == 'Comilla')
                                                <div>Comilla</div>
                                            @elseif($data->education_board == 'Dinajpur')
                                                <div>Dinajpur</div>
                                            @elseif($data->education_board == 'Jashore')
                                                <div>jashore</div>
                                            @elseif($data->education_board == 'Mymensingh')
                                                <div>Mymensingh</div>
                                            @elseif($data->education_board == 'Rajshahi')
                                                <div>Rajshahi</div>
                                            @elseif($data->education_board == 'Sylhet')
                                                <div>Sylhet</div>
                                            @elseif($data->education_board == 'Madrasah')
                                                <div>Madrasah</div>
                                            @elseif($data->education_board == 'Technical')
                                                <div>Technical</div>
                                            @elseif($data->education_board == 'BOU')
                                                <div>BOU</div>
                                            @else
                                                <div>-</div>
                                            @endif

                                        </td>
                                        <td>{{$data->group}}</td>
                                        <td>{{$data->institute_name}}</td>
                                         <td>
                                            @if($data->result == 'grade')
                                                <div>CGPA-{{ $data->cgpa }} out of {{$data->scale}}</div>
                                            @elseif($data->result == '1st_class')
                                                <div>First Division,Mark: {{$data->mark}}%</div>
                                            @elseif($data->result == '2nd_class')
                                                 <div>Second Division,Mark: {{$data->mark}}%</div>
                                            @elseif($data->result == '3rd_class')
                                                 <div>Third Division,Mark: {{$data->mark}}%</div>
                                            @endif
                                         </td>
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

