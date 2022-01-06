<?php
  /**
   * New Team
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: newTeam.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <div class="wojo action input">
            <input type="text" placeholder="<?php echo Lang::$word->TMS_NAME;?>" name="name">
            <button type="button" class="wojo icon black button" data-color="true"><i class="icon contrast"></i></button>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->TMS_INFO1;?></label>
          <div class="row grid small gutters screen-2 tablet-2 mobile-2 phone-1">
            <?php foreach($this->data as $row):?>
            <?php if($row->userlevel == 9 or $row->userlevel == 8 or $row->userlevel == 5):?>
            <div class="columns">
              <div class="wojo fitted checkbox">
                <input type="checkbox" name="uid[<?php echo $row->id;?>]" id="for_uid<?php echo $row->id;?>" value="<?php echo $row->id;?>">
                <label for="for_uid<?php echo $row->id;?>"><?php echo $row->fullname;?></label>
              </div>
            </div>
            <?php endif;?>
            <?php endforeach;?>
          </div>
        </div>
        <div class="basic field">
          <label><?php echo Lang::$word->TMS_INFO2;?></label>
          <div class="row grid small gutters screen-2 tablet-2 mobile-2 phone-1">
            <?php foreach($this->data as $row):?>
            <?php if($row->userlevel == 1):?>
            <div class="columns">
              <div class="wojo fitted checkbox">
                <input type="checkbox" name="uid[<?php echo $row->id;?>]" id="for_uid<?php echo $row->id;?>" value="<?php echo $row->id;?>">
                <label for="for_uid<?php echo $row->id;?>"><?php echo $row->fullname;?></label>
              </div>
            </div>
            <?php endif;?>
            <?php endforeach;?>
          </div>
        </div>
      </div>
      <input name="color" type="hidden" value="">
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