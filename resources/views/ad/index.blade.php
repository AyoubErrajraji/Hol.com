@extends('layouts.template')

@section('page_title', 'Advertentie')

@section('breadcrumbs')
    <li class="active"><i class="fa fa-tags"></i> Advertentie</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lijst van Advertenties</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                @can('add_ads')
                    <a href="{{ route('ads.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Create</a>
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
                <th>Title</th>
                <th class="hide-on-phone">Author</th>
                <th>State</th>
                <th class="hide-on-phone">Bid Count</th>
                <th class="hide-on-phone">Created At</th>
                @can('edit_ads', 'delete_ads')
                    <th class="text-center">Actions</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)

                @if(Auth::user()->hasRole('Admin'))
                    <tr>
                        <td class="hide-on-phone">{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td class="hide-on-phone">{{ $item->user['name'] }}</td>
                        <th>{{ $item->state->name }}</th>
                        <td class="hide-on-phone">{{ $item->bid->count() }}</td>
                        <td class="hide-on-phone">{{ $item->created_at->toFormattedDateString() }}</td>
                        @if(auth()->user()->can('edit_ads') || auth()->user()->can('delete_ads') )
                            <td class="text-center {{ $item->active ? "active-color" : "inactive-color" }}">
                                @can('edit_ads')
                                    <a href="{{ route('ads.edit', ['ad' => $item->id])  }}" class="btn btn-xs btn-info">
                                        <i class="fa fa-edit"></i> Edit</a>
                                @endcan

                                @can('delete_ads')
                                    {!! Form::open( ['method' => 'delete', 'url' => route('ads.destroy', ['ad' => $item->id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are you sure wanted to delete it?")']) !!}
                                    <button type="submit" class="btn-delete btn btn-xs btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endcan
                                @if($item->state->name != 'Geblokkeerd')
                                    @can('block_ad')
                                        {!! Form::open( ['method' => 'post', 'url' => route('approve.block', $item ), 'style' => 'display: inline']) !!}
                                        <button class="btn btn-xs btn-info">
                                            <i class="fa fa-ban"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    @endcan
                                @else
                                    @can('unblock_ad')
                                        {!! Form::open( ['method' => 'post', 'url' => route('approve.unblock', $item), 'style' => 'display: inline']) !!}
                                        <button class="btn btn-xs btn-info">
                                            <i class="fa fa-circle-o"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    @endcan
                                @endif
                            </td>
                        @endif
                    </tr>
                @endif
                @if(Auth::user()->hasRole('User'))
                    @if(Auth::user()->id == $item->user->id)
                        <tr>
                            <td class="hide-on-phone">{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="hide-on-phone">{{ $item->user['name'] }}</td>
                            <th>{{ $item->state->name }}</th>
                            <td class="hide-on-phone">{{ $item->bid->count() }}</td>
                            <td class="hide-on-phone">{{ $item->created_at->toFormattedDateString() }}</td>
                            @if(auth()->user()->can('edit_ads') || auth()->user()->can('delete_ads') )
                                <td class="text-center {{ $item->active ? "active-color" : "inactive-color" }}">
                                    @can('edit_ads')
                                        <a href="{{ route('ads.edit', ['ad' => $item->id])  }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-edit"></i> Edit</a>
                                    @endcan

                                    @can('delete_ads')
                                        {!! Form::open( ['method' => 'delete', 'url' => route('ads.destroy', ['ad' => $item->id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are you sure wanted to delete it?")']) !!}
                                        <button type="submit" class="btn-delete btn btn-xs btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    @endcan
                                    @if($item->state->name != 'Geblokkeerd')
                                        @can('block_ad')
                                            {!! Form::open( ['method' => 'post', 'url' => route('approve.block', $item ), 'style' => 'display: inline']) !!}
                                            <button class="btn btn-xs btn-info">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        @endcan
                                    @else
                                        @can('unblock_ad')
                                            {!! Form::open( ['method' => 'post', 'url' => route('approve.unblock', $item), 'style' => 'display: inline']) !!}
                                            <button class="btn btn-xs btn-info">
                                                <i class="fa fa-circle-o"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        @endcan
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endif
                @endif


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
        $("#ads").addClass("active");
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