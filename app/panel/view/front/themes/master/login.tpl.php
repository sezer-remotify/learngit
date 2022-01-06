<?php

/**
 * Index
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2017
 * @version $Id: index.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO")) {
  die('Direct access to this location is not allowed.');
}
?>
<div class="login-wrapper">
  <div class="wojo login segment">
    <div class="wojo form">
      <div class="center aligned margin bottom" style="margin-bottom: 3em;">
        <a href="https://remotify.co">
          <img src="<?php echo THEMEURL; ?>/images/remotify-logo.png" alt="User Icon" class="wojo basic medium inline image logoLogin">
        </a>

      </div>
       <form id="loginform" class=" <?php if (!$this->loginform) echo "hide-all"; ?>">
        <div class=" wojo block fields">
          <div class="field">
            <div class="wojo icon input">
              <i class="icon email alt"></i>
              <input type="email" placeholder="<?php echo Lang::$word->EMAIL; ?>" name="email">
            </div>
          </div>
          <div class="field">
            <div class="wojo icon input">
              <i class="icon lock"></i>
              <input type="password" autocomplete placeholder="<?php echo Lang::$word->PASSWORD; ?>" name="password">
              <i class="eye-toggler icon icon-feather-eye font-18"></i>
            </div>
          </div>
          <button type="button" name="doLogin" class="wojo secondary big button"><?php echo Lang::$word->LOGIN; ?></button>
          <!-- Social Login -->
          <div class="social-login-separator"></div>
          <div class="welcome-text">
            <span><?php echo Lang::$word->NO_ACCOUNT; ?> <a id="signup" class="grey"><?php echo Lang::$word->REGISTER ?>!</a></span>
            <span> <a id="passreset" class="grey"><?php echo Lang::$word->PASSWORD_L; ?>?</a></span>
          </div>
        </div>
      </form>
      <div id="passform" class="hide-all">
        <div class="wojo block fields">
          <div class="field">
            <div class="wojo icon input">
              <i class="icon user alt"></i>
              <input type="text" name="fname" placeholder="<?php echo Lang::$word->FNAME; ?>">
            </div>
          </div>
          <div class="field">
            <div class="wojo icon input">
              <i class="icon email alt"></i>
              <input type="text" name="forgotEmail" placeholder="<?php echo Lang::$word->EMAIL; ?>">
            </div>
          </div>
          <button type="button" name="doPass" class="wojo negative big button"><?php echo Lang::$word->SUBMIT; ?></button>
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
          <div class="field">
            <div class="wojo icon input">
              <i class="icon email alt"></i>
              <input type="text" name="registerEmail" placeholder="<?php echo Lang::$word->EMAIL; ?>">
            </div>
          </div>
          <div class="field">
            <div class="wojo icon input">
              <i class="icon lock alt"></i>
              <input type="password" name="registerPassword" autocomplete placeholder="<?php echo Lang::$word->PASSWORD; ?>">
              <i class="eye-toggler icon icon-feather-eye font-18"></i>
            </div>
          </div>

          <div>
            <span><input id="terms-and-conditions" name="agreement" class="margin-right-5" type="checkbox"><?php echo Lang::$word->AGREE_TO; ?> <a href="#"><?php echo Lang::$word->USER_AGREEMENT; ?></a> and <a href="#"><?php echo Lang::$word->PRIVACY; ?></a></span>
          </div>

          <!-- Button -->
          <button type="button" class="wojo secondary big button step-1-button margin-top-20 "><?php echo Lang::$word->REGISTER; ?> </button>
          <!-- Social Login -->
          <div class="social-login-separator"></div>
          <div class="welcome-text">
            <span><?php echo Lang::$word->HAVE_ACCOUNT; ?> <a id="loginPage"><?php echo Lang::$word->LOGIN; ?>!</a></span>
          </div>
        </div>
      </form>
      <div id="step-2" class="hide-all">
        <div class="container">
          <div class="row font-18 ">
            <div class="col-xl-12 text-center">
              <i class="font-80 color-blue icon-material-outline-email"></i>
            </div>
            <div class="col-xl-12 padding-top-20 text-center">
              <p class="font-18"><?php echo Lang::$word->EM_VER_SENT ?></p>
            </div>
            <button type="button" class="wojo secondary big button step-2-button margin-top-20 margin-bottom-20 width-100"><?php echo Lang::$word->NEXT; ?></button>
          </div>
        </div>
      </div>
      <div id="step-3" class="hide-all">
        <div class="container">
          <div class="row font-18">
            <div class="col-xl-12 padding-left-0 padding-top-0">
              <h2 class="font-weight-700"><?php echo Lang::$word->CHOOSE_PL; ?></h2>
            </div>
            <div class="col-xl-12 padding-left-0 padding-bottom-10 padding-top-15">
              <p><?php echo Lang::$word->CANT_CH_U; ?></p>
            </div>

            <div class="field width-100">
              <div class="wojo icon input">
                <i class="icon user alt"></i>
                <input type="text" name="username" id="username-register" placeholder="<?php echo Lang::$word->PROFILE_LINK; ?>">
              </div>
            </div>

            <!-- <div class="col-xl-12 padding-left-0">
              <span>Suggestions: </span><span><a href="#"> username1</a>/</span><span><a href="#"> username2</a>/</span><span><a href="#"> username3</a></span>
            </div> -->
            <button type="button" class="wojo secondary big button step-3-button margin-top-20 margin-bottom-20 width-100"><?php echo Lang::$word->NEXT; ?></button>
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
              <p><?php echo Lang::$word->CHANGE_LATER; ?></p>
            </div>
            <div class="col-xl-12" id="work" data-type="work">
              <label for="want_to_work">
                <div class="row margin-top-20 padding-top-20 padding-bottom-20 border want_to_work pointer background-hover-blue border-hover-blue">
                  <div class="col-sm-3 d-flex align-items-center justify-content-center padding-right-0 padding-left-0 text-center">
                    <i class="font-80 color-blue icon-material-outline-computer"></i>
                  </div>
                  <div class="col-sm-7 d-flex align-items-center justify-content-center  padding-right-0 padding-left-0">
                    <h4 class="margin-bottom-0"><?php echo Lang::$word->WANT_WORK; ?></h4>
                  </div>
                  <div class="col-sm-2 d-flex align-items-center justify-content-center padding-left-0 padding-right-0 text-center">
                    <p class="font-40"><i class="color-blue icon-material-outline-arrow-right-alt"></i></p>
                  </div>
                </div>
              </label>
            </div>
            <div class="col-xl-12 padding-top-30 padding-bottom-20" id="hire" data-type="hire">
              <label for="want_to_hire">
                <div class="row margin-top-20 padding-top-20 padding-bottom-20 border want_to_work pointer background-hover-blue border-hover-blue">
                  <div class="col-sm-3 d-flex align-items-center justify-content-center padding-right-0 padding-left-0 text-center">
                    <i class="font-80 color-blue icon-material-outline-computer"></i>
                  </div>
                  <div class="col-sm-7 d-flex align-items-center justify-content-center padding-right-0 padding-left-0">
                    <h4 class="margin-bottom-0"><?php echo Lang::$word->WANT_HIRE; ?></h4>
                  </div>
                  <div class="col-sm-2 d-flex align-items-center justify-content-center padding-left-0 padding-right-0 text-center">
                    <p class="font-40"><i class="color-blue icon-material-outline-arrow-right-alt"></i></p>
                  </div>
                </div>
              </label>
            </div>
          </div>
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
      <script src="<?php echo THEMEURL; ?>/js/login.js"></script>
      <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function() {
          $.Login({
            url: "<?php echo FRONTVIEW; ?>",
            surl: "<?php echo SITEURL; ?>",
          });
        });
        // ]]>
      </script>

    </div>
  </div>
</div>
