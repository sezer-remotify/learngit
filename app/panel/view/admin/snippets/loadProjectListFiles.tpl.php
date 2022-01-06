<?php
  /**
   * Load Project List Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadProjectListFiles.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($data):?>
<?php foreach($data as $row):?>
<div class="item align middle" id="item_<?php echo $row->id;?>">
  <div class="content auto">
    <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($row->name);?>" class="wojo default rounded image">
  </div>
  <div class="content horizontal padding">
    <h6 class="basic"><?php echo $row->caption;?></h6>
    <p class="wojo small text"><?php echo Lang::$word->BY;?>
      <a href="<?php echo Url::url("members", "details", false,"?id=" . $row->created_by_id);?>"><?php echo $row->created_by_name;?></a>
      <?php echo Lang::$word->ON . ' ' . Date::doDate("short_date", $row->created);?>
      <span id="is_hidden_<?php echo $row->id;?>">
      <?php if($row->chidden or $row->thidden or $row->nhidden or $row->is_hidden):?>
      <i class="icon mask"></i>
      <?php endif;?>
      </span>
    </p>
  </div>
  <div class="content auto">
    <a class="grey" data-dropdown="#fileDrop_<?php echo $row->id;?>">
    <i class="icon vertical ellipsis"></i>
    </a>
    <div class="wojo dropdown small pointing top-right" id="fileDrop_<?php echo $row->id;?>">
      <!-- Start fileDownload -->
      <a href="<?php echo SITEURL . "/download.php?id=" . $row->id;?>" class="item"><?php echo Lang::$word->DOWNLOAD;?></a>
      <?php if($row->parent == "project"):?>
      <!-- Start HideFromClients -->
      <a id="act_<?php echo $row->id;?>" data-set='{"id":<?php echo $row->id;?>, "status":<?php echo $row->is_hidden ? 1 : 0;?>}' class="item is_hidden"><?php echo $row->is_hidden ? Lang::$word->FMG_SUB2 : Lang::$word->FMG_SUB1;?></a>
      <?php endif;?>
      <div class="divider"></div>
      <!-- Start deleteFile -->
      <a data-set='{"option":[{"delete": "deleteFile","title": "<?php echo Validator::sanitize($row->caption, "chars");?>","id":<?php echo $row->id;?>,"name": "<?php echo $row->name;?>"}],"action":"delete", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
      <?php echo Lang::$word->DELETE;?>
      </a>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>