<template>

    <li id="dropdown-cart" class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shopping-cart"></i> ({{ inCartAmount() }})
        </a>
        <ul class="dropdown-menu">

            <li class="user-body" v-for="(cartitem,index) in inCart" v-bind:key="index" v-if="cartitem.amount > 0">
                <div class="pull-left">
                    <img :src="cartitem.product.image" class="cart-item-image">
                    <button class="btn btn-sm btn-danger"v-on:click="removeFromCart(index)">Verwijder product</button>
                    <p>{{ cartitem.amount }}x {{ cartitem.product.title }}</p>
                    <p><b> €{{ cartitem.product.price + ",-" }} </b></p>
                </div>

            </li>
            <li class="user-footer">
                Totaal: €<b>{{total}},-</b>
                <router-link to="/cart">Bekijk hele winkelwagen</router-link>
            </li>
        </ul>
    </li>


</template>

<script>
    import axios from 'axios'

        export default {
            name: 'cart-component',
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
                total() {
                    var i;
                    var totalPrice = 0;
                    for (i = 0; i < this.inCart.length; i++) {
                        totalPrice += this.inCart[i].amount * this.inCart[i].product.price;
                    }
                    return totalPrice;
                },
            },
            mounted() {
                this.$store.dispatch('addUser', this._user)
                    .then(() => console.log('User added to store state'));
            },
            created() {
                axios.get(`/api/products/${this.orderBy}`).then(result => {
                    this.addProducts(result.data);
                }).catch((e) => {
                    this.errorMessages.push(e);
                })


                axios.get(`/api/cartitem`).then(result => {
                    var i;
                    for (i=0; i<result.data.length; i++){
                        this.addToCartFromDb(result.data[i]);
                    }
                }).catch((e) => {
                    this.errorMessages.push(e);
                })

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
                    }, 5);
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

<style>
    .cart-item-image {
        height: 100px;
        width: 100px;
    }
</style>