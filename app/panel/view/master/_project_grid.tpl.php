<?php

/**
 * Projects Grid
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _projects_grid.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<style>
  .projectName
  {
    font-weight:500!important;
    color:#2a41e8!important;
    transition: all 0.5s;
  }
  .projectName:hover
  {
    color:#4b4b4b!important;
    transition: all 0.5s;
  }
</style>
<div class="wojo heading message">
  <div class="content">
    <h3 class="font-weight-700"><?php echo Lang::$word->PRJ_PROJECTS; ?></h3>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <?php if (App::Auth()->usertype == 'client') : ?>
        <a href="<?php echo Url::url("/master/projects", "new"); ?>" class="wojo button"><?php echo Lang::$word->PRJ_PRJSTART; ?></a>
      <?php endif; ?>
      <a href="#" class="wojo button"><?php echo Lang::$word->PRJ_SUB9; ?></a>
    </div>
  </div>
  <div class="columns auto phone-100">
    
  </div>
</div>
 
<?php if (!$this->data) : ?>
  <div class="center aligned"><img src="<?php echo ADMINVIEW; ?>/images/projects_empty.svg" alt="" class="wojo center big image">
    <p class="wojo semi grey text"><?php echo (App::Auth()->usertype == 'client')?Lang::$word->CLIENT_PRJ_INFO :Lang::$word->FREELANCER_PRJ_INFO; ?></p>
  </div>
<?php else : ?>
  <div class="wojo mason">
    <?php foreach ($this->data as $row) : ?>
      <div class="item" id="item_<?php echo $row->id; ?>">
        <div class="wojo attached card position-inherit">
          <div class="header">
            <div class="row">
              <div class="columns">
                <h4 class="wojo truncate margin-bottom-0">

                  <?php if (App::Auth()->usertype == 'client') : ?>
                    <a href="<?php echo Url::url("/master/projects/bids", $row->id); ?>" class="grey projectName"><?php echo $row->name; ?></a>
                  <?php else : ?>
                    <span class="color-blue"><?php echo $row->name; ?></span>
                  <?php endif; ?>
                </h4>
                <small><?php echo $row->work_type . ' (' . ucwords($row->project_type) . ')'; ?></small>
              </div>
              <div class="columns auto">
                <a class="grey" data-dropdown="#projectDrop_<?php echo $row->id; ?>">
                  <i class="icon vertical ellipsis"></i>
                </a>
                <div class="wojo dropdown small pointing top-right" id="projectDrop_<?php echo $row->id; ?>">
                  <!-- View Project -->
                  <a href="<?php echo Url::url("/master/projects/view", $row->id); ?>" class="item"><?php echo Lang::$word->VIEW; ?></a>
                  <?php if (App::Auth()->usertype == 'client') : ?>
                    <!-- Start editProject -->
                    <a href="#" class="item"><?php echo Lang::$word->EDIT; ?></a>
                    <!-- Start completeProject -->
                    <a href="#" class="item"><?php echo Lang::$word->PRJ_SUB6; ?></a>
                    <div class="divider"></div>
                    <!-- Start trashProject -->
                    <a href="#" class="item wojo demi text data">
                      <?php echo Lang::$word->REMOVE; ?>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="content padding-top-0">
            <?php echo $row->description; ?></div>
          <div class="footer divided">
            <div class="row">
              <div class="columns">
                <?php if ($lrow = Utility::searchForValueName("id", $row->label_id, "name", $this->labels, true)) : ?>
                  <span class="wojo small label" style="color:#fff;background:<?php echo $lrow->color; ?>;border-color:<?php echo $lrow->color; ?>"><?php echo $lrow->name; ?></span>
                  <a href="<?php echo Url::url("/master/projects/view", $row->id); ?>"><span class="wojo small label" style="color:#fff;background:#2a41e8;">View Project</span>
                  <?php if (App::Auth()->usertype == 'client') : ?> <a href="<?php echo Url::url("/master/projects/bids", $row->id); ?>"><span class="wojo small label" style="color:#fff;background:#2a41e8;">Bids</span> <?php endif; ?>
                    <?php endif; ?>
              </div>
              <div class="columns auto"><?php echo Date::timesince($row->created); ?></div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>