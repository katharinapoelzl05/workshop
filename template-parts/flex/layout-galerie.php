<?php
/**
 * Galerie (Grid)
 * Felder: images (gallery IDs), show_captions (bool)
 */
$ids           = get_sub_field('images') ?: [];
$show_captions = (bool) get_sub_field('show_captions');
?>
<?php if (!empty($ids)): ?>
<div class="galerie__grid">
  <?php foreach ($ids as $img_id): 
    $caption = wp_get_attachment_caption($img_id);
  ?>
  <figure class="galerie__item">
    <?php echo wp_get_attachment_image($img_id, 'medium', false, ['class' => 'galerie__image', 'loading' => 'lazy', 'decoding' => 'async']); ?>
    <?php if ($show_captions && $caption): ?>
      <figcaption class="galerie__caption"><?php echo esc_html($caption); ?></figcaption>
    <?php endif; ?>
  </figure>
  <?php endforeach; ?>
</div>
<?php endif; ?>
