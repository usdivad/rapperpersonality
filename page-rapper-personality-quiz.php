<?php get_header(); ?>
<div id="main-content">
  <div id="left-column">
    <article class="post">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1 class="page-title clearfix"><?php the_title(); ?></h1>
        <?php the_content(__('Read more ...'));?>
      <?php endwhile; else: ?>
      <?php endif; ?>
    </article>
  </div>

  <div id="sidebar">
    <aside>
      <?php include(TEMPLATEPATH."/r-ad-top.php");?>
      <?php include(TEMPLATEPATH."/r-3-social-links.php");?>
      <?php include(TEMPLATEPATH."/r-latest-news.php");?>
      <?php include(TEMPLATEPATH."/above-fold-ad.php");?>
      <?php include(TEMPLATEPATH."/r-ad.php");?>
    </aside>
  </div>
</div>
<?php get_footer(); ?>
