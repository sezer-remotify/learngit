<?php

if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

if (!App::Auth()->is_Freelancer() || !App::Auth()->is_completed) {
  Url::redirect(SITEURL . '/');
  exit;
}

  include("header.tpl.php");
?>
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
.dashboard-container{
  height:auto!important;
}

</style>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <div class="page-wrapper">

    <!--<section class="page-title">

      <div class="layer-outer">
        <span class="layer-image wow slideInDown animated" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-name: slideInDown;"></span>
      </div>

      <div class="auto-container">
        <h1><?php echo $this->title; ?></h1>
        <div class="bread-crumb">Profile Update</div>
        <div class="col-xl-12 margin-bottom-100 centered-button">
              <a href="http://remotify.co/app/panel/master"><button type="button" id="" name="" data-action="" form="" class="wojo secondary button margin-top-30">Dashboard</button></a>
            </div>

      </div>
    </section>-->

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
                        <img class="profile-pic" src="<?php echo ($this->row->avatar) ? UPLOADURL . "/avatars/" . $this->row->avatar : MASTERVIEW . "/images/user-avatar-placeholder.png"; ?>" alt="" />
                        <div class="upload-button"></div>
                        <input class="file-upload" name="profile" type="file" accept="image/*" />
                      </div>
                    </div>

                    <div class="col-xl-9 col-md-9 col-sm-12">
                      <div class="row">

                        <div class="col-xl-6">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->FNAME; ?></h5>
                            <input id="first-name" name="name" type="text" class="with-border" value="<?php echo $this->row->fname; ?>" placeholder="<?php echo Lang::$word->FNAME; ?>">
                          </div>
                        </div>

                        <div class="col-xl-6">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->LNAME; ?></h5>
                            <input id="last-name" name="surname" type="text" class="with-border" value="<?php echo $this->row->lname; ?>" placeholder="<?php echo Lang::$word->LNAME; ?>">
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
                            <input id="headline" name="headline" type="text" class="with-border" value="<?php echo $this->row->headline; ?>" placeholder="<?php echo Lang::$word->HEADLINE_EXAMPLE; ?>">
                          </div>
                        </div>

                        <div class="col-xl-6">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->COUNTRY; ?></h5>
                            <select id="country" name="country" class="selectpicker with-border" data-size="7" data-live-search="true">
                              <option value="" disabled><?php echo Lang::$word->CHOOSE; ?>...</option>
                              <?php foreach ($this->countries as $v) : ?>
                                <option value="<?php echo $v->iso_alpha2; ?>" <?php if ($this->row->country === $v->iso_alpha2) echo "selected"; ?>><?php echo $v->name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-xl-12">
                          <div class="submit-field">
                            <h5><?php echo Lang::$word->ABOUT_ME; ?></h5>
                            <textarea id="about-me" name="about" cols="30" rows="5" class="with-border" placeholder="<?php echo Lang::$word->ABOUT_ME; ?>"><?php echo $this->row->about; ?></textarea>
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

                                <?php foreach ($this->uLanguages as $v) : ?>
                                  <span class="keyword languages">
                                    <span class="keyword-remove lang-remove"></span>
                                    <span class="keyword-text"><?php echo $v->name ?></span>
                                  </span>
                                  <input name="languages[]" type="hidden" class="lang-one" value="<?php echo $v->id ?>">
                                <?php endforeach; ?>
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
                            <h5><?php echo Lang::$word->EXPERIENCE; ?><i class="help-icon" data-tippy-placement="right" title="Choose your experience year"></i></h5>
                            <!--<input id="experience" name="experience" type="hidden" value="<?php echo $this->row->experience; ?>"> -->
                            <span id="experienceVal"><?php echo $this->row->experience; ?></span>
                            <input id="experience" name="experience" class="experience-bidding-slider" type="text" value="<?php echo $this->row->experience; ?>" data-slider-handle="custom" data-slider-min="0" data-slider-max="30" data-slider-value="<?php echo $this->row->experience; ?>" data-slider-step="1" data-slider-tooltip="hide" />
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
                              <div class="bidding-value margin-bottom-10"><i id="hourlyCurrency" class="<?= ($this->row->currency === Lang::$word->TRY) ? "icon-line-awesome-turkish-lira" : "icon-line-awesome-usd" ?>"></i><span id="hourlyRateVal"><?php echo $this->row->hourly_rate; ?></span>
                              </div>
                              <input id="hourly-rate" name="hourly_rate" class="hourly-rate-bidding-slider" type="text" value="<?php echo $this->row->hourly_rate; ?>" data-slider-handle="custom" data-slider-min="5" data-slider-max="300" data-slider-value="<?php echo $this->row->hourly_rate; ?>" data-slider-step="1" data-slider-tooltip="hide" />
                            </div>
                          </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                          <div class="submit-field">
                            <div class="bidding-widget weekly-hours-slider">
                              <!-- Headline -->
                              <span class="bidding-detail"><?php echo Lang::$word->SET_WEEKLY_HOURS; ?></span>

                              <!-- Slider -->
                              <div class="bidding-value margin-bottom-10"><span id="weeklyHoursVal"><?php echo $this->row->available_hour; ?></span>hrs
                              </div>
                              <input id="weekly-hours" name="weekly_hours" class="weekly-hours-bidding-slider" type="text" value="<?php echo $this->row->available_hour; ?>" data-slider-handle="custom" data-slider-min="1" data-slider-max="40" data-slider-value="<?php echo $this->row->available_hour; ?>" data-slider-step="1" data-slider-tooltip="hide" />
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
                            <option value="<?php echo Lang::$word->TRY; ?>" <?php if ($this->row->currency === Lang::$word->TRY) echo "selected"; ?>><?php echo Lang::$word->TRY; ?></option>
                            <option value="<?php echo Lang::$word->USD; ?>" <?php if ($this->row->currency === Lang::$word->USD) echo "selected"; ?>><?php echo Lang::$word->USD; ?></option>
                          </select>
                        </div>
                        </div>
                      </div>
                        <div class="col-xl-6 col-md-6">
                          <div class="submit-field">
                            <div class="bidding-widget">
                              <!-- Headline -->
                              <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->CFG_PHONE; ?></span>
                              <input id="phone-number" name="phone" type="text" class="with-border" value="<?php echo $this->row->phone; ?>" placeholder="<?php echo Lang::$word->PHONE_NUMBER_EXAMPLE; ?>" maxlength="20">
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
                            <input id="current-fulltime" name="current_employment" type="radio" value="Full Time" <?php if ($this->row->emp_type === 'Full Time') echo 'checked'; ?>>
                            <label for="current-fulltime"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-parttime" name="current_employment" type="radio" value="Part Time" <?php if ($this->row->emp_type === 'Part Time') echo 'checked'; ?>>
                            <label for="current-parttime"><span class="radio-label"></span><?php echo Lang::$word->PARTTIME; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-freelancer" name="current_employment" type="radio" value="Freelancer" <?php if ($this->row->emp_type === 'Freelancer') echo 'checked'; ?>>
                            <label for="current-freelancer"><span class="radio-label"></span><?php echo Lang::$word->FREELANCER; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-permanent" name="current_employment" type="radio" value="Permanent" <?php if ($this->row->emp_type === 'Permanent') echo 'checked'; ?>>
                            <label for="current-permanent"><span class="radio-label"></span><?php echo Lang::$word->PERMANENT; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="current-none" name="current_employment" type="radio" value="None" <?php if ($this->row->emp_type === 'None') echo 'checked'; ?>>
                            <label for="current-none"><span class="radio-label"></span><?php echo Lang::$word->NONE; ?></label>
                          </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                          <div class="section-headline margin-top-25 margin-bottom-12">
                            <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->EMPLOYMENT_TYPE; ?></span>
                          </div>
                          <div class="radio">
                            <input id="preferred-fulltime" name="preferred_employment" type="radio" value="Full Time" <?php if ($this->row->emp_prefer === 'Full Time') echo 'checked'; ?>>
                            <label for="preferred-fulltime"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME_CONTRACT; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="preferred-freelancer" name="preferred_employment" type="radio" value="Part Time" <?php if ($this->row->emp_prefer === 'Part Time') echo 'checked'; ?>>
                            <label for="preferred-freelancer"><span class="radio-label"></span><?php echo Lang::$word->PARTTIME; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="preferred-permanent" name="preferred_employment" type="radio" value="Freelancer" <?php if ($this->row->emp_prefer === 'Freelancer') echo 'checked'; ?>>
                            <label for="preferred-permanent"><span class="radio-label"></span><?php echo Lang::$word->FREELANCER; ?></label>
                          </div>
                          <br>
                          <div class="radio">
                            <input id="preferred-parttime" name="preferred_employment" type="radio" value="Permanent" <?php if ($this->row->emp_prefer === 'Permanent') echo 'checked'; ?>>
                            <label for="preferred-parttime"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME_PERMANENT; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-12 col-md-12">
                          <div class="submit-field">
                            <div class="bidding-widget">
                              <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->REFERS; ?> (Max. 5)</span>
                              <?php
                              if(count($this->references) == 0 || $this->references == 0 ) :
                              ?>
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
                              <?php
                              else:
                              $k=0;
                              foreach($this->references as $reference) :
                              ?>
                              <div class="row" id="refer<?php echo $k; ?>">
                                <div class="col-md-4">
                                  <input id="reference_name<?php echo $k; ?>" type="text" name="references_name[]" type="text" class="with-border" placeholder="John Doe" value="<?php echo $reference->reference; ?>">
                                </div>
                                <div class="col-md-4">
                                 <input id="reference_phone<?php echo $k; ?>" name="references_phone[]" maxlength="20" type="text" placeholder="(555) 555 55 55" class="with-border input-phone" value="<?php echo $reference->phone; ?>">
                                </div>
                                <div class="col-md-4">
                                  <input id="reference_email<?php echo $k; ?>" type="email" name="references_email[]" type="text" class="with-border" placeholder="johndoe@example.com" value="<?php echo $reference->email; ?>">
                                </div>
                              </div>
                              <?php $k++;endforeach;  endif;
                              ?>
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
                              <input id="portfolio-link" name="portfolio" type="text" class="with-border" value="<?php echo $this->row->portfolio; ?>" placeholder="<?php echo Lang::$word->PORTFOLIO_LINK_EXAMPLE; ?>">
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
                                <span id="cover-name"><?php echo $this->row->cv; ?></span>
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
                          <option <?php foreach ($this->uSkills as $uSkills) : if ($uSkills->id == $skills->id) echo 'selected';
                                                                                                                                            endforeach; ?> value="<?php echo $skills->id; ?>"><?php echo $skills->name; ?></option>

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
                          <option value="Google" <?php if($this->row->hearAbout == "Google") echo "selected";?>>Google</option>
                          <option value="Linkedn" <?php if($this->row->hearAbout == "Linkedn") echo "selected";?>>Linkedn</option>
                          <option value="3" <?php if($this->row->hearAbout != "Google" && $this->row->hearAbout != "Linkedn" && $this->row->hearAbout != "") echo "selected";?>>From a Friend/ Employee</option>
                        </select>
                        <input type="text" name="hearAbout" style="<?php if(!($this->row->hearAbout != "Google" && $this->row->hearAbout != "Linkedn" && $this->row->hearAbout != "")) echo "display:none";?>" class="hearAbout" placeholder="Fullname or Username" value="<?php echo $this->row->hearAbout;?>">
                      </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Save changes Button -->
            <div class="col-xl-12 margin-bottom-100 centered-button">
              <button type="button" id="save-button" name="dosubmit" data-action="doUpdate" form="register-form" class="wojo secondary button margin-top-30"><?php echo Lang::$word->SAVEC; ?></button>
            </div>
          </div>

        </form>
      </div>
      <!-- Dashboard Content / End -->

      </main>
</div>
</div>
</div>
<footer> Copyright ©2021 Remotify </footer>


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

    var refer = <?php echo count($this->references)-1;?>;
    $(".hear").change(function(){

      if($(this).val() == 3 || $(this).val() == 4)
      {
        $(".hearAbout").show(300);
        setTimeout(() => {
          $(".hearAbout").attr("value",'');
        }, 400);
      }else
      {
        $(".hearAbout").hide(300);
        setTimeout(() => {
          $(".hearAbout").attr("value",$(this).val());
        }, 400);
      }
    });

    $(".addRefer").click(function(){
      if(refer!=4)
      {
        var preReferLink = "#refer"+refer;
        refer++;
        var newReferLink = "#refer"+refer;
        var template = '<div class="row" style="display:none" id="refer'+refer+'"><div class="col-md-4"><input id="reference'+refer+'" type="text" name="references_name[]" type="text" class="with-border" placeholder="John Doe"></div><div class="col-md-4"><input id="reference'+refer+'" type="tel" name="references_phone[]" maxlength="20" type="text" placeholder="(555) 555 55 55" class="with-border input-phone"></div><div class="col-md-4"><input id="reference'+refer+'" type="email" name="references_email[]" type="text" class="with-border" placeholder="johndoe@example.com"></div></div>';
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

    $(".input-phone").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    }
   });

    /*An array containing all the language names in the world:*/
    let names = [<?php foreach ($this->languages as $v) : echo "'" . $v->name . "',";
                  endforeach; ?>];
    // array of the user current selected languages
    var langs = [<?php foreach ($this->uLanguages as $v) : echo "'" . strtolower($v->name) . "',";
                  endforeach; ?>];


$('#fixed-currency').on('change', function (e) {
      var data = {TRY:'icon-line-awesome-turkish-lira', USD: 'icon-line-awesome-usd'}, selectVal = $(this).val();

      $('#hourlyCurrency').removeClass().addClass(data[selectVal]);

    });

    $(".experience-card").click(function() {
      //$("input#experience").val($(this).find(".experience-level").html());
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

  <script src="/js/wow.js"></script>
  <!-- <script src="/js/script.js"></script> -->

</body>

</html>
