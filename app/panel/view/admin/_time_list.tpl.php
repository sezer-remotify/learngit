<?php
/**
 * Time List
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _time_list.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if ( !defined( "_WOJO" ) )
	die( 'Direct access to this location is not allowed.' );
?>
<?php if(!$this->data):?>
<div class="center aligned full padding"><img src="<?php echo ADMINVIEW;?>/images/time_empty.svg" alt="" class="wojo center big image">
  <p class="wojo semi grey text"><?php echo Lang::$word->TMR_NOTIME;?></p>
</div>
<?php else:?>
<?php foreach ($this->data as $date => $rows):?>
<div class="wojo fitted segment">
  <div class="header">
    <h5 class="basic"><?php echo Date::doDate("short_date", $date);?></h5>
  </div>
  <table class="wojo responsive basic table">
    <?php foreach ($rows as $trow):?>
    <tr id="item_<?php echo $trow->id;?>">
      <td class="auto"><?php echo Utility::decimalToHour($trow->hours);?>
        <?php echo $trow->jobname;?></td>
      <td class="four wide"><a href="<?php echo Url::url('/admin/members/details', $trow->user_id);?>" class="grey">
        <?php if($trow->avatar):?>
        <div class="wojo category image"><img src="<?php echo UPLOADURL;?>/avatars/<?php echo $trow->avatar;?>" alt=""></div>
        <?php else:?>
        <span class="wojo initials circular label">
        <?php echo Utility::getInitials($trow->uname);?>
        </span>
        <?php endif;?>
        <?php echo $trow->uname;?>
        </a></td>
      <td><?php if($trow->task_id):?>
        <a href="<?php echo Url::url('/admin/tasks', $trow->task_id);?>">
        <?php echo $trow->title;?>
        </a>
        <?php else:?>
        <a href="<?php echo Url::url('/admin/projects/tasks', $trow->project_id);?>">
        <?php echo $trow->title;?>
        </a>
        <?php endif;?>
        <p class="wojo small text">
          <?php echo $trow->description;?>
        </p></td>
      <td class="two wide"><span class="wojo small semi <?php echo $trow->is_billable ? " positive " : "negative ";?> text">
        <?php echo $trow->is_billable ? Lang::$word->INV_ISBILL : Lang::$word->INV_ISNOBILL;?>
        </span></td>
      <td class="auto"><a class="wojo simple icon button" data-dropdown="#mTimeList_<?php echo $trow->id;?>">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="mTimeList_<?php echo $trow->id;?>">
          <a class="item is_edit" data-id="<?php echo $trow->id;?>">
          <?php echo Lang::$word->EDIT;?>
          </a>
          <!-- Start moveTimeToProject -->
          <a data-set='{"option":[{"action":"moveTimeToProject","id":<?php echo $trow->id;?>,"pid":<?php echo $this->row->id;?>,"time":"<?php echo $trow->hours;?>", "jobname":"<?php echo $trow->jobname;?>"}], "label":"<?php echo Lang::$word->TSK_SUB;?>", "url":"helper.php", "parent":"#item_<?php echo $trow->id;?>", "complete":"replace", "modalclass":"normal", "redirect":"true"}' class="item action"><?php echo Lang::$word->TSK_SUB;?></a>
          <div class="divider"></div>
          <!-- Start trashTimeRecord -->
          <a data-set='{"option":[{"trash": "trashTimeRecord","title": "<?php echo Validator::sanitize($trow->title, "chars");?>","pid":<?php echo $this->row->id;?>,"id":<?php echo $trow->id;?>,"is_billable":<?php echo $trow->is_billable;?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $trow->id;?>", "redirect":"<?php echo Url::url("/admin/projects/time", $this->row->id);?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endforeach;?>
<?php endif;?>