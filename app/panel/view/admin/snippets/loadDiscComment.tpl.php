<?php
  /**
   * Load Discussion Comment
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadDiscComment.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$data) : Message::invalid("ID" . $data['items']['id']); return; endif;
?>
<li class="item" id="item_<?php echo $data['row']->id;?>">
  <div class="badge">
    <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $data['items']['avatar'] ? $data['items']['avatar'] : "blank.svg" ;?>">
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns">
        <a class="wojo secondary inverted rounded label" href="<?php echo Url::url("/admin/members/details", $data['row']->created_by_id);?>"><?php echo $data['row']->created_by_name;?></a>
        <?php echo Date::timesince($data['row']->created);?></div>
      <div class="columns auto">
        <a class="grey" data-dropdown="#discDrop_<?php echo $data['row']->id;?>">
        <i class="icon horizontal ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="discDrop_<?php echo $data['row']->id;?>">
          <!-- Start editMessage -->
          <a class="editMessage item" data-id="<?php echo $data['row']->id;?>"><?php echo Lang::$word->EDIT;?></a>
          <div class="divider"></div>
          <!-- Start trashDiscMessage -->
          <a data-set='{"option":[{"trash": "trashDiscMessage","title": "<?php echo Lang::$word->TSK_SUB15 . ' #';?>","id":<?php echo $data['row']->id;?>, "discname": "<?php echo $data['items']['discname'];?>", "pid":<?php echo $data['items']['pid'];?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>","parent":"#item_<?php echo $data['row']->id;?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div>
      </div>
    </div>
    <div id="msg_<?php echo $data['row']->id;?>" class="description"><?php echo $data['row']->body;?></div>
  </div>
</li>