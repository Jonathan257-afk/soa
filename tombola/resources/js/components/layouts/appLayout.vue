<template>
	<div>
        <div class="wrapper" id="contente-element">
            <div class="main-header" data-background-color="purple" id="menu">
                <!-- Logo Header -->
                <div class="logo-header">
                    
                    <a href="" class="logo">
                        <img src="" alt="logo" id="mainLogo" style="width:15%;" class="navbar-brand">
                    </a>
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                    <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                    <div class="navbar-minimize">
                        <button class="btn btn-minimize btn-rounded">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-expand-lg">
                    
                    <div class="container-fluid">
                        <div class="collapse" id="search-nav">
                        </div>
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            
                            <!-- <notification></notification> -->
                            
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="assets/img/avatar.png" id="imageProfileInNavBar1" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img id="imageProfileInNavBar2" src="assets/img/avatar.png" alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4 class="nameUserAuth">{{ user.name}}</h4>
                                                <p class="text-muted emailUserAuth">{{ user.email}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <router-link to="/">Parametre Compte</router-link>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <slider v-bind:user="user"></slider>


            <main>
                <div class="main-panel">
                    <div class="content">
                        <div class="page-inner">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>


<script>

export default {
	data() {
		return {
			formData : {
				matricule : "",
				password : "",
			}
		}
	},

    props: [
        "user"
    ],

	methods : {
	},

    created(){
    },

    mounted() {
        
    }
}
</script>




