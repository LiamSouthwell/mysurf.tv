<template>
    <div class="social">
        <p>Join Us</p>
        <div class="facebook">
            <a href="https://www.facebook.com/surfingaustraliainc/">
                <img src="/images/fblogo.png" width="60px" height="60px">
            </a>
        </div>
        <div class="instagram">
            <a href="https://www.instagram.com/surfingaus/">
                <img src="/images/iglogo.png" width="60px" height="60px">
            </a>
        </div>
        <div>
            All content © 2019: <a href="https://www.surfingaustralia.com/">Surfing Australia</a>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
    .social {
        position: relative;
        display: inline-block;
        bottom: 0;
        width: 100%;
        height: 110px;
        text-align: center;
        font-weight: bold;
    }

    .facebook {
        display: inline-block;
        margin: auto;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 5px;
        padding-right: 5px;
    }

    .instagram {
        display: inline-block;
        margin: auto;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 5px;
        padding-right: 5px;
    }
</style>