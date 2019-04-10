<template>
    <nav class="navbar navbar-expand-sm navbar-dark mb-2">
        
            <a href="#" class="navbar-brand"><img src="/images/mysurftvlogo.png" width="35" ></a>
            <h3> Surfing Australia </h3>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#searchBar">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">Playlists</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Latest</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Trending</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Links</a>
                </li>
            </ul>
            </div>


            <div class="collapse navbar-collapse" id="searchBar">
                <div class="active-cyan-3 active-cyan-4">
                    <input id="searchTerms" class="form-control search" type="text" placeholder="Search" aria-label="Search">
                    <button class="searchbtn btn" @click="search()"> Go </button>
                </div>
            </div>
        
    </nav>
</template>
<script>

module.exports = {
    data: function () {
        return {
            data: 'hello',
        }
    },

    methods: {
    search: function() {
      console.log("Hello?");

        axios
            .post('/search', {terms: document.getElementById("searchTerms").value})
            .then((response => {
                console.log(response.data)
            }));
    }
  }
}


</script>
<style scoped>
h3{
    font-size: 18px;
    color: rgb(45, 63, 81);
    margin: auto;
    font-weight: 900;
}

 .navbar-toggler{
    color:rgb(45, 63, 81);
 }
#navbarMenu{
    color: rgb(43,63,81);
}

 .navbar{
background-image: url('/images/mysurftvmainmenubg.png');
 }

.nav-link{
    color: rgb(43,63,81) !important;
    font-weight: 650;
}
.search{
    width: 85%;
    float: left;
}
.searchbtn{
    margin-left: 5px;
    background-color: rgb(43,63,81);
    color: white;
}
</style>