<?php

function projecttheme_redirect_contact_sheet( $status ) {
	$referer = wp_get_referer();
	$redirect_url = $referer ? remove_query_arg( 'contact_status', $referer ) : home_url( '/' );

	wp_safe_redirect( add_query_arg( 'contact_status', $status, $redirect_url ) );
	exit;
}

function projecttheme_handle_contact_sheet_submission() {
	check_admin_referer( 'projecttheme_contact_sheet', 'contact_sheet_nonce' );

	$first_name = isset( $_POST['first_name'] ) && is_string( $_POST['first_name'] )
		? sanitize_text_field( wp_unslash( $_POST['first_name'] ) )
		: '';
	$surname = isset( $_POST['surname'] ) && is_string( $_POST['surname'] )
		? sanitize_text_field( wp_unslash( $_POST['surname'] ) )
		: '';
	$email = isset( $_POST['email'] ) && is_string( $_POST['email'] )
		? sanitize_email( wp_unslash( $_POST['email'] ) )
		: '';
	$message = isset( $_POST['message'] ) && is_string( $_POST['message'] )
		? sanitize_textarea_field( wp_unslash( $_POST['message'] ) )
		: '';

	if ( ! $first_name || ! $surname || ! is_email( $email ) || ! $message ) {
		projecttheme_redirect_contact_sheet( 'invalid' );
	}

	$recipient = sanitize_email( get_option( 'admin_email' ) );
	if ( ! is_email( $recipient ) ) {
		projecttheme_redirect_contact_sheet( 'failed' );
	}

	$subject = sprintf(
		/* translators: %s: sender's full name */
		__( 'Contact form message from %s', 'projecttheme' ),
		$first_name . ' ' . $surname
	);
	$body = sprintf(
		"Name: %s\nSurname: %s\nEmail: %s\n\nMessage:\n%s",
		$first_name,
		$surname,
		$email,
		$message
	);

	if ( ! wp_mail( $recipient, $subject, $body, array( 'Reply-To: ' . $email ) ) ) {
		projecttheme_redirect_contact_sheet( 'failed' );
	}

	projecttheme_redirect_contact_sheet( 'sent' );
}
add_action( 'admin_post_nopriv_projecttheme_contact_sheet', 'projecttheme_handle_contact_sheet_submission' );
add_action( 'admin_post_projecttheme_contact_sheet', 'projecttheme_handle_contact_sheet_submission' );
