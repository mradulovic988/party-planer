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
			global $wpdb;

			if ( isset( $_POST['pp-party-planer-submit'] ) ) {
				if ( ! isset( $_POST['pp_calculator_name'] ) || ! wp_verify_nonce( $_POST['pp_calculator_name'], 'pp_calculator_save' ) ) {
					esc_attr__( 'Sorry, this action is not allowed.', PARTY_PLANER_TEXT_DOMAIN );
					exit;
				} else {

					// Declare fields and values
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

					// Create formula
					$start_alc_point     = ( $pp_alc_guests_number - $pp_non_alc_guests_number ) * $pp_time_party;
					$start_non_alc_point = $pp_non_alc_guests_number * $pp_time_party;

					// Add old group coefficients
					$old_2030              = $pp_age_old_2030 * 1.1;
					$old_3040              = $pp_age_old_3040 * 0.9;
					$old_4050              = $pp_age_old_4050 * 0.8;
					$old_5060              = $pp_age_old_5060 * 0.7;
					$old_70                = $pp_age_old_70 * 0.6;
					$old_group_coefficient = $old_2030 + $old_3040 + $old_4050 + $old_5060 + $old_70;

					// Do the final math
					$beer_cons   = $start_alc_point * PP_BEER_CONS * $pp_bear_input_name / 100 + $old_group_coefficient;
					$wine_cons   = $start_alc_point * PP_WINE_CONS * $pp_wine_input_name / 100 + $old_group_coefficient;
					$strong_cons = $start_alc_point * PP_STRONG_CONS * $pp_strong_input_name / 100 + $old_group_coefficient;

					$get_html = '
					<div id="pp-calculated" class="pp-result-wrapper pp-p-20">
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

					if ( ! empty( $pp_add_inf_name ) || ! empty( $pp_add_inf_lname ) || ! empty( $pp_add_inf_email ) || ! empty( $pp_add_inf_phone ) ) {
						$table  = $wpdb->prefix . 'party_planer';
						$data   = array(
							'fname'   => $pp_add_inf_name,
							'lname'   => $pp_add_inf_lname,
							'email'   => $pp_add_inf_email,
							'phone'   => $pp_add_inf_phone,
							'beer'    => ceil( $beer_cons ),
							'wine'    => ceil( $wine_cons ),
							'strong'  => ceil( $strong_cons ),
							'non_alc' => ceil( $start_non_alc_point )
						);
						$format = array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' );
						$wpdb->insert( $table, $data, $format );
					}

					return $get_html;
				}
			}
		}
	}
}