@extends('layouts.guestbook')

@section('scripts')
    @include('layouts.scripts')
@endsection

@section('top')
    @include('layouts.top')
@endsection

@section('content')
    @include('layouts.error')
    @include('layouts.info')
    @include('layouts.all_messages')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
