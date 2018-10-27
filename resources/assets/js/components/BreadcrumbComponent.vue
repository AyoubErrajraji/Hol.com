<template>
    <li v-if="routeName === 'home'"><i class="fa fa-home"></i> Home</li>
    <li v-else-if="routeName === 'veiling'"><i class="fa fa-gavel"></i> Veiling / {{ routeParams.slug }}</li>

</template>

<script>
    export default {
        name: "breadcrumb-component",
        computed: {
            routeName() {
                return this.$route.name;
            },
            routeParams() {
                return this.$route.params;
            }
        }
    }
</script>

<style>

</style>