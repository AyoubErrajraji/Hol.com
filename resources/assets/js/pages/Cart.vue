<template>
    <div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Winkelwagen</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">

                    <div v-for="(cartitem,index) in inCart" v-bind:key="index">
                        <h4><b>{{cartitem.product.title}}</b></h4>

                        <h4><b>Prijs: €{{cartitem.product.price }}</b></h4>

                        <ul class="items">
                            <li class="item">
                                <div class="item-preview">
                                    <img :src="cartitem.product.image" class="cart-item-image item-thumbnail">
                                    <div>
                                        <h2 class="item-title"></h2>
                                        <p class="item-description"></p>
                                        <b>Aantal:</b> <input type="number" min="0" max="999" name="quantity" :value="cartitem.amount" disabled>
                                        <span class="item-price"></span>
                                        <button class="btn btn-sm btn-danger"v-on:click="removeFromCart(index)">Verwijder product</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="box-footer clearfix">
                        <router-link to="/"><a href="javascript:void(0)" class="btn btn-sm btn-info btn-primary">< Verder met winkelen</a></router-link>
                        <router-link to="/checkout"><a href="javascript:void(0)" class="btn btn-sm btn-success pull-right"> > Verder met bestellen</a></router-link>

                        <table style="width: 100%;">
                            <tr>
                                <td>Subtotaal: €{{Subtotal}},- <span class="cart-price cart-total"></span></td>
                                <td>BTW(21%): €{{BTW}},- <span class="cart-price cart-total"></span></td>
                                <td>Totaal: €{{totalBTW}},-<span class="cart-price cart-total"></span></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        name: 'Cart',
        data(){
            return{
                products:[]
            }
        },
        computed: {
            _user() {
                if (this.user) {
                    return JSON.parse(this.user)
                } else {
                    return null
                }
            },
            inCart() {
                return this.$store.getters.inCart;
            },
            orderBy() {
                return this.$store.getters.orderBy;
            },
            totalBTW() {
                var i;
                var totalPrice = 0;
                for (i = 0; i < this.inCart.length; i++) {
                    totalPrice += this.inCart[i].amount * this.inCart[i].product.price;
                }
                return totalPrice;
            },
            BTW() {
                var i;
                var totalPrice = 0;
                for (i = 0; i < this.inCart.length; i++) {
                    totalPrice += this.inCart[i].amount * this.inCart[i].product.price;
                }
                return (totalPrice * 0.21);
            },
            Subtotal() {
                var i;
                var totalPrice = 0;
                for (i = 0; i < this.inCart.length; i++) {
                    totalPrice += this.inCart[i].amount * this.inCart[i].product.price;
                }
                return totalPrice - (totalPrice * 0.21);
            },
        },
        mounted() {
            this.$store.dispatch('addUser', this._user)
                .then(() => console.log('User added to store state'));
        },
        methods: {
            addProducts(data) {
                this.$store.dispatch('addProducts', data)
                    .then(() => console.log('Products added to store state'));
            },
            removeFromCart(invId) {
                this.$store.dispatch('removeFromCart', invId)
                    .then(() => console.log('Cart has been removed from the store state'));

                setTimeout(function(){
                    $("#dropdown-cart").addClass("open");
                }, 200);
            },
            addToCart(invId) {
                this.$store.dispatch('addToCart', invId);
            },
            addToCartFromDb(invId) {
                this.$store.dispatch('addToCartFromDb', invId);
            },
            inCartAmount() {
                var i;
                var amount = 0;
                for (i = 0; i < this.inCart.length; i++) {
                    amount += this.inCart[i].amount * 1;
                }
                return amount;
            },
        },
    }
</script>

<style scoped>
    body {
        margin: 0;
        background: #fdca40;
        padding: 30px;
    }


    .items {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .cart-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 7px 400px 0px 400px;
        font-size: 130%;
        font-weight: bold;
        color: rgba(51, 58, 69, 0.8);
    }
    .cart-price {
        color: #333a45;
    }
    .cart-total {
        font-size: 200%;
    }

    .item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 2px solid rgba(51, 58, 69, 0.1);
    }
    .item-preview {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .item-thumbnail {
        margin-right: 20px;
        border-radius: 3px;
        justify-content: space-between;
    }
    .item-title {
        margin: 0 0 10px 0;
        font-size: inherit;
        font-weight: bold;
    }
    .item-description {
        margin: 0;
        color: rgba(51, 58, 69, 0.6);
    }
    .item-quantity {
        max-width: 30px;
        padding: 8px 12px;
        color: rgba(51, 58, 69, 0.8);
        border: 2px solid rgba(51, 58, 69, 0.1);
        border-radius: 3px;
    }
    .item-price {
        margin-left: 20px;
    }
    .text1{

        margin: 0px 0px 0px 25px;
        font-weight: bold;


    }

    .MoveText{

        margin: 20px 800px 10px 10px;


    }

    .button1{

        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 15px 100px  0px 1250px;
    }
    .button1:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    .button2:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    .button2{
        background-color: #008CBA; /* Green */
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px 100px 0px 1250px;
    }

</style>