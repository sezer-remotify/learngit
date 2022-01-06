<?php
  /**
   * Copy Task List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: copyTaskList.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
	  
  if(!$this->data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->TSK_SUB;?></h5>
</div>
<div class="body">
  <div class="wojo form content">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->INV_SUB5_3;?></label>
          <select name="cpid">
            <?php if($this->data):?>
            <?php foreach($this->data as $row):?>
            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php endforeach;?>
            <?php endif;?>
          </select>
        </div>
      </div>
    </form>
  </div>
</div>