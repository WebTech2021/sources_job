@extends('layouts.admin')
@section('page-title','Job List')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0"><i class="far fa-stream"></i> {{__('Job List')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('job list')}}</li>
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
                            <h4 class="mb-0 float-left mr-3 ">
                                <i class="fa fa-list"></i> {{__('job list')}}
                            </h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
{{--                                <a href="{{route('jobSeeker-export')}}" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"--}}
{{--                                   aria-controls="DataTables_Table_0" type="button">--}}
{{--                                    <span><i class="fas fa-download"></i> {{__('Export')}}</span>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            {{--show data from datatable--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            var Table = $('#dataTable').dataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{ route('job.list')}}',
                columns: [
                    {data: "DT_RowIndex",title:"si", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "job_title", title:'Job Title', orderable: false,  searchable: true, defaultContent:"null"},
                    {data: "organization_name", title:'Organization Name', orderable: false,  searchable: true, defaultContent:"null"},
                    {data: "job_categories", title:"job category", orderable: false, searchable: true,defaultContent:"-"},
                    {data: "vacancy",title:"vacancy", searchable: true},
                    {data: "employment_status",title:"job type", searchable: true, defaultContent:"-"},
                    {data: "salary",title:"salary", searchable: true, defaultContent:"-"},
                    {data: "min_experience",title:"	min experience", searchable: true, defaultContent:"-"},
                    {data: "status",title:"status", searchable: true, defaultContent:"-"},
                ],
            });


        })
    </script>
@endpush



