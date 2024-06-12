@extends("layouts/index/app")

@section("main")        
	<main class="o-blocks">
		<section id="bComponentContenuHero0" class="c-heroBanner">
			<div lazy-background="" class="c-heroBanner__circle -null"></div>
			<div class="c-heroBanner__oblongs">
			<div class="a-oblong"></div>
			<div class="a-oblong"></div>
			<div class="a-oblong"></div>
			<div class="a-oblong"></div>
			</div>
			<div class="row -main c-heroBanner__row">
			<!---->
			<div class="column-24 lg-column-12 c-heroBanner__content m-enteteSection">
				<!---->
				<div class="m-editor -hero -mint">
				<h1><strong><u>Tombola et Bingo</u></strong> en ligne</h1>
				<p>Touchez un public plus large et bénéficiez de la viralité d’internet. Ou Gagner pour la bonne cause tout en aidant les associations.</p>
				</div>
				<ul class="m-editor__links -horizontal">
				<li><a href="{{ route('select-signIn') }}" data-ux="Showcase_ActivityRaffle_Hero_SignUp"
					target="_self" class="a-button a-buttonText -primary">
					<div class="a-button__container">
						<!---->
						<!----> <span>S'inscrire</span>
					</div>
					</a></li>
				</ul>
			</div>
			<div class="column-24 lg-column-9 lg-offset-1 no-width c-heroBanner__logo">
				<!---->
				<!---->
			</div>
			</div>
		</section>
		<div class="row">
			<section class="mantine-1xq6p4z col-lg-6 col-md-6">
				<div class="mantine-dwxshi" style="margin-bottom: 40px; text-align: center;">
				<h2 class="mantine-18kyze8 mantine-1cg6ach" style="background: url({{asset('assets/img/header-bg.svg')}});background-repeat: no-repeat;background-position: center;">Les prochaines <span class="mantine-1vat4w">Tombola</span></h2>
				</div>
				<div class="container-fluid" >
				<div class="table-responsive">
					<table class="table table-striped table-hover" style="">
					<thead style="background: #2e2f5e;; color: #ffffff;">
						<tr>
							<th class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;color:#ffffff;">Date de Tirage ( {{ config("app.timezone_utc") }} )</th>
							<th class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;color:#ffffff;">Association</th>
							<th class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;color:#ffffff;">Prix Ticket</th>
							<!-- <td class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;">Dotation</td> -->
							<th style="border: none;"></th>
						</tr>
					</thead>
					<tbody>
						@if(auth()->user())
							@if(count($tombolas) > 0)
								@foreach($tombolas as $tombola) 
									<tr data-canceled="false" data-finished="false" href="#"
										style="cursor: pointer;">
										<td style="font-size:14px;">{{ dateToString($tombola->date) }}</td>
										<td style="font-size:14px;" class="mantine-1h4e3s6" >{{ $tombola->association->name }}</td>
										<td style="font-size:14px;" class="mantine-1h4e3s6">{{ spaceNombre($tombola->montant) }}  €</td>
										
										<!-- <td style="font-size:14px;">Gratuit</td> -->
										<td  style="font-size:14px;"><button data-id="{{ $tombola->id }}"  data-bs-toggle="modal" data-bs-target="#modalShowLot" class="btn btn-outline-success showModalLot">Voir les
											lots et jouer</button></td>
									</tr>
								@endforeach
							@else 
								<tr style="text-align:center;">
									<td colspan="4" style="font-size:14px;text-align:center;">Aucun Tombola Disponible pour le moment !</td>
								</tr>
							@endif
						@else
							<tr style="text-align:center;">
								<td colspan="4" style="font-size:14px;text-align:center;">Vous devez vous connéctez pour pouvoir jouer</td>
							</tr>
						@endif
					</tbody>
					</table>
				</div>
				<div class="mantine-8od8ev" style="text-align:center">
				<a href="{{ route('game') }}" class="btn btn-danger" style="margin-top: 44px;">
					<div class="mantine-3xbgk5 mantine-Button-inner"><span
					class="mantine-qo1k2 mantine-Button-label">Voir tous les tombolas<em></em></span></div>
				</a></div>
				</div>
			</section>

			<section class="mantine-1xq6p4z col-lg-6 col-md-6">
				<div class="mantine-dwxshi" style="margin-bottom: 40px; text-align: center;">
					<h2 class="mantine-18kyze8 mantine-1cg6ach" style="background: url({{asset('assets/img/header-bg.svg')}});background-repeat: no-repeat;background-position: center;">Les prochaines <span class="mantine-1vat4w">BINGO</span></h2>
				</div>
				<div class="container-fluid" >
					<div class="table-responsive">
					<table class="table table-striped table-hover" style="">
						<thead style="background: #2e2f5e;; color: #ffffff;">
							<tr>
								<th class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;color:#ffffff;">Date de Tirage ( {{ config("app.timezone_utc") }} )</th>
								<th class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;color:#ffffff;">Association</th>
								<th class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;color:#ffffff;">Prix Ticket</th>
								<!-- <td class="mantine-16k5z1f" style="cursor: pointer;font-size:18px;">Dotation</td> -->
								<th style="border: none;"></th>
							</tr>
						</thead>
						<tbody>
							@if(auth()->user())
								@if(isset($bingos) && $bingos != null && count($bingos) > 0)
									@foreach($bingos as $bingo) 
										<tr data-canceled="false" data-finished="false" href="#"
											style="cursor: pointer;">
											<td style="font-size:14px;">{{ dateToString($bingo->date) }}</td>
											<td style="font-size:14px;" class="mantine-1h4e3s6" >{{ $bingo->association->name }}</td>
											<td style="font-size:14px;" class="mantine-1h4e3s6">{{ spaceNombre($bingo->montant) }}  €</td>
											
											<!-- <td style="font-size:14px;">Gratuit</td> -->
											<td  style="font-size:14px;"><button data-id="{{ $bingo->id }}"  data-bs-toggle="modal" data-bs-target="#modalShowLotBingo" class="btn btn-outline-success showModalLotBingo">Voir les
												lots et jouer</button></td>
										</tr>
									@endforeach
								@else 
									<tr style="text-align:center;">
										<td colspan="4" style="font-size:14px;text-align:center;">Aucun Bingo Disponible pour le moment !</td>
									</tr>
								@endif
							@else
								<tr style="text-align:center;">
									<td colspan="4" style="font-size:14px;text-align:center;">Vous devez vous connéctez pour pouvoir jouer</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
				<div class="mantine-8od8ev" style="text-align:center">
					<a href="{{ route('game') }}" class="btn btn-danger" style="margin-top: 44px;">
						<div class="mantine-3xbgk5 mantine-Button-inner"><span
						class="mantine-qo1k2 mantine-Button-label">Voir tous les Bingo<em></em></span></div>
					</a>
				</div>
			</section>
		</div>
	</main>
@endsection