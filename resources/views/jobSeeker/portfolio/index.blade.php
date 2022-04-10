@extends('layouts.employee')
@section('page-title','Employee Education')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/pages/app-ecommerce.css')}}">
@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">My Portfolio</a>
                </li>
                <li class="breadcrumb-item active">Portfolio list
                </li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                    <div class="card-header border-bottom p-1 d-flex align-items-center justify-content-between">
                        <div class="head-label">
                            <h4 class="mb-0"> <i class="fa fa-list"></i>  {{__('My Portfolio')}}</h4>
                        </div>
                        <div class="dt-action-buttons">
                            <div class="dt-buttons">
                                <a class="btn btn-primary" href="{{route('employee.portfolio.create')}}"><i class="fas fa-plus"></i> Add Portfolio</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <!-- BEGIN: Content-->
                            <div class="app-content  ecommerce-application">
                                <div class="content-wrapper container-xxl p-0">
                                    <div class="content-body">
                                        <section id="wishlist" class="grid-view wishlist-items">
                                            @foreach($portfolios as $portfolio)
                                            <div class="card ecommerce-card">
                                                <div class="item-img text-center">
                                                    <a href="#">
                                                        <img class="img-fluid p-1"  src="{{asset(config('imagepath.portfolio').$portfolio->image)}}" alt="img-placeholder"  />
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="item-wrapper">
                                                        <div class="item-cost">
                                                            <h6 class="item-price"><i class="fas fa-eye"></i>  120</h6>
                                                        </div>
                                                    </div>
                                                    <div class="item-name">
                                                        <a href="#">{{$portfolio->title ?? ' '}}</a>
                                                    </div>
                                                    <p class="card-text item-description">
                                                       {{$portfolio->description ?? ' '}}
                                                    </p>
                                                </div>
                                                <div class="item-options text-center">
                                                    <a href="{{route('employee.portfolio.edit',encrypt($portfolio->id))}}" class="btn btn-light btn-wishlist">
                                                        <i data-feather="edit"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                    <a href="{{route('employee.portfolio.show',encrypt($portfolio->id))}}" class="btn btn-primary btn-wishlist">
                                                        <i data-feather="eye"></i>
                                                        <span class="add-to-cart">View Details</span>
                                                    </a>
                                                   <div style="width: 100%" class="btn-light">
                                                       <form action="{{route('employee.portfolio.destroy',encrypt($portfolio->id))}}" method="post">
                                                           @csrf
                                                           @method('DELETE')
                                                           <button type="submit" class="btn text-danger">
                                                               <i class="far fa-trash-alt"></i>&nbsp;&nbsp; {{__('Delete')}}
                                                           </button>
                                                       </form>
                                                   </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Content-->
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush
