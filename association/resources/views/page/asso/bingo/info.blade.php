@extends("layouts/asso/app")

@section("header")
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/auth.css') }}">
@endsection

@section("main")
    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">{{ $bingo->libelle}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a target="_blank" class="btn btn-outline-primary" href="{{ route('bingo-site', $bingo->id) }}"><i class="fas fa-eye"></i> Voir le site</a>
                @if($bingo->date < now())
                    <a class="btn btn-outline-success" href="{{ route('asso-bingo-tirage', $bingo->id) }}"><i class="fas fa-eye"></i> Voir le résultat</a>
                @endif
            </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="g-4 row">
                <div class="col-xxl-12 col-12">
                    <div class="card g-4">
                        <div class="pb-0 px-10 card-header">
                            <h3 class="mb-0">Historique d'achat</h3>
                            @if($bingo->date > now())
                                <div class="mb-2 chart-dropdown">
                                    <div class="nav-item dropdown">
                                        <button class="btn btn-outline-primary" type="button" id="btn-show-modal-add-acheteur"  data-bs-toggle="modal" data-bs-target="#addAcheteurModal">
                                            <i class="fas fa-plus"></i> Nouveau</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tableauRevision" class="display table table-striped table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date d'achat ( {{ config("app.timezone_utc") }} )</th>
                                            <th>Acheteur</th>
                                            <th>Nombre de ticket</th>
                                            <th>Don</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bingo->achat as $achat)
                                            <tr>
                                                <td>{{ dateToString($achat->created_at) }}</td>
                                                <td>
                                                    <?php 
                                                        if($achat->user_id != null && isset($achat->user) && $achat->user != null  && isset($achat->user->name))  
                                                            echo $achat->user->name . " ". $achat->user->first_name;
                                                        else if($achat->bienfetaire_id != null && isset($achat->bienfetaire) && $achat->bienfetaire != null  && isset($achat->bienfetaire->name))
                                                            echo $achat->bienfetaire->name . " ". $achat->bienfetaire->first_name;
                                                    ?>
                                                </td>
                                                <td>{{ $achat->ticket }}</td>
                                                <td>{{ spaceNombre(($achat->don != null) ? $achat->don->sum("montant") : 0) }}  €</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4">
            <div class="g-4 row">
                <div class="col-xxl-12 col-12">
                    <div class="card g-4">
                        <div class="pb-0 px-10 card-header">
                            <h3>Lot à gagner</h3>
                        </div>
                        <div class="card-body">
                            @foreach($bingo->lotbingo as $lot)
                                <div class='card'>
                                    <img src="{{asset('assets/img/lot/bingo/'. $lot->bingo_id . '/'. $lot->image)}}" class='card-img-top' alt='{{ $lot->libelle}}'>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $lot->libelle}}</h5>
                                        <p class="card-text">Lot N° {{ $lot->number}}</p>
                                        <p class="card-text">{{ spaceNombre($lot->price ) }} € (valeur estimée)</p>
                                        <a  class="card-text">{{ $lot->link }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    @if($bingo->date > now())
        <div class="modal fade" id="addAcheteurModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAcheteurModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addAcheteurModalLabel">Ajout d'un acheteur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('bingo-buy') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="RegisterOrganism--RequiredInformation">
                                *renseignement obligatoire
                            </div>

                            <section class="RegisterOrganism Register--Step"  style="margin-top:0px">
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
                                                        name="plus" class="Input">
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
                            </section>

                            <section class="RegisterOrganism Register--Step" >
                                <fieldset>
                                    <legend>Information sur l'acheteur</legend>
                        
                            
                                    <div class="RegisterOrganism--Name HaFormField">
                                        <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                            <div>
                                                <div class="HaFormField--Label">
                                                    <label  class="Label col-form-label">
                                                        Nom *
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input type="text"  required style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" id="don-tombola-buy" maxlength="100"
                                                        name="name" class="Input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="RegisterOrganism--Name HaFormField">
                                        <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                            <div>
                                                <div class="HaFormField--Label">
                                                    <label  class="Label col-form-label">
                                                        Prénom
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input type="text"  style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" id="don-tombola-buy" maxlength="100"
                                                        name="first_name" class="Input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="RegisterOrganism--Name HaFormField">
                                        <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                            <div>
                                                <div class="HaFormField--Label">
                                                    <label  class="Label col-form-label">
                                                        Email
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input type="email" style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" id="don-tombola-buy" maxlength="100"
                                                        name="email" class="Input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="RegisterOrganism--Name HaFormField">
                                        <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                            <div>
                                                <div class="HaFormField--Label">
                                                    <label  class="Label col-form-label">
                                                        Numéro téléphone
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input type="text" style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" id="don-tombola-buy" maxlength="100"
                                                        name="tel" class="Input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </section>

                            <section class="RegisterOrganism Register--Step" >
                                <fieldset>
                                    <legend>Option de Don</legend>
                        
                            
                                    <div class="RegisterOrganism--Name HaFormField">
                                        <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                            <div class="col-auto">
                                                <div class="HaFormField--Label">
                                                    <label  class="Label col-form-label">
                                                        A donner
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="HaFormField--Field">
                                                    <div class="Input--Wrapper Input--Wrapper-Medium">
                                                        <input type="number"  style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" id="don-tombola-buy" maxlength="100"
                                                        name="don" class="Input" placeholder=" x €">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="don-bingo-buy" required value="{{$bingo->id}}"
                                                        name="bingoId" class="Input">
                                </fieldset>
                            </section>

                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection