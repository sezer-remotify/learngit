<?php
  /**
   * Resend Invitation
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: resendInvitation.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <p>
        <?php echo str_replace("[NAME]", '<span class="wojo bold text">' . $this->row->email  . '</span>', Lang::$word->MAC_RESEND_C);?>
      </p>
    </form>
  </div>
</div>