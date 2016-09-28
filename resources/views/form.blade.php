@extends('layouts.guestbook')

@section('scripts')
    @include('layouts.scripts')
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
@endsection

@section('top')
    @include('layouts.top')
@endsection

@section('content')
    @include('layouts.error')
    @include('layouts.info')
    @include('layouts.form')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
