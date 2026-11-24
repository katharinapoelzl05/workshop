<?php
/**
 * Partial: Pottery
 * ACF-Felder: title (text), description (wysiwyg), image (image ID), cta (link)
 */

$title = trim((string) get_sub_field('title'));
$description = get_sub_field('description');
$image_id = get_sub_field('image');
$cta = get_sub_field('cta');

if (!$title) {
  $title = 'Pottery';
}

if (!$description) {
  $description = '<p>Get your hands dirty and discover the joy of working with clay. Learn basic pottery techniques and create your own handmade ceramic piece. A relaxing experience for beginners and creative minds</p>';
}

$image_url = $image_id
  ? wp_get_attachment_image_url($image_id, 'large')
  : get_template_directory_uri() . '/assets/images/pottery-workshop.jpeg';
$image_alt = $image_id
  ? get_post_meta($image_id, '_wp_attachment_image_alt', true)
  : __('Keramik und Töpferwaren in einer Werkstatt', 'projecttheme');

$cta_url = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '#contact_sheet';
$cta_title = is_array($cta) && !empty($cta['title']) ? $cta['title'] : __('Contact us', 'projecttheme');
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>

<div class="pottery__inner">
  <?php if ($image_url): ?>
    <div class="pottery__image-frame">
      <img class="pottery__image"
           src="<?php echo esc_url($image_url); ?>"
           alt="<?php echo esc_attr($image_alt); ?>"
           loading="lazy"
           decoding="async">
    </div>
  <?php endif; ?>

  <div class="pottery__content">
    <div class="pottery__text">
      <h2 class="pottery__title"><?php echo esc_html($title); ?></h2>
      <div class="pottery__description">
        <?php echo wp_kses_post($description); ?>
      </div>
    </div>

    <a class="pottery__cta"
       href="<?php echo esc_url($cta_url); ?>"
       target="<?php echo esc_attr($cta_target); ?>"
       <?php if ($cta_rel): ?>rel="<?php echo esc_attr($cta_rel); ?>"<?php endif; ?>>
      <?php echo esc_html($cta_title); ?>
    </a>
  </div>
</div>
