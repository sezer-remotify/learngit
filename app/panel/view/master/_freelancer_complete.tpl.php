<?php

if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

if (!App::Auth()->is_Freelancer() || App::Auth()->is_completed) {
  Url::redirect(SITEURL . '/');
  exit;
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="icon" href="<?php echo SITEURL; ?>/assets/images/favicon.png" type="image/x-icon">
  <!-- <link href="css/responsive.css" rel="stylesheet"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $this->title; ?></title>
  <!-- Bootstrap CSS -->
  <link href="<?php echo MASTERVIEW . '/cache/' . Cache::cssCache(array('base.css', 'transition.css', 'label.css', 'form.css', 'dropdown.css', 'input.css', 'button.css', 'message.css', 'image.css', 'list.css', 'table.css', 'icon.css', 'card.css', 'editor.css', 'modal.css', 'tooltip.css', 'menu.css', 'progress.css', 'utility.css', 'style.css'), MASTERBASE); ?>" rel="stylesheet" type="text/css" />

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <link href="/.old/css/bootstrap.css" rel="stylesheet">
  <link href="/.old/css/style.css" rel="stylesheet">
  <link href="/.old/css/responsive.css" rel="stylesheet">
  <link href="<?php echo MASTERVIEW; ?>/css/dashboard.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo MASTERVIEW; ?>/css/noman_custom.css" rel="stylesheet" type="text/css">
  <link href="<?php echo MASTERVIEW; ?>/css/blue.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/jquery.js"></script>
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/global.js"></script>
  <link href="<?php echo MASTERVIEW; ?>/css/custom-saq.css" rel="stylesheet" type="text/css" />
  <style>.select2-container--default .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice button {
    background: #403ab4;
    color: #fff;
    border-color: #fff !important;
    height: 30px;
    line-height: 30px;
}
.danger{
  background:#dc3545!important;
  height:auto!important;
}
.addRefer{
  height:auto!important;
}
.hear{
  height:35px;

}

</style>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
</head>

<body class="height-auto">
  <div class="page-wrapper">
    <div>
      <!-- Main Header-->
      <header class="main-header header-style-five background-inherit position-absolute">
        <!--Header-Upper-->
        <div class="header-upper">
          <div class="auto-container">
            <div class="header-outer padding-top-10 padding-bottom-10">
              <div class="logo-box padding-bottom-0 padding-top-0">
                <div class="logo"><img src="/.old/images/remotify-logo2.png" alt="" title=""></div>
              </div>

              <div class="nav-outer clearfix">
              </div>
              <!--Outer Box-->
            </div>
          </div>
        </div>
        <!--End Header Upper-->
      </header>
      <!--End Main Header -->
    </div>

    <section class="page-title">
      <div class="layer-outer">
        <span class="layer-image wow slideInDown animated" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-name: slideInDown;"></span>
      </div>
      <div class="auto-container">
        <h1><?php echo Lang::$word->FREELANCER_SIGNUP; ?></h1>
        <div class="bread-crumb"><?php echo Lang::$word->DASH_INFO_5; ?> </div>
      </div>
    </section>

    <main class="auto-container  dashboard-container height-auto">
      <!-- Dashboard Content
    ================================================== -->
      <div class="dashboard-content-inner">

        <form id="register-form" method="POST">
          <div class="row">


            <!-- Dashboard Box -->
            <div class="col-xl-12">
              <div class="dashboard-box margin-top-0">

                <!-- Headline -->
                <div class="headline">
                  <h3><i class="icon-material-outline-account-circle"></i> <?php echo Lang::$word->ACC_MY_ACCOUNT; ?></h3>
                </div>

                <div class="content with-padding padding-bottom-0">

                  <div class="row">

                    <div class="col-xl-3 col-md-3 col-sm-12">
                      <div class="avatar-wrapper" data-tippy-placement="bottom" title="Profile Picture">
                        <img class="profile-pic" src="<?php echo MASTERVIEW; ?>/images/user-avatar-placeholder.png" alt="" />
                        <div class="upload-button"></div>
                        <input class="file-upload" name="profile" type="file" accept="image/*" />
                      </div>
                    </div>

                    <div class="col-xl-9 col-md-9 col-sm-12">
                      <div class="row">

                        <div class="col-xl-6">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->FNAME; ?></h5>
                            <input id="first-name" name="name" type="text" class="with-border" placeholder="<?php echo Lang::$word->FNAME; ?>">
                          </div>
                        </div>

                        <div class="col-xl-6">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->LNAME; ?></h5>
                            <input id="last-name" name="surname" type="text" class="with-border" placeholder="<?php echo Lang::$word->LNAME; ?>">
                          </div>
                        </div>

                        <!-- <div class="col-xl-6">
                        <div class="submit-field">
                          <h5><?php echo Lang::$word->USERNAME; ?></h5>
                          <input id="username" name="username" type="text" placeholder="<?php echo Lang::$word->USERNAME; ?>">
                        </div>
                      </div>

                      <div class="col-xl-6">
                        <div class="submit-field">
                          <h5><?php echo Lang::$word->EMAIL; ?></h5>
                          <input type="text" class="with-border" placeholder="<?php echo Lang::$word->EMAIL; ?>">
                        </div>
                      </div> -->

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <!-- Dashboard Box -->
            <div class="col-xl-12">
              <div class="dashboard-box">

                <!-- Headline -->
                <div class="headline">
                  <h3><i class="icon-material-outline-face"></i><?php echo Lang::$word->MY_PROFILE; ?></h3>
                </div>

                <div class="content">
                  <ul class="fields-ul">
                    <li>
                      <div class="row">
                        <div class="col-xl-6">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->HEADLINE; ?></h5>
                            <input id="headline" name="headline" type="text" class="with-border" placeholder="<?php echo Lang::$word->HEADLINE_EXAMPLE; ?>">
                          </div>
                        </div>

                        <div class="col-xl-6">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->COUNTRY; ?></h5>
                            <select id="country" name="country" class="selectpicker with-border" data-size="7" data-live-search="true">
                              <option value="" disabled selected><?php echo Lang::$word->CHOOSE; ?>...</option>
                              <?php foreach ($this->countries as $v) : ?>
                                <option value="<?php echo $v->iso_alpha2; ?>"><?php echo $v->name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-xl-12">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->ABOUT_ME; ?></h5>
                            <textarea id="about-me" name="about" cols="30" rows="5" class="with-border" placeholder="<?php echo Lang::$word->ABOUT_ME; ?>"></textarea>
                          </div>
                        </div>
                        <div class="col-xl-12">
                          
                        <div class="submit-field">
                          <h5><?php echo Lang::$word->PROMOTION_CODE . " (" . Lang::$word->OPTIONAL . ")"; ?></h5>
                        <input type="text" class="with-border" id="promo_code" name="promo_code" placeholder="<?php echo Lang::$word->PROMOTION_CODE; ?>">
                        </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="row margin-bottom-50">
                        <div class="col-xl-12">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->LANGUAGES; ?> <i class="help-icon" data-tippy-placement="right" title="Add the languages you know"></i></h5>
                            <!-- Skills List -->
                            <div class="keywords-container">
                              <div class="keyword-input-container">
                                <input id="lang-input" type="text" autocomplete="disabled" placeholder="Add the languages you know...">
                                <button id="add-lang-btn" type="button" class="custom-add-button ripple-effect keyword-input-button"><i class="icon-material-outline-add"></i></button>
                              </div>
                              <div id="language-list" class="keywords-list">

                                <span class="keyword languages">
                                  <span class="keyword-remove lang-remove"></span>
                                  <span class="keyword-text">English</span></span>
                                <input name="languages[]" type="hidden" value="43" class="lang-one">
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                    <div class="row">
                        <div class="col-xl-12">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->EXPERIENCE; ?><i class="help-icon" data-tippy-placement="right" title="Choose your experience level"></i></h5>
                            <!--<input id="experience" name="experience" type="hidden" value="<?php echo $this->row->experience; ?>"> -->
                            <span id="experienceVal">0</span>
                            <input id="experience" name="experience" class="experience-bidding-slider" type="text" value="0" data-slider-handle="custom" data-slider-min="0" data-slider-max="30" data-slider-value="0" data-slider-step="1" data-slider-tooltip="hide" />
                             <!-- <div class="pricing-plans-container margin-top-50">
                              Plan
                              <div class="pricing-plan experience-card <?php if ($this->row->experience === "Beginner") echo 'selected' ?>">
                                <?php if ($this->row->experience === "Beginner") echo '<div class="recommended-badge">' . Lang::$word->SELECTED . '</div>'; ?>
                                <div class="pricing-plan-label billed-monthly-label"><strong class="experience-level"><?php echo Lang::$word->BEGINNER; ?></strong></div>
                                <div class="pricing-plan-features">
                                  <strong><?php echo Lang::$word->LESS_1_EXPERIENCE; ?></strong>
                                </div>
                              </div>
                              <div class="pricing-plan experience-card <?php if ($this->row->experience === "Intermediate") echo 'selected' ?>">
                                <?php if ($this->row->experience === "Intermediate") echo '<div class="recommended-badge">' . Lang::$word->SELECTED . '</div>'; ?>
                                <div class="pricing-plan-label billed-monthly-label"><strong class="experience-level"><?php echo Lang::$word->INTERMEDIATE; ?></strong></div>
                                <div class="pricing-plan-features">
                                  <strong><?php echo Lang::$word->LESS_5_EXPERIENCE; ?></strong>
                                </div>
                              </div>
                              <div class="pricing-plan experience-card <?php if ($this->row->experience === "Advanced") echo 'selected' ?>">
                                <?php if ($this->row->experience === "Advanced") echo '<div class="recommended-badge">' . Lang::$word->SELECTED . '</div>'; ?>
                                <div class="pricing-plan-label billed-monthly-label"><strong class="experience-level"><?php echo Lang::$word->ADVANCED; ?></strong></div>
                                <div class="pricing-plan-features">
                                  <strong><?php echo Lang::$word->MORE_5_EXPERIENCE; ?></strong>
                                </div>
                              </div> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Dashboard Box -->
            <div class="col-xl-12">
              <div class="dashboard-box">

                <!-- Headline -->
                <div class="headline">
                  <h3><i class="icon-material-outline-face"></i> <?php echo Lang::$word->MY_PROFILE; ?></h3>
                </div>

                <div class="content">
                  <ul class="fields-ul">
                    <li>
                      <div class="row">
                        <div class="col-xl-6 col-md-6">
                          <div class="submit-field">
                            <div class="bidding-widget hourly-rate-slider">
                              <!-- Headline -->
                              <span class="bidding-detail"><?php echo Lang::$word->SET_HOURLY_RATE; ?></span>

                              <!-- Slider -->
                              <div class="bidding-value margin-bottom-10"><i id="hourlyCurrency" class="icon-line-awesome-turkish-lira"></i><span id="hourlyRateVal">35</span>
                              </div>
                              <input id="hourly-rate" name="hourly_rate" class="hourly-rate-bidding-slider" type="text" value="35" data-slider-handle="custom" data-slider-min="20" data-slider-max="350" data-slider-value="35" data-slider-step="1" data-slider-tooltip="hide" />
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                          <div class="submit-field">
                            <div class="bidding-widget weekly-hours-slider">
                              <!-- Headline -->
                              <span class="bidding-detail"><?php echo Lang::$word->SET_WEEKLY_HOURS; ?></span>

                              <!-- Slider -->
                              <div class="bidding-value margin-bottom-10"><span id="weeklyHoursVal">10</span>hrs
                              </div>
                              <input id="weekly-hours" name="weekly_hours" class="weekly-hours-bidding-slider" type="text" value="10" data-slider-handle="custom" data-slider-min="1" data-slider-max="40" data-slider-value="10" data-slider-step="1" data-slider-tooltip="hide" />
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">

                      <div class="col-xl-6 col-md-6">
                        
                              
                            <div class="submit-field">
                            <div class="bidding-widget">
                              <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->CFG_SCURRENCY_S; ?></span>
                              <select class="form-select with-border" data-size="2" id="fixed-currency" name="fixed_currency" title="fixed-Currency" >
                                <option value="<?php echo Lang::$word->TRY; ?>"><?php echo Lang::$word->TRY; ?></option>
                                <option value="<?php echo Lang::$word->USD; ?>"><?php echo Lang::$word->USD; ?></option>
                              </select>
                            </div>
                            </div>
                          </div>
                        <div class="col-xl-6 col-md-6">
                          <div class="submit-field">
                            <div class="bidding-widget">
                              <!-- Headline -->
                              <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->CFG_PHONE; ?></span>
                              <input id="phone-number" name="phone" type="text" class="with-border" placeholder="<?php echo Lang::$word->PHONE_NUMBER_EXAMPLE; ?>" maxlength="20">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row margin-bottom-20">
                        <div class="col-xl-6 col-md-6">
                          <div class="section-headline margin-top-25 margin-bottom-12">
                            <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->CURRENT_EMPLOYMENT; ?></span>
                          </div>
                          <div class="radio">
                            <input id="current-fulltime" name="current_employment" type="radio" value="Full Time" checked="">
                            <label for="current-fulltime"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-parttime" name="current_employment" type="radio" value="Part Time">
                            <label for="current-parttime"><span class="radio-label"></span><?php echo Lang::$word->PARTTIME; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-freelancer" name="current_employment" type="radio" value="Freelancer">
                            <label for="current-freelancer"><span class="radio-label"></span><?php echo Lang::$word->FREELANCER; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-permanent" name="current_employment" type="radio" value="Permanent">
                            <label for="current-permanent"><span class="radio-label"></span><?php echo Lang::$word->PERMANENT; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-none" name="current_employment" type="radio" value="None">
                            <label for="current-none"><span class="radio-label"></span><?php echo Lang::$word->NONE; ?></label>
                          </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                          <div class="section-headline margin-top-25 margin-bottom-12">
                            <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->EMPLOYMENT_TYPE; ?></span>
                          </div>
                          <div class="radio">
                            <input id="preferred-fulltime" name="preferred_employment" type="radio" value="Full Time" checked="">
                            <label for="preferred-fulltime"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME_CONTRACT; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="preferred-parttime" name="preferred_employment" type="radio" value="Permanent">
                            <label for="preferred-parttime"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME_PERMANENT; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="preferred-freelancer" name="preferred_employment" type="radio" value="Part Time">
                            <label for="preferred-freelancer"><span class="radio-label"></span><?php echo Lang::$word->PARTTIME; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="preferred-permanent" name="preferred_employment" type="radio" value="Freelancer">
                            <label for="preferred-permanent"><span class="radio-label"></span><?php echo Lang::$word->FREELANCER; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-12 col-md-12">
                          <div class="submit-field">
                            <div class="bidding-widget">
                              <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->REFERS; ?> (Max. 5)</span>
                              <div class="row" id="refer0">
                                <div class="col-md-4">
                                  <input id="reference_name0" type="text" name="references_name[]" type="text" class="with-border" placeholder="John Doe">
                                </div>
                                <div class="col-md-4">
                                 <input id="reference_phone0" name="references_phone[]" maxlength="20" type="text" placeholder="(555) 555 55 55" class="with-border input-phone">
                                </div>
                                <div class="col-md-4">
                                  <input id="reference_email0" type="email" name="references_email[]" type="text" class="with-border" placeholder="johndoe@example.com">
                                </div>
                              </div>
                              <div class="row referButton">
                                <div class="col">
                                  <a class="wojo secondary button addRefer">Add More</a>
                                  <a class="wojo danger button removeRefer">Remove</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-12 col-md-12">
                          <div class="submit-field">
                            <div class="bidding-widget">
                              <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->PORTFOLIO_LINK; ?>. <?php echo Lang::$word->PORTFOLIO_LINKDESC; ?>  (LinkedIn, GitHub, GitLab...)</span>
                              <input id="portfolio-link" name="portfolio" type="text" class="with-border" placeholder="<?php echo Lang::$word->PORTFOLIO_LINK_EXAMPLE; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-12 col-md-12">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->ATTACHMENTS; ?></h5>

                            <!-- Attachments -->
                            <div class="attachments-container margin-top-0 margin-bottom-0">
                              <div class="attachment-box ripple-effect" style="flex:0 0 calc(100% - 21px);">
                                <span id="cover"><?php echo Lang::$word->CV . Lang::$word->CLICK_UPLOAD; ?></span>
                                <span id="cover-name"></span>
                                <i>PDF</i>
                                <button id="cover-remove" type="button" class="remove-attachment" data-tippy-placement="top" title="Remove"></button>
                                <input id="cover-input" name="cv" type="file" accept=".pdf" />
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="row">
                      <div class="col-xl-12 margin-top-20">
                        <h4 class="font-weight-700"><?php echo Lang::$word->SKILLS; ?></h4>
                        <h6 id="minimum_skill_select" class="text-red hide-all"><?php echo Lang::$word->MINIMUM_ONE_SKILL; ?></h6>
                      </div>
                      <div class="col-xl-12 padding-top-5 padding-bottom-15" id="skills_container">
                      <select class="js-example-basic-multiple" name="skills[]" multiple="multiple">
  
                          <?php $x = 1;
                          foreach ($this->skills as $skills) : ?>
                          <option value="<?php echo $skills->id; ?>"><?php echo $skills->name; ?></option>

                          <?php endforeach; ?>
                        </select>
                        
                        
                      </div>
                      </div>
                    </li>
                    <li>
                      <div class="row">
                      <div class="col-xl-12 margin-top-20">
                        <h4 class="font-weight-700"><?php echo Lang::$word->HEAR_ABOUT; ?></h4>
                      </div>
                      <div class="col-xl-12 padding-top-5 padding-bottom-15" id="hear_container">
                        <select class="hear" name="hear">
                          <option value="Google">Google</option>
                          <option value="Linkedn">Linkedn</option>
                          <option value="3">From a Friend</option>
                          <option value="4">From a Client</option>
                        </select>
                        <input type="text" name="hearAbout" style="display:none;" class="hearAbout" placeholder="Fullname or Username">
                      </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Save changes Button -->
            <div class="col-xl-12 margin-bottom-100 centered-button">
              <button type="button" id="save-button" name="dosubmit" data-action="doSignup" form="register-form" class="wojo secondary button margin-top-30"><?php echo Lang::$word->SAVEC; ?></button>
            </div>
          </div>

        </form>
      </div>
      <!-- Dashboard Content / End -->

    </main>


    <div id="footer"></div>

  </div>


                       
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/tippy.all.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/simplebar.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/bootstrap-slider.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/clipboard.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/counterup.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/magnific-popup.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/slick.min.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/js/custom.js"></script>


  <script>
    var refer = 0;
    $(".hear").change(function(){
      
      if($(this).val() == 3 || $(this).val() == 4)
      {
        $(".hearAbout").show(300, function(){
          $(".hearAbout").attr("value","");
        });
      }else
      {
        $(".hearAbout").hide(300, function()
          {
            $(".hearAbout").attr("value",$(this).val());
          }
        );
      }
    });
    
    $(".addRefer").click(function(){
      if(refer!=4)
      {
        var preReferLink = "#refer"+refer;
        refer++;
        var newReferLink = "#refer"+refer;
        var template = '<div class="row" style="display:none" id="refer'+refer+'"><div class="col-md-4"><input id="reference'+refer+'" type="text" name="references-name[]" type="text" class="with-border" placeholder="John Doe"></div><div class="col-md-4"><input id="reference'+refer+'" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="references-phone[]" type="text" class="with-border" placeholder="123-456-7890"></div><div class="col-md-4"><input id="reference'+refer+'" type="email" name="references-email[]" type="text" class="with-border" placeholder="johndoe@example.com"></div></div>';
        $(preReferLink).after(template); 
        $(newReferLink).slideToggle( "slow");
      }else
      {
        var preReferLink = "#refer"+refer;
        var template = '<div class="row" style="display:none" id="alertRefer"><div class="col"><center><h6>You have reached your maximum reference count.</h6></center></div></div>';
        $(preReferLink).after(template); 
        $("#alertRefer").slideToggle(500);
        setTimeout(() => {
          $("#alertRefer").slideToggle(500);
        }, 1500);
      }
    });
    $(".removeRefer").click(function(){
      if(refer!=0)
      {
        var referLink = "#refer"+refer;
        $(referLink).slideToggle( "slow", function(){
          $(referLink).remove();
        });
        refer--;
      }else
      {
        var preReferLink = "#refer"+refer;
        var template = '<div class="row" style="display:none" id="alertRefer"><div class="col"><center><h6>You cant remove last one.</h6></center></div></div>';
        $(preReferLink).after(template); 
        $("#alertRefer").slideToggle(500);
        setTimeout(() => {
          $("#alertRefer").slideToggle(500);
        }, 1500);
      }
    });

    /*An array containing all the language names in the world:*/
    let names = [<?php foreach ($this->languages as $v) : echo "'" . $v->name . "',";
                  endforeach; ?>];

    var langs = ["english"];
    $('#fixed-currency').on('change', function (e) {
      var data = {TRY:'icon-line-awesome-turkish-lira', USD: 'icon-line-awesome-usd'}, selectVal = $(this).val();
      
      $('#hourlyCurrency').removeClass().addClass(data[selectVal]);
      
    });

    $(".experience-card").click(function() {
      $("input#experience").val($(this).find(".experience-level").html());
      $(".recommended-badge").parent().removeClass("selected");
      $(".recommended-badge").remove();
      $(this).prepend(
        '<div class="recommended-badge"><?php echo Lang::$word->SELECTED; ?></div>'
      );
      $(this).addClass("selected");
    });
    // Hourly Rate slider
    $('.hourly-rate-bidding-slider').slider();
    $(".hourly-rate-bidding-slider").on("slide", function(slideEvt) {
      $("#hourlyRateVal").html($('.hourly-rate-bidding-slider').val());
    });
    $(document).on('click', '.hourly-rate-slider', function() {
      $("#hourlyRateVal").html($('.hourly-rate-bidding-slider').val());
    });
      // Experience slider
      $('.experience-bidding-slider').slider();
    $(".experience-bidding-slider").on("slide", function(slideEvt) {
      $("#experienceVal").html($('.experience-bidding-slider').val());
    });
    $(document).on('click', '.experience-slider', function() {
      $("#experienceVal").html($('.experience-bidding-slider').val());
    });
    // Weekly hours slider
    $('.weekly-hours-bidding-slider').slider();
    $(".weekly-hours-bidding-slider").on("slide", function(slideEvt) {
      $("#weeklyHoursVal").html($('.weekly-hours-bidding-slider').val());
    });
    $(document).on('click', '.weekly-hours-slider', function() {
      $("#weeklyHoursVal").html($('.weekly-hours-bidding-slider').val());
    });
  </script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/freelancer_signup.js"></script>




  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/editor/trumbowyg.js"></script>
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/editor/trumbowyg.js"></script>
  <script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/master.js"></script>
  <script type="text/javascript">
    // <![CDATA[
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    $(document).ready(function() {
      
      $.Master({
        weekstart: <?php echo $this->core->weekstart; ?>,
        ampm: "<?php echo ($this->core->time_format) == "hh:mm" ? false : true; ?>",
        url: "<?php echo MASTERVIEW; ?>",
        surl: "<?php echo SITEURL; ?>",
        eucookie: <?php echo $this->core->eucookie; ?>,
        lang: {
          monthsFull: [<?php echo Date::monthList(false); ?>],
          monthsShort: [<?php echo Date::monthList(false, false); ?>],
          weeksFull: [<?php echo Date::weekList(false); ?>],
          weeksShort: [<?php echo Date::weekList(false, 3); ?>],
          weeksMed: [<?php echo Date::weekList(false, 2); ?>],
          weeksSmall: [<?php echo Date::weekList(false, 1); ?>],
          selPic: "<?php echo Lang::$word->SELPIC; ?>",
          ok: "<?php echo Lang::$word->OK; ?>",
          today: "<?php echo Lang::$word->TODAY; ?>",
          now: "<?php echo Lang::$word->NOW; ?>",
          clear: "<?php echo Lang::$word->CLEAR; ?>",
          doSearch: "<?php echo Lang::$word->SEARCH; ?>",
          delBtn: "<?php echo Lang::$word->DELETE_REC; ?>",
          arcBtn: "<?php echo Lang::$word->MTOARCHIVE; ?>",
          trsBtn: "<?php echo Lang::$word->MTOTRASH; ?>",
          restBtn: "<?php echo Lang::$word->RFCOMPLETE; ?>",
          uarcBtn: "<?php echo Lang::$word->RFARCHIVE; ?>",
          canBtn: "<?php echo Lang::$word->CANCEL; ?>",
          allBtn: "<?php echo Lang::$word->SELECT_ALL; ?>",
          sellOne: "<?php echo Lang::$word->SELECT; ?>",
          sellected: "<?php echo Lang::$word->SELECTED; ?>",
          allSell: "<?php echo Lang::$word->ALL_SELECTED; ?>",
          noMatch: "<?php echo Lang::$word->NOMATCH; ?>",
          delMsg1: "<?php echo Lang::$word->DELCONFIRM1; ?>",
          delMsg2: "<?php echo Lang::$word->DELCONFIRM2; ?>",
          delMsg3: "<?php echo Lang::$word->TRASH; ?>",
          delMsg5: "<?php echo Lang::$word->DELCONFIRM4; ?>",
          delMsg6: "<?php echo Lang::$word->DELCONFIRM6; ?>",
          delMsg7: "<?php echo Lang::$word->DELCONFIRM10; ?>",
          delMsg8: "<?php echo Lang::$word->DELCONFIRM3; ?>",
          delMsg9: "<?php echo Lang::$word->DELCONFIRM11; ?>",
          working: "<?php echo Lang::$word->WORKING; ?>"

        }
      });
    });
    // ]]>
  </script>

  <!--Scroll to top-->
  <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fas fa-angle-up"></span></div>
  <!-- <script src="/js/jquery.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

  <script src="/.old/js/wow.js"></script>
  <!-- <script src="/js/script.js"></script> -->

</body>

</html>