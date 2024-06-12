@extends("layouts/asso/app")

@section("header")
    <style>
        .number-tirage{
            background-color:#2e2f5e;
            padding:auto;
        }
    </style>
@endsection

@section("main")
    <div class="d-md-flex align-items-center justify-content-between mb-5">
        <h1 class="mb-0">Tirage du Bingo " {{$bingo->libelle}} " par " {{ $bingo->association->name}} "</h1>
    </div>

    <div class="g-4 row">
		<div class="col-xxl-12 col-12">
			<div class="card g-4">
				<div class="pb-0 px-10 card-header">
                    <h4>Numéro Tiré</h4>
				</div>
                <div class="card-body"  id="tirage-number-container">
                    
				</div>
			</div>
		</div>
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
                                    <th>Gagnant</th>
                                    <th>Lot</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tirage-gagnant-container">

                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
	
@endsection

@section("footer")
    <script>
        const tirage = {{ $bingo->tirage }};
        const gagnant = <?= json_encode($gagnantbingo) ?>;

        var numberGagnant = {};
        $.each(gagnant , function(index, g){
            numberGagnant[g.gagnant_at] = g;
        });

        var index = 0;
        var intervalId = setInterval(setTirage, 1000);
        
        function setTirage() {
            if(typeof tirage[index] != "undefined") {
                $("#tirage-number-container").append("<div class='col-lg-1 col-md-1 col-xs-1 col-sm-1 badge number-tirage'><span class=''>"+tirage[index]+"</span></div>");
                
                if(typeof numberGagnant[tirage[index]] != "undefined" && numberGagnant[tirage[index]] != null) {
                    let td = `
                        <tr>
                            <td>`+numberGagnant[tirage[index]].gagnant+`</td>
                            <td>`+ numberGagnant[tirage[index]].lot +`</td>
                            <td>
                                <a class="btn btn-outline-primary" href="#"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    `;
                    $("#tirage-gagnant-container").append(td);
                }
                index++;
            }
            else 
                clearInterval(intervalId);
        }
    </script>
@endsection