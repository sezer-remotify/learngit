<?php
  /**
   * Gateways
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: gateways.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->GWT_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->GWT_SUB1;?></p>
  </div>
</div>
<div class="wojo segment form">
  <form method="post" id="wojo_form" name="wojo_form">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->GWT_NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo fluid input">
          <input type="text" placeholder="<?php echo Lang::$word->GWT_NAME;?>" value="<?php echo $this->data->displayname;?>" name="displayname">
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo $this->data->extra_txt;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo fluid input">
          <input type="text" placeholder="<?php echo $this->data->extra_txt;?>" value="<?php echo $this->data->extra;?>" name="extra">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo $this->data->extra_txt2;?></label>
        <div class="wojo fluid input">
          <input type="text" placeholder="<?php echo $this->data->extra_txt2;?>" value="<?php echo $this->data->extra2;?>" name="extra2">
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo $this->data->extra_txt3;?>
        </label>
        <div class="wojo fluid input">
          <input type="text" placeholder="<?php echo $this->data->extra_txt3;?>" value="<?php echo $this->data->extra3;?>" name="extra3">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->GWT_LIVE;?></label>
        <div class="wojo checkbox radio inline">
          <input name="live" type="radio" value="1" <?php Validator::getChecked($this->data->live, 1); ?> id="live1">
          <label for="live1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="live" type="radio" value="0" <?php Validator::getChecked($this->data->live, 0); ?> id="live2">
          <label for="live2"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field five wide">
        <div class="basic field">
          <label><?php echo Lang::$word->ACTIVE;?></label>
          <div class="wojo checkbox radio inline">
            <input name="active" type="radio" value="1" <?php Validator::getChecked($this->data->active, 1); ?> id="active1">
            <label for="active1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio inline">
            <input name="active" type="radio" value="0" <?php Validator::getChecked($this->data->active, 0); ?> id="active2">
            <label for="active2"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field disabled">
        <label><?php echo Lang::$word->GWT_IPNURL;?></label>
        <span class="wojo text"><?php echo SITEURL.'/gateways/' . $this->data->dir . '/ipn.php';?></span>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/gateways");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processGateway" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->GWT_UPDATE;?></button>
    </div>
    <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
  </form>
</div>
<?php break;?>
<?php default: ?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->GWT_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->GWT_SUB;?></p>
  </div>
</div>
<?php if($this->data):?>
<div class="wojo cards screen-3 tablet-3 mobile-1">
  <?php foreach ($this->data as $row):?>
  <div class="card">
    <div class="content dimmable <?php echo ($row->active == 0) ? "active" : "";?>" id="item_<?php echo $row->id;?>">
      <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>">
      <img src="<?php echo SITEURL;?>/gateways/<?php echo $row->dir;?>/logo_large.png" alt=""></a>
    </div>
    <div class="divided footer">
      <div class="row align middle">
        <div class="columns">
          <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->displayname;?></a>
        </div>
        <div class="columns auto">
          <div class="wojo fitted toggle checkbox is_dimmable" data-set='{"option":[{"action": "gatewayStatus","id":<?php echo $row->id;?>}],"parent":"#item_<?php echo $row->id;?>"}' >
            <input name="active" type="checkbox" value="1" <?php Validator::getChecked($row->active, 1); ?> id="gateway_<?php echo $row->id;?>">
            <label for="gateway_<?php echo $row->id;?>"><?php echo Lang::$word->ACTIVE;?></label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>