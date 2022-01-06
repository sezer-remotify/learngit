<?php
  /**
   * Load Task Comment
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTaskComment.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
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
        <div class="wojo secondary inverted rounded label"><?php echo $data['row']->created_by_name;?></div>
        <?php echo Date::timesince($data['row']->created);?></div>
    </div>
    <div id="msg_<?php echo $data['row']->id;?>" class="description"><?php echo $data['row']->body;?></div>
  </div>
</li>