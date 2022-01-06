<?php
  /**
   * Projects Archive
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _project_archive.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->PRJ_SUB9;?></h3>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::url("/admin/projects", "new");?>" class="wojo button"><?php echo Lang::$word->PRJ_PRJSTART;?></a>
      <a class="wojo active passive button"><?php echo Lang::$word->PRJ_SUB9;?></a>
    </div>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/archive_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->PRJ_INFO2;?></p>
</div>
<?php else:?>
<table class="wojo fitted segment responsive table">
  <thead>
    <tr>
      <th><?php echo Lang::$word->PRJ_PRJNAME;?> </th>
      <th><?php echo Lang::$word->CLIENT;?> </th>
      <th><?php echo Lang::$word->PRJ_SUB10;?> </th>
      <th class="auto"> </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($this->data as $row):?>
    <?php $crow = Utility::searchForValueName("id", $row->id, "name", $this->companies, true);?>
    <tr id="item_<?php echo $row->id;?>">
      <td><a href="<?php echo Url::url("/admin/projects/tasks", $row->id);?>"><?php echo $row->name;?></a></td>
      <td><?php if($crow):?>
        <a href="<?php echo Url::url("/admin/companies/edit", $crow->id);?>" class="grey"><?php echo $crow->name;?></a>
        <?php else:?>
        ...
        <?php endif;?></td>
      <td><?php echo Date::doDate("short_date", $row->completed);?></td>
      <td><a class="wojo small dark inverted icon button" data-dropdown="#projectDrop_<?php echo $row->id;?>">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="projectDrop_<?php echo $row->id;?>">
          <!-- Start reopenProject -->
          <a data-set='{"option":[{"iaction":"reopenProject","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->name, "chars");?>"}], "url":"/helper.php", "parent":"#item_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->PRJ_SUB11;?></a>
          <div class="divider"></div>
          <!-- Start trashProject -->
          <a data-set='{"option":[{"trash": "trashProject","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php endif;?>