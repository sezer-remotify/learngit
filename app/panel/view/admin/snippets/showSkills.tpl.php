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
?>
<div class="header">
  <h5><?php echo Lang::$word->SKILLS;?><span class="wojo secondary text"><?php echo $this->row[0]->fullname?></span></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
      <div class="field">
              <?php echo $this->row[0]->skills;?></div>
      </div>
      </div>
    </form>
  </div>
</div>