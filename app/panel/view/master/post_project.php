<?php

if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="icon" href="<?php echo SITEURL; ?>/assets/images/favicon.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $this->title; ?></title>

  <!-- Bootstrap CSS -->
  <link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('base.css', 'transition.css', 'label.css', 'form.css', 'dropdown.css', 'input.css', 'button.css', 'message.css', 'image.css', 'list.css', 'table.css', 'icon.css', 'card.css', 'editor.css', 'modal.css', 'tooltip.css', 'menu.css', 'progress.css', 'utility.css', 'style.css'), THEMEBASE); ?>" rel="stylesheet" type="text/css" />

  <link href="<?php echo THEMEURL; ?>/css/dashboard.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo THEMEURL; ?>/css/noman_custom.css" rel="stylesheet" type="text/css">
  <link href="<?php echo THEMEURL; ?>/css/blue.css" rel="stylesheet" type="text/css" />
  <link href="/css/bootstrap.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="<?php echo THEMEURL; ?>/css/custom-saq.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/jquery.js"></script>
  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/global.js"></script>
</head>

<body class="height-auto">
  <div class="page-wrapper">
    <div>
      <!-- Main Header-->
      <header class="main-header header-style-five background-inherit">
        <!--Header-Upper-->
        <div class="header-upper">
          <div class="auto-container">
            <div class="header-outer padding-top-10 padding-bottom-10">
              <div class="logo-box padding-bottom-0 padding-top-0">
                <div class="logo"><a href="<?php echo Url::url('/master'); ?>"><img src="/images/remotify-logo2.png" alt="" title=""></a></div>
              </div>

              <div class="nav-outer clearfix">

                <!-- Main Menu -->
                <nav class="main-menu navbar-expand-lg">

                  <div class="navbar-header">
                    <?php if ($this->isLoggedIn) : ?><div class="link-btn margin-right-20"><a href="<?php echo Url::url('/master'); ?>" class="theme-btn btn-style-one"><?php echo Lang::$word->DASH ?>
                          ></a></div><?php endif; ?>

                    <?php if (!$this->isLoggedIn) : ?>
                      <button class="navbar-toggler margin-top-8" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    <?php endif; ?>

                  </div>
                  <?php if (!$this->isLoggedIn) : ?>

                    <div class="navbar-collapse collapse scroll-nav" id="navbarSupportedContent">
                      <ul class="navigation">

                        <li class="padding-top-20 padding-bottom-15"><a href="/how-it-works.html" class=""><?php echo Lang::$word->WANT_WORK; ?></a></li>
                        <li class="padding-top-20 padding-bottom-15"><a href="/career.html" class="">Talent</a></li>
                        <li class="padding-top-20 padding-bottom-15"><a target="_blank" href="https://medium.com/remotifyco"><?php echo Lang::$word->BLOG; ?></a></li>
                        <li class="padding-top-20 padding-bottom-15">
                          <a href="/app/panel"><?php echo Lang::$word->LOGIN; ?></a>
                        </li>
                      </ul>
                    </div>
                  <?php endif; ?>
                </nav>
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
        <h1><?php echo Lang::$word->PRJ_PRJSTART; ?></h1>
      </div>
    </section>

    <div class="auto-container dashboard-container height-auto">
      <!-- Dashboard Content
    ================================================== -->
      <div class="container-fluid margin-bottom-50">
        <div class="row">
          <form id="project-form" method="POST" class="col-xl-12 margin-bottom-100">
            <div>
              <div class="row">
                <div class="col-xl-12 color-white padding-top-20 padding-bottom-40">
                  <h1><?php echo Lang::$word->WHAT_YOU_NEED; ?></h1>
                </div>
                <div class="col-xl-12 padding-bottom-30">
                  <p><?php echo Lang::$word->WHAT_YOU_NEED_DESC; ?></p>
                </div>
                <div class="col-xl-12 dashboard-box px-4 py-2">
                  <div class="row margin-top-20">
                    <div id="name-section" class="col-xl-12">
                      <div class="row">
                        <div class="col-xl-12 padding-bottom-5">
                          <h4 class="font-weight-700"><?php echo Lang::$word->PRJ_PRJNAME; ?></h4>
                        </div>
                        <div class="col-xl-12">
                          <input type="text" class="input-text with-border" id="project-name" name="name" placeholder="<?php echo Lang::$word->ANY_NAME; ?>" required="">
                        </div>
                        <div class="col-xl-12 padding-bottom-5">
                          <h4 class="font-weight-700"><?php echo Lang::$word->DESCRIPTION; ?></h4>
                        </div>
                        <div class="col-xl-12">
                          <div class="submit-field margin-bottom-5">
                            <textarea id="project-desc" cols="30" rows="5" name="description" class="with-border" placeholder="<?php echo Lang::$word->TSK_DESC; ?>"></textarea>
                            <div class="row">
                              <div class="col-xl-12 text-right">
                                <p id="counter"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12">
                          <div id="upload_section" class="margin-top-30 margin-bottom-30">
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
                          <div>
                            <button type="button" id="next-skills-button" class="wojo button color-bg-dark-blue"><?php echo Lang::$word->NEXT; ?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="skills-section" class="col-xl-12" style="display:none">
                      <div class="row">
                        <div class="col-xl-12 margin-bottom-10">
                          <h4><?php echo Lang::$word->SKILLS_REQUIRED; ?></h4>
                          <h6 id="minimum_skill_select" class="text-red hide-all"><?php echo Lang::$word->MINIMUM_ONE_SKILL; ?></h6>
                        </div>
                        <div class="col-xl-12">
                          <div class="row margin-bottom-20">
                            <?php $x = 1;
                            foreach ($this->skills as $skills) : ?>
                              <?php if ($x == 1 || $x == abs((count($this->skills) / 4)) + 1 || $x == (abs((count($this->skills) / 4)) * 2) + 1 || $x == (abs((count($this->skills) / 4)) * 3) + 1) echo '<div class="col-sm-6 col-md-3 col-xl-3">'; ?>
                              <div class="checkbox custom-check padding-right-10 margin-bottom-7 col-xl-12">
                                <input type="checkbox" id="<?php echo $skills->id; ?>" name="skills[]" data-text="<?php echo $skills->name; ?>" value="<?php echo $skills->id; ?>">
                                <label class="margin-bottom-0 padding-left-25" for="<?php echo $skills->id; ?>"><span class="checkbox-icon"></span><?php echo $skills->name; ?></label>
                              </div>
                              <?php if ($x == abs(count($this->skills)) || $x == abs((count($this->skills) / 4)) || $x == (abs((count($this->skills) / 4)) * 2) || $x == (abs((count($this->skills) / 4)) * 3)) echo '</div>'; ?>
                              <?php ++$x; ?>

                            <?php endforeach; ?>
                          </div>
                        </div>
                        <div class="col-xl-12 padding-top-25 padding-bottom-15">
                          <h4 class="font-weight-700"><?php echo Lang::$word->SKILL_LEVEL; ?></h4>
                        </div>
                        <div class="col-xl-12">
                          <div class="submit-field">
                            <select class="form-select with-border" id="skill-level" name="skill_level" data-size="4" title="skill level">
                              <option value="junior"><?php echo Lang::$word->JUNIOR; ?></option>
                              <option value="mid"><?php echo Lang::$word->MID; ?></option>
                              <option value="senior"><?php echo Lang::$word->SENIOR; ?></option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-12 margin-bottom-20 d-flex justify-content-end">

                          <div>
                            <button type="button" id="next-payment-button" class="wojo button color-bg-dark-blue"><?php echo Lang::$word->NEXT; ?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="payment-section" class="col-xl-12" style="display:none">
                      <div class="row">
                        <div class="col-xl-12 padding-top-15 padding-bottom-10">
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
                        <div class="col-xl-12 padding-top-15 padding-bottom-15 budget">
                          <h4 class="font-weight-700"><?php echo Lang::$word->PRJ_BUDGET; ?></h4>
                        </div>
                        <div class="col-xl-12 fixed-budget">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="submit-field">
                                <select class="form-select with-border" data-size="2" id="fixed-currency" name="fixed_currency" title="fixed-Currency">
                                  <option value="<?php echo Lang::$word->TRY; ?>"><?php echo Lang::$word->TRY; ?></option>
                                  <option value="<?php echo Lang::$word->USD; ?>"><?php echo Lang::$word->USD; ?></option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="submit-field">
                                <select id="fixed-budget" name="fixed_budget" class="form-select with-border" data-size="2" title="Select Pay">
                                  <?php foreach ($this->budgets as $budget) : ?>
                                    <?php if ($budget->type === "fixed" || $budget->type === "customize") : ?>
                                      <option value="<?php echo $budget->id; ?>">
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
                                <select class="form-select with-border" data-size="2" id="hourly-budget" name="hourly_budget" title="Select Pay">
                                  <?php foreach ($this->budgets as $budget) : ?>
                                    <?php if ($budget->type === "hourly" || $budget->type === "customize") : ?>
                                      <option value="<?php echo $budget->id; ?>">
                                        <?php
                                        if ($budget->type !== "customize" && $budget->maximum != 0) echo $budget->name . " (" . $budget->minimum . " - " . $budget->maximum . " " . Lang::$word->TRY . ")";
                                        else if ($budget->type !== "customize" && $budget->maximum == 0) echo $budget->name . " (" . $budget->minimum . "+ <span>" . Lang::$word->TRY . "</span>)";
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
                        <div id="custom_budget_section" class="col-xl-12 hide-all">
                          <div class="row">
                            <div class="col-xl-12 padding-top-15 padding-bottom-15">
                              <h4 class="font-weight-700"><?php echo Lang::$word->CUSTOM_BUDGET; ?></h4>
                            </div>
                            <div class="col-xl-12 margin-bottom-20">
                              <div class="row">
                                <div class="col-md-6">
                                  <label for="min_budget"><?php echo Lang::$word->MIN_R1; ?></label>
                                  <input type="number" id="min_budget" name="min">
                                </div>
                                <div class="col-md-6">
                                  <label for="max_budget"><?php echo Lang::$word->MAX_R1; ?></label>
                                  <input type="number" id="max_budget" name="max">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12 margin-bottom-20 d-flex justify-content-end">

                          <div>
                            <button type="button" id="next-summary-button" class="wojo button color-bg-dark-blue"><?php echo Lang::$word->NEXT; ?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="summary-section" class="col-xl-12" style="display:none">
                      <div class="row">
                        <div class="col-xl-12 padding-top-20 padding-bottom-10">
                          <h4 class="font-weight-700"><?php echo Lang::$word->CORRECT_DETAILS; ?></h4>
                        </div>
                        <div class="col-xl-12">
                          <div class="box-shadow padding-top-20 padding-bottom-40 px-1">
                            <div class="row">
                              <div class="col-xl-3 col-md-4 col-sm-12 border-right padding-bottom-5">
                                <div class="row">
                                  <div class="col-sm-12 text-center"> <i class="font-80 color-blue icon-material-outline-desktop-windows"></i></div>
                                  <div class="col-sm-12 text-center">
                                    <p id="project-payment-summary"></p>
                                  </div>
                                  <div class="col-sm-12 text-center">
                                    <h5><span id="project-currency-summary"></span></h5>
                                    <h6><span id="project-budget-summary"></span></h6>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-9 col-md-8 col-sm-12 padding-bottom-5">
                                <div class="row">
                                  <div class="col-xl-12">
                                    <h6 id="project-name-summary"></h6>
                                  </div>

                                  <div id="project-desc-summary" class="col-xl-12">
                                  </div>
                                  <div class="col-xl-12">
                                    <?php echo Lang::$word->SKILLS . ": "; ?>
                                    <span id="project-skills-summary"></span>
                                  </div>
                                  <div class="col-xl-12">
                                    <?php echo Lang::$word->SKILLS . " " . Lang::$word->LEVEL . ": "; ?>
                                    <span id="project-skill-level-summary"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12 margin-top-20 margin-bottom-20 d-flex justify-content-end">
                          <div>
                            <button type="button" id="post-projectform" class="wojo secondary button"><?php echo Lang::$word->POST_PROJECT; ?></button>
                          </div>
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
                  <div class="col-xl-12 d-flex flex-row justify-content-end">
                    <div>
                      <button id="verif-next-button" type="button" class="wojo button step-2-button"><?php echo Lang::$word->NEXT; ?></button>
                    </div>
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
        </div>
      </div>
      <!-- Dashboard Content / End -->

    </div>
  </div>


  <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/editor/trumbowyg.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
  <script src="<?php echo THEMEURL; ?>/js/login.js"></script>
  <script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {
      $.Login({
        url: "<?php echo FRONTVIEW; ?>",
        surl: "<?php echo SITEURL; ?>",
        postProject: true,
      });

      $('#project-desc').keyup(function() {
        var left = 100 - $(this).val().length;
        if (left < 0) {
          left = 0;
        }
        $('#counter').text('Minimum required: ' + left);
      });
    });
    // ]]>
  </script>


  <script src="<?php echo ADMINVIEW; ?>/js/js/jquery-migrate-3.3.1.min.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/tippy.all.min.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/simplebar.min.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/bootstrap-slider.min.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/snackbar.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/clipboard.min.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/magnific-popup.min.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/slick.min.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/js/custom.js"></script>
  <script src="<?php echo ADMINVIEW; ?>/js/master.js"></script>

  <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fas fa-angle-up"></span></div>
  <script src="/js/wow.js"></script>
  <!-- <script src="/js/popper.min.js"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="/js/pagenav.js"></script>
  <!-- <script src="/js/bootstrap.min.js"></script> -->
  <script src="/js/script.js"></script>


</body>

</html>