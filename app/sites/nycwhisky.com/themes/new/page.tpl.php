<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
</head>


<body class="<?php print $body_classes ?> <?php if ($title == "Create Event") { print "event"; } ?>">
  <div class="content">
    <h2 id="title"><?php print $title ?></h2>  
    <?php if ($messages) { ?><div class="messages"><?php print $messages ?></div><?php } ?>
    <?php print $content ?>
  </div>

</body>
</html>
