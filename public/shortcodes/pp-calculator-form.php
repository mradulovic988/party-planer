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
            </div>
            
            <div class="pp-advanced-section">
            	<div class="pp-row">
	                <div class="pp-col-50 pp-p-20">
	                    <div class="pp-fields pp-m-tb-10">
	                        <table class="pp-table">
	                            <tr>
									<th>' . __( 'godine', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
									<th>' . __( 'muškarci', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
									<th>' . __( 'žene', PARTY_PLANER_TEXT_DOMAIN ) . '</th>
								</tr>
								<tr>
									<td>' . __( '20-30', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-gender-2030"></td>
									<td><input class="pp-w-100" type="text" name="pp-gender-2030"></td>
								</tr>
								<tr>
									<td>' . __( '30-40', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-gender-3040"></td>
									<td><input class="pp-w-100" type="text" name="pp-gender-3040"></td>
								</tr>
								<tr>
									<td>' . __( '40-50', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-gender-4050"></td>
									<td><input class="pp-w-100" type="text" name="pp-gender-4050"></td>
								</tr>
								<tr>
									<td>' . __( '50-60', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-gender-5060"></td>
									<td><input class="pp-w-100" type="text" name="pp-gender-5060"></td>
								</tr>
								<tr>
									<td>' . __( 'preko 70', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
									<td><input class="pp-w-100" type="text" name="pp-gender-70"></td>
									<td><input class="pp-w-100" type="text" name="pp-gender-70"></td>
								</tr>
							</table>
	                    </div>
	                </div>
	                
	                <div class="pp-col-50 pp-p-20">
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
										<td><input class="pp-w-100" type="text" name="pp-adv-beer-lager"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'pšenično', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-beer-psenicno"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'ipa', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-beer-ipa"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'ostalo', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-beer-ostalo"></td>
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
										<td><input class="pp-w-100" type="text" name="pp-adv-vine-crveno"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'belo', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-vine-belo"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'rose', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-vine-rose"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'penušavo', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-vine-penusavo"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'ostalo', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-vine-ostalo"></td>
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
										<td><input class="pp-w-100" type="text" name="pp-adv-strong-vodka"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'džin', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-strong-dzin"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'viski', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-strong-viski"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'rakija', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-strong-rakija"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'tekila', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-strong-tekila"></td>
										<td>%</td>
									</tr>
									<tr>
										<td>' . __( 'ostalo', PARTY_PLANER_TEXT_DOMAIN ) . '</td>
										<td><input class="pp-w-100" type="text" name="pp-adv-strong-ostalo"></td>
										<td>%</td>
									</tr>
								</table>
							</div>
	                    </div>
	                </div>
                </div>
            </div>
            <div class="pp-advance-option-wrapper pp-m-tb-20">
                <span class="pp-advance-option">' . __( 'Napredne opcije    ⇩', PARTY_PLANER_TEXT_DOMAIN ) . '</span>
        		<input type="submit" name="pp-party-planer-submit" id="pp-party-planer-submit" value="' . __( 'Računaj', PARTY_PLANER_TEXT_DOMAIN ) . '">
			</div>
        </form>
		';
	}
}