<?php

/**
 * Freelancer Search Projects page
 *
 * @package Wojo Framework
 * @author MOHAMMAD ILYAS KOHISTANI
 * @copyright 2019
 * @version $Id: freelancer_search_proj.tpl.php, v1.00 2021-01-23 21:18:00 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');


if (!Auth::hasPrivileges('manage_people')) : print Message::msgError(Lang::$word->NOACCESS);
  return;
endif;
?>

<link href="<?php echo MASTERVIEW; ?>/css/dashboard.css" rel="stylesheet" type="text/css">
<link href="<?php echo MASTERVIEW; ?>/css/blue.css" rel="stylesheet" type="text/css">

<!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="images/single-task.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="single-page-header-inner">
          <div class="left-side">
            <div class="header-image "><a href="<?php echo Url::url('/admin/members/' . $this->uRow->username); ?>">
                <img id="company-logo" src="<?php echo ($this->uRow->avatar) ? UPLOADURL . "/avatars/" . $this->uRow->avatar : MASTERVIEW . "/images/user-avatar-placeholder.png"; ?>" alt="<?php echo $this->uRow->fname; ?>">
              </a></div>
            <div class="header-details">
              <h3 id="project-name"><?php echo $this->row->name; ?></h3>
              <ul>
                <li>
                  <h5><?php echo ucwords($this->uRow->fname . ' ' . $this->uRow->fname); ?></h5>
                </li>
                <li>
                  <div id="company-verified" class="verified-badge-with-title"><?php echo Lang::$word->VERIFIED; ?>
                  </div>
                </li>
              </ul>
              <ul>
                <?php
                if ($this->row->country) echo '<li><img id="company-country" class="flag" src=" ' . UPLOADURL . '/flags/' . $this->row->country . '.svg" alt="' . $this->row->country . '">
                </li>';
                ?>
                <li class="d-inline-flex align-items-center"><span class="icon-material-outline-business-center custom-icon margin-right-5"></span><?php echo $this->row->work_type; ?>
                </li>
                <li class="d-inline-flex align-items-center"><span class="icon-material-outline-access-time custom-icon margin-right-5"></span><?php echo $this->row->start_date; ?>
                </li>
                <li class="d-inline-flex align-items-center"><span class="icon-line-awesome-group custom-icon margin-right-5"></span><?php echo $this->row->required_dev; ?>
                </li>
              </ul>
            </div>
          </div>
          <div class="right-side">
            <div class="salary-box">
              <div class="salary-type text-center">
                <strong><?php echo ucwords($this->budget->type . ' ' . Lang::$word->NAV_37); ?></strong>
              </div>
              <div id="project-budget" class="salary-amount">
                <?php echo ($this->row->currency === 'TRY') ? '₺' . $this->budget->minimum . (($this->budget->maximum > 0) ? ' - ₺' . $this->budget->maximum : '+')
                  : '$' . $this->budget->minimum . (($this->budget->maximum > 0) ? ' - $' . $this->budget->maximum : '+'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Content
================================================== -->
<div class="dashboard-container height-auto">
  <div class="container">
    <div class="row">

      <!-- Content -->
      <div class="col-xl-12 col-lg-12 content-right-offset">


        <!-- Description -->
        <div class="single-page-section">
          <h3 class="margin-bottom-25"><?php echo Lang::$word->PROJECT_DESCRIPTION; ?></h3>
          <p id="project-description"><?php echo $this->row->description; ?></p>
        </div>
        <!-- Skills -->
        <div class="single-page-section">
          <h3><?php echo Lang::$word->SKILLS_REQUIRED; ?></h3>
          <div id="skills-required" class="task-tags">
            <?php foreach ($this->skills as $v) echo '<span class="margin-left-4">' . $v->name . '</span>'; ?>
          </div>
        </div>

        <?php if (count((array)$this->files) > 0) : ?>
          <!-- Atachments -->
          <div class="single-page-section">
            <h3><?php echo Lang::$word->ATTACHMENTS; ?></h3>
            <div id="attachments" class="attachments-container">
              <?php foreach ($this->files as $v) : ?>
                <a target="_BLANK" href="<?php echo UPLOADURL . '/files/' . $v->name; ?>" class="attachment-box ripple-effect" download><span>Project Brief</span><i><?php echo $v->fext; ?></i></a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>