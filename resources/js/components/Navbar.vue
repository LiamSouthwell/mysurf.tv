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
                    <a href="/playlists" class="nav-link">Playlists</a>
                </li>
                <li class="nav-item">
                    <a href="/latest" class="nav-link">Latest</a>
                </li>
                <li class="nav-item">
                    <a href="/trending" class="nav-link">Trending</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link">Admin</a>
                </li>
                <li class="nav-item">
                    <div id="darkMode">
                        <span id="darkTitle">Dark Mode</span>
                        <label class="switch">
                            <input type="checkbox" @click="toggleClass()">
                            <span class="slider round"></span>
                        </label>
                        <div id="toggleLabels">
                        <label id="offOn">Off/On</label>
		                </div>
		            </div>
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
            isActive: false
        }
    },

    methods: {
    search: function() {
      this.$router.push({path: '/search/' + document.getElementById("searchTerms").value})
    },
    toggleClass: function() {
        if(this.isActive){
            this.isActive = false;
            console.log("Turning dark mode off");
            document.body.style.backgroundColor = "#e2e2e2";
            document.body.style.color = "black";
        } else {
            this.isActive = true;
            console.log("Turning dark mode on");
            document.body.style.backgroundColor = "#544b4b";
            document.body.style.color = "white";
        }
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

.nav-link:hover, .nav-link:focus {
    color: black !important;
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
	height: 50px;
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


#offOn {
	position: relative;
	top: 33px;
    right: 7.5px;
}

 @media only screen and (min-width: 1000px) {
     #darkMode {
         position: relative;
         width: 160px;
     }

     #darkTitle {
         position: relative;
         display: inline-block;
         float: right;
         top: 3px;
     }

     #offOn {
         right: -75px;
         top: 36px;
     }
 }

</style>