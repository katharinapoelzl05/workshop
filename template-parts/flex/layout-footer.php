<?php
/**
 * Partial: Footer
 * ACF-Feld: title (text)
 */

$title = trim((string) get_sub_field('title'));

if (!$title) {
  $title = 'Independend organisation';
}
?>

<div class="footer__inner">
  <p class="footer__title">
    <?php echo esc_html($title); ?>
  </p>
</div>
