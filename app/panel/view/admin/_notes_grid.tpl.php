<?php
  /**
   * Notes Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _notes_grid.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_TITLE2;?></h3>
<?php include_once(ADMINBASE . '/snippets/project_header.tpl.php');?>
<div class="right aligned full padding">
  <a href="<?php echo Url::url("/admin/notes/new", $this->row->id);?>" class="wojo primary icon button"><i class="icon pencil"></i></a>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notes_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->NOT_INFO;?></p>
</div>
<?php else:?>
<div class="wojo mason">
  <?php foreach ($this->data as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card" style="background:<?php echo $row->color;?>">
      <div class="header">
        <div class="row">
          <div class="columns">
            <h4 class="basic"><?php echo $row->name;?></h4>
          </div>
          <div class="columns auto">
            <a class="grey" data-dropdown="#noteDrop_<?php echo $row->id;?>">
            <i class="icon vertical ellipsis"></i>
            </a>
            <div class="wojo dropdown small pointing top-right" id="noteDrop_<?php echo $row->id;?>">
              <a href="<?php echo Url::url("/admin/notes/view/" . $row->project_id, $row->id);?>" class="item"><?php echo Lang::$word->VIEW;?></a>
              <a href="<?php echo Url::url("/admin/notes/edit", $row->id);?>" class="item"><?php echo Lang::$word->NOT_EDIT;?></a>
              <div class="divider"></div>
              <!-- Start trashNote -->
              <a data-set='{"option":[{"trash": "trashNote","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id":<?php echo $row->id;?>, "pid":<?php echo $row->project_id;?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
              <?php echo Lang::$word->MTOTRASH;?>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <h6 class="basic"><?php echo Lang::$word->BY;?>
          <a href="<?php echo Url::url("/admin/members/details", $row->created_by_id);?>"><?php echo $row->created_by_name;?></a>
        </h6>
        <p class="wojo small semi text">
          <?php echo Date::timesince($row->created);?>
        </p>
        <div class="wojo small divider"></div>
        <p class="wojo small text">
          <?php echo Validator::cleanOut($row->body);?>
        </p>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>