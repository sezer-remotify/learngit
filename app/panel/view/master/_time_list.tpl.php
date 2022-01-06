<?php

/**
 * Time List
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _time_list.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<?php if (!$this->data) : ?>
  <div class="center aligned full padding"><img src="<?php echo MASTERVIEW; ?>/images/time_empty.svg" alt="" class="wojo center big image">
    <p class="wojo semi grey text"><?php echo Lang::$word->TMR_NOTIME; ?></p>
  </div>
<?php else : ?>
  <?php foreach ($this->data as $date => $rows) : ?>
    <div class="wojo fitted segment">
      <div class="header">
        <h5 class="basic"><?php echo Date::doDate("short_date", $date); ?></h5>
      </div>
      <table class="wojo responsive basic table">
        <?php foreach ($rows as $trow) : ?>
          <tr id="item_<?php echo $trow->id; ?>">
            <td class="auto"><?php echo Utility::decimalToHour($trow->hours); ?>
              <?php echo Lang::$word->HOURLY;; ?></td>
            <td class="four wide"><a href="<?php echo Url::url('/master/profile/view', $trow->username); ?>" class="grey">
                <?php if ($trow->avatar) : ?>
                  <div class="wojo category image"><img src="<?php echo UPLOADURL; ?>/avatars/<?php echo $trow->avatar; ?>" alt=""></div>
                <?php else : ?>
                  <span class="wojo initials circular label">
                    <?php echo Utility::getInitials($trow->uname); ?>
                  </span>
                <?php endif; ?>
                <?php echo $trow->uname; ?>
              </a></td>
            <td><?php if ($trow->task_id) : ?>
                <!-- <a href="<?php echo Url::url('/master/tasks', $trow->task_id); ?>"> -->
                <?php echo $trow->title; ?>
                <!-- </a> -->
              <?php else : ?>
                <!-- <a href="<?php echo Url::url('/master/projects/tasks', $trow->project_id); ?>"> -->
                <?php echo $trow->title; ?>
                <!-- </a> -->
              <?php endif; ?>
              <p class="wojo small text">
                <?php echo $trow->description; ?>
              </p>
            </td>
            <td class="two wide" <?php if ($trow->user_id != App::auth()->uid) echo 'colspan="2"'; ?>><span class="wojo small semi <?php echo $trow->is_billable ? " positive " : "negative "; ?> text">
                <?php echo $trow->is_billable ? Lang::$word->INV_ISBILL : Lang::$word->INV_ISNOBILL; ?>
              </span></td>
            <?php if ($trow->user_id == App::auth()->uid) : ?>
              <td class="auto"><a class="wojo simple icon button" data-dropdown="#mTimeList_<?php echo $trow->id; ?>">
                  <i class="icon vertical ellipsis"></i>
                </a>
                <div class="wojo dropdown small pointing top-right" id="mTimeList_<?php echo $trow->id; ?>">
                  <a class="item is_edit" data-id="<?php echo $trow->id; ?>">
                    <?php echo Lang::$word->EDIT; ?>
                  </a>
                  <div class="divider"></div>
                  <!-- Start deleteTimeRecord -->
                  <a data-set='{"option":[{"delete": "deleteTimeRecord","title": "<?php echo Validator::sanitize($trow->title, "chars"); ?>","pid":<?php echo $this->row->id; ?>,"id":<?php echo $trow->id; ?>,"name": "<?php echo $trow->title; ?>","is_billable":<?php echo $trow->is_billable; ?>}],"action":"delete", "parent":"#item_<?php echo $trow->id; ?>"}' class="item wojo demi text data">
                    <?php echo Lang::$word->DELETE; ?>
                  </a>
                </div>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  <?php endforeach; ?>
<?php endif; ?>