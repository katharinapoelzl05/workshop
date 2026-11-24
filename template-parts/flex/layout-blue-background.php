<?php
/**
 * Partial: blue background
 * ACF-Felder: title (text), text (textarea), stamp (image)
 */

$title = trim((string) get_sub_field('title'));
$text = trim((string) get_sub_field('text'));
$stamp_id = get_sub_field('stamp');

if (!$title) {
  $title = 'The Creative Affair';
}

if (!$text) {
  $text = 'Creativity brings people together. Whether you’re discovering a new hobby or developing an existing passion, we’re here to inspire you. Explore different crafts, meet like-minded people and enjoy the beauty of creating something with your own hands';
}

$stamp_url = $stamp_id
  ? wp_get_attachment_image_url($stamp_id, 'full')
  : get_template_directory_uri() . '/assets/images/blue-background-stamp.svg';

$stamp_alt = $stamp_id
  ? get_post_meta($stamp_id, '_wp_attachment_image_alt', true)
  : '';
?>

<div class="blue-background__inner">
  <h2 class="blue-background__title">
    <?php echo esc_html($title); ?>
  </h2>

  <div class="blue-background__stamp">
    <?php if ($stamp_url): ?>
      <img class="blue-background__stamp-image"
           src="<?php echo esc_url($stamp_url); ?>"
           alt="<?php echo esc_attr($stamp_alt); ?>"
           loading="lazy"
           decoding="async">
    <?php endif; ?>

    <p class="blue-background__text">
      <?php echo esc_html($text); ?>
    </p>
  </div>
</div>
