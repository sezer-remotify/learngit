<?php
  /**
   * Email Templates
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: templates.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_etemplates')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->EMT_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->EMT_SUB1;?></p>
  </div>
</div>
<div class="wojo segment form">
  <form method="post" id="wojo_form" name="wojo_form">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->EMT_NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->EMT_NAME;?>" value="<?php echo $this->data->name;?>" name="name">
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->EMT_SUBJECT;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->EMT_SUBJECT;?>" value="<?php echo $this->data->subject;?>" name="subject">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <textarea class="bodypost" name="body"><?php echo Url::out_url($this->data->body);?></textarea>
        <p class="wojo small icon negative text">
          <i class="icon negative info sign"></i>
          <?php echo Lang::$word->NOTEVAR;?></p>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->EMT_DESC;?></label>
        <textarea class="small" placeholder="<?php echo Lang::$word->EMT_DESC;?>" name="help"><?php echo $this->data->help;?></textarea>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/templates");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processTemplate" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->EMT_UPDATE;?></button>
    </div>
    <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
  </form>
</div>
<?php break;?>
<?php default: ?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->EMT_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->EMT_SUB;?></p>
  </div>
</div>
<?php if(!$this->data):?>
<div class="big full padding center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small demi caps text"><?php echo Lang::$word->EMT_NOITEMS;?></p>
</div>
<?php else:?>
<div class="wojo segment">
  <table class="wojo basic responsive table">
    <thead>
      <tr>
        <th class="auto center aligned"><i class="icon disabled id"></i></th>
        <th><?php echo Lang::$word->EMT_NAME;?></th>
        <th><?php echo Lang::$word->EMT_SUBJECT;?></th>
        <th class="center aligned"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td><span class="wojo small label"><?php echo $row->id;?></span></td>
      <td><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="grey">
        <?php echo $row->name;?></a></td>
      <td><?php echo $row->subject;?></td>
      <td class="auto"><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="wojo icon primary inverted circular button"><i class="icon note"></i></a></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>