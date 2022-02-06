<?php
/**
 * Class PP_Settings
 *
 * API Settings - Admin pages and fields
 *
 * @class PP_Settings
 * @package PP_Settings
 * @version 1.0.0
 * @author M Lab Studio
 */

if ( ! class_exists( 'PP_Settings' ) ) {
	class PP_Settings {
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'pp_add_admin_pages' ) );
			add_action( 'admin_init', array( $this, 'pp_register_settings' ) );
			add_action( 'admin_notices', array( $this, 'pp_show_error_notice' ) );
		}

		public function pp_show_error_notice() {
			if ( isset( $_GET['settings-updated'] ) ) {
				$message = esc_attr__( 'You have successfully saved your settings.', PARTY_PLANER_TEXT_DOMAIN );
				add_settings_error( 'pp_settings_fields', 'success', $message, 'success' );
			}
		}

		public function pp_add_admin_pages() {
			add_menu_page(
				__( 'Party Planer', PARTY_PLANER_TEXT_DOMAIN ),
				__( 'Party Planer', PARTY_PLANER_TEXT_DOMAIN ),
				'manage_options',
				'party_planer_options', array( $this, 'pp_register_submenu_page_callback', ),
				'dashicons-calculator'
			);
			add_submenu_page(
				'party_planer_options',
				__( 'Query', PARTY_PLANER_TEXT_DOMAIN ),
				__( 'Query', PARTY_PLANER_TEXT_DOMAIN ),
				'manage_options',
				'party_planer_query', array( $this, 'pp_query' )
			);
		}

		public function pp_query() {

		}

		protected function pp_menu_is_active( $active_tab, $is_active, $is_next ) {
			?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=party_planer_options" class="nav-tab <?php if ( $active_tab == 'party_planer_options' ) {
					echo 'nav-tab-active';
				} ?> "><?php _e( 'Party Planer', PARTY_PLANER_TEXT_DOMAIN ); ?></a>
                <a href="?page=party_planer_query" class="nav-tab <?php if ( $active_tab == 'party_planer_query' ) {
					echo 'nav-tab-active';
				} ?>"><?php _e( 'Query', PARTY_PLANER_TEXT_DOMAIN ); ?></a>
            </h2>
			<?php

			$active_tab = $is_active;

			if ( isset( $_GET["tab"] ) ) {

				if ( $_GET["tab"] == $is_active ) {
					$active_tab = $is_active;
				} else {
					$active_tab = $is_next;
				}
			}
		}

		protected function pp_settings_fields( string $type, string $id, string $class, string $name, string $value, string $placeholder = '', string $description = '', string $min = '', string $max = '', string $required = '' ) {
			switch ( $type ) {
				case 'text':
					echo '<input type="text" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="pp_settings_fields[' . esc_attr( $name ) . ']" value="' . esc_attr( $value ) . '" placeholder="' . esc_attr( $placeholder ) . '" ' . esc_attr( $required ) . '><small class="pp-field-desc">' . esc_attr( $description ) . '</small>';
					break;
				case 'checkbox':
					echo '<label class="pp-switch" for="' . esc_attr( $id ) . '"><input type="checkbox" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="pp_settings_fields[' . esc_attr( $name ) . ']" value="1" ' . esc_attr( $value ) . '><span class="pp-slider pp-round"></span></label><small class="pp-field-desc">' . esc_attr( $description ) . '</small>';
					break;
			}
		}

		public function pp_options_check( string $id ): string {
			$options = get_option( 'pp_settings_fields' );

			return ( ! empty( $options[ $id ] ) ? $options[ $id ] : '' );
		}

		public function pp_register_submenu_page_callback() {
			?>
            <div class="wrap">
				<?php $this->pp_menu_is_active( 'party_planer_options', 'party_planer_options', 'party_planer_query' ); ?>
                <form action="options.php" method="post">

					<?php
					settings_errors( 'pp_settings_fields' );
					wp_nonce_field( 'pp_dashboard_save', 'pp_form_save_name' );
					settings_fields( 'pp_settings_fields' );
					do_settings_sections( 'pp_settings_section_one' );
					?>
                    <div class="pp-loading-wrapper">
						<?php
						submit_button(
							esc_attr__( 'Save changes', PARTY_PLANER_TEXT_DOMAIN ),
							'primary',
							'pp_save_changes_btn',
							true,
							array( 'id' => 'pp-save-changes-btn' )
						);
						?>
                        <div class="pp-loader"></div>
                    </div>

                </form>

				<?php
				if ( ! isset( $_POST['pp_form_save_name'] ) ||
				     ! wp_verify_nonce( $_POST['pp_form_save_name'], 'pp_dashboard_save' ) ) {
					return;
				}
				?>
            </div>
			<?php
		}

		public function pp_register_settings() {

			register_setting( 'pp_settings_fields', 'pp_settings_fields', 'pp_sanitize_callback' );

			// Adding sections
			add_settings_section( 'pp_section_id', esc_attr__( 'Party Planer Option', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_settings_section_callback'
			), 'pp_settings_section_one' );

			// Add to cart fields
			add_settings_field( 'pp_section_id_test', esc_attr__( 'Test', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_test'
			), 'pp_settings_section_one', 'pp_section_id' );
		}

		public function pp_settings_section_callback() {
            // Page description
		}

		public function pp_section_id_test() {
			$this->pp_settings_fields( 'text', 'pp-checkout-fields', 'pp-settings-field', 'checkout_fields', esc_attr__( sanitize_text_field( $this->pp_options_check( 'checkout_fields' ) ) ), 'test', esc_attr__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, aliquam', PARTY_PLANER_TEXT_DOMAIN ) );
		}
	}

	new PP_Settings();
}