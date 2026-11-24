<?php
/**
 * Partial: Aquarell
 * ACF-Felder: title (text), description (wysiwyg), image (image ID), cta (link)
 */

$title = trim((string) get_sub_field('title'));
$description = get_sub_field('description');
$image_id = get_sub_field('image');
$cta = get_sub_field('cta');

if (!$title) {
  $title = 'Aquarell';
}

if (!$description) {
  $description = '<p>Explore the beauty of watercolour painting. Experiment with colours, learn simple painting techniques and create your own artwork in a relaxed and inspiring atmosphere.</p>';
}

$image_url = $image_id
  ? wp_get_attachment_image_url($image_id, 'large')
  : get_template_directory_uri() . '/assets/images/aquarell-workshop.jpeg';
$image_alt = $image_id
  ? get_post_meta($image_id, '_wp_attachment_image_alt', true)
  : __('Aquarellfarben, Pinsel und Malutensilien auf einem Tisch', 'projecttheme');

$cta_url = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '#contact_sheet';
$cta_title = is_array($cta) && !empty($cta['title']) ? $cta['title'] : __('Contact us', 'projecttheme');
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>

<div class="aquarell__inner">
  <?php if ($image_url): ?>
    <div class="aquarell__image-frame">
      <img class="aquarell__image"
           src="<?php echo esc_url($image_url); ?>"
           alt="<?php echo esc_attr($image_alt); ?>"
           loading="lazy"
           decoding="async">
    </div>
  <?php endif; ?>

  <div class="aquarell__content">
    <div class="aquarell__text">
      <h2 class="aquarell__title"><?php echo esc_html($title); ?></h2>
      <div class="aquarell__description">
        <?php echo wp_kses_post($description); ?>
      </div>
    </div>

    <a class="aquarell__cta"
       href="<?php echo esc_url($cta_url); ?>"
       target="<?php echo esc_attr($cta_target); ?>"
       <?php if ($cta_rel): ?>rel="<?php echo esc_attr($cta_rel); ?>"<?php endif; ?>>
      <?php echo esc_html($cta_title); ?>
    </a>
  </div>
</div>
