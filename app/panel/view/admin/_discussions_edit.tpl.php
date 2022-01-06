<?php
  /**
   * Edit Discussions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _discussions_edit.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="row align center">
    <div class="columns screen-70 tablet-100 mobile-100 phone-100">
      <h3><?php echo Lang::$word->MSG_TITLE1;?></h3>
      <h4><?php echo $this->row->name;?></h4>
      <div class="wojo segment form">
        <div class="wojo big fluid icon input">
          <i class="icon pencil"></i>
          <input value="<?php echo $this->row->name;?>" placeholder="<?php echo Lang::$word->NAME;?>" type="text" name="name">
        </div>
        <textarea name="body" class="quickpost"><?php echo $this->row->body;?></textarea>
        <div class="wojo basic divider"></div>
        <div class="full vertical padding">
          <div class="wojo basic uploader" id="drag-and-drop-zone">
            <div class="content">
              <label class="align spaced">
                <span class="wojo small demi grey text"><?php echo Lang::$word->ATTACHMENTS;?></span>
                <a class="wojo small demi grey text"><?php echo Lang::$word->FMG_UPLFILES;?></a>
                <input type="file" multiple name="attach[]">
              </label>
            </div>
          </div>
        </div>
        <div class="wojo basic divider"></div>
        <div id="fileList" class="wojo items celled">
          <?php if($this->filedata):?>
          <!-- Start Attachments -->
          <?php foreach($this->filedata as $frow):?>
          <div class="item align middle" id="uploadFile_<?php echo $frow->id;?>">
            <div class="columns auto">
              <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($frow->name);?>" class="wojo default rounded image">
            </div>
            <div class="columns" id="contentFile_<?php echo $frow->id;?>">
              <h6 class="basic"><?php echo $frow->caption;?></h6>
              <a class="wojo small negative icon right text iaction" data-set='{"option":[{"iaction":"removeTaskFile", "id":<?php echo $frow->id;?>,"name":"<?php echo $frow->name;?>"}], "url":"/helper.php", "complete":"remove", "parent":"#uploadFile_<?php echo $frow->id;?>"}'><?php echo Lang::$word->REMOVE;?>
              <i class="icon close"></i></a>
            </div>
          </div>
          <input type="hidden" value="<?php echo $frow->name;?>" name="attachment[]">
          <?php endforeach;?>
          <?php endif;?>
        </div>
        <?php if($this->puserdata and $this->messageusers):?>
        <!-- Start Subscribers -->
        <div class="wojo basic divider"></div>
        <div class="full vertical padding">
          <h5><?php echo Lang::$word->TSK_SUB6;?></h5>
          <?php $key = explode(",", $this->messageusers->uid);?>
          <div class="row grid screen-2 tablet-2 mobile-1 phone-2">
            <?php foreach($this->puserdata as $urow):?>
            <?php $checked = (in_array($urow->id, $key) ? ' checked="checked"' : '');?>
            <div class="columns">
              <div class="wojo small checkbox">
                <input type="checkbox" name="subscribers[]" value="<?php echo $urow->id;?>"<?php echo $checked;?> id="dSbList_<?php echo $urow->id;?>">
                <label for="dSbList_<?php echo $urow->id;?>"><?php echo $urow->name;?></label>
              </div>
            </div>
            <?php endforeach;?>
          </div>
        </div>
        <?php endif;?>
        <div class="wojo basic divider"></div>
        <div class="full vertical padding">
          <div class="wojo toggle fitted checkbox">
            <input type="checkbox" name="is_hidden" value="1" id="dHidden" <?php Validator::getChecked($this->row->is_hidden, 1);?>>
            <label for="dHidden"><?php echo Lang::$word->TSK_SUB7;?></label>
          </div>
        </div>
        <div class="wojo fitted divider"></div>
        <div class="center aligned">
          <a href="<?php echo Url::url("/admin/discussions/view/" . $this->prow->id, $this->row->id);?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
          <button type="button" data-action="processDiscussion" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->MSG_TITLE1;?></button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="pid" value="<?php echo $this->prow->id;?>">
  <input type="hidden" name="id" value="<?php echo $this->row->id;?>">
</form>
<script src="<?php echo ADMINVIEW;?>/js/discussions.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Discussions({
		url: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		pid: <?php echo $this->row->type_id;?>,
		discname: "<?php echo $this->row->name;?>",
        lang: {
            removeText: "<?php echo Lang::$word->REMOVE;?>",
			showHistory: "<?php echo Lang::$word->TSK_SUB12;?>",
			hideHistory: "<?php echo Lang::$word->TSK_SUB13;?>",
			btnmAdd: "<?php echo Lang::$word->TSK_SUB16;?>",
			btnmUpd: "<?php echo Lang::$word->TSK_SUB17;?>",
        }
    });
});
// ]]>
</script>