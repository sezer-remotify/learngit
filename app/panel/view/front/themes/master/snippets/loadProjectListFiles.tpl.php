<?php
  /**
   * Load Project List Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: loadProjectListFiles.tpl.php, v1.00 2017-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($data):?>
<?php foreach($data as $row):?>
<div class="item" id="item_<?php echo $row->id;?>">
  <div class="content shrink">
    <a href="<?php echo SITEURL . "/download.php?id=" . $row->id;?>" class="wojo icon button" style="background-color:<?php echo File::getFileColor($row->name);?>"><i class="icon white <?php echo File::getFileIcon($row->name);?>"></i></a>
  </div>
  <div class="content horizontal-padding">
    <p class="wojo small bold text"><?php echo $row->caption;?></p>
    <p class="wojo small text"><?php echo Lang::$word->BY;?>
      <a href="<?php echo Url::url("members", "details", false,"?id=" . $row->created_by_id);?>"><?php echo $row->created_by_name;?></a>
      <?php echo Lang::$word->ON . ' ' . Date::doDate("short_date", $row->created);?>
    </p>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>