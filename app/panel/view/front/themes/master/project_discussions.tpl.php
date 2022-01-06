<?php
  /**
   * Project Discussions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: project_discussions.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "new": ?>
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
        <div class="wojo divider"></div>
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
        <div class="wojo fitted divider"></div>
        <div id="fileList" class="wojo items celled"></div>
        <div class="center aligned">
          <button type="button" data-action="processDiscussion" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->MSG_TITLE;?></button>
          <a href="<?php echo Url::url("/dashboard/projects/discussions/", $this->row->id);?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="pid" value="<?php echo $this->row->id;?>">
</form>
<script src="<?php echo THEMEURL;?>/js/discussions.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Discussions({
		url: "<?php echo FRONTVIEW;?>",
		pid: <?php echo $this->row->id;?>,
		discname: "<?php echo $this->row->name;?>",
        lang: {
            removeText: "<?php echo Lang::$word->REMOVE;?>",
        }
    });
});
// ]]>
</script>
<?php break;?>
<!-- Start view -->
<?php case "view": ?>
<?php if($this->row):?>
<p class="wojo small demi text">
  <?php echo $this->prow->name;?> - <?php echo Lang::$word->CREATED_BY;?>
  <?php echo $this->row->created_by_name;?>
  <?php echo strtolower(Lang::$word->ON) . ' ' . Date::doDate("short_date", $this->prow->created);?>
</p>
<div class="wojo space divider"></div>
<h2><?php echo $this->row->name;?></h2>
<div class="wojo small text"><?php echo $this->row->body;?></div>
<div class="wojo divider"></div>
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
          <div class="wojo secondary inverted rounded label"><span class="counter"><?php echo $i--;?></span><?php echo $mrow->created_by_name;?></div>
          <?php echo Date::timesince($mrow->created);?></div>
      </div>
      <div id="msg_<?php echo $mrow->id;?>" class="description"><?php echo $mrow->body;?></div>
    </div>
  </li>
  <?php endforeach;?>
  <?php endif;?>
</ul>
<?php endif;?>
<script src="<?php echo THEMEURL;?>/js/discussions.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Discussions({
		url: "<?php echo FRONTVIEW;?>",
		pid: <?php echo $this->row->type_id;?>,
		discname: "<?php echo $this->row->name;?>",
        lang: {
            removeText: "<?php echo Lang::$word->REMOVE;?>",
        }
    });
});
// ]]>
</script>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<h3><?php echo Lang::$word->MSG_TITLE4;?></h3>
<?php include_once(THEMEBASE . '/snippets/project_header.tpl.php');?>
<div class="wojo form fitted segment">
  <div class="header">
    <div class="items icon"><i class="icon comments"></i>
    </div>
    <div class="items text">
      <h4 class="basic">
        <?php echo Lang::$word->MSG_SUB3;?>
      </h4>
      <a href="<?php echo Url::url("/dashboard/discussions/new", $this->row->id);?>" class="wojo icon text"><i class="icon plus alt"></i><?php echo Lang::$word->MSG_NEW;?></a>
    </div>
  </div>
  <div class="content">
    <div class="wojo very relaxed fluid celled list">
      <?php if(!$this->data):?>
      <div class="item blank align middle center">
        <img src="<?php echo ADMINVIEW;?>/images/comment_empty.svg" alt="" class="wojo center large image">
        <p class="wojo semi grey text"><?php echo Lang::$word->MSG_NOMSG;?></p>
      </div>
      <?php else:?>
      <?php foreach ($this->data as $parent_id => $values) :?>
      <div class="item align middle">
        <div class="content auto">
          <div class="wojo dark inverted label"><i class="icon comments"></i>
            <?php echo isset($this->data[$parent_id]['message']) ? count($this->data[$parent_id]['message']) : 0;?>
          </div>
        </div>
        <div class="content padding left">
          <a href="<?php echo Url::url("/dashboard/discussions/view/" . $this->row->id, $values['id']);?>" class="wojo demi text">
          <?php echo $values['name'];?>
          </a>
          <?php echo $values['is_hidden'] ? '<i class="icon eye blocked"></i>' : '';?>
          <?php if(isset($values['message'])):?>
          <div class="wojo small text description">
            <?php foreach ($values['message'] as $k => $row) :?>
            <span class="wojo grey text">
            <?php echo $row['user'];?>
            </span> : <?php echo Validator::sanitize($row['body'], "default", 100);?>
            <span class="wojo small secondary inverted label">
            <?php echo Date::timeSince($row['created']);?>
            </span>
            <?php break;?>
            <?php endforeach;?>
          </div>
          <?php endif;?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>