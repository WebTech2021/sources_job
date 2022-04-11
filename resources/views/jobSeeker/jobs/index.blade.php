@extends('layouts.job_seeker')
@section('page-title','jobs')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('jobs')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('jobs list')}}</li>
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
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('list of jobs')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                {{--                                <a href="#" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"--}}
                                {{--                                   aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#default">--}}
                                {{--                                    <span>{{__('')}} <i class="fas fa-plus"></i></span>--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="col-sm-4 col-lg-4 mb-1 mt-1">--}}
                    {{--                        <label for="workplace">{{__('search by job type')}}</label>--}}
                    {{--                        <select class="select2 form-select select2-hidden-accessible form-control basicInput "--}}
                    {{--                                tabindex="-1" aria-hidden="true" id="employment_status"--}}
                    {{--                        >--}}
                    {{--                            <option value="all" selected>All</option>--}}
                    {{--                            <option value="full_time">Full Time</option>--}}
                    {{--                            <option value="part_time">Part Time</option>--}}
                    {{--                            <option value="contract">Contract</option>--}}
                    {{--                            <option value="internship">Internship</option>--}}
                    {{--                            <option value="freelance">Freelance</option>--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                    <div class="card-body pt-2 pb-0">
                        <div class="row ">
                            <div class="col-12">
                                <x-jobstatus/>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            <!--Data show from Datatable -->
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
            $('#dataTable').dataTable({
                stateSave: true,
                serverSide: true,
                processing: true,
                ajax: '{!! route('jobSeeker.jobs.list', ['employment_status'=>request('employment_status')]) !!}',
                columns: [
                    {data: "DT_RowIndex", title: 'SI', name: "DT_RowIndex", searchable: false, orderable: false, defaultContent: '-'},
                    {data: "nameWithImage", title: 'Company Name', searchable: true, defaultContent: '-'},
                    {data: "job_title", title: 'job title', searchable: true, defaultContent: '-'},
                    {data: "min_experience", title: ' Min Experience (year)', searchable: true, defaultContent: '-'},
                    {data: "vacancy", title: 'vacancy', searchable: true, defaultContent: '-'},
                    {data: "salary", title: 'salary', searchable: true, defaultContent: '-'},
                    {data: "employment_status", title: 'job type', defaultContent: '-'},
                    {data: "expire_date", title: 'Apply DeadLine', searchable: true, defaultContent: '-'},
                    {data: "action", title: 'action', orderable: false, searchable: false, defaultContent: '-'},
                ],
            });
        })
    </script>

    {{--    --}}
    {{--    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            let filterData = {}--}}
    {{--            load_data()--}}

    {{--            function load_data() {--}}
    {{--                $('#dataTable').dataTable({--}}
    {{--                    sDom: "ltipr",--}}
    {{--                    destroy: true,--}}
    {{--                    serverSide: true,--}}
    {{--                    processing: true,--}}
    {{--                    responsive: true,--}}
    {{--                    ajax: {--}}
    {{--                        url: '{!! route('employee.jobs.list', ['status'=>request('status')]) !!}',--}}
    {{--                        data: filterData--}}
    {{--                    },--}}

    {{--                    columns: [--}}
    {{--                        {--}}
    {{--                            data: "DT_RowIndex",--}}
    {{--                            title: 'SI',--}}
    {{--                            name: "DT_RowIndex",--}}
    {{--                            searchable: false,--}}
    {{--                            orderable: false,--}}
    {{--                            defaultContent: '-'--}}
    {{--                        },--}}
    {{--                        {data: "organization_name", title: 'Company Name', searchable: true, defaultContent: '-'},--}}
    {{--                        {data: "job_title", title: 'job title', searchable: true, defaultContent: '-'},--}}
    {{--                        {--}}
    {{--                            data: "min_experience",--}}
    {{--                            title: ' Min Experience (year)',--}}
    {{--                            searchable: true,--}}
    {{--                            defaultContent: '-'--}}
    {{--                        },--}}
    {{--                        {data: "vacancy", title: 'vacancy', searchable: true, defaultContent: '-'},--}}
    {{--                        {data: "salary", title: 'salary', searchable: true, defaultContent: '-'},--}}
    {{--                        {data: "employment_status", title: 'job type', searchable: true, defaultContent: '-'},--}}
    {{--                        {data: "expire_date", title: 'Apply DeadLine', searchable: true, defaultContent: '-'},--}}
    {{--                        {data: "action", title: 'action', orderable: false, searchable: false, defaultContent: '-'},--}}
    {{--                    ],--}}
    {{--                });--}}
    {{--            }--}}

    {{--            $('.basicInput').bind('keyup change', function () {--}}
    {{--                filterData.status = $('#employment_status').val()--}}
    {{--                load_data()--}}

    {{--                let queryParams = new URLSearchParams(window.location.search);--}}
    {{--                queryParams.set("status", $("#employment_status option:selected").text());--}}
    {{--                history.replaceState(null, null, "?" + queryParams.toString());--}}
    {{--            });--}}

    {{--        })--}}
    {{--    </script>--}}
@endpush


