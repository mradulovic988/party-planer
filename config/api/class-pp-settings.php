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

		/**
		 * Show notice
		 *
		 * @return void
		 */
		public function pp_show_error_notice() {
			if ( isset( $_GET['settings-updated'] ) ) {
				$message = esc_attr__( 'You have successfully saved your settings.', PARTY_PLANER_TEXT_DOMAIN );
				add_settings_error( 'pp_settings_fields', 'success', $message, 'success' );
			}
		}

		/**
		 * Admin plugin pages
		 *
		 * @return void
		 */
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
				'party_planer_query', array( $this, 'pp_register_submenu_query_page_callback' )
			);
		}

		/**
		 * Show navigation menu on admin pages
		 *
		 * @param string $active_tab Active tab
		 * @param string $is_active Is active tab
		 * @param string $is_next Next tab
		 *
		 * @return void
		 */
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

		/**
		 * Settings API fields
		 *
		 * @param string $type Field type
		 * @param string $id Field ID
		 * @param string $class Field Class
		 * @param string $name Field name
		 * @param string $value Field value
		 * @param string $placeholder Field placeholder
		 * @param string $description Field description
		 * @param string $min Field minimum value - number
		 * @param string $max Field maximum value - number
		 * @param string $required Field required
		 *
		 * @return void
		 */
		protected function pp_settings_fields( string $type, string $id, string $class, string $name, string $value, string $placeholder = '', string $description = '', string $min = '', string $max = '', string $required = '' ) {
			switch ( $type ) {
				case 'text':
					echo '<input type="text" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="pp_settings_fields[' . esc_attr( $name ) . ']" value="' . esc_attr( $value ) . '" placeholder="' . esc_attr( $placeholder ) . '" ' . esc_attr( $required ) . '><small class="pp-field-desc">' . esc_attr( $description ) . '</small>';
					break;
				case 'checkbox':
					echo '<label class="pp-switch" for="' . esc_attr( $id ) . '"><input type="checkbox" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="pp_settings_fields[' . esc_attr( $name ) . ']" value="1" ' . esc_attr( $value ) . '><span class="pp-slider pp-round"></span></label><small class="pp-field-desc">' . esc_attr( $description ) . '</small>';
					break;
				case 'number':
					echo '<label class="text" for="' . esc_attr( $id ) . '"><input type="number" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="pp_settings_fields[' . esc_attr( $name ) . ']" value="1" ' . esc_attr( $value ) . '><span class="pp-slider pp-round"></span></label><small class="pp-field-desc">' . esc_attr( $description ) . '</small>';
					break;
			}
		}

		/**
		 * Check if option is empty or not
		 *
		 * @param string $id Option ID
		 *
		 * @return string
		 */
		public function pp_options_check( string $id ): string {
			$options = get_option( 'pp_settings_fields' );

			return ( ! empty( $options[ $id ] ) ? $options[ $id ] : '' );
		}

		/**
		 * Party planer option admin page
		 *
		 * @return void
		 */
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


		public function pp_register_submenu_query_page_callback() {
			$this->pp_menu_is_active( 'party_planer_query', 'party_planer_query', '' );

			$get_tables = new PP_Query_Table();
			$get_tables->prepare_items();
			?>
            <div class="wrap">
				<?php $get_tables->display(); ?>
            </div>
			<?php

		}

		/**
		 * Register all Settings API
		 *
		 * @return void
		 */
		public function pp_register_settings() {

			register_setting( 'pp_settings_fields', 'pp_settings_fields', 'pp_sanitize_callback' );

			// Adding sections
			add_settings_section( 'pp_section_id', esc_attr__( 'Party Planer Option', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_settings_section_callback'
			), 'pp_settings_section_one' );

			// Fields
			add_settings_field( 'pp_section_id_beer_consumption', esc_attr__( 'Beer Consumption', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_beer_consumption'
			), 'pp_settings_section_one', 'pp_section_id' );

			add_settings_field( 'pp_section_id_wine_consumption', esc_attr__( 'Wine Consumption', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_wine_consumption'
			), 'pp_settings_section_one', 'pp_section_id' );

			add_settings_field( 'pp_section_id_strong_consumption', esc_attr__( 'Strong Consumption', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_strong_consumption'
			), 'pp_settings_section_one', 'pp_section_id' );

			add_settings_field( 'pp_section_id_strong_consumption', esc_attr__( 'Strong Consumption', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_strong_consumption'
			), 'pp_settings_section_one', 'pp_section_id' );

			add_settings_field( 'pp_section_id_beer_preferences', esc_attr__( 'Beer Preferences', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_beer_preferences'
			), 'pp_settings_section_one', 'pp_section_id' );

			add_settings_field( 'pp_section_id_wine_preferences', esc_attr__( 'Wine Preferences', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_wine_preferences'
			), 'pp_settings_section_one', 'pp_section_id' );

			add_settings_field( 'pp_section_id_strong_preferences', esc_attr__( 'Strong Preferences', PARTY_PLANER_TEXT_DOMAIN ), array(
				$this,
				'pp_section_id_strong_preferences'
			), 'pp_settings_section_one', 'pp_section_id' );
		}

		/**
		 * Party planer option description text
		 *
		 * @return void
		 */
		public function pp_settings_section_callback() {
			_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam animi autem, beatae et expedita explicabo facere fugit labore laborum modi nam placeat porro provident quasi, quisquam similique sunt vitae.', PARTY_PLANER_TEXT_DOMAIN );
		}

		/**
		 * Beer consumption field
		 *
		 * @return void
		 */
		public function pp_section_id_beer_consumption() {
			$this->pp_settings_fields( 'text', 'pp-beer-consumption', 'pp-beer-consumption', 'beer_consumption', esc_attr__( sanitize_text_field( $this->pp_options_check( 'beer_consumption' ) ) ), '0.4', esc_attr__( '%', PARTY_PLANER_TEXT_DOMAIN ) );
		}

		/**
		 * Wine consumption field
		 *
		 * @return void
		 */
		public function pp_section_id_wine_consumption() {
			$this->pp_settings_fields( 'text', 'pp-wine-consumption', 'pp-wine-consumption', 'wine_consumption', esc_attr__( sanitize_text_field( $this->pp_options_check( 'wine_consumption' ) ) ), '0.17', esc_attr__( '%', PARTY_PLANER_TEXT_DOMAIN ) );
		}

		/**
		 * Strong consumption field
		 *
		 * @return void
		 */
		public function pp_section_id_strong_consumption() {
			$this->pp_settings_fields( 'text', 'pp-strong-consumption', 'pp-strong-consumption', 'strong_consumption', esc_attr__( sanitize_text_field( $this->pp_options_check( 'strong_consumption' ) ) ), '0.08', esc_attr__( '%', PARTY_PLANER_TEXT_DOMAIN ) );
		}

		/**
		 * Beer preferences field
		 *
		 * @return void
		 */
		public function pp_section_id_beer_preferences() {
			$this->pp_settings_fields( 'text', 'pp-beer-preferences', 'pp-beer-preferences', 'beer_preferences', esc_attr__( sanitize_text_field( $this->pp_options_check( 'beer_preferences' ) ) ), '40%', esc_attr__( '%', PARTY_PLANER_TEXT_DOMAIN ) );
		}

		/**
		 * Wine preferences field
		 *
		 * @return void
		 */
		public function pp_section_id_wine_preferences() {
			$this->pp_settings_fields( 'text', 'pp-wine-preferences', 'pp-wine-preferences', 'wine_preferences', esc_attr__( sanitize_text_field( $this->pp_options_check( 'wine_preferences' ) ) ), '35%', esc_attr__( '%', PARTY_PLANER_TEXT_DOMAIN ) );
		}

		/**
		 * Strong preferences field
		 *
		 * @return void
		 */
		public function pp_section_id_strong_preferences() {
			$this->pp_settings_fields( 'text', 'pp-strong-preferences', 'pp-strong-preferences', 'strong_preferences', esc_attr__( sanitize_text_field( $this->pp_options_check( 'strong_preferences' ) ) ), '25%', esc_attr__( '%', PARTY_PLANER_TEXT_DOMAIN ) );
		}
	}

	new PP_Settings();
}