<template>
    <div>
        {{ this.approves.length }}
    </div>
</template>

<script>
    export default {
        name: "approve-count-component",
        computed: {
            approves() {
                return this.$store.getters.getApproves;
            },
        },
    }
</script>

<style scoped>

</style>