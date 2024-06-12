@extends("layouts/asso/app")


@section("main")
    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">Vos Dons</h1>
        <div class="text-end mt-4 mt-md-0"><a class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#addDonateurModal"><i class="fas fa-plus"></i> Nouveau</a></div>
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
                                    <th>Bienfetaire</th>
                                    <th>Email</th>
                                    <th>Tel</th>
                                    <th>Evènement</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dons as $don)
                                    <tr>
                                        <td>
                                            <?php 
                                                if($don->user_id != null && isset($don->user) && $don->user != null  && isset($don->user->name))  
                                                    echo $don->user->name . " ". $don->user->first_name;
                                                else if($don->bienfetaire_id != null && isset($don->bienfetaire) && $don->bienfetaire != null  && isset($don->bienfetaire->name))
                                                    echo $don->bienfetaire->name . " ". $don->bienfetaire->first_name;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($don->user_id != null && isset($don->user) && $don->user != null  && isset($don->user->email))  
                                                    echo $don->user->email;
                                                else if($don->bienfetaire_id != null && isset($don->bienfetaire) && $don->bienfetaire != null  && isset($don->bienfetaire->email))
                                                    echo $don->bienfetaire->email;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($don->user_id != null && isset($don->user) && $don->user != null  && isset($don->user->tel))  
                                                    echo $don->user->tel;
                                                else if($don->bienfetaire_id != null && isset($don->bienfetaire) && $don->bienfetaire != null  && isset($don->bienfetaire->tel))
                                                    echo $don->bienfetaire->tel;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($don->tombola_id != null && isset($don->tombola) && $don->tombola != null  && isset($don->tombola->libelle))  
                                                    echo $don->tombola->libelle;
                                                else if($don->bingo_id != null && isset($don->bingo) && $don->bingo != null  && isset($don->bingo->libelle))
                                                    echo $don->bingo->libelle;
                                            ?>
                                        </td>
                                        <td>{{ spaceNombre($don->montant)  }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="addDonateurModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDonateurModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDonateurModalLabel">Ajout d'un Donateur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('asso-don-store') }}">
                    @csrf
                    <div class="modal-body">
                        <section class="RegisterOrganism Register--Step" >
                            
                            <div class="RegisterOrganism--Name HaFormField">
                                <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                    <div>
                                        <div class="HaFormField--Label">
                                            <label  class="Label col-form-label">
                                                Nom du Donateur <span class="required"></span>
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
                                                Prénom du Donateur 
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
                                                Email du Donateur
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
                                                Numéro téléphone du Donateur 
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

                            <div class="RegisterOrganism--Name HaFormField">
                                <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                    <div>
                                        <div class="HaFormField--Label">
                                            <label  class="Label col-form-label">
                                                A donner
                                            </label><span class="required"></span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="HaFormField--Field">
                                            <div class="Input--Wrapper Input--Wrapper-Medium">
                                                <input required type="number"  style="border-radius: 3px!important;border: 2px solid #00909e !important;" data-max="3" id="don-tombola-buy" maxlength="100"
                                                    name="don" class="Input" placeholder=" x €">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="RegisterOrganism--Name HaFormField" id="container-select-tombola-add-don">
                                <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                    <div>
                                        <div class="HaFormField--Label">
                                            <label  class="Label col-form-label">
                                                Donner des billets pour le tombola
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="HaFormField--Field">
                                            <div class="Input--Wrapper Input--Wrapper-Medium">
                                                <select style="border-radius: 3px!important;border: 2px solid #00909e !important;"
                                                    name="tombola" id="select-tombola-add-don" class="Input form-control">
                                                    <option selected="selected" value=""></selected>
                                                    @foreach($tombolas as $tombola)
                                                        <option value="{{ $tombola->id}}">{{ $tombola->libelle }}</selected>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="RegisterOrganism--Name HaFormField" id="container-select-bingo-add-don">
                                <div class="row g-3 align-items-center" style="margin-bottom:20px;">
                                    <div>
                                        <div class="HaFormField--Label">
                                            <label  class="Label col-form-label">
                                                Donner des billets pour le Bingo
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="HaFormField--Field">
                                            <div class="Input--Wrapper Input--Wrapper-Medium">
                                                <select style="border-radius: 3px!important;border: 2px solid #00909e !important;"
                                                    name="bingo" class="Input form-control" id="select-bingo-add-don">
                                                    <option selected="selected" value=""></selected>
                                                    @foreach($bingos as $bingo)
                                                        <option value="{{ $bingo->id}}">{{ $bingo->libelle }}</selected>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="RegisterOrganism--RequiredInformation">
                            <span
                                class="required"></span>renseignement obligatoire
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section("footer")
    <script>
        $("#select-tombola-add-don").off().on("change", function() {
            if($(this).val() != "") {
                $("#select-bingo-add-don").val("");
                $("#container-select-bingo-add-don").hide(500);
            }
            else
                $("#container-select-bingo-add-don").show(500);
        });

        $("#select-bingo-add-don").off().on("change", function() {
            if($(this).val() != "") {
                $("#select-tombola-add-don").val("");
                $("#container-select-tombola-add-don").hide(500);
            }
            else
                $("#container-select-tombola-add-don").show(500);
        });
    </script>
@endsection