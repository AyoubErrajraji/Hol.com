<template>
    <div>

        <div class="col-md-12">
            <form>
                <div class="col-xs-4">
                    <input class="form-control" type="text" placeholder="Zoeken" v-model="search"/>
                </div>

                <div class="col-xs-3">
                    <label for="Alles">Kies een filter:</label>
                    <select id="Alles">
                        <option value="Alles">Alles</option>
                        <option value="A-Z">A-Z</option>
                        <option value="Z-A">Z-A</option>
                        <option value="minPrice">prijs laag-hoog</option>
                        <option value="maxPrice">prijs hoog-laag</option>
                    </select>
                </div>

                <div class="col-xs-2">
                    <label class="control-label form-control">Prijs Bereik</label>
                </div>


                <div class="col-xs-3">
                    <div class="input-group">
                        <span class="input-group-addon">€</span>
                        <input class="form-control" type="text" placeholder="Minimale Prijs" v-model="minPrice"/>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <span class="input-group-addon">€</span>
                        <input class="form-control" type="text" placeholder="Maximale Prijs" v-model="maxPrice"/>
                    </div>
                </div>
            </form>
        </div>

        <br><br>

        <div class="col-md-12">
            <!-- Products -->
            <ProductComponent v-for="(product,index) in filteredList" v-bind:key="index"
                              v-if="product.active && product.price > minPrice && product.price < maxPrice && index >= paginateStart && index < paginateEnd "
                              :product="product"/>
        </div>

        <div class="col-md-12">
            <div class="col-xs-4">
                <button class="btn" @click="prevPage">Vorige Pagina</button>
                {{ paginateStart }} - {{ paginateEnd }} van de {{ filteredList.length }} items
                <button class="btn" @click="nextPage">Volgende Pagina</button>
            </div>
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
                paginateStart: 1,
                paginateEnd: 15
            }
        },
        computed: {
            filteredList() {
                return this.productList.filter(product => {
                    return product.title.toLowerCase().includes(this.search.toLowerCase())
                })
            },
        }, beforeRouteUpdate(to) {

            console.log(to.params.id);
            this.id = to.params.id;
            console.log(this.$route.params.id);
            axios.get(`/api/category/${to.params.id}`, {
            }).then(result => {
                this.productList = result.data.products;
                console.log(this.productList);
            }).catch((e) => {
                this.errorMessages.push(e);
            });
        },
        mounted() {
            axios.get(`/api/category/${this.$route.params.id}`, {
            }).then(result => {
                this.productList = result.data.products;
                console.log(this.productList);

            }).catch((e) => {
                this.errorMessages.push(e);
            });

        },
        methods: {
            prevPage() {
                this.paginateStart -= 15;
                this.paginateEnd -= 15;
            },
            nextPage() {
                this.paginateStart += 15;
                this.paginateEnd += 15;
            },

        }
    }

</script>

<style>

</style>