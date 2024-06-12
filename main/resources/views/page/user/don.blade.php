@extends("layouts/user/app")

@section("main")

    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">HISTORIQUE DE MES DONS</h1>
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
                                    <th>Date ( {{ config("app.timezone_utc") }} )</th>
                                    <th>Association</th>
                                    <th>Libellé</th>
                                    <th>Montant du Don</th>
                                    <th>Tickets réçus</th>
                                    <th>Status du Tirage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(auth()->user() != null && isset(auth()->user()->don) && auth()->user()->don != null)
                                    @foreach(auth()->user()->don as $don)
                                        <tr>
                                            <td>{{ dateToString($don->created_at) }}</td>
                                            <td>
                                                <?php 
                                                    if($don->tombola_id != null && isset($don->tombola->association) && $don->tombola->association != null  && isset($don->tombola->association->name)) 
                                                        echo $don->tombola->association->name;
                                                    else if($don->bingo_id != null && isset($don->bingo->association) && $don->bingo->association != null  && isset($don->bingo->association->name))
                                                        echo $don->bingo->association->name;
                                                ?>
                                            <td>
                                                <?php 
                                                    if($don->tombola_id != null && isset($don->tombola->association) && $don->tombola->association != null  && isset($don->tombola->libelle)) 
                                                        echo $don->tombola->libelle;
                                                    else if($don->bingo_id != null && isset($don->bingo->association) && $don->bingo->association != null  && isset($don->bingo->libelle))
                                                        echo $don->bingo->libelle;
                                                ?>
                                            </td>
                                            <td>{{ spaceNombre($don->montant)  }}  €</td>
                                            <td>{{ spaceNombre($don->ticket) }}</td>
                                            <td>
                                                En Cours
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td  colspan="6" style="text-align:center;">Vous avez effectué aucun don</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
	
@endsection