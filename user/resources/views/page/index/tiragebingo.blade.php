@extends("layouts/index/minisite")

@section("header") 
    <title>Tirage du bingo {{$bingo->libelle}} | {{  $bingo->association->name }}</title>
    <style>
        .no-border, table>.no-border, table>thead>.no-border, table>thead>tr>.no-border, table>tbody>tr>.no-border, table>tbody>.no-border {
            border: none!important;
        }

        table, table>thead,table>thead>tr,table>thead>tr>th,table>tbody,,table>tbody>tr,table>thead>tr>td {
            text-align:center;
            background-color: rgba(0,0,0,0);
        }

        .table-bingo {
            background-color: #2e2f5e;
            border : 2px solid rgba(0, 0, 0, 0.3);
            border-radius: 20px;
        }

        .color-white {
            color:#ffffff!important;
            font-weight: bold!important;
        }

        .color-black {
            color:#000!important;
            font-weight: bold!important;
        }

        .container-number-tirer {
            display: flex; 
            justify-content: center; align-items: center;
            height:200px;
        }

        .container-number-tirer .badge {
            font-size:80px;
            color:#000;
            font-weight: bold;
            padding:20px;
            border : 10px solid #2e2f5e;
            background-color:  rgb(46, 47, 94, 0.5);
            box-shadow: 5px 5px 5px 5px rgba(0,255,0,0.3)!important;
        }
    </style>
@endsection

@section("nav-desktop")
    <nav class="o-header__content o-header__logo">
        <ul>
            <li subnav="true" class="m-headerNav"><a>
                <img data-src="{{ asset('assets/img/bingo.png')}}" style="border-radius: 0.75rem;height: 5rem;width: 5rem;" alt="" data-not-lazy=""
                    src="{{ asset('assets/img/bingo.png')}}"> </a>
            </li>
            <li class="m-headerNav">
                <a href="#" class="a-headernavButton a-buttonText">Tirage du bingo {{$bingo->libelle}}  - {{ $bingo->association->name }}</a>
            </li>
        </ul>
    </nav>

    <nav class="o-header__content">
        <ul>
                <li class="o-header__button"><a href="{{ route('index') }}" data-ux="Showcase_Header_NavLink_Signin"
                    target="_self" class="a-button a-buttonText -fifth">
                    <div class="a-button__container">
                        <!---->
                        <!----> <span>Aller sur l'Accueil</span>
                    </div>
                </a></li>
                <li class="o-header__button"><a href="{{  route('bingo-site', $bingo->id) }}" data-ux="Showcase_Header_NavLink_Signin"
                    target="_self" class="a-button a-buttonText -fifth">
                    <div class="a-button__container">
                        <!---->
                        <!----> <span><i class="fas fa-eye"></i> Voir le Bingo</span>
                    </div>
                </a></li>

                @if(auth()->user())
                    <li class="o-header__button"><a href="{{ route('login') }}" data-ux="Showcase_Header_NavLink_Signin"
                        target="_self" class="a-button a-buttonText -fifth">
                        <div class="a-button__container">
                            <!---->
                            <!----> <span>Mon Compte</span>
                        </div>
                    </a></li>
                @endif

            <li subnav="true" class="m-headerNav"><a>
                <img data-src="{{ asset('assets/img/logo/'. $bingo->association->id . '/' . $bingo->association->logo)}}" style="border-radius: 0.75rem;height: 5rem;width: 5rem;" alt="" data-not-lazy=""
                    src="{{ asset('assets/img/logo/'. $bingo->association->id . '/' . $bingo->association->logo)}}"> </a>
            </li>
            
        </ul>
    </nav>

@endsection

@section("nav-mobile")

@endsection

@section("content")
    <section  style="background-image: url({{ asset('assets/img/bingo-night-banner.jpg')}});background-position: center;margin-bottom:20px;height:auto;width:100%;" class="c-heroBanner">
                            
    </section>

    <section>
        <div class="g-4 row">
            <div class="col-lg-3 col-md-3">
                <div class="shadow-lg mb-5 rounded">
                    <div class="table-responsive table-bingo" style="text-align:center">
                        <table class="table no-border">
                            <thead>
                                <tr class="no-border">
                                    <th class="color-white no-border bold">B</th>
                                    <th class="color-white no-border bold">I</th>
                                    <th class="color-white no-border bold">N</th>
                                    <th class="color-white no-border bold">G</th>
                                    <th class="color-white no-border bold">O</th>
                                </tr>
                            </thead>
                            <tbody class="no-border bold">
                                @for($i = 1; $i <= 15; $i++) 
                                    <tr class="no-border bold">
                                        <td class="no-border bold color-black" id="case-<?= $i ?>">{{ $i }}</td>
                                        <td class="no-border bold color-black" id="case-<?= $i + 15 ?>">{{ $i + 15 }}</td>
                                        <td class="no-border bold color-black" id="case-<?= $i + 30 ?>">{{ $i + 30 }}</td>
                                        <td class="no-border bold color-black" id="case-<?= $i + 45 ?>">{{ $i + 45 }}</td>
                                        <td class="no-border bold color-black" id="case-<?= $i + 60 ?>">{{ $i + 60 }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="g-4 col-lg-6 col-md-6">
                <div  class="container-number-tirer">
                    <div style="text-align:center;">
                        <div class="badge shadow-lg"  id="number-tirer"></div>
                    </div>
                </div>
                <div>
                    <div class="card g-4 shadow-lg mb-5 bg-body-tertiary rounded">
                        <div class="pb-0 px-10 card-header header-color">
                            <h5>Numéro Tiré</h5>
                        </div>
                        <div class="card-body"  id="tirage-number-container">
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3">
                
                <div class="mantine-1jci8zy" style="height:480px;background: linear-gradient(150deg, color-mix(in srgb, rgb(46,47,94) 70%, rgb(255, 255, 255)), color-mix(in srgb, rgb(46,47,94) 70%, rgb(0, 0, 0)));"> 
                    <div class="mantine-rrxw64" tabindex="-1">GAGNANTS</div>
                    <div class="mantine-Grid-root mantine-1a3lk33"  id="gagnant-container">
                        
                    </div>
                </div>
            </div>
        </div>

        
    </section>

    <section>
        <div class="card">
            <h5 class="mb-0 mantine-rrxw64">Lot à gagner</h5>
            
            <div class="card-body"  style="background: linear-gradient(150deg, color-mix(in srgb, rgb(46,47,94) 70%, rgb(255, 255, 255)), color-mix(in srgb, rgb(46,47,94) 70%, rgb(0, 0, 0)));">
                <div class="row">
                    @foreach($bingo->lotbingo as $lot)
                        <div class='col-lg-3 col-md-3'>
                            <div class='card'>
                                <img src="{{ asset('assets/img/lot/bingo/'.$bingo->id.'/'.$lot->image) }}" class='card-img-top' alt='{{ $lot->libelle}}'>
                                <div class="card-body">
                                    <h3 class="card-title">Lot N° {{ $lot->number }} : {{ $lot->libelle }}</h3>
                                    <p class="card-text">{{ $lot->price }} € (valeur estimée)</p>
                                    <a  class="card-text">{{ $lot->link }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
               
@section("footer")
    <nav class="o-header__content o-header__logo nav-desktop">
        <ul>
            <li subnav="true" class="m-headerNav"><a>
                <img data-src="{{ asset('assets/img/bingo.png')}}" style="border-radius: 0.75rem;height: 100px;width: 100px;" alt="" data-not-lazy=""
                    src="{{ asset('assets/img/bingo.png')}}"> </a>
            </li>
        </ul>
    </nav>
    <nav class="o-header__content o-header__logo nav-desktop">
        <ul>
            <li class="m-headerNav">
                <a href="#" class="a-headernavButton a-buttonText">{{$bingo->libelle}}  - {{ $bingo->association->name }} </br>
                <span style="color:rbga(255, 255, 255, 0.3)!important;">{{ $bingo->association->email }}</span>
            </a>
            </li>
        </ul>
    </nav>
@endsection

@section("script-content")
    <script>
        $("#number-tirer").hide();
        const tirage = {{ $bingo->tirage }};
        const gagnant = <?= json_encode($gagnantbingo) ?>;

        var numberGagnant = {};
        $.each(gagnant , function(index, g){
            numberGagnant[g.gagnant_at] = g;
        });

        var index = 0;
        var intervalId = setInterval(setTirage, 6000);
        var intervalShowNumber;
        var nombreTirer;

        function setTirage() {
            if(typeof tirage[index] != "undefined") {
                $("#number-tirer").hide(400);
                $("#number-tirer").html(tirage[index]);
                $("#number-tirer").show(500);
                nombreTirer = tirage[index];

                intervalShowNumber = setInterval(refreshNumberShow , 600);
                index++;
            }
            else {
                $("#gagnant-container").html("");
                $.each(numberGagnant, function(key, val) {
                    $("#gagnant-container").append("<h5 class='color-white' style='text-align:center;margin-left:10px;'>Lot "+ val.lot+" : "+ val.gagnant+"</h5>")
                });

                clearInterval(intervalId);
            }
                
        }

        function refreshNumberShow() {
            $("#tirage-number-container").append("<div class='col-lg-1 col-md-1 col-xs-1 col-sm-1 badge number-tirage'><span class=''>"+nombreTirer+"</span></div>");
            $("#case-"+nombreTirer).removeClass("color-black").addClass("color-white");
            clearInterval(intervalShowNumber);
        } 
    </script>
@endsection