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
                    <button class="btn-apricot" @click="addToCart(product)">Add to Cart</button>
                </div>

                <div class="col-md-12">
                    <p>
                        {{ product.body }}
                    </p>
                </div>

                <div class="col-md-12">
                    <img src="/img/beoordeling.jpg" style="width: 400px; height: 300px;" >
                </div>
            </div>
        </div>

        <div class="box box-solid ">
            <div class="box-body">
                <div class="col-md-12">
                    <h2>Anderen bekeken ook</h2>
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
        data(){
            return  {
                product: [],
                errorMessages: []
            }
        },

        components:{
          ProductComponent

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

</style>