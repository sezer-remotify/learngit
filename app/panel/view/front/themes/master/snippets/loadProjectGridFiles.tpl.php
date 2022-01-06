<?php
  /**
   * Load Project Files Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: loadProjectGridFiles.tpl.php, v1.00 2017-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($data):?>
<?php foreach($data as $row):?>
<div class="item" id="item_<?php echo $row->id;?>">
  <div class="wojo attached card">
    <div class="content content-center">
      <a href="<?php echo SITEURL . "/download.php?id=" . $row->id;?>"><img src="<?php echo UPLOADURL . "/mime/" . File::getFileIcon($row->name);?>.svg" alt="" class="wojo basic medium image"></a>
      <p class="wojo small bold text half-vertical-margin truncate"><?php echo $row->caption;?></p>
      <div class="wojo small attached horizontal list">
        <div class="item">
          <?php echo Lang::$word->BY;?>: <span><?php echo $row->created_by_name;?></span>
        </div>
        <div class="item">
          <?php echo Lang::$word->ON . ': ' . Date::doDate("short_date", $row->created);?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>