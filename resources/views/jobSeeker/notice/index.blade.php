@extends('layouts.job_seeker')
@section('page-title','Notice List')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0"><i class="fab fa-bandcamp"></i> {{__('Notice')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Notice list')}}</li>
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
                            <h4 class="mb-0"><i class="fas fa-list"></i> {{__('All Notices')}}</h4>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            <tbody>
                            <!--Data show from Datatable -->
                            </tbody>
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
            let Table = $('#dataTable').dataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{ route('jobSeeker.seeker.notice')}}',
                columns: [
                    {data: "DT_RowIndex", title: 'SI', name: "DT_RowIndex", searchable: false, orderable: false, defaultContent:'-'},
                    {data: "notice_subject", title:'subject',searchable: true, defaultContent:'-'},
                    {data: "notice_body", title:'body',searchable: true, defaultContent:'-'},
                    {data: "created", title:'sent',searchable: true, defaultContent:'-'},
                    {data: "read_at", title:'read',searchable: true, defaultContent:'-'},
                ],
            });

        })
    </script>
@endpush





