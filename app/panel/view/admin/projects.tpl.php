<?php
  /**
   * Projects
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: projects.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<?php include"_project_edit.tpl.php";?>
<?php break;?>
<!-- Start new -->
<?php case "new": ?>
<?php include"_project_new.tpl.php";?>
<?php break;?>
<!-- Start invite -->
<?php case "invite": ?>
<?php include"_project_invite.tpl.php";?>
<?php break;?>
<!-- Start archive -->
<?php case "archive": ?>
<?php include"_project_archive.tpl.php";?>
<?php break;?>
<!-- Start view -->
<?php case "tasks": ?>
<?php include"_project_tasks.tpl.php";?>
<?php break;?>
<!-- Start view -->
<?php case "bids": ?>
<?php include"_project_bids.tpl.php";?>
<?php break;?>
<!-- Start discussions -->
<?php case "discussions": ?>
<?php include"_project_discussions.tpl.php";?>
<?php break;?>
<!-- Start files -->
<?php case "files": ?>
<?php include"_project_files.tpl.php";?>
<?php break;?>
<!-- Start notes -->
<?php case "notes": ?>
<?php include"_project_notes.tpl.php";?>
<?php break;?>
<!-- Start time -->
<?php case "time": ?>
<?php include"_project_time.tpl.php";?>
<?php break;?>
<!-- Start notes -->
<?php case "expenses": ?>
<?php include"_project_expenses.tpl.php";?>
<?php break;?>
<!-- Start notes -->
<?php case "activity": ?>
<?php include"_project_activity.tpl.php";?>
<?php break;?>
<!-- Start list -->
<?php case "list": ?>
<?php include"_project_list.tpl.php";?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include"_project_grid.tpl.php";?>
<?php break;?>
<?php endswitch;?>