<template>
    <div id="app">

        <h2>Mijn Bestellingen</h2>

        <div v-for="(order,index) in userDetails.orders" v-bind:key="index">
            <h4>{{ order.created_at | formatDate }} | Bestelnummer: {{ order.id }}</h4>

            <router-link :to="'../order/' + order.id">
                <div class="box box-warning" v-for="product in order.products">
                    <div class="box-body row">
                        <div class="col-md-2">
                            <img :src="product.image" style="max-width: 200px; max-height: 100px;">
                        </div>
                        <div class="col-md-9">
                            <h5>
                                {{ product.title }}
                            </h5>
                            <h5>
                                {{ product.pivot.amount }} stuks
                            </h5>
                            <h5 style="color: green;">
                                <b>{{ order.state.name }}</b>
                            </h5>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </router-link>

        </div>

    </div>

</template>

<script>
    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: "OrderHistory",
        computed: {
            user() {
                return this.$store.getters.user
            },
            userLoaded() {
                return this.$store.getters.userLoaded
            },
            userDetails() {
                return this.$store.getters.userDetails
            },
        },
        created() {
            console.log('Attempt details');
            this.getUserDetails(this.$route.params.id);
        },
        methods: {
            addUserDetails(data) {
                this.$store.dispatch('addUserDetails', data)
                    .then(() => console.log('Details added to store state'));
            },
            getUserDetails(id) {
                axios.get(`/api/user/${id}`).then(result => {
                    this.addUserDetails(result.data);
                }).catch((e) => {
                    this.errorMessages.push(e);
                })
            }
        },
        filters: {
            formatDate: function (value) {
                if (value) {
                    return moment(String(value)).format('DD/MM/YYYY')
                }
            },
        }
    }

</script>

<style scoped>

</style>