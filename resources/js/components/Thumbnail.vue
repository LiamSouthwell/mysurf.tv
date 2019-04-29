
<template>
    <div id="thumbs"
        <img :src="this.thumbnail" width="350" height="190"></img>
    </div>
</template>

<script>
export default {
    props: ['thumbnail', 'duration', 'created_at', 'title'],
}
</script>

<style scoped>
    img {
        border: solid black 2px;
    }
    #thumbs:hover > img {
        background-image: linear-gradient(black, rgba(255,0,0,0));
    }
</style>