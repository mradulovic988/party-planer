<?php
/**
 * Class PP_Query_Table
 *
 * Class for listing queries in Query admin page
 *
 * @class PP_Query_Table
 * @package PP_Query_Table
 * @version 1.0.0
 * @author M Lab Studio
 * @see https://developer.wordpress.org/reference/classes/wp_list_table/
 */

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if ( ! class_exists( 'PP_Query_Table' ) ) {
	class PP_Query_Table extends WP_List_Table {

		/**
		 * Prepare the items for the table to process
		 *
		 * @return void
		 */
		public function prepare_items() {
			$columns  = $this->get_columns();
			$hidden   = $this->get_hidden_columns();
			$sortable = $this->get_sortable_columns();

			$data = $this->table_data();
			usort( $data, array( &$this, 'sort_data' ) );

			$perPage     = 3;
			$currentPage = $this->get_pagenum();
			$totalItems  = count( $data );

			$this->set_pagination_args( array(
				'total_items' => $totalItems,
				'per_page'    => $perPage
			) );

			$data = array_slice( $data, ( ( $currentPage - 1 ) * $perPage ), $perPage );

			$this->_column_headers = array( $columns, $hidden, $sortable );
			$this->items           = $data;

			$this->pp_delete_query();
		}

		/**
		 * Override the parent columns method. Defines the columns to use in your listing table
		 *
		 * @return array
		 */
		public function get_columns() {
			$columns = array(
				'id'      => 'ID',
				'fname'   => 'First Name',
				'lname'   => 'Last name',
				'email'   => 'Email',
				'phone'   => 'Phone',
				'beer'    => 'Pivo',
				'wine'    => 'Vino',
				'strong'  => 'Žestina',
				'non_alc' => 'Bezalkoholno',
				'delete'  => 'Delete'
			);

			return $columns;
		}

		/**
		 * Define which columns are hidden
		 *
		 * @return array
		 */
		public function get_hidden_columns() {
			return array();
		}

		/**
		 * Define the sortable columns
		 *
		 * @return Array
		 */
		public function get_sortable_columns() {
			return array( 'fname' => array( 'fname', false ) );
		}

		/**
		 * Get the table data
		 *
		 * @return array
		 */
		private function table_data() {
			global $wpdb;
			$rows = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}party_planer`" );

			$data = array();

			foreach ( $rows as $row ) {
				$data[] = array(
					'id'      => $row->id,
					'fname'   => $row->fname,
					'lname'   => $row->lname,
					'email'   => '<a href="mailto:' . $row->email . '">' . $row->email . '</a>',
					'phone'   => '<a href="tel:' . $row->phone . '">' . $row->phone . '</a>',
					'beer'    => $row->beer . 'l',
					'wine'    => $row->wine . 'l',
					'strong'  => $row->strong . 'l',
					'non_alc' => $row->non_alc . 'l',
					'delete'  => '<form method="post">' . wp_nonce_field( 'pp_delete_save', 'pp_delete_name' ) . '<input type="hidden" name="pp-delete-query" value="' . $row->id . '" name="pp-delete-row"><input type="submit" value="Delete" name="pp-delete-row"></form>'
				);
			}

			return $data;
		}

		/**
		 * Deleting query
		 *
		 * @return void
		 */
		protected function pp_delete_query() {
			global $wpdb;
			if ( isset( $_POST['pp-delete-row'] ) ) {
				if ( ! isset( $_POST['pp_delete_name'] ) || ! wp_verify_nonce( $_POST['pp_delete_name'], 'pp_delete_save' ) ) {
					esc_attr__( 'Sorry, this action is not allowed.', PARTY_PLANER_TEXT_DOMAIN );
					exit;
				} else {
					$get_query = sanitize_text_field( $_POST['pp-delete-query'] );
					$wpdb->delete( $wpdb->prefix . 'party_planer', array( 'id' => $get_query ), array( '%d' ) );
					echo '<script>location.reload()</script>';
				}
			}
		}

		/**
		 * Define what data to show on each column of the table
		 *
		 * @param array $item Data
		 * @param string $column_name - Current column name
		 *
		 * @return mixed
		 */
		public function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'id':
				case 'fname':
				case 'lname':
				case 'email':
				case 'phone':
				case 'beer':
				case 'wine':
				case 'strong':
				case 'non_alc':
				case 'delete':
					return $item[ $column_name ];

				default:
					return print_r( $item, true );
			}
		}

		/**
		 * Allows you to sort the data by the variables set in the $_GET
		 *
		 * @return mixed
		 */
		private function sort_data( $a, $b ) {
			// Set defaults
			$orderby = 'id';
			$order   = 'asc';

			// If orderby is set, use this as the sort column
			if ( ! empty( $_GET['orderby'] ) ) {
				$orderby = $_GET['orderby'];
			}

			// If order is set use this as the order
			if ( ! empty( $_GET['order'] ) ) {
				$order = $_GET['order'];
			}


			$result = strcmp( $a[ $orderby ], $b[ $orderby ] );

			if ( $order === 'asc' ) {
				return $result;
			}

			return - $result;
		}
	}
}