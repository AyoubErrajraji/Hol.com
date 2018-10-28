@extends('layouts.template')

@section('page_title', 'product' . $product->title)

@section('breadcrumbs')
    <li><a href="{{ url('products')  }}"><i class="fa fa-paragraph"></i> Products</a></li>
    <li class="active">Edit</li>
@endsection

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Edit product</h3>
            <div class="pull-right box-tools">
                <a href="{{ route('products.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <!-- /.box-header -->

        {!! Form::model($product, ['method' => 'PUT', 'route' => ['products.update',  $product->id ] ]) !!}
            @include('product._form')

        <div class="box-footer">
            {!! Form::submit('Save changes', ['class' => 'btn btn-primary']) !!}
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