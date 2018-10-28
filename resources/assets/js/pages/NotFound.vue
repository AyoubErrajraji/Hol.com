<template>
    <div class="bg-black">
        <div class="code-area">
            <span style="color: #777;font-style:italic;">// 404 page not found.</span>
            <span>
                <span style="color:#d65562;">if </span>
	            (<span style="color:#4ca8ef;">!</span><span style="font-style: italic;color:#bdbdbd;">found</span>) {
            </span>
            <span>
                <span style="padding-left: 15px;color:#2796ec">
                    <i style="width: 10px;display:inline-block"></i>throw
                </span>
                <span>(<span style="color: #a6a61f">"(╯°□°)╯︵ ┻━┻"</span>);</span>
	            <span style="display:block">}</span>
                <span style="color: #777;font-style:italic;">// <router-link to="/">Go home!</router-link></span>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'notfound'
    }
</script>

<style scoped>
    .code-area > span {
        display: block;
    }
    .code-area {
        position: absolute;
        width: 320px;
        min-width: 320px;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        font-family: "Courier New"
    }
</style>