<?php

namespace GenesisCustomizer;

add_action( 'genesis_setup', __NAMESPACE__ . '\setup_theme' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function setup_theme() {
	$optional = false;

	$config = apply_filters( 'genesis_customizer_dependencies', [
		[
			'name'     => 'Genesis Customizer',
			'host'     => 'github',
			'slug'     => 'genesis-customizer/genesis-customizer.php',
			'uri'      => 'seothemes/genesis-customizer',
			'branch'   => 'master',
			'optional' => $optional,
			'token'    => null,
		],
		[
			'name'     => 'One Click Demo Import',
			'host'     => 'wordpress',
			'slug'     => 'one-click-demo-import/one-click-demo-import.php',
			'uri'      => 'https://wordpress.org/plugins/one-click-demo-import/',
			'optional' => $optional,
		],
		[
			'name'     => 'Kirki',
			'host'     => 'wordpress',
			'slug'     => 'kirki/kirki.php',
			'uri'      => 'https://wordpress.org/plugins/kirki/',
			'optional' => $optional,
		],
	] );

	// Install and active dependencies.
	\WP_Dependency_Installer::instance()->load_hooks();
	\WP_Dependency_Installer::instance()->register( $config );
}

add_action( 'admin_init', __NAMESPACE__ . '\theme_redirect', 100 );
/**
 * Redirect after activation.
 *
 * @since 1.0.0
 *
 * @return void
 */
function theme_redirect() {
	global $pagenow;

	if ( "themes.php" == $pagenow && is_admin() && isset( $_GET['activated'] ) ) {
		exit( wp_redirect( admin_url( 'admin.php?page=genesis-customizer-demo-import' ) ) );
	}
}
