<?php
/**
 * Class PP_Calculation
 *
 * Calculation
 *
 * @class PP_Calculation
 * @package PP_Calculation
 * @version 1.0.0
 * @author M Lab Studio
 */

if ( ! class_exists( 'PP_Calculation' ) ) {
	class PP_Calculation {
		public function pp_get_data() {
			if ( isset( $_POST['pp-party-planer-submit'] ) ) {
				if ( ! isset( $_POST['pp_calculator_name'] ) || ! wp_verify_nonce( $_POST['pp_calculator_name'], 'pp_calculator_save' ) ) {
					esc_attr__( 'Sorry, this action is not allowed.', PARTY_PLANER_TEXT_DOMAIN );
					exit;
				} else {
					$pp_alc_guests_number     = ( ! empty( $_POST['pp-alc-guests-number'] ) ? sanitize_text_field( $_POST['pp-alc-guests-number'] ) : 0 );
					$pp_non_alc_guests_number = ( ! empty( $_POST['pp-non-alc-guests-number'] ) ? sanitize_text_field( $_POST['pp-non-alc-guests-number'] ) : 0 );
					$pp_time_party            = ( ! empty( $_POST['pp-time-party'] ) ? sanitize_text_field( $_POST['pp-time-party'] ) : 0 );
					$pp_age_old_2030          = ( ! empty( $_POST['pp-age-old-2030'] ) ? sanitize_text_field( $_POST['pp-age-old-2030'] ) : 0 );
					$pp_age_old_3040          = ( ! empty( $_POST['pp-age-old-3040'] ) ? sanitize_text_field( $_POST['pp-age-old-3040'] ) : 0 );
					$pp_age_old_4050          = ( ! empty( $_POST['pp-age-old-4050'] ) ? sanitize_text_field( $_POST['pp-age-old-4050'] ) : 0 );
					$pp_age_old_5060          = ( ! empty( $_POST['pp-age-old-5060'] ) ? sanitize_text_field( $_POST['pp-age-old-5060'] ) : 0 );
					$pp_age_old_70            = ( ! empty( $_POST['pp-age-old-70'] ) ? sanitize_text_field( $_POST['pp-age-old-70'] ) : 0 );
					$pp_bear_input_name       = ( ! empty( $_POST['ppBearInputName'] ) ? sanitize_text_field( $_POST['ppBearInputName'] ) : PP_BEER_PREF );
					$pp_wine_input_name       = ( ! empty( $_POST['ppVineInputName'] ) ? sanitize_text_field( $_POST['ppVineInputName'] ) : PP_WINE_PREF );
					$pp_strong_input_name     = ( ! empty( $_POST['ppStrongInputName'] ) ? sanitize_text_field( $_POST['ppStrongInputName'] ) : PP_STRONG_PREF );
					$pp_add_inf_name          = ( ! empty( $_POST['pp-add-inf-name'] ) ? sanitize_text_field( $_POST['pp-add-inf-name'] ) : null );
					$pp_add_inf_lname         = ( ! empty( $_POST['pp-add-inf-lname'] ) ? sanitize_text_field( $_POST['pp-add-inf-lname'] ) : null );
					$pp_add_inf_email         = ( ! empty( $_POST['pp-add-inf-email'] ) ? sanitize_email( $_POST['pp-add-inf-email'] ) : null );
					$pp_add_inf_phone         = ( ! empty( $_POST['pp-add-inf-phone'] ) ? sanitize_text_field( $_POST['pp-add-inf-phone'] ) : null );

					// Do the math
					$start_alc_point     = ( $pp_alc_guests_number - $pp_non_alc_guests_number ) * $pp_time_party;
					$start_non_alc_point = $pp_non_alc_guests_number * $pp_time_party;
					$beer_cons           = $start_alc_point * PP_BEER_CONS * $pp_bear_input_name / 100;
					$wine_cons           = $start_alc_point * PP_WINE_CONS * $pp_wine_input_name / 100;
					$strong_cons         = $start_alc_point * PP_STRONG_CONS * $pp_strong_input_name / 100;

					$get_html = '
					<div class="pp-result-wrapper pp-p-20">
						<div class="pp-result-title-wrapper">
							<div class="pp-result-title pp-col-50">
								<h2>' . __( 'Potrebno piće', PARTY_PLANER_TEXT_DOMAIN ) . '</h2>
							</div>
							<div class="pp-result-description pp-col-50">
								<p>' . __( 'Na osnovu gore unetih informacija kalkulator Vam automatski izračunava potrebe pića za vaše slavlje.', PARTY_PLANER_TEXT_DOMAIN ) . '</p>
							</div>
						</div>
						<div class="pp-result-get-wrapper">
							<div class="pp-result-col pp-col-25">
								<p class="pp-result-number">' . __( ceil( $beer_cons ) . 'l', PARTY_PLANER_TEXT_DOMAIN ) . '</p>
								<span class="pp-result-number-description">' . __( 'Pivo', PARTY_PLANER_TEXT_DOMAIN ) . '</span>
							</div>
							<div class="pp-result-col pp-col-25">
								<p class="pp-result-number">' . __( ceil( $wine_cons ) . 'l', PARTY_PLANER_TEXT_DOMAIN ) . '</p>
								<span class="pp-result-number-description">' . __( 'Vino', PARTY_PLANER_TEXT_DOMAIN ) . '</span>
							</div>
							<div class="pp-result-col pp-col-25">
								<p class="pp-result-number">' . __( ceil( $strong_cons ) . 'l', PARTY_PLANER_TEXT_DOMAIN ) . '</p>
								<span class="pp-result-number-description">' . __( 'Žestina', PARTY_PLANER_TEXT_DOMAIN ) . '</span>
							</div>
							<div class="pp-result-col pp-col-25">
								<p class="pp-result-number">' . __( ceil( $start_non_alc_point ) . 'l', PARTY_PLANER_TEXT_DOMAIN ) . '</p>
								<span class="pp-result-number-description">' . __( 'Bezalkoholna pića', PARTY_PLANER_TEXT_DOMAIN ) . '</span>
							</div>
						</div>
					<div>
					';

					if ( $pp_add_inf_name !== null && $pp_add_inf_lname !== null && $pp_add_inf_email !== null && $pp_add_inf_phone !== null ) {
						return;
					} else {
						// code
					}

					return $get_html;
				}
			}
		}
	}
}