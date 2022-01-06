<?php

/**
 * Time Weekly
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _time_weekly.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div class="center aligned margin bottom">
  <div id="timenav" class="wojo small rounded white buttons">
    <div id="prev" class="wojo button" data-date="<?php echo Date::doDate("yyyy/MM/dd", Date::NumberOfDays("-1 week")); ?>"><?php echo Lang::$word->ACT_PREV; ?></div>
    <div id="mNow" class="wojo right button">
      <a class="wojo small secondary text"><span><?php echo Date::doDate("short_date", Date::today()); ?></span></a>
      <i class="icon small chevron down"></i>
    </div>
    <div id="next" class="wojo button" data-date="<?php echo Date::doDate("yyyy/MM/dd", Date::NumberOfDays("+1 week")); ?>"><span></span><?php echo Lang::$word->NEXT; ?></div>
  </div>
</div>
<div id="timeWeekly" class="wojo form">
  <?php include(MASTERBASE . "/snippets/loadTimeWeekly.tpl.php"); ?>
</div>