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
                            </div>
                        </div>
                    </div>
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
@endpush


