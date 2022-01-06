<?php
  /**
   * Project Notes
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: notes.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "new": ?>
<!-- Start new -->
<?php case "new": ?>
<?php include("_notes_new.tpl.php");?>
<?php break;?>
<!-- Start view -->
<?php case "view": ?>
<?php include("_notes_view.tpl.php");?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include("_notes_grid.tpl.php");?>
<?php break;?>
<?php endswitch;?>