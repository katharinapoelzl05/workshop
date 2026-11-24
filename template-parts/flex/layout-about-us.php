<?php
/**
 * Partial: About us
 * ACF-Felder: headline (text), body (wysiwyg), image (image ID)
 */

$headline = trim((string) get_sub_field('headline'));
$body = get_sub_field('body');
$image_id = get_sub_field('image');

if (!$headline) {
  $headline = 'About us';
}

if (!$body) {
  $body = '<p>We are a young and creative team with a passion for art, handmade things and bringing people together.</p>'
    . '<p>Our idea is simple: create a place where everyone can explore their creativity, try something new and enjoy making things with their own hands.</p>'
    . '<p>We believe that creativity has no limits and that you don’t need to be an expert to create something beautiful. Whether you’re picking up a paintbrush for the first time, shaping your first piece of pottery or discovering a new craft, there’s always room to experiment, learn and have fun.</p>'
    . '<p>Our workshops are all about good vibes, new experiences and sharing creative moments.</p>'
    . '<p>We want everyone to feel welcome, get inspired and leave with something they’ve made themselves – and maybe a new hobby, too!</p>';
}

$image_url = $image_id
  ? wp_get_attachment_image_url($image_id, 'full')
  : get_template_directory_uri() . '/assets/images/about-us-pottery.jpg';
$image_alt = $image_id
  ? get_post_meta($image_id, '_wp_attachment_image_alt', true)
  : __('Workshop-Teilnehmerin beim Töpfern', 'projecttheme');
?>

<div class="about-us__inner">
  <div class="about-us__content">
    <h2 class="about-us__title"><?php echo esc_html($headline); ?></h2>
    <div class="about-us__body">
      <?php echo wp_kses_post($body); ?>
    </div>
  </div>

  <?php if ($image_url): ?>
    <div class="about-us__image-frame">
      <img class="about-us__image"
           src="<?php echo esc_url($image_url); ?>"
           alt="<?php echo esc_attr($image_alt); ?>"
           loading="lazy"
           decoding="async">
    </div>
  <?php endif; ?>
</div>
