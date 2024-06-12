@extends("layouts/asso/app")

@section("header")
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/auth.css') }}">
@endsection

@section("main")
    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">{{ auth()->user()->association->name }}</h1>
    </div>

    <div class="g-4 row" style="margin-bottom:5%;">
		<div class="col-xxl-12 col-12">
            <div id="__nuxt">
                <div id="__layout">
                    <div>
                        <div class="HaAccessibility">
                        
                        </div>
                        <div aria-live="polite" role="status" aria-atomic="true" class="HaToaster">
                        
                        </div>
                        <div class="Register" style="--step-background-position: 0%;">
                            
                            <div class="Register--Wrapper" style="margin-left:5%;margin-right:5%;">
                                <section class="RegisterOrganism" style="margin-top:0px">
                                    <fieldset>
                                        <legend>Information Général</legend>
                                        
                                    
                                        <div class="RegisterOrganism--Name HaFormField">
                                            <div class="HaFormField--Label">
                                                <label for="HaFormFieldInput-1" class="Label">
                                                    Le nom officiel de votre organisme *
                                                </label>
                                            </div>
                                            <div class="HaFormField--Field">
                                                <div class="Input--Wrapper Input--Wrapper-Medium">
                                                    <input type="text" required id="name-association-input" value="{{ auth()->user()->association->name }}"
                                                        name="name" class="Input  input-update-association">
                                                </div>
                                                
                                                
                                                <div class="RegisterOrganism--HelpText">📍Pour faciliter la vérification de votre compte, inscrivez
                                                ici le nom de votre association tel qu'il est déclaré en préfecture, et non un diminutif ou un nom
                                                d'usage.</div>
                                            </div>
                                        
                                        </div>

                                        <span>
                                            <div class="RegisterOrganism--Email HaFormField">
                                                <div class="HaFormField--Label">
                                                    <label for="HaFormFieldInput-4" class="Label">
                                                        L'email de votre organisme
                                                    </label>
                                                </div>
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input id="email-association-input" value="{{ auth()->user()->association->email }}" type="email" required  name="email" class="Input  input-update-association">
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
                                                <div class="row" style="margin-left:10px;margin-right:10px">
                                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-yes check-yes-interet <?php if(auth()->user()->association->interet){ echo 'active'; } ?>" id="container-for-check-yes-interet"  style="text-align:center;border-radius:0px;">
                                                        <label id="label-for-interet-yes" for="interet-yes" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label  check-yes-interet">
                                                            Oui
                                                        </label>
                                                    </div>
                                                    <div  class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-no check-no-interet <?php if(!auth()->user()->association->interet){ echo 'active'; } ?>" id="container-for-check-no-interet"  style="text-align:center;border-radius:0px;">
                                                        <label id="label-for-interet-no"  for="interet-no" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label check-no-interet">
                                                            Non
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                <input type="radio" style="display:none" class="input-update-association" <?php if(auth()->user()->association->interet){ echo 'checked="true"'; } ?> id="interet-yes" value="yes" name="interet">
                                                <input type="radio" style="display:none" class="input-update-association" <?php if(!auth()->user()->association->interet){ echo 'checked="true"'; } ?>  id="interet-no" value="no" name="interet">
                                            </div>
                                        
                                        </div>

                                        <div class="RegisterOrganism--Name HaFormField" <?php if(auth()->user()->association->interet){ echo 'style="display:none"'; } ?> id="cerfa-section" >
                                            <div class="HaFormField--Label">
                                                <label for="HaFormFieldInput-1" class="Label">
                                                    Vous êtes en possibilité d'émettre des CERFA DONS ? *
                                                </label>
                                            </div>
                                            <div class="HaFormField--Field">
                                                <div class="row"  style="margin-left:10px;margin-right:10px">
                                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-yes check-yes-cerfa  <?php if(auth()->user()->association->cerfa){ echo 'active'; } ?>" id="container-for-check-yes-cerfa"  style="text-align:center;border-radius:0px;">
                                                        <label id="label-for-cerfa-yes" for="cerfa-yes" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label  check-yes-cerfa">
                                                            Oui
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-no check-no-cerfa   <?php if(!auth()->user()->association->cerfa){ echo 'active'; } ?>" id="container-for-check-no-cerfa"  style="text-align:center;border-radius:0px;">
                                                        <label id="label-for-cerfa-no"  for="cerfa-no" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label check-no-cerfa">
                                                            Non
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                <input type="radio" class="input-update-association" style="display:none" <?php if(auth()->user()->association->cerfa){ echo 'checked="true"'; } ?> id="cerfa-yes" value="yes" name="cerfa">
                                                <input type="radio" class="input-update-association" style="display:none" <?php if(auth()->user()->association->cerfa){ echo 'checked="true"'; } ?> id="cerfa-no" value="no" name="cerfa">
                                            </div>
                                        
                                        </div>

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
                                                                            <img class="img_imageUploader" style="width: 100px;height: 100px;" src="{{ asset('assets/img/logo/'. auth()->user()->association->id.'/'. auth()->user()->association->logo) }}">
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
                                    </fieldset>
                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section("footer")
    @if((auth()->user()->association->stripe == null || auth()->user()->association->stripe == "") && (auth()->user()->association->paypal_id == null || auth()->user()->association->paypal_id == "") && (auth()->user()->association->gpay == null || auth()->user()->association->gpay == ""))
        <script>
            defilerTo("#sectionPaiement");
        </script>
    @endif
	<script>

        function updateInfo() {
            const params = {
                "name" : $("#name-association-input").val(),
                "email" : $("#email-association-input").val(),
                "interet" : $("input[name=interet]:checked").val(),
                "cerfa" : $("input[name=cerfa]:checked").val(),
            }
            AjaxPost(
                "{{ route('asso-update-info') }}", 
                params, 
                "", 
                function(success) {
                }, 
                function(error){
                }
            );
        }

        function updateLogo(fileToSend, nameFile) {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var data = new FormData();
            data.append('logo', fileToSend);
            data.append('name', nameFile);

            fetch("{{ route('asso-update-logo') }}", {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                body: data
            }).then(
                response => response.json()
            ).then(
                success => console.log(success)
            ).catch(
                error => console.log(error)
            );
        }

        $(".input-update-association").off().on("change", function(){
            updateInfo();
        });
        
		$("#container-for-check-yes-interet").off().on("click", function(){
			$("#container-for-check-no-interet").removeClass("active");
			$(this).addClass("active");
			$("#interet-yes").prop("checked", true);

			$("#cerfa-yes").prop("checked", true);
			$("#cerfa-section").fadeOut(1000);

            updateInfo();
		});

		$("#container-for-check-no-interet").off().on("click", function(){
			$("#container-for-check-yes-interet").removeClass("active");
			$(this).addClass("active");
			$("#interet-no").prop("checked", true);
            
			$("#container-for-check-yes-cerfa").removeClass("active");
			$("#container-for-check-no-cerfa").addClass("active");
			$("#cerfa-section").fadeIn(1000);
			$("#cerfa-no").prop("checked", true);

            updateInfo();
		});

		$("#interet-yes").off().on("click", function(){
			$("#container-for-check-no-interet").removeClass("active");
			$(this).parent().addClass("active");

			$("#cerfa-yes").prop("checked", true);
			$("#cerfa-section").fadeOut(1000);

            updateInfo();
		});

		$("#interet-no").off().on("click", function(){
			$("#container-for-check-yes-interet").removeClass("active");
			$(this).parent().addClass("active");
            
			$("#container-for-check-yes-cerfa").removeClass("active");
			$("#container-for-check-no-cerfa").addClass("active");
			$("#cerfa-section").fadeIn(1000);
			$("#cerfa-no").prop("checked", true);

            updateInfo();
		});


		$("#container-for-check-yes-cerfa").off().on("click", function(){
			$("#container-for-check-no-cerfa").removeClass("active");
			$(this).addClass("active");
			$("#cerfa-yes").prop("checked", true);

            updateInfo();
		});

		$("#container-for-check-no-cerfa").off().on("click", function(){
			$("#container-for-check-yes-cerfa").removeClass("active");
			$(this).addClass("active");
			$("#cerfa-no").prop("checked", true);

            updateInfo();
		});

		$("#cerfa-yes").off().on("click", function(){
			$("#container-for-check-no-cerfa").removeClass("active");
			$(this).parent().addClass("active");

            updateInfo();
		});

		$("#cerfa-no").off().on("click", function(){
			$("#container-for-check-yes-cerfa").removeClass("active");
			$(this).parent().addClass("active");

            updateInfo();
		});


		$("#img-input-add-logo").off().on("change", function(e){
			
            if (e.target && e.target.files && e.target.files[0]) {
                const name = getNameImage(e.target.files[0]);
                $("#name_logo").val(name);
				var reader = new FileReader();

                reader.onloadend = function() {
                    $('#container-img-input-add-logo .img_imageUploader').attr('src', reader.result);
                    updateLogo(e.target.files[0], name);
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });
	</script>
@endsection