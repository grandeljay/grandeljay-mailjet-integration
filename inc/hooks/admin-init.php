<?php
/**
 * Admin Initialization
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Fields
 */
define( 'GJMJ4WP_MAILJET_API_VERSION', 'gjmj4wp-mailjet-api-version' );
define( 'GJMJ4WP_MAILJET_API_VERSION_SEND', 'gjmj4wp-mailjet-api-version-send' );
define( 'GJMJ4WP_MAILJET_API_KEY', 'gjmj4wp-mailjet-api-key' );
define( 'GJMJ4WP_MAILJET_API_SECRET', 'gjmj4wp-mailjet-api-secret' );

/**
 * Settings
 *
 * @link https://developer.wordpress.org/apis/handbook/settings/
 */
function gjmj4wp_settings() {
	/**
	 * Sections
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_settings_section/
	 */
	$gjmj4wp_sections_mailjet_api = 'gjmj4wp-mailjet-api';

	$gjmj4wp_sections = array(
		/** Mailjet API */
		array(
			'id'       => $gjmj4wp_sections_mailjet_api,
			'title'    => __( 'Mailjet API', 'grandeljay-mailjet-for-wordpress' ),
			'callback' => 'gjmj4wp_setting_section_mailjet_api_html',
			'page'     => GJMJ4WP_SETTINGS_MAILJET_API,
		),
	);

	foreach ( $gjmj4wp_sections as $section ) {
		add_settings_section(
			$section['id'],
			$section['title'],
			$section['callback'],
			$section['page'],
		);
	}

	/**
	 * Fields
	 */
	$gjmj4wp_fields = array(
		/**
		 * Mailjet API
		 */

		/** Version */
		array(
			array(
				'id'       => GJMJ4WP_MAILJET_API_VERSION,
				'title'    => __( 'Version', 'grandeljay-mailjet-for-wordpress' ),
				'callback' => 'gjmj4wp_setting_section_mailjet_api_version_html',
				'page'     => GJMJ4WP_SETTINGS_MAILJET_API,
				'section'  => $gjmj4wp_sections_mailjet_api,
				'args'     => array(
					'label_for' => GJMJ4WP_MAILJET_API_VERSION,
				),
			),
			array(
				'option_group' => GJMJ4WP_SETTINGS_MAILJET_API,
				'option_name'  => GJMJ4WP_MAILJET_API_VERSION,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The current API version to use.',
					'show_in_rest' => false,
					'default'      => 'v3',
				),
			),
		),

		/** Version (Send) */
		array(
			array(
				'id'       => GJMJ4WP_MAILJET_API_VERSION_SEND,
				'title'    => __( 'Version (Send)', 'grandeljay-mailjet-for-wordpress' ),
				'callback' => 'gjmj4wp_setting_section_mailjet_api_version_send_html',
				'page'     => GJMJ4WP_SETTINGS_MAILJET_API,
				'section'  => $gjmj4wp_sections_mailjet_api,
				'args'     => array(
					'label_for' => GJMJ4WP_MAILJET_API_VERSION_SEND,
				),
			),
			array(
				'option_group' => GJMJ4WP_SETTINGS_MAILJET_API,
				'option_name'  => GJMJ4WP_MAILJET_API_VERSION_SEND,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The current Send API version to use.',
					'show_in_rest' => false,
					'default'      => 'v3.1',
				),
			),
		),

		/** Key */
		array(
			array(
				'id'       => GJMJ4WP_MAILJET_API_KEY,
				'title'    => __( 'Key', 'grandeljay-mailjet-for-wordpress' ),
				'callback' => 'gjmj4wp_setting_section_mailjet_api_key_html',
				'page'     => GJMJ4WP_SETTINGS_MAILJET_API,
				'section'  => $gjmj4wp_sections_mailjet_api,
				'args'     => array(
					'label_for' => GJMJ4WP_MAILJET_API_KEY,
				),
			),
			array(
				'option_group' => GJMJ4WP_SETTINGS_MAILJET_API,
				'option_name'  => GJMJ4WP_MAILJET_API_KEY,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The Mailjet API Key to use.',
					'show_in_rest' => false,
					'default'      => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
				),
			),
		),

		/** Secret */
		array(
			array(
				'id'       => GJMJ4WP_MAILJET_API_SECRET,
				'title'    => __( 'Secret', 'grandeljay-mailjet-for-wordpress' ),
				'callback' => 'gjmj4wp_setting_section_mailjet_api_secret_html',
				'page'     => GJMJ4WP_SETTINGS_MAILJET_API,
				'section'  => $gjmj4wp_sections_mailjet_api,
				'args'     => array(
					'label_for' => GJMJ4WP_MAILJET_API_SECRET,
				),
			),
			array(
				'option_group' => GJMJ4WP_SETTINGS_MAILJET_API,
				'option_name'  => GJMJ4WP_MAILJET_API_SECRET,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The Mailjet API Secret to use.',
					'show_in_rest' => false,
					'default'      => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
				),
			),
		),
	);

	foreach ( $gjmj4wp_fields as $section_field ) {
		add_settings_field(
			$section_field[0]['id'],
			$section_field[0]['title'],
			$section_field[0]['callback'],
			$section_field[0]['page'],
			$section_field[0]['section'],
			$section_field[0]['args'],
		);

		register_setting(
			$section_field[1]['option_group'],
			$section_field[1]['option_name'],
			$section_field[1]['args'],
		);
	}
}

add_action( 'admin_init', 'gjmj4wp_settings' );

/**
 * Setting Section: Mailjet API
 *
 * @param array $args Display arguments.
 *
 * @return void
 */
function gjmj4wp_setting_section_mailjet_api_html( $args ): void {
}

/**
 * Mailjet API: Version
 */
function gjmj4wp_setting_section_mailjet_api_version_html() {
	$versions        = array(
		'v2',
		'v3',
	);
	$current_version = get_option( GJMJ4WP_MAILJET_API_VERSION );
	$field_value     = isset( $versions[ $current_version ] ) ? $versions[ $current_version ] : '';
	?>
	<select name="<?php echo esc_attr( GJMJ4WP_MAILJET_API_VERSION ); ?>"
			id="<?php echo esc_attr( GJMJ4WP_MAILJET_API_VERSION ); ?>"
	>
		<?php foreach ( $versions as $version ) { ?>
			<option value="<?php echo esc_attr( $version ); ?>"
					<?php selected( $version, $current_version ); ?>
			>
				<?php echo esc_html( $version ); ?>
			</option>
		<?php } ?>
	</select>
	<?php
}

/**
 * Mailjet API: Version (Send)
 */
function gjmj4wp_setting_section_mailjet_api_version_send_html() {
	$versions        = array(
		'v3',
		'v3.1',
	);
	$current_version = get_option( GJMJ4WP_MAILJET_API_VERSION_SEND );
	$field_value     = isset( $versions[ $current_version ] ) ? $versions[ $current_version ] : '';
	?>
	<select name="<?php echo esc_attr( GJMJ4WP_MAILJET_API_VERSION_SEND ); ?>" id="<?php echo esc_attr( GJMJ4WP_MAILJET_API_VERSION_SEND ); ?>">
		<?php foreach ( $versions as $version ) { ?>
			<option value="<?php echo esc_attr( $version ); ?>"
					<?php selected( $version, $current_version ); ?>
			>
				<?php echo esc_html( $version ); ?>
			</option>
		<?php } ?>
	</select>
	<?php
}

/**
 * Mailjet API: Key
 */
function gjmj4wp_setting_section_mailjet_api_key_html() {
	$current_key = get_option( GJMJ4WP_MAILJET_API_KEY );
	?>
	<input type="text" name="<?php echo esc_attr( GJMJ4WP_MAILJET_API_KEY ); ?>" id="<?php echo esc_attr( GJMJ4WP_MAILJET_API_KEY ); ?>" value="<?php echo esc_html( $current_key ); ?>" />
	<?php
}

/**
 * Mailjet API: Secret
 */
function gjmj4wp_setting_section_mailjet_api_secret_html() {
	$current_secret = get_option( GJMJ4WP_MAILJET_API_SECRET );
	?>
	<input type="text" name="<?php echo esc_attr( GJMJ4WP_MAILJET_API_SECRET ); ?>" id="<?php echo esc_attr( GJMJ4WP_MAILJET_API_SECRET ); ?>" value="<?php echo esc_html( $current_secret ); ?>" />
	<?php
}