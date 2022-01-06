<?php
  /**
   * Index
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: index.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->ADM_MYWORK;?></h3>
<!-- my Projects-->
<div class="wojo fitted segment">
  <div class="divided header">
    <h4 class="basic"><?php echo Lang::$word->PRJ_MYPRJ;?></h4>
  </div>
  <?php if($this->projects):?>
  <!-- my Projects-->
  <div class="content">
    <div class="wojo very relaxed fluid divided list">
      <?php foreach($this->projects as $row):?>
      <div class="item">
        <div class="content">
          <a href="<?php echo Url::url("/admin/projects/tasks", $row->id);?>"><?php echo $row->name;?></a>
        </div>
        <div class="content auto">
          <?php echo Date::timeSince($row->created);?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <?php unset($row);?>
  </div>
  <?php endif;?>
</div>

<!-- my Tasks-->
<div class="wojo fitted segment">
  <div class="divided header">
    <h4 class="basic"><?php echo Lang::$word->TSK_MYTASKS;?></h4>
  </div>
  <?php if($this->tasks):?>
  <div class="content">
    <?php foreach($this->tasks as $key => $rows):?>
    <h6><a href="<?php echo Url::url("/admin/projects/tasks", $rows['pid']);?>"><?php echo $rows['pname'];?></a>
    </h6>
    <?php if($rows['tasks']):?>
    <div class="wojo celled fluid list">
      <?php foreach($rows['tasks'] as $row):?>
      <div class="item">
        <div class="content">
          <a href="<?php echo Url::url("/admin/tasks", $row['id']);?>" class="wojo small <?php echo ($row['is_priority']) ? 'highlited label right' : 'inverted';?>"><?php echo $row['name'];?>
          <?php echo ($row['is_hidden']) ? '<i class="icon eye blocked disabled"></i>' : null?></a>
          <?php if($row['due_on']):?>
          <span class="wojo small <?php echo Date::dateLabels($row['due_on']);?> text" data-tooltip="<?php echo Lang::$word->INV_DUED;?>">(<?php echo Date::doDate("short_date", $row['due_on']);?>)</span>
          <?php endif;?>
        </div>
        <div class="content auto">
          <?php echo Date::timeSince($row['created']);?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>

<!-- my Time-->
<div class="wojo fitted segment">
  <div class="divided header">
    <h4 class="basic"><?php echo Lang::$word->TMR_MYTIME;?></h4>
  </div>
  <?php if($this->times):?>
  <div class="content">
    <?php foreach($this->times as $key => $rows):?>
    <h6><a href="<?php echo Url::url("/admin/projects/tasks", $rows['pid']);?>"><?php echo $rows['pname'];?></a>
    </h6>
    <?php if($rows['times']):?>
    <div class="wojo items">
      <?php foreach($rows['times'] as $row):?>
      <div class="item">
        <div class="columns">
          <div class="header"><?php echo $row['title'];?></div>
          <div class="description">@ <?php echo Utility::decimalToHour($row['hours']);?>
            <?php echo $row['jobname'] ? $row['jobname'] : "...";?>
            <span class="wojo vertical divider"></span>
            <span class="wojo small bold text"><?php echo $row['is_billable'] ? Lang::$word->INV_ISBILL : Lang::$word->INV_ISNOBILL;?></span>
            <span class="wojo vertical divider"></span>
            <?php echo $row['description'];?></div>
        </div>
        <div class="columns auto">
          <?php echo Date::timeSince($row['created']);?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
    <?php endforeach;?>
    <?php unset($key, $rows, $row);?>
  </div>
  <?php endif;?>
</div>

<!-- my Expenses-->
<div class="wojo fitted segment">
  <div class="divided header">
    <h4 class="basic"><?php echo Lang::$word->EXP_MYEXP;?></h4>
  </div>
  <?php if($this->expense):?>
  <!-- my Expenses-->
  <div class="content">
    <?php foreach($this->expense as $key => $rows):?>
    <h6><a href="<?php echo Url::url("/admin/projects/tasks", $rows['pid']);?>"><?php echo $rows['pname'];?></a>
    </h6>
    <?php if($rows['exp']):?>
    <div class="wojo items">
      <?php foreach($rows['exp'] as $row):?>
      <div class="item">
        <div class="columns">
          <div class="header"><?php echo $row['title'] ? $row['title'] : "...";?></div>
          <div class="description">@ <?php echo Utility::formatMoney($row['amount'], $row['currency']);?>
            <?php echo $row['catname'] ? $row['catname'] : "...";?>
            <span class="wojo vertical divider"></span>
            <span class="wojo small bold text"><?php echo $row['is_billable'] ? Lang::$word->INV_ISBILL : Lang::$word->INV_ISNOBILL;?></span>
            <span class="wojo vertical divider"></span>
            <?php echo $row['description'];?></div>
        </div>
        <div class="columns auto">
          <?php echo Date::timeSince($row['created']);?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
    <?php endforeach;?>
    <?php unset($key, $rows, $row);?>
  </div>
  <?php endif;?>
</div>
