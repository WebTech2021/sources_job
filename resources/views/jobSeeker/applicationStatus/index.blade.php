@extends('layouts.employee')
@section('page-title','jobs')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('jobs')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('employee.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('jobs status')}}</li>
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
                ajax: '{!! route('employee.application.status')!!}',
                columns: [
                    {data: "DT_RowIndex", title: 'SI', name: "DT_RowIndex", searchable: false, orderable: false, defaultContent: '-'},
                    {data: "nameWithImage", title: 'Company Name', searchable: true, defaultContent: '-'},
                    {data: "job_title", title: 'job title', searchable: true, defaultContent: '-'},
                    {data: "status", title: 'status', defaultContent: '-'},
                ],
            });
        })
    </script>
@endpush



