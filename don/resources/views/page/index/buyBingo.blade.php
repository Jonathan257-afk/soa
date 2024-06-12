@extends("layouts/index/app")

@section("head")
	<link rel="stylesheet" media="screen" href="{{ asset('assets/css/auth.css') }}">
	<style>
		.paiementCheck.active img{
			border : 3px green solid;
		}
	</style>
@endsection

@section("body")
	<div id="__nuxt">
		<form method="post" action="{{ route('bingo-buy') }}">
			@csrf
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
									{{ $bingo->libelle }}
								</div>
							</div>
						</div>
						<div class="Register--Wrapper">
						<div class="Logo Register--Logo"  style="margin-bottom:0px"><img src="{{asset('assets/img/logo/'. $bingo->association->id . '/'. $bingo->association->logo)}}"
							alt="logo" class="Logo--HaOnly"></div>
							<section class="RegisterOrganism Register--Step" id="section1" style="margin-top:0px">
								<fieldset>
									<legend>Combien de tickets ? *</legend>
									
								
									<div class="g-3 align-items-center" style="margin-bottom:20px;">
										
										<div class="HaFormField--Label">
											<label class="Label col-form-label custom-control overflow-checkbox row">
												<div class="overflow-control-description col-auto">1 ticket</div>
												<div class="HaFormField--Field col-auto">
													<div class="Input--Wrapper Input--Wrapper-Medium">
														<input type="checkbox"  min="0" id="one-ticket-buy" name="one-ticket-buy" maxlength="100"
															class="overflow-control-input">
															<span class="overflow-control-indicator"></span>
													</div>
												</div>
											</label>
										</div>
									</div>

									

									<div class="row g-3 align-items-center">
										<div class="col-auto">
											<div class="HaFormField--Label">
												<label for="plus-ticket-buy" class="Label">
													Plus
												</label>
											</div>
										</div>
										<div class="col-auto">
											<div class="HaFormField--Field">
												<div class="Input--Wrapper Input--Wrapper-Medium">
													<input style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" type="number" id="plus-ticket-buy"
														name="plus" class="Input Input--Limit">
												</div>
											</div>
										</div>
										<div class="HaFormField--Label">
											<label for="don-bingo-buy" class="Label">
												<span style="color: red;" id="erreur-ticket"></span>
											</label>
										</div>
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
									Annuler
									
									
								</a> 
								<button type="button" id="btn-suivant-1" class="HaButton HaButton-Fill HaButton-Primary HaButton-Medium">
									Suivant
								</button>
								</div>
							</section>

							<section class="RegisterOrganism Register--Step" id="section2" style="margin-top:0px;display:none">
								<fieldset>
									<legend>Don pour {{ $bingo->association->name }}</legend>
						
							
									<div class="RegisterOrganism--Name HaFormField">
										<div class="row g-3 align-items-center" style="margin-bottom:20px;">
											<div class="HaFormField--Label">
												<label  class="Label col-form-label">
												Votre don ouvre droit à  des tickets gratuits dans la limite de 74€ de ticket par AN ! 
												</label>
											</div>
											<div class="col-auto">
												<div class="HaFormField--Label">
													<label  class="Label col-form-label">
														Je donne
													</label>
												</div>
											</div>
											<div class="col-auto">
												<div class="HaFormField--Field">
													<div class="Input--Wrapper Input--Wrapper-Medium">
														<input type="number"  style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" id="don-bingo-buy" maxlength="100"
														name="don" class="Input Input--Limit" placeholder=" x €">
													</div>
												</div>
											</div>
											<div class="HaFormField--Label">
												<label for="don-bingo-buy" class="Label">
													Je peux avoir <span id="nombre-ticket-after-don">0</span> gratuits et j'économise <span id="impot-deduit-after-don">0</span> sur mes impots! </br>
													@if($bingo->association->cerfa)
														<span style="color:rgba(0,0,0, 0.5);">Vous recevrez un CERFA don de la part de l'association</span> </br>
													@endif	
													<span style="color: red;" id="erreur-don"></span>
												</label>
											</div>
										</div>
									</div>

									<input type="hidden" id="don-bingo-buy" required value="{{$bingo->id}}"
														name="bingoId" class="Input Input--Limit">
								</fieldset>

								<div class="RegisterOrganism--Actions"><button type="button"
									id="btn-precedent-1"
									class="RegisterOrganism--Back HaButton HaButton-Link HaButton-Basic HaButton-Medium HaButton-IconLeft"><span
									class="HaButton--Icon HaButton--Icon-WithText"><svg aria-hidden="true" focusable="false"
										data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left">
										<path fill="currentColor"
										d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"
										class=""></path>
									</svg></span>
									Précédent
									
									
								</button> 
								<button type="button" id="btn-suivant-2" class="HaButton HaButton-Fill HaButton-Primary HaButton-Medium">
									Suivant
								</button>
								</div>
							</section>

							
							<section class="RegisterOrganism Register--Step" id="section3" style="margin-top:0px;display:none;">
								<fieldset>
									<legend>Mode de Paiement</legend>
									<div class="row">
										@if($bingo->association->stripe != null && $bingo->association->stripe != "")
											<label class='col-md-4 animate-zoom-hover paiementCheck active' for="pay-stripe">
												<div class='card'>
													<img src="{{ asset('assets/img/logo/stripe.png') }} " class='card-img-top' alt='logo stripe'>
												</div>
											</label>
										@endif
										@if($bingo->association->paypal_id != null && $bingo->association->paypal_id != "")
											<label class='col-md-4 animate-zoom-hover paiementCheck ' for="pay-paypal">
												<div class='card'>
													<img src="{{ asset('assets/img/logo/paypal.jpg') }} " class='card-img-top' alt='logo stripe'>
												</div>
											</label>
										@endif
										@if($bingo->association->gpay != null && $bingo->association->gpay != "")
											<label class='col-md-4 animate-zoom-hover paiementCheck ' for="pay-gpay">
												<div class='card'>
													<img src="{{ asset('assets/img/logo/gpay.avif') }} " class='card-img-top' alt='logo stripe'>
												</div>
											</label>
										@endif
										@if($bingo->association->stripe != null && $bingo->association->stripe != "")
											<input type="radio" style="display:none;" checked="true"  id="pay-stripe" value="stripe" name="paiement">
										@endif	
										@if($bingo->association->paypal_id != null && $bingo->association->paypal_id != "")
											<input type="radio" style="display:none;" id="pay-paypal" value="paypal" name="paiement">
										@endif
										@if($bingo->association->gpay != null && $bingo->association->gpay != "")
											<input type="radio" style="display:none;" id="pay-gpay" value="gpay" name="paiement">
										@endif
									</div>
									<input type="hidden" id="don-bingo-buy" required value="{{$bingo->id}}"
														name="bingoId" class="Input Input--Limit">
								</fieldset>

								<div class="RegisterOrganism--Actions">
									<button type="button"
										id="btn-precedent-2"
										class="RegisterOrganism--Back HaButton HaButton-Link HaButton-Basic HaButton-Medium HaButton-IconLeft"><span
										class="HaButton--Icon HaButton--Icon-WithText"><svg aria-hidden="true" focusable="false"
											data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg"
											viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left">
											<path fill="currentColor"
											d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"
											class=""></path>
										</svg></span>
										Précédent
									
									
									</button> 
									<button type="submit" id="btn-suivant-3" class="HaButton HaButton-Fill HaButton-Primary HaButton-Medium">
										Suivant
									</button>
								</div>
							</section>
						</div>
					</main>
				</div>
			</div>
		</form>
  	</div>
@endsection

@section("footer")
	<script>
		$("#btn-suivant-1").off().on("click", function(){
			if($("#plus-ticket-buy").val() > 0 || $("input[name='one-ticket-buy']").is(":checked")) {
				$("#section1").hide(1000);
				$("#section2").fadeIn(3000);
			}
			else 
				errorNotify("Veuillez choisir l'un des options !");
		});

		$("#btn-precedent-1").off().on("click", function(){
			$("#section2").hide(1000);
			$("#section1").fadeIn(3000);
		});

		$("#btn-suivant-2").off().on("click", function(){
			if($("#name-bingo-buy").val() != "" && $("#email-bingo-buy").val() != "" ) {
				$("#section2").hide(1000);
				$("#section3").fadeIn(3000);
			}
			else 
				errorNotify("Veuillez remplir les champs obligatoire * !");
		});

		
		$("#btn-precedent-2").off().on("click", function(){
			$("#section3").hide(1000);
			$("#section2").fadeIn(3000);
		});

		$("#btn-precedent-3").off().on("click", function(){
			$("#section4").hide(1000);
			$("#section3").fadeIn(3000);
		});

		function changeValueDon() {
			var don = $("#don-bingo-buy").val();
			var nbTicket = 0;
			var ticketToBuy = ($("#plus-ticket-buy").val() > $("#plus-ticket-buy").val()) ? $("#plus-ticket-buy").val() : 1;

			var impot =  Math.round((2*don/3 ) / (3 /3));
			const prixTicket = <?= $bingo->montant?>;
			if(don / 3 > 74) {
				nbTicket = Math.round(74 / prixTicket);
			}
			else {
				nbTicket = Math.round((don / 3) / prixTicket);
			}

			$("#nombre-ticket-after-don").html(nbTicket);
			$("#impot-deduit-after-don").html(impot);

			const total = nbTicket + ticketToBuy;
			if(total > <?= $bingo->ticket ?>)
				$("#erreur-don").html("Nous somme désolé mais il reste que " +  <?= $bingo->ticket ?>+ " ticket(s) alors qu'avec ce don + achat vous obtenez au total " + total + " tickets");
			else 
				$("#erreur-don").html("");
		}

		function changeBuyPlus() {
			
			var erreur = ""
			var ticket = $("#plus-ticket-buy").val();
			max =  Math.round((<?= $bingo->max ?> * 30 ) / 100); 
			if(ticket > max) {
				erreur = "Vous ne pouvez qu'achèter au maximun " + max + " tickets";
				ticket = max;
				$("#plus-ticket-buy").val(max);
			}

			if(ticket > <?= $bingo->ticket ?>) {
				erreur = "Nous somme désolé mais il reste que " +  <?= $bingo->ticket ?>+ " ticket(s)";
				ticket = <?= $bingo->ticket ?>;
				$("#plus-ticket-buy").val(<?= $bingo->ticket ?>);
			}

			$("#erreur-ticket").html(erreur);
		}

		$(".Input--Limit").off().on("keyup", function() {
			console.log($(this).attr("id"));
			if($(this) != null && typeof $(this).data("max") != "undefined") {
				var max = parseInt($(this).data("max"));
				var val = $(this).val();
				if( val.length > max) 
					$(this).val(val.slice(0, -1));

				if($(this).attr("id") == "plus-ticket-buy") {
					changeBuyPlus();
				}
				
				if($(this).attr("id") == "don-bingo-buy") {
					changeValueDon();
				}
			}
		});

		$(".paiementCheck").on("click", function(){
			$(".paiementCheck").removeClass("active");
			$(this).addClass("active");
		});
	</script>
@endSection