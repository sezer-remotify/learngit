<?php
  /**
   * Projects
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: projects.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_PROJECTS;?></h3>
<a href="<?php echo Url::url("/dashboard/projects/archive");?>" class="wojo small secondary inverted button"><?php echo Lang::$word->PRJ_SUB9;?></a>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/projects_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->PRJ_NOPRJ1;?></p>
</div>
<?php else:?>
<div class="wojo mason">
  <?php foreach($this->data as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>">
    <div class="wojo card">
      <div class="header">
        <h4 class="wojo truncate">
          <a href="<?php echo Url::url("/dashboard/projects/tasks", $row->id);?>"><?php echo $row->name;?></a>
        </h4>
      </div>
      <div class="content">
        <?php echo $row->description;?></div>
      <div class="footer divided">
        <div class="flex align spaced middle">
          <?php if($lrow = Utility::searchForValueName("id", $row->label_id, "name", $this->labels, true)):?>
          <div class="wojo small label" style="color:#fff;background:<?php echo $lrow->color;?>;border-color:<?php echo $lrow->color;?>"><?php echo $lrow->name;?></div >
          <?php endif;?>
          <div class="wojo small text"><?php echo Date::timesince($row->created);?></div >
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>