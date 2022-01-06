<?php
  /**
   * Tasks
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: tasks.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "completed": ?>
<?php include "_task_completed.tpl.php";?>
<?php break;?>
<?php default: ?>
<?php include "_task_view.tpl.php";?>
<?php break;?>
<?php endswitch;?>
