@extends('layouts.template')

@section('page_title', 'Forgot password')

@section('breadcrumbs')
    <li><a href="{{ url('login')  }}">Login</a></li>
    <li class="active">Forgot Password</li>
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Forgot password</h3>
            </div>

            <!-- /.box-header -->
            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <!-- form start -->
                <div class="box-body">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ url('/login') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">
                        Send Password Reset Link
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </div>
@endsection
