<?php
  /**
   * Add To Projects
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: addToProjects.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
      $data = Project::getProjectPermissions($this->row->id);
?>
<div class="header">
  <h5><?php echo Lang::$word->ADDPROJECT;?><span class="wojo secondary text"><?php echo $this->row->fname . ' ' . $this->row->lname?></span></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <label><?php echo Lang::$word->MAC_SUB9;?>:</label>
          <?php if($this->projects):?>
          <div class="padding top">
            <div class="row grid small gutters screen-2 tablet-2 mobile-2 phone-1">
              <?php foreach ($this->projects as $row):?>
              <div class="columns">
                <div class="wojo fitted checkbox">
                  <?php $check = in_array($row->id, $data) ? ' checked="checked"' : null;?>
                  <input type="checkbox" name="projects[]" value="<?php echo $row->id;?>"<?php echo $check;?> id="check_<?php echo $row->id;?>">
                  <label for="check_<?php echo $row->id;?>"><?php echo $row->name;?></label>
                </div>
              </div>
              <?php endforeach;?>
            </div>
          </div>
          <?php endif;?>
        </div>
        <div class="basic field">
          <label><?php echo Lang::$word->ACC_NOTIFY;?></label>
          <div class="wojo toggle checkbox">
            <input type="checkbox" name="notify" value="1" checked id="notify_1">
            <label for="notify_1"><?php echo Lang::$word->YES;?></label>
          </div>
        </div>
      </div>
      <input name="fullname" type="hidden" value="<?php echo $this->row->fname . ' ' . $this->row->lname;?>">
      <input name="email" type="hidden" value="<?php echo $this->row->email;?>">
    </form>
  </div>
</div>
