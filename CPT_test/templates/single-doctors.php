<?php
/**
 * ОДИНОЧНЫЙ ШАБЛОН
 */
get_header();
?>

<div class="doctor-single" style="max-width: 800px; margin: 0 auto; padding: 20px;">
  <h1><?php the_title(); ?></h1>

  <?php if (has_post_thumbnail()) : ?>
    <div class="doctor-avatar" style="margin: 20px 0;">
      <?php the_post_thumbnail('medium', ['style' => 'width: 100%; height: auto; border-radius: 8px;']); ?>
    </div>
  <?php endif; ?>

  <div class="doctor-meta" style="margin: 20px 0; line-height: 1.6;">
    <?php
    $experience = get_post_meta(get_the_ID(), '_doctor_experience', true);
    $price      = get_post_meta(get_the_ID(), '_doctor_price', true);
    $rating     = get_post_meta(get_the_ID(), '_doctor_rating', true);
    ?>
    <?php if ($experience !== ''): ?>
      <p><strong>Стаж:</strong> <?php echo esc_html($experience); ?> лет</p>
    <?php endif; ?>
    <?php if ($price !== ''): ?>
      <p><strong>Цена от:</strong> <?php echo esc_html($price); ?> ₽</p>
    <?php endif; ?>
    <?php if ($rating !== ''): ?>
      <p><strong>Рейтинг:</strong> <?php echo esc_html($rating); ?>/5</p>
    <?php endif; ?>
  </div>

  <div class="doctor-taxonomies" style="margin: 20px 0;">
    <?php
    $specializations = get_the_term_list(get_the_ID(), 'specialization', '<strong>Специализации:</strong> ', ', ', '');
    $cities          = get_the_term_list(get_the_ID(), 'city', '<strong>Город:</strong> ', ', ', '');
    ?>
    <?php if ($specializations): ?>
      <p><?php echo wp_kses_post($specializations); ?></p>
    <?php endif; ?>
    <?php if ($cities): ?>
      <p><?php echo wp_kses_post($cities); ?></p>
    <?php endif; ?>
  </div>

  <div class="doctor-content" style="margin-top: 20px;">
    <?php if (has_excerpt()): ?>
      <p><strong>Кратко:</strong> <?php the_excerpt(); ?></p>
    <?php endif; ?>
    <?php the_content(); ?>
  </div>
</div>

<?php get_footer(); ?>