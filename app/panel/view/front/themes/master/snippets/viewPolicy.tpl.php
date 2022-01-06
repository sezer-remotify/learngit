<?php
  /**
   * View Policy
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: viewPolicy.tpl.php, v1.00 2017-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="header">
  <h5><?php echo Lang::$word->PRIVACY;?></h5>
</div>
<div class="body">
  <?php echo $this->row;?>
</div>