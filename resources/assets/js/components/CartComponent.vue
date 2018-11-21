<template>

    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-shopping-cart"></i> ({{ inCart.length }})
        </a>
        <ul class="dropdown-menu">

            <li class="user-body" v-for="(product,index) in inCart" v-bind:key="index">
                <div class="pull-left">
                    <img :src="product.image" class="cart-item-image">
                    {{ product.title }}
                    <p><b> €{{ product.price }} </b></p>
                </div>
                <div class="pull-right">
                    <button class="btn btn-sm btn-danger" @click="removeFromCart(index)">&times;</button>
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

    export default {
        name: 'cart-component',
        computed: {
            _user() {
                if (this.user) {
                    return JSON.parse(this.user)
                } else {
                    return null
                }
            },
            total() {
                return this.$store.getters.inCart.reduce(function (sum, item) {
                    return sum + item.price
                }, 0)
            },
            inCart() { return this.$store.getters.inCart; },
            orderBy() { return this.$store.getters.orderBy; },
        },
        mounted(){
            this.$store.dispatch('addUser', this._user)
                .then(() => console.log('User added to store state'));
        },
        created() {
            axios.get(`/api/products/${this.orderBy}`).then(result => {
                this.addProducts(result.data);
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
                this.$store.dispatch('removeFromCart', invId);

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