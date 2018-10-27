<template>
    <div>
        Product
    </div>
</template>

<script>

    export default {
        name: "product-component",
        props: ['ad', 'index'],
        computed: {
            user() {
                return this.$store.getters.user;
            },
        },
    }
</script>

<style>

</style>