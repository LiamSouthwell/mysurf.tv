<template>
    <nav class="navbar navbar-expand-lg navbar-dark mb-2">
        
            <router-link to="/"><div class="navbar-brand"><img id="logo"  src="/images/mysurftvlogo.png" width="50" height="50" ></div></router-link>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#searchBar">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/"><p class="nav-link">Playlists</p> </router-link>
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
                    <input id="searchTerms" class="form-control search" type="text" placeholder="What are you looking for?" aria-label="Search">
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
      this.$router.push({path: '/search/' + document.getElementById("searchTerms").value})
    }
  }
}


</script>
<style scoped>

h3{
    font-size: 18px;
    color: white;
    margin: auto;
    font-weight: 900;
}

.navbar-toggler{
    color: white;
    border: none;
 }

#navbarMenu{
    color: white;
}

.navbar{
    background-image: url('/images/mysurftvmainmenubg.png');
    background-size: cover;
    background-repeat: no-repeat;
}

.navbar-nav {
    text-align: right;
}

.nav-link{
    color: white !important;
    font-weight: 650;
}

.search{
    width: 78%;
    float: left;
}

.searchbtn{
    margin-left: 2px;
    background-color: rgb(43,63,81);
    color: white;
    width: 20%;
}

#searchTerms {
    background-color: #dddddd;
    color: white;
}
 
 @media only screen and (min-width: 600px) {
    #searchBar {
    position: absolute;
    right: 5px;
    }

    #searchTerms {
        font-size: 12px;
    }

    #logo {
        width: 70px;
        height: 70px;
    }
 }

</style>