@extends('layouts.job_seeker')
@section('page-title','edit reference')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Reference')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Reference Edit')}}</li>
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
                            <h4 class="mb-0"> <i class="fa fa-edit"></i> {{__('Edit Reference')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('jobSeeker.reference.index')}}" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0" type="button">
                                    <span>{{__('Go Back')}} </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('jobSeeker.reference.update',encrypt($ref_data->id))}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row pt-2">
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-full-name">Full Name: <span style="color:red">*</span></label>
                                    <input type="text" id="modern-full-name" name="name" class="form-control" placeholder="full name" value="{{old('name',$ref_data->name)}}" required="">
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-">Profession: </label>
                                    <input type="text" id="modern-profession" name="profession" class="form-control" placeholder="profession" value="{{old('profession',$ref_data->profession)}}">
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-">Phone Number: <span style="color:red">*</span></label>
                                    <input type="text" id="modern-phone-number" name="phone_number" class="form-control" placeholder="phone number" value="{{old('phone_number',$ref_data->phone_number)}}" required="">
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-email">Email: </label>
                                    <input type="text" id="modern-email" name="email" class="form-control" placeholder="email" value="{{old('email',$ref_data->email)}}">
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-address">Address: </label>
                                    <input type="text" id="modern-address" name="address" class="form-control" placeholder="address" value="{{old('address',$ref_data->address)}}">
                                </div>
                                <div class="col-sm-4 col-12 mb-2">
                                    <label for="status">{{__('Status')}}</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active" {{ $ref_data->status == 'active'? 'selected':'' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ $ref_data->status == 'inactive'? 'selected':'' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <button  class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                             aria-controls="DataTables_Table_0" type="submit">
                                        <span>{{__('Update')}}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


