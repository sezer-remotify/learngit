<?php
  /**
   * My Password
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: mypassword.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->ACC_PASS_CHANGE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->ACC_SUB1;?></p>
  </div>
</div>
<div class="row align center">
  <div class="columns screen-70 tablet-100 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo segment form">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->NEWPASS;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input type="text" name="password">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CONPASS;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input type="text" name="password2">
          </div>
        </div>
        <div class="right aligned">
          <button type="button" data-action="updatePassword" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->ACC_PASSUPDATE;?></button>
        </div>
      </div>
    </form>
  </div>
</div>