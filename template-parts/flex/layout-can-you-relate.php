<?php
/**
 * Partial: Can you relate?
 * ACF-Felder: title (text), body (wysiwyg), image (image ID)
 */

$title = trim((string) get_sub_field('title'));
$body = get_sub_field('body');
$image_id = get_sub_field('image');

if (!$title) {
  $title = 'Can you relate?';
}

if (!$body) {
  $body = '<p>Ever had a creative idea but didn’t know where to start? Or felt like everyone else was more talented, more experienced or simply better than you?</p>'
    . '<p>Maybe you’ve been staring at a blank page, waiting for the perfect idea to appear. Or you’ve stopped yourself from trying something because you were afraid it wouldn’t turn out the way you imagined.</p>'
    . '<p>&nbsp;</p>'
    . '<p>Here’s the thing: creativity isn’t about being perfect or comparing your work to others. It’s about making mistakes, getting a little messy and enjoying the process.</p>'
    . '<p>So forget about getting everything right. Give yourself permission to experiment, make mistakes and create something just for the fun of it. You might surprise yourself!</p>';
}

$image_url = $image_id
  ? wp_get_attachment_image_url($image_id, 'full')
  : get_template_directory_uri() . '/assets/images/can-you-relate-painting.jpg';
$image_alt = $image_id
  ? get_post_meta($image_id, '_wp_attachment_image_alt', true)
  : __('Pinsel beim Bemalen eines Keramikstücks', 'projecttheme');
?>

<div class="can-you-relate__inner">
  <?php if ($image_url): ?>
    <div class="can-you-relate__image-frame">
      <img class="can-you-relate__image"
           src="<?php echo esc_url($image_url); ?>"
           alt="<?php echo esc_attr($image_alt); ?>"
           loading="lazy"
           decoding="async">
    </div>
  <?php endif; ?>

  <div class="can-you-relate__content">
    <h2 class="can-you-relate__title"><?php echo esc_html($title); ?></h2>
    <div class="can-you-relate__body">
      <?php echo wp_kses_post($body); ?>
    </div>
  </div>
</div>
