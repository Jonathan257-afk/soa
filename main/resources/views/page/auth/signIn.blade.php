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
              <h1>
                Inscrivez votre organisme gratuitement
              </h1>
              <form method="post" action="{{ route('association-signUp') }}"  enctype="multipart/form-data">
                @csrf
                <div class="RegisterOrganism--Name HaFormField">
                  	<div class="HaFormField--Label">
						<label for="HaFormFieldInput-1" class="Label">
							Quel est le nom officiel de votre organisme ? *
						</label>
                  	</div>
					<div class="HaFormField--Field">
						<div class="Input--Wrapper Input--Wrapper-Medium">
							<input type="text" required maxlength="100"
								 name="name" class="Input">
						</div>
						
						
						<div class="RegisterOrganism--HelpText">📍Pour faciliter la vérification de votre compte, inscrivez
						ici le nom de votre association tel qu'il est déclaré en préfecture, et non un diminutif ou un nom
						d'usage.</div>
					</div>
                  
                </div>
                <span>
					<div class="RegisterOrganism--Email HaFormField">
						<div class="HaFormField--Label"><label for="HaFormFieldInput-4" class="Label">Quel est votre email ?
							*</label></div>
						<div class="HaFormField--Field">
						<div class="Input--Wrapper Input--Wrapper-Medium">
							<input type="email" required  name="email" class="Input">
						</div>
						</div>
					</div>
                </span>

				<div class="RegisterOrganism--Name HaFormField">
                  	<div class="HaFormField--Label">
						<label for="HaFormFieldInput-1" class="Label">
							Vous êtes d'intérêt général ? *
						</label>
                  	</div>
					<div class="HaFormField--Field">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-yes check-yes-interet" id="container-for-check-yes-interet"  style="text-align:center;border-radius:0px;">
								<label id="label-for-interet-yes" for="interet-yes" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label  check-yes-interet">
									Oui
								</label>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-6 active col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-no check-no-interet" id="container-for-check-no-interet"  style="text-align:center;border-radius:0px;">
								<label id="label-for-interet-no"  for="interet-no" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label check-no-interet">
									Non
								</label>
							</div>
						</div>
						
						<input type="radio" style="display:none" id="interet-yes" value="yes" name="interet">
						<input type="radio" style="display:none" checked="true" id="interet-no" value="no" name="interet">
					</div>
                  
                </div>

				<div class="RegisterOrganism--Name HaFormField" id="cerfa-section">
                  	<div class="HaFormField--Label">
						<label for="HaFormFieldInput-1" class="Label">
							Vous êtes en possibilité d'émettre des CERFA DONS ? *
						</label>
                  	</div>
					<div class="HaFormField--Field">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-yes check-yes-cerfa" id="container-for-check-yes-cerfa"  style="text-align:center;border-radius:0px;">
								<label id="label-for-cerfa-yes" for="cerfa-yes" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label  check-yes-cerfa">
									Oui
								</label>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton active HaButton-Fill HaButton-Primary HaButton-Medium check-no check-no-cerfa" id="container-for-check-no-cerfa"  style="text-align:center;border-radius:0px;">
								<label id="label-for-cerfa-no"  for="cerfa-no" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label check-no-cerfa">
									Non
								</label>
							</div>
						</div>
						
						<input type="radio" style="display:none" id="cerfa-yes" value="yes" name="cerfa">
						<input type="radio" style="display:none" checked="true" id="cerfa-no" value="no" name="cerfa">
					</div>
                  
                </div>

                <span>
                  <div class="RegisterOrganism--Email HaFormField">
                    <div class="HaFormField--Label">
                      <label for="HaFormFieldInput-4" class="Label">Mot de passe *</label>
                    </div>
                    <div class="HaFormField--Field">
                      <div class="Input--Wrapper Input--Wrapper-Medium"><input type="password" name="password"
                          class="Input" required>
                      </div>
                    </div>
                  </div>
                </span>
                <span>
                  <div class="RegisterOrganism--Email HaFormField">
                    <div class="HaFormField--Label">
						<label for="HaFormFieldInput-4" class="Label">Confirmer votre mot de passe *</label>
					</div>
                    <div class="HaFormField--Field">
                      <div class="Input--Wrapper Input--Wrapper-Medium"><input required type="password" name="confirm"
                          class="Input">
                      </div>
                    </div>
                  </div>
                </span>

				<span>
                  	<div class="RegisterOrganism--Email HaFormField">
						<div class="HaFormField--Label">
							<label for="HaFormFieldInput-4" class="Label">Votre logo</label>
						</div>
						<div class="HaFormField--Field form-group">
							<div class="Input--Wrapper Input--Wrapper-Medium">
								<div class=" css-b62m3t-container">
									<span id="react-select-7-live-region"
										class="css-7pg0cj-a11yText">
									</span>
									<span aria-live="polite" aria-atomic="false"
										aria-relevant="additions text" class="css-7pg0cj-a11yText">
									</span>
									<div style="width:100%;text-align: center;" id="container-img-input-add-logo">
										<div class="card card-stats card-round"
											style="background-color: #f9f9f9;border:1px #000 solid;">
											<div class="card-body" style="width: auto;height: auto;">
												<div>
													<img class="img_imageUploader" style="width: 100px;height: 100px;" src="{{ asset('assets/img/image-uploader-default.jpg') }}">
												</div>
											</div>
											<div style="margin-left: 30px;margin-right: 30px;">
												<label for="img-input-add-logo" class="btn btn-primary btn-border btn-round btn-lg btn-block">
													Changer l'image
												</label>
											</div>
											<input style="display:none;"
												class="form-control" type="file"
												id="img-input-add-logo" name="logo"
												accept="image/png, image/jpeg, image/jpg">
											<input style="display:none;"
												class="form-control" type="hidden" id="name_logo" name="logo_name">
										</div>
									</div>
								</div>
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
                    Inscrire mon organisme
                  </button></div>
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
		$("#container-for-check-yes-interet").off().on("click", function(){
			$("#container-for-check-no-interet").removeClass("active");
			$(this).addClass("active");
			$("#interet-yes").prop("checked", true);

			$("#cerfa-yes").prop("checked", true);
			$("#cerfa-section").fadeOut(1000);
		});

		$("#container-for-check-no-interet").off().on("click", function(){
			$("#container-for-check-yes-interet").removeClass("active");
			$(this).addClass("active");
			$("#interet-no").prop("checked", true);

			$("#container-for-check-yes-cerfa").removeClass("active");
			$("#container-for-check-no-cerfa").addClass("active");
			$("#cerfa-section").fadeIn(1000);
			$("#cerfa-no").prop("checked", true);
		});

		$("#interet-yes").off().on("click", function(){
			$("#container-for-check-no-interet").removeClass("active");
			$(this).parent().addClass("active");

			$("#cerfa-yes").prop("checked", true);
			$("#cerfa-section").fadeOut(1000);
		});

		$("#interet-no").off().on("click", function(){
			$("#container-for-check-yes-interet").removeClass("active");
			$(this).parent().addClass("active");

			$("#container-for-check-yes-cerfa").removeClass("active");
			$("#container-for-check-no-cerfa").addClass("active");
			$("#cerfa-section").fadeIn(1000);
			$("#cerfa-no").prop("checked", true);
		});


		$("#container-for-check-yes-cerfa").off().on("click", function(){
			$("#container-for-check-no-cerfa").removeClass("active");
			$(this).addClass("active");
			$("#cerfa-yes").prop("checked", true);
		});

		$("#container-for-check-no-cerfa").off().on("click", function(){
			$("#container-for-check-yes-cerfa").removeClass("active");
			$(this).addClass("active");
			$("#cerfa-no").prop("checked", true);
		});

		$("#cerfa-yes").off().on("click", function(){
			$("#container-for-check-no-cerfa").removeClass("active");
			$(this).parent().addClass("active");
		});

		$("#cerfa-no").off().on("click", function(){
			$("#container-for-check-yes-cerfa").removeClass("active");
			$(this).parent().addClass("active");
		});


		$("#img-input-add-logo").off().on("change", function(e){
			
            if (e.target && e.target.files && e.target.files[0]) {
                $("#name_logo").val(getNameImage(e.target.files[0]))
				var reader = new FileReader();

                reader.onloadend = function() {
                    $('#container-img-input-add-logo .img_imageUploader').attr('src', reader.result);
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });
	</script>
@endsection