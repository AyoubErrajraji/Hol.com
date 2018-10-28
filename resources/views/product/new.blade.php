@extends('layouts.template')

@section('page_title', 'product')

@section('breadcrumbs')
    <li><a href="{{ url('products')  }}"><i class="fa fa-paragraph"></i> Products</a></li>
    <li class="active">Create</li>
@endsection

@section('content')

<!-- general form elements -->
<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Create a new product</h3>
        <div class="pull-right box-tools">
            <a href="{{ route('products.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <!-- /.box-header -->

    {!! Form::open(['route' => ['products.store'] ]) !!}
    @include('product._form')

    <div class="box-footer">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
    <!-- Submit Form Button -->

    {!! Form::close() !!}

</div>
<!-- /.box -->

@endsection

@push('scripts')
    <script>
        $("#products").addClass("active");
    </script>
@endpush