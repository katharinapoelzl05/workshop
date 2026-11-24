<?php
/**
 * Partial: Header with logo
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

$home_index = null;
foreach ($navigation as $index => $item) {
  if (strcasecmp(trim((string) ($item['title'] ?? '')), 'Home') === 0) {
    $home_index = $index;
    break;
  }
}

if ($home_index === null) {
  array_unshift($navigation, [
    'title' => 'Home',
    'link' => ['url' => home_url('/'), 'target' => '_self'],
  ]);
} else {
  $home_item = $navigation[$home_index];
  $home_item['title'] = 'Home';
  $home_item['link'] = is_array($home_item['link'] ?? null) ? $home_item['link'] : [];
  if (empty($home_item['link']['url'])) {
    $home_item['link']['url'] = home_url('/');
  }

  unset($navigation[$home_index]);
  array_unshift($navigation, $home_item);
}
?>

<div class="header-with-logo__inner">
  <img class="header-with-logo__logo"
       src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/header-logo-mark.png'); ?>"
       alt="<?php esc_attr_e('Logo', 'projecttheme'); ?>"
       width="58"
       height="48">

  <nav class="header-with-logo__nav" aria-label="<?php esc_attr_e('Hauptnavigation', 'projecttheme'); ?>">
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
        <a class="header-with-logo__link"
           href="<?php echo esc_url($url); ?>"
           target="<?php echo esc_attr($target); ?>"
           <?php if ($rel): ?>rel="<?php echo esc_attr($rel); ?>"<?php endif; ?>>
          <?php echo esc_html($title); ?>
        </a>
      <?php else: ?>
        <span class="header-with-logo__link">
          <?php echo esc_html($title); ?>
        </span>
      <?php endif; ?>
    <?php endforeach; ?>
  </nav>
</div>
