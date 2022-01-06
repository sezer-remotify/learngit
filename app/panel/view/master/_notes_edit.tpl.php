<?php

/**
 * Notes Edit
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _notes_edit.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<h3>
  <?php echo Lang::$word->PRJ_TITLE2; ?>
</h3>
<h4>
  <?php echo $this->prow->name; ?>
</h4>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form">
    <div class="row gutters">
      <div class="columns screen-70 tablet-60 mobile-100 phone-100">
        <div id="dColor" class="wojo segment" style="background:<?php echo $this->row->color; ?>">
          <div class="wojo fields">
            <div class="field">
              <div class="wojo big basic transparent icon input">
                <i class="icon pencil"></i>
                <input placeholder="<?php echo Lang::$word->NOT_NAME; ?> *" value="<?php echo $this->row->name; ?>" type="text" name="name">
                <a id="bgColor" class="wojo small secondary icon button"><i class="icon contrast"></i></a>
              </div>
            </div>
          </div>
          <div class="wojo notes content">
            <div id="noteBody"><?php echo $this->row->body; ?></div>
          </div>
          <div class="center aligned">
            <a href="<?php echo Url::url("/master/projects/notes", $this->row->project_id); ?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL; ?></a>
            <button type="button" data-action="processNote" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->NOT_UPDATE; ?></button>
          </div>
        </div>
      </div>
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo segment">
          <div class="padding bottom">
            <div class="wojo basic uploader" id="drag-and-drop-zone">
              <div class="content">
                <label class="align spaced">
                  <span class="wojo small demi grey text"><?php echo Lang::$word->ATTACHMENTS; ?></span>
                  <a class="wojo small demi grey text"><?php echo Lang::$word->FMG_UPLFILES; ?></a>
                  <input type="file" multiple name="attach[]">
                </label>
              </div>
            </div>
          </div>
          <div id="fileList" class="wojo items celled">
            <?php if ($this->filedata) : ?>
              <!-- Start Attachments -->
              <?php foreach ($this->filedata as $frow) : ?>
                <div class="item align middle" id="uploadFile_<?php echo $frow->id; ?>">
                  <div class="columns auto">
                    <img src="<?php echo SITEURL; ?>/assets/images/filetypes/<?php echo File::getFileType($frow->name); ?>" class="wojo default rounded image">
                  </div>
                  <div class="columns" id="contentFile_<?php echo $frow->id; ?>">
                    <h6 class="basic"><?php echo $frow->caption; ?></h6>
                    <a class="wojo small negative icon right text iaction" data-set='{"option":[{"iaction":"removeNoteFile", "id":<?php echo $frow->id; ?>,"name":"<?php echo $frow->name; ?>"}], "url":"/helper.php", "complete":"remove", "parent":"#uploadFile_<?php echo $frow->id; ?>"}'><?php echo Lang::$word->REMOVE; ?>
                      <i class="icon close"></i></a>
                  </div>
                  <input type="hidden" value="<?php echo $frow->name; ?>" name="attachment[]">
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div class="padding top">
            <div class="wojo toggle checkbox">
              <input type="checkbox" name="is_hidden" value="1" id="dHidden" <?php Validator::getChecked($this->row->is_hidden, 1); ?>>
              <label for="dHidden"><?php echo Lang::$word->TSK_SUB7; ?></label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="color" value="<?php echo $this->row->color; ?>">
  <input type="hidden" name="pid" value="<?php echo $this->row->project_id; ?>">
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>">
</form>
<script src="<?php echo MASTERVIEW; ?>/js/notes.js"></script>
<script type="text/javascript">
  // <![CDATA[	
  $(document).ready(function() {
    $.Notes({
      url: "<?php echo MASTERVIEW; ?>",
      surl: "<?php echo SITEURL; ?>",
      pid: "<?php echo $this->row->project_id; ?>",
      notename: "<?php echo $this->row->name; ?>",
      lang: {
        removeText: "<?php echo Lang::$word->REMOVE; ?>",
        saveText: "<?php echo Lang::$word->NOT_SAVE; ?>",
        editText: "<?php echo Lang::$word->NOT_EDIT; ?>",
      }
    });
  });
  // ]]>
</script>