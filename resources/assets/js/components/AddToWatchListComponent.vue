<template>
    <div class="card-token" v-if="isWatchlistLoaded">
        <a v-on:click="userClicked()">
            <i :class="[isAdInWatchlist ? 'fa fa-heart' : 'far fa-heart']" aria-hidden="true"></i>
        </a>
    </div>

    <!--<li id="dropdown-watchlist" class="dropdown user user-menu">-->
        <!--&lt;!&ndash; Menu Toggle Button &ndash;&gt;-->
        <!--<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
            <!--<i class="fas fa-star"></i> ({{ inCart.length }})-->
        <!--</a>-->
        <!--<ul class="dropdown-menu">-->

            <!--<li class="user-body" v-for="(cartitem,index) in inCart" v-bind:key="index">-->
                <!--<div class="pull-left">-->
                    <!--<img :src="cartitem.product.image" class="cart-item-image">-->
                    <!--{{ cartitem.product.title }}-->
                    <!--<p><b> €{{ cartitem.product.price + ",-" }} </b></p>-->
                <!--</div>-->
                <!--<div class="pull-right">-->
                    <!--<button class="btn btn-sm btn-danger"v-on:click="removeFromCart(index)">Verwijder product</button>-->
                <!--</div>-->

            <!--</li>-->
            <!--<li class="user-footer">-->
                <!--Totaal: €<b>{{total}},-</b>-->
                <!--<router-link to="/cart">Bekijk hele winkelwagen</router-link>-->
            <!--</li>-->
        <!--</ul>-->
    <!--</li>-->
</template>

<script>
    export default {
        name: "watchlist-component",
        props: ['user_id', 'ad_id'],
        data() {
            return {
                watchlistItem: {
                    user_id: this.user_id,
                    ad_id: this.ad_id
                }
            }
        },
        computed: {
            isWatchlistLoaded() {
                return this.$store.getters.watchlistLoaded;
            },
            isAdInWatchlist() {
                return this.$store.getters.isAdInWatchlist(this.ad_id);
            }
        },
        methods: {
            userClicked() {
                if (this.isAdInWatchlist) {
                    this.deleteFromWatchlist();
                } else {
                    this.addToWatchList();
                }
            },
            addToWatchList() {
                this.start();
                axios.post('/api/watchlistitem', this.watchlistItem)
                    .then(res => {
                        this.$store.dispatch('addWatchlistItem', res.data)
                            .then(() => console.log('Watchlist item added to store state'));
                        this.finish();
                    })
                    .catch(err => {
                        console.log(err);
                        this.fail();
                    });
            },
            deleteFromWatchlist() {
                this.start();
                const item = this.$store.getters.getWatchlistItemByAdId(this.ad_id);
                axios.delete(`/api/watchlistitem/${item.id}`)
                    .then(() => {
                        this.$store.dispatch('deleteWatchlistItem', item.id)
                            .then(() => console.log('Watchlist item deleted from store state'));
                        this.finish()
                    })
                    .catch(err => {
                        console.log(err);
                        this.fail()
                    });
            },
            start () {
                this.$Progress.start()
            },
            increase (num) {
                this.$Progress.increase(num)
            },
            finish () {
                this.$Progress.finish()
            },
            fail () {
                this.$Progress.fail()
            },
        }
    }
</script>

<style scoped>

</style>
