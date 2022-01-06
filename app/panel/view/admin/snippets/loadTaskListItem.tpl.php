<?php
  /**
   * Load Invoice Company
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTaskListItem.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<li id="listItem_<?php echo $data->id;?>" class="drop" data-id="<?php echo $data->id;?>">
  <div class="item auto"><a class="handle"><i class="icon reorder"></i></a>
  </div>
  <div class="item" data-name="<?php echo Validator::sanitize($data->name, "chars");?>" data-id="<?php echo $data->id;?>">
    <span><?php echo $data->name;?></span> (<span>0</span>)</div>
</li>