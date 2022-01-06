<?php
  /**
   * Project Notes New
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _notes_new.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_TITLE2;?></h3>
<h4><?php echo $this->row->name;?></h4>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form">
    <div class="row gutters">
      <div class="columns screen-70 tablet-60 mobile-100 phone-100">
        <div id="dColor" class="wojo segment">
          <div class="wojo fields">
            <div class="field">
              <div class="wojo big basic transparent icon input">
                <i class="icon pencil"></i>
                <input placeholder="<?php echo Lang::$word->NOT_NAME;?> *" type="text" name="name">
                <a id="bgColor" class="wojo small primary icon button"><i class="icon contrast"></i></a>
              </div>
            </div>
          </div>
          <div class="wojo notes content">
            <div id="noteBody"></div>
          </div>
          <div class="center aligned">
            <a href="<?php echo Url::url("/dashboard/projects/notes", $this->row->id);?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
            <button type="button" data-action="processNote" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->NOT_NEW;?></button>
          </div>
        </div>
      </div>
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo segment">
          <div class="wojo basic uploader" id="drag-and-drop-zone">
            <div class="content">
              <label class="align spaced">
                <span class="wojo small demi grey text"><?php echo Lang::$word->ATTACHMENTS;?></span>
                <a class="wojo small demi grey text"><?php echo Lang::$word->FMG_UPLFILES;?></a>
                <input type="file" multiple name="attach[]">
              </label>
            </div>
          </div>
          <div id="fileList" class="wojo items celled"></div>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="color">
  <input type="hidden" name="pid" value="<?php echo $this->row->id;?>">
</form>
<script src="<?php echo THEMEURL;?>/js/notes.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Notes({
		url: "<?php echo FRONTVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		pid: "<?php echo $this->row->id;?>",
		notename: "<?php echo $this->row->name;?>",
		is_edit: false,
        lang: {
            removeText: "<?php echo Lang::$word->REMOVE;?>",
			saveText: "<?php echo Lang::$word->NOT_SAVE;?>",
			editText: "<?php echo Lang::$word->NOT_EDIT;?>",
        }
    });
});
// ]]>
</script>