<?php

namespace GenesisCustomizer;

// Install and active dependencies.
\WP_Dependency_Installer::instance()->run( __DIR__ );

// Redirect after activation.
add_action( 'admin_init', function() {
	global $pagenow;

	if ( "themes.php" == $pagenow && is_admin() && isset( $_GET['activated'] ) ) {
		exit( wp_redirect( admin_url( 'admin.php?page=genesis-customizer-setup' ) ) );
	}
}, 100 );
