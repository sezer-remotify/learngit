<?php
  /**
   * Reports
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _reports_main.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->REP_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->REP_INFO;?></p>
  </div>
</div>
<div class="wojo fitted segment">
  <div class="header divided">
    <h4 class="basic">
      <?php echo Lang::$word->REP_SUB;?>
    </h4>
  </div>
  <div class="content">
    <div class="wojo fluid relaxed divided list">
      <div class="item align middle">
        <div class="content auto"><img src="<?php echo ADMINVIEW;?>/images/payments.svg" alt="" class="wojo small basic image"></div>
        <div class="content padding left"><a href="<?php echo Url::url("/admin/reports", "payments");?>"><?php echo Lang::$word->REP_SUB1;?></a>
          <p class="wojo small text"><?php echo Lang::$word->REP_INFO1;?></p>
        </div>
      </div>
      <div class="item align middle">
        <div class="content auto"><img src="<?php echo ADMINVIEW;?>/images/uninvoiced.svg" alt="" class="wojo small basic image"></div>
        <div class="content padding left"><a href="<?php echo Url::url("/admin/reports", "uninvoiced");?>"><?php echo Lang::$word->REP_SUB2;?></a>
          <p class="wojo small text"><?php echo Lang::$word->REP_INFO2_1;?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="wojo fitted segment">
  <div class="header divided">
    <h4 class="basic">
      <?php echo Lang::$word->REP_SUB3;?>
    </h4>
  </div>
  <div class="content">
    <div class="wojo fluid relaxed divided list">
      <div class="item align middle">
        <div class="content auto"><img src="<?php echo ADMINVIEW;?>/images/tasks.svg" alt="" class="wojo small basic image"></div>
        <div class="content padding left"><a href="<?php echo Url::url("/admin/reports", "tasks");?>"><?php echo Lang::$word->REP_SUB4;?></a>
          <p class="wojo small text"><?php echo Lang::$word->REP_INFO4_1;?></p>
        </div>
      </div>
      <div class="item align middle">
        <div class="content auto"><img src="<?php echo ADMINVIEW;?>/images/workload.svg" alt="" class="wojo small basic image"></div>
        <div class="content padding left"><a href="<?php echo Url::url("/admin/reports", "workload");?>"><?php echo Lang::$word->REP_SUB5;?></a>
          <p class="wojo small text"><?php echo Lang::$word->REP_INFO5_1;?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="wojo fitted segment">
  <div class="header divided">
    <h4 class="basic">
      <?php echo Lang::$word->REP_SUB6;?>
    </h4>
  </div>
  <div class="content">
    <div class="wojo fluid relaxed divided list">
      <div class="item align middle">
        <div class="content auto"><img src="<?php echo ADMINVIEW;?>/images/time.svg" alt="" class="wojo small basic image"></div>
        <div class="content padding left"><a href="<?php echo Url::url("/admin/reports", "time");?>"><?php echo Lang::$word->REP_SUB7;?></a>
          <p class="wojo small text"><?php echo Lang::$word->REP_INFO7_1;?></p>
        </div>
      </div>
      <div class="item align middle">
        <div class="content auto"><img src="<?php echo ADMINVIEW;?>/images/expense.svg" alt="" class="wojo small basic image"></div>
        <div class="content padding left"><a href="<?php echo Url::url("/admin/reports", "expense");?>"><?php echo Lang::$word->REP_SUB8;?></a>
          <p class="wojo small text"><?php echo Lang::$word->REP_INFO8_1;?></p>
        </div>
      </div>
      <div class="item align middle">
        <div class="content auto"><img src="<?php echo ADMINVIEW;?>/images/budget.svg" alt="" class="wojo small basic image"></div>
        <div class="content padding left"><a href="<?php echo Url::url("/admin/reports", "budget");?>"><?php echo Lang::$word->REP_SUB10;?></a>
          <p class="wojo small text"><?php echo Lang::$word->REP_INFO10_1;?></p>
        </div>
      </div>
    </div>
  </div>
</div>