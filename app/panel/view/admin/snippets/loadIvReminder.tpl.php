<?php
  /**
   * Load Invoice Reminder
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadIvReminder.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<?php if($data->pstatus <> 2):?>
<a id="act_<?php echo $data->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $data->id;?>}], "label":"<?php echo $data->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $data->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $data->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
<?php endif;?>