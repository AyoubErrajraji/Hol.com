<template>

    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-shopping-cart"></i> ({{ inCart.length }})
        </a>
        <ul class="dropdown-menu">

            <li class="user-body" v-for="(cartitem,index) in inCart" v-bind:key="index">
                <div class="pull-left">
                    <img :src="cartitem.product.image" class="cart-item-image">
                    {{ cartitem.product.title }}
                    <p><b> €{{ cartitem.product.price + ",-" }} </b></p>
                </div>
                <div class="pull-right">
                    <button class="btn btn-sm btn-danger"v-on:click="removeFromCart(index)">Verwijder product</button>
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
                    return this.$store.getters.inCart.reduce(function (sum, item) {
                        return Math.round(sum + item.price)
                    }, 0)
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
                },
                addToCart(invId) {
                    this.$store.dispatch('addToCart', invId);
                },
                addToCartFromDb(invId) {
                    this.$store.dispatch('addToCartFromDb', invId)
                        .then(() => console.log('bladibla'));

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