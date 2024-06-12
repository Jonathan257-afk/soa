@extends("layouts/index/app")

@section("head")

@endsection

@section("body")
  <noscript data-n-head="1" data-hid="gtm-noscript" data-pbody="true"><iframe
      src="https://www.googletagmanager.com/ns.html?id=GTM-MK78CRC&" height="0" width="0"
      style="display:none;visibility:hidden" title="gtm"></iframe></noscript>
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
                Vous avez déjà un compte?
              </div> <a data-v-6d7935cc="" href="{{ route('login') }}"
                class="Register--BannerButton HaButton HaButton-Outline HaButton-Primary HaButton-Medium">
                
                Connexion
                
              </a>
            </div>
          </div>
          <div class="Register--Wrapper">
            <div class="Logo Register--Logo"  style="margin-bottom:0px"><img src="{{asset(config('path.logo.green'))}}"
                alt="logo" class="Logo--HaOnly"></div>
            <section class="RegisterOrganism Register--Step" style="margin-top:0px">
				<fieldset>
					<legend>S'inscrire etant</legend>
					<div class="row">
						<a  href="{{ route('userSignIn') }}" class='col-md-6 animate-zoom-hover paiementCheck active' for="sign-individuel">
							<div class='card btn btn-primary' style="border-radius:15px;">
								<div class="card-body">
									<h5 class="card-title" style="color:#ffffff;">Particulier</h5>
								</div>
							</div>
						</a>

						<a href="{{ route('asso-signIn') }}" class='col-md-6 animate-zoom-hover paiementCheck active' for="sign-asso">
							<div class='card btn btn-primary' style="border-radius:15px;">
								<div class="card-body">
									<h5 class="card-title" style="color:#ffffff;">ASSOCIATIONS</h5>
								</div>
							</div>
						</a>

					</div>
				</fieldset>

                <div class="RegisterOrganism--Actions"><a data-ux="Auth_SignUp_Form_BackToHome"
                    href="{{ route('index') }}"
                    class="RegisterOrganism--Back HaButton HaButton-Link HaButton-Basic HaButton-Medium HaButton-IconLeft"><span
                      class="HaButton--Icon HaButton--Icon-WithText"><svg aria-hidden="true" focusable="false"
                        data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left">
                        <path fill="currentColor"
                          d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"
                          class=""></path>
                      </svg></span>
                    Retour
                    
                    
                  	</a> 
				</div>
            </form>
        </section>
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