@extends("layouts/asso/app")

@section("header")
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/auth.css') }}">
@endsection

@section("main")
    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">Ajout d'un nouveau Tombola</h1>
        <div class="text-end mt-4 mt-md-0"><a class="btn btn-outline-primary" href="{{ route('asso-tombola') }}"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left">
                        <path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z" class=""></path>
                      </svg> Retour</a></div>
    </div>
    <form method="post" id="form-add-tombola" action="{{ route('asso-tombola-store') }}"  enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="pb-0 px-10 card-header">
                <h5 class="mb-0">Information sur le tombola</h5>
                <div class="mb-2 chart-dropdown">
						<div class="nav-item dropdown">
                            <a aria-expanded="false" role="button"
								class="dropdown-toggle nav-link" tabindex="0" href="#">
                                    <svg
									aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
									class="svg-inline--fa fa-bars " role="img"
									xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
									<path fill="currentColor"
										d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z">
									</path>
								</svg></a></div>
					</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group w-100"><label class="form-label" for="formBasic">Date de début d'émission des tickets  ( {{ config("app.timezone_utc") }} ):</label><span
                                class="required"></span>
                            <div class=" css-b62m3t-container"><span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class=" css-1d8n9bt">
                                            <input class="" required type="datetime-local" name="dateDebut" id="input-add-date-debut-tombola"
                                                style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group w-100"><label class="form-label" for="formBasic">Date de tirage ( {{ config("app.timezone_utc") }} ):</label><span
                                class="required"></span>
                            <div class=" css-b62m3t-container"><span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class=" css-1d8n9bt">
                                            <input class="" required type="datetime-local" name="date" id="input-add-date-tombola"
                                                style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group w-100"><label class="form-label" for="formBasic">Libellé:</label><span
                                class="required"></span>
                            <div class=" css-b62m3t-container"><span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class=" css-1d8n9bt">
                                            <input class="" required name="libelle"  id="input-add-libelle-tombola"
                                                style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group w-100"><label class="form-label" for="formBasic">Prix d'un Ticket en  €:</label><span
                                class="required"></span>
                            <div class=" css-b62m3t-container"><span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class=" css-1d8n9bt">
                                            <input class="" required type="number" name="montant"  id="input-add-montant-tombola"
                                                style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="form-group w-100">
                            <div>
                                <label for="HaFormFieldInput-1">
                                   Utiliser l'option de tirage du plateforme ? *
                                </label>
                            </div>
                            <div class=" css-b62m3t-container">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-yes check-yes-tirage" id="container-for-check-yes-tirage"  style="text-align:center;border-radius:0px;">
                                        <label id="label-for-tirage-yes" for="tirage-yes" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label  check-yes-tirage">
                                            Oui
                                        </label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 active col-sm-6 HaButton HaButton-Fill HaButton-Primary HaButton-Medium check-no check-no-tirage" id="container-for-check-no-tirage"  style="text-align:center;border-radius:0px;">
                                        <label id="label-for-tirage-no"  for="tirage-no" style="cursor:pointer; text-align:center;color:#ffffff!important" class="Label check-no-tirage">
                                            Non
                                        </label>
                                    </div>
                                </div>
                                
                                <input type="radio" style="display:none" id="tirage-yes" value="yes" name="tirage">
                                <input type="radio" style="display:none" checked="true" id="tirage-no" value="no" name="tirage">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10" id="container-config-ticker">
                        <fieldset>
                            <legend>Configiuration des tickets</legend>
                            <div class="form-group w-100">
                                <label class="form-label" for="formBasic">Nombre Tickets émettre:</label>
                                <span class="required"></span>
                                <div class=" css-b62m3t-container"><span id="react-select-7-live-region"
                                        class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                        aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                    <div class=" css-1s2u09g-control">
                                        <div class=" css-1d8n9bt">
                                                <input class="" type="number" value="0" required name="ticket"  id="input-add-number-tombola"
                                                    style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group w-100">
                                <label class="form-label" for="formBasic">Vendre les tickets à partir du numéro:</label>
                                <span class="required"></span>
                                <div class=" css-b62m3t-container"><span id="react-select-7-live-region"
                                        class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                        aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                    <div class=" css-1s2u09g-control">
                                        <div class=" css-1d8n9bt">
                                                <input class="" type="number" value="0" required name="debut"  id="input-add-number-tombola"
                                                    style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="pb-0 px-10 card-header">
                <h5 class="mb-0">Lot à gagner</h5>
                <div class="mb-2 chart-dropdown">
                    <div class="nav-item dropdown">
                        <button class="btn btn-outline-primary" type="button" id="btn-show-modal-add-lot"  data-bs-toggle="modal" data-bs-target="#addLotModal">
                            <i class="fas fa-plus"></i> Nouveau</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" id="input-nombre-lot-to-add" value="0" name="numberLotAdd">
                <div class="row"  id="container-lot">
                </div>
            </div>
        </div>

        <div class="d-md-flex align-items-center justify-content-between mb-5">
        <div class="text-end mt-4 mt-md-0 mb-0"><a class="btn btn-outline-danger" href="{{ route('asso-tombola') }}"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left">
                            <path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z" class=""></path>
                        </svg> Annuler</a></div>
            <div class="text-end mt-4 mt-md-0"><button class="btn btn-outline-success"
                            type="submit" id="btn-add-tombola">Enregistrer</button></div>
        </div>
    </form>
    
    <div class="modal fade" id="addLotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addLotModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addLotModalLabel">Ajout d'un lot</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-add-lot"  enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group w-100">
                            <label class="form-label" for="formBasic">Lot N° :</label><span
                                                class="required"></span>
                            <div class=" css-b62m3t-container">
                                <span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class=" css-1d8n9bt">
                                            <input class="" readonly required type="number" id="input-add-number-lot" name="number"
                                                style="color: inherit; background-color: rgba(0, 0, 0, 0.1); opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group w-100">
                            <label class="form-label" for="formBasic">libelle du Lot:</label><span
                                                class="required"></span>
                            <div class=" css-b62m3t-container">
                                <span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class=" css-1d8n9bt">
                                            <input class="" required type="text" id="input-add-libelle-lot" name="libelle"
                                                style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group w-100">
                            <label class="form-label" for="formBasic">Estimation du Prix (en  €) :</label><span
                                                class="required"></span>
                            <div class=" css-b62m3t-container">
                                <span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class=" css-1d8n9bt">
                                            <input class="" required type="number" id="input-add-price-lot" name="price"
                                                style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group w-100">
                            <label class="form-label" for="formBasic">Lien vers le Lot:</label>
                            <div class=" css-b62m3t-container">
                                <span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                <div class=" css-1s2u09g-control">
                                    <div class="css-1d8n9bt">
                                            <input type="text" id="input-add-link-lot" name="link" placeholder="https://www.exapmle.com"
                                                style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px; margin: 0px; outline: 0px; padding: 0px;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group w-100">
                            <label class="form-label" for="formBasic">Image du Lot:</label><span
                                                class="required"></span>
                            <div class=" css-b62m3t-container">
                                <span id="react-select-7-live-region"
                                    class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false"
                                    aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                                    <div style="width:100%;text-align: center;" id="container-img-input-add-lot">
                                <div class="card card-stats card-round"
                                    style="background-color: #f9f9f9;border:1px #000 solid;">
                                    <div class="card-body" style="width: auto;height: auto;">
                                        <div>
                                            <img class="img_imageUploader" style="width: 100px;height: 100px;" src="{{ asset('assets/img/image-uploader-default.jpg') }}">
                                        </div>
                                    </div>
                                    <div style="margin-left: 30px;margin-right: 30px;">
                                        <label for="img-input-add-lot" class="btn btn-primary btn-border btn-round btn-lg btn-block">
                                            Changer l'image
                                        </label>
                                    </div>
                                    <input require style="display:none;"
                                        class="form-control" type="file"
                                        id="img-input-add-lot" name="image_uploader"
                                        accept="image/png, image/jpeg, image/jpg">
                                </div>
                            </div>
                            
                            </div>
                            
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btn-add-lot">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("footer")
    <script>
        var lots = [];
        var imageToSendLot = null;
        var nameImageLot = "";
        var now = new Date().toISOString().slice(0, 16);

        document.getElementById('input-add-date-tombola').min = now;
        document.getElementById('input-add-date-debut-tombola').min = now;

        $("#container-for-check-yes-tirage").off().on("click", function(){
			$("#container-for-check-no-tirage").removeClass("active");
			$(this).addClass("active");
			$("#tirage-yes").prop("checked", true);
            $("#container-config-ticker").fadeOut(500);
		});

		$("#container-for-check-no-tirage").off().on("click", function(){
			$("#container-for-check-yes-tirage").removeClass("active");
			$(this).addClass("active");
			$("#tirage-no").prop("checked", true);
            $("#container-config-ticker").fadeIn(500);
		});

		$("#tirage-yes").off().on("click", function(){
			$("#container-for-check-no-tirage").removeClass("active");
			$(this).parent().addClass("active");
            $("#container-config-ticker").fadeOut(500);
		});

		$("#tirage-no").off().on("click", function(){
			$("#container-for-check-yes-tirage").removeClass("active");
			$(this).parent().addClass("active");
            $("#container-config-ticker").fadeIn(500);
		});

        $("#btn-show-modal-add-lot").off().on("click", function() {
            $("#input-add-number-lot").val(lots.length + 1);
        });

        $("#img-input-add-lot").off().on("change", function(e){
            if(imageToSendLot != null)
                imageToSendLot = null;

            imageToSendLot = e.target.files[0];
            nameImageLot = getNameImage(imageToSendLot);

            if (e.target && e.target.files && e.target.files[0]) {
                var reader = new FileReader();

                reader.onloadend = function() {
                    $('#container-img-input-add-lot .img_imageUploader').attr('src', reader.result);
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });

        $("#form-add-lot").off().on("submit", function(e){
            e.preventDefault();
            sendFile(imageToSendLot, nameImageLot);

            let btnAnimate = new Bouton("btn-add-lot");
            btnAnimate.attenteBtn();

            var reader = new FileReader();

            reader.onloadend = function() {
                var lotToSend = {};
            
                lotToSend["image"] = imageToSendLot;
                lotToSend["name_image"] = nameImageLot;
                lotToSend["number"] = $("#input-add-number-lot").val();
                lotToSend["price"] = $("#input-add-price-lot").val();
                lotToSend["libelle"] = $("#input-add-libelle-lot").val();
                lotToSend["link"] = $("#input-add-link-lot").val();
                lotToSend["pathImage"] = reader.result;

                

                lots.push(lotToSend);

                btnAnimate.arreter();
                $("#addLotModal").modal("hide");

                $("#input-nombre-lot-to-add").val(lots.length);
                appendNewValueInLotList();
            }

            reader.readAsDataURL(imageToSendLot);
        });

        function sendFile(fileToSend, nameFile) {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var data = new FormData();
            data.append('fileToSave', fileToSend);
            data.append('name', nameFile);

            fetch("{{ route('file-store-tmp') }}", {
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

        function appendNewValueInLotList() {
            $("#container-lot").html("");
            $.each(lots, function(key, lot) {
                if (lot != null) {
                    var str = "<div class='col-md-3'>"+
                        "<div class='card'>" +
                            "<img src='"+lot["pathImage"]+"' class='card-img-top' alt='...'>"+
                            '<div class="card-body">'+
                                '<h5 class="card-title">'+lot["libelle"]+'</h5>'+
                                '<p class="card-text">Lot N° '+lot["number"]+'</p>'+
                                '<p class="card-text">'+lot["price"]+' € (valeur estimée)</p>'+
                                '<a  class="card-text">'+lot["link"]+'</a>'+
                                '<input type="hidden" name="libelleLot'+key+'" value="'+lot["libelle"]+'" >' +
                                '<input type="hidden" name="numberLot'+key+'" value="'+lot["number"]+'" >' +
                                '<input type="hidden" name="nameImageLot'+key+'" value="'+lot["name_image"]+'" >' +
                                '<input type="hidden" name="linkLot'+key+'" value="'+lot["link"]+'" >' +
                                '<input type="hidden" name="price'+key+'" value="'+lot["price"]+'" >' +
                            '</div>'+
                        '</div>'+
                    '</div>';

                    $("#container-lot").append(str);
                }
            });
        }
    </script>
@endsection

