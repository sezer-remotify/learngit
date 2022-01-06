<?php
  /**
   * Copy Discussion To Project
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: copyDiscussionToProject.tpl.php,, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo str_replace("[NAME]", '<span class="wojo secondary text">' . $this->row->name  . '</span>', Lang::$word->MSG_TITLE3);?></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <select name="cpid">
            <?php if($this->data):?>
            <?php foreach($this->data as $row):?>
            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php endforeach;?>
            <?php endif;?>
          </select>
        </div>
        <div class="field basic">
          <div class="wojo toggle checkbox">
            <input type="checkbox" name="delete" value="1" checked="checked" id="is_copy">
            <label for="is_copy"><?php echo Lang::$word->MSG_INFO7;?></label>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>