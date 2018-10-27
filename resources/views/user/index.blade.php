@extends('layouts.template')

@section('page_title', 'Users')

@section('breadcrumbs')
    <li class="active"><i class="fa fa-user"></i> Users</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List of users</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                @can('add_users')
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Create</a>
                @endcan
            </div>
            <!-- /. tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="hide-on-phone">Id</th>
                    <th>Name</th>
                    <th class="hide-on-phone">Email</th>
                    <th class="hide-on-phone">Role</th>
                    <th class="hide-on-phone">Created At</th>
                    @can('edit_users', 'delete_users')
                    <th class="text-center">Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach($result as $item)
                    <tr>
                        <td class="hide-on-phone">{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="hide-on-phone">{{ $item->email }}</td>
                        <td class="hide-on-phone">{{ $item->roles->implode('name', ', ') }}</td>
                        <td class="hide-on-phone">{{ $item->created_at->toFormattedDateString() }}</td>

                        @can('edit_users')
                        <td class="text-center">
                            @include('shared._actions', [
                                'entity' => 'users',
                                'id' => $item->id
                            ])
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection

@push('scripts')
    <script>
        $("#users").addClass("active");
    </script>

    <!-- DataTables -->
    <script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>

    <script>
        $(function () {
            $('#data-table').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })
    </script>
@endpush