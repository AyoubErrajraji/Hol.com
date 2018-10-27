<template>
    <li class="dropdown tasks-menu" v-if="isProductsLoaded || true">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-shopping-cart"></i>
            <span class="label label-danger">{{ cart.length }}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">Er zitten {{ cart.length }} product(en) in je winkelwagen</li>
            <li>
                <ul class="menu">
                    <li v-for="item in cart"><!-- Task item -->
                        <a>
                            <!-- Task title and progress text -->
                            <h3>
                                {{ item.title }}
                            </h3>
                            <div>
                                Body
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                </ul>
            </li>
            <li class="footer">
                <a>Bekijk alle producten in je winkelwagen</a>
            </li>
        </ul>
    </li>
    <!-- Inner menu: contains the tasks -->
</template>

<script>
    import axios from 'axios'
    import Countdown from '@xkeshi/vue-countdown'

    export default {
        name: "cart-component",
        components: {},
        props: ['user'],
        computed: {
            _user() {
                if (this.user) {
                    return JSON.parse(this.user)
                } else {
                    return null
                }
            },
            isProductsLoaded() {
                return this.$store.getters.productsLoaded;
            },
            cart() { return this.$store.getters.cart; },
        },
        created() {
            this.$store.dispatch('addUser', this._user)
                .then(() => {
                    console.log('User added to store state');
                });
        },
        methods: {
            removeFromCart(invId) {
                this.$store.dispatch('removeFromCart', invId);

            },
        }
    }
</script>

<style>

</style>