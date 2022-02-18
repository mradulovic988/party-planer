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

					// Declare basic guest number
					$pp_alc_guests_number     = ( ! empty( $_POST['pp-alc-guests-number'] ) ? sanitize_text_field( $_POST['pp-alc-guests-number'] ) : 0 );
					$pp_non_alc_guests_number = ( ! empty( $_POST['pp-non-alc-guests-number'] ) ? sanitize_text_field( $_POST['pp-non-alc-guests-number'] ) : 0 );

					// Declare party time
					$pp_time_party = ( ! empty( $_POST['pp-time-party'] ) ? sanitize_text_field( $_POST['pp-time-party'] ) : 0 );

					// Declare advance old groups
					$pp_age_old_2030 = ( ! empty( $_POST['pp-age-old-2030'] ) ? sanitize_text_field( $_POST['pp-age-old-2030'] ) : 0 );
					$pp_age_old_3040 = ( ! empty( $_POST['pp-age-old-3040'] ) ? sanitize_text_field( $_POST['pp-age-old-3040'] ) : 0 );
					$pp_age_old_4050 = ( ! empty( $_POST['pp-age-old-4050'] ) ? sanitize_text_field( $_POST['pp-age-old-4050'] ) : 0 );
					$pp_age_old_5060 = ( ! empty( $_POST['pp-age-old-5060'] ) ? sanitize_text_field( $_POST['pp-age-old-5060'] ) : 0 );
					$pp_age_old_70   = ( ! empty( $_POST['pp-age-old-70'] ) ? sanitize_text_field( $_POST['pp-age-old-70'] ) : 0 );

					// Declare ranges
					$pp_bear_input_name   = ( ! empty( $_POST['ppBearInputName'] ) ? sanitize_text_field( $_POST['ppBearInputName'] ) : PP_BEER_PREF );
					$pp_wine_input_name   = ( ! empty( $_POST['ppVineInputName'] ) ? sanitize_text_field( $_POST['ppVineInputName'] ) : PP_WINE_PREF );
					$pp_strong_input_name = ( ! empty( $_POST['ppStrongInputName'] ) ? sanitize_text_field( $_POST['ppStrongInputName'] ) : PP_STRONG_PREF );

					// Declare user description fields
					$pp_add_inf_name  = ( ! empty( $_POST['pp-add-inf-name'] ) ? sanitize_text_field( $_POST['pp-add-inf-name'] ) : null );
					$pp_add_inf_lname = ( ! empty( $_POST['pp-add-inf-lname'] ) ? sanitize_text_field( $_POST['pp-add-inf-lname'] ) : null );
					$pp_add_inf_email = ( ! empty( $_POST['pp-add-inf-email'] ) ? sanitize_email( $_POST['pp-add-inf-email'] ) : null );
					$pp_add_inf_phone = ( ! empty( $_POST['pp-add-inf-phone'] ) ? sanitize_text_field( $_POST['pp-add-inf-phone'] ) : null );

					// Declare advance type preferences fields
					$pp_add_beer_lager    = ( ! empty( $_POST['pp-adv-beer-lager'] ) ? sanitize_text_field( $_POST['pp-adv-beer-lager'] ) : null );
					$pp_add_beer_psenica  = ( ! empty( $_POST['pp-adv-beer-psenicno'] ) ? sanitize_text_field( $_POST['pp-adv-beer-psenicno'] ) : null );
					$pp_add_beer_ipa      = ( ! empty( $_POST['pp-adv-beer-ipa'] ) ? sanitize_text_field( $_POST['pp-adv-beer-ipa'] ) : null );
					$pp_add_wine_red      = ( ! empty( $_POST['pp-adv-vine-crveno'] ) ? sanitize_text_field( $_POST['pp-adv-vine-crveno'] ) : null );
					$pp_add_wine_white    = ( ! empty( $_POST['pp-adv-vine-belo'] ) ? sanitize_text_field( $_POST['pp-adv-vine-belo'] ) : null );
					$pp_add_wine_rose     = ( ! empty( $_POST['pp-adv-vine-rose'] ) ? sanitize_text_field( $_POST['pp-adv-vine-rose'] ) : null );
					$pp_add_wine_penusavo = ( ! empty( $_POST['pp-adv-vine-penusavo'] ) ? sanitize_text_field( $_POST['pp-adv-vine-penusavo'] ) : null );
					$pp_add_strong_vodka  = ( ! empty( $_POST['pp-adv-strong-vodka'] ) ? sanitize_text_field( $_POST['pp-adv-strong-vodka'] ) : null );
					$pp_add_strong_dzin   = ( ! empty( $_POST['pp-adv-strong-dzin'] ) ? sanitize_text_field( $_POST['pp-adv-strong-dzin'] ) : null );
					$pp_add_strong_viski  = ( ! empty( $_POST['pp-adv-strong-viski'] ) ? sanitize_text_field( $_POST['pp-adv-strong-viski'] ) : null );
					$pp_add_strong_rakija = ( ! empty( $_POST['pp-adv-strong-rakija'] ) ? sanitize_text_field( $_POST['pp-adv-strong-rakija'] ) : null );
					$pp_add_strong_tekila = ( ! empty( $_POST['pp-adv-strong-tekila'] ) ? sanitize_text_field( $_POST['pp-adv-strong-tekila'] ) : null );
					$pp_add_strong_vermut = ( ! empty( $_POST['pp-adv-strong-vermut'] ) ? sanitize_text_field( $_POST['pp-adv-strong-vermut'] ) : null );

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

					// Add type preferences
					$beer_lager       = $pp_add_beer_lager / 100;
					$beer_psenica     = $pp_add_beer_psenica / 100;
					$beer_ipa         = $pp_add_beer_ipa / 100;
					$wine_red         = $pp_add_wine_red / 100;
					$wine_white       = $pp_add_wine_white / 100;
					$wine_rose        = $pp_add_wine_rose / 100;
					$wine_penusavo    = $pp_add_wine_penusavo / 100;
					$strong_vodka     = $pp_add_strong_vodka / 100;
					$strong_dzin      = $pp_add_strong_dzin / 100;
					$strong_viski     = $pp_add_strong_viski / 100;
					$strong_rakija    = $pp_add_strong_rakija / 100;
					$strong_tekila    = $pp_add_strong_tekila / 100;
					$strong_vermut    = $pp_add_strong_vermut / 100;
					$type_preferences = $beer_lager + $beer_psenica + $beer_ipa + $wine_red + $wine_white + $wine_rose +
					                    $wine_penusavo + $strong_vodka + $strong_dzin + $strong_viski + $strong_rakija +
					                    $strong_tekila + $strong_vermut;

					// Do the final math
					$beer_cons   = $start_alc_point * PP_BEER_CONS * $pp_bear_input_name / 100 + $old_group_coefficient + $type_preferences;
					$wine_cons   = $start_alc_point * PP_WINE_CONS * $pp_wine_input_name / 100 + $old_group_coefficient + $type_preferences;
					$strong_cons = $start_alc_point * PP_STRONG_CONS * $pp_strong_input_name / 100 + $old_group_coefficient + $type_preferences;

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
						<div class="pp-result-get-wrapper pp-inline-flex">
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