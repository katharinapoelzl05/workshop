<?php
/**
 * Partial: Hero Basic / Titelbild
 * ACF-Felder: title (textarea), background_image (image)
 */

$title  = trim((string) get_sub_field('title'));
$img_id = get_sub_field('background_image');

if (!$title) {
  $title = "Discover your next passion.\nJoin our community.";
}

$image_url = $img_id
  ? wp_get_attachment_image_url($img_id, 'full')
  : get_template_directory_uri() . '/assets/images/hero-basic-titelbild.png';

$image_alt = $img_id
  ? get_post_meta($img_id, '_wp_attachment_image_alt', true)
  : '';
?>

<div class="hero-basic-titelbild__inner">
  <?php if ($image_url): ?>
    <img class="hero-basic-titelbild__image"
         src="<?php echo esc_url($image_url); ?>"
         alt="<?php echo esc_attr($image_alt); ?>"
         loading="eager"
         fetchpriority="high">
  <?php endif; ?>

  <div class="hero-basic-titelbild__content">
    <h1 class="hero-basic-titelbild__title">
      <?php echo nl2br(esc_html($title)); ?>
    </h1>
  </div>
</div>
