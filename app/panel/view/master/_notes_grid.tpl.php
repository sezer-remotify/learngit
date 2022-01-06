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
<h3><?php echo Lang::$word->PRJ_TITLE2; ?></h3>
<?php include_once(MASTERBASE . '/snippets/project_header.tpl.php'); ?>
<div class="right aligned full padding">
  <a href="<?php echo Url::url("/master/notes/new", $this->row->id); ?>" class="wojo primary icon button"><i class="icon pencil"></i></a>
</div>
<?php if (!$this->data) : ?>
  <div class="center aligned"><img src="<?php echo MASTERVIEW; ?>/images/notes_empty.svg" alt="" class="wojo center large image">
    <p class="wojo semi grey text"><?php echo Lang::$word->NOT_INFO; ?></p>
  </div>
<?php else : ?>
  <div class="wojo mason">
    <?php foreach ($this->data as $row) : ?>
      <div class="item" id="item_<?php echo $row->id; ?>">
        <div class="wojo attached card" style="background:<?php echo $row->color; ?>">
          <div class="header">
            <div class="row">
              <div class="columns">
                <h4 class="basic"><?php echo $row->name; ?></h4>
              </div>
              <div class="columns auto">
                <a class="grey" data-dropdown="#noteDrop_<?php echo $row->id; ?>">
                  <i class="icon vertical ellipsis"></i>
                </a>
                <div class="wojo dropdown small pointing top-right" id="noteDrop_<?php echo $row->id; ?>">
                  <a href="<?php echo Url::url("/master/notes/view/" . $row->project_id, $row->id); ?>" class="item"><?php echo Lang::$word->VIEW; ?></a>
                  <?php if (Auth::$udata->uid == $row->created_by_id) : ?>
                    <a href="<?php echo Url::url("/master/notes/edit", $row->id); ?>" class="item"><?php echo Lang::$word->NOT_EDIT; ?></a>
                    <div class="divider"></div>
                    <!-- Start trashNote -->
                    <a class="item wojo negative demi text iaction" data-set='{"option":[{"iaction":"removeNote", "id":<?php echo $row->id; ?>,"name":"<?php echo $row->name; ?>"}], "url":"/helper.php", "complete":"remove", "parent":"#item_<?php echo $row->id; ?>"}'><?php echo Lang::$word->REMOVE; ?></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="content">
            <h6 class="basic"><?php echo Lang::$word->BY; ?>
              <a href="<?php echo Url::url("/master/profile/view", $row->created_by_email); ?>"><?php echo $row->created_by_name; ?></a>
            </h6>
            <p class="wojo small semi text">
              <?php echo Date::timesince($row->created); ?>
            </p>
            <div class="wojo small divider"></div>
            <p class="wojo small text">
              <?php echo Validator::cleanOut($row->body); ?>
            </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>