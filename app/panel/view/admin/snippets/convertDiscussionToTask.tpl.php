<?php
  /**
   * Convert Discussion To Task
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: convertDiscussionToTask.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo str_replace("[NAME]", '<span class="wojo secondary text">' . $this->row->name  . '</span>', Lang::$word->MSG_TITLE2);?></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo primary message">
        <div class="content">
          <?php echo Lang::$word->MSG_INFO3;?></div>
      </div>
    </form>
  </div>
</div>