<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

  <head>
    <meta name="apple-mobile-web-app-capable" content="yes" /> 
    <title><?php print $head_title ?></title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />
    <?php print $head ?>
    <?php print $styles ?>
    <?php print $scripts ?>
  </head>
  <body>
    <div id="topbar">
    
      <div id="leftnav"><?php if (!$is_front): ?><a href="<?php print base_path(); ?>"><img alt="home" src="<?php print  base_path() . path_to_theme() ?>/images/home.png" /></a><?php endif; ?>
      </div>
      
      <div id="title"><?php print $site_name; ?></div>
      
	<?php if(theme_get_setting('iwebkit_menu_type') == 'popup'): ?>
      <div id="rightnav"><a class="noeffect" onclick="iWebkit.popup('nav')"><img alt="nav" src="<?php print base_path().path_to_theme() ?>/images/nav.png" /></a>
	<?php endif; ?>
      </div>
	  </div>

<?php
global $theme_path;

if(theme_get_setting('iwebkit_menu_type') == 'popup') {
  if(!empty($primary_links)) {
    $out = '<div id="nav" class="popup">';
    $out .= '<div id="frame" class="confirm_screen">';
    $out .= '<span>'.check_plain('Navigation').'</span>';
    
    foreach($primary_links as $link_name => $link) {
	    $out .= l('<span class="gray">' . check_plain($link['title']) . '</span>', check_url($link['href']), array('html' => TRUE));
    }
    
    $out .= '<a class="noeffect" onclick="iWebkit.closepopup(event)">';
    $out .= '<span class="black">'.t('Cancel').'</span>';
    $out .= '</a>';
    $out .= '</div>';
    $out .= '</div>';
    echo $out;
   }
} elseif(theme_get_setting('iwebkit_menu_type') == t('normal-every')) {
	// Display the primary links
   	if(!empty($primary_links)) {
		
	  $out = '<ul class="pageitem" title="' . ($title ? check_plain($title) : $site_name) . '" selected="true"><li class="textbox"><p>'.t('Menu').'</p></li>';
		
	  foreach($primary_links as $link_name => $link) {
	    $out .= '<li class="menu"><a href="' . check_url($link['href']) . '"><img alt="list" src="/'.$theme_path.'/thumbs/contacts.png" /><span class="name">' . check_plain($link['title']) . '</span><span class="comment">'.check_plain($link['attributes']['title']).'</span><span class="arrow"></span></a></li>';
	  }
	  $out .= '</ul>';
	  echo $out;
	}
  }	elseif(theme_get_setting('iwebkit_menu_type') == t('normal-front') && $is_front) {
  	// Display the primary links
     if(!empty($primary_links)) {
  		    $out = '<ul class="pageitem" title="' . ($title ? check_plain($title) : check_plain($site_name)) . '" selected="true">
		<li class="textbox"><p>'.t('Menu').'
  		</li>';

  	  foreach($primary_links as $link_name => $link) {
		    $out .= '<li class="menu">'.l('<img alt="list" src="'.$theme_path.'/thumbs/contacts.png" /><span class="name">' . check_url($link['title'])  . '</span><span class="comment">'.check_plain($link['attributes']['title']).'</span><span class="arrow"></span>', check_url($link['href']), array('attributes' => array(),'html' => 'true')).'</li>';
  		}
  		$out .= '</ul>';
  		echo $out;
  	}
    }
?>
	
    <div id="content">
      
      <div id="block-top">
        <?php if ($block_top): ?>
        <?php print $block_top; ?>
        <?php endif; ?>
      </div><!-- /block-top -->
      <div id="block-middle">
        <?php if ($block_middle): ?>
        <?php print $block_middle; ?>
        <?php endif; ?>
      </div><!-- /block-middle -->
      <div id="block-lower">
        <?php if ($block_lower): ?>
        <?php print $block_lower; ?>
        <?php endif; ?>
      </div><!-- /block-lower -->

      <span class="graytitle">
        <?php if($title): ?>
        <?php print $title ?>
        <?php endif; ?>
      </span>
      <?php if($content): ?>
        <?php print $content; ?>
      <?php endif; ?><!--End of content -->

      <div id="footer-top">
        <?php if ($footer_top): ?>
        <?php print $footer_top; ?>
        <?php endif; ?>
      </div><!-- /footer-top -->

      <div id="footer-middle">
        <?php if ($footer_middle): ?>
        <?php print $footer_middle; ?>
        <?php endif; ?>
      </div><!-- /footer-middle -->

      <div id="footer-bottom">
        <?php if ($footer_bottom): ?>
        <?php print $footer_bottom; ?>
        <?php endif; ?>
      </div><!-- /footer-bottom -->

   </div>

    <div id="footer">
      <?php print $footer_message; ?>
    </div>
  </body>
  <?php print $closure ?>
</html>
