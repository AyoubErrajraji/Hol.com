<template>
    <div>

        <h4 class="text1">Winkelwagen</h4>
        <div v-for="(product,index) in inCart" v-bind:key="index">
            <img :src="product.image" class="cart-item-image">
            {{ product.title }}
            <button class="btn btn-sm btn-danger" @click="removeFromCart(index)">&times;</button>
            <b-dropdown-divider></b-dropdown-divider>

        </div>
        <router-link to="/"><b-button variant="outline-primary" class="button1">< Verder met winkelen</b-button></router-link>
        <router-link to="/checkout"><b-button variant="outline-success" class="button2"> > Verder met bestellen</b-button></router-link>


    </div>
</template>

<script>
    import CartComponent from '../components/CartComponent'

    export default {
        name: "Cart",
        components: {
            CartComponent
        },
        computed: {
            inCart() { return this.$store.getters.inCart; },
            user() { return this.$store.getters.user },
        },
        methods: {
            removeFromCart(invId) {
                this.$store.dispatch('removeFromCart', invId);

            },
        }
    }

</script>

<style scoped>
    .text1{

        margin: 0px 0px 0px 25px;
        font-weight: bold;


    }

    .MoveText{

        margin: 20px 800px 10px 10px;


    }

    .button1{

        margin: 300px 100px  0px 1050px;
    }

    .button2{

        margin: 150px 100px 0px 1050px;
    }

    h1 {
        left: 100px;

    }

    h2 {
        left: 100px;
        min-width: 20em;
        margin: 30px;
        padding: 0;
        font-family: "Open Sans",Arial,Helvetica,sans-serif;
        font-size: 100%;
        line-height: 1.5;
        background-color: #fff;
        color: #31312f;
    }

</style>