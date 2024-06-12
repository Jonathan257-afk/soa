<!doctype html>
<html data-n-head-ssr lang="fr" data-n-head="%7B%22lang%22:%7B%22ssr%22:%22fr%22%7D%7D">

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta data-n-head="ssr" charset="utf-8">
	<meta data-n-head="ssr" http-equiv="X-UA-Compatible" content="chrome=1, ie=edge">
	<meta data-n-head="ssr" data-hid="viewport" name="viewport"
		content="width=device-width,initial-scale=1,maximum-scale=5">

	<meta data-n-head="ssr" data-hid="author" name="author" content="Corsica Bati">
	<meta data-n-head="ssr" name="format-detection" content="telephone=no">
	<meta data-n-head="ssr" name="msapplication-TileColor" content="#ffffff">
	<meta data-n-head="ssr" name="theme-color" content="#ffffff">
	<meta data-n-head="ssr" data-hid="keywords" property="keywords"
		content="Corsica Bati, association, bingo, tombola, collecte, bingo en ligne, tombola en ligne, simple, dons, adhésions, associations, cotisations, dons en ligne, paiement don, gérer association, collecte de fonds, financement participatif">

	<meta data-n-head="ssr" data-hid="description" name="Corsica Bati - ASSOCIATION TOMBOLA"
		content="Organisez une tombola ou/et Bingo pour votre association 100% gratuite! ">
	<meta data-n-head="ssr" data-hid="twitter:title" name="twitter:title"
		content="Organiser votre tombola en ligne gratuitement !">
	@yield("head")
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" media="screen" href="{{ asset('assets/css/azzara.min.css') }}">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	
	@if(Route::is("index") || Route::is("game"))
		<link rel="stylesheet" media="screen" href="{{ asset('assets/css/index.css') }}">
	@endif

	@if(Route::is("login") || Route::is("asso-signIn") || Route::is("select-signIn")  || Route::is("userSignIn"))
		<link rel="stylesheet" media="screen" href="{{ asset('assets/css/auth.css') }}">
	@endif
	
	<link rel="stylesheet" media="screen" href="{{ asset('assets/css/checkbox.css') }}">
 	<title>{{ getTitle() }}</title>

  	<style>
    
		fieldset {
			display: block;
			margin-inline-start: 2px;
			margin-inline-end: 2px;
			padding-block-start: 0.35em;
			padding-inline-start: 0.75em;
			padding-inline-end: 0.75em;
			padding-block-end: 0.625em;
			min-inline-size: min-content;
			border-width: 2px;
			border-style: groove;
			border-color: rgb(192, 192, 192);
			border-image: initial;
		}

		fieldset legend {
			display: block;
			padding-inline-start: 2px;
			padding-inline-end: 2px;
			border-width: initial;
			border-style: none;
			border-color: initial;
			border-image: initial;
			float: none;
			width: auto;
			text-align:center;
		}

		.check-no , .check-yes {
        	border-color: rgba(4, 4, 4, 0.5);
        	background-color: rgba(4, 4, 4, 0.5)!important;
        }  
        
        .check-no:hover, .check-no.active {
        	border-color: red;
        	background-color: red!important;
        }  
        
        .check-yes:hover, .check-yes.active {
        	border-color: green;
        	background-color: green!important;
        }

		.animate-zoom-hover {
			transition : transform 0.3 ease;
			cursor : pointer;
		}

		.animate-zoom-hover:hover {
			transform : scale(1.1);
		}

		.jouer-nav {
			color:#ffffff!important;
			background : #33cc33!important;
		}

		@keyframes appearMenuMobile {
			from {
				transform: translateX(0%);
			}
			to {
				transform: translateX(100%);
			}
		}

		@keyframes outMenuMobile {
			from {
				transform: translateX(100%);
			}
			to {
				transform: translateX(0%);
			}
		}

		.o-header .nav-desktop {
			display: flex;
		}

		@media(min-width:1200px) {
			.o-header .nav-mobile {
				display: none;
			}

			#btn-close-collapse-slidbar-mobile {
				display: none!important;
			}


			#btn-collapse-slidbar-desktop {
				display: block!important;
			}
		}

		@media(max-width:1200px) {
			.o-header .nav-mobile {
				display: flex;
				animation: outMenuMobile 0.3s ease-in-out forwards;
			}

			#btn-close-collapse-slidbar-mobile {
				display: block!important;
			}

			#btn-collapse-slidbar-desktop {
				display: none!important;
			}
		}

		/* btn-close-collapse-slidbar-mobile */

		.o-header.-active .nav-desktop {
			display: none;
		}

		.o-header.-active .nav-mobile {
			display: flex;
			animation: appearMenuMobile 0.3s ease-in-out forwards;
		}

		nav .pro-inner-list-item .popper-element {
			
		}
  	</style>
  
</head>

<body>
    @yield("body")
    

	<script src="{{ asset('assets/plugins/jquery/jquery-3.6.3.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script src="{{ asset('assets/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>


	<script src="{{ asset('assets/js/animationBtn.js') }}"></script>
  	<script src="{{ asset('assets/js/fonction.js') }}"></script>
  	<script>
	  	$("#btn-show-menu-mobile").off().on("click", function(){
			$("#index-header-nav").toggleClass("-active");
	  	});

		$("#btn-collapse-slidbar-desktop").off().on("click", function() {
			$("#container-slidbar").toggleClass("collapsed");
			$("#container-main").toggleClass("wrapper");
			$("#container-main").toggleClass("wrapper-res");

			$("#container-slidbar").find(".pro-sidebar-content").find("nav").find("li").toggleClass("d-flex");
			$("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".pro-inner-list-item").toggleClass("react-slidedown popper-element closed");
			$("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".c-drop").toggleClass("popper-inner");

			if($("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".pro-inner-list-item").hasClass("popper-element")) {
				$("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".pro-inner-list-item").css({
					"position": "fixed",
					"left": "0px",
					"top": "auto",
					"margin": "0px",
					"transform": "translate(75px, 15px)",
				});

				$("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".pro-inner-list-item").find(".c-drop").css({
					"background-color": "#2b2b2b",
					"border-radius": "4px",
					"max-height": "100vh",
					"overflow-y": "auto",
					"padding-left": "20px",
				});
			}
			else {
				$("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".pro-inner-list-item").css("height", "0px");
				$("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".pro-inner-list-item").css({
					"position": "relative",
					"left": "auto",
					"top": "auto",
					"margin": "0px",
					"transform": "none",
				});

				$("#container-slidbar").find(".pro-sidebar-content").find("nav").find(".pro-inner-list-item").find(".c-drop").css({
					"background-color": "transparent",
					"border-radius": "none",
					"max-height": "auto",
					"overflow-y": "none",
					"padding-left": "none",
				});
			}
		});


		$("#btn-collapse-slidbar-mobile, #btn-close-collapse-slidbar-mobile").off().on("click", function() {
			$("#container-slidbar").removeClass("collapsed");
			$("#container-slidbar").toggleClass("hide-menu");
			$("#container-slidbar").toggleClass("open-menu");
			$("#container-class-false").toggleClass("false");
			$("#container-class-false").toggleClass("bg-overlay d-block");
		});

		$(".my-slidbar-drop").off().on("click", function(){
			$(this).parent().toggleClass("open");
			$(this).parent().find(".pro-inner-list-item").toggleClass("closed");

			if(!$(this).parent().find(".pro-inner-list-item").hasClass("closed"))
				$(this).parent().find(".pro-inner-list-item").css("height", "auto");
			else 
				$(this).parent().find(".pro-inner-list-item").css("height", "0px");
				
				// pro-inner-item
				// react-slidedown pro-inner-list-item closed


				//pro-inner-list-item popper-element
	  	});
  	</script>
	@yield("script")

	@include("layouts/message")
</body>

</html>