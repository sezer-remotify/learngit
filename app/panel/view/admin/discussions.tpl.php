<?php
  /**
   * Discussions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: discussions.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<?php include"_discussions_edit.tpl.php";?>
<?php break;?>
<!-- Start new -->
<?php case "new": ?>
<?php include"_discussions_new.tpl.php";?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include"_discussions_view.tpl.php";?>
<?php break;?>
<?php endswitch;?>
