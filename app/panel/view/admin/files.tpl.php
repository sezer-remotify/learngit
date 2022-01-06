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

<h3><?php echo Lang::$word->FMG_TITLE;?></h3>
<?php include_once(ADMINBASE . '/snippets/project_header.tpl.php');?>
<div class="wojo gutters segment">
  <div class="row gutters">
    <div class="columns phone-100">
      <div class="wojo secondary button uploader" id="drag-and-drop-zone"><i class="icon plus alt"></i>
        <label><?php echo Lang::$word->FMG_UPLFILES;?>
          <input type="file" multiple name="attach[]">
        </label>
      </div>
      <div class="wojo secondary button uploader" style=" padding: 0; "><a href="<?php echo Lang::$word->CONTRACT_FILE;?>" target="_blank" style=" color: #fff;text-decoration: unset;padding: .875rem 1.875rem; "><i class="icon download alt"></i>
    
      <?php echo Lang::$word->CONTRACT_FILE_TEXT;?>
        
    </a>
      </div>
    </div>
    <div class="columns auto phone-100">
      <?php if(in_array("list", $this->segments)):?>
      <a class="wojo small basic disabled icon button"><i class="icon unordered list"></i></a>
      <a href="<?php echo Url::url("/admin/projects/contract/" . $this->row->id);?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
      <?php else:?>
      <a class="wojo small basic disabled icon button"><i class="icon grid"></i></a>
      <a href="<?php echo Url::url("/admin/projects/contract/list", $this->row->id);?>" class="wojo small primary icon button"><i class="icon reorder"></i></a>
      <?php endif;?>
    </div>
  </div>
   <div id="fileList" class="wojo items relaxed"></div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/files_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->FMG_INFO;?></p>
</div>
<?php else:?>
<?php if(in_array("list", $this->segments)):?>
<?php include_once (ADMINBASE . "/_files_list.tpl.php");?>
<?php else:?>
<?php include_once (ADMINBASE . "/_files_grid.tpl.php");?>
<?php endif;?>
<?php endif;?>
<script src="<?php echo ADMINVIEW;?>/js/files.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
  $(document).ready(function() {
	  $.Files({
		  url: "<?php echo ADMINVIEW;?>",
		  surl: "<?php echo SITEURL;?>",
		  mode: "<?php echo (in_array("list", $this->segments)) ? "list" : "grid";?>",
		  lang: {
			  removeText: "<?php echo Lang::$word->REMOVE;?>",
			  addText: "<?php echo Lang::$word->FMG_ADD;?>"
		  }
	  });
  });
// ]]>
</script>
