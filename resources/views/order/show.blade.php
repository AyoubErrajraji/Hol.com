@extends('layouts.template')

@section('page_title')
    Bestelling Ordernummer: {{ $result->id }}
@endsection

@section('breadcrumbs')
    <li class="active"><i class="fa fa-archive"></i> Bestellingen</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Hol.com, Inc.
                        <small class="pull-right">Date: {{ date('d-m-Y', strtotime($result->created_at)) }}</small>
                    </h2>
                </div>
                <!-- /.col -->

            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Van
                    <address>
                        <strong>Hol.com, Inc.</strong><br>
                        Wijnhaven 107<br>
                        3011 WN Rotterdam<br>
                        Telefoon: (804) 123-5432<br>
                        Email: info@hol.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Naar
                    <address>
                        <strong>{{ $result->user->name }}</strong><br>
                        {{ $result->address->street }} {{ $result->address->number }}<br>
                        {{ $result->address->zip_code }}, {{ $result->address->city }}<br>
                        Telefoon: -------<br>
                        Email: {{ $result->user->email }}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Factuur #{{ $result->id }}</b><br>
                    <br>
                    <b>Bestelling ID:</b> {{ $result->id }}<br>
                    <b>Betaling verloopt op:</b> {{ $result->created_at->addWeeks(4)->format('d/m/y') }}<br>
                    <b>Account:</b> {{ $result->user->id }}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Hvl</th>
                            <th>Product</th>
                            <th>ID #</th>
                            <th>Beschrijving</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $subtotal = 0;
                        @endphp


                        @foreach($result->products as $product)
                            <tr>
                                <td>{{ $product->pivot->amount }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->body }}</td>
                                <td>€{{ number_format($product->pivot->amount * $product->price, 2, ',', '.') }}</td>
                            </tr>

                            @php
                                $subtotal += $product->pivot->amount * $product->price;
                            @endphp

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Betaal Methoden:</p>
                    <img src="{{ asset('bower_components/admin-lte/dist/img/credit/visa.png') }}" alt="Visa">
                    <img src="{{ asset('bower_components/admin-lte/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                    <img src="{{ asset('bower_components/admin-lte/dist/img/credit/american-express.png') }}" alt="American Express">
                    <img src="{{ asset('bower_components/admin-lte/dist/img/credit/paypal2.png') }}" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">Betalen voor {{ $result->created_at->addWeeks(4)->format('d/m/y') }}</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotaal:</th>
                                <td>€{{ number_format($subtotal, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>BTW (21%)</th>
                                <td>€{{ number_format(0.21 * $subtotal, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Verzendkosten:</th>
                                <td>€25,00</td>
                            </tr>
                            <tr>
                                <th>Totaal:</th>
                                <td>€{{ number_format(1.21 * $subtotal, 2, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default" disabled><i class="fa fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success pull-right" disabled><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" disabled>
                        <i class="fa fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>



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