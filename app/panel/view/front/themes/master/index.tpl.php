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
      <div id="loginform">
        <div class="wojo block fields">
          <div class="field">
            <div class="wojo icon input">
              <i class="icon user alt"></i>
              <input type="email" placeholder="<?php echo Lang::$word->EMAIL; ?>" name="username">
            </div>
          </div>
          <div class="field">
            <div class="wojo icon input">
              <i class="icon lock"></i>
              <input type="password" placeholder="<?php echo Lang::$word->PASSWORD; ?>" name="password">
            </div>
          </div>
          <button type="button" name="doLogin" class="wojo secondary big button"><?php echo Lang::$word->LOGIN; ?></button>
          <!-- <a style="text-decoration: none; margin-top: 10px;" href="/app/panel/admin/login/" class="wojo big button">REMOTIFIER LOGIN</a> -->
          <p class="center aligned margin top">
            <a id="passreset" class="grey"><?php echo Lang::$word->PASSWORD_L; ?>?</a>
          </p>
        </div>
      </div>
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
              <input type="text" name="email" placeholder="<?php echo Lang::$word->EMAIL; ?>">
            </div>
          </div>
          <button type="button" name="doPass" class="wojo negative big button"><?php echo Lang::$word->SUBMIT; ?></button>
          <p class="center aligned margin top">
            <a id="backto" class="grey"><?php echo Lang::$word->BACKTOLOGIN; ?></a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
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