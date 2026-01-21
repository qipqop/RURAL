<?php get_header(); ?>
<div class="doctor-single">
  <h1><?php the_title(); ?></h1>
  <?php if (has_post_thumbnail()) : ?>
    <div class="doctor-avatar"><?php the_post_thumbnail('medium'); ?></div>
  <?php endif; ?>
  
  <div class="doctor-meta">
    <p><strong>Стаж:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_doctor_experience', true)); ?> лет</p>
    <p><strong>Цена от:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_doctor_price', true)); ?> ₽</p>
    <p><strong>Рейтинг:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_doctor_rating', true)); ?>/5</p>
  </div>

  <div class="doctor-taxonomies">
    <p><strong>Специализации:</strong> <?php echo get_the_term_list(get_the_ID(), 'specialization', '', ', ', ''); ?></p>
    <p><strong>Город:</strong> <?php echo get_the_term_list(get_the_ID(), 'city', '', ', ', ''); ?></p>
  </div>

  <div class="doctor-content">
    <?php the_content(); ?>
  </div>
</div>
<?php get_footer(); ?>