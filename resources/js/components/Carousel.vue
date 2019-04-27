
<template>
    <div id="carousel" data-options="mode: carousel; height: 210px;">
    <p id="header">Choose from our range of playlists!</p>
        <button id="leftBtn"><span class="fa fa-chevron-left"></span></button>
        <img src="/images/playBtn.png" width="350" height="190"></img>
        <img src="/images/playBtn.png" width="350" height="190"></img>
        <img src="/images/playBtn.png" width="350" height="190"></img>
        <button id="rightBtn"><span class="fa fa-chevron-right"></span></button>
        <img src="/images/playBtn.png" width="350" height="190"></img>
        <img src="/images/playBtn.png" width="350" height="190"></img>
        <img src="/images/playBtn.png" width="350" height="190"></img>
    </div>  
</template>

<style scoped>

    #header {
        font-weight: bold;
    }

    #carousel {
        position: relative;
        overflow: auto;
        white-space: nowrap;
        padding: 5px;
        margin: 10px;
    }

    #leftBtn, rightBtn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    img {
        border: solid black 2px;
    }
</style>