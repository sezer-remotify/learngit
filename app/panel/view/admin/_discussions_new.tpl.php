<?php
  /**
   * New Discussions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _discussions_new.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="row align center">
    <div class="columns screen-70 tablet-100 mobile-100 phone-100">
      <h3><?php echo Lang::$word->MSG_TITLE;?></h3>
      <h4><?php echo $this->row->name;?></h4>
      <div class="wojo segment form">
        <div class="wojo big fluid icon input">
          <i class="icon pencil"></i>
          <input  placeholder="<?php echo Lang::$word->MSG_INFO;?>" type="text" name="name">
        </div>
        <textarea name="body" class="quickpost"></textarea>
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
        <div id="fileList" class="wojo items celled"></div>
        <div class="wojo basic divider"></div>
        <div class="full vertical padding">
          <div class="flex align spaced">
            <span class="wojo small demi grey text"><?php echo Lang::$word->TSK_SUB6;?></span>
            <a data-slide="true" data-trigger="#subData" class="wojo small demi grey text"><?php echo Lang::$word->CHOOSE;?></a>
          </div>
          <div id="subData" class="hide-all">
            <p id="subList" class="wojo small semi text"></p>
            <?php if($this->puserdata):?>
            <div class="row grid screen-2 tablet-2 mobile-1 phone-2">
              <?php foreach($this->puserdata as $prow):?>
              <div class="columns">
                <div id="dSbList_<?php echo $prow->id;?>" class="wojo small checkbox">
                  <input type="checkbox" data-name="<?php echo $prow->name;?>" name="subscribers[]" value="<?php echo $prow->id;?>" id="subs_<?php echo $prow->id;?>">
                  <label for="subs_<?php echo $prow->id;?>"><?php echo $prow->name;?></label>
                </div>
              </div>
              <?php endforeach;?>
            </div>
            <?php endif;?>
          </div>
        </div>
        <div class="wojo basic divider"></div>
        <div class="full vertical padding">
          <div class="wojo fitted toggle checkbox">
            <input type="checkbox" name="is_hidden" value="1" id="dHidden">
            <label for="dHidden"><?php echo Lang::$word->TSK_SUB7;?></label>
          </div>
        </div>
        <div class="wojo fitted divider"></div>
        <div class="center aligned">
          <a href="<?php echo Url::url("/admin/projects/discussions/", $this->row->id);?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
          <button type="button" data-action="processDiscussion" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->MSG_TITLE;?></button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="pid" value="<?php echo $this->row->id;?>">
</form>
<script src="<?php echo ADMINVIEW;?>/js/discussions.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Discussions({
		url: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		pid: <?php echo $this->row->id;?>,
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