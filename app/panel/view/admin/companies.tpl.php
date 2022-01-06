<?php
  /**
   * Companies
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: companies.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_companies')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<?php include("_company_edit.tpl.php");?>
<?php break;?>
<!-- Start new -->
<?php case "view": ?>
<?php include("_company_view.tpl.php");?>
<?php break;?>
<!-- Start history -->
<?php case "new": ?>
<?php include("_company_new.tpl.php");?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php Url::redirect(Url::url("admin/members"));?>
<?php break;?>
<?php endswitch;?>