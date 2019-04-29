
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
</style>