@extends("layouts/asso/app")

@section("header")
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/auth.css') }}">
@endsection

@section("main")
    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">{{ auth()->user()->association->name }}</h1>
    </div>

    <div class="g-4 row">
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
                                <section class="RegisterOrganism" id="sectionPaiement" style="margin-top:0px">
                                    <fieldset>
                                        <legend>Mode de Paiement</legend>
                                        
                                        <div class="RegisterOrganism--Name HaFormField">
                                            <div class="HaFormField--Field">
                                                <div class="RegisterOrganism--HelpText">
                                                    📍{{ config('app.name')}} garantisse la confidentialité de vos données et ne seront utilisé que pour transférer directement les montants obtenues par les achats des billets sur votre compte. Nulle personne autre que l’association en question y auront accès. </br>
                                                    Vous pouvez trouver les informations à saisir dans l'onglet Développeur de votre Compte Stripe ou Paypal ou GPay.
                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="RegisterOrganism--Name HaFormField">
                                            <div class="HaFormField--Label">
                                                <label for="HaFormFieldInput-1" class="Label">
                                                    Votre Clé secrète Stripe pour recevoir les paiement via Stripe
                                                </label>
                                            </div>
                                            <div class="HaFormField--Field">
                                                <div class="Input--Wrapper Input--Wrapper-Medium">
                                                    <input type="text" id="stripe-update-association" value="{{  auth()->user()->association->stripe }}"
                                                        name="sk" class="Input  paiement-input-association" placeholder="sk_test_51OfOETC8qDlg4KjvIRxcEFrb1oYwLVT3ZQ78MELJbxAFTRekPojNjV6g6rImG7JVW1zmiT2pSLIU5klU2YFWwr1W00BLSPvtOQ">
                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="RegisterOrganism--Name HaFormField">
                                            <div class="HaFormField--Label">
                                                <label for="HaFormFieldInput-1" class="Label">
                                                    GPay
                                                </label>
                                            </div>
                                            <div class="HaFormField--Field">
                                                <div class="Input--Wrapper Input--Wrapper-Medium">
                                                    <input readonly type="text" id="gpay-update-association" 
                                                        name="sk" class="Input  paiement-input-association" placeholder="sk_test_51OfOETC8qDlg4KjvIRxcEFrb1oYwLVT3ZQ78MELJbxAFTRekPojNjV6g6rImG7JVW1zmiT2pSLIU5klU2YFWwr1W00BLSPvtOQ">
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <fieldset>
                                            <legend style="text-align: left;">Paypal</legend>
                                            <div class="RegisterOrganism--Name HaFormField">
                                                <div class="HaFormField--Label">
                                                    <label for="HaFormFieldInput-1" class="Label">
                                                        Votre Client ID
                                                    </label>
                                                </div>
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input type="text" id="paypal-clientId-update-association"  value="{{ (auth()->user()->association->paypal_id != null ) ?  auth()->user()->association->paypal->clientId  : '' }}"
                                                            name="paypal-clientId" class="Input  paiement-input-association" placeholder="ATEQU6ujF8_dbgwQ4cz42w8VuKJTMPi8zgh2_KrHjp4EeMZlJq_585BmNqpns71fVqah93pYrjdRA0H4">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="RegisterOrganism--Name HaFormField">
                                                <div class="HaFormField--Label">
                                                    <label for="HaFormFieldInput-1" class="Label">
                                                        Votre Client SECRET
                                                    </label>
                                                </div>
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input type="text" id="paypal-clientSecret-update-association"  value="{{ (auth()->user()->association->paypal_id != null ) ? auth()->user()->association->paypal->clientSecret : '' }}"
                                                            name="paypal-clientSecret" class="Input paiement-input-association" placeholder="ENzNaqSIKXs-sP0L6zy1SAoJI0j-79ZuqxAof380jGm72EifUsEsZ_x4fgMjqG5a8v1f1Qm5EiO7JoMM">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
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
        function updatePaiement() {
            const params = {
                "stripe" : $("#stripe-update-association").val(),
                "paypal-clientSecret" : $("#paypal-clientSecret-update-association").val(),
                "paypal-clientId" : $("#paypal-clientId-update-association").val(),
                "gpay" : $("#gpay-update-association").val(),
            }
            AjaxPost(
                "{{ route('asso-update-paiement') }}", 
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

        $(".paiement-input-association").off().on("change", function(){
            updatePaiement();
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