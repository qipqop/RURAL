<?php
/**
 * АРХИВ "Доктор"
 */
get_header();
?>

<div class="doctors-archive" style="max-width: 1200px; margin: 0 auto; padding: 20px;">

  <h1 style="text-align: center; margin-bottom: 30px;">Наши врачи</h1>

  <!-- Фильтрации -->
  <form method="get" style="margin-bottom: 30px; display: flex; gap: 12px; flex-wrap: wrap; align-items: end;">
    <?php
    // Копирование GET кроме фильтров
    foreach ($_GET as $key => $value) {
        if (!in_array($key, ['specialization', 'city', 'sort'])) {
            echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
        }
    }
    ?>

    <select name="specialization" style="padding: 6px; font-size: 14px;">
      <option value="">Любая специализация</option>
      <?php
      $specializations = get_terms(['taxonomy' => 'specialization', 'hide_empty' => false]);
      foreach ($specializations as $term):
        $selected = (isset($_GET['specialization']) && $_GET['specialization'] === $term->slug) ? ' selected' : '';
        echo '<option value="' . esc_attr($term->slug) . '"' . $selected . '>' . esc_html($term->name) . '</option>';
      endforeach;
      ?>
    </select>

    <select name="city" style="padding: 6px; font-size: 14px;">
      <option value="">Любой город</option>
      <?php
      $cities = get_terms(['taxonomy' => 'city', 'hide_empty' => false]);
      foreach ($cities as $term):
        $selected = (isset($_GET['city']) && $_GET['city'] === $term->slug) ? ' selected' : '';
        echo '<option value="' . esc_attr($term->slug) . '"' . $selected . '>' . esc_html($term->name) . '</option>';
      endforeach;
      ?>
    </select>

    <select name="sort" style="padding: 6px; font-size: 14px;">
      <option value="rating_desc"<?php selected($_GET['sort'] ?? '', 'rating_desc'); ?>>По рейтингу ↓</option>
      <option value="price_asc"<?php selected($_GET['sort'] ?? '', 'price_asc'); ?>>По цене ↑</option>
      <option value="exp_desc"<?php selected($_GET['sort'] ?? '', 'exp_desc'); ?>>По стажу ↓</option>
    </select>

    <button type="submit" style="padding: 6px 12px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">Применить</button>
  </form>

  <!-- Список докторов -->
  <?php if (have_posts()): ?>
    <div class="doctors-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; margin-bottom: 30px;">
      <?php while (have_posts()): the_post(); ?>
        <div class="doctor-card" style="border: 1px solid #eee; border-radius: 8px; padding: 16px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
          <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
            <?php if (has_post_thumbnail()): ?>
              <div style="margin-bottom: 12px;">
                <?php the_post_thumbnail('thumbnail', ['style' => 'width: 100%; height: auto; border-radius: 6px;']); ?>
              </div>
            <?php endif; ?>
            <h3 style="margin: 0 0 10px; font-size: 1.2em;"><?php the_title(); ?></h3>
          </a>

          <?php
          $specs = wp_get_post_terms(get_the_ID(), 'specialization', ['fields' => 'names']);
          if (!empty($specs)):
            echo '<p style="margin: 8px 0; color: #555; font-size: 0.95em;">' . esc_html(implode(', ', array_slice($specs, 0, 2))) . '</p>';
          endif;
          ?>

          <?php
          $exp   = get_post_meta(get_the_ID(), '_doctor_experience', true);
          $price = get_post_meta(get_the_ID(), '_doctor_price', true);
          $rate  = get_post_meta(get_the_ID(), '_doctor_rating', true);
          ?>
          <?php if ($exp !== ''): ?><p style="margin: 6px 0;">Стаж: <?php echo esc_html($exp); ?> лет</p><?php endif; ?>
          <?php if ($price !== ''): ?><p style="margin: 6px 0;">Цена от: <?php echo esc_html($price); ?> ₽</p><?php endif; ?>
          <?php if ($rate !== ''): ?><p style="margin: 6px 0;">Рейтинг: <?php echo esc_html($rate); ?>/5</p><?php endif; ?>

          <a href="<?php the_permalink(); ?>" style="display: inline-block; margin-top: 12px; color: #3498db; text-decoration: none; font-weight: bold;">Подробнее →</a>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- Пагинация -->
    <div class="pagination" style="text-align: center;">
      <?php echo paginate_links([
        'type'      => 'list',
        'prev_text' => '&laquo; Назад',
        'next_text' => 'Вперёд &raquo;'
      ]); ?>
    </div>

  <?php else: ?>
    <p>Нет врачей, соответствующих выбранным критериям.</p>
  <?php endif; ?>

</div>

<?php get_footer(); ?>