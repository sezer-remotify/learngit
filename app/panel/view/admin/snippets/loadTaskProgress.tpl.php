<?php
  /**
   * Load Task Progress
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTaskProgress.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<p class="wojo grey text">
  <?php echo str_replace(array("[a]", "[b]", "[c]"), array($this->row->closed, $this->row->total, "<br>" . $this->row->open), Lang::$word->TSK_TSKPRGS);?></p>
<div class="wojo mini positive progress">
  <div class="bar" style="width:<?php echo $this->row->total ? Utility::doPercent($this->row->closed, $this->row->total) : 0;?>%"></div>
</div>
<a href="<?php echo Url::url("/admin/tasks/completed", $this->id);?>" class="wojo demi text"><?php echo Lang::$word->TSK_SUB2;?></a>