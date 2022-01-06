<?php
  /**
   * Edit Team
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: editTeam.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
      $data = App::Company()->getAllTeams($this->row->name);
  if($in = $data[$this->row->name]['usstr']):
	  $users = Db::run()->pdoQuery("SELECT id, CONCAT(fname,' ',lname) as fullname FROM `" . Users::mTable . "` WHERE id NOT IN($in) AND status = ? AND active= ?", array(1, "y"))->results();
  else:
	  $users = Db::run()->pdoQuery("SELECT id, CONCAT(fname,' ',lname) as fullname FROM `" . Users::mTable . "` WHERE status = ? AND active= ?", array(1, "y"))->results();
  endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->TMS_TITLE2;?></h5>
</div>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="modal_form" name="modal_form">
      <?php foreach($data as $team):?>
      <div class="wojo block fields">
        <div class="field">
          <div class="wojo action input">
            <input type="text" value="<?php echo $team['name'];?>" name="name">
            <button type="button" style="background:<?php echo $team['color'];?>" class="wojo icon black button" data-color="true"><i class="icon contrast"></i></button>
          </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->TMS_INFO3;?></label>
        <div class="row grid small gutters screen-2 tablet-2 mobile-2 phone-1">
          <?php foreach ($team['members'] as $row) :?>
          <?php if($row['fullname']):?>
          <div class="columns">
            <div class="wojo fitted checkbox">
              <input type="checkbox" checked="checked" id="for_uid<?php echo $row['user_id'];?>" name="uid[<?php echo $row['user_id'];?>]" value="<?php echo $row['user_id'];?>">
              <label for="for_uid<?php echo $row['user_id'];?>">
                <?php echo $row['fullname'];?></label>
            </div>
          </div>
          <?php endif;?>
          <?php endforeach;?>
        </div>
      </div>
      <?php if($users):?>
      <div class="basic field">
        <label><?php echo Lang::$word->TMS_INFO1;?></label>
        <div class="row grid small gutters screen-2 tablet-2 mobile-2 phone-1">
          <?php foreach ($users as $urow) :?>
          <div class="columns">
            <div class="wojo fitted checkbox">
              <input type="checkbox" name="uid[<?php echo $urow->id;?>]" id="for_uid<?php echo $urow->id;?>" value="<?php echo $urow->id;?>">
              <label for="for_uid<?php echo $urow->id;?>">
                <?php echo $urow->fullname;?></label>
            </div>
          </div>
          <?php endforeach;?>
          </ul>
          <?php endif;?>
        </div>
      </div>
      <input name="color" type="hidden" value="<?php echo $team['color'];?>">
    </form>
    <?php endforeach;?>
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