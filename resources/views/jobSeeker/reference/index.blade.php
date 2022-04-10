@extends('layouts.job_seeker')
@section('page-title','reference')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Reference')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Reference')}}</li>
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
                            <h4 class="mb-0"><i class="fas fa-list-alt"></i>  {{__('List of Reference')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('jobSeeker.reference.create')}}" class="dt-button create-new btn btn-primary ml-1 mr-1">
                                    <span><i class="fas fa-plus"></i> {{__('Create Reference')}}</span>
                                </a>
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
                ajax: '{{route('jobSeeker.reference.index')}}',
                columns: [
                    {data: "DT_RowIndex", title: 'SI', name: "DT_RowIndex", searchable: false, orderable: false, defaultContent: 'null'},
                    {data: "name", title: 'name', searchable: true, defaultContent: 'null'},
                    {data: "profession", title:'Profession', searchable: true, defaultContent: 'null'},
                    {data: "phone_number", title: 'phone number', searchable: true, defaultContent: 'null'},
                    {data: "email", title: 'email', searchable: true, defaultContent: 'null'},
                    {data: "address", title: 'address', defaultContent: 'null'},
                    {data: "status", title: 'status', defaultContent: 'null'},
                    {data: "action", title: 'action', orderable: false, searchable: false, defaultContent: 'null'},
                ],
            });
        })
@endpush
