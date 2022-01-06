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

if (!App::Auth()->is_Admin()) {
  Url::redirect(SITEURL . '/');
  exit;
}
?>
<!doctype html>
<html lang="<?php echo Core::$language; ?>">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="<?php echo SITEURL; ?>/assets/images/favicon.png" type="image/x-icon">
  <title><?php echo $this->title; ?></title>
  <link href="<?php echo ADMINVIEW . '/cache/' . Cache::cssCache(array('base.css', 'icons.css', 'transition.css', 'label.css', 'form.css', 'dropdown.css', 'input.css', 'button.css', 'message.css', 'image.css', 'list.css', 'table.css', 'icon.css', 'card.css', 'editor.css', 'modal.css', 'tooltip.css', 'menu.css', 'progress.css', 'utility.css', 'style.css'), ADMINBASE); ?>" rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="<?php echo MASTERVIEW; ?>/css/dashboard.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/noman_custom.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/jquery.js"></script>
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/global.js"></script>
  <style>
      .close_button{
        position:fixed;
        top:580px;
        left:5px;
        display:block;
        padding:8px;
        padding-bottom:12px;
        border-radius:5px;
        background:var(--primary-color);
        border: thin solid var(--primary-color);
        text-decoration: none!important;
        color:#fafafa!important;
        transition: background 0.5s, transform 0.5s;
      }
      .close_button:hover{
        background:#fafafa;
        border: thin solid #dfdfdf;
        color:var(--primary-color)!important;
        transition: background 0.5s;
      }
      .navbar{
        overflow:unset!important;
      }
  </style>
</head>

<body>
  <div style="display:none">
    <?php
    $included_files = get_included_files();
    echo '<pre>';
    foreach ($included_files as $filename) {
        echo "$filename\n";
    }
    echo '</pre>';
    ?>
  </div>
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
  <header>
    <div class="wojo-grid">
      <div class="row horizontal small gutters align middle">
        <div class="columns">
          <a href="<?php echo Url::url("/admin"); ?>" class="logo">
            <?php echo (App::Core()->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="' . $this->core->company . '">' : $this->core->company; ?>
          </a>
        </div>
        <div class="columns auto">
          <a class="wojo icon simple circular button panelToggle" id="panelToggle"><span class="status negative"></span><i class="icon white bell"></i></a>
        </div>
        <div class="columns auto">
          <a data-dropdown="#dropdown-uMenu" class="wojo right icon white text" id="uName"><span><?php echo App::Auth()->name; ?></span>
            <div class="wojo primary inverted initials big label"><?php echo Utility::getInitials(App::Auth()->name); ?></div>
          </a>
          <div class="wojo small dropdown top-right" id="dropdown-uMenu">
            <div class="wojo small circular center image">
              <img src="<?php echo UPLOADURL; ?>/avatars/<?php echo (App::Auth()->avatar) ? App::Auth()->avatar : "blank.svg"; ?>" alt="">
            </div>
            <h5 class="wojo small dimmed text center aligned"><?php echo App::Auth()->name; ?></h5>
            <a class="item" href="<?php echo Url::url("/admin/myaccount"); ?>"><i class="icon user"></i>
              <?php echo Lang::$word->ACC_MY_ACCOUNT; ?></a>
            <a class="item" href="<?php echo Url::url("/admin/mypassword"); ?>"><i class="icon lock"></i>
              <?php echo Lang::$word->ACC_PASS_CHANGE; ?></a>
            <a class="item" href="<?php echo Url::url("/admin/myactivity"); ?>"><i class="icon timeline"></i>
              <?php echo Lang::$word->ADM_ACTIVITY; ?></a>
            <?php if (App::Auth()->usertype == "owner") : ?>
              <a class="item" href="http://fkb.wojoscripts.com" target="_blank"><i class="icon chat"></i>
                <?php echo Lang::$word->ADM_HELP; ?></a>
            <?php endif; ?>
            <div class="divider"></div>
            <a class="item" href="<?php echo Url::url("/admin/logout"); ?>"><i class="icon power"></i>
              <?php echo Lang::$word->LOGOUT; ?></a>
          </div>
        </div>
        <?php if (App::Auth()->usertype == "owner") : ?>
          <div class="columns auto">
            <a data-dropdown="#dropdown-aMenu" class="wojo icon simple transparent button">
              <i class="icon cogs"></i>
            </a>
            <div class="wojo small dropdown top-right" id="dropdown-aMenu">
              <a class="item" href="<?php echo Url::url("/admin/configuration"); ?>"><i class="icon cogs"></i>
                <?php echo Lang::$word->ADM_CONFIG; ?></a>
              <?php if (Auth::checkAcl("owner")) : ?>
                <a class="item" href="<?php echo Url::url("/admin/permissions"); ?>"><i class="icon lock"></i>
                  <?php echo Lang::$word->ACC_ROLE; ?></a>
              <?php endif; ?>
              <a class="item" href="<?php echo Url::url("/admin/language"); ?>"><i class="icon flag"></i>
                <?php echo Lang::$word->LMG_TITLE; ?></a>
              <a class="item" href="<?php echo Url::url("/admin/templates"); ?>"><i class="icon email"></i>
                <?php echo Lang::$word->EMT_TITLE; ?></a>
              <?php if (Auth::checkAcl("owner")) : ?>
                <a class="item" href="<?php echo Url::url("/admin/system"); ?>"><i class="icon laptop"></i>
                  <?php echo Lang::$word->SYS_TITLE; ?></a>
                <a class="item" href="<?php echo Url::url("/admin/gateways"); ?>"><i class="icon credit card"></i>
                  <?php echo Lang::$word->ADM_PAYMENTS; ?></a>
                <a class="item" href="<?php echo Url::url("/admin/reports"); ?>"><i class="icon line chart"></i>
                  <?php echo Lang::$word->ADM_REPORTS; ?></a>
                <div class="divider"></div>
                <a class="item" href="<?php echo Url::url("/admin/trash"); ?>"><i class="icon trash"></i>
                  <?php echo Lang::$word->TRASH; ?></a>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="columns auto hide-all" id="mobileToggle">
          <a class="wojo simple icon button"><i class="icon white reorder"></i></a>
        </div>
      </div>
    </div>
  </header>
  <div class="navbar">
    <div class="wojo-grid">
      <nav class="menu">
        <ul class="wojo menu">
          <!-- <li<?php if (count($this->segments) == 1) echo ' class="active"'; ?>>
          <a href="<?php echo Url::url("/admin"); ?>">
          <img src="<?php echo ADMINVIEW; ?>/images/mywork.svg">
          <span class="title"><?php echo Lang::$word->ADM_MYWORK; ?></span>
          </a>
        </li> -->
          <?php if (Auth::hasPrivileges('manage_people')) : ?>
            <li<?php if (in_array("members", $this->segments)) echo ' class="active"'; ?>>
              <a href="<?php echo Url::Url("/admin/members"); ?>">
                <img src="<?php echo ADMINVIEW; ?>/images/accounts.svg">
                <span class="title"><?php echo Lang::$word->ADM_ACCOUNTS; ?></span>
              </a>
              </li>
            <?php endif; ?>
            <?php if (Auth::hasPrivileges('manage_invoices')) : ?>
              <li<?php if (in_array("invoices", $this->segments)) echo ' class="active"'; ?>>
                <a href="<?php echo $this->core->invoice_view ? Url::url("/admin/invoices", "grid") : Url::url("/admin/invoices"); ?>">
                  <img src="<?php echo ADMINVIEW; ?>/images/invoices.svg">
                  <span class="title"><?php echo Lang::$word->ADM_INVOICES; ?></span>
                </a>
                </li>
              <?php endif; ?>
              <li<?php if (in_array("projects", $this->segments)) echo ' class="active"'; ?>>
                <a href="<?php echo $this->core->project_view ? Url::url("/admin/projects", "list") : Url::url("/admin/projects"); ?>">
                  <img src="<?php echo ADMINVIEW; ?>/images/projects.svg">
                  <span class="title"><?php echo Lang::$word->ADM_PROJECTS; ?></span>
                </a>
                </li>
                <?php if (Auth::hasPrivileges('manage_estimates')) : ?>
                  <li<?php if (in_array("estimates", $this->segments)) echo ' class="active"'; ?>>
                    <a href="<?php echo Url::url("/admin/estimates"); ?>">
                      <img src="<?php echo ADMINVIEW; ?>/images/estimates.svg">
                      <span class="title"><?php echo Lang::$word->ADM_ESTIMATES; ?></span>
                    </a>
                    </li>
                  <?php endif; ?>
                  <?php if (Auth::hasPrivileges('manage_skills')) : ?>
                  <li<?php if (in_array("skills", $this->segments)) echo ' class="active"'; ?> style="margin-left:12px;">
                    <a href="<?php echo Url::url("/admin/skills"); ?>">
                      <img src="<?php echo ADMINVIEW; ?>/images/estimates.svg">
                      <span class="title"><?php echo Lang::$word->SKILLS; ?></span>
                    </a>
                    </li>
                  <?php endif; ?>
                  <li<?php if (in_array("contact_list", $this->segments)) echo ' class="active"'; ?>>
                    <a href="<?php echo Url::url("/admin/contact_list"); ?>">
                      <img src="<?php echo ADMINVIEW; ?>/images/estimates.svg">
                      <span class="title"><?php echo Lang::$word->CONTACTS; ?></span>
                    </a>
                    </li>
                  <!--  <li<?php if (in_array("calendar", $this->segments)) echo ' class="active"'; ?>>
          <a href="<?php echo Url::url("/admin/calendar"); ?>">
          <img src="<?php echo ADMINVIEW; ?>/images/calendar.svg">
          <span class="title"><?php echo Lang::$word->ADM_CALENDAR; ?></span>
          </a>
        </li> -->
        </ul>
      </nav>
    </div>
  </div>
  <a href="" class="close_button">
        <i class="icon angle left close_icon"></i>
      </a>
  <div class="wojo-grid">
    <div class="wojo small breadcrumb">
      <?php echo Url::crumbs($this->crumbs ? $this->crumbs : $this->segments, "//", Lang::$word->HOME); ?>
    </div>
  </div>
  <div class="wojo-grid">
    <main>
