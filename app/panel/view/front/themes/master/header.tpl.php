<?php

if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<!doctype html>
<html lang="<?php echo Core::$language; ?>">

<head>
  <meta charset="utf-8">
  <title><?php echo $this->title; ?></title>
  <link rel="icon" href="<?php echo SITEURL; ?>/assets/images/favicon.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="dcterms.rights" content="<?php echo $this->core->company; ?> &copy; All Rights Reserved">
  <meta name="robots" content="index">
  <meta name="robots" content="follow">
  <meta name="revisit-after" content="1 day">
  <link
    href="<?php echo MASTERVIEW . '/cache/' . Cache::cssCache(array('base.css', 'transition.css', 'label.css', 'form.css', 'dropdown.css', 'input.css', 'button.css', 'message.css', 'image.css', 'list.css', 'table.css', 'icon.css', 'card.css', 'editor.css', 'modal.css', 'tooltip.css', 'menu.css', 'progress.css', 'utility.css', 'style.css'), MASTERBASE); ?>"
    rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="<?php echo MASTERVIEW; ?>/css/dashboard.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/blue.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/noman_custom.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/custom-saq.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/jquery.js"></script>
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/global.js"></script>
  <script src="https://kit.fontawesome.com/a632dba639.js" crossorigin="anonymous"></script>
</head>

<body class="<?php echo $this->pageclass; ?>">
    <div id="wrapper" class="padding-0 margin-0">
    <?php if ($this->core->eucookie and (empty($_COOKIE['FMEU']))) : ?>
    <div id="cookie-overlay">
      <div class="wojo notice alert">
        <div class="content"><span><?php echo Lang::$word->META_COOKIE; ?></span>
          <p class="sticky-note"><?php echo Lang::$word->META_COOKIE1; ?><<br><?php echo Lang::$word->META_COOKIE2; ?></p>
          <a class="wojo small white button" id="c_yes">Continue</a> <a class="wojo small simple button" id="c_no"
            href="https://google.com">Cancel</a>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <header id="header-container" class="fullwidth dashboard-header position-inherit">
      <!-- Header -->
      <div id="header">
        <div class="container">

          <!-- Left Side Content -->
          <div class="left-side">

            <!-- Logo -->
            <div id="logo">
              <a href="<?php echo Url::url("/admin"); ?>">
                <img src='<?php echo MASTERVIEW . "/images/remotify-logo.png" ?>' alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="clearfix"></div>

    <div class="dashboard-container">
      <div class="wojo-grid width-75">
        <main>