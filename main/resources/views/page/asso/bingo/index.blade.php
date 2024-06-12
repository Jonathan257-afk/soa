@extends("layouts/asso/app")


@section("main")
    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">Vos Bingo <span style="color:rgba(0, 0, 0, 0.3);font-size:17px;">(A noter que les dates sont en {{ config("app.timezone_utc") }})</span></h1>
        <div class="text-end mt-4 mt-md-0"><a class="btn btn-outline-primary" href="{{ route('asso-bingo-add') }}"><i class="fas fa-plus"></i> Nouveau</a></div>
    </div>

    <div class="g-4 row">
		<div class="col-xxl-12 col-12">
			<div class="card g-4">
				<div class="pb-0 px-10 card-header">
					
				</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableauRevision" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Debut d'émission </th>
                                    <th>Date de Tirage</th>
                                    <th>Nom</th>
                                    <th>Prix d'un Ticket</th>
                                    <th>Tickets émis</th>
                                    <th>Tickets vendus</th>
                                    <th>Montant collecté</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bingos as $bingo)
                                    <tr>
                                        <td>{{ dateToString($bingo["dateDebut"]) }}</td>
                                        <td>{{ dateToString($bingo["date"]) }}</td>
                                        <td>{{ $bingo["libelle"] }}</td>
                                        <td>{{ spaceNombre($bingo["montant"]) }}  €</td>
                                        <td>{{ $bingo["max"] }}</td>
                                        <td>{{ $bingo["max"] - $bingo["ticket"] }}</td>
                                        <td>0  €</td>
                                        <td>
                                            <a href="{{ route('asso-bingo-info', $bingo['id'])}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection