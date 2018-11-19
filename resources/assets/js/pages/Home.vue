<template>
    <div>

        <div class="col-md-12">
            <form>
                <div class="col-xs-4">
                    <input class="form-control" type="text" placeholder="Zoeken" v-model="search"/>
                </div>

                <div class="col-xs-3">
                    <label for="Alles">Kies een filter:</label>
                    <select id="Alles" v-model="order" v-on:change="addOrderBy(this.order)">
                        <option value='{"orderBy": "id","order": "asc"}'>Alles</option>
                        <option value='{"orderBy": "title","order": "asc"}'>A-Z</option>
                        <option value='{"orderBy": "title","order": "desc"}'>Z-A</option>
                        <option value='{"orderBy": "price","order": "asc"}'>prijs laag-hoog</option>
                        <option value='{"orderBy": "price","order": "desc"}'>prijs hoog-laag</option>
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
            <div v-if="productsLoaded">


                <!-- Products -->
                <ProductComponent v-for="(product,index) in filteredList" v-bind:key="index"
                                  v-if="product.active && product.price > minPrice && product.price < maxPrice && index >= paginateStart && index < paginateEnd "
                                  :product="product"/>
            </div>

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
    import ProductComponent from '../components/ProductComponent'
    import axios from 'axios'

    export default {
        name: 'home',
        components: {
            ProductComponent
        },
        data() {
            return {
                search: '',
                minPrice: 0,
                maxPrice: 1000000,
                errorMessages: [],
                paginateStart: 1,
                paginateEnd: 15,
                order: 'id'
            }
        },
        computed: {
            productsLoaded() {
                return this.$store.getters.shopProductsLoaded;
            },
            filteredList() {
                return this.shopProducts.filter(product => {
                    return product.title.toLowerCase().includes(this.search.toLowerCase())
                })
            },
            shopProducts() {
                return this.$store.getters.shopProducts;
            },
        },
        methods: {
            addProducts(data) {
                this.$store.dispatch('addProducts', data)
                    .then(() => console.log('Products added to store state'));
            },
            prevPage() {
                this.paginateStart -= 15;
                this.paginateEnd -= 15;
            },
            nextPage() {
                this.paginateStart += 15;
                this.paginateEnd += 15;
            },
            addOrderBy(orderby) {
                console.log(this.order);
                let order = JSON.parse(this.order);
                this.$store.dispatch('addOrderBy', order.orderBy);

                axios.get(`/api/products/${order.orderBy}/${order.order}`).then(result => {
                    this.addProducts(result.data);

                }).catch((e) => {
                    this.errorMessages.push(e);
                    console.error(e.message);
                })
            },
        }
    }
</script>

<style>

</style>