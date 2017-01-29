<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-app="myApp" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php print $head_title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="cleartype" content="on">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/layout.css">
  <link rel="stylesheet" href="/css/responsive.css">
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
  <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
  <link rel="icon" href="/images/favicon.png" type="image/png">
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
</head>


<body>

  <div class="container" role="main">
    <div class="c1" id="social">
      <div class="networks">
        <span><a href="http://twitter.com/nycwhisky" class="twitter">
          Follow @NYCWhisky on Twitter
        </a></span>
        <span><a href="https://instagram.com/nycwhisky/" class="instagram">
          Follow @NYCWhisky on Instagram
        </a></span>
        <span><a href="https://www.facebook.com/nycwhisky" class="facebook">
          Like NYCWhisky on Facebook
        </a></span>
      </div>
      <div class="form">
        <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=NYCwhiskyTastings', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
          <input type="hidden" value="NYCwhiskyTastings" name="uri">
          <input type="hidden" name="loc" value="en_US">
          <input class="subscribe" type="submit" value="Subscribe">
          <input class="email" type="email" name="email" placeholder="SUBSCRIBE" />
        </form>
      </div>
    </div>

    <div class="c2" id="search">
      <!-- TODO(Thomas): Search -->
    </div>

    <div class="c3" id="header">
      <h1><a href="http://nycwhisky.com">NYCWhisky</a></h1>

      <div id="carousel" ng-controller="FeaturedCtrl">
        <div class="carousel-nav"></div>
        <div class="carousel-content">
          



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

        </div>
        <div class="carousel-nav"></div>
      </div>

    </div>

    <div class="c4" id="events">
      <div ng-view autoscroll>

        <?php if ($title): print '<h2'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h2>'; endif; ?>
        <?php if ($tabs): print '<div class="tabs">'.$tabs.'</div>'; endif; ?>
        <?php if ($help) { ?><div class="help"><?php print $help ?></div><?php } ?>
        <?php if ($messages) { ?><div class="messages"><?php print $messages ?></div><?php } ?>

        <?php print $content ?>



      </div>
    </div>

    <div class="c7" id="footer">
      <span id="footer-navigation">
        <a href="http://nycwhisky.com/#/events">EVENTS</a> | <a href="/contact">CONTACT US</a> | <a href="#/about">ABOUT US</a> | <a href="#/login">LOG IN</a>
      </span>
      <span id="copyright">&copy; COPYRIGHT NYCWHISKY</span>
      <!--<div id="footer-banner">Your advert here, 728px x 90px<br />Optionally provide smaller version for mobile.</div>-->
    </div>
  </div>

  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
  <!--<script src="bower_components/angular/angular.js"></script>-->
  <script src="bower_components/angular-route/angular-route.js"></script>
  <script src="bower_components/angular-sanitize/angular-sanitize.js"></script>
  <script src="bower_components/angular-addtocalendar/addtocalendar.min.js"></script>
  <script src="bower_components/angular-bootstrap/ui-bootstrap.min.js"></script>
  <script src="bower_components/downloadjs/download.min.js"></script>
  <script src="bower_components/html5-boilerplate/js/vendor/modernizr-2.6.2.min.js"></script>
  <script src="app.js"></script>
  <script src="about/about.js"></script>
  <script src="add/add.js"></script>
  <script src="events/events.js"></script>
  <script src="featured/featured.js"></script>
  <script src="instagram/instagram.js"></script>
  <script src="login/login.js"></script>
  <!-- TODO: Remove the version & interpolate stuff -->
  <script src="components/version/version.js"></script>
  <script src="components/version/version-directive.js"></script>
  <script src="components/version/interpolate-filter.js"></script>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-640716-8', 'auto');
    ga('send', 'pageview');
  </script>

<?php print $closure ?>
</body>
</html>