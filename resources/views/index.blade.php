@extends('layouts.template')

@section('page_title', 'Producten')

@section('breadcrumbs')
    <breadcrumb-component></breadcrumb-component>
@endsection

@section('content')

    <router-view></router-view>

@endsection

@push('scripts')
    <!-- Scripts -->
    <script>
        $("#auction").addClass("active");
    </script>
@endpush