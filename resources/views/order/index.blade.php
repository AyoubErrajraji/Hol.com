@extends('layouts.template')

@section('page_title', 'Bestellingen')

@section('breadcrumbs')
    <li class="active"><i class="fa fa-archive"></i> Bestellingen</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lijst met bestellingen</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                @can('add_orders')
                    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm" disabled> <i class="glyphicon glyphicon-plus-sign"></i> Maak nieuwe order</a>
                @endcan
            </div>
            <!-- /. tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- TODO add id="data-table" for exended functions -->
            <table id="data-table" class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Bestelling ID</th>
                <th>Klant</th>
                <th>Status</th>
                <th>Aantal Producten</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $order)
                <tr>
                    <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        @if($order->state->id == 1)
                            <span class="label label-danger">{{ $order->state->name }}</span>
                        @elseif($order->state->id == 2)
                            <span class="label label-warning">{{ $order->state->name }}</span>
                        @elseif($order->state->id == 3)
                            <span class="label label-info">{{ $order->state->name }}</span>
                        @elseif($order->state->id == 4)
                            <span class="label label-success">{{ $order->state->name }}</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $total_products = 0;
                            foreach($order->products as $product){
                                $total_products += $product->pivot->amount;
                            }
                        @endphp
                        {{ $total_products }}
                    </td>
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
        $("#orders").addClass("active");
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