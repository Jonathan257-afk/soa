<html lang="fr">

<head>
    <title>{{$bingo->libelle}} | {{  $bingo->association->name }}</title>
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" media="screen" href="{{ asset('assets/css/azzara.min.css') }}">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<link rel="stylesheet" media="screen" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/game.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/minisite.css') }}">
    @yield("header")
</head>

<body class="bg-gris">
    <div>
        <div>
            <div class="o-layout">
                <div class="t-page">
                    <header class="o-header"  id="index-header-nav">
                        <button aria-label="Ouvrir le menu mobile" class="o-header__burger" id="btn-show-menu-mobile">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        @yield("nav-desktop")
                        @yield("nav-mobile")
                    </header>
                    <main>
                        @yield("content")
                    </main>

                    <footer class="o-footer" style="padding-top:30px;">
                        @yield("footer")
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.3.min.js') }}"></script>
    <script>
	  	$("#btn-show-menu-mobile").off().on("click", function(){
			$("#index-header-nav").toggleClass("-active");
	  	});
    </script>
    @yield("script-content")
</body>
</html>