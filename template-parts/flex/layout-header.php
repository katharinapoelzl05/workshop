<?php
/**
 * Partial: Header
 * ACF-Feld: navigation (repeater: title, link)
 */

$navigation = get_sub_field('navigation');

if (!is_array($navigation) || empty($navigation)) {
  $navigation = [
    ['title' => 'Workshop', 'link' => ['url' => '#', 'target' => '_self']],
    ['title' => 'About us', 'link' => ['url' => '#', 'target' => '_self']],
    ['title' => 'Contact', 'link' => ['url' => '#', 'target' => '_self']],
  ];
}
?>

<div class="header__inner">
  <nav class="header__nav" aria-label="<?php esc_attr_e('Hauptnavigation', 'projecttheme'); ?>">
    <?php foreach ($navigation as $item): ?>
      <?php
      $title = trim((string) ($item['title'] ?? ''));
      $link = $item['link'] ?? [];
      $url = is_array($link) ? ($link['url'] ?? '') : '';
      $target = is_array($link) ? ($link['target'] ?? '_self') : '_self';

      if (!$title) {
        continue;
      }

      $rel = $target === '_blank' ? 'noopener noreferrer' : '';
      ?>
      <?php if ($url): ?>
        <a class="header__nav-link"
           href="<?php echo esc_url($url); ?>"
           target="<?php echo esc_attr($target); ?>"
           <?php if ($rel): ?>rel="<?php echo esc_attr($rel); ?>"<?php endif; ?>>
          <?php echo esc_html($title); ?>
        </a>
      <?php else: ?>
        <span class="header__nav-link">
          <?php echo esc_html($title); ?>
        </span>
      <?php endif; ?>
    <?php endforeach; ?>
  </nav>
</div>
