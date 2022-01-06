<?php
  /**
   * Estimates
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: estimates.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_estimates')): print Message::msgError(Lang::$word->NOACCESS); return; endif; 
?>
<?php switch(Url::segment($this->segments)): case "edit": case "duplicate": ?>
<!-- Start edit -->
<?php include("_estimate_edit.tpl.php");?>
<?php break;?>
<!-- Start new -->
<?php case "new": ?>
<?php include("_estimate_new.tpl.php");?>
<?php break;?>
<!-- Start project -->
<?php case "project": ?>
<?php include("_estimate_project.tpl.php");?>
<?php break;?>
<!-- Start archive -->
<?php case "archive": ?>
<?php include("_estimate_archive.tpl.php");?>
<?php break;?>
<!-- Start view -->
<?php case "view": ?>
<?php include("_estimate_view.tpl.php");?>
<?php break;?>
<!-- Start invoice -->
<?php case "invoice": ?>
<?php include("_estimate_invoice.tpl.php");?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include("_estimate_list.tpl.php");?>
<?php break;?>
<?php endswitch;?>