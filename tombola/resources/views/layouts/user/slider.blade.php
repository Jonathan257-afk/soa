<nav class="pro-menu inner-submenu-arrows">
    <ul>
        <li class="pro-menu-item d-flex flex-column <?php if(Route::is("user-dashboard") ) { echo 'active';} ?>">
            <div class="pro-inner-item" tabindex="0" role="button">
                <span class="pro-icon-wrapper">
                    <span  class="pro-icon">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-pie" class="svg-inline--fa fa-chart-pie " role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M304 16.58C304 7.555 310.1 0 320 0C443.7 0 544 100.3 544 224C544 233 536.4 240 527.4 240H304V16.58zM32 272C32 150.7 122.1 50.34 238.1 34.25C248.2 32.99 256 40.36 256 49.61V288L412.5 444.5C419.2 451.2 418.7 462.2 411 467.7C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zM558.4 288C567.6 288 575 295.8 573.8 305C566.1 360.9 539.1 410.6 499.9 447.3C493.9 452.1 484.5 452.5 478.7 446.7L320 288H558.4z">
                            </path>
                        </svg>
                    </span>
                </span>
                <span class="pro-item-content">
                    <a href="{{ route('user-dashboard') }}">Tableau de Bord</a>
                </span>
            </div>
        </li>
        <li class="pro-menu-item d-flex flex-column  <?php if(Route::is("user-achat") ) { echo 'active';} ?>">
            <div class="pro-inner-item" role="button" tabindex="0">
                <span class="pro-icon-wrapper">
                    <span
                    class="pro-icon">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="boxes-stacked" class="svg-inline--fa fa-boxes-stacked " role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M160 48C160 21.49 181.5 0 208 0H256V80C256 88.84 263.2 96 272 96H304C312.8 96 320 88.84 320 80V0H368C394.5 0 416 21.49 416 48V176C416 202.5 394.5 224 368 224H208C181.5 224 160 202.5 160 176V48zM96 288V368C96 376.8 103.2 384 112 384H144C152.8 384 160 376.8 160 368V288H208C234.5 288 256 309.5 256 336V464C256 490.5 234.5 512 208 512H48C21.49 512 0 490.5 0 464V336C0 309.5 21.49 288 48 288H96zM416 288V368C416 376.8 423.2 384 432 384H464C472.8 384 480 376.8 480 368V288H528C554.5 288 576 309.5 576 336V464C576 490.5 554.5 512 528 512H368C341.5 512 320 490.5 320 464V336C320 309.5 341.5 288 368 288H416z">
                            </path>
                        </svg>
                    </span>
                </span>
                <span class="pro-item-content">
                    <a href="{{ route('user-achat') }}">Mes Tickets</a>
                </span>
            </div>
        </li>

        <li class="pro-menu-item d-flex flex-column  <?php if(Route::is("user-don") ) { echo 'active';} ?>">
            <div class="pro-inner-item" role="button" tabindex="0">
                <span class="pro-icon-wrapper">
                    <span
                    class="pro-icon">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="boxes-stacked" class="svg-inline--fa fa-boxes-stacked " role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M160 48C160 21.49 181.5 0 208 0H256V80C256 88.84 263.2 96 272 96H304C312.8 96 320 88.84 320 80V0H368C394.5 0 416 21.49 416 48V176C416 202.5 394.5 224 368 224H208C181.5 224 160 202.5 160 176V48zM96 288V368C96 376.8 103.2 384 112 384H144C152.8 384 160 376.8 160 368V288H208C234.5 288 256 309.5 256 336V464C256 490.5 234.5 512 208 512H48C21.49 512 0 490.5 0 464V336C0 309.5 21.49 288 48 288H96zM416 288V368C416 376.8 423.2 384 432 384H464C472.8 384 480 376.8 480 368V288H528C554.5 288 576 309.5 576 336V464C576 490.5 554.5 512 528 512H368C341.5 512 320 490.5 320 464V336C320 309.5 341.5 288 368 288H416z">
                            </path>
                        </svg>
                    </span>
                </span>
                <span class="pro-item-content">
                    <a href="{{ route('user-don') }}">Mes DONS</a>
                </span>
            </div>
        </li>

        <li class="pro-menu-item d-flex flex-column">
            <div class="pro-inner-item" tabindex="0" role="button">
                <span class="pro-icon-wrapper">
                    <span
                    class="pro-icon">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="boxes-stacked" class="svg-inline--fa fa-boxes-stacked " role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M160 48C160 21.49 181.5 0 208 0H256V80C256 88.84 263.2 96 272 96H304C312.8 96 320 88.84 320 80V0H368C394.5 0 416 21.49 416 48V176C416 202.5 394.5 224 368 224H208C181.5 224 160 202.5 160 176V48zM96 288V368C96 376.8 103.2 384 112 384H144C152.8 384 160 376.8 160 368V288H208C234.5 288 256 309.5 256 336V464C256 490.5 234.5 512 208 512H48C21.49 512 0 490.5 0 464V336C0 309.5 21.49 288 48 288H96zM416 288V368C416 376.8 423.2 384 432 384H464C472.8 384 480 376.8 480 368V288H528C554.5 288 576 309.5 576 336V464C576 490.5 554.5 512 528 512H368C341.5 512 320 490.5 320 464V336C320 309.5 341.5 288 368 288H416z">
                            </path>
                        </svg>
                    </span>
                </span>
                <span class="pro-item-content">
                    <a href="{{ route('game') }}"> Jouer</a>
                </span>
            </div>
        </li>

        <li class="pro-menu-item d-flex flex-column  <?php if(Route::is("user-account") ) { echo 'active';} ?>">
            <div class="pro-inner-item" tabindex="0" role="button">
                <span class="pro-icon-wrapper">
                    <span  class="pro-icon">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="boxes-stacked" class="svg-inline--fa fa-boxes-stacked " role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M160 48C160 21.49 181.5 0 208 0H256V80C256 88.84 263.2 96 272 96H304C312.8 96 320 88.84 320 80V0H368C394.5 0 416 21.49 416 48V176C416 202.5 394.5 224 368 224H208C181.5 224 160 202.5 160 176V48zM96 288V368C96 376.8 103.2 384 112 384H144C152.8 384 160 376.8 160 368V288H208C234.5 288 256 309.5 256 336V464C256 490.5 234.5 512 208 512H48C21.49 512 0 490.5 0 464V336C0 309.5 21.49 288 48 288H96zM416 288V368C416 376.8 423.2 384 432 384H464C472.8 384 480 376.8 480 368V288H528C554.5 288 576 309.5 576 336V464C576 490.5 554.5 512 528 512H368C341.5 512 320 490.5 320 464V336C320 309.5 341.5 288 368 288H416z">
                            </path>
                        </svg>
                    </span>
                </span>
                <span class="pro-item-content">
                    <a href="{{ route('user-account') }}">Mon compte</a>
                </span>
            </div>
        </li>

        

        <li class="pro-menu-item d-flex flex-column">
            <div class="pro-inner-item" tabindex="0" role="button">
                <span class="pro-icon-wrapper">
                    <span  class="pro-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                </span>
                <span class="pro-item-content">
                    <a href="{{ route('logout') }}"> Se déconnecter</a>
                </span>
            </div>
        </li>
    </ul>
</nav>