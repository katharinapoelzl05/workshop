<?php
/**
 * Partial: images
 * ACF-Feld: images (gallery)
 */

$image_ids = get_sub_field('images');

if (!is_array($image_ids) || empty($image_ids)) {
  $image_ids = [];
  for ($index = 1; $index <= 4; $index++) {
    $image_ids[] = get_template_directory_uri() . '/assets/images/images-pic-' . $index . '.png';
  }
}
?>

<div class="images__grid">
  <?php foreach (array_slice($image_ids, 0, 4) as $image): ?>
    <figure class="images__item">
      <?php if (is_numeric($image)): ?>
        <?php echo wp_get_attachment_image(
          (int) $image,
          'large',
          false,
          [
            'loading' => 'lazy',
            'decoding' => 'async',
          ]
        ); ?>
      <?php else: ?>
        <img src="<?php echo esc_url($image); ?>"
             alt=""
             loading="lazy"
             decoding="async">
      <?php endif; ?>
    </figure>
  <?php endforeach; ?>
</div>
