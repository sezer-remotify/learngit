<?php
  /**
   * Project Notes View
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _notes_view.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_TITLE2;?></h3>
<h4><?php echo $this->prow->name;?></h4>
<div class="row gutters">
  <div class="columns screen-70 tablet-60 mobile-100 phone-100">
    <div class="wojo segment" style="background:<?php echo $this->row->color;?>">
      <div class="row no-all-gutters">
        <div class="columns phone-100">
          <p class="wojo small text">
            <?php echo Lang::$word->IN;?>
            <a href="<?php echo Url::url("/dashboard/projects/view", $this->prow->id);?>"><?php echo $this->prow->name;?></a>
            - <?php echo Lang::$word->CREATED_BY;?>
            <span><?php echo $this->row->created_by_name;?></span>
            <?php echo strtolower(Lang::$word->ON) . ' ' . Date::doDate("short_date", $this->row->created);?>
          </p>
        </div>
      </div>
      <h4><?php echo $this->row->name;?></h4>
      <div class="wojo big space divider"></div>
      <div class="wojo notes content">
        <?php echo $this->row->body;?>
      </div>
    </div>
  </div>
  <div class="columns screen-30 tablet-40 mobile-100 phone-100">
    <div class="wojo segment">
      <h6><?php echo Lang::$word->ATTACHMENTS;?></h6>
      <?php if($this->filedata):?>
      <!-- Start Attachments -->
      <div id="fileList" class="wojo small fluid relaxed celled list">
        <?php foreach($this->filedata as $frow):?>
        <div class="item align middle">
          <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($frow->name);?>" class="wojo small rounded shadow image">
          <div class="columns">
            <p class="header"><?php echo $frow->caption;?></p>
            <p class="wojo tiny text"><?php echo File::getSize($frow->fsize);?> - <a href="<?php echo SITEURL;?>/download.php?id=<?php echo $frow->id;?>"><?php echo Lang::$word->DOWNLOAD;?></a>
            </p>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>