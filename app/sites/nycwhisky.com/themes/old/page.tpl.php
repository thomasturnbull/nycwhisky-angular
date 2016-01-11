<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
</head>


<body>

  <div id="utilities">
  <?php print $search_box ?>
  <?php if (isset($primary_links)) : ?>
  <?php print '<div id="plinks">'; ?>
          <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
          <?php print '</div>'; ?>
        <?php endif; ?>
  </div>
  


<div id="page">

  <div id="header">
<?php if ($site_name) : ?>
            <h1 class="sitetitle">
	      <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>">
	        <?php print $site_name ?>
	      </a>
	    </h1>
	  <?php endif; ?>
 <?php if ($site_slogan){?>
<h2><?php print $site_slogan ?></h2>
<?php } ?>
<?php if ($header) { ?>
  <div id="header-block"><?php print $header ?></div>
<?php } ?>

  </div>

 
         <?php if (($secondary_links)) : ?>
      <?php print '<div id="submenu">' ?>
          <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')) ?>
          <?php print '</div><div class="stopfloat"></div>' ?>
        <?php endif; ?>

       
   

  <div class="content">
  
  
   <div id="primary" style=<?php print '"width:'.new_width( $right, $left).'px;">' ?>
               <div class="singlepage">

         <?php if ($title): print '<h2'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h2>'; endif; ?>
          <?php if ($tabs): print '<div class="tabs">'.$tabs.'</div>'; endif; ?>
        <?php if ($help) { ?><div class="help"><?php print $help ?></div><?php } ?>
          <?php if ($messages) { ?><div class="messages"><?php print $messages ?></div><?php } ?>
<div class="drdot">
<hr />
</div>
         
          
 <?php print $content ?>
      </div>
      <hr />
    </div>

    <hr />
   
   
   
        	<!-- left -->
        <?php if ($left) { ?>
          <div class="lsidebar">

          
            <?php print $left ?>
            
          </div><!-- end left -->
        <?php } ?>

   	<!-- right -->
        <?php if ($right) { ?>
          <div class="rsidebar">
 
            <?php print $right ?>
         
          </div><!-- end right -->
        <?php } ?>



 <div class="clear"></div>

  </div>
  <br class="clear" />
</div>
<!-- Close Page -->
<hr />
<div id="footer">
<?php print $footer ?>
<?php print $footer_message ?>
</div>
<?php print $closure ?>
</body>
</html>