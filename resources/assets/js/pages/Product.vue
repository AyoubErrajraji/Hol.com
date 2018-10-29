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

        <div class="col-md-12">
            <!-- Products -->
            <ProductComponent v-for="(product,index) in filteredList" v-bind:key="index" v-if="product.active && product.price > minPrice && product.price < maxPrice && index > paginateStart && index < paginateEnd "  :product="product"/>
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

            // axios.get(`/api/category/${this.$route.params.id}`, {
            // }).then(result => {
            //     this.product = result.data;
            // }).catch((e) => {
            //     this.errorMessages.push(e);
            // })
        },



    }
</script>
<style>

</style>