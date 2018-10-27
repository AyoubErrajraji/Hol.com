@extends('layouts.template')

@section('page_title', 'Edit user ' . $user->first_name)

@section('breadcrumbs')
    <li><a href="{{ url('users')  }}"><i class="fa fa-user"></i> Users</a></li>
    <li class="active">Edit</li>
@endsection

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Edit user</h3>
            <div class="pull-right box-tools">
                <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <!-- /.box-header -->

        {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update',  $user->id ] ]) !!}
            @include('user._form')
        {!! Form::close() !!}

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
        $("#users").addClass("active");
    </script>
@endpush