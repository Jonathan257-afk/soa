@extends("layouts/index/app")

@section("head")
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/auth.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/errorOrMessageBlade.css') }}" />
@endsection

@section("body")
  <div id="__nuxt">
    <div id="__layout">
      <div>
        <div class="HaAccessibility">
          
        </div>
        <div aria-live="polite" role="status" aria-atomic="true" class="HaToaster">
          
        </div>
        <main class="Register" style="--step-background-position: 0%;">
            <div data-v-6d7935cc="" class="Register--Banner">
                <div data-v-6d7935cc="" class="Register--BannerContainer">
                    <div data-v-6d7935cc="" class="Register--BannerText">
                        {{ config('app.name') }}
                    </div> 
                   
                </div>
            </div>
            
            <div id="notfound">
                <div class="notfound">
                    <div class="notfound-404">
                        <h1>MERCI!</h1>
                    </div>
                    <h2>{{ config('app.name') }}</h2>
                    <p>
                        Nous vous remercions d’avoir choisie tombola. Veuillez-vous rendre dans votre boite email pour vérifier votre compte et continue.
                        </br>A noter : Si vous ne trouvez pas notre mail dans votre boîte de réception principale, veuillez vérifier votre dossier de spam ou courrier indésirable. Parfois, nos emails peuvent être dirigés là-bas par erreur.
                    </p>
                    <a href="{{ route('index') }}">Aller sur l'Accueil</a>
                </div>
            </div>
        </main>
      </div>
    </div>
  </div>
@endsection

@section("footer")
	<script>

	</script>
@endsection
<!-- 
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>{{ getTitle() }}</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">

	

</head>

<body>

	

</body>

</html> -->