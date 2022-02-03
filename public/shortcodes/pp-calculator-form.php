<?php
add_shortcode( 'party-planer', 'pp_calculator_form' );

if ( ! function_exists( 'pp_calculator_form' ) ) {
	function pp_calculator_form() {
		return '
		<form action="" method="post" id="pp-calculator-form">
			<div class="pp-basic-section">
	            <div class="pp-row">
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'BROJ GOSTIJU', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
	                        <select name="pp-alc-guests-number" id="pp-alc-guests-number" class="pp-select-width pp-alc-guests-number">
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                        </select>
	                        <label for="pp-alc-guests-number" class="pp-m-lr-10">' . __( 'Broj gostiju koji konzumira alkohol', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
	                        <select name="pp-non-alc-guests-number" id="pp-non-alc-guests-number" class="pp-select-width pp-non-alc-guests-number">
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                        </select>
	                        <label for="pp-non-alc-guests-number" class="pp-m-lr-10">' . __( 'Broj gostiju koji ne konzumira alkohol', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                    </div>
	                </div>
	        
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'TRAJANJE PROSLAVE', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
	                        <input type="text" name="pp-time-party" class="pp-time-party pp-w-100" id="pp-time-party" placeholder="h">
	                        <label for="pp-time-party" class="pp-m-lr-10">' . __( '(uneti vreme trajanja proslave)', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                    </div>
	                </div>
	            </div>
	            
	            <div class="pp-row">
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'STAROSNE GRUPE', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
	                        <table class="pp-table">
	                            <tr>
									<th>' . __( 'godine', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
									<th>' . __( 'broj gostiju', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
								</tr>
								<tr>
									<td>' . __( '20-30', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-age-old-2030"></td>
								</tr>
								<tr>
									<td>' . __( '30-40', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-age-old-3040"></td>
								</tr>
								<tr>
									<td>' . __( '40-50', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-age-old-4050"></td>
								</tr>
								<tr>
									<td>' . __( '50-60', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-age-old-5060"></td>
								</tr>
								<tr>
									<td>' . __( 'preko 70', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-age-old-70"></td>
								</tr>
							</table>
	                    </div>
	                </div>
	        
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'PREFERENCIJA PIĆA', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10 pp-inline-flex">
	                        <label for="ppBearInputId" class="pp-m-lr-10">' . __( 'Pivo', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                        <input type="range" name="ppBearInputName" id="ppBearInputId" value="30" min="1" max="100" oninput="ppBearOutputId.value = ppBearInputId.value">
   							<output class="pp-m-lr-10" name="ppBearOutputName" id="ppBearOutputId">30%</output>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10 pp-inline-flex">
	                        <label for="ppVineInputId" class="pp-m-lr-10">' . __( 'Vino', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                        <input type="range" name="ppVineInputName" id="ppVineInputId" value="55" min="1" max="100" oninput="ppVineOutputId.value = ppVineInputId.value">
   							<output class="pp-m-lr-10" name="ppVineOutputName" id="ppVineOutputId">55%</output>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10 pp-inline-flex">
	                        <label for="ppStrongInputId" class="pp-m-lr-10">' . __( 'Žestina', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                        <input type="range" name="ppStrongInputName" id="ppStrongInputId" value="20" min="1" max="100" oninput="ppStrongOutputId.value = ppStrongInputId.value">
   							<output class="pp-m-lr-10" name="ppStrongOutputName" id="ppStrongOutputId">20%</output>
	                    </div>
	                </div>
	            </div>
	            <div class="pp-advance-option-wrapper pp-m-tb-20">
	            	<button class="pp-advance-option">' . __( 'Napredne opcije', PARTY_PLANER_TEXT_DOMAIN ) . '</button>
				</div>
            </div>
            <div class="pp-advanced-section">
            	<h2>test advanced section toggle</h2>
            </div>
        </form>
		';
	}
}