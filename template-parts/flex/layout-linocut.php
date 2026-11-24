<?php
/**
 * Partial: Linocut
 * ACF-Felder: title (text), description (wysiwyg), image (image ID), cta (link)
 */

$title = trim((string) get_sub_field('title'));
$description = get_sub_field('description');
$image_id = get_sub_field('image');
$cta = get_sub_field('cta');

if (!$title) {
  $title = 'Linocut';
}

if (!$description) {
  $description = '<p>Explore the art of printmaking in this hands-on workshop. Learn to carve your own design into linoleum and create unique prints to take home. No experience needed — just bring your creativity!</p>';
}

$image_url = $image_id
  ? wp_get_attachment_image_url($image_id, 'large')
  : get_template_directory_uri() . '/assets/images/linocut-workshop.jpg';
$image_alt = $image_id
  ? get_post_meta($image_id, '_wp_attachment_image_alt', true)
  : __('Linolschnitt-Workshop beim Drucken', 'projecttheme');

$cta_url = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '#contact_sheet';
$cta_title = is_array($cta) && !empty($cta['title']) ? $cta['title'] : __('Contact us', 'projecttheme');
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>

<div class="linocut__inner">
  <?php if ($image_url): ?>
    <div class="linocut__image-frame">
      <img class="linocut__image"
           src="<?php echo esc_url($image_url); ?>"
           alt="<?php echo esc_attr($image_alt); ?>"
           loading="lazy"
           decoding="async">
    </div>
  <?php endif; ?>

  <div class="linocut__content">
    <div class="linocut__text">
      <h2 class="linocut__title"><?php echo esc_html($title); ?></h2>
      <div class="linocut__description">
        <?php echo wp_kses_post($description); ?>
      </div>
    </div>

    <a class="linocut__cta"
       href="<?php echo esc_url($cta_url); ?>"
       target="<?php echo esc_attr($cta_target); ?>"
       <?php if ($cta_rel): ?>rel="<?php echo esc_attr($cta_rel); ?>"<?php endif; ?>>
      <?php echo esc_html($cta_title); ?>
    </a>
  </div>
</div>
