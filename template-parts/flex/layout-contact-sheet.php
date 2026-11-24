<?php
/**
 * Partial: Contact sheet
 * ACF-Felder: title, studio_intro, studio_address
 */

$title = trim((string) get_sub_field('title'));
$studio_intro = trim((string) get_sub_field('studio_intro'));
$studio_address = trim((string) get_sub_field('studio_address'));

if (!$title) {
  $title = 'Contact us';
}

if (!$studio_intro) {
  $studio_intro = 'Or visit us in person at our studio at';
}

if (!$studio_address) {
  $studio_address = 'Mustermannstraße 45.';
}

$contact_status = isset($_GET['contact_status']) && is_string($_GET['contact_status'])
  ? sanitize_key(wp_unslash($_GET['contact_status']))
  : '';
$contact_status_messages = [
  'sent' => __('Thank you. Your message has been sent.', 'projecttheme'),
  'invalid' => __('Please complete all fields with a valid email address.', 'projecttheme'),
  'failed' => __('Your message could not be sent. Please try again later.', 'projecttheme'),
];
?>

<div class="contact-sheet__inner">
  <div class="contact-sheet__intro">
    <h1 class="contact-sheet__title"><?php echo esc_html($title); ?></h1>
    <p class="contact-sheet__address">
      <?php echo esc_html($studio_intro); ?><br>
      <?php echo esc_html($studio_address); ?>
    </p>
  </div>

  <?php if (isset($contact_status_messages[$contact_status])): ?>
    <p class="contact-sheet__status" role="status">
      <?php echo esc_html($contact_status_messages[$contact_status]); ?>
    </p>
  <?php endif; ?>

  <form class="contact-sheet__form"
        action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
        method="post">
    <input type="hidden" name="action" value="projecttheme_contact_sheet">
    <?php wp_nonce_field('projecttheme_contact_sheet', 'contact_sheet_nonce'); ?>

    <div class="contact-sheet__field">
      <label for="contact-sheet-first-name"><?php esc_html_e('Name', 'projecttheme'); ?></label>
      <input id="contact-sheet-first-name"
             name="first_name"
             type="text"
             placeholder="Value"
             autocomplete="given-name"
             required>
    </div>

    <div class="contact-sheet__field">
      <label for="contact-sheet-surname"><?php esc_html_e('Surname', 'projecttheme'); ?></label>
      <input id="contact-sheet-surname"
             name="surname"
             type="text"
             placeholder="Value"
             autocomplete="family-name"
             required>
    </div>

    <div class="contact-sheet__field">
      <label for="contact-sheet-email"><?php esc_html_e('Email', 'projecttheme'); ?></label>
      <input id="contact-sheet-email"
             name="email"
             type="email"
             placeholder="Value"
             autocomplete="email"
             required>
    </div>

    <div class="contact-sheet__field">
      <label for="contact-sheet-message"><?php esc_html_e('Message', 'projecttheme'); ?></label>
      <textarea id="contact-sheet-message"
                name="message"
                placeholder="Value"
                required></textarea>
    </div>

    <button class="contact-sheet__submit" type="submit">
      <?php esc_html_e('Submit', 'projecttheme'); ?>
    </button>
  </form>
</div>
