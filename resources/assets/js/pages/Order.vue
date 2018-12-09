<template>
    <div id="app">

        <div class="box">
            <div class="box-body">

                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Hol.com, Inc.
                            <small class="pull-right">Date: {{ order.created_at | formatDate }}</small>
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
                            <strong>{{ this.order.user.name }}</strong><br>
                            {{ this.order.address.street }} {{ this.order.address.number }}<br>
                            {{ this.order.address.zip_code }}, {{ this.order.address.city }}<br>
                            Telefoon: -------<br>
                            Email: {{ this.order.user.email }}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Factuur #{{ order.id }}</b><br>
                        <br>
                        <b>Bestelling ID:</b> {{ order.id }}<br>
                        <b>Betaling verloopt op:</b> 2/22/2014<br>
                        <b>Account:</b> {{ order.id }}
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

                            <tr v-for="(product,index) in order.products" v-bind:onload="addSubTotal(product)">
                                <td>{{ product.pivot.amount }}</td>
                                <td>{{ product.title }}</td>
                                <td>{{ product.id }}</td>
                                <td>{{ product.body }}</td>
                                <td>€{{ product.pivot.amount * product.price }} </td>
                            </tr>

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
                        <img src="/bower_components/admin-lte/dist/img/credit/visa.png" alt="Visa">
                        <img src="/bower_components/admin-lte/dist/img/credit/mastercard.png" alt="Mastercard">
                        <img src="/bower_components/admin-lte/dist/img/credit/american-express.png" alt="American Express">
                        <img src="/bower_components/admin-lte/dist/img/credit/paypal2.png" alt="Paypal">

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <p class="lead">Prijs Voor 2/22/2014</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotaal:</th>
                                    <td>€{{ subTotal }}</td>
                                </tr>
                                <tr>
                                    <th>BTW (21%)</th>
                                    <td>€{{ 0.21 * subTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Verzendkosten:</th>
                                    <td>€25,00</td>
                                </tr>
                                <tr>
                                    <th>Totaal:</th>
                                    <td>€{{ 1.21 * subTotal }}</td>
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

    </div>

</template>

<script>
    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: "Order",
        data() {
            return {
                subTotal: 0,
                errorMessages: [],
                order: null,
            }
        },
        created() {
            this.getOrder(this.$route.params.id);
        },
        methods: {
            getOrder(id) {
                axios.get(`/api/order/${id}`).then(result => {
                    this.order = result.data;
                    this.calculateSubTotal();
                }).catch((e) => {
                    this.errorMessages.push(e);
                })
            },
            addSubTotal(product) {
                this.subTotal += product.pivot.amount * product.price;
            }
        },
        filters: {
            formatDate: function (value) {
                if (value) {
                    return moment(String(value)).format('MM/DD/YYYY')
                }
            }
        }
    }

</script>

<style scoped>

</style>