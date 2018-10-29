<template>
    <div>

        <div class="col-md-12">
            <form>
                <div class="col-xs-4">
                    <input class="form-control" type="text" placeholder="Search" v-model="search"/>
                </div>

                <div class="col-xs-2">
                    Price Range
                </div>
                <div class="col-xs-3">
                    <input class="form-control" type="text" placeholder="Min Price" v-model="minPrice"/>
                </div>
                <div class="col-xs-3">
                    <input class="form-control" type="text" placeholder="Max Price" v-model="maxPrice"/>
                </div>
            </form>
        </div>

        <br><br>

        <div class="col-md-12">
            <!-- Products -->
            <ProductComponent v-for="(product,index) in filteredList" v-bind:key="index" v-if="product.active && product.price > minPrice && product.price < maxPrice"  :product="product"/>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'
    import ProductComponent from '../components/ProductComponent'

    export default {
        name: 'category',
        components: {
            ProductComponent
        },
        data(){
            return  {
                search: '',
                minPrice: 0,
                maxPrice: 1000000,
                errorMessages: [],
                productList: [],
            }
        },
        computed: {
            filteredList() {
                return this.productList.filter(product => {
                    return product.title.toLowerCase().includes(this.search.toLowerCase())
                })
            },
        },
        mounted() {
            axios.get(`/api/category/${this.$route.params.id}`, {
            }).then(result => {
                this.productList = result.data.products;
            }).catch((e) => {
                this.errorMessages.push(e);
            })
        },
    }

</script>

<style>

</style>