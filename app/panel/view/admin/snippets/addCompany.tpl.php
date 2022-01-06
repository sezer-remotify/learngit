<?php
  /**
   * Add Company
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: addcompany.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="header">
  <h5><?php echo Lang::$word->CMP_NEW;?></h5>
</div>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo small block fields">
        <div class="field">
          <input type="text" placeholder="<?php echo Lang::$word->CMP_NAME;?> *" name="name">
        </div>
        <div class="field">
          <input data-geo="name" placeholder="<?php echo Lang::$word->ADDRESS;?>" type="text" name="address">
        </div>
        <div class="field">
          <input data-geo="locality" placeholder="<?php echo Lang::$word->CITY;?>" type="text" name="city">
        </div>
      </div>
      <div class="wojo small fields">
        <div class="field">
          <input data-geo="administrative_area_level_1" placeholder="<?php echo Lang::$word->STATE;?>" type="text" name="state">
        </div>
        <div class="field">
          <input data-geo="postal_code" placeholder="<?php echo Lang::$word->ZIP;?>" type="text" name="zip">
        </div>
      </div>
      <div class="wojo small fields">
        <div class="field">
          <input placeholder="<?php echo Lang::$word->CMP_WWW;?>" type="text" name="website">
        </div>
        <div class="field">
          <input placeholder="<?php echo Lang::$word->CFG_PHONE;?>" type="text" name="phone">
        </div>
      </div>
      <div class="wojo block small fields">
        <div class="field">
          <select name="currency" data-wselect='{"search":true}' class="selectbox">
            <?php foreach($this->countries as $ctrow):?>
            <option value="<?php echo $ctrow->currency_code . ',' . $ctrow->iso_alpha2;?>"><?php echo $ctrow->name;?> - <?php echo $ctrow->currency_name;?> (<?php echo $ctrow->currrency_symbol;?>)</option>
            <?php endforeach;?>
          </select>
          <p class="wojo small grey text">
            <?php echo Lang::$word->CMP_CURRENCY_T;?>
          </p>
        </div>
        <?php if($this->jobs):?>
        <div class="field">
          <label><?php echo Lang::$word->CMP_RATE;?></label>
        </div>
        <?php endif;?>
      </div>
      <?php if($this->jobs):?>
      <div class="wojo small fields">
        <div class="seven wide field"><span class="wojo small demi grey text"><?php echo Lang::$word->CMP_JOBT;?></span></div>
        <div class="three wide field"><span class="wojo small demi grey text"><?php echo App::Core()->currency;?> / <?php echo Lang::$word->_HOUR;?></span></div>
      </div>
      <?php foreach($this->jobs as $i => $jrow):?>
      <div class="wojo small fields">
        <?php $i++;?>
        <div class="seven wide field">
          <label><?php echo $i . '. ' . $jrow->name;?></label>
        </div>
        <div class="three wide field">
          <input placeholder="<?php echo $jrow->hrate;?>" type="text" name="hrate[<?php echo $jrow->name;?>]">
        </div>
      </div>
      <?php endforeach;?>
      <input name="dorates" type="hidden" value="1">
      <?php endif;?>
      <div class="wojo block small fields">
        <div class="basic field">
          <textarea name="note" placeholder="<?php echo Lang::$word->NOTE;?>"></textarea>
          <p class="wojo small grey text">
            <?php echo Lang::$word->CMP_NOTE_T;?>
          </p>
        </div>
      </div>
    </form>
  </div>
</div>