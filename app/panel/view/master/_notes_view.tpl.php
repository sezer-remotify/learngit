<?php

/**
 * Notes View
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _notes_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_TITLE2; ?></h3>
<h4><?php echo $this->prow->name; ?></h4>
<div class="row gutters">
  <div class="columns screen-70 tablet-60 mobile-100 phone-100">
    <div class="wojo segment" style="background:<?php echo $this->row->color; ?>">
      <div class="row">
        <div class="columns phone-100">
          <p class="wojo small text">
            <?php echo Lang::$word->IN; ?>
            <a href="<?php echo Url::url("/master/projects/notes/", $this->prow->id); ?>"><?php echo $this->prow->name; ?></a>
            - <?php echo Lang::$word->CREATED_BY; ?>
            <a href="<?php echo Url::url("/master/profile/view", $this->row->created_by_email); ?>"><?php echo $this->row->created_by_name; ?></a>
            <?php echo strtolower(Lang::$word->ON) . ' ' . Date::doDate("short_date", $this->row->created); ?>
          </p>
        </div>
        <?php if (Auth::$udata->uid == $this->row->created_by_id) : ?>
          <div class="columns auto phone-100">
            <div class="wojo white small buttons rounded">
              <a href="<?php echo Url::url("/master/notes/edit", $this->row->id); ?>" class="wojo button"><?php echo Lang::$word->NOT_EDIT; ?></a>
              <a class="wojo  button  iaction" data-set='{"option":[{"iaction":"removeNote", "id":<?php echo $this->row->id; ?>,"name":"<?php echo $this->row->name; ?>"}], "url":"/helper.php", "complete":"","redirect":"<?php echo  Url::url("/master/projects/notes/", $this->prow->id); ?>"}'><i class="icon horizontal trash margin-0"></i></a>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <h4><?php echo $this->row->name; ?>
        <span id="dHidden"><?php echo $this->row->is_hidden ? '<i class="icon mask"></i>' : null; ?></span>
      </h4>
      <div class="wojo big space divider"></div>
      <div class="wojo notes content">
        <?php echo $this->row->body; ?>
      </div>
    </div>
  </div>
  <div class="columns screen-30 tablet-40 mobile-100 phone-100">
    <div class="wojo segment">

      <?php if (Auth::$udata->uid == $this->row->created_by_id) : ?>
        <h6><?php echo Lang::$word->TSK_SUB6; ?></h6>
        <div id="subData">
          <?php if ($this->puserdata) : ?>
            <?php $key = $this->noteusers ? explode(",", $this->noteusers->uid) : []; ?>
            <div id="subscList">
              <?php foreach ($this->puserdata as $urow) : ?>
                <?php $checked = (in_array($urow->id, $key) ? ' checked="checked"' : ''); ?>
                <div class="quarter-top-space">
                  <div id="dSbList_<?php echo $urow->id; ?>" class="wojo small checkbox">
                    <input type="checkbox" data-name="<?php echo $urow->name; ?>" name="subscribers[]" value="<?php echo $urow->id; ?>" <?php echo $checked; ?> id="dSub_<?php echo $urow->id; ?>">
                    <label for="dSub_<?php echo $urow->id; ?>"><?php echo $urow->name; ?></label>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
        <div id="dIsHidden" class="wojo toggle checkbox">
          <input type="checkbox" name="is_hidden" value="1" id="hid_1" <?php Validator::getChecked($this->row->is_hidden, 1); ?>>
          <label for="hid_1"><?php echo Lang::$word->TSK_SUB7; ?></label>
        </div>
      <?php endif; ?>
      <h6><?php echo Lang::$word->ATTACHMENTS; ?></h6>
      <?php if ($this->filedata) : ?>
        <!-- Start Attachments -->
        <div id="fileList" class="wojo small fluid relaxed celled list">
          <?php foreach ($this->filedata as $frow) : ?>
            <div class="item align middle">
              <img src="<?php echo SITEURL; ?>/assets/images/filetypes/<?php echo File::getFileType($frow->name); ?>" class="wojo small rounded shadow image">
              <div class="columns">
                <p class="header"><?php echo $frow->caption; ?></p>
                <p class="wojo tiny text"><?php echo File::getSize($frow->fsize); ?> - <a href="<?php echo SITEURL; ?>/download.php?id=<?php echo $frow->id; ?>"><?php echo Lang::$word->DOWNLOAD; ?></a>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
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