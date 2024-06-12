@extends("layouts/user/app")

@section("main")

    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">HISTORIQUE DE MES ACHATS</h1>
    </div>

    <div class="g-4 row">
		<div class="col-xxl-12 col-12">
			<div class="card g-4">
				<div class="pb-0 px-10 card-header">
                    <h4>Tickets Gagnant</h4>
				</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableauRevision" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Date d'achat ( {{ config("app.timezone_utc") }} )</th>
                                    <th>évènement</th>
                                    <th>Association</th>
                                    <th>Libellé</th>
                                    <th>Ticket N°</th>
                                    <th>Lot</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($gagnants) > 0)
                                    @foreach($gagnants as $gagnant)
                                        <tr>
                                            <?php $achat = $gagnant->bingoticket->achat; ?>
                                            <td>{{ dateToString($achat->created_at) }}</td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null) 
                                                        echo "Tombola";
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->montant))
                                                        echo "Bingo";
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola->association) && $achat->tombola->association != null  && isset($achat->tombola->association->name)) 
                                                        echo $achat->tombola->association->name;
                                                    else if($achat->bingo_id != null && isset($achat->bingo->association) && $achat->bingo->association != null  && isset($achat->bingo->association->name))
                                                        echo $achat->bingo->association->name;
                                                ?></td>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola) && $achat->tombola != null  && isset($achat->tombola->libelle)) 
                                                        echo $achat->tombola->libelle;
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->libelle))
                                                        echo $achat->bingo->libelle;
                                                ?>
                                            </td>
                                            <td>{{ $gagnant->bingoticket->num_ticket }}</td>
                                            <td>{{ $gagnant->lotbingo->libelle }}</td>
                                            <td>
                                                @if($achat->bingo_id != null)
                                                    <a target="_blank" href="{{ route('mini-site-bingo-tirage', $achat->bingo_id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                @endif  
                                            </td>
                                            <td>
                                                @if($gagnant->bingoticket_id == null)
                                                    
                                                @elseif($gagnant->bingoticket_id != null)
                                                    <a target="_blank" href="{{ route('ticket-user-bingo-to-print', $gagnant->bingoticket_id) }}" class="btn btn-success btn-sm"><i class="fas fa-print"></i></a>
                                                @endif  
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td  colspan="7" style="text-align:center;">Vous n'avez aucun tickets gagnant</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>

    <div class="g-4 row">
		<div class="col-xxl-12 col-12">
			<div class="card g-4">
				<div class="pb-0 px-10 card-header">
                    <h4>Tickets en cours</h4>
				</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableauRevision" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Date d'achat ( {{ config("app.timezone_utc") }} )</th>
                                    <th>évènement</th>
                                    <th>Association</th>
                                    <th>Libellé</th>
                                    <th>Prix</th>
                                    <th>Nombre de tickets Achetés</th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($achats) > 0)
                                    @foreach($achats as $achat)
                                        <tr>
                                            <td>{{ dateToString($achat->created_at) }}</td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null) 
                                                        echo "Tombola";
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->montant))
                                                        echo "Bingo";
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola->association) && $achat->tombola->association != null  && isset($achat->tombola->association->name)) 
                                                        echo $achat->tombola->association->name;
                                                    else if($achat->bingo_id != null && isset($achat->bingo->association) && $achat->bingo->association != null  && isset($achat->bingo->association->name))
                                                        echo $achat->bingo->association->name;
                                                ?></td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola) && $achat->tombola != null  && isset($achat->tombola->libelle)) 
                                                        echo $achat->tombola->libelle;
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->libelle))
                                                        echo $achat->bingo->libelle;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola) && $achat->tombola != null  && isset($achat->tombola->montant)) 
                                                        echo spaceNombre($achat->tombola->montant) . " €";
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->montant))
                                                        echo spaceNombre($achat->bingo->montant) . " €";
                                                ?>
                                            </td>
                                            <td> {{ spaceNombre($achat->ticket) }}</td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola) && $achat->tombola != null  && isset($achat->tombola->montant)) 
                                                        echo spaceNombre($achat->tombola->montant * $achat->ticket) . " €";
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->montant))
                                                        echo spaceNombre($achat->bingo->montant * $achat->ticket) . " €";
                                                ?>        
                                            </td>
                                            
                                            <td>
                                                @if($achat->tombola_id != null)
                                                    <a target="_blank" href="{{ route('tombola-site', $achat->tombola_id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                @elseif($achat->bingo_id != null)
                                                    <a target="_blank" href="{{ route('bingo-site', $achat->bingo_id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                @endif    
                                            </td>

                                            <td>
                                                @if($achat->tombola_id != null)
                                                    <a target="_blank" href="{{ route('ticket-to-print', $achat->id) }}" class="btn btn-success btn-sm"><i class="fas fa-print"></i></a>
                                                @elseif($achat->bingo_id != null)
                                                    <a target="_blank" href="{{ route('tickets-user-bingo-to-print', $achat->id) }}" class="btn btn-success btn-sm"><i class="fas fa-print"></i></a>
                                                @endif    
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td  colspan="9" style="text-align:center;">Vous n'avez aucun ticket en cours</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>

    <div class="g-4 row">
		<div class="col-xxl-12 col-12">
			<div class="card g-4">
				<div class="pb-0 px-10 card-header">
                    <h4>Tickets Perdant</h4>
				</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableauRevision" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Date d'achat ( {{ config("app.timezone_utc") }} )</th>
                                    <th>évènement</th>
                                    <th>Association</th>
                                    <th>Libellé</th>
                                    <th>Ticket N°</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($perdants) > 0)
                                    @foreach($perdants as $ticket)
                                        <?php $achat = $ticket->achat; ?>
                                        <tr>
                                            <td>{{ dateToString($achat->created_at) }}</td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null) 
                                                        echo "Tombola";
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->montant))
                                                        echo "Bingo";
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola->association) && $achat->tombola->association != null  && isset($achat->tombola->association->name)) 
                                                        echo $achat->tombola->association->name;
                                                    else if($achat->bingo_id != null && isset($achat->bingo->association) && $achat->bingo->association != null  && isset($achat->bingo->association->name))
                                                        echo $achat->bingo->association->name;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($achat->tombola_id != null && isset($achat->tombola) && $achat->tombola != null  && isset($achat->tombola->libelle)) 
                                                        echo $achat->tombola->libelle;
                                                    else if($achat->bingo_id != null && isset($achat->bingo) && $achat->bingo != null  && isset($achat->bingo->libelle))
                                                        echo $achat->bingo->libelle;
                                                ?>
                                            </td>
                                            <td>{{ $ticket->num_ticket }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td  colspan="6" style="text-align:center;">Vous n'avez aucun ticket perdant</td>
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