<?php
  /**
   * Task
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: task.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_SUB12;?></h3>
<h4><?php echo $this->row->name;?></h4>
<div class="wojo segment">
  <p class="wojo small text">
    <?php echo $this->row->name;?></a>
    - <?php echo Lang::$word->TSK_TASK . '#' . $this->row->id;?> - <?php echo Lang::$word->CREATED_BY;?>
    <?php echo $this->task->created_by_name;?>
    <?php echo strtolower(Lang::$word->ON) . ' ' . Date::doDate("short_date", $this->task->created);?>
  </p>
  <div class="wojo space divider"></div>
  <h4><?php echo $this->task->name;?></h4>
  <?php echo $this->task->body;?>
  <?php if($this->filedata):?>
  <!-- Start Attachments -->
  <div class="wojo space divider"></div>
  <h6><?php echo Lang::$word->ATTACHMENTS;?></h6>
  <div id="fileList" class="wojo small fluid relaxed celled list">
    <?php foreach($this->filedata as $frow):?>
    <div class="item align middle">
      <div class="content auto padding right">
        <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($frow->name);?>" class="wojo default rounded image">
      </div>
      <div class="content">
        <p class="header"><?php echo $frow->caption;?></p>
        <p class="wojo tiny text">
          <?php echo File::getSize($frow->fsize);?> - <a href="<?php echo SITEURL;?>/download.php?id=<?php echo $frow->id;?>"><?php echo Lang::$word->DOWNLOAD;?></a>
        </p>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>
<h6><?php echo Lang::$word->MSG_DISC;?></h6>
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

<!-- Start Comments -->
<ul id="dComments" class="wojo timeline">
  <?php if($this->messages):?>
  <?php $i = count($this->messages);?>
  <?php foreach($this->messages as $mrow):?>
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
<script src="<?php echo THEMEURL;?>/js/view_tasks.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Tasks({
		url: "<?php echo FRONTVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		pid: "<?php echo $this->task->project_id;?>",
		taskname: "<?php echo $this->task->name;?>",
		  lang: {
			  btnmAdd: "<?php echo Lang::$word->TSK_SUB16;?>",
			  btnmUpd: "<?php echo Lang::$word->TSK_SUB17;?>",
		  }
    });
});
// ]]>
</script>