<?php
  /**
   * View Discussions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _discussions_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>

<a href="<?php echo Url::url("/admin/projects/discussions", $this->row->type_id);?>" class="wojo mini button">
<i class="icon long arrow left"></i>
<?php echo str_replace("[NAME]", $this->prow->name . ' ' . Lang::$word->MSG_DISC, Lang::$word->BACKTO);?>
</a>
<div class="row gutters">
  <div class="columns screen-70 tablet-70 mobile-100 phone-100">
    <div class="row align middle">
      <div class="columns">
        <p class="wojo small demi text">
          <a href="<?php echo Url::url("/admin/projects/tasks", $this->prow->id);?>"><?php echo $this->prow->name;?></a>
          - <?php echo Lang::$word->CREATED_BY;?>
          <a href="<?php echo Url::url("/admin/members/details", $this->row->created_by_id);?>"><?php echo $this->row->created_by_name;?></a>
          <?php echo strtolower(Lang::$word->ON) . ' ' . Date::doDate("short_date", $this->prow->created);?>
        </p>
      </div>
      <div class="columns auto">
        <div class="wojo small white rounded buttons">
          <a class="wojo button" href="<?php echo Url::url("/admin/discussions/edit", $this->row->id);?>"><?php echo Lang::$word->MSG_EDIT;?></a>
          <a class="wojo icon button" data-dropdown="#disMenu"><i class="icon horizontal ellipsis"></i></a>
        </div>
        <div class="wojo dropdown small pointing top-right" id="disMenu">
          <!-- Start convertDiscussionToTask -->
          <a data-set='{"option":[{"action":"convertDiscussionToTask","id": <?php echo $this->row->id;?>, "pid":<?php echo $this->prow->id;?>}], "label":"<?php echo Lang::$word->MSG_SUB1;?>", "url":"helper.php", "parent":"#item_<?php echo $this->row->id;?>", "complete":"highlite", "modalclass":"normal","redirect":true}' class="item action"><?php echo Lang::$word->MSG_SUB1;?></a>
          
          <!-- Start copyDiscussionToProject -->
          <a data-set='{"option":[{"action":"copyDiscussionToProject","id": <?php echo $this->row->id;?>, "pid":<?php echo $this->prow->id;?>}], "label":"<?php echo Lang::$word->OK;?>", "url":"helper.php", "parent":"#item_<?php echo $this->row->id;?>", "complete":"highlite", "modalclass":"normal","redirect":true}' class="item action"><?php echo Lang::$word->MSG_SUB2;?></a>
          <div class="divider"></div>
          <!-- Start trashMessage -->
          <a data-set='{"option":[{"trash": "trashMessage","title": "<?php echo Validator::sanitize($this->row->name, "chars");?>","id": "<?php echo $this->row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $this->row->id;?>","redirect":"<?php echo Url::url("/admin/projects/discussions", $this->prow->id);?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div>
      </div>
    </div>
    <h3>
      <?php echo $this->row->name;?>
      <span id="dHidden"><?php echo ($this->row->is_hidden) ? '<i class="icon negative mask"></i>' : null;?></span>
    </h3>
    <div class="wojo small text"><?php echo $this->row->body;?></div>
    <?php if($this->filedata):?>
    <!-- Start Attachments -->
    <div class="wojo segment">
      <h6><?php echo Lang::$word->ATTACHMENTS;?></h6>
      <div id="fileList" class="wojo fluid relaxed celled list">
        <?php foreach($this->filedata as $frow):?>
        <div class="item">
          <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($frow->name);?>" class="wojo small rounded shadow image">
          <div class="content">
            <p class="header"><?php echo $frow->caption;?></p>
            <div class="wojo small text"><?php echo Date::doDate("long_date", $frow->created);?></div>
            <div class="wojo small text"><?php echo File::getSize($frow->fsize);?>
              <span class="wojo vertical divider"></span>
              <a href="<?php echo SITEURL;?>/download.php?id=<?php echo $frow->id;?>"><?php echo Lang::$word->DOWNLOAD;?></a>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <?php endif;?>
    <div class="wojo small segment form">
      <h6><?php echo Lang::$word->MSG_DISCN;?></h6>
      <div class="row align middle">
        <div class="columns auto"><img src="<?php echo UPLOADURL;?>/avatars/<?php echo App::Auth()->avatar ? App::Auth()->avatar : "blank.svg";?>" alt="" class="wojo small circular image"></div>
        <div class="columns padding left">
          <div class="is_editor wojo segment"><?php echo Lang::$word->TSK_INFO5;?></div>
          <div id="cButtons" class="hide-all small full padding">
            <button name="doComments" type="button" data-id="0" class="wojo small primary button">
            <?php echo Lang::$word->TSK_SUB16;?>
            </button>
            <a id="cCancel" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Start Comments -->
    <ul id="dComments" class="wojo timeline">
      <?php $i = ($this->data) ? count($this->data) : 0;?>
      <?php if($this->data):?>
      <?php foreach($this->data as $mrow):?>
      <li class="item" id="item_<?php echo $mrow->id;?>">
        <div class="badge">
          <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $mrow->avatar ? $mrow->avatar : "blank.svg" ;?>">
        </div>
        <div class="content">
          <div class="row align middle">
            <div class="columns">
              <a class="wojo secondary inverted rounded label" href="<?php echo Url::url("/admin/members/details", $mrow->created_by_id);?>"><span class="counter"><?php echo $i--;?></span><?php echo $mrow->created_by_name;?></a>
              <?php echo Date::timesince($mrow->created);?></div>
            <div class="columns auto">
              <a class="grey" data-dropdown="#discDrop_<?php echo $mrow->id;?>">
              <i class="icon horizontal ellipsis"></i>
              </a>
              <div class="wojo dropdown small pointing top-right" id="discDrop_<?php echo $mrow->id;?>">
                <!-- Start editMessage -->
                <a class="editMessage item" data-id="<?php echo $mrow->id;?>"><?php echo Lang::$word->EDIT;?></a>
                <div class="divider"></div>
                <!-- Start trashDiscMessage -->
                <a data-set='{"option":[{"trash": "trashDiscMessage","title": "<?php echo Validator::sanitize(Lang::$word->TSK_SUB15 . ' #' . $i, "chars");?>","id":<?php echo $mrow->id;?>, "pid":<?php echo $this->prow->id;?>,"discname": "<?php echo $this->row->name;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $mrow->id;?>"}' class="item wojo demi text data">
                <?php echo Lang::$word->MTOTRASH;?>
                </a>
              </div>
            </div>
          </div>
          <div id="msg_<?php echo $mrow->id;?>" class="description"><?php echo $mrow->body;?></div>
        </div>
      </li>
      <?php endforeach;?>
      <?php endif;?>
    </ul>
    <p><a id="showHistory" class="wojo small semi icon right text"><?php echo Lang::$word->TSK_SUB12;?>
      <i class="icon chevron black down"></i></a>
    </p>
    <div id="tHistory" class="hide-all">
    </div>
  </div>
  <div class="columns screen-30 tablet-30 mobile-100 phone-100">
    <div class="wojo segment">
      <h4><?php echo Lang::$word->TSK_SUB6;?></h4>
      <div id="subData">
        <div class="wojo small space divider"></div>
        <?php if($this->puserdata):?>
        <?php $key = $this->messageusers ? explode(",", $this->messageusers->uid) : [];?>
        <div id="subscList">
          <?php foreach($this->puserdata as $urow):?>
          <?php $checked = (in_array($urow->id, $key) ? ' checked="checked"' : '');?>
          <div class="wojo small checkbox">
            <input type="checkbox" data-name="<?php echo $urow->name;?>" name="subscribers[]" value="<?php echo $urow->id;?>"<?php echo $checked;?> id="dSbList_<?php echo $urow->id;?>">
            <label for="dSbList_<?php echo $urow->id;?>"><?php echo $urow->name;?></label>
          </div>
          <?php endforeach;?>
        </div>
        <?php endif;?>
      </div>
      <div class="wojo divider"></div>
      <div class="wojo toggle fitted checkbox">
        <input type="checkbox" name="is_hidden" value="1" <?php Validator::getChecked($this->row->is_hidden, 1);?> id="dIsHidden">
        <label for="dIsHidden"><?php echo Lang::$word->TSK_SUB7;?></label>
      </div>
    </div>
  </div>
</div>
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
