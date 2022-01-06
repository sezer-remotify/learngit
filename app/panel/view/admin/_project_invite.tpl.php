<?php
  /**
   * Projects Invite
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _project_invite.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->MAC_INVPEOPLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->PRJ_SUB;?></p>
  </div>
</div>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="row grid phone-1 mobile-1 tablet-2 screen-3 gutters align bottom">
    <div class="columns">
      <div class="wojo segment">
        <h4><?php echo Lang::$word->MEMBERS;?></h4>
        <p class="wojo small text"><?php echo str_replace("[ICON]", "<i class=\"icon small badge disabled\"></i>", Lang::$word->PRJ_SUB1);?></p>
        <div class="wojo positive fluid button" data-dropdown="#memberList">
          <span class="text"><?php echo Lang::$word->PRJ_PRORTM;?></span>
          <i class="icon chevron down"></i>
        </div>
        <div class="wojo dropdown small fluid top-center" id="memberList">
          <?php if($this->staffdata):?>
          <?php foreach($this->staffdata as $staff):?>
          <?php $disabled = Utility::searchForValue("id", $staff->id, $this->puserdata) ? " disabled selected" : null;?>
          <a id="staff_<?php echo $staff->id;?>" class="item<?php echo $disabled;?>" data-set='{"name": "<?php echo $staff->name;?>","type":"staff", "avatar": "<?php echo $staff->avatar;?>","id":<?php echo $staff->id;?>}'>
          <?php echo $staff->name;?>
          <span class="padding left"><?php echo $staff->email;?></span>
          </a>
          <?php endforeach;?>
          <?php endif;?>
          <?php if($this->teamdata):?>
          <?php foreach($this->teamdata as $team => $rows):?>
          <a id="team_<?php echo $rows['id'];?>" class="item" data-set='{"name": "<?php echo $team;?>","type":"team", "color": "<?php echo $rows['color'];?>", "counter": <?php echo $rows['counter'];?>, "ids":"<?php echo $rows['usstr'];?>", "id":<?php echo $rows['id'];?>}'>
          <?php echo $team;?>
          <span class="wojo dimmed text padding left"><?php echo str_replace("[NUMBER]", "<span class=\"wojo bold text\">" . $rows['counter'] . "</span>", Lang::$word->PRJ_TM_INFO);?></span></a>
          <?php endforeach;?>
          <?php endif;?>
        </div>
        <div class="wojo space divider"></div>
        <div class="wojo celled items" id="mlist">
          <?php if($this->puserdata):?>
          <?php foreach($this->puserdata as $prow):?>
          <?php if($prow->type == "staff" or $prow->type == "owner"):?>
          <div class="item align middle">
            <div class="columns auto">
              <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg";?>" alt="" class="wojo category image">
            </div>
            <div class="columns"><?php echo $prow->name;?></div>
            <div class="columns auto">
              <a class="makeLeader wojo small inverted circular icon button<?php echo ($prow->id == $this->row->leader_id) ? " positive" : null;?>" data-id="<?php echo $prow->id;?>"><i class="icon badge link"></i></a>
              <?php if($prow->type == "staff"):?>
              <a data-set='{"name": "<?php echo $prow->name;?>","type":"staff", "avatar": "<?php echo $prow->avatar;?>","id":<?php echo $prow->id;?>}' class="removeItem wojo inverted negative small circular icon button"><i class="icon close link"></i></a>
              <?php endif;?>
            </div>
          </div>
          <?php endif;?>
          <?php endforeach;?>
          <?php else:?>
          <div class="item">
            <img src="<?php echo UPLOADURL;?>/avatars/<?php echo Auth::$udata->avatar ? Auth::$udata->avatar : "blank.svg";?>" alt="" class="wojo category image">
            <div class="columns">
              <div class="header"><?php echo Auth::$udata->name;?></div>
            </div>
            <div class="columns auto">
              <a class="makeLeader wojo small circular icon button" data-id="<?php echo Auth::$userdata->id;?>"><i class="icon positive badge link"></i></a>
            </div>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="wojo segment">
        <h4><?php echo Lang::$word->CLIENTS;?></h4>
        <p class="wojo small text"><?php echo Lang::$word->PRJ_SUB2;?></p>
        <div class="wojo secondary fluid button" data-dropdown="#clientList">
          <span class="text"><?php echo Lang::$word->PRJ_PRORTM;?></span>
          <i class="icon chevron down"></i>
        </div>
        <div class="wojo dropdown small fluid top-center" id="clientList">
          <div class="scrolling">
            <?php if($this->clientdata):?>
            <?php foreach($this->clientdata as $crow):?>
            <?php $disabled = Utility::searchForValue("id", $crow->id, $this->puserdata) ? " disabled selected" : null;?>
            <a id="client_<?php echo $crow->id;?>" class="item<?php echo $disabled;?>" data-set='{"name": "<?php echo $crow->name;?>","type":"client", "avatar": "<?php echo $crow->avatar;?>","id":<?php echo $crow->id;?>}'>
            <?php echo $crow->name;?>
            <span class="padding left"><?php echo $crow->email;?></span>
            </a>
            <?php endforeach;?>
            <?php endif;?>
          </div>
        </div>
        <div class="wojo space divider"></div>
        <div class="wojo celled items" id="clist">
          <?php if($this->puserdata):?>
          <?php foreach($this->puserdata as $prow):?>
          <?php if($prow->type == "member"):?>
          <div class="item align middle">
            <div class="columns auto">
              <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg";?>" alt="" class="wojo category image">
            </div>
            <div class="columns">
              <?php echo $prow->name;?>
            </div>
            <div class="columns auto">
              <a data-set='{"name": "<?php echo $prow->name;?>","type":"client", "avatar": "<?php echo $prow->avatar;?>","id":<?php echo $prow->id;?>}' class="removeItem wojo small inverted negative circular icon button"><i class="icon close link"></i></a>
            </div>
          </div>
          <?php endif;?>
          <?php endforeach;?>
          <?php endif;?>
        </div>
      </div>
    </div>
    <div class="columns center aligned">
      <div class="wojo segment">
        <p class="wojo small text"><?php echo Lang::$word->PRJ_SUB3;?></p>
        <button type="button" data-action="projectInvite" name="dosubmit" class="wojo primary rounded right button"><?php echo Lang::$word->MAC_SENDINV;?><i class="icon arrow forward"></i></button>
        <p class="margin top">
          <a href="<?php echo Url::url("/admin/projects/tasks", $this->row->id);?>" class="inverted"><?php echo Lang::$word->PRJ_SKIP;?></a>
        </p>
      </div>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->row->id;?>">
  <input type="hidden" name="project" value="<?php echo $this->row->name;?>">
  <?php if($this->puserdata):?>
  <?php foreach($this->puserdata as $prow):?>
  <input type="hidden" id="<?php echo ($prow->type == "member") ? "client_" . $prow->id : "staff_" . $prow->id;?>" name="users[]" value="<?php echo $prow->id;?>">
  <?php endforeach;?>
  <?php endif;?>
</form>
<script src="<?php echo ADMINVIEW;?>/js/project_invite.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Invite({
		url: "<?php echo ADMINVIEW;?>",
		upurl: "<?php echo UPLOADURL;?>"
    });
});
// ]]>
</script>