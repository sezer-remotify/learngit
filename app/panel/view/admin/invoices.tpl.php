<?php
  /**
   * Invoices
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: invoices.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "edit": case "duplicate": ?>
<!-- Start edit -->
<?php  if(!Auth::hasPrivileges('edit_invoice')): print Message::msgError(Lang::$word->NOACCESS); return; endif;?>
<?php include("_invoice_edit.tpl.php");?>
<?php break;?>
<!-- Start new -->
<?php case "new": case "newr":?>
<?php include("_invoice_new.tpl.php");?>
<?php break;?>
<!-- Start project -->
<?php case "project": ?>
<?php include("_invoice_project.tpl.php");?>
<?php break;?>
<!-- Start recurring -->
<?php case "recurring": ?>
<?php  if(!Auth::hasPrivileges('manage_invoices')): print Message::msgError(Lang::$word->NOACCESS); return; endif;?>
<?php include("_invoice_recurring.tpl.php");?>
<?php break;?>
<!-- Start canceled -->
<?php case "canceled": ?>
<?php  if(!Auth::hasPrivileges('manage_invoices')): print Message::msgError(Lang::$word->NOACCESS); return; endif;?>
<?php include("_invoice_archive.tpl.php");?>
<?php break;?>
<!-- Start view -->
<?php case "view": ?>
<?php  if(!Auth::hasPrivileges('manage_invoices')): print Message::msgError(Lang::$word->NOACCESS); return; endif;?>
<?php include("_invoice_view.tpl.php");?>
<?php break;?>
<!-- Start grid -->
<?php case "grid": ?>
<?php include("_invoice_grid.tpl.php");?>
<?php  if(!Auth::hasPrivileges('manage_invoices')): print Message::msgError(Lang::$word->NOACCESS); return; endif;?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include("_invoice_list.tpl.php");?>
<?php  if(!Auth::hasPrivileges('manage_invoices')): print Message::msgError(Lang::$word->NOACCESS); return; endif;?>
<?php break;?>
<?php endswitch;?>