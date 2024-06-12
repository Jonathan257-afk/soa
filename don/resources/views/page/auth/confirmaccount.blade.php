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
                    <h2>Votre compte a été vérifié avec succès</h2>
                    <p>
            
                    </p>
                    <a href="{{ route('login') }}">Mon compte</a>
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
