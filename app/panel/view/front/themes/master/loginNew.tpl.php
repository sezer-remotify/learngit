<?php

if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div class="auto-container dashboard-container height-auto margin-top-100">
  <div class="container">
    <div class="row">
      <div class="col-xl-5 offset-xl-3">
        <!-- Form -->
        <div class="wojo login">
          <div class="wojo login-form">
            <form id="loginform" class=" <?php if (!$this->loginform) echo "hide-all"; ?>">
              <div class="login-register-page">
                <!-- Welcome Text -->
                <div class="welcome-text">
                  <h3><?php echo Lang::$word->LOGIN; ?></h3>
                </div>
                <!-- Social Login -->
                <div class="social-login-separator" style="display:none;">
                   <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=78dqfnxibe34q2&redirect_uri=https%3A%2F%2Fremotify.co%2Fapp%2Fpanel%2Fauth%2Flinkedin%2Fcallback&state=622633783&scope=r_liteprofile%20r_emailaddress" class="linkedn_button"><i class="fab fa-linkedin"></i><?php echo Lang::$word->LINKEDIN_LOGIN; ?></a>
                  </div>
                <div class="wojo block fields">
                  <div class="field">
                    <div class="wojo icon input">
                      <i class="icon email alt"></i>
                      <input type="email" class="margin-0" placeholder="<?php echo Lang::$word->EMAIL; ?>" name="email">
                    </div>
                  </div>
                  <div class="field">
                    <!-- <i class="icon-material-outline-lock"></i> -->
                    <div class="wojo icon input">
                      <i class="icon lock"></i>
                      <input type="password" class="margin-0" autocomplete placeholder="<?php echo Lang::$word->PASSWORD; ?>" name="password">
                      <i class="icon icon-feather-eye font-18 eye-toggler pointer"></i>
                    </div>
                  </div>
                  <button type="button" name="doLogin"
                    class="wojo secondary button margin-bottom-20 btn-one" style="width:91%!important;"><?php echo Lang::$word->LOGIN; ?></button>
                  <div class="welcome-text margin-bottom-0">
                    <span><?php echo Lang::$word->NO_ACCOUNT; ?> <a id="signup"><?php echo Lang::$word->REGISTER; ?>!</a></span>
                  </div>
                  <div class="welcome-text">
                    <span class="margin-bottom-10"> <a id="passreset" class="grey forgot-password"><?php echo Lang::$word->PASSWORD_L; ?>?</a></span>
                  </div>
                </div>
              </div>
            </form>
            <div id="passform" class="hide-all">
              <div class="wojo block fields">
                <div class="welcome-text">
                  <h3><?php echo Lang::$word->FORGOT_PASS; ?></h3>
                </div>
                <div class="field">
                  <div class="wojo icon input">
                    <i class="icon user alt"></i>
                    <input type="text" class="margin-0" name="fname" placeholder="<?php echo Lang::$word->FNAME; ?>">
                  </div>
                </div>
                <div class="field">
                  <div class="wojo icon input">
                    <i class="icon email alt"></i>
                    <input type="text" name="forgotEmail" class="margin-0" placeholder="<?php echo Lang::$word->EMAIL; ?>">
                  </div>
                </div>
                <div class="field">
                  <button type="button" name="doPass" class="wojo secondary button"><?php echo Lang::$word->SUBMIT; ?></button>
                </div>
                <!-- Social Login -->
                <div class="social-login-separator"></div>
                <input type="hidden" name="u" value="">
                <input type="hidden" name="p" value="">
                <div class="welcome-text">
                  <span><a id="backto"><?php echo Lang::$word->BACKTOLOGIN; ?>!</a></span>
                </div>
              </div>
            </div>
            <form id="step-1" class="<?php if (!$this->registerform) echo "hide-all"; ?>">
              <div class="wojo block fields">
                <!-- Welcome Text -->
                <div class="welcome-text">
                  <h3><?php echo Lang::$word->REGISTER; ?></h3>
                </div>
                <div class="field">
                  <div class="wojo icon input">
                    <i class="icon email alt"></i>
                    <input type="text" name="registerEmail" id="registerEmail" data-tippy-content="Hotmail accounts not allowed" class="margin-0"
                      title="<?php echo Lang::$word->NO_HOTMAIL; ?>" placeholder="<?php echo Lang::$word->EMAIL; ?>">
                  </div>
                </div>
                <div class="field">
                  <div class="wojo icon input">
                    <i class="icon lock alt"></i>
                    <input type="password" name="registerPassword" class="margin-0" autocomplete placeholder="<?php echo Lang::$word->PASSWORD; ?>">
                    <i class="icon icon-feather-eye font-18 eye-toggler pointer"></i>
                  </div>
                </div>

                <div>
                  <span><input id="terms-and-conditions" name="agreement" class="margin-right-5" type="checkbox"><?php echo Lang::$word->AGREE_TO; ?>
                    <a href="https://remotify.co/termscondition/"><?php echo Lang::$word->USER_AGREEMENT; ?></a> and <a href="https://remotify.co/privacy-policy/"><?php echo Lang::$word->PRIVACY; ?></a></span>
                </div>

                <!-- Button -->
                <button type="button" class="wojo secondary button step-1-button margin-top-20 btn-one"><?php echo Lang::$word->REGISTER; ?>
                </button>
                <!-- Social Login -->
                <div class="social-login-separator"></div>
                <div class="welcome-text">
                  <span><?php echo Lang::$word->HAVE_ACCOUNT; ?> <a id="loginPage"><?php echo Lang::$word->LOGIN; ?>!</a></span>
                </div>
              </div>
            </form>
            <div id="step-2" class="hide-all">
              <div class="container">
                <div class="welcome-text">
                  <h3><?php echo Lang::$word->REGISTER; ?></h3>
                </div>
                <div class="row font-18 ">
                  <div class="wojo block fields">
                    <div class="text-center">
                      <i class="font-80 color-blue icon-material-outline-email"></i>
                    </div>
                    <div class="padding-top-20 text-center">
                      <p class="font-18"><?php echo Lang::$word->EM_VER_SENT ?></p>
                    </div>
                    <div class="d-flex">
                      <button type="button"
                        class="wojo secondary flex-grow-1 margin-right-2 button resend-email margin-top-20 margin-bottom-20 btn-two"><?php echo Lang::$word->RESEND_EMAIL; ?></button>
                      <button type="button"
                        class="wojo secondary flex-grow-1 button step-2-button margin-top-20 margin-bottom-20 btn-one"><?php echo Lang::$word->NEXT; ?></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="step-3" class="hide-all">
              <div class="container">
                <div class="row font-18">
                  <div class="wojo block fields">

                    <h3><?php echo Lang::$word->CHOOSE_PL; ?></h3>
                    <div class="padding-left-0 padding-bottom-10 padding-top-15">
                      <p><?php echo Lang::$word->CANT_CH_PL; ?></p>
                    </div>

                    <div class="field width-100">
                      <div class="wojo icon input">
                        <i class="icon user alt"></i>
                        <input type="text" class="margin-0" name="username" id="username-register" placeholder="<?php echo Lang::$word->PROFILE_LINK; ?>">
                      </div>
                    </div>
                    <button type="button"
                      class="wojo secondary button step-3-button margin-top-20 margin-bottom-20 width-100 btn-one"><?php echo Lang::$word->NEXT; ?></button>

                  </div>
                </div>
              </div>
            </div>
            <div id="step-4" class="hide-all">
              <div class="container">
                <div class="row label-classes">
                  <div class="col-xl-12 padding-top-20">
                    <h2><strong><?php echo Lang::$word->SELECT_ACC; ?></strong></h2>
                  </div>
                  <div class="col-xl-12">

                  </div>
                  <div class="col-xl-12" id="work" data-type="work">
                    <label for="want_to_work">
                      <div
                        class="row margin-top-20 padding-top-20 padding-bottom-20 border want_to_work pointer background-hover-blue border-hover-blue">
                        <div class="col-sm-4 d-flex align-items-center justify-content-center padding-right-0 padding-left-0 text-center">

                          <i class="font-80 color-blue fas fa-laptop-house"></i>
                        </div>
                        <div class="col-sm-5 d-flex align-items-center justify-content-center  padding-right-0 padding-left-0">
                          <h4 class="margin-bottom-0" style=" color: #54769a; font-size: 22px; font-weight: bold; "><?php echo Lang::$word->WANT_WORK; ?></h4>
                        </div>
                        <div class="col-sm-3 d-flex align-items-center justify-content-center padding-left-0 padding-right-0 text-center">
                          <p class="font-40"><i class="color-blue fas fa-arrow-right"></i></p>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="col-xl-12 padding-top-30 padding-bottom-20" id="hire" data-type="hire">
                    <label for="want_to_hire">
                      <div
                        class="row margin-top-20 padding-top-20 padding-bottom-20 border want_to_work pointer background-hover-blue border-hover-blue">
                        <div class="col-sm-4 d-flex align-items-center justify-content-center padding-right-0 padding-left-0 text-center">
                          <i class="font-80 color-blue fas fa-briefcase"></i>
                        </div>
                        <div class="col-sm-5 d-flex align-items-center justify-content-center padding-right-0 padding-left-0">
                          <h4 class="margin-bottom-0" style=" color: #54769a; font-size: 22px; font-weight: bold; "><?php echo Lang::$word->WANT_HIRE; ?></h4>
                        </div>
                        <div class="col-sm-3 d-flex align-items-center justify-content-center padding-left-0 padding-right-0 text-center">
                          <p class="font-40"><i class="color-blue fas fa-arrow-right"></i></p>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
