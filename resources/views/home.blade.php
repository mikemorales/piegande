@extends('layouts.app')

@section('content')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.menu')
        <div id="dashboard">
            @yield('content')
        </div>
    </div>
@endsection
