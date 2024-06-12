<header class="o-header" id="index-header-nav">
	<a href="{{ route('index') }}" aria-label="Retour à l'accueil" class="o-header__logo">
		<img data-src="{{ asset(config('path.logo.white'))}}" alt="" width="170" height="37" data-not-lazy=""
			src="{{ asset(config('path.logo.white'))}}">
	</a> 
	<button aria-label="Ouvrir le menu mobile" class="o-header__burger" id="btn-show-menu-mobile">
		<span></span>
		<span></span>
		<span></span>
	</button>
	<nav class="o-header__content nav-desktop">
		<ul>
			<li subnav="true" class="m-headerNav"><a href="{{ route('index') }}" class="a-headernavButton a-buttonText">
					Accueil</a>
			</li>
			<li class="m-headerNav"><a href="#" data-ux="Showcase_Header_NavLink_Free" target="_self"
					class="a-headernavButton a-buttonText"><span>FAQ ?</span></a></li>
			<li class="o-header__button"><a href="{{ route('game') }}" data-ux="Showcase_Header_NavLink_Signup"
						target="_self" class="a-button a-buttonText -seventh  nav-buttom jouer-nav">
				<div class="a-button__container">
					
					 <span>Jouer</span>
				</div>
			</a></li>

			@if(!auth()->user())
				<li class="o-header__button "><a href="{{ route('asso-signIn') }}" data-ux="Showcase_Header_NavLink_Signup"
						target="_self" class="a-button a-buttonText -seventh  nav-buttom">
						<div class="a-button__container">
							 <span>Créer un événement</span>
						</div>
					</a></li>
			@endif
			<li class="o-header__button "><a href="{{ route('login') }}" data-ux="Showcase_Header_NavLink_Signin"
					target="_self" class="a-button a-buttonText -fifth  nav-buttom">
					<div class="a-button__container">
						 <span>Mon compte</span>
					</div>
				</a></li>
		</ul>
	</nav>
	<nav class="o-header__content nav-mobile">
		<ul>
			<li class="o-header__button">
				<a href="{{ route('game') }}" data-ux="Showcase_Header_NavLink_Signup"
						target="_self" class="a-button a-buttonText -seventh  nav-buttom jouer-nav">
					<div class="a-button__container">
						 <span>Jouer</span>
					</div>
				</a>
			</li>
			@if(!auth()->user())
				<li class="o-header__button "><a href="{{ route('asso-signIn') }}" data-ux="Showcase_Header_NavLink_Signup"
						target="_self" class="a-button a-buttonText -seventh  nav-buttom">
						<div class="a-button__container">
							 <span>Créer un événement</span>
						</div>
					</a></li>
			@endif
				<li class="o-header__button "><a href="{{ route('login') }}" data-ux="Showcase_Header_NavLink_Signin"
					target="_self" class="a-button a-buttonText -fifth  nav-buttom">
					<div class="a-button__container">
						 <span>Mon compte</span>
					</div>
				</a></li>
				
			
			
			</a></li>
			<li class="m-headerNav"><a href="#" data-ux="Showcase_Header_NavLink_Free" target="_self"
					class="a-headernavButton a-buttonText"><span>FAQ ?</span></a></li>

			<li subnav="true" class="m-headerNav"><a href="{{ route('index') }}" class="a-headernavButton a-buttonText">
					Accueil</a>
			</li>
		</ul>
	</nav>
	<div class="o-header__overlay"></div>
</header>