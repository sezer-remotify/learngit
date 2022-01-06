<?php

/**
 * Helper
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: helper.php, v1.00 2019-08-05 10:12:05 gewa Exp $
 */
define("_WOJO", true);
require_once("../../init.php");

if (!App::Auth()->is_Admin())
	exit;

$gAction = Validator::get('action');
$pAction = Validator::post('action');
$iAction = Validator::post('iaction');
$title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;
/* == GET Actions == */
switch ($gAction):
		/* == Add user Notes == */
	case "addUserNote":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
		$tpl->note = Db::run()->first(Users::nTable, array('note'), array('uid' => Filter::$id));
		$tpl->template = 'addUserNote.tpl.php';
		echo $tpl->render();
	break;
		/* == Short CV == */
		case "showShortCV":
			$tpl = App::View(BASEPATH . 'view/admin/snippets/');
			$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
			$tpl->template = 'shortCV.tpl.php';
			echo $tpl->render();
		break;
		/* == Add To Client Projects == */
	case "addtoClientProjects":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
		$tpl->projects = App::Project()->getClientProjects();
		$tpl->template = 'addToProjects.tpl.php';
		echo $tpl->render();
		break;
		/* == showSkillsOfUserInPopup == */
	case "showSkills":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$sql = "
							SELECT 
								CONCAT(u.fname, ' ', u.lname) AS fullname,
								u.id AS uid,
								u.headline AS headline,
								GROUP_CONCAT(sk.name SEPARATOR ', ') AS skills
							FROM
								`" . Users::mTable . "`  AS u
								LEFT JOIN `" . Users::smTable . "` AS su
								ON u.id = su.uid
								LEFT JOIN `" . Project::sTable . "` AS sk
								ON su.sid = sk.id
							WHERE u.userlevel = 21
							AND u.id = " . Filter::$id . "
							GROUP BY u.id;";
		$tpl->row =  Db::run()->pdoQuery($sql, array(1, 0))->results();
		$tpl->projects = App::Project()->getClientProjects();
		$tpl->template = 'showSkills.tpl.php';
		echo $tpl->render();
		break;
		case "showSkillsConf":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$sql = "
							SELECT 
								CONCAT(u.fname, ' ', u.lname) AS fullname,
								u.id AS uid,
								u.headline AS headline,
								GROUP_CONCAT(sk.name SEPARATOR ', ') AS skills
							FROM
								`" . Users::mTable . "`  AS u
								LEFT JOIN `" . Users::smTable . "` AS su
								ON u.id = su.uid
								LEFT JOIN `" . Project::sTable . "` AS sk
								ON su.sid = sk.id
							WHERE u.userlevel = 21
							AND u.id = " . Filter::$id . "
							AND su.confirmed=1
							GROUP BY u.id;";
		$tpl->row =  Db::run()->pdoQuery($sql, array(1, 0))->results();
		$tpl->projects = App::Project()->getClientProjects();
		$tpl->template = 'showSkills.tpl.php';
		echo $tpl->render();
		break;
		/* == Load Invoice Entries == */
	case "invoiceItems":
		$timerecords = false;
		$expenses = false;
		$html = '';
		$and = '';

		if (isset($_GET['timeperiod']) and $_GET['timeperiod'] == "period") :
			if (isset($_GET['datefrom_submit']) && $_GET['datefrom_submit'] <> "") :
				$enddate = date("Y-m-d");
				$fromdate = Validator::sanitize($_GET['datefrom_submit']);
				//$fromdate = Db::toDate($fromdate, false);
				if (isset($_GET['dateto_submit']) && $_GET['dateto_submit'] <> "") :
					$enddate = Validator::sanitize($_GET['dateto_submit']);
				//$enddate = Db::toDate($enddate, false);
				endif;
				$and = "AND created BETWEEN '$fromdate' AND '$enddate'";
			endif;
		else :
			$and = null;
		endif;

		if (isset($_GET['timerecord']) and $_GET['timerecord'] == "true") :
			$timerecords = Db::run()->pdoQuery("SELECT * FROM `" . Project::trTable . "` WHERE project_id = " . Filter::$id . " AND invoiced = 0 AND is_billable = 1 $and")->results();
		endif;

		if (isset($_GET['expense']) and $_GET['expense'] == "true") :
			$expenses = Db::run()->pdoQuery("SELECT * FROM `" . Project::exTable . "` WHERE project_id = " . Filter::$id . " AND invoiced = 0 AND is_billable = 1 $and")->results();
		endif;

		if ($timerecords and $expenses) :
			$data = array_merge_recursive($timerecords, $expenses);
		elseif ($timerecords) :
			$data = $timerecords;
		elseif ($expenses) :
			$data = $expenses;
		else :
			$data = false;
		endif;

		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->data = $data;
		$tpl->taxes = App::Content()->getTaxes();
		$tpl->template = 'loadInvoiceItems.tpl.php';

		$json['status']  = $data ? 'success' : 'error';
		$json['message'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Get Company Address == */
	case "companyAddress":
		$data = '';
		$currency = '';
		if ($row = Db::run()->first(Company::cTable, null, array("id" => Filter::$id))) :
			$data .= $row->address . "\n";
			$data .= $row->city . ", " . $row->state . "\n";
			$data .= $row->zip . ", " . $row->country . "\n";
			$currency = $row->currency . "," . $row->country;
		endif;

		$json['status'] = $row ? 'success' : 'error';
		$json['message'] = $data;
		$json['currency'] = $currency;
		print json_encode($json);
		break;

		/* == Get Expense Record Weekly == */
	case "getExpRecordWeekly":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->pheader = Utility::renderTimeRecordHeader(Validator::sanitize($_GET['date'], "date"));
		$dates = iterator_to_array($tpl->pheader);
		$tpl->results = App::Project()->getProjectExpenseRecords(Filter::$id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
		$tpl->currency = (isset($_GET['currency'])) ? Validator::sanitize($_GET['currency']) : App::Core()->currency;
		$tpl->template = 'loadExpensesWeekly.tpl.php';
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Get Time Record Weekly == */
	case "getTimeRecordWeekly":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->pheader = Utility::renderTimeRecordHeader(Validator::sanitize($_GET['date'], "date"));
		$dates = iterator_to_array($tpl->pheader);
		$tpl->results = App::Project()->getProjectTimeRecords(Filter::$id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
		$tpl->template = 'loadTimeWeekly.tpl.php';
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Move Timerecord to Project == */
	case "moveTimeToProject":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->data = App::Project()->getProjectsByPermissions(1, Filter::$id);
		$tpl->template = 'moveTimeToProject.tpl.php';
		echo $tpl->render();
		break;

		/* == Copy Note to Project == */
	case "copyNoteToProject":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Project::nTable, null, array('id' => Filter::$id));
		$tpl->data = App::Project()->getProjectsByPermissions(1, $tpl->row->project_id);
		$tpl->template = 'copyNoteToProject.tpl.php';
		echo $tpl->render();
		break;

		/* == Get Message History == */
	case "getMessageHistory":
	case "getTaskHistory":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->data = App::Comments()->getMessageHistory(Validator::sanitize($_GET['type'], "emailalt"), Filter::$id);
		$tpl->template = 'loadMessageHistory.tpl.php';
		echo $tpl->render();
		break;

		/* == Copy Task List == */
	case "copyTaskList":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->data =  Db::run()->pdoQuery("SELECT id, name FROM " . Project::pTable . " WHERE status = 1 AND id !=" . intval($_GET['pid']))->results();
		$tpl->template = 'copyTaskList.tpl.php';
		echo $tpl->render();
		break;

		/* == Edit Single Task == */
	case "editTask":
		if ($row = App::Task()->getTaskById(Filter::$id)) :
			$json['type'] = "success";
			if ($row->labels) :
				$json['labels'] = Utility::jSonToArray($row->labels);
			endif;
			if ($userdata = Db::run()->select(Project::sbTable, array("user_id"), array("task_id" => Filter::$id))->results()) :
				$json['subscribers'] = $userdata;
			endif;
			if ($filedata = Db::run()->select(Project::fTable, null, array("task_id" => Filter::$id))->results()) :
				$files = [];
				foreach ($filedata as $k => $frow) :
					$files[$k]['id'] = $frow->id;
					$files[$k]['name'] = $frow->name;
					$files[$k]['caption'] = $frow->caption;
					$files[$k]['fext'] = $frow->fext;
					$files[$k]['type'] = File::getFileType($frow->name);
				//$files[$k]['color'] = File::getFileColor($frow->name);
				endforeach;
				$json['files'] = $files;
			endif;
			$json['data'] = $row;
			$json['date_long'] = Date::doDate("MMMM dd, yyyy", $row->due_on);
			$json['date_short'] = Date::doDate("MM/dd/yyyy", $row->due_on);
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Add Time Record == */
	case "addTimeRecord":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = App::Task()->getTaskByPermission(Filter::$id);
		$tpl->core = App::Core();
		if ($tpl->row) :
			$tpl->puserdata = App::Project()->getProjectUsers($tpl->row->project_id);
			$tpl->timerecords = Utility::groupToLoop(App::Task()->getTaskTimeRecords($tpl->row->id), "trdate");
			$tpl->id = Filter::$id;
		endif;
		$tpl->template = 'addTimeRecord.tpl.php';
		echo $tpl->render();
		break;

		/* == Edit Time Record == */
	case "editTimeRecord":
		if ($row = App::Project()->getTimeRecordById(Filter::$id)) :
			$json['type'] = "success";
			$json['short_date'] = Date::doDate("MMMM dd, yyyy", $row->created);
			$json['input_date'] = Date::doDate("yyyy-dd-MM", $row->created);
			$json['data'] = $row;
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Add Expense Record == */
	case "addExpenseRecord":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = App::Task()->getTaskByPermission(Filter::$id);
		$tpl->core = App::Core();
		if ($tpl->row) :
			$tpl->puserdata = App::Project()->getProjectUsers($tpl->row->project_id);
			$tpl->exprecords = Utility::groupToLoop(App::Task()->getTaskExpenses($tpl->row->id), "exdate");
			$tpl->id = Filter::$id;
		endif;
		$tpl->template = 'addExpenseRecord.tpl.php';
		echo $tpl->render();
		break;

		/* == Edit Expense Record == */
	case "editExpenseRecord":
		if ($row = App::Project()->getExpenseRecordById(Filter::$id)) :
			$json['type'] = "success";
			$json['short_date'] = Date::doDate("MMMM dd, yyyy", $row->created);
			$json['input_date'] = Date::doDate("yyyy-dd-MM", $row->created);
			$json['data'] = $row;
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Convert Discussion to Task == */
	case "convertDiscussionToTask":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Comments::mTable, null, array('id' => Filter::$id));
		$tpl->template = 'convertDiscussionToTask.tpl.php';
		echo $tpl->render();
		break;

		/* == Copy Discussion to Project == */
	case "copyDiscussionToProject":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Comments::mTable, null, array('id' => Filter::$id));
		$tpl->data = App::Project()->getProjectsByPermissions(1, $tpl->row->type_id);
		$tpl->template = 'copyDiscussionToProject.tpl.php';
		echo $tpl->render();
		break;

		/* == Edit Team == */
	case "editTeam":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Company::tmTable, null, array('id' => Filter::$id));
		$tpl->template = 'editTeam.tpl.php';
		echo $tpl->render();
		break;

		/* == New Team == */
	case "newTeam":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->data = Db::run()->select(Users::mTable, array("id", "userlevel", "CONCAT(fname,' ',lname) as fullname"), array("status" => 1, "active" => "y"))->results();
		$tpl->template = 'newTeam.tpl.php';
		echo $tpl->render();
		break;

		/* == New Company == */
	case "newCompany":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->countries = App::Content()->getCountryList();
		$tpl->jobs = Utility::jSonToArray(App::Core()->job_types);
		$tpl->template = 'addCompany.tpl.php';
		echo $tpl->render();
		break;

		/* == Change Company == */
	case "changeCompany":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
		$tpl->companies = App::Company()->getCompanies();
		$tpl->template = 'changeCompany.tpl.php';
		echo $tpl->render();
		break;

		/* == Add To Projects == */
	case "addtoProjects":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
		$tpl->projects = App::Project()->getProjects();
		$tpl->template = 'addToProjects.tpl.php';
		echo $tpl->render();
		break;

		/* == Add To Team == */
	case "addtoTeam":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
		$tpl->teams = App::Company()->getAllTeams();
		$tpl->template = 'addtoTeam.tpl.php';
		echo $tpl->render();
		break;

		/* == Mark Invoice as Sent == */
	case "invoiceMarkSent":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Project::ivTable, null, array('id' => Filter::$id));
		$tpl->template = 'invoiceMarkSent.tpl.php';
		echo $tpl->render();
		break;

		/* == Invoice Reminder == */
	case "invoiceReminder":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Project::ivTable, null, array('id' => Filter::$id));
		$tpl->template = 'invoiceReminder.tpl.php';
		echo $tpl->render();
		break;

		/* == Send Invoice == */
	case "sendInvoice":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Project::ivTable, null, array('id' => Filter::$id));
		$tpl->data = App::Users()->getAllClients(1);
		$tpl->template = 'sendInvoice.tpl.php';
		echo $tpl->render();
		break;

		/* == Add Invoice Payment == */
	case "invoiceAddPayment":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Project::ivTable, null, array('id' => Filter::$id));
		$tpl->template = 'invoiceAddPayment.tpl.php';
		echo $tpl->render();
		break;

		/* == Delete Invoice Payment == */
	case "invoiceDeletePayment":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Project::pyTable, null, array('id' => Filter::$id));
		$tpl->template = 'invoiceDeletePayment.tpl.php';
		echo $tpl->render();
		break;

		/* == Invoice Access == */
	case "invoiceAccess":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Project::ivTable, null, array('id' => Filter::$id));
		$tpl->data = Utility::groupToLoop(App::Project()->getInvoiceAccess(), "day");
		$tpl->template = 'invoiceAccess.tpl.php';
		echo $tpl->render();
		break;

		/* == Send Estimate == */
	case "sendEstimate":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Content::esTable, null, array('id' => Filter::$id));
		$tpl->data = App::Users()->getAllClients(1);
		$tpl->template = 'sendEstimate.tpl.php';
		echo $tpl->render();
		break;

		/* == Resend Invitation == */
	case "resendInvitation":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
		$tpl->template = 'resendInvitation.tpl.php';
		echo $tpl->render();
		break;

		/* == Copy Invitation == */
	case "copyInvitation":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Users::mTable, null, array('id' => Filter::$id));
		$tpl->template = 'copyInvitation.tpl.php';
		echo $tpl->render();
		break;

		/* == Company History == */
	case "companyHistory":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Db::run()->first(Company::cTable, null, array('id' => Filter::$id));
		$tpl->template = 'companyHistory.tpl.php';
		echo $tpl->render();
		break;

		/* == Edit Role == */
	case "editRole":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->data = Db::run()->first(Users::rTable, null, array('id' => Filter::$id));
		$tpl->template = 'editRole.tpl.php';
		echo $tpl->render();
		break;

		/* == Load Language Section == */
	case "loadLanguageSection":
		$xmlel = simplexml_load_file(BASEPATH . Lang::langdir . Core::$language . ".lang.xml");
		$section = $xmlel->xpath('/language/phrase[@section="' . Validator::sanitize($_GET['section']) . '"]');
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->xmlel = $xmlel;
		$tpl->section = $section;
		$tpl->template = 'loadLanguageSection.tpl.php';
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Get Calendar Records == */
	case "getCalendarRecords":
		if (empty($_GET['year']) or empty($_GET['month'])) :
			$year = Date::doDate("yyyy", Date::today());
			$month = Date::doDate("MM", Date::today());
			$ids = null;
		else :
			$year = Validator::sanitize($_GET['year'], "time");
			$month = Validator::sanitize($_GET['month'], "time");
			$ids = Validator::sanitize($_GET['ids'], "implode");
		endif;
		$data = App::Content()->getCalendarEvents($ids);
		$json['events'] = $data;
		print json_encode($json);
		break;

		/* == Add Calendar == */
	case "addCalendar":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->staff = App::Users()->getAllStaff();
		$tpl->template = 'addCalendar.tpl.php';
		echo $tpl->render();
		break;

		/* == Edit Calendar == */
	case "editCalendar":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		if ($tpl->row = Db::run()->first(Content::clTable, null, array('id' => Filter::$id))) :
			$tpl->staff = App::Users()->getAllStaff();
			$tpl->calusers = Db::run()->select(Content::cluTable, array("GROUP_CONCAT(user_id) as uid"), array("calendar_id" => $tpl->row->id), 'GROUP BY calendar_id')->result();
		endif;
		$tpl->template = 'editCalendar.tpl.php';
		echo $tpl->render();
		break;

		/* == Add Event == */
	case "addEvent":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->staff = App::Users()->getAllStaff();
		$tpl->data = App::Content()->getCalendars();
		$tpl->core = App::Core();
		$tpl->template = 'addEvent.tpl.php';
		echo $tpl->render();
		break;

		/* == Edit Event == */
	case "editEvent":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		if ($tpl->row = Db::run()->first(Content::cleTable, null, array('id' => Filter::$id))) :
			$tpl->staff = App::Users()->getAllStaff();
			$tpl->data = App::Content()->getCalendars();
		endif;
		$tpl->core = App::Core();
		$tpl->template = 'editEvent.tpl.php';
		echo $tpl->render();
		break;

		/* == Download Invoice == */
	case "downloadInvoice":
		if ($row = Db::run()->first(Project::ivTable, null, array('id' => Filter::$id))) :
			$title = "invoice-" . Content::invoiceID($row->id, $row->custom_id) . "-from_" . App::Core()->company;

			ob_start();
			require_once(ADMINBASE . '/snippets/Pdf_Invoice.tpl.php');
			$pdf_html = ob_get_contents();
			ob_end_clean();

			require_once(BASEPATH . 'lib/mPdf/vendor/autoload.php');
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => App::Core()->pagesize]);
			$mpdf->SetTitle($title);
			$mpdf->WriteHTML($pdf_html);
			$mpdf->Output($title . ".pdf", "D");
			exit;
		else :
			exit;
		endif;
		break;

		/* == Download Estimate == */
	case "downloadEstimate":
		if ($row = Db::run()->first(Content::esTable, null, array('id' => Filter::$id))) :
			$title = "estimate-" . $row->title . "-from_" . App::Core()->company;

			ob_start();
			require_once(ADMINBASE . '/snippets/Pdf_Estimate.tpl.php');
			$pdf_html = ob_get_contents();
			ob_end_clean();

			require_once(BASEPATH . 'lib/mPdf/vendor/autoload.php');
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => App::Core()->pagesize]);
			$mpdf->SetTitle($title);
			$mpdf->WriteHTML($pdf_html);
			$mpdf->Output($title . ".pdf", "D");
			exit;
		else :
			exit;
		endif;
		break;

		/* == Get Main Activity == */
	case "getFullActivity":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->template = 'loadActivity.tpl.php';
		$tpl->data = $tpl->data = App::Users()->getAllUserActivity(isset($_GET['date']) ? Validator::sanitize($_GET['date'], "date") : '');
		$json['html'] = $tpl->render();

		print json_encode($json);
		break;

		/* == Payment Stats == */
	case "getPaymentsChart":
		$data = Stats::getPaymentsChart();
		print json_encode($data);
		break;

		/* == Payment Stats == */
	case "getPaymentsCvs":
		header("Pragma: no-cache");
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Payments.csv');

		$data = fopen('php://output', 'w');
		fputcsv($data, array('Transaction ID', 'Company ID', 'Amount', 'Tax', 'Discount', 'Currency', 'Created', 'Processor'));

		$stmt = Db::run()->prepare("SELECT txn_id, company_id, amount, tax, discount, currency, created, pp FROM `" . Project::pyTable . "`");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
			fputcsv($data, $row);
		endwhile;
		break;


		/* == Uninvoiced Stats == */
	case "getUninvoicedCvs":
		header("Pragma: no-cache");
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Payments.csv');

		$data = fopen('php://output', 'w');
		fputcsv($data, array('Type', 'Project Name', 'Client Name', 'Title', 'Description', 'Hours', 'Amount', 'Currency', 'Created'));

		$result = Stats::exportUninvoicedItems();

		foreach ($result as $row) :
			fputcsv($data, $row);
		endforeach;
		break;

		/* == Timerecords Stats == */
	case "getTimeRecordsCvs":
		header("Pragma: no-cache");
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Payments.csv');

		$data = fopen('php://output', 'w');
		fputcsv($data, array('Project Name', 'Client Name', 'Title', 'Description', 'Assagnee', 'Job Type', 'Hours', 'Amount', 'Currency', 'User ID', 'ID', 'Created'));

		$array = Stats::getTimeRecords();
		$result = json_decode(json_encode($array), true);

		foreach ($result as $row) :
			fputcsv($data, $row);
		endforeach;
		break;

		/* == Load Task Reports == */
	case "loadTaskReports":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->template = 'loadTaskReports.tpl.php';
		$tpl->data = Stats::getTaskreports();
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Task Reports == */
	case "getTaskReports":
		switch ($_GET['type']):
			case "category":
				$html = '<select name="category_id">';
				$html .= Utility::loopOptions(Utility::jSonToArray(App::Core()->prjcats), "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

			case "company":
				$html = '<select name="company_id">';
				$html .= Utility::loopOptions(App::Company()->getCompanies(), "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

			case "projects":
				$html = '<select name="projects_id">';
				$html .= Utility::loopOptions(App::Project()->getProjects(), "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

			case "users":
				$html = '<select name="assigne_id">';
				$html .= Utility::loopOptions(App::Users()->getAllStaff(1, "y", true), "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

			case "tasklist":
				$html = '<select name="tlist_id"';
				$html .= Utility::loopOptions(Db::run()->pdoQuery("SELECT MAX(id) as id, name FROM `" . Task::tlTable . "` GROUP by name")->results(), "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

			case "labels":
				$tasklabels = Utility::jSonToArray(App::Core()->tasklabels);
				$html = '<select name="labels" multiple>';
				$html .= Utility::loopOptions($tasklabels, "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

			case "createddby":
				$html = '<select name="created_by_id">';
				$html .= Utility::loopOptions(App::Users()->getAllStaff(1, "y", true), "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

			case "completedby":
				$html = '<select name="completed_by_id">';
				$html .= Utility::loopOptions(App::Users()->getAllStaff(1, "y", true), "id", "name");
				$html .= '</select>';
				$json['html'] = $html;
				break;

		endswitch;
		print json_encode($json);
		break;

		/* == Load Task Workload == */
	case "getWorkload":
		Db::run()->update(Task::tTable, array("assigned_id" => Filter::$id), array("id" => intval($_GET['task'])));

		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->template = 'loadWorkload.tpl.php';
		$tpl->data = Stats::getTasksWorkload(1, Filter::$id);
		$tpl->staff = App::Users()->getAllStaff(1, "y", true);
		$json['html'] = $tpl->render();

		print json_encode($json);
		break;

		/* == Load TimeRecord Reports == */
	case "loadTimeReports":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->template = 'loadTimeReports.tpl.php';
		$tpl->result = Stats::getTimeRecords();
		$tpl->type = Validator::sanitize($_GET['type']);
		$json['html'] = $tpl->render();

		print json_encode($json);
		break;

		/* == Load Expense Reports == */
	case "loadExpenseReports":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->template = 'loadExpenseReports.tpl.php';
		$tpl->result = Stats::getExpenses();
		$tpl->type = Validator::sanitize($_GET['type']);
		$json['html'] = $tpl->render();

		print json_encode($json);
		break;

		/* == Load Budget Report == */
	case "loadBudgetReport":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->template = 'loadBudgetReport.tpl.php';
		$tpl->data = Stats::getBudget(Filter::$id);
		if ($tpl->row = Db::run()->first(Project::pTable, array('budget', 'currency'), array('id' => Filter::$id))) :
			$total = Stats::doArraySum($tpl->data, "amount");
			$class = (($tpl->row->budget == 0 or $tpl->row->budget > $total) ? "positive" : "negative");
			$pcent = ($tpl->row->budget == 0) ? 100 : Utility::doPercent($total, $tpl->row->budget);
			$spent = '<span class="wojo ' . $class . ' text">(' . $pcent . '%)</span>';
			$json['expense'] = Utility::formatMoney($total, $tpl->row->currency);
			$json['budget'] = Utility::formatMoney($tpl->row->budget, $tpl->row->currency);
			$json['spent'] = $spent;
		endif;

		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Get Notifications == */
	case "doNotifications":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->template = 'renderNotification.tpl.php';
		$tpl->data = Comments::renderNotification();

		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

endswitch;

/* == Post Actions == */
switch ($pAction):
		/* == Add User note ==*/
	case "addUserNote":
		App::Users()->addUserNotes();
		break;
			/* == Add User note ==*/
	case "showShortCV":
		App::Users()->updateShortCV();
		break;
		/* == Add To Client Project ==*/
	case "addtoClientProjects":
		App::Project()->addToProjects(true);
		break;
		/* == Move Time to Project == */
	case "moveTimeToProject":
		App::Project()->moveTimeToProject();
		break;

		/* == Copy Note to Project == */
	case "copyNoteToProject":
		App::Content()->copyNoteToProject();
		break;

		/* == Copy Task List == */
	case "copyTaskList":
		App::Project()->copyTaskList();
		break;

		/* == Add To Projects == */
	case "addtoProjects":
		App::Project()->addToProjects();
		break;

		/* == Convert Discussion to Task == */
	case "convertDiscussionToTask":
		App::Comments()->convertDiscussionToTask();
		break;

		/* == Copy Discussion to Project == */
	case "copyDiscussionToProject":
		App::Comments()->copyDiscussionToProject();
		break;

		/* == New Team == */
	case "newTeam":
		App::Company()->newTeam();
		break;

		/* == Edit Team == */
	case "editTeam":
		App::Company()->editTeam();
		break;

		/* == Change Company == */
	case "changeCompany":
		App::Company()->changeCompany();
		break;

		/* == Add New Company == */
	case "newCompany":
		App::Company()->processCompany();
		break;

		/* == Add To Team == */
	case "addtoTeam":
		App::Company()->addToTeam();
		break;

		/* == Mark Invoice as Sent == */
	case "invoiceMarkSent":
		App::Project()->invoiceMarkSent();
		break;

		/* == Mark Reminder == */
	case "invoiceReminder":
		App::Project()->invoiceReminder();
		break;

		/* == Invoice Payment == */
	case "invoiceAddPayment":
		App::Project()->invoiceAddPayment();
		break;

		/* == Invoice Delete Payment == */
	case "invoiceDeletePayment":
		App::Project()->invoiceDeletePayment();
		break;

		/* == Process Invitation == */
	case "resendInvitation":
		App::Users()->resendInvitation();
		break;

		/* == Send Invoice == */
	case "sendInvoice":
		App::Project()->sendInvoice();
		break;

		/* == Send Estimate == */
	case "sendEstimate":
		App::Content()->sendEstimate();
		break;

		/* == Update Role Description == */
	case "editRole":
		App::Users()->updateRoleDescription();
		break;

		/* == Chnage Role == */
	case "changeRole":
		if (Auth::checkAcl("owner")) :
			Db::run()->update(Users::rpTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
		endif;
		break;

		/* == Chnage Gateway Status == */
	case "gatewayStatus":
		if (Auth::checkAcl("owner")) :
			Db::run()->update(Admin::gTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
		endif;
		break;

		/* == Update Language Phrase == */
	case "editPhrase":
		if (file_exists(BASEPATH . Lang::langdir . Core::$language . ".lang.xml")) :
			$xmlel = simplexml_load_file(BASEPATH . Lang::langdir . Core::$language . ".lang.xml");
			$node = $xmlel->xpath("/language/phrase[@data = '" . $_POST['key'] . "']");
			$node[0][0] = $title;
			$xmlel->asXML(BASEPATH . Lang::langdir . Core::$language . ".lang.xml");
			$json['title'] = $title;
			print json_encode($json);
		endif;
		break;

		/* == Update Task Label == */
	case "updateTaskLabel":
		Db::run()->update(Task::tlbTable, array('name' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Update Project Label == */
	case "updateProjectLabel":
		Db::run()->update(Project::plTable, array('name' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Update Project Category == */
	case "updateProjectCat":
		Db::run()->update(Project::pcTable, array('name' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Update Job Name == */
	case "updateJobName":
		Db::run()->update(Project::jtTable, array('name' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Update Job Hour == */
	case "updateJobHour":
		Db::run()->update(Project::jtTable, array('name' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Update Expense Category == */
	case "upadeExCatName":
		Db::run()->update(Project::excTable, array('name' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Update Tax Name == */
	case "updateTaxName":
		Db::run()->update(Content::taxTable, array('name' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Update Tax Rate == */
	case "updateTaxRate":
		Db::run()->update(Content::taxTable, array('amount' => $title), array('id' => Filter::$id));
		$json['title'] = $title;
		print json_encode($json);
		break;

		/* == Delete Task Label == */
	case "deleteTaskLabel":
		Db::run()->delete(Task::tlbTable, array("id" => filter::$id));
		break;

		/* == Delete Project Label == */
	case "deleteProjectLabel":
		Db::run()->delete(Project::plTable, array("id" => filter::$id));
		break;

		/* == Delete Job Type == */
	case "deleteJobType":
		Db::run()->delete(Project::jtTable, array("id" => filter::$id));
		break;

		/* == Delete Expense Category == */
	case "deleteExCat":
		Db::run()->delete(Project::excTable, array("id" => filter::$id));
		break;

		/* == Delete Project Category == */
	case "deleteProjectCat":
		Db::run()->delete(Project::pcTable, array("id" => filter::$id));
		break;

		/* == Delete Tax Rate == */
	case "deleteTaxRate":
		Db::run()->delete(Content::taxTable, array("id" => filter::$id));
		break;

		/* == Update Task Label Color == */
	case "updateTaskLabelColor":
		Db::run()->update(Task::tlbTable, array("color" => Validator::sanitize($_POST['color'], "string")), array("id" => filter::$id));
		break;

		/* == Update Project Label Color == */
	case "updateProjectLabelColor":
		Db::run()->update(Project::plTable, array("color" => Validator::sanitize($_POST['color'], "string")), array("id" => filter::$id));
		break;

		/* == Set Calendar Visibility == */
	case "calendarVisibilityStatus":
		Db::run()->update(Content::cluTable, array('is_visible' => intval($_POST['status'])), array('user_id' => App::Auth()->uid, 'calendar_id' => Filter::$id));
		break;

		/* == Process Calendar == */
	case "editCalendar":
	case "addCalendar":
		App::Content()->processCalendar();
		break;
endswitch;

/* == Instant Actions == */
switch ($iAction):
		/* == Estimate Mark Won == */
	case "estimateMarkWon":
		if (Db::run()->update(Content::esTable, array("status" => 3), array("id" => filter::$id))) :
			$json['type'] = "success";
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Estimate Mark Lost == */
	case "estimateMarkLost":
		if (Db::run()->update(Content::esTable, array("status" => 2), array("id" => filter::$id))) :
			$json['type'] = "success";
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Set Note Hidden Status == */
	case "noteHiddenSatatus":
		Db::run()->update(Project::nTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'note_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Notes",
			'title' => Validator::sanitize($_POST['notename']),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_016 : Lang::$word->ACT_017,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Note Subscribers == */
	case "noteSubscribersStatus":
		if ($_POST['status']) :
			Db::run()->insert(Project::sbTable, array('user_id' => Validator::sanitize($_POST['uid'], "int"), 'note_id' => Filter::$id));
		else :
			Db::run()->delete(Project::sbTable, array('user_id' => Validator::sanitize($_POST['uid'], "int"), 'note_id' => Filter::$id));
		endif;
		break;

		/* == Set File Hidden Status== */
	case "fileHiddenSatatus":
		Db::run()->update(Project::fTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		$data['icon'] = $_POST['status'] ? '<i class="icon mask"></i>' : '';
		$data['html'] = $_POST['status'] ? Lang::$word->FMG_SUB2 : Lang::$word->FMG_SUB1;
		print json_encode($data);
		break;

		/* == Load Message Body == */
	case "getMessageBody":
		if ($row = Db::run()->first(Comments::mTable, array("body"), array("id" => Filter::$id))) :
			$json['type'] = 'success';
			$json['body'] = $row->body;
		else :
			$json['type'] = 'error';
		endif;
		print json_encode($json);
		break;

		/* == Set Message Hidden Status== */
	case "messageHiddenSatatus":
		Db::run()->update(Comments::mTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		Db::run()->update(Comments::mTable, array("is_hidden" => intval($_POST['status'])), array('parent_id' => Filter::$id));
		$data = array(
			'message_id' => Filter::$id,
			'project_id' => intval($_POST['pid']),
			'uid' => App::Auth()->uid,
			'type' => "Messages",
			'title' => Validator::sanitize($_POST['discname']),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_016 : Lang::$word->ACT_017,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Message Subscribers == */
	case "messageSubscribersStatus":
		if ($_POST['status']) :
			Db::run()->insert(Project::sbTable, array('user_id' => intval($_POST['uid']), 'message_id' => Filter::$id));
		else :
			Db::run()->delete(Project::sbTable, array('user_id' => intval($_POST['uid']), 'message_id' => Filter::$id));
		endif;
		break;

		/* == Update Project Permissions == */
	case "pperm":
		if ($_POST['field'] == "project_id") :
			Db::run()->delete(Project::pxTable, array('project_id' => Filter::$id, 'user_id' => intval($_POST['value'])));
		endif;
		break;

		/* == Update Project Leader Status == */
	case "pstatus":
		if ($_POST['field'] == "leader_id") :
			$data = array(
				'leader_id' => intval($_POST['value']),
				'leader_name' => Db::run()->getValueById(Users::mTable, "CONCAT(fname,' ',lname)", intval($_POST['value']))
			);
			Db::run()->update(Project::pTable, $data, array('id' => Filter::$id));
		endif;
		break;

		/* == Add Project Permissions == */
	case "addperm":
		if ($_POST['type'] == "staff" or $_POST['type'] == "client") :
			$data = array(
				'user_id' => intval($_POST['uid']),
				'project_id' => Filter::$id
			);
			Db::run()->insert(Project::pxTable, $data);
		else :
			if (!empty($_POST['uid'])) :
				$ausers = array_unique($_POST['uid']);
				foreach ($ausers as $k => $uid) :
					Db::run()->delete(Project::pxTable, array('user_id' => $uid, 'project_id' => Filter::$id));
					$datapArray[] = array(
						'user_id' => $uid,
						'project_id' => FIlter::$id,
					);
				endforeach;
			endif;
			Db::run()->insertBatch(Project::pxTable, $datapArray);
		endif;
		break;

		/* == Reopen Project == */
	case "reopenProject":
		$data = array(
			'status' => 1,
			'completed' => 'NULL',
			'completed_by_id' => 0,
			'completed_by_name' => 'NULL'
		);
		Db::run()->update(Project::pTable, $data, array('id' => Filter::$id));

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Complete Project == */
	case "completeProject":
		$data = array(
			'status' => 4,
			'completed' => Db::toDate(),
			'completed_by_id' => App::Auth()->uid,
			'completed_by_name' => App::Auth()->name
		);
		Db::run()->update(Project::pTable, $data, array('id' => Filter::$id));

		$udata = array(
			'uid' => App::Auth()->uid,
			'type' => "Projects",
			'project_id' => Filter::$id,
			'groups' => "projectc",
			'username' => App::Auth()->name,
			'title' => Validator::sanitize($_POST['name'], "string"),
			'is_activity' => 1,
			'ip' => Url::getIP()
		);
		Db::run()->insert(Users::aTable, $udata);

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Remove Files == */
	case "removeTaskFile":
	case "removeDiscFile":
	case "removeProjectFile":
	case "removeNoteFile":
		$name = Validator::sanitize($_POST['name']);
		File::deleteFile(UPLOADS . '/files/' . $name);
		Db::run()->delete(Project::fTable, array("name" => $name));
		Db::run()->delete(Project::ftTable, array("name" => $name));
		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Process Attachments == */
	case "taskFiles":
	case "discussionFiles":
	case "projectFiles":
	case "noteFiles":
		if (!empty($_FILES['file']['name'])) :
			$upl = Upload::instance(App::Core()->file_size, App::Core()->file_ext);
			$upl->process("file", UPLOADS . "/files/", "file_");
			if (empty(Message::$msgs)) :
				$data = array(
					'caption' => $upl->fileInfo['name'],
					'parent' => strtolower(Validator::sanitize($_POST['type'], "alpha")),
					'project_id' => Filter::$id,
					'name' => $upl->fileInfo['fname'],
					'fsize' => $upl->fileInfo['size'],
					'fext' => $upl->fileInfo['ext'],
					'mime' => File::getMimeType(UPLOADS . "/files/" . $upl->fileInfo['fname']),
					'created_by_id' => Auth::$udata->uid,
					'created_by_name' => Auth::$udata->name,
				);

				$last_id = Db::run()->insert(Project::ftTable, $data)->getLastInsertId();

				$json['status'] = "success";
				$json['filename'] = $data['name'];
				$json['type'] = File::getFileType($data['name']);
				$json['icon'] = File::getFileIcon($data['name']);
				$json['color'] = File::getFileColor($data['name']);
				$json['id'] = $last_id;
			else :
				$json['status'] = "error";
				$json['message'] = Message::$msgs['name'];
			endif;
			print json_encode($json);
		endif;
		break;

		/* == Task hidden status == */
	case "taskHidden":
		Db::run()->update(Task::tTable, array("is_hidden" => intval($_POST['active'])), array("id" => Filter::$id));
		break;

		/* == Task priority == */
	case "taskPriority":
		Db::run()->update(Task::tTable, array("is_priority" => intval($_POST['active'])), array("id" => Filter::$id));
		break;

		/* == Update Tasks == */
	case "updateTasks":
		$is_add = ($_POST['add'] == "true") ?  "`task_list_id` = " . Filter::$id . "," : null;
		$i = 0;
		$query = "UPDATE `" . Task::tTable . "` SET $is_add `sorting` = CASE ";
		$idlist = '';
		foreach ($_POST['items'] as $item) :
			$i++;
			$query .= " WHEN id = " . $item . " THEN " . $i . " ";
			$idlist .= $item . ',';
		endforeach;
		$idlist = substr($idlist, 0, -1);
		$query .= "
			  END
			  WHERE id IN (" . $idlist . ")";
		Db::run()->pdoQuery($query);

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Update Task List == */
	case "updateTaskList":
		$i = 0;
		$query = "UPDATE `" . Task::tlTable . "` SET `sorting` = CASE ";
		$idlist = '';
		foreach ($_POST['items'] as $item) :
			$i++;
			$query .= " WHEN id = " . $item . " THEN " . $i . " ";
			$idlist .= $item . ',';
		endforeach;
		$idlist = substr($idlist, 0, -1);
		$query .= "
			  END
			  WHERE id IN (" . $idlist . ")";
		Db::run()->pdoQuery($query);

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Complete Task == */
	case "completeTask":
		$data = array("status" => 3, "completed" => Db::toDate(), "completed_by_name" => App::Auth()->name, "completed_by_id" => App::Auth()->uid);
		Db::run()->update(Task::tTable, $data, array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Db::run()->getValueById(Task::tTable, "name", Filter::$id),
			'comment' => Lang::$word->ACT_001,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);

		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Stats::getTaskStatus(intval($_POST['pid']));
		$tpl->id = intval($_POST['pid']);
		$tpl->template = 'loadTaskProgress.tpl.php';

		$json['type'] = "success";
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Set Task List == */
	case "taskUpdateList":
		Db::run()->update(Task::tTable, array("task_list_id" => intval($_POST['task_list_id'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Validator::sanitize($_POST['taskname']),
			'comment' => str_replace("[NAME]", Validator::sanitize($_POST['name'], "string"), Lang::$word->ACT_009),
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Assignee == */
	case "taskUpdateAssignee":
		$id = Validator::sanitize($_POST['assigned_id'], "int");
		Db::run()->update(Task::tTable, array("assigned_id" => $id), array('id' => Filter::$id));
		$ua = Db::run()->getValueById(Users::mTable, "avatar", $id);
		$avatar = ($ua) ? $ua : 'blank.svg';

		$json['avatar'] = UPLOADURL . '/avatars/' . $avatar;
		print json_encode($json);

		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Validator::sanitize($_POST['taskname']),
			'comment' => str_replace("[NAME]", Validator::sanitize($_POST['name'], "string"), Lang::$word->ACT_014),
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Update Label List == */
	case "taskUpdateLabels":
		$tasklabels = Utility::jSonToArray(App::Core()->tasklabels);
		$ids = explode(',', $_POST['labels']);
		$result = array_filter(
			$tasklabels,
			function ($o) use ($ids) {
				return in_array($o->id, $ids);
			}
		);
		$result = array_values($result);
		$labels = json_encode($result);

		Db::run()->update(Task::tTable, array("labels" => $labels), array('id' => Filter::$id));
		break;

		/* == Set Task Due Date == */
	case "taskDueDateSatatus":
		Db::run()->update(Task::tTable, array("due_on" => Db::toDate($_POST['duedate'], false)), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'title' => Validator::sanitize($_POST['taskname']),
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'comment' => str_replace("[DATE]", Date::doDate("short_date", $_POST['duedate']), Lang::$word->ACT_008),
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Task Hidden Status== */
	case "taskHiddenSatatus":
		Db::run()->update(Task::tTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Db::run()->getValueById(Task::tTable, "name", Filter::$id),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_016 : Lang::$word->ACT_017,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Task Priority Status== */
	case "taskPrioritySatatus":
		Db::run()->update(Task::tTable, array("is_priority" => intval($_POST['status'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Db::run()->getValueById(Task::tTable, "name", Filter::$id),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_003 : Lang::$word->ACT_004,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Task Subscribers == */
	case "taskSubscribersStatus":
		if ($_POST['status']) :
			Db::run()->insert(Project::sbTable, array('user_id' => intval($_POST['uid']), 'task_id' => Filter::$id));
		else :
			Db::run()->delete(Project::sbTable, array('user_id' => intval($_POST['uid']), 'task_id' => Filter::$id));
		endif;
		break;

		/* == Update Task Job == */
	case "taskUpdateJob":
		$job_hours = Validator::sanitize($_POST['job_hours'], "float");
		$job_id = Validator::sanitize($_POST['job_id'], "int");
		$category = Validator::sanitize($_POST['cat'], "string");
		Db::run()->update(
			Task::tTable,
			array(
				"job_hours" => $job_hours,
				"job_id" => $job_id
			),
			array('id' => Filter::$id)
		);

		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Validator::sanitize($_POST['taskname']),
			'comment' => $job_id ? str_replace(array("[A]", "[B]"), array($job_hours, $category), Lang::$word->ACT_018) : Lang::$word->ACT_019,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Mark Messages as Red == */
	case "markRed":
		if ($_POST['type'] == "note") :
			Db::run()->update(Project::sbTable, array("status" => 1), array('note_id' => intval($_POST['note_id']), 'user_id' => App::Auth()->uid));
			$json['success'] = true;
		elseif ($_POST['type'] == "message") :
			Db::run()->update(Project::sbTable, array("status" => 1), array('message_id' => intval($_POST['message_id']), 'user_id' => App::Auth()->uid));
			$json['success'] = true;
		else :
			Db::run()->update(Project::sbTable, array("status" => 1), array('task_id' => intval($_POST['task_id']), 'user_id' => App::Auth()->uid));
			$json['success'] = true;
		endif;
		print json_encode($json);
		break;

endswitch;

/* == Clear Session Temp Queries == */
if (isset($_GET['ClearSessionQueries'])) :
	App::Session()->remove('debug-queries');
	App::Session()->remove('debug-warnings');
	App::Session()->remove('debug-errors');
	print 1;
endif;
