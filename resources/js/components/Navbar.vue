<template>
    <nav class="navbar navbar-expand-lg navbar-dark mb-2">
        
            <router-link to="/"><div class="navbar-brand"><img id="logo"  src="/images/mysurftvlogo.png" width="50" height="50" ></div></router-link>
            <button class="navbar-toggler" id="srchBtn" data-toggle="collapse" data-target="#searchBar"  @click="hideMenu">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>

            <button class="navbar-toggler" id="barsBtn" data-toggle="collapse" data-target="#navbarMenu" @click="hideSearch">
                <span class="fa fa-bars"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item" v-if="this.user != null">
                    <a class="nav-link">Welcome, {{this.user.name}}</a>
                </li>
                <li class="nav-item">
                    <a href="/login" v-if="this.user == null" class="nav-link">Login</a>
                </li>

                <li class="nav-item">
                    <router-link to="/latest" class="nav-link">Latest</router-link>
                </li>
                </li>
                <li class="nav-item">
                    <router-link to="/trending" class="nav-link">Trending</router-link>
                </li>
                <li class="nav-item" v-if="this.user != null">
                    <router-link to="/userplaylists" class="nav-link">My Playlists</router-link>
                </li>
                <li class="nav-item">
                    <div id="darkMode">
                        <span id="darkTitle">Dark Mode</span>
                        <label class="switch">
                            <input type="checkbox" @click="toggleClass()">
                            <span class="slider round"></span>
                        </label>
		            </div>
                </li>
                <li class="nav-item" v-if="this.user != null">
                    <a href="/logout" class="nav-link">Logout</a>
                </li>
            </ul>
            </div>

            <div class="collapse navbar-collapse" id="searchBar">
                <div class="active-cyan-3 active-cyan-4" id="srch"> 
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
            isActive: false
        }
    },
    props: ['user'],

    methods: {
    search: function() {
      this.$router.push({path: '/search/' + document.getElementById("searchTerms").value})
    },
    toggleClass: function() {
        if(this.isActive){
            this.isActive = false;
            console.log("Turning dark mode off");
            document.body.style.backgroundColor = "#e6e6e6";
            document.body.style.color = "#212529";
            document.getElementById("header").style.color = "#2d3f51";
        } else {
            this.isActive = true;
            console.log("Turning dark mode on");
            document.body.style.backgroundColor = "#161f28";
            document.body.style.color = "#F1F1F2";
            document.getElementById("header").style.color = "#F1F1F2";
            document.getElementById("vidBtns").style.color = "#212529";
        }
    },
    hideSearch: function(){
        $('#searchBar').collapse("hide");
    },
    hideMenu: function(){
        $('#navbarMenu').collapse("hide");
    }
  }
}


</script>
<style scoped>

.navbar-toggler{
    color: #C4DFE6;
    border: 1px solid white;
    border-radius: 25px;
    background-color: #2d3f51;
    width: 44x;
    height: 44px;
 }

.navbar{
    padding-top: 40px;
    background-image: url('/images/mysurftvmainmenubg.png');
    background-size: 100% 76px;
    background-repeat: no-repeat;
    background-position: center top;
    background-color: #dedbdb;
}

ul {
    margin-top: 10px;
}

#srchBtn {
    position: absolute;
    right: 60px;
    top: 13px;
}

#logo {
    position: absolute;
    top: 10px;
}


#barsBtn {
    position: absolute;
    top: 13px;
    right: 10px;
}

#srch {
    margin-top: 10px;
}

.navbar-nav {
    text-align: right;
}

.nav-link{
    color: #F1F1F2 !important; 
    font-weight: 650;
}

.nav-link:hover, .nav-link:focus {
    color: #2d3f51 !important;
}

.search{
    width: 78%;
    float: left;
}

.searchbtn{
    margin-left: 2px;
    background-color: #2d3f51;
    color: white;
    width: 20%;
}

#searchTerms {
    height: 38px;
    background-color: #F1F1F2;
    color: #1995AD;
}
 
 @media only screen and (min-width: 600px) {
    #searchBar {
    position: absolute;
    right: 5px;
    top: 75px;
    }

    #searchTerms {
        font-size: 12px;
    }

    #logo {
        width: 60px;
        height: 60px;
        position: absolute;
        top: 5px;
    }
 }

 .switch {
  position: absolute;
  width: 60px;
  height: 34px;
  right: 2px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

#darkMode {
	height: 20px;
	width: 100%;
	position: relative;
	text-align: right;
	right: 0;
}

#darkTitle {
    font-weight: bold;
	position: absolute;
	right: 68px;
	margin-top: 5px;
}

#toggleLabels {
    font-weight: bold;
	text-align: right;
}

 @media only screen and (min-width: 991px) {
     .navbar {
         background-size: cover;
         color: #F1F1F2 !important;
         height: 80px;
     }

     .navbar-nav {
         position: absolute;
         left: 100px;
     }

     .nav-link{
        color: #F1F1F2 !important; 
        font-weight: 650;
        padding-bottom: 50px;
    }

     #logo {
        width: 80px;
        height: 80px;
    }

     #searchBar {
        position: absolute;
        right: 5px;
        top: 15px;
    }

     #darkMode {
         position: relative;
         width: 160px;
     }

     #darkTitle {
         display: inline-block;
         float: right;
         top: 3px;
         color: #F1F1F2;
     }
 }

@media only screen and (max-width: 991px) {
    .nav-link{
    color: black !important;
    font-weight: 650;
}
    .navbar-toggler {
        color: #F1F1F2;
    }

    #darkTitle {
        color: black;
    }
}

</style>