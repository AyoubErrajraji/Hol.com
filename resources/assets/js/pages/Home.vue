<template>
    <div>

        <div class="col-md-12">
            <form>
                <div class="col-xs-4">
                    <input class="form-control" type="text" placeholder="Zoeken" v-model="search"/>
                </div>

                    <div class="col-xs-2">
                        Prijs Bereik
                    </div>
                    <div class="col-xs-3">
                        <input class="form-control" type="text" placeholder="Minimale Prijs" v-model="minPrice"/>
                    </div>
                    <div class="col-xs-3">
                        <input class="form-control" type="text" placeholder="Maximale Prijs" v-model="maxPrice"/>
                    </div>
            </form>
        </div>

        <br><br>

        <div class="col-md-12">
            <!-- Products -->
            <ProductComponent v-for="(product,index) in filteredList" v-bind:key="index" v-if="product.active && product.price > minPrice && product.price < maxPrice && index > paginateStart && index < paginateEnd "  :product="product"/>
        </div>

        <div class="col-md-12">
            <div class="col-xs-4">
                <button class="btn" @click="prevPage">Vorige Pagina</button>
                {{ paginateStart }} - {{ paginateEnd }}
                <button class="btn" @click="nextPage">Volgende Pagina</button>
            </div>
        </div>

    </div>
</template>

<script>
    import ProductComponent from '../components/ProductComponent'

    export default {
        name: 'home',
        components: {
            ProductComponent
        },
        data(){
            return  {
                search: '',
                minPrice: 0,
                maxPrice: 1000000,
                errorMessages: [],
                paginateStart: 0,
                paginateEnd: 15
            }
        },
        computed: {
            filteredList() {
                return this.shopProducts.filter(product => {
                    return product.title.toLowerCase().includes(this.search.toLowerCase())
                })
            },
            shopProducts() { return this.$store.getters.shopProducts; },
        },
        methods: {
            prevPage(){
                this.paginateStart -= 15;
                this.paginateEnd -= 15;
            },
            nextPage(){
                this.paginateStart += 15;
                this.paginateEnd += 15;
            }
        }
    }
</script>

<style>

</style>