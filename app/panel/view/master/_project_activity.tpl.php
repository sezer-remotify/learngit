<?php

/**
 * Project Activity
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _project_activity.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_TITLE3; ?></h3>
<?php include_once(MASTERBASE . '/snippets/project_header.tpl.php'); ?>
<?php if (!$this->data) : ?>
  <div class="center aligned"><img src="<?php echo MASTERVIEW; ?>/images/activity_empty.svg" alt="" class="wojo center large image">
    <p class="wojo semi grey text"><?php echo Lang::$word->PRJ_NOACT; ?></p>
  </div>
<?php else : ?>
  <ul class="wojo segment activity scrollbox" style="height:600px">
    <?php foreach ($this->data as $date => $rows) : ?>
      <li>
        <div class="intro"><?php echo Date::doDate("short_date", $date); ?></div>
        <div class="content">
          <?php foreach ($rows as $arow) : ?>
            <div class="item wojo small text">
              <span class="wojo tiny bold dimmed text half-right-padding"><?php echo Date::doTime($arow->hour); ?></span>
              <a href="<?php echo Url::url("/master/profile/view/", $arow->username); ?>" class="inverted"><?php echo $arow->fullname; ?></a>
              <span class="wojo separator"></span>
              <?php if ($arow->groups == "history") : ?>
                <?php echo Users::activityHistoryStatus($arow, 'master'); ?>
              <?php else : ?>
                <?php echo Users::activityStatus($arow, 'master'); ?>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>