@extends("layouts/index/minisite")

@section("header") 
    <title>{{$bingo->libelle}} | {{  $bingo->association->name }}</title>
@endsection

@section("nav-desktop")
    <nav class="o-header__content o-header__logo">
        <ul>
            <li subnav="true" class="m-headerNav"><a>
                <img data-src="{{ asset('assets/img/bingo.png')}}" style="border-radius: 0.75rem;height: 5rem;width: 5rem;" alt="" data-not-lazy=""
                    src="{{ asset('assets/img/bingo.png')}}"> </a>
            </li>
            <li class="m-headerNav">
                <a href="#" class="a-headernavButton a-buttonText">{{$bingo->libelle}}  - {{ $bingo->association->name }}</a>
            </li>
        </ul>
    </nav>

    <nav class="o-header__content">
        <ul>
            @if(now() < $bingo->date)
                <li class="o-header__button"><a href="{{ route('index') }}" data-ux="Showcase_Header_NavLink_Signin"
                    target="_self" class="a-button a-buttonText -fifth">
                    <div class="a-button__container">
                        <!---->
                        <!----> <span>Aller sur l'Accueil</span>
                    </div>
                </a></li>
                <li class="o-header__button"><a href="{{ route('bingo-to-buy', $bingo->id) }}" data-ux="Showcase_Header_NavLink_Signin"
                    target="_self" class="a-button a-buttonText -fifth">
                    <div class="a-button__container">
                        <!---->
                        <!----> <span>Je Participe</span>
                    </div>
                </a></li>
            @else
                <li class="o-header__button"><a href="{{ route('index') }}" data-ux="Showcase_Header_NavLink_Signin"
                    target="_self" class="a-button a-buttonText -fifth">
                    <div class="a-button__container">
                        <!---->
                        <!----> <span>Aller sur l'Accueil</span>
                    </div>
                </a></li>

                <li class="o-header__button"><a href="{{ route('mini-site-bingo-tirage', $bingo->id) }}" data-ux="Showcase_Header_NavLink_Signin"
                    target="_self" class="a-button a-buttonText -fifth">
                    <div class="a-button__container">
                        <!---->
                        <!----> <span><i class="fas fa-eye"></i> Voir le résultat</span>
                    </div>
                </a></li>
            @endif


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
            <div class="col-lg-8 col-md-8 col-sm-6">
                <div class="card g-4 shadow-lg mb-5 bg-body-tertiary rounded">
                    <div class="pb-0 px-10 card-header">
                        <h5>{{$bingo->libelle}}</h5>
                    </div>
                    <div class="card-body">
                        <p style="font-size: 20px;margin-bottom:15px;">par {{ $bingo->association->name }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card g-4 shadow-lg mb-5 bg-body-tertiary rounded">
                    <div class="pb-0 px-10 card-header header-color">
                        <h5>Partager l'événement</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class='col-lg-2 col-md-2 col-sm-6'>
                                <div class='share-event-container' title="Partager l'événement sur facebook">
                                    <i class="fab fa-facebook-f facebook"></i>
                                </div>
                            </div>

                            <div class='col-lg-2 col-md-2 col-sm-6' title="Partager l'événement sur twitter">
                                <div class='share-event-container'>
                                    <i class="fab fa-twitter twitter"></i>
                                </div>
                            </div>

                            <div class='col-lg-2 col-md-2 col-sm-6' title="Partager l'événement sur linkedin">
                                <div class='share-event-container'>
                                    <i class="fab fa-linkedin-in linkedin"></i>
                                </div>
                            </div>

                            <div class='col-lg-2 col-md-2 col-sm-6' title="Copier l'événement dans le presse-papier">
                                <div class='share-event-container'>
                                    <i class="fas fa-link link"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="g-4 row">
            <div class="col-lg-8 col-md-8 col-sm-6">
                <div class="card g-4 shadow-lg mb-5 bg-body-tertiary rounded">
                    <div class="pb-0 px-10 card-header">
                        <h5>Information sur le bingo</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flex-1 flex justify-center items-center p-3 w-full">
                                <fieldset>
                                    <div class="text-center">
                                        <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                            <h5 style="text-align:center;">Lancement du bingo </br>( {{ config("app.timezone_utc") }} )</h5>
                                        </div>
                                        <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                            <p style="text-align:center;">{{ dateToString($bingo->dateDebut)}}</p>
                                        </div>
                                    </div>
                                    
                                </fieldset>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flex-1 flex justify-center items-center p-3 w-full">
                                <fieldset>
                                    <div class="text-center">
                                        <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                            <h5 style="text-align:center;">PRIX D'UN TICKET</h5>
                                        </div>
                                        <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                            <p style="text-align:center;">{{ spaceNombre($bingo->montant) }} €</p>
                                        </div>
                                    </div>
                                    
                                </fieldset>
                            </div>
                            @if(now() < $bingo->date)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flex-1 flex justify-center items-center p-3 w-full">
                                    <fieldset>
                                        <div class="text-center">
                                            <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                                <h5 style="text-align:center;">Tickets restants</h5>
                                            </div>
                                            <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                                <p style="text-align:center;">{{  $bingo->ticket }}</p>
                                            </div>
                                        </div>
                                        
                                    </fieldset>
                                </div>
                            @endif

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flex-1 flex justify-center items-center p-3 w-full">
                                <fieldset>
                                    <div class="text-center">
                                        <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                            <h5 style="text-align:center;">Date de Tirage </br>( {{ config("app.timezone_utc") }} )</h5>
                                        </div>
                                        <div class="m-editor m-enteteSection__editor -iris -left" style="text-align:center;margin-bottom:15px;">
                                            <p style="text-align:center;">{{ dateToString($bingo->date)}}</p>
                                        </div>
                                    </div>
                                    
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card g-4 shadow-lg mb-5 bg-body-tertiary rounded">
                    <div class="pb-0 px-10 card-header header-color">
                        <h5>Plateforme de paiement 100% sécurisée</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Toutes les informations bancaires pour traiter ce paiement sont totalement sécurisées. </br>
                            Vous êtes assurés de la fiabilité de vos transactions sur {{config("app.name")}}.
                        </p>

                        
                            <div class="row">
                                @if($bingo->association->stripe != null && $bingo->association->stripe != "")
                                    <div class='col-lg-3 col-md-3 col-sm-6' style="margin-bottom:10px;">
                                        <div class='share-event-container' title="Paiement via Stripe">
                                            <i class="fab fa-stripe" style="background:rgb(37, 150, 190);"></i>
                                        </div>
                                    </div>
                                @endif
                                @if($bingo->association->paypal_id != null && $bingo->association->paypal_id != "")
                                    <div class='col-lg-3 col-md-3 col-sm-6' style="margin-bottom:10px;">
                                        <div class='share-event-container' title="Paiement via Paypal">
                                            <i class="fab fa-paypal" style="background:#04197f;"></i>
                                        </div>
                                    </div>
                                @endif
                                @if($bingo->association->gpay != null && $bingo->association->gpay != "")
                                    <div class='col-lg-3 col-md-3 col-sm-6' style="margin-bottom:10px;">
                                        <div class='share-event-container' title="Paiement via Google Pay">
                                            <i class="fab fa-google" style="background:#4983e2;"></i>
                                        </div>
                                    </div>
                                @endif

                                <div class='col-lg-3 col-md-3 col-sm-6' style="margin-bottom:10px;">
                                    <div class='share-event-container' title="Paiement par Carte Visa">
                                        <i class="fab fa-cc-visa" style="color:#04197f;background:#ffffff;border:1px solid #04197f;"></i>
                                    </div>
                                </div>

                                <div class='col-lg-3 col-md-3 col-sm-6' style="margin-bottom:10px;">
                                    <div class='share-event-container' title="Paiement par MasterCard">
                                        <i class="fab fa-cc-mastercard" style="color:#f06825;background:#ffffff;border:1px solid #f06825;"></i>
                                    </div>
                                </div>

                                
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="g-4 row">
        
            <div class="col-lg-8 col-md-8 col-sm-6">
                
                <div class="mantine-1jci8zy" style="background: linear-gradient(150deg, color-mix(in srgb, rgb(46,47,94) 70%, rgb(255, 255, 255)), color-mix(in srgb, rgb(46,47,94) 70%, rgb(0, 0, 0)));"> 
                    <div class="mantine-rrxw64" tabindex="-1"> <?= count($bingo->lotbingo) ?>  lots à gagner !</div>
                    <div class="mantine-Grid-root mantine-1a3lk33">
                        <div class="mantine-Grid-col">
                            <div class="mantine-container <?php if(count($bingo->lotbingo) > 3) echo 'row';?>">
                                @foreach($bingo->lotbingo as $lot)
                                    <?php $attrContainer = ($lot->link != null && $lot->link != "") ? " style='cursor:pointer;' data-href='". $lot->link . "'" : "";  ?>
                                    <div class="mantine-Grid-col mantine-ocm5r  <?php if(count($bingo->lotbingo) > 3) echo 'col-lg-3 col-md-3 col-sm-5';?> ">
                                        <div class="mantine-gmnaht"><?= $lot->libelle ?></div>
                                        <div class="mantine-1od7zmz">
                                            <div <?= $attrContainer ?> class="mantine-kv9yl3 container-lot-in-game ">
                                                <p class="mantine-1tig8jw">🎁 À gagner</p>
                                                <a class="mantine-mchb6r" rel="noreferrer">
                                                    <div class="mantine-Image-root mantine-15po0m8" style="width: 100%;">
                                                        <figure class="mantine-11nhzn5 mantine-Image-figure">
                                                            <div class="mantine-qqmv3w mantine-Image-imageWrapper">
                                                                <img class="mantine-3y8yz3 mantine-Image-image" src="{{asset('assets/img/lot/bingo/'.$lot->bingo_id.'/'. $lot->image)}}" alt="giftImage" style="object-fit: cover; width: 100%; height: auto;">
                                                            </div>
                                                        </figure>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>                                
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card g-4 shadow-lg mb-5 bg-body-tertiary rounded">
                    
                    <div class="card-body">
                        <p class="card-text my-flex">
                            Gagner pour la bonne cause.
                        </p>
                        @if(now() < $bingo->date)

                            <a href="{{ route('bingo-to-buy', $bingo->id) }}" data-ux="Showcase_ActivityRaffle_Hero_SignUp"
                                target="_self" class="a-button a-buttonText -primary my-flex">
                                <div class="a-button__container">
                                    <!---->
                                    <!----> <span>Je Participe</span>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('mini-site-bingo-tirage', $bingo->id) }}" data-ux="Showcase_ActivityRaffle_Hero_SignUp"
                                target="_self" class="a-button a-buttonText -primary my-flex">
                                <div class="a-button__container">
                                    <!---->
                                    <!----> <span><i class="fas fa-eye"></i> Voir le résultat</span>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
               
@section("footer")
    <nav class="o-header__content o-header__logo">
        <ul>
            <li subnav="true" class="m-headerNav"><a>
                <img data-src="{{ asset('assets/img/bingo.png')}}" style="border-radius: 0.75rem;height: 100px;width: 100px;" alt="" data-not-lazy=""
                    src="{{ asset('assets/img/bingo.png')}}"> </a>
            </li>
        </ul>
    </nav>
    <nav class="o-header__content o-header__logo">
        <ul>
            <li class="m-headerNav">
                <a href="#" class="a-headernavButton a-buttonText">{{$bingo->libelle}}  - {{ $bingo->association->name }} </br>
                <span style="color:rbga(255, 255, 255, 0.3)!important;">{{ $bingo->association->email }}</span>
            </a>
            </li>
        </ul>
    </nav>
    @if(now() < $bingo->date)
        <nav class="o-header__content">
            <ul>
            <li class="o-header__button"><a href="{{ route('bingo-to-buy', $bingo->id) }}" data-ux="Showcase_Header_NavLink_Signin"
                target="_self" class="a-button a-buttonText -fifth">
                <div class="a-button__container">
                    <!---->
                    <!----> <span>Je Participe</span>
                </div>
            </a></li>
            </ul>
        </nav>

    @else
        <nav class="o-header__content">
            <li class="o-header__button"><a href="{{ route('mini-site-bingo-tirage', $bingo->id) }}" data-ux="Showcase_Header_NavLink_Signin"
                target="_self" class="a-button a-buttonText -fifth">
                <div class="a-button__container">
                    <!---->
                    <!----> <span><i class="fas fa-eye"></i> Voir le résultat</span>
                </div>
            </a></li>
        </nav>
    @endif
@endsection

@section("script-content")

@endsection