@extends('layouts.template')

@section('page_title', 'Goedkeuren')

@section('breadcrumbs')
    <li class="active"><i class="fa fa-tags"></i> Goedkeuren</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lijst van Afwachtende Advertenties</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">

            <thead>
            <tr>
                <th class="hide-on-phone">Id</th>
                <th>Title</th>
                <th>State</th>
                <th>Action</th>
                <th class="hide-on-phone">Author</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td class="hide-on-phone">{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->state->name }}</td>
                    <td>
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
                        @if($item->state->name == 'In Afwachting')
                            @can('manage_pending')
                                {!! Form::open( ['method' => 'post', 'url' => route('approve.active', $item ), 'style' => 'display: inline']) !!}
                                    <button class="btn btn-xs btn-success">
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                <!! Form::close() !!}

                                {!! Form::open( ['method' => 'post', 'url' => route('approve.refuse', $item ), 'style' => 'display: inline']) !!}
                                    <button class="btn btn-xs btn-danger">
                                        <i class="fa fa-close"></i>
                                    </button>
                                {!! Form::close() !!}
                            @endcan
                        @endif

                    </td>
                    <td class="hide-on-phone">{{ $item->user['name'] }}</td>
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
        $("#approves").addClass("active");
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