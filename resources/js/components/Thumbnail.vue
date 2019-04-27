
<template>

        <img :src="this.thumbnail" width="350" height="190"></img>

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
</style>