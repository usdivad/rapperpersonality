<?php get_header(); ?>
<div id="fb-root"></div>
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

<style>
  label {
    font-weight: normal;
    margin-left: 4px;
    margin-bottom: 4px;
  }

  label:hover {
    background-color: #EBEBEB;
  }

  input:checked {
    background-color: red;
  }
</style>

<script>
//fb
  window.fbAsyncInit = function() {
          FB.init({
            appId      : 1375271719406903,
            status     : true,
            xfbml      : true
          });
        };

        /*(function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/all.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));*/

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1375271719406903";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      
//twitter
  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

</script>




<script type="text/javascript">
//put all.js here, paste into wordpress, Cmd+Z
</script>