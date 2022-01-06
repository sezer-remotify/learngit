<?php
/**
 * New Company
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _company_new.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if ( !defined( "_WOJO" ) )
	die( 'Direct access to this location is not allowed.' );
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->CMP_NEW;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->CMP_INFO1;?></p>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::url("/admin/members", "invite");?>" class="wojo button"><?php echo Lang::$word->MAC_INVPEOPLE;?></a>
      <a class="wojo active passive button"><?php echo Lang::$word->CMP_NEW;?></a>
      <a href="<?php echo Url::url("/admin/teams");?>" class="wojo button"><?php echo Lang::$word->TMS_TEAMS;?></a>
      <a href="<?php echo Url::url("/admin/members", "archive");?>" class="wojo button"><?php echo Lang::$word->ARCHIVE;?></a>
    </div>
  </div>
</div>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->NAME;?></span></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CMP_NAME;?>
          <i class="icon asterisk"></i>
        </label>
      </div>
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->CMP_NAME;?>" name="name">
      </div>
    </div>
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->CMP_DETAILS;?></span></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->ADDRESS;?>
        </label>
      </div>
      <div class="field">
        <input data-geo="name" placeholder="<?php echo Lang::$word->ADDRESS;?>" type="text" name="address">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->STATE;?>
        </label>
      </div>
      <div class="field">
        <input data-geo="administrative_area_level_1" placeholder="<?php echo Lang::$word->STATE;?>" type="text" name="state">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CITY;?>
        </label>
      </div>
      <div class="field">
        <input data-geo="locality" placeholder="<?php echo Lang::$word->CITY;?>" type="text" name="city">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->ZIP;?>
        </label>
      </div>
      <div class="field">
        <input data-geo="postal_code" placeholder="<?php echo Lang::$word->ZIP;?>" type="text" name="zip">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CMP_WWW;?>
        </label>
      </div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->CMP_WWW;?>" type="text" name="website">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_PHONE;?>
        </label>
      </div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->CFG_PHONE;?>" type="text" name="phone">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->VAT;?>
        </label>
      </div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->VAT;?>" type="text" name="vat">
      </div>
    </div>
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->CFG_CURRENCY;?></span></h6>
    <div class="wojo fields align-top">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_CURRENCY;?>
        </label>
      </div>
      <div class="field">
        <select name="currency" data-wselect='{"search":true,"placeholder":"<?php echo Lang::$word->CFG_CURRENCY;?>"}' class="selectbox">
          <?php foreach($this->countries as $ctrow):?>
          <option value="<?php echo $ctrow->currency_code . ',' . $ctrow->iso_alpha2;?>">
          <?php echo $ctrow->name;?> - <?php echo $ctrow->currency_name;?> ( <?php echo $ctrow->currrency_symbol;?>)</option>
          <?php endforeach;?>
        </select>
        <p class="wojo small grey text">
          <?php echo Lang::$word->CMP_CURRENCY_T;?>
        </p>
      </div>
    </div>
  </div>
  <?php if($this->jobs):?>
  <div class="wojo small segment form">
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->CMP_RATEC;?></span></h6>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CMP_RATEB;?>
        </label>
      </div>
      <div class="basic field">
        <div class="wojo toggle checkbox">
          <input type="checkbox" checked="checked" name="dorates" value="1" id="for_dorates" onchange="$('.crates').slideToggle()">
          <label for="for_dorates">&nbsp;</label>
        </div>
        <div class="crates">
          <div class="wojo fields">
            <div class="seven wide field">
              <h6>
                <?php echo Lang::$word->CMP_JOBT;?>
              </h6>
            </div>
            <div class="three wide field">
              <h6>
                <?php echo App::Core()->currency;?> / <?php echo Lang::$word->_HOUR;?>
              </h6>
            </div>
          </div>
          <?php foreach($this->jobs as $i => $jrow):?>
          <div class="wojo small fields align middle">
            <?php $i++;?>
            <div class="seven wide field">
              <label>
                <?php echo $i . '. ' . $jrow->name;?>
              </label>
            </div>
            <div class="three wide field">
              <input placeholder="<?php echo $jrow->hrate;?>" type="text" name="hrate[<?php echo $jrow->name;?>]">
            </div>
          </div>
          <?php endforeach;?>
          <input name="dorates" type="hidden" value="1">
        </div>
      </div>
    </div>
  </div>
  <?php endif;?>
  <div class="wojo segment form">
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->NOTE;?></span></h6>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CMP_ADDINFO;?>
        </label>
      </div>
      <div class="field">
        <textarea name="note" placeholder="<?php echo Lang::$word->NOTE;?>"></textarea>
        <p class="wojo small grey text">
          <?php echo Lang::$word->CMP_NOTE_T;?>
        </p>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/members");?>" class="wojo simple small button">
      <?php echo Lang::$word->CANCEL;?>
      </a>
      <button type="button" data-action="processCompany" name="dosubmit" class="wojo primary button">
      <?php echo Lang::$word->CMP_CREATE;?>
      </button>
    </div>
  </div>
  <input data-geo="country_short" name="country" type="hidden" value="">
  <input name="nomodal" type="hidden" value="1">
</form>