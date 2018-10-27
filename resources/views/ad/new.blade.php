@extends('layouts.template')

@section('page_title', 'Nieuwe advertentie')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Advertentie</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <a href="{{ route('ads.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <!-- /. tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['route' => ['ads.store'], 'enctype' => 'multipart/form-data', 'files' => true ]) !!}
            @include('ad._form')
            <!-- Submit Form Button -->
            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection


