<?php

/**
 * Files
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: files.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<style>
  .fa-google-drive{
    margin-right:1rem;
  }
</style>
<h3><?php echo Lang::$word->FMG_TITLE; ?></h3>
<?php include_once(MASTERBASE . '/snippets/project_header.tpl.php'); ?>
<div class="wojo gutters segment">
  <div class="row gutters">
    <div class="columns phone-100">
      <div class="wojo secondary button uploader" id="drag-and-drop-zone" style="color:white;height:35px;"><i class="icon plus alt"></i>
        <label><?php echo Lang::$word->FMG_UPLLASTCONTRACT; ?>
          <input type="file" multiple name="attach[]">
        </label>
      </div>
      <div class="wojo secondary button uploader" id="drag-and-drop-zone" style="height:35px;"><i class="icon plus alt"></i>
         <a href="<?php echo Lang::$word->CONTRACT_FILE;?>" style="color:white;" target="_blank" download><?php echo Lang::$word->DOWNLOAD_SAMPLE;?></a>
      </div>
      <?php
      if($this->row->drive_link != ""):
       ?>
      <div class="wojo secondary button" style="height:35px;"><i class="fab fa-google-drive"></i>
        <a href="<?php echo $this->row->drive_link ?>" style="color:white;" target="_blank"><?php echo Lang::$word->FMG_DRIVE_LINK;?></a>
      </div>
      <?php
      endif;
      ?>
    </div>
    <div class="columns auto phone-100">
      <?php if (in_array("list", $this->segments)) : ?>
        <a class="wojo small basic disabled icon button"><i class="icon unordered list"></i></a>
        <a href="<?php echo Url::url("/master/projects/files/" . $this->row->id); ?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
      <?php else : ?>
        <a class="wojo small basic disabled icon button"><i class="icon grid"></i></a>
        <a href="<?php echo Url::url("/master/projects/files/list", $this->row->id); ?>" class="wojo small primary icon button"><i class="icon reorder"></i></a>
      <?php endif; ?>
    </div>
  </div>
  <div id="fileList" class="wojo items relaxed"></div>
</div>
<?php if (!$this->data) : ?>
  <div class="center aligned"><img src="<?php echo MASTERVIEW; ?>/images/files_empty.svg" alt="" class="wojo center large image">
    <p class="wojo semi grey text"><?php echo Lang::$word->FMG_INFO; ?></p>
  </div>
<?php else : ?>
  <?php if (in_array("list", $this->segments)) : ?>
    <?php include_once(MASTERBASE . "/_files_list.tpl.php"); ?>
  <?php else : ?>
    <?php include_once(MASTERBASE . "/_files_grid.tpl.php"); ?>
  <?php endif; ?>
<?php endif; ?>
<script src="<?php echo MASTERVIEW; ?>/js/files.js"></script>
<script type="text/javascript">
  // <![CDATA[
  $(document).ready(function() {
    $.Files({
      url: "<?php echo MASTERVIEW; ?>",
      surl: "<?php echo SITEURL; ?>",
      mode: "<?php echo (in_array("list", $this->segments)) ? "list" : "grid"; ?>",
      lang: {
        removeText: "<?php echo Lang::$word->REMOVE; ?>",
        addText: "<?php echo Lang::$word->FMG_ADD; ?>"
      }
    });
  });
  // ]]>
</script>
