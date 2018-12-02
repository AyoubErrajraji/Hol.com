<template>
    <div class="row">
        <div class="col-75">
            <div class="container">
                <form @submit.prevent="submit()" novalidate>

                    <div class="row">
                        <div class="col-50">

                            <h1>Bestelling gegevens formulier invullen</h1>

                            <label for="name"><i class="fa fa-user"></i>Naam</label>
                            <input type="text" id="name" name="name" v-model="name"  v-validate="'required|name'"
                                   :class="{'has-error': errors.has('name')}" placeholder="John M. Doe">

                            <span v-show="errors.has('name')" class="alert-danger help-block">
                                {{ errors.first('naam')}}</span>

                            <label for="email"><i class="fa fa-envelope"></i>Email</label>
                            <input type="text" id="email" name="email" v-model="email"  v-validate="'required|email'"
                                   :class="{'has-error': errors.has('email')}" placeholder="JohnDoe@voorbeeld.com">

                            <span v-show="errors.has('email')" class="alert-danger help-block">
                                {{ errors.first('email')}}</span>

                            <label for="address"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="address" name="address"  v-model="address" v-validate="'required|address'"
                                   :class="{'has-error': errors.has('address')}" placeholder="Wijnhaven 999">

                            <span v-show="errors.has('address')" class="alert-danger help-block">
                                {{ errors.first('address')}}</span>

                            <label for="city"><i class="fa fa-institution"></i>Woonplaats</label>
                            <input type="text" id="city" name="city" v-model="city" v-validate="'required|city'"
                                   :class="{'has-error': errors.has('city')}" placeholder="Rhoon">

                            <span v-show="errors.has('address')" class="alert-danger help-block">
                                {{ errors.first('city')}}</span>

                                <label for="zip"><i class="fa fa-address-card-o"></i> Postcode</label>
                                <input type="text" id="zip" name="zip" v-model="zip" v-validate="'required|zip'"
                                       :class="{'has-error': errors.has('zip')}" placeholder="1234AM">

                            <span v-show="errors.has('zip')" class="alert-danger help-block">
                                {{ errors.first('zip')}}</span>
                                </div>

                            </div>
                                <label>

                                <input type="checkbox" checked="checked" name="sameadr"> ik ga akkoord met de eisen die hol.com aan mij stelt.
                            </label>

                    <button @click="validate" class="btn">Bestellen</button>
                </form>
                </div>
        </div>
    </div>
</template>

        <script>

    import Vue from 'vue'
    import VeeValidate from 'vee-validate'

    Vue.use(VeeValidate);

    export default {
        name: "Checkout",
        data () {
            return {
                email: '',
                name: '',
                address: '',
                city: '',
                zip: ''
            }
        },
        methods: {
            submit() {
                if(!this.validate()) {
                    alert('Gegevens ingediend.')
                } else {
                    alert('Gegevens zijn niet ingediend.')
                }
            },
            validate() {
                this.$validator.validateAll();
                return this.errors.any()
            }
        }
    }
</script>

<style scoped>
    .row {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap; /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%; /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%; /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%; /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }
    .alert-danger {
        color: red;
    }
    .has-error {
        border-color: red;
    }
    .container {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #168fff;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        outline-color: #af0010;
    }

    span.price {
        float: right;
        color: grey;
    }

    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }
        .col-25 {
            margin-bottom: 20px;
        }
    }

</style>