@extends('layouts.admin')
@section('page-title','Category List')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0"><i class="far fa-stream"></i> {{__('Category List')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Category list')}}</li>
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
                                <i class="fa fa-list"></i> {{__('Category list')}}
                            </h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('category.create')}}"
                                   class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button">
                                    <span><i class="fas fa-plus"></i> {{__('Add Category')}}</span>
                                </a>
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
                ajax: '{{route('category.index')}}',
                columns: [
                    {data: "DT_RowIndex",title:"si", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name", title:'Category Name', orderable: false,  searchable: true, defaultContent:"null"},
                    {data: "slug", title:'Slug', orderable: false,  searchable: true, defaultContent:"null"},
                    {data: "action", title:'Action', orderable: false,  searchable: true, defaultContent:"null"},
                ],
            });
        })
    </script>
@endpush




