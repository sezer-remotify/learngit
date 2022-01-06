<?php

if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
if ($this->isLoggedIn && !App::Auth()->is_Client()) {
  Url::redirect(SITEURL . '/');
  exit;
}
if ($this->isLoggedIn && !Auth::$udata->is_completed) {
  Url::redirect(SITEURL . '/master/profile/edit');
  exit;
}
?>

  <?php include("header.tpl.php")?>
    <div class="auto-container dashboard-container height-auto">
      <!-- Dashboard Content
    ================================================== -->
      <div class="container-fluid margin-bottom-50">
        <div class="row">
          <form id="project-form" method="POST" class="col-xl-12 margin-bottom-100">
            <div>
              <div class="row">
                <div class="col-xl-12 color-black padding-top-20 padding-bottom-40">
                  <h1><?php echo Lang::$word->WHAT_YOU_NEED; ?></h1>
                </div>
                <!--<div class="col-xl-12 padding-bottom-30">-->
                <!--  <p><?php echo Lang::$word->WHAT_YOU_NEED_DESC; ?></p>-->
                <!--</div>-->
                <div class="col-xl-12 dashboard-box">
                  <div class="row margin-top-20">
                    <div id="name-section" class="row col-xl-12 margin-left-0 margin-right-0">
                      <div class="col-xl-12">
                        <div class="section-headline margin-top-25 margin-bottom-5">
                          <h4 class="font-weight-700"><?php echo Lang::$word->WORK_TYPE; ?></h4>
                        </div>
                        <div class="radio">
                          <input id="parttime" name="work_type" checked="" type="radio" value="Part-Time">
                          <label for="parttime"><span class="radio-label"></span><?php echo Lang::$word->HOURLY; ?></label>
                        </div>
                        <br>
                        <div class="radio">
                          <input id="projectbased" name="work_type" type="radio" value="Project Based">
                          <label for="projectbased"><span class="radio-label"></span><?php echo Lang::$word->PROJECT_BASED; ?></label>
                        </div>
                        <?php /*
                        <div class="radio">
                          <input id="contract" name="work_type" type="radio"  value="Full-Time Contract">
                          <label for="contract"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME_CONTRACT; ?></label>
                        </div>
                        <br>
                        <br>
                        <div class="radio">
                          <input id="fulltime" name="work_type" type="radio" value="Full-Time">
                          <label for="fulltime"><span class="radio-label"></span><?php echo Lang::$word->FULLTIME; ?></label>
                        </div>*/?>
                        <div class="section-headline margin-top-20">
                          <h4 class="font-weight-700"><?php echo Lang::$word->PROMOTION_CODE . " (" . Lang::$word->OPTIONAL . ")"; ?></h4>
                        </div>
                        <input type="text" class="input-text with-border" id="promo_code" name="promo_code" placeholder="<?php echo Lang::$word->PROMOTION_CODE; ?>">
                      </div>
                      <div class="col-xl-12 margin-bottom-20 d-flex justify-content-end">
                        <button type="button" id="next-fulltime-button" class="wojo button color-bg-dark-blue"><?php echo Lang::$word->NEXT; ?></button>
                      </div>
                    </div>
                    <div id="projectbased-section" class="row col-xl-12 margin-left-0 margin-right-0" style="display: none;">
                      <div class="col-xl-12">
                        <h4 class="font-weight-700"><?php echo Lang::$word->PRJ_PRJNAME; ?></h4>
                      </div>
                      <div class="col-xl-12">
                        <input type="text" class="input-text with-border" id="project-name" name="name" placeholder="<?php echo Lang::$word->ANY_NAME; ?>">
                          <div class="row">
                            <div class="col-xl-12 text-right">
                              <p id="counterpname"></p>
                            </div>
                          </div>
                      </div>
                      <div class="col-xl-12">
                        <h4 class="font-weight-700"><?php echo Lang::$word->DESCRIPTION; ?></h4>
                      </div>
                      <div class="col-xl-12">
                        <div class="submit-field">
                          <textarea id="project-desc" cols="30" rows="5" name="description" class="with-border" placeholder="<?php echo Lang::$word->TSK_DESC; ?>"></textarea>
                          <div class="row">
                            <div class="col-xl-12 text-right">
                              <p id="counter"></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <div id="upload_section" class=" margin-bottom-30">
                          <div class="padding-bottom-20 padding-top-20 padding-right-20 padding-left-20 border-striped">
                            <div class="row">
                              <div class="col-xl-12">
                                <div class="uploadButton margin-top-15">
                                  <input class="uploadButton-input" type="file" accept="image/*, application/pdf" name="file[]" id="project-upload" multiple="">
                                  <label class="uploadButton-button ripple-effect" for="project-upload"><i class="icon-material-outline-add"></i><?php echo Lang::$word->FMG_UPLFILES; ?></label>
                                  <span class="uploadButton-file-name"><?php echo Lang::$word->UPLOAD_DESC; ?></span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-12 margin-bottom-20 d-flex justify-content-end">
                        <button type="button" id="next_2" class="wojo button color-bg-dark-blue"><?php echo Lang::$word->NEXT; ?></button>
                      </div>
                    </div>
                    <div id="fulltime-section" class="row col-xl-12 margin-left-0 margin-right-0" style="display:none">
                      <div class="col-xl-12">
                        <div class="section-headline">
                          <h4 class="font-weight-700"><?php echo Lang::$word->NO_DEVS; ?></h4>
                        </div>
                        <div class="radio">
                          <input id="one" name="no_devs" type="radio" checked="" value="1">
                          <label for="one"><span class="radio-label"></span><?php echo Lang::$word->ONE; ?></label>
                        </div>
                        <br>
                        <div class="radio">
                          <input id="more-one" name="no_devs" type="radio" checked="" value="2">
                          <label for="more-one"><span class="radio-label"></span><?php echo Lang::$word->MORE_ONE; ?></label>
                        </div>
                        <br>
                        <div class="radio">
                          <input id="dont-know" name="no_devs" type="radio" checked="" value="0">
                          <label for="dont-know"><span class="radio-label"></span><?php echo Lang::$word->DONT_KNOW; ?></label>
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <div class="section-headline margin-top-20 margin-bottom-12">
                          <h4 class="font-weight-700"><?php echo Lang::$word->SKILL_LEVEL; ?></h4>
                        </div>
                        <div class="radio">
                          <input id="junior" name="skill_level" type="radio" checked="" value="junior">
                          <label for="junior"><span class="radio-label"></span><?php echo Lang::$word->JUNIOR; ?></label>
                        </div>
                        <br>
                        <div class="radio">
                          <input id="mid" name="skill_level" type="radio" checked="" value="mid">
                          <label for="mid"><span class="radio-label"></span><?php echo Lang::$word->MID; ?></label>
                        </div>
                        <br>
                        <div class="radio">
                          <input id="senior" name="skill_level" type="radio" checked="" value="senior">
                          <label for="senior"><span class="radio-label"></span><?php echo Lang::$word->SENIOR; ?></label>
                        </div>
                      </div>
                      <div class="col-xl-12 margin-top-20" style="display:none;">
                        <h4 class="font-weight-700"><?php echo Lang::$word->PRO_TYPE; ?></h4>
                      </div>
                      <div class="col-xl-12 padding-top-5 padding-bottom-15" style="display:none;" id="type_container">
                      <select class="js-example-basic-multiple" name="job_type">
                      <option value="OPT"></option>
                        </select>
                        
                        
                      </div>
                      <div class="col-xl-12 margin-top-20 skills">
                        <h4 class="font-weight-700"><?php echo Lang::$word->SKILLS; ?></h4>
                        <h6 id="minimum_skill_select" class="text-red hide-all"><?php echo Lang::$word->MINIMUM_ONE_SKILL; ?></h6>
                      </div>
                      <div class="col-xl-12 padding-top-5 padding-bottom-15" id="skills_container">
                      <select class="js-example-basic-multiple" name="skills[]" multiple="multiple">
  
                          <?php $x = 1;
                          foreach ($this->skills as $skills) : ?>
                          <option value="<?php echo $skills->id; ?>" <?=($skills->name == 'html' || $skills->name == 'Html' || $skills->name == 'HTML') ? 'selected' : '';?>><?php echo $skills->name; ?></option>

                          <?php endforeach; ?>
                        </select>
                        
                        
                      </div>
                      <div class="col-xl-12 padding-top-5 padding-bottom-10">
                        <h4 class="font-weight-700"><?php echo Lang::$word->ADM_PAYMENTS; ?></h4>
                      </div>
                      <div class="col-xl-12 d-flex justify-content-between">
                        <div class="m-2">
                          <label for="fixed-price" class="fixed-price-box hover-box box-shadow pointer border-active">
                            <div class="row">
                              <div class="col-sm-4 margin-top-35 padding-bottom-30 text-center">
                                <i class="font-80 color-blue icon-material-outline-lock"></i>
                              </div>
                              <div class="col-sm-8">
                                <div class="row padding-top-20 padding-right-5 padding-left-5">
                                  <div class="col-xl-12">
                                    <h5><?php echo Lang::$word->FIXED_PAY; ?></h5>
                                  </div>
                                  <div class="col-xl-12">
                                    <p class="font-12"><?php echo Lang::$word->FIXED_PAY_DESC; ?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="m-2">
                          <label for="hourly-price" class="box-shadow hourly-priced-box hover-box pointer">
                            <div class="row">
                              <div class="col-sm-4 margin-top-35 padding-bottom-30 text-center">
                                <i class="font-80 color-blue icon-line-awesome-clock-o"></i>
                              </div>
                              <div class="col-sm-8">
                                <div class="row padding-top-20 padding-right-5 padding-left-5">
                                  <div class="col-xl-12">
                                    <h5><?php echo Lang::$word->HOURLY_PAY; ?></h5>
                                  </div>
                                  <div class="col-xl-12">
                                    <p class="font-12"><?php echo Lang::$word->HOURLY_PAY_DESC; ?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </label>
                        </div>

                      </div>
                      <input name="project_type" class="hidden" type="radio" id="fixed-price" value="fixed" checked>
                      <input name="project_type" class="hidden" type="radio" id="hourly-price" value="hourly">

                      <div class="col-xl-12">
                        <h4 class="font-weight-700"><?php echo Lang::$word->CFG_SCURRENCY_S; ?></h4>
                      </div>
                      <div class="col-xl-12 fixed-budget">
                        <div class="row">
                          <div class="col-md-2">
                            <div class="submit-field">
                              <select class="form-select with-border" data-size="2" id="fixed-currency" name="fixed_currency" title="fixed-Currency" >
                                <option value="<?php echo Lang::$word->TRY; ?>"><?php echo Lang::$word->TRY; ?></option>
                                <option value="<?php echo Lang::$word->USD; ?>"><?php echo Lang::$word->USD; ?></option>
                              </select>
                            </div>
                          </div>
                        <div class="col-md-10">
                            <div class="submit-field">
                              <select id="fixed-budget"  style="opacity:0" name="fixed_budget" class="form-select with-border" data-size="2" title="Select Pay" style=" padding: 0 15px; ">
                                <?php foreach ($this->budgets as $budget) : ?>
                                  <?php if (/*$budget->type === "fixed" ||*/ $budget->type === "customize") : ?>
                                    <option selected value="<?php echo $budget->id; ?>">
                                      <?php
                                      if ($budget->type !== "customize" && $budget->maximum != 0) echo $budget->name . " (" . $budget->minimum . " - " . $budget->maximum . " " . Lang::$word->TRY . ")";
                                      else if ($budget->type !== "customize" && $budget->maximum == 0) echo $budget->name . " (" . $budget->minimum . "+ " . Lang::$word->TRY . ")";
                                      else echo $budget->name;
                                      ?>
                                    </option>
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-12 hourly-budget hidden">
                        <div class="row">
                          <div class="col-md-2">
                            <div class="submit-field">
                              <select class="form-select with-border" data-size="2" id="hourly-currency" name="hourly_currency" title="Currency">
                                <option value="<?php echo Lang::$word->TRY; ?>"><?php echo Lang::$word->TRY; ?></option>
                                <option value="<?php echo Lang::$word->USD; ?>"><?php echo Lang::$word->USD; ?></option>
                              </select>
                            </div>
                          </div>
                      <div class="col-md-10">
                            <div class="submit-field">
                              <select style="opacity:0" class="form-select with-border" data-size="2" id="hourly-budget" name="hourly_budget" title="Select Pay">
                              <?php foreach ($this->budgets as $budget) : ?>
                                  <?php if (/*$budget->type === "fixed" ||*/ $budget->type === "customize") : ?>
                                    <option selected value="<?php echo $budget->id; ?>">
                                      <?php
                                      if ($budget->type !== "customize" && $budget->maximum != 0) echo $budget->name . " (" . $budget->minimum . " - " . $budget->maximum . " " . Lang::$word->TRY . ")";
                                      else if ($budget->type !== "customize" && $budget->maximum == 0) echo $budget->name . " (" . $budget->minimum . "+ " . Lang::$word->TRY . ")";
                                      else echo $budget->name;
                                      ?>
                                    </option>
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="custom_budget_section" class="col-xl-12">
                        <div class="row">
                          <div class="col-xl-12">
                            <h4 class="font-weight-700"><?php echo Lang::$word->CUSTOM_BUDGET; ?></h4>
                          </div>
                          <div class="col-xl-12 margin-bottom-20">
                            <div class="row">
                              <div class="col-md-6">
                                <label for="min_budget"><?php echo Lang::$word->MIN_R1; ?></label>
                                <input type="number" id="min_budget" name="min" value="0">
                              </div>
                              <div class="col-md-6">
                                <label for="max_budget"><?php echo Lang::$word->MAX_R1; ?></label>
                                <input type="number" id="max_budget" name="max" value="0">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <h4 class="font-weight-700"><?php echo Lang::$word->START_TIME; ?></h4>
                      </div>
                      <div class="col-xl-12">
                        <input type="date" class="input-date with-border" id="start-time" name="start_time">
                      </div>
                      <div class="col-xl-12 margin-bottom-20 d-flex justify-content-end">
                        <div>
                          <button type="button" id="fulltime-submit-btn" name="postProject" class="wojo secondary button"><?php echo Lang::$word->POST_PROJECT; ?></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <form id="loginform" class="margin-top-25 hide-all container">
            <div class="row justify-content-center">
              <div class="col-xl-6">
                <div class="wrapper fadeInDown">
                  <div id="formContent">
                    <!-- Tabs Titles -->
                    <h5 class="margin-bottom-20"><?php echo Lang::$word->LOGIN; ?></h5>

                    <!-- login Form -->
                    <div class=" wojo block fields">
                      <div class="field">
                        <div class="wojo icon input">
                          <i class="icon email alt"></i>
                          <input type="email" id="login-email" class="fadeIn second margin-0" name="email" placeholder="<?php echo Lang::$word->EMAIL; ?>">
                        </div>
                      </div>
                      <div class="field">
                        <div class="wojo icon input">
                          <i class="icon lock"></i>
                          <input type="password" id="login-password" class="fadeIn third margin-0" autocomplete name="password" placeholder="<?php echo Lang::$word->PASSWORD; ?>">
                          <i class="eye-toggler icon icon-feather-eye font-18"></i>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between margin-top-20">
                      <div>
                        <button type="button" class="wojo button gray closeRegistration"><?php echo Lang::$word->BACK; ?></button>
                      </div>
                      <div>
                        <button id="signup" type="button" class="color-blue"><?php echo Lang::$word->NO_ACCOUNT; ?>
                          <strong><?php echo Lang::$word->REGISTER; ?></strong>
                        </button>
                      </div>
                      <div>
                        <button name="doLogin" type="button" class="wojo button"><?php echo Lang::$word->LOGIN; ?>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <form id="step-1" class="margin-top-25 hide-all container">
            <div class="row justify-content-center">
              <div class="col-xl-6">
                <div class="wrapper fadeInDown">
                  <div id="formContent">
                    <!-- Tabs Titles -->
                    <h5 class="margin-bottom-20"><?php echo Lang::$word->REGISTER; ?></h5>

                    <!-- Signup Form -->
                    <div class=" wojo block fields">
                      <div class="field">
                        <div class="wojo icon input">
                          <i class="icon email alt"></i>
                          <input type="email" id="email" class="fadeIn second margin-0" name="registerEmail" placeholder="<?php echo Lang::$word->EMAIL; ?>">
                        </div>
                      </div>
                      <div class="field">
                        <div class="wojo icon input">
                          <i class="icon lock"></i>
                          <input type="password" id="password" class="fadeIn third margin-0" name="registerPassword" autocomplete placeholder="<?php echo Lang::$word->PASSWORD; ?>">
                          <i class="eye-toggler icon icon-feather-eye font-18"></i>
                        </div>
                      </div>
                    </div>
                    <div id="two-step-checkbox" class="checkbox margin-top-20 margin-bottom-20">
                      <input type="checkbox" name="agreement" id="two-step">
                      <label for="two-step"><span id="checkbox-icon" class="checkbox-icon" title="Check!"></span><?php echo Lang::$word->AGREE_TO ?>
                        <a href="#"><?php echo Lang::$word->USER_AGREEMENT ?></a> <?php echo Lang::$word->AND ?> <a href="#"><?php echo Lang::$word->PRIVACY ?></a></label>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between">
                      <div>
                        <button type="button" class="wojo button gray closeRegistration"><?php echo Lang::$word->BACK; ?></button>
                      </div>
                      <div>
                        <button type="button" id="loginPage" class="color-blue"><?php echo Lang::$word->HAVE_ACCOUNT; ?>
                          <strong><?php echo Lang::$word->LOGIN; ?></strong></button>
                      </div>
                      <div>
                        <button type="button" class="wojo button step-1-button"><?php echo Lang::$word->NEXT; ?></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <div id="step-2" class="margin-top-25 hide-all container">
            <div class="row justify-content-center">
              <div class="col-xl-6">
                <div class="row font-18 padding-left-20 padding-right-20">
                  <div class="col-xl-11 text-center">
                    <img src="<?php echo THEMEURL; ?>/images/remotify-logo.png" alt="logo" class="width-50">
                  </div>
                  <div class="col-xl-11 text-center padding-top-20">
                    <i class="font-40 color-blue icon-material-outline-email"></i>
                  </div>
                  <div class="col-xl-12 padding-top-20 margin-bottom-20">
                    <p class="font-18"><?php echo Lang::$word->EM_VER_SENT; ?></p>
                  </div>
                  <div class="col-xl-12 d-flex margin-top-20 margin-bottom-20">
                    <button type="button" class="wojo secondary flex-grow-1 margin-right-2 button resend-email"><?php echo Lang::$word->RESEND_EMAIL; ?></button>
                    <button type="button" class="wojo secondary flex-grow-1 button step-2-button"><?php echo Lang::$word->NEXT; ?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="step-3" class="margin-top-25 hide-all container">
            <div class="row justify-content-center">
              <div class="col-xl-6">
                <div class="wrapper fadeInDown">
                  <div id="formContent">
                    <!-- Tabs Titles -->
                    <h5 class="margin-bottom-20"><?php echo Lang::$word->CHOOSE_U; ?></h5>
                    <div class="col-xl-12 padding-left-0 padding-bottom-0 padding-top-0">
                      <p><?php echo Lang::$word->CANT_CH_U; ?></p>
                    </div>

                    <!-- Login Form -->
                    <input type="text" id="username" name="username" class="fadeIn second" placeholder="<?php echo Lang::$word->USERNAME; ?>">
                    <div class="d-flex flex-row justify-content-end margin-bottom-20">
                      <div>
                        <input type="hidden" name="u">
                        <input type="hidden" name="p">
                        <button id="signup-button" type="button" class="wojo button step-3-button"><?php echo Lang::$word->REGISTER; ?></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include(MASTERBASE . '/snippets/_client_profile_form.tpl.php'); ?>
        </div>
      </div>
      <!-- Dashboard Content / End -->

    </div>
  </div>


  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/editor/trumbowyg.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
  <script type="text/javascript">
  $(document).ready(function() {
  $('.js-example-basic-multiple').select2();
});
    // <![CDATA[
    $(document).ready(function() {
      $.Login({
        url: "<?php echo MASTERVIEW; ?>",
        surl: "<?php echo SITEURL; ?>",
        postProject: true,
      });
      
      $('#project-name').keyup(function() {
        var left = 10 - $(this).val().length;
        if (left < 0) {
          left = 0;
        }
        $('#counterpname').text('Minimum required: ' + left);
      });
      $('#project-desc').keyup(function() {
        var left = 50 - $(this).val().length;
        if (left < 0) {
          left = 0;
        }
        $('#counter').text('Minimum required: ' + left);
      });
    });
    // ]]>
  </script>

  <script src="<?php echo MASTERVIEW; ?>/js/js/jquery-migrate-3.3.1.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/mmenu.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/tippy.all.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/simplebar.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/bootstrap-slider.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/snackbar.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/clipboard.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/magnific-popup.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/slick.min.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/js/custom.js"></script>
  <script src="<?php echo MASTERVIEW; ?>/js/master.js"></script>

  <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fas fa-angle-up"></span></div>
  <script src="/.old/js/wow.js"></script>
  <!-- <script src="/js/popper.min.js"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="/.old/js/pagenav.js"></script>
  <!-- <script src="/js/bootstrap.min.js"></script> -->
  <script src="/.old/js/script.js"></script>

  <script>
    function showPassword(icon) {
      var passForm = icon.previousElementSibling;
      if (passForm.type == 'password') {
        passForm.type = 'text';
        icon.classList.add('icon-feather-eye-off');
      } else {
        passForm.type = 'password';
        icon.classList.remove('icon-feather-eye-off');
      }
    }
  </script>


</body>
<?php include("footer.tpl.php")?>
</html>