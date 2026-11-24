<?php
/**
 * Partial: headline
 * ACF-Feld: title (text)
 */

$title = trim((string) get_sub_field('title'));

if (!$title) {
  $title = 'Discover what our community has created.';
}
?>

<div class="headline__inner">
  <h2 class="headline__title">
    <?php echo esc_html($title); ?>
  </h2>
</div>
