@extends('layouts.template')

@section('page_title', 'Create user')

@section('breadcrumbs')
    <li><a href="{{ url('users')  }}"><i class="fa fa-user"></i> Users</a></li>
    <li class="active">Create</li>
@endsection

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Create a new user</h3>
            <div class="pull-right box-tools">
                <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <!-- /.box-header -->

            {!! Form::open(['route' => ['users.store'] ]) !!}
                @include('user._form')
            {!! Form::close() !!}

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
        $("#users").addClass("active");
    </script>
@endpush