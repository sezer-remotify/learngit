<?php

/**
 * Header
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: header.tpl.php, v1.00 2019-10-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client()) {
  Url::redirect(SITEURL . '/');
  exit;
}

if (App::Auth()->is_Freelancer() && !App::Auth()->is_completed) {
  Url::redirect(SITEURL . '/master/profile/complete');
  exit;
}
?>
<!doctype html>
<html lang="<?php echo Core::$language; ?>">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="<?php echo SITEURL; ?>/assets/images/favicon.png" type="image/x-icon">
  <title><?php echo $this->title; ?></title>
  <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
  <link
    href="<?php echo MASTERVIEW . '/cache/' . Cache::cssCache(array('base.css', 'transition.css', 'label.css', 'form.css', 'dropdown.css', 'input.css', 'button.css', 'message.css', 'image.css', 'list.css', 'table.css', 'icon.css', 'card.css', 'editor.css', 'modal.css', 'tooltip.css', 'menu.css', 'progress.css', 'utility.css', 'style.css'), MASTERBASE); ?>"
    rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <link href="<?php echo MASTERVIEW; ?>/css/dashboard.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/blue.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/noman_custom.css?v1.2" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/custom-saq.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/fonts/fontawesome/css/all.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/jquery.js"></script>
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/global.js"></script>
</head>

<body>
  <div id="wrapper" class="padding-0 margin-0">
    <div id="notifyPanel">
      <div class="row align middle spaced">
        <div class="columns">
          <h4>Latest Notifications</h4>
        </div>
        <div class="columns auto"><a class="wojo small icon simple button panelToggle"><i class="icon close"></i></a>
        </div>
      </div>
      <div class="content">
        <div class="wojo small divided list"></div>
      </div>
    </div>
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
          <!-- Right Side Content / End -->
          <div class="right-side">

            <!--  User Notifications -->
            <div class="header-widget hide-on-mobile">

              <!-- Notifications -->
              <div class="header-notifications">

                <!-- Trigger -->
                <div class="header-notifications-trigger">
                  <a href="#"><i class="icon-feather-bell"></i></a>
                </div>

                <!-- Dropdown -->
                <div class="header-notifications-dropdown">

                  <div class="header-notifications-headline">
                    <h4><?=(isset(Lang::$word->ADM_NOTF)) ? Lang::$word->ADM_NOTF : '' ?></h4>
                  </div>

                  <div class="header-notifications-content">
                    <div class="header-notifications-scroll" data-simplebar>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--  User Notifications / End -->

            <!-- User Menu -->
            <div class="header-widget">

              <!-- Messages -->
              <div class="header-notifications user-menu">
                <div class="header-notifications-trigger">
                  <a href="#">
                    <div class="user-avatar status-online"><img
                        src="<?php echo UPLOADURL; ?>/avatars/<?php echo (App::Auth()->avatar) ? App::Auth()->avatar : "blank.svg"; ?>" alt=""></div>
                  </a>
                </div>

                <!-- Dropdown -->
                <div class="header-notifications-dropdown">

                  <!-- User Status -->
                  <div class="user-status">

                    <!-- User Name / Avatar -->
                    <div class="user-details">
                      <div class="user-avatar status-online"><img
                          src="<?php echo UPLOADURL; ?>/avatars/<?php echo (App::Auth()->avatar) ? App::Auth()->avatar : "blank.svg"; ?>" alt="">
                      </div>
                      <div class="user-name">
                        <?php echo ucwords(App::Auth()->name); ?>
                      </div>
                    </div>
                  </div>

                  <ul class="user-menu-small-nav">
                    <li>
                      <a class="item" href="<?php echo Url::url("/master/profile/edit"); ?>"><i class="icon user"></i>
                        <?php echo Lang::$word->ACC_MY_ACCOUNT; ?></a>
                    </li>
                    <li>
                      <a class="item" href="<?php echo Url::url("/master/profile/view/" . App::Auth()->username); ?>"><i class="icon eye"></i>
                        <?php echo Lang::$word->VIEW_AS; ?></a>
                    </li>
                    <li>
                      <a class="item" href="<?php echo Url::url("/master/mypassword"); ?>"><i class="icon lock"></i>
                        <?php echo Lang::$word->ACC_PASS_CHANGE; ?></a>
                      <div class="divider"></div>
                    </li>
                    <li>
                      <a class="item" href="<?php echo Url::url("/master/logout"); ?>"><i class="icon power"></i>
                        <?php echo Lang::$word->LOGOUT; ?></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="clearfix"></div>

    <div class="dashboard-container">
      <div class="dashboard-sidebar">
        <div class="dashboard-sidebar-inner" data-simplebar>
          <div class="dashboard-nav-container">

            <!-- Responsive Navigation Trigger -->
            <a href="#" class="dashboard-responsive-nav-trigger">
              <span class="hamburger hamburger--collapse">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </span>
            </a>
            <!-- Navigation -->
            <div class="dashboard-nav">
              <div class="dashboard-nav-inner">
                <ul data-submenu-title="<?php echo Lang::$word->ADM_ORGMAN; ?>">

                   <?php if (App::Auth()->usertype == 'freelancer') : ?>
                  <li <?php if (in_array("bids", $this->segments)) echo ' '; ?>>
                    <a href="<?php echo  Url::url("/master/projects"); ?>">
                      <i class="icon-material-outline-dns"></i>
                      <span class="title"><?php echo Lang::$word->ADM_PROJECTS; ?></span>
                    </a>
                  </li>
                  <?php endif; ?>
                   <?php if (App::Auth()->usertype == 'freelancer') : ?>
                  <li <?php if (in_array("bids", $this->segments)) echo ' '; ?>>
                    <a href="<?php echo  Url::url("/master/bids"); ?>">
                      <i class="icon-material-outline-add"></i>
                      <span class="title"><?php echo Lang::$word->BIDS; ?></span>
                    </a>
                  </li>
                  <?php endif; ?>
                  <?php if (App::Auth()->usertype == 'client') : ?>
                    <li>
                    <a href="<?php echo  Url::url("/master/projects/new"); ?>">
                      <i class="icon-material-outline-add"></i>
                      <span class="title"><?php echo Lang::$word->ADM_NEWPRJ; ?></span>
                    </a>
                  </li>
                  <li <?php if (in_array("projects", $this->segments)) echo ' class="active"'; ?>>
                    <a href="<?php echo  Url::url("/master/projects"); ?>">
                      <i class="icon-material-outline-dns"></i>
                      <span class="title"><?php echo Lang::$word->ADM_PROJECTS; ?></span>
                    </a>
                  </li>

                  <li
                    <?php if (in_array("master", $this->segments) && !in_array("projects", $this->segments) && !in_array("edit", $this->segments)) echo ' class="active"'; ?>>
                    <a href="<?php echo  Url::url("/"); ?>">
                      <i class="icon-line-awesome-calendar-plus-o"></i>
                      <span class="title"><?php echo Lang::$word->ADM_SCHEDULE; ?></span>
                    </a>
                  </li>
                  <?php endif; ?>
                </ul>
                <ul data-submenu-title="<?php echo Lang::$word->ADM_ACCOUNT; ?>">
                  <li <?php if (in_array("edit", $this->segments)) echo ' class="active"'; ?>>
                    <a class="item" href="<?php echo Url::url("/master/profile/edit"); ?>"><i class="icon user"></i>
                      <?php echo Lang::$word->ACC_MY_ACCOUNT; ?></a>
                  </li>
                  <li>
                    <a class="item" href="<?php echo Url::url("/master/logout"); ?>"><i class="icon power"></i>
                      <?php echo Lang::$word->LOGOUT; ?></a>
                  </li>
                </ul>

              </div>
            </div>
            <!-- Navigation / End -->

          </div>
        </div>
      </div>
      <div class="wojo-grid width-75" style="overflow:hidden;">
        <main>
