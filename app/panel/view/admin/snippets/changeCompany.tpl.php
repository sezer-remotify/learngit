<?php
  /**
   * Change Company
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: changeCompany.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->CHANGECMP;?><span class="wojo secondary text"><?php echo $this->row->fname . ' ' . $this->row->lname?></span></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="basic field">
          <label><?php echo Lang::$word->MAC_SUB10;?>:</label>
          <select name="company">
            <option value="0">--- <?php echo Lang::$word->CMP_SELECT;?> ---</option>
            <?php echo Utility::loopOptions($this->companies, "id", "name", $this->row->company);?>
          </select>
        </div>
      </div>
    </form>
  </div>
</div>