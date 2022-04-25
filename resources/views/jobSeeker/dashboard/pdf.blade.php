<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Some Random Title</title>
    <style>
        body{
            font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
            letter-spacing: -0.3px;
        }
        .invoice-wrapper{ width: 700px; margin: auto; }
        .nav-sidebar .nav-header:not(:first-of-type){ padding: 1.7rem 0rem .5rem; }
        .logo{ font-size: 50px; }
        .sidebar-collapse .brand-link .brand-image{ margin-top: -33px; }
        .content-wrapper{ margin: auto !important; }
        .billing-company-image { width: 50px; }
        .billing_name { text-transform: uppercase; }
        .billing_address { text-transform: capitalize; }
        .table{ width: 100%; border-collapse: collapse; }
        th{ text-align: left; padding: 10px; }
        td{ padding: 10px; vertical-align: top; }
        .row{ display: block; clear: both; }
        .text-right{ text-align: right; }
        .table-hover thead tr{ background: #eee; }
        .table-hover tbody tr:nth-child(even){ background: #fbf9f9; }
        address{ font-style: normal; }
    </style>
</head>
<body>
<div class="row invoice-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <td>
                            <h2>{{$seeker_details->first_name.' '.$seeker_details->last_name}}</h2>
                            <p>Mobile No:+88 {{$seeker_details->phone_number}}</p>
                            <p>Email: {{$seeker_details->email}}</p>
                            <p>Address: {{$seeker_details->p_address}}</p>
                        </td>
                        <td class="text-right">
{{--                            <strong>Date: 28 April 2020</strong>--}}
                            <img  height="165" width="140" src="{{$seeker_details->image ? ('images/profile/'.$seeker_details->image) ?? 'images/dummy.jpg'  : ('images/dummy.jpg')}}">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Career Objective:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <p>{{ $seeker_details->application_info->objective ?? ' ' }}</p>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <br><br><br>
        <div>
            <small><small>NOTE: This is system generate invoice no need of signature</small></small>
        </div>
    </div>
</div>
</body>
</html>
