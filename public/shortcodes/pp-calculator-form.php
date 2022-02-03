<?php
add_shortcode( 'party-planer', 'pp_calculator_form' );
if ( ! function_exists( 'pp_calculator_form' ) ) {
	function pp_calculator_form() {
		return '
		<form action="" method="post" id="pp-calculator-form">
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
                        <input type="text" name="pp-time-party" class="pp-time-party" id="pp-time-party" placeholder="h">
                        <label for="pp-time-party" class="pp-m-lr-10">' . __( '(uneti vreme trajanja proslave)', PARTY_PLANER_TEXT_DOMAIN ) . '</label>
                    </div>
                </div>
            </div>
        </form>
		';
	}
}