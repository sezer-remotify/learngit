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
              <div>
                <h4><span><?php echo Lang::$word->LOOKING_FOR; ?>: </span><span id="looking_for"><?php echo $this->row->emp_prefer; ?></span></h4>
              </div>
              <ul class="margin-bottom-20">
                <!-- <li>
                  <div class="star-rating" data-rating="5.0"></div>
                </li> -->
                <?php if ($this->row->country) : ?>
                  <li>
                    <img class="flag" src="<?php echo UPLOADURL; ?>/flags/<?php echo strtolower($this->row->country) . ".svg"; ?>" alt="<?php echo strtolower($this->row->country); ?>">
                    <?php foreach ($this->countries as $v) : ?>
                      <?php if ($v->iso_alpha2 === $this->row->country) echo $v->name; ?>
                    <?php endforeach; ?>
                  </li>
                <?php endif; ?>
                <li>
                  <div class="verified-badge-with-title"><?php echo Lang::$word->VERIFIED; ?></div>
                </li>
              </ul>
              <!-- <ul>
                <li>
                  <span id="preferred-freelancer" class="icon-material-outline-star-border custom-icon custom-icon-active"
                    data-tippy-placement="bottom" data-tippy-theme="light" data-tippy=""
                    data-original-title="<?php echo Lang::$word->PREFERRED_FREELANCER; ?>">
                  </span>
                </li>
                <li>
                  <span id="profile-verified" class="icon-material-outline-account-circle custom-icon custom-icon-active"
                    data-tippy-placement="bottom" data-tippy-theme="light" data-tippy=""
                    data-original-title="<?php echo Lang::$word->ID_VERIFIED; ?>">
                  </span>
                </li>
                <li>
                  <span id="payment-verified" class="icon-material-outline-monetization-on custom-icon custom-icon-active"
                    data-tippy-placement="bottom" data-tippy-theme="light" data-tippy=""
                    data-original-title="<?php echo Lang::$word->PAYMENT_VERIFIED; ?>">
                  </span>
                </li>
                <li>
                  <span id="phone-verified" class="icon-line-awesome-phone-square custom-icon custom-icon-active" data-tippy-placement="bottom"
                    data-tippy-theme="light" data-tippy="" data-original-title="<?php echo Lang::$word->PHONE_VERIFIED; ?>">
                  </span>
                </li>
                <li>
                  <span id="email-verified" class="icon-material-outline-email custom-icon custom-icon-active" data-tippy-placement="bottom"
                    data-tippy-theme="light" data-tippy="" data-original-title="<?php echo Lang::$word->EMAIL_VERIFIED; ?>">
                  </span>
                </li>
                <li>
                  <span id="facebook-connected" class="icon-brand-facebook custom-icon custom-icon-active" data-tippy-placement="bottom"
                    data-tippy-theme="light" data-tippy="" data-original-title="<?php echo Lang::$word->FACEBOOK_CONNECTED; ?>"></span>
                </li>
              </ul> -->
            </div>
          </div>
          <div class="col-xl-6 padding-top-15">
            <!-- Profile Overview -->
            <div class="profile-overview">
              <div class="overview-item text-center"><strong id="hourly_rate"><i class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> font-weight-700"></i><?php echo $this->row->hourly_rate; ?></strong><span><?php echo Lang::$word->REP_SUB31; ?></span></div>
              <div class="overview-item text-center"><strong id="weekly_avail_hrs"><?php echo $this->row->available_hour; ?></strong><span><?php echo Lang::$word->WEEKLY_AVAIL; ?></span></div>
              <div class="overview-item text-center"><strong id="experience"><?php echo $this->row->experience; ?></strong><span><?php echo Lang::$word->EXP_LEVEL; ?></span></div>
              <!-- <div class="overview-item"><strong>53</strong><span>Jobs Done</span></div> -->
              <!-- <div class="overview-item"><strong>22</strong><span>Rehired</span></div> -->
            </div>

            <!-- Button -->
            <?php if (App::Auth()->logged_in && Auth::$udata->uid != $this->row->id) : ?>
              <!-- <a href="#small-dialog" class="apply-now-button popup-with-zoom-anim margin-bottom-50 text-white"><?php echo Lang::$word->MAKE_OFFER; ?>
                <i class="icon-material-outline-arrow-right-alt"></i></a> -->

            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page Content
================================================== -->
<div class="container dashboard-container padding-top-40">
  <div class="row width-100">

    <!-- Content -->
    <div class="col-xl-8 col-lg-8 content-right-offset">

      <!-- About Me Section -->
      <div class="single-page-section">
        <h3 class="margin-bottom-25 font-weight-700"><?php echo Lang::$word->ABOUT_ME; ?></h3>
        <div id="about">
          <?php echo $this->row->about; ?>
        </div>
      </div>

      <!-- Attachment Section / Start -->
      <div class="boxed-list margin-bottom-60">
        <div class="boxed-list-headline">
          <h3><i class="icon-material-outline-description"></i><?php echo Lang::$word->ATTACHMENTS; ?></h3>
        </div>
        <ul id="publications-list" class="boxed-list-ul">
          <li>
            <!-- Attachments Widget -->
            <div class="sidebar-widget">
              <div class="attachments-container">
                <a target="_BLANK" href="<?php echo UPLOADURL . "/files/" . $this->row->cv; ?>" class="attachment-box ripple-effect"><span><?php echo Lang::$word->CV; ?></span><i>PDF</i></a>
                <!-- <a href="#" class="attachment-box ripple-effect"><span><?php echo Lang::$word->CONTRACT; ?></span><i>DOCX</i></a> -->
              </div>
            </div>
          </li>
        </ul>
      </div>


    </div>


    <!-- Sidebar -->
    <div class="col-xl-4 col-lg-4">
      <div class="sidebar-container">


        <!-- Skills Widget -->
        <div class="sidebar-widget">
          <h3 class=" font-weight-700"><?php echo Lang::$word->SKILLS; ?></h3>
          <div class="task-tags">
            <?php foreach ($this->skills as $v) : ?>
              <span> <?php echo $v->name; ?></span>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Languages Widget -->
        <div class="sidebar-widget">
          <h3 class=" font-weight-700"><?php echo Lang::$word->LANGUAGES; ?></h3>
          <div class="task-tags">
            <?php foreach ($this->languages as $v) : ?>
              <span> <?php echo $v->name; ?></span>
            <?php endforeach; ?>
          </div>
        </div>



      </div>
    </div>

  </div>
</div>
<!-- Make an Offer Popup / End -->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script>
  tippy('#payment-verified', {
    content: "Payment Verified!",
  });
  tippy('#preferred-freelancer', {
    content: "Preferred Freelancer!",
  });
  tippy('#email-verified', {
    content: "Email Address Verified!",
  });
  tippy('#profile-verified', {
    content: "Profile Completed!",
  });
  tippy('#phone-verified', {
    content: "Phone Number Verified!",
  });
  tippy('#facebook-connected', {
    content: "Facebook Connected!",
  });
  $(document).ready(function() {
    $('#payment-verified').hover(function() {
      $('#payment-verified').toggleClass("custom-icon-active");
    });
    $('#preferred-freelancer').hover(function() {
      $('#preferred-freelancer').toggleClass("custom-icon-active");
    });
    $('#email-verified').hover(function() {
      $('#email-verified').toggleClass("custom-icon-active");
    });
    $('#profile-verified').hover(function() {
      $('#profile-verified').toggleClass("custom-icon-active");
    });
    $('#phone-verified').hover(function() {
      $('#phone-verified').toggleClass("custom-icon-active");
    });
    $('#facebook-connected').hover(function() {
      $('#facebook-connected').toggleClass("custom-icon-active");
    });
  });
</script>