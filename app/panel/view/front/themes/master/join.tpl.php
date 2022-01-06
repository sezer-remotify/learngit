<?php

/**
 * Join
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2017
 * @version $Id: join.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div class="login-wrapper">
  <div class="wojo login segment">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo form">
        <h2 class="center aligned"><?php echo str_replace("[COMPANY]", $this->core->company, Lang::$word->META_WELCOME); ?>!</h2>
        <p class="center aligned"><?php echo Lang::$word->DASH_INFO_1; ?></p>
        <div class="wojo block fields">
          <div class="field">
            <label><?php echo Lang::$word->FNAME; ?>
              <i class="icon asterisk"></i></label>
            <input type="text" placeholder="<?php echo Lang::$word->FNAME; ?>" name="fname">
          </div>
          <div class="field">
            <label><?php echo Lang::$word->LNAME; ?>
              <i class="icon asterisk"></i></label>
            <input type="text" placeholder="<?php echo Lang::$word->LNAME; ?>" name="lname">
          </div>
        </div>
        <div class="wojo block fields">
          <div class="field">
            <label><?php echo Lang::$word->PASSWORD; ?>
              <i class="icon asterisk"></i></label>
            <input type="password" placeholder="<?php echo Lang::$word->PASSWORD; ?>" name="password">
          </div>
          <div class="field">
            <label><?php echo Lang::$word->CONPASS; ?>
              <i class="icon asterisk"></i></label>
            <input type="password" placeholder="<?php echo Lang::$word->CONPASS; ?>" name="password2">
          </div>
        </div>
        <div class="wojo block fields">
          <div class="field">
            <input type="file" name="avatar" data-type="image" data-exist="<?php echo UPLOADURL . '/avatars/blank.svg'; ?>" accept="/image/png, image/jpeg">
          </div>
          <p class="wojo small text"><?php echo str_replace("[COMPANY]", $this->core->company, Lang::$word->DASH_INFO_2); ?></p>
          <div class="field">
            <div class="wojo checkbox">
              <input type="checkbox" name="privacy" value="1" id="agree">
              <label for="agree"><?php echo Lang::$word->AGREE; ?></label>
            </div>
            <p class="center aligned">
              <a data-set='{"option":[{"action": "viewPolicy","id":1}], "label":"<?php echo Lang::$word->PRIVACY; ?>", "url":"helper.php", "parent":"#item_1", "modalclass":"big", "buttons":false}' class="wojo small demi text action"><?php echo Lang::$word->PRIVACY_V; ?></a>
            </p>
          </div>
          <button type="button" data-action="userJoin" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->SUBMIT; ?></button>
        </div>
      </div>
      <input type="hidden" name="token" value="<?php echo $this->segments[1]; ?>">
    </form>
  </div>
</div>