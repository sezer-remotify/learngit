<?php

/**
 * Projects
 *
 * @package Wojo Framework
 * @author MOHAMMAD ILYAS KOHISTANI
 * @copyright 2019
 * @version $Id: projects.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>

<style>
  .alert
  {
    display:none;
  }
  .wojo.message {
	border-radius: 7px!important;
	border: thin solid #5b5b5b10!important;
	box-shadow: 0px 14px 10px -10px rgba(0, 0, 0, 0.1)!important;
	margin-bottom: 20px!important;
}
.wojo.message h3{
	color:#5b5b5b;
}
</style>
<?php if (App::Auth()->Is_Freelancer()) : ?>
  <?php switch (Url::segment($this->segments)):
    case "view": ?>
      <!-- start view project -->
      <?php
      if (in_array(Auth::$udata->uid, array_column((array)$this->puRow, 'user_id')))
        include "_project_view.tpl.php";
      else {
        Url::redirect(Url::url("/"));
        exit;
      }
      ?>
      <?php break; ?>
      <!-- Start list -->
    <?php
    case "list": ?>
      <?php include "_project_list.tpl.php"; ?>
      <?php break; ?>
    <?php
    default: ?>
      <?php
      if (!Url::segment($this->segments))
        include "_project_grid.tpl.php";
      else  Url::redirect(Url::url("/master/projects"));
      ?>
      <?php break; ?>
  <?php endswitch; ?>
<?php else : ?>
  <?php if (Url::segment($this->segments, 0) === 'startProject') : ?>
    <?php include "_project_add.tpl.php";
    exit; ?>
  <?php endif; ?>
  <?php switch (Url::segment($this->segments)):
    case "edit": ?>
      <!-- Start edit -->
      <?php include "_project_edit.tpl.php"; ?>
      <?php break; ?>
      <!-- Start new -->
    <?php
    case "new": ?>
      <?php include "_project_add.tpl.php"; ?>
      <?php break; ?>
      <!-- View project -->
    <?php
    case "view": ?>
      <?php
      if (in_array(Auth::$udata->uid, array_column((array)$this->puRow, 'user_id')))
        include "_project_view.tpl.php";
      else {
        Url::redirect(Url::url("/"));
        exit;
      }
      ?>
      <?php break; ?>
      <!-- Start invite -->
    <?php
    case "invite": ?>
      <?php include "_project_invite.tpl.php"; ?>
      <?php break; ?>
      <!-- Start archive -->
    <?php
    case "archive": ?>
      <?php include "_project_archive.tpl.php"; ?>
      <?php break; ?>
      <!-- Start view -->
    <?php
    case "tasks": ?>
      <?php include "_project_tasks.tpl.php"; ?>
      <?php break; ?>
      <!-- Start discussions -->
    <?php
    case "discussions": ?>
      <?php include "_project_discussions.tpl.php"; ?>
      <?php break; ?>
      <!-- Start files -->
    <?php
    case "files": ?>
      <?php include "_project_files.tpl.php"; ?>
      <?php break; ?>
      <!-- Start notes -->
    <?php
    case "notes": ?>
      <?php include "_project_notes.tpl.php"; ?>
      <?php break; ?>
      <!-- Start time -->
    <?php
    case "time": ?>
      <?php include "_project_time.tpl.php"; ?>
      <?php break; ?>
      <!-- Start notes -->
    <?php
    case "expenses": ?>
      <?php include "_project_expenses.tpl.php"; ?>
      <?php break; ?>
      <!-- Start notes -->
    <?php
    case "activity": ?>
      <?php include "_project_activity.tpl.php"; ?>
      <?php break; ?>
      <!-- Start list -->
    <?php
    case "list": ?>
      <?php include "_project_list.tpl.php"; ?>
      <?php break; ?>
      <!-- Start bids -->
    <?php
    case "bids": ?>
      <?php include "_project_bids.tpl.php"; ?>
      <?php break; ?>
      <!-- Start default -->
    <?php
    default: ?>
      <?php include "_project_grid.tpl.php"; ?>
      <?php break; ?>
  <?php endswitch; ?>

<?php endif; ?>

<script>
  $(document).ready( function(){
      $(".alert").toggle("slide", {"direction":"up"}, "slow");
    setTimeout(function(){
        //$(".alert").toggle("slide", {"direction":"up"}, "slow");
      }, 3500);
  });

    </script>
