<?php
/**
 * Shortcode that show calculator on the front-end
 *
 * @author M Lab Studio
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/functions/add_shortcode
 * @see https://projects.invisionapp.com/share/XA11Q5S62CG5#/screens
 * @package pp_calculator_form
 */
add_shortcode( 'party-planer', 'pp_calculator_form' );

if ( ! function_exists( 'pp_calculator_form' ) ) {
	function pp_calculator_form() {
		$data = '
		<form action="" method="post" id="pp-calculator-form">
		' . wp_nonce_field( 'pp_calculator_save', 'pp_calculator_name' ) . '
			<div class="pp-basic-section">
	            <div class="pp-row">
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'BROJ GOSTIJU', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
	                        <input class="pp-w-100" type="number" name="pp-alc-guests-number" id="pp-alc-guests-number" required>
	                        <label for="pp-alc-guests-number" class="pp-m-lr-10">' . __( 'Broj gostiju koji konzumira alkohol', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
	                        <input class="pp-w-100" type="number" name="pp-non-alc-guests-number" id="pp-non-alc-guests-number" required>
	                        <label for="pp-non-alc-guests-number" class="pp-m-lr-10">' . __( 'Broj gostiju koji konzumira bezalkoholni program', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                    </div>
	                </div>
	        
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'TRAJANJE PROSLAVE', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
	                        <input type="number" name="pp-time-party" class="pp-time-party pp-w-100" id="pp-time-party" placeholder="h" required>
	                        <label for="pp-time-party" class="pp-m-lr-10">' . __( '(uneti vreme trajanja proslave)', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	                    </div>
	                </div>
	            </div>
	            
	            <div class="pp-row">
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'PREFERENCIJA PIĆA', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10 pp-inline-flex">
	                    	' . __( 'Pivo', PARTY_PLANER_TEXT_DOMAIN ) . '<input id="ppBearInputId" type="range" class="pp-ranges" name="ppBearInputName" value="' . PP_BEER_PREF . '" min="0" max="100"/><label class="pp-label-beer-range" for="ppBearInputId">' . PP_BEER_PREF . '</label>%
	                    </div>
	                    <div class="pp-fields pp-m-tb-10 pp-inline-flex">
		                    ' . __( 'Vino', PARTY_PLANER_TEXT_DOMAIN ) . '<input id="ppVineInputId" type="range" class="pp-ranges" name="ppVineInputName" value="' . PP_WINE_PREF . '" min="0" max="100"/><label class="pp-label-vine-range" for="ppVineInputId"> ' . PP_WINE_PREF . '</label>%
	                    </div>
	                    <div class="pp-fields pp-m-tb-10 pp-inline-flex">
		                    ' . __( 'Žestina', PARTY_PLANER_TEXT_DOMAIN ) . '<input id="ppStrongInputId" type="range" class="pp-ranges" name="ppStrongInputName" value="' . PP_STRONG_PREF . '" min="0" max="100"/><label class="pp-label-strong-range" for="ppStrongInputId"> ' . PP_STRONG_PREF . '</label>%
	                    </div>
	                </div>
	            </div>
            </div>
            
            <div class="pp-advanced-section">
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
									<td><input class="pp-w-100 pp-range-numbers pp-first-field" type="number" step="any" min="0" max="100" name="pp-age-old-2030" required> %</td>
								</tr
								<tr>
									<td>' . __( '30-40', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100 pp-range-numbers pp-second-field" type="number" step="any" min="0" max="100" name="pp-age-old-3040" required> %</td>
								</tr>
								<tr>
									<td>' . __( '40-50', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100 pp-range-numbers pp-third-field" type="number" step="any" min="0" max="100" name="pp-age-old-4050" required> %</td>
								</tr>
								<tr>
									<td>' . __( '50-60', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100 pp-range-numbers pp-fourth-field" type="number" step="any" min="0" max="100" name="pp-age-old-5060" required> %</td>
								</tr>
								<tr>
									<td>' . __( 'preko 70', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100 pp-range-numbers pp-fifth-field" type="number" step="any" min="0" max="100" name="pp-age-old-70" required> %</td>
								</tr>
							</table>
	                    </div>
	                </div>
	                
	                <div class="pp-col-50 pp-p-20">
	                	<div class="pp-title-wrapper">
	                        <img class="pp-dot" src="' . plugins_url( '../assets/img/pp-dot.png', __FILE__ ) . '" alt="">
	                        <h4 class="pp-title">' . __( 'PREFERENCIJE TIPA', PARTY_PLANER_TEXT_DOMAIN ) . '</h4>
	                    </div>
	                    <div class="pp-fields pp-m-tb-10">
		                    <div class="pp-row">
		                    	<!-- Pivo - col 1 -->
		                        <table class="pp-table">
		                            <tr>
										<th>' . __( '', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
										<th>' . __( 'Pivo', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
										<th>' . __( '', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
									</tr>
									<tr>
										<td>' . __( 'lager', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-beer-lager"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'pšenično', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-beer-psenicno"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'ipa', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-beer-ipa"></td>
										<td>%</td>
									</tr>
								</table>
								
								<!-- Vino - col 2 -->
								<table class="pp-table">
		                            <tr>
										<th>' . __( '', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
										<th>' . __( 'Vino', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
										<th>' . __( '', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
									</tr>
									<tr>
										<td>' . __( 'crveno', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-vine-crveno"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'belo', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-vine-belo"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'rose', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-vine-rose"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'penušavo', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-vine-penusavo"></td>
										<td>%</td>
									</tr>
								</table>
								
								<!-- Žestina - col 3 -->
								<table class="pp-table">
		                            <tr>
										<th>' . __( '', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
										<th>' . __( 'Žestina', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
										<th>' . __( '', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
									</tr>
									<tr>
										<td>' . __( 'vodka', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-strong-vodka"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'džin', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-strong-dzin"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'viski', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-strong-viski"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'rakija', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-strong-rakija"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'tekila', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-strong-tekila"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'vermut', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100 pp-total-percentages" type="text" value="0" name="pp-adv-strong-vermut"></td>
										<td>%</td>
									</tr>
								</table>
							</div>
	                    </div>
	                </div>
                </div>
                <!-- 84 -->
            </div>
            <div class="pp-advance-option-wrapper pp-m-tb-20">
            	<div class="pp-additional-information pp-p-20">
	                <input type="checkbox" name="pp-information" id="pp-information" class="pp-m-tb-20">
	                <label for="pp-information">' . __( 'Želim da učestvujem u istraživanju. Space garantuje bezbednost i poverljivost podataka koji su prikupljeni istraživanjem. Prikupljeni podaci koriste se isključivo u statističke svrhe.', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
	            	    
                    <div class="pp-col-50 pp-p-20 pp-addition-information-wrapper">
	                    <div class="pp-fields pp-m-tb-10">
	                        <table class="pp-table">
								<tr>
									<td>' . __( 'Ime: ', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-300 pp-check-required" type="text" name="pp-add-inf-name"></td>
								</tr>
								<tr>
									<td>' . __( 'Prezime: ', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-300 pp-check-required" type="text" name="pp-add-inf-lname"></td>
								</tr>
								<tr>
									<td>' . __( 'Email: ', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-300 pp-check-required" type="email" name="pp-add-inf-email"></td>
								</tr>
								<tr>
									<td>' . __( 'Kontakt telefon: ', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-300 pp-check-required" type="text" name="pp-add-inf-phone"></td>
								</tr>
							</table>
	                    </div>
	                </div>
            	</div>
            	
                <span class="pp-advance-option">' . __( 'Napredne opcije    ⇩', PARTY_PLANER_TEXT_DOMAIN ) . '</span>
        		<input type="submit" name="pp-party-planer-submit" id="pp-party-planer-submit" value="' . __( 'Izračunaj', PARTY_PLANER_TEXT_DOMAIN ) . '">
			</div>
        </form>';
		$data .= ( new PP_Calculation() )->pp_get_data();

		return $data;
	}
}
