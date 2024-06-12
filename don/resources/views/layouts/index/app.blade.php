@extends("layouts/app")

@section("head")
	@if(Route::is("index") || Route::is("game"))
		<link rel="stylesheet" media="screen" href="{{ asset('assets/css/game.css') }}">
		<style>
			.container-lot-in-game {
				transition : transform 0.3 ease;
			}

			.container-lot-in-game:hover {
				transform : scale(1.1);
			}
		</style>
	@endif

	@yield("header")
@endsection

@section("body")
<div>
	<div>
		<div class="o-layout">
			<div class="t-page">
				@include("layouts/index/nav")
				<main class="o-blocks">
					@yield("main")
				</main>

				<!-- Modal Show lot tombola-->
				<div class="modal fade" id="modalShowLot" data-bs-backdrop="static" data-bs-keyboard="false"
					tabindex="-1" aria-labelledby="modalShowLotLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<form method="post" id="form-modal-to-buy" action="#">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" style="text-align:center" id="modalShowLotLabel"></h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">

								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success" id="btn-buy-tombola">Voir</button>
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
								</div>
							</div>
						</form>
					</div>
				</div>


				<!-- Modal Show lot bingo-->
				<div class="modal fade" id="modalShowLotBingo" data-bs-backdrop="static" data-bs-keyboard="false"
					tabindex="-1" aria-labelledby="modalShowLotBingoLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<form method="post" id="form-modal-to-buy-bingo" action="#">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" style="text-align:center" id="modalShowLotBingoLabel"></h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">

								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success" id="btn-buy-bingo">Voir</button>
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
								</div>
							</div>
						</form>
					</div>
				</div>


				<footer class="o-footer">

				</footer>
			</div>
		</div>
	</div>
</div>
@endsection

@section("script")
<script>

	// tombola
	$(".showModalLot").off().on("click", function () {
		const id = $(this).data("id");
		
		$("#btn-buy-tombola").addClass("disable");

		AjaxPost(
			"{{ route('get-tombola-by-id') }}",
			{
				id: id
			},
			"",
			function (response) {
				setLot(response);
				$("#btn-buy-tombola").removeClass("disable");
			},
			function (error) {
				console.log(error);
			}
		);
	});

	$("#form-modal-to-buy").off().on("submit", function(e){
		e.preventDefault();
		if(!$("#btn-buy-tombola").hasClass("disable") && typeof $("#tombola-to-buy-id").val() != "undefined") {
			var tombolaId =  $("#tombola-to-buy-id").val();
			window.open("{{ route('index') }}" + "/tombola/view/" + tombolaId);
		}
		else 
			errorNotify("Une erreur est survenue ! Veuillez recommencer");
	});

	function setLot(tombola) {
		var str = `
			<div class="mantine-1jci8zy" style="background: linear-gradient(150deg, color-mix(in srgb, rgb(46,47,94) 70%, rgb(255, 255, 255)), color-mix(in srgb, rgb(46,47,94) 70%, rgb(0, 0, 0)));"> 
				<div class="mantine-rrxw64" tabindex="-1"> `+ tombola.lot.length +` lots à gagner !</div>
				<div class="mantine-Grid-root mantine-1a3lk33">
		`;
		$.each(tombola.lot, function (key, lot) {
			let attrContainer = (lot.link != null && lot.link != "") ? " style='cursor:pointer;' data-href='"+lot.link+"'" : ""; 
			str += `	
					<div class="mantine-Grid-col mantine-ocm5r">
						<div class="mantine-gmnaht">
							`+lot.libelle+`	
						</div>
						<div class="mantine-1od7zmz">
							<div ` + attrContainer +` class="mantine-kv9yl3 container-lot-in-game  container-lot-in-game-tombola">
								<p class="mantine-1tig8jw">🎁 À gagner</p>
								<a class="mantine-mchb6r" rel="noreferrer">
									<div class="mantine-Image-root mantine-15po0m8" style="width: 100%;">
										<figure class="mantine-11nhzn5 mantine-Image-figure">
											<div class="mantine-qqmv3w mantine-Image-imageWrapper">
												<img class="mantine-3y8yz3 mantine-Image-image" src="assets/img/lot/`+lot.tombola_id+`/`+lot.image+`" alt="giftImage" style="object-fit: cover; width: 100%; height: auto;">
											</div>
										</figure>
									</div>
								</a>
							</div>
						</div>
					</div>
						
			`
		});

		str += `
			</div>
		</div>
		<input type="hidden" name="_token" value="<?= csrf_token() ?>">
		<input type="hidden" id="tombola-to-buy-id" name="tombola_id" value="`+tombola.id+`">
		`;
		$("#modalShowLot .modal-body").html(str);
		$(".container-lot-in-game-tombola").on("click", function(){
			if($(this) != null && $(this).data("href") != "undefined"  && $(this).data("href") != ""  && $(this).data("href") != "#")
				window.open($(this).data("href"));
		});
	}

	// bingo
	$(".showModalLotBingo").off().on("click", function () {
		const id = $(this).data("id");
		
		$("#btn-buy-bingo").addClass("disable");

		AjaxPost(
			"{{ route('get-bingo-by-id') }}",
			{
				id: id
			},
			"",
			function (response) {
				setLotBingo(response);
				$("#btn-buy-bingo").removeClass("disable");
			},
			function (error) {
				console.log(error);
			}
		);
	});

	$("#form-modal-to-buy-bingo").off().on("submit", function(e){
		e.preventDefault();
		if(!$("#btn-buy-bingo").hasClass("disable") && typeof $("#bingo-to-buy-id").val() != "undefined") {
			var bingoId =  $("#bingo-to-buy-id").val();
			window.open("{{ route('index') }}" + "/bingo/view/" + bingoId);
		}
		else 
			errorNotify("Une erreur est survenue ! Veuillez recommencer");
	});

	function setLotBingo(bingo) {
		var str = `
			<div class="mantine-1jci8zy" style="background: linear-gradient(150deg, color-mix(in srgb, rgb(46,47,94) 70%, rgb(255, 255, 255)), color-mix(in srgb, rgb(46,47,94) 70%, rgb(0, 0, 0)));"> 
				<div class="mantine-rrxw64" tabindex="-1"> `+ bingo.lotbingo.length +` lots à gagner !</div>
				<div class="mantine-Grid-root mantine-1a3lk33">
		`;
		$.each(bingo.lotbingo, function (key, lot) {
			let attrContainer = (lot.link != null && lot.link != "") ? " style='cursor:pointer;' data-href='"+lot.link+"'" : ""; 
			str += `	
					<div class="mantine-Grid-col mantine-ocm5r">
						<div class="mantine-gmnaht">
							`+lot.libelle+`	
						</div>
						<div class="mantine-1od7zmz">
							<div ` + attrContainer +` class="mantine-kv9yl3 container-lot-in-game container-lot-in-game-bingo ">
								<p class="mantine-1tig8jw">🎁 À gagner</p>
								<a class="mantine-mchb6r" rel="noreferrer">
									<div class="mantine-Image-root mantine-15po0m8" style="width: 100%;">
										<figure class="mantine-11nhzn5 mantine-Image-figure">
											<div class="mantine-qqmv3w mantine-Image-imageWrapper">
												<img class="mantine-3y8yz3 mantine-Image-image" src="assets/img/lot/bingo/`+lot.bingo_id+`/`+lot.image+`" alt="giftImage" style="object-fit: cover; width: 100%; height: auto;">
											</div>
										</figure>
									</div>
								</a>
							</div>
						</div>
					</div>
						
			`
		});

		str += `
			</div>
		</div>
		<input type="hidden" name="_token" value="<?= csrf_token() ?>">
		<input type="hidden" id="bingo-to-buy-id" name="bingo_id" value="`+bingo.id+`">
		`;
		$("#modalShowLotBingo .modal-body").html(str);
		$(".container-lot-in-game-bingo").on("click", function(){
			if($(this) != null && $(this).data("href") != "undefined"  && $(this).data("href") != ""  && $(this).data("href") != "#" )
				window.open($(this).data("href"));
		});
	}
</script>
@yield("footer")
@endsection