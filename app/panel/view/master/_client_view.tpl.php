<?php

/**
 * Expenses
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: expenses.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>

<!-- Titlebar
================================================== -->
<div class="single-page-header freelancer-header margin-0" data-background-image="images/single-freelancer.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="single-page-header-inner row">
          <div class="left-side col-xl-6">
            <div class="header-image freelancer-avatar"><img src="<?php echo UPLOADURL; ?>/avatars/<?php echo ($this->row->avatar) ? $this->row->avatar : "blank.svg"; ?>" alt=""></div>
            <div class="header-details">
              <div>
                <h3 id="name" class="margin-0">
                  <?php echo $this->row->fname . ' ' . $this->row->lname; ?>
                </h3>
              </div>
              <div>
                <h3 class="margin-0"><span><?php echo $this->row->headline; ?></span></h3>
              </div>
              <ul class="margin-bottom-20">
                <!-- <li>
                  <a id="linkedin-connected" class="icon-brand-linkedin custom-icon custom-icon-active" data-tippy-placement="bottom" data-tippy-theme="light" title="LinkedIn Link"></a>
                </li> -->
                <li>
                  <div class="verified-badge-with-title"><?php echo Lang::$word->VERIFIED; ?></div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page Content
================================================== -->
<div class="dashboard-container height-auto margin-top-40">
  <div class="container">
    <div class="row">

      <!-- Content -->
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">

        <!-- About Me Section -->
        <?php if ($this->row->about) : ?>
          <div class="single-page-section">
            <h3 class="margin-bottom-25"><?php echo Lang::$word->ABOUT_ME; ?></h3>
            <div id="about">
              <?php echo $this->row->about; ?>
            </div>
          </div>
        <?php endif; ?>
        <!-- Company Info Section / Start -->
        <div class="boxed-list margin-bottom-60">
          <div class="boxed-list-headline">
            <h3><i class="icon-material-outline-description"></i><?php echo Lang::$word->CMP_INFO; ?></h3>
          </div>
          <ul class="boxed-list-ul">
            <li>
              <div class="boxed-list-item">
                ​
                <!-- Content -->
                <div class="item-content">
                  <h4 id="cmp_name"><?php echo $this->irow->cmp_name; ?></h4>
                  <div class="item-details margin-top-7">

                    <?php if ($this->irow->cmp_linkedin) : ?>
                      <div class="detail-item"><a id="cmp_linkedin" href="#"><i class="icon-feather-linkedin"></i>
                          <?php echo $this->irow->cmp_linkedin; ?></a></div>
                    <?php endif; ?>

                    <?php if ($this->irow->cmp_website) : ?>
                      <div class="detail-item"><a id="cmp_web" href="#"><i class="icon-feather-home"></i> <?php echo $this->irow->cmp_website; ?></a>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="item-description">
                    <p id="cmp_desc"><?php echo $this->irow->cmp_desc; ?></p>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <!-- Company Info Section / End -->


      </div>

      <div class="col-xl-4 col-md-4 col-sm-12">
        <div class="sidebar-container">
          <!-- Skills Widget -->
          <div class="sidebar-widget">
            <h3 class=" font-weight-700"><?php echo Lang::$word->SKILLS; ?> <i class="help-icon" data-tippy-placement="top" title="<?php echo Lang::$word->CLIENT_LOOKING; ?>"></i></h3>
            <div class="task-tags">
              <?php foreach ($this->skills as $v) : ?>
                <span> <?php echo $v->name; ?></span>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>