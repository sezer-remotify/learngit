<?php
  /**
   * Edit Calendar
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: editCalendar.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo $this->row->name?></h5>
</div>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <label><?php echo Lang::$word->CAL_NAME;?></label>
          <div class="wojo small fluid right icon input">
            <input type="text" placeholder="<?php echo Lang::$word->CAL_NAME;?> *" value="<?php echo $this->row->name?>" name="name">
            <button id="bgColor" style="background:<?php echo $this->row->color;?>" class="wojo icon black button" data-color="true"><i class="icon contrast"></i></button>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->CAL_SUB1;?></label>
          <a class="wojo right basic fluid button" data-dropdown="#dropdown-calUsrId">
          <?php echo Lang::$word->CAL_CALENDARS;?>
          <i class="icon chevron down"></i></a>
          <div class="wojo small pointing dropdown top-left" id="dropdown-calUsrId">
            <div class="full padding">
              <div class="row grid screen-2 tablet-2 mobile-2">
                <?php if($this->staff):?>
                <?php $key = explode(",", $this->calusers->uid);?>
                <?php foreach($this->staff as $srow):?>
                <?php $checked = (in_array($srow->id, $key) ? ' checked="checked"' : '');?>
                <div class="columns">
                  <div class="wojo fitted toggle checkbox">
                    <input type="checkbox" name="user_id[]" value="<?php echo $srow->id;?>" id="calUsrId_<?php echo $srow->id;?>"<?php echo $checked;?>>
                    <label for="calUsrId_<?php echo $srow->id;?>"><?php echo $srow->name;?></label>
                  </div>
                </div>
                <?php endforeach;?>
                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input name="color" type="hidden" value="<?php echo $this->row->color;?>">
      <input name="user_id[]" type="hidden" value="<?php echo $this->row->created_by_id;?>">
    </form>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
	$('[data-color="true"]').wColorPicker({
		allowCustomColor: false,
		allowRecent: false,
		recentMax: 5,
		rows: 5,
		onChangeColor: function() {
			$('input[name=color]').val(this);
		}
	});
});
// ]]>
</script>