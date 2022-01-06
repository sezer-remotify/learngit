<?php
  /**
   * Copy Invitation
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: copyInvitation.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->MAC_COPYLINK;?></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <p>
        <?php echo str_replace("[EMAIL]", '<span class="wojo semi text">' . $this->row->email  . '</span>', Lang::$word->MAC_COPY_I);?>
      </p>
      <div class="wojo divider"></div>
      <div class="wojo action input">
        <input id="tokenText" type="text" value="<?php echo Url::url("/join", "?token=" . $this->row->invite_token);?>" readonly>
        <a class="wojo primary inverted icon button" id="copyText"><i class="icon copy"></i></a>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function () {
	  $('#copyText').click(function() {
		  $('#tokenText').select();
		  document.execCommand('copy');
	  });
  });
// ]]>
</script>