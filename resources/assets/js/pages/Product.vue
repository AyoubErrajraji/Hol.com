<template>
    <div>
        <div class="box box-solid">
            <div class="box-body">
                <div class="col-md-12">
                    <h2>{{ product.title }}</h2>
                </div>

                <div class="col-md-6">
                    <img :src="product.image" style="width: 300px; height: 200px;"/>
                </div>

                <div class="col-md-6">

                    <h2>€{{ product.price }}</h2>
                    <button class="btn-apricot" @click="addToCart(product)"> Winkelwagen </button>

                </div>

                <div class="col-md-12">
                    <p>
                        {{ product.body }}
                    </p>
                </div>

                <div class="col-md-12">
                    <img src="/img/beoordeling.jpg" style="width: 400px; height: 300px;" >
                    <h5>€{{ product.reviews }}</h5>
                </div>
            </div>
        </div>

        <div class="box box-solid" v-for="cat in product.categories">
            <div class="box-body">
                <div class="col-md-12">
                    <h2>Anderen bekeken ook</h2>
                        <!-- Products -->
                        <ProductComponent v-for="(product,index) in cat.products" v-bind:key="index" v-if="product.active && index < 3" :product="product"/>

                </div>
            </div>
        </div>

    </div>
</template>

<script>

    import axios from 'axios'
    import ProductComponent from"../components/ProductComponent"

    export default {
        name: 'product',
        components:{
            ProductComponent

        },
        data(){
            return  {
                product: [],
                product_category: [],
                errorMessages: []
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
        created() {
            axios.get(`/api/product/${this.$route.params.id}`, {
            }).then(result => {
                this.product = result.data;
            }).catch((e) => {
                this.errorMessages.push(e);
            })


        },
    }
</script>
<style>
    .btn-apricot {
        background-color: #F7882F;
        color: white;
    }
    .btn-blueberry {
        background-color: #6B7A8F;
        color: white;
    }
</style>