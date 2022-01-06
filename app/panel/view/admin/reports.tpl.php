<?php
  /**
   * Reports
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: reports.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "payments": ?>
<!-- Start payments -->
<?php include("_reports_payments.tpl.php");?>
<?php break;?>
<?php case "uninvoiced": ?>
<!-- Start uninvoiced -->
<?php include("_reports_uninvoiced.tpl.php");?>
<?php break;?>
<!-- Start tasks -->
<?php case "tasks": ?>
<?php include("_reports_tasks.tpl.php");?>
<?php break;?>
<!-- Start workload -->
<?php case "workload": ?>
<?php include("_reports_workload.tpl.php");?>
<?php break;?>
<!-- Start time -->
<?php case "time": ?>
<?php include("_reports_time.tpl.php");?>
<?php break;?>
<!-- Start expense -->
<?php case "expense": ?>
<?php include("_reports_expense.tpl.php");?>
<?php break;?>
<!-- Start tracked -->
<?php case "tracked": ?>
<?php include("_reports_tracked.tpl.php");?>
<?php break;?>
<!-- Start budget -->
<?php case "budget": ?>
<?php include("_reports_budget.tpl.php");?>
<?php break;?>
<?php default: ?>
<?php include("_reports_main.tpl.php");?>
<?php break;?>
<?php endswitch;?>