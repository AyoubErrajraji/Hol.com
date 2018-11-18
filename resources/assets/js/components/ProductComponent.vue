<template>
    <div class="col-md-4">
        <div class="box box-solid ">
            <div class="box-header with-border">
                <h3 class="box-title">{{ product.title }}</h3>
            </div>
            <div class="box-body text-center">
                <img :src="product.image ">
                <p>€{{product.price}}       </p>
                <hr>
                <button class="btn btn-apricot" @click="addToCart(product)">Winkelwagen</button>
                <router-link class="btn btn-blueberry" :to="{name: 'Product', params: {id: product.id} }">Lees meer</router-link>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "ProductComponent",
        props: {
            product: {
                required: true,
                type: Object
            }
        },
        filters: {
            toString: function (value) {
                if (!value) return '';
                return value.toString()
            }
        },
        methods: {
            addToCart(invId) {
                this.$store.dispatch('addToCart', invId);
            },
        },
        computed: {
            inCart() { return this.$store.getters.inCart; },
        },
    }
</script>

<style>
    .card-image {
        width: 100%;
    }
    .btn-apricot {
        background-color: #F7882F;
        color: white;
    }
    .btn-blueberry {
        background-color: #6B7A8F;
        color: white;
    }
</style>