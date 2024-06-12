@extends("layouts/index/app")

@section("head")

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
                Vous n'avez pas de compte?
              </div> <a data-v-6d7935cc="" href="{{ route('select-signIn') }}"
                class="Register--BannerButton HaButton HaButton-Outline HaButton-Primary HaButton-Medium">
                
                S'inscrire
                
              </a>
            </div>
          </div>
          <div class="Register--Wrapper">
            <div class="Logo Register--Logo"  style="margin-bottom:0px"><img src="{{asset(config('path.logo.green'))}}"
                alt="logo" class="Logo--HaOnly"></div>
            <section class="RegisterOrganism Register--Step" style="margin-top:0px">
              <h1>
                Veuillez vous connectez pour continuer
              </h1>
              <form method="post" action="{{ route('authentificate') }}">
                @csrf
                 <span>
                  <div class="RegisterOrganism--Email HaFormField">
                    <div class="HaFormField--Label"><label for="HaFormFieldInput-4" class="Label">Votre adresse email
                        *</label></div>
                    <div class="HaFormField--Field">
                      <div class="Input--Wrapper Input--Wrapper-Medium">
						  <input type="email" required  name="email" class="Input">
                      </div>
                    </div>
                  </div>
                </span>
                <span>
                  <div class="RegisterOrganism--Email HaFormField">
                    <div class="HaFormField--Label"><label for="HaFormFieldInput-4" class="Label">Votre mot de passe
                        *</label></div>
                    <div class="HaFormField--Field">
                      <div class="Input--Wrapper Input--Wrapper-Medium"><input type="password" name="password"
                          class="Input" required>
                      </div>
                    </div>
                  </div>
                </span>

                <div class="RegisterOrganism--RequiredInformation">
                  *renseignement obligatoire
                </div>
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
				  <button type="submit" class="HaButton HaButton-Fill HaButton-Primary HaButton-Medium">
                    Se connecter
                  </button></div>
              </form>
            </section>
          </div>
        </main>
      </div>
    </div>
  </div>
@endsection