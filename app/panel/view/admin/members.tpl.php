<?php
  /**
   * Members
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: members.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_people')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "details": ?>
<!-- Start edit -->
<?php include("_members_details.tpl.php");?>
<?php break;?>
<!-- Start new -->
<?php case "archive": ?>
<?php include("_members_archive.tpl.php");?>
<?php break;?>
<!-- Start history -->
<?php case "invite": ?>
<?php include("_members_invite.tpl.php");?>
<?php break;?>
<!-- Start grid -->
<?php case "grid": ?>
<?php include("_members_grid.tpl.php");?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include("_members_list.tpl.php");?>
<?php break;?>
<?php endswitch;?>