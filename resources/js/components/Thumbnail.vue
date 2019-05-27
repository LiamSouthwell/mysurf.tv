
<template>
	<div class="video">
        <img :src="this.thumbnail" ></img>
	</div>
</template>

<script>
export default {
    props: ['thumbnail', 'duration', 'created_at', 'title', 'description'],
}
</script>

<style scoped>
	img{
    max-width: 640px;

    max-height: 370px;
	}

	.video{
		height: 100%;
		width: 100%;
	}
@media only screen and (max-width: 1100px) {
  img {
    max-width: 365px;
    max-height: 205px;
  }
}
</style>