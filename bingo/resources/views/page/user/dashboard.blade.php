@extends("layouts/user/app")

@section("main")

	<div class="g-4 row">
		<div class="col-12 mb-4 col">
			<div class="row">
				<div class="col-xxl-3 col-xl-4 col-sm-6 widget">
					<div
						class="bg-info cursor-pointer shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3">
						<div
							class="bg-blue-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
							<svg aria-hidden="true" focusable="false" data-prefix="fas"
								data-icon="arrow-right"
								class="svg-inline--fa fa-arrow-right fs-1-xl text-white" role="img"
								xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path fill="currentColor"
									d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z">
								</path>
							</svg>
						</div>
						<div class="text-end text-white">
							<h2 class="fs-1-xxl fw-bolder text-white">{{  spaceNombre($ticket_tombola) }}</h2>
							<h3 class="mb-0 fs-4 fw-light">Nombre de Tickets de Tombola acheté</h3>
						</div>
					</div>
				</div>

				<div class="col-xxl-3 col-xl-4 col-sm-6 widget">
					<div
						class="bg-info cursor-pointer shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3">
						<div
							class="bg-blue-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
							<svg aria-hidden="true" focusable="false" data-prefix="fas"
								data-icon="arrow-right"
								class="svg-inline--fa fa-arrow-right fs-1-xl text-white" role="img"
								xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path fill="currentColor"
									d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z">
								</path>
							</svg>
						</div>
						<div class="text-end text-white">
							<h2 class="fs-1-xxl fw-bolder text-white">{{  spaceNombre($ticket_bingo) }}</h2>
							<h3 class="mb-0 fs-4 fw-light">Nombre de Tickets de Bingo acheté</h3>
						</div>
					</div>
				</div>

				
				<div class="col-xxl-3 col-xl-4 col-sm-6 widget">
					<div
						class="widget-bg-purple  cursor-pointer shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3">
						<div
							class="bg-purple-700 widget-icon rounded-10 d-flex align-items-center justify-content-center">
							<svg aria-hidden="true" focusable="false" data-prefix="fas"
								data-icon="dollar-sign"
								class="svg-inline--fa fa-dollar-sign fs-1-xl text-white" role="img"
								xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
								<path fill="currentColor"
									d="M160 0C177.7 0 192 14.33 192 32V67.68C193.6 67.89 195.1 68.12 196.7 68.35C207.3 69.93 238.9 75.02 251.9 78.31C268.1 82.65 279.4 100.1 275 117.2C270.7 134.3 253.3 144.7 236.1 140.4C226.8 137.1 198.5 133.3 187.3 131.7C155.2 126.9 127.7 129.3 108.8 136.5C90.52 143.5 82.93 153.4 80.92 164.5C78.98 175.2 80.45 181.3 82.21 185.1C84.1 189.1 87.79 193.6 95.14 198.5C111.4 209.2 136.2 216.4 168.4 225.1L171.2 225.9C199.6 233.6 234.4 243.1 260.2 260.2C274.3 269.6 287.6 282.3 295.8 299.9C304.1 317.7 305.9 337.7 302.1 358.1C295.1 397 268.1 422.4 236.4 435.6C222.8 441.2 207.8 444.8 192 446.6V480C192 497.7 177.7 512 160 512C142.3 512 128 497.7 128 480V445.1C127.6 445.1 127.1 444.1 126.7 444.9L126.5 444.9C102.2 441.1 62.07 430.6 35 418.6C18.85 411.4 11.58 392.5 18.76 376.3C25.94 360.2 44.85 352.9 60.1 360.1C81.9 369.4 116.3 378.5 136.2 381.6C168.2 386.4 194.5 383.6 212.3 376.4C229.2 369.5 236.9 359.5 239.1 347.5C241 336.8 239.6 330.7 237.8 326.9C235.9 322.9 232.2 318.4 224.9 313.5C208.6 302.8 183.8 295.6 151.6 286.9L148.8 286.1C120.4 278.4 85.58 268.9 59.76 251.8C45.65 242.4 32.43 229.7 24.22 212.1C15.89 194.3 14.08 174.3 17.95 153C25.03 114.1 53.05 89.29 85.96 76.73C98.98 71.76 113.1 68.49 128 66.73V32C128 14.33 142.3 0 160 0V0z">
								</path>
							</svg>
						</div>
						<div class="text-end text-white">
							<h2 class="fs-1-xxl fw-bolder text-white">{{  spaceNombre($gains) }} €</h2>
							<h3 class="mb-0 fs-4 fw-light">Estimation Montant gagné</h3>
						</div>
					</div>
				</div>

				<div class="col-xxl-3 col-xl-4 col-sm-6 widget">
					<div
						class="bg-warning cursor-pointer shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3">
						<div
							class="bg-yellow-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
							<svg aria-hidden="true" focusable="false" data-prefix="fas"
								data-icon="dollar-sign"
								class="svg-inline--fa fa-dollar-sign fs-1-xl text-white" role="img"
								xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
								<path fill="currentColor"
									d="M160 0C177.7 0 192 14.33 192 32V67.68C193.6 67.89 195.1 68.12 196.7 68.35C207.3 69.93 238.9 75.02 251.9 78.31C268.1 82.65 279.4 100.1 275 117.2C270.7 134.3 253.3 144.7 236.1 140.4C226.8 137.1 198.5 133.3 187.3 131.7C155.2 126.9 127.7 129.3 108.8 136.5C90.52 143.5 82.93 153.4 80.92 164.5C78.98 175.2 80.45 181.3 82.21 185.1C84.1 189.1 87.79 193.6 95.14 198.5C111.4 209.2 136.2 216.4 168.4 225.1L171.2 225.9C199.6 233.6 234.4 243.1 260.2 260.2C274.3 269.6 287.6 282.3 295.8 299.9C304.1 317.7 305.9 337.7 302.1 358.1C295.1 397 268.1 422.4 236.4 435.6C222.8 441.2 207.8 444.8 192 446.6V480C192 497.7 177.7 512 160 512C142.3 512 128 497.7 128 480V445.1C127.6 445.1 127.1 444.1 126.7 444.9L126.5 444.9C102.2 441.1 62.07 430.6 35 418.6C18.85 411.4 11.58 392.5 18.76 376.3C25.94 360.2 44.85 352.9 60.1 360.1C81.9 369.4 116.3 378.5 136.2 381.6C168.2 386.4 194.5 383.6 212.3 376.4C229.2 369.5 236.9 359.5 239.1 347.5C241 336.8 239.6 330.7 237.8 326.9C235.9 322.9 232.2 318.4 224.9 313.5C208.6 302.8 183.8 295.6 151.6 286.9L148.8 286.1C120.4 278.4 85.58 268.9 59.76 251.8C45.65 242.4 32.43 229.7 24.22 212.1C15.89 194.3 14.08 174.3 17.95 153C25.03 114.1 53.05 89.29 85.96 76.73C98.98 71.76 113.1 68.49 128 66.73V32C128 14.33 142.3 0 160 0V0z">
								</path>
							</svg>
						</div>
						<div class="text-end text-white">
							<h2 class="fs-1-xxl fw-bolder text-white">{{ spaceNombre($donTotal) }}  €</h2>
							<h3 class="mb-0 fs-4 fw-light">Total de mes Dons</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection