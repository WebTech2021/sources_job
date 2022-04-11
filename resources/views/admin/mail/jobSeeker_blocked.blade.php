@extends('layouts.mail')
@section('content')
    <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Hey,</p>
    <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #7367f0; ">{{ $name }}</p>
    <p style="margin: 0 0 24px;">
        Your <span style="font-weight: 600;">Sources</span> Account has been Blocked.
    </p>
    <p style="margin: 0 0 24px;">Please contact with Sources Admin.</p>
    <p>Thank you</p>
@endsection

