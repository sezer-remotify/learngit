<?php

/**
 * Stats Class
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2017
 * @version $Id: stats.class.php, v1.00 2017-04-20 18:20:24 gewa Exp $
 */
if (!defined("_WOJO"))
	die('Direct access to this location is not allowed.');

class Stats
{


	/**
	 * Stats::__construct()
	 *
	 * @return
	 */
	public function __construct()
	{
	}

	/**
	 * Stats::getPaymentTable()
	 *
	 * @return
	 */
	public static function getPaymentTable()
	{
		$data = array();
		$sql = "SELECT created,	currency,	amount,	id,	MONTH(created) as month FROM `" . Project::pyTable . "`
		WHERE YEAR(created) = ? ORDER BY created ASC;";
		$query = Db::run()->pdoQuery($sql, array(date('Y')))->results();

		for ($i = 1; $i <= 12; $i++) {
			$data['month'][] = array($i, Date::dodate("MMMM", date("Y-m-d", mktime(0, 0, 0, $i, 10))));
		}

		if ($query) {
			$cid = null;
			foreach ($query as $i => $row) {
				if ($cid != $row->currency) {
					$cid = $row->currency;
					$data['currency'][$row->currency][$row->month] = $row->currency;
				}

				$data['currencies'][$row->currency][$row->month][$i] = $row->amount;
				$data['total'][$row->month][$i] = $row->id;
			}
		}
		return $data;
	}

	/**
	 * Stats::getPaymentsChart()
	 *
	 * @return
	 */
	public static function getPaymentsChart()
	{
		$data = array();
		$data['label'] = array();
		$data['color'] = array();
		$data['legend'] = array();

		$color = array(
			"#f44336",
			"#2196f3",
			"#e91e63",
			"#4caf50",
			"#ff9800",
			"#ff5722",
			"#795548",
			"#607d8b",
			"#00bcd4",
			"#9c27b0"
		);

		$begin = new DateTime(date('Y') . '-01');
		$end = new DateTime(date('Y') . '-12');
		$end = $end->modify('+1 month');

		$interval = new DateInterval('P1M');
		$daterange = new DatePeriod($begin, $interval, $end);

		$sql = "SELECT currency, amount, DATE_FORMAT(created, '%Y-%m') as created  FROM `" . Project::pyTable . "`
		WHERE YEAR(created) = ?;";
		$query = Db::run()->pdoQuery($sql, array(date('Y')))->results();
		$currency = Utility::groupToLoop($query, "currency");

		foreach ($daterange as $k => $date) {
			$data['data'][$k]['m'] = $date->format("Y-m");
			if ($currency) {
				foreach ($currency as $cymbol => $rows) {
					$sum = 0;
					foreach ($rows as $row) {
						if ($row->created == $date->format("Y-m")) {
							$sum += $row->amount;
							$data['data'][$k][$cymbol] = $sum;
						} else {
							$data['data'][$k][$cymbol] = 0;
						}
					}
				}
			} else {
				$data['data'][$k][App::Core()->currency] = 0;
			}
		}

		if ($currency) {
			$k = 0;
			foreach ($currency as $label => $vals) {
				$k++;
				$data['label'][] = $label;
				$data['color'][] = $color[$k];
				$data['legend'][] = '<div class="item align middle"><span class="wojo ring label" style="background:' . $color[$k] . '"> </span> &nbsp;' . $label . '</div>';
			}
		} else {
			$data['label'][] = App::Core()->currency;
			$data['color'][] = $color[0];
			$data['legend'][] = '<div class="item align middle"><span class="wojo ring label" style="background:' . $color[0] . '"> </span> &nbsp;' . App::Core()->currency . '</div>';
		}

		return $data;
	}

	/**
	 * Stats::getUninvoicedItems()
	 *
	 * @return
	 */
	public static function getUninvoicedItems()
	{
		$sql = "SELECT 	p.name,	p.company_name,	p.currency,	p.id, total_hours,	total_tamount,	total_amount  FROM `" . Project::pTable . "` AS p
				LEFT JOIN (SELECT	project_id, SUM(amount * hours) AS total_tamount, SUM(hours) AS total_hours FROM	`" . Project::trTable . "` WHERE invoiced = 0 AND is_billable = 1  GROUP BY project_id) AS t ON t.project_id = p.id
				LEFT JOIN (SELECT	project_id,	SUM(amount) AS total_amount FROM	`" . Project::exTable . "` WHERE invoiced = 0	AND is_billable = 1 GROUP BY project_id) AS e ON e.project_id = p.id
			  WHERE p.status = ?;";

		$query = Db::run()->pdoQuery($sql, array(1))->results();
		$result = array();
		if ($query) {
			foreach ($query as $key => $row) {
				if ($row->total_hours == null and $row->total_amount == null) {
					unset($query[$key]);
				} else {
					$result[] = $row;
				}
			}
		}
		return ($result) ? $result : 0;
	}

	/**
	 * Stats::getProjectTotalExpense()
	 *
	 * @return
	 */
	public static function getProjectTotalExpense($project_id)
	{

		$sql = "SELECT (SELECT IFNULL(SUM(amount * hours), 0)	FROM `" . Project::trTable . "`
			WHERE is_billable = 1 AND project_id = ?) AS total_time,	(SELECT IFNULL(SUM(amount), 0)	FROM `" . Project::exTable . "`
			WHERE is_billable = 1 AND  project_id = ?) AS total_expense;";

		$row = Db::run()->pdoQuery($sql, array($project_id, $project_id))->result();
		return $row;
	}

	/**
	 * Stats::exportUninvoicedItems()
	 *
	 * @return
	 */
	public static function exportUninvoicedItems()
	{
		$sql = "SELECT 'Timerecord' AS type,	p.name,	p.company_name,	t.title,	t.description,	t.hours,	t.amount,	p.currency,	DATE(t.created) as date FROM	`" . Project::pTable . "` AS p
				JOIN `" . Project::trTable . "` AS t ON t.project_id = p.id
			  WHERE t.is_billable = 1
			  AND t.invoiced = 0
			  UNION ALL
			  SELECT
			   'Expense' AS type,
				p.name,
				p.company_name,
				e.title,
				e.description,
				'hours',
				e.amount,
				p.currency,
				DATE(e.created) as date
			  FROM
				`" . Project::pTable . "` AS p
				JOIN `" . Project::exTable . "` AS e
				  ON e.project_id = p.id
			  WHERE e.is_billable = 1
			  AND e.invoiced = 0
			  ORDER BY type DESC;";

		$data = Db::run()->pdoQuery($sql)->results();

		$array = array();
		foreach ($data as $rows) {
			if ($rows->type == "Expense") {
				$rows->hours = 0;
			}
			if ($rows->type == "Timerecord") {
				$rows->amount = number_format($rows->amount * $rows->hours, 2);
			}
			$array[] = $rows;
		}

		return json_decode(json_encode($array), true);
	}

	/**
	 * Stats::getTaskStatus()
	 *
	 * @param int $id
	 * @return
	 */
	public static function getTaskStatus($id, $hidden = true)
	{
		$is_hidden = ($hidden) ? 'AND is_hidden = 0 ' : null;

		$sql = "SELECT	COUNT(*) AS total,	COUNT(IF(status = 1, 1, NULL)) AS open,	COUNT(IF(status = 3, 1, NULL)) AS closed FROM	`" . Task::tTable . "`
		  WHERE project_id = ?
		  $is_hidden
		  AND status <> 2;";

		$row = Db::run()->pdoQuery($sql, array($id))->result();
		return ($row) ? $row : 0;
	}

	/**
	 * Stats::getTaskTimeExpense()
	 *
	 * @return
	 */
	public static function getTaskTimeExpense($task_id)
	{

		$sql = "SELECT (SELECT IFNULL(SUM(hours), 0) FROM `" . Project::trTable . "`
			WHERE task_id = ?) AS total_hours,	(SELECT IFNULL(SUM(amount), 0)	FROM `" . Project::exTable . "`
			WHERE task_id = ?) AS total_amount;";

		$row = Db::run()->pdoQuery($sql, array($task_id, $task_id))->result();
		return $row;
	}

	/**
	 * Stats::getTaskreports()
	 *
	 * @return
	 */
	public static function getTaskreports()
	{
		$clause = '';
		switch ($_GET['project_id']) {
			case "active":
				$clause .= " AND p.status = 1";
				break;
			case "completed":
				$clause .= " AND p.status = 4";
				break;
			case "category":
				if (Validator::notEmptyGet('category_id') and $category_id = Validator::sanitize($_GET['category_id'], "int", 6)) {
					$clause .= " AND p.category_id = {$category_id}";
				}
				break;
			case "company":
				if (Validator::notEmptyGet('company_id') and $company_id = Validator::sanitize($_GET['company_id'], "int", 6)) {
					$clause .= " AND p.company_id = {$company_id}";
				}
				break;
			case "selected":
				if (Validator::notEmptyGet('projects_id') and $projects_id = Validator::sanitize($_GET['projects_id'], "int", 6)) {
					$clause .= " AND p.id = {$projects_id}";
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['assign_id']) {
			case "users":
				if (Validator::notEmptyGet('assigne_id') and $assigne_id = Validator::sanitize($_GET['assigne_id'], "int", 6)) {
					$clause .= " AND t.assigned_id = {$assigne_id}";
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['tasklist_id']) {
			case "nolist":
				$clause .= " AND t.task_list_id = 0";
				break;
			case "selected":
				if (Validator::notEmptyGet('tlist_id') and $tlist_id = Validator::sanitize($_GET['tlist_id'], "int", 6)) {
					$clause .= " AND t.task_list_id = {$tlist_id}";
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['label_id']) {
			case "nolabel":
				$clause .= " AND t.labels IS NULL";
				break;
			case "selected":
				if (Validator::notEmptyGet('labels') and $labels = Validator::sanitize($_GET['labels'], "implode")) {
					if ($trow = self::$db->pdoQuery("SELECT GROUP_CONCAT(DISTINCT(task_id)) as tasks FROM `" . Task::tlaTable . "` WHERE label_id IN($labels);")->result()) {
						$clause .= " AND t.id IN ({$trow->tasks})";
					} else {
						$clause .= null;
					}
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['duedate_id']) {
			case "noduedate":
				$clause .= " AND t.due_on IS NULL";
				break;
			case "today":
				$clause .= " AND DATE(t.due_on) = '" . Date::today('', 'Y-m-d') . "'";
				break;
			case "tomorrow":
				$clause .= " AND DATE(t.due_on) = '" . Date::NumberOfDays('+1 day', 'Y-m-d') . "'";
				break;
			case "thisweek":
				$clause .= " AND YEARWEEK(t.due_on, " . App::Core()->weekstart . ") = YEARWEEK(CURDATE(), " . App::Core()->weekstart . ")";
				break;
			case "nextweek":
				$clause .= " AND YEARWEEK(t.due_on, " . App::Core()->weekstart . ") = YEARWEEK(CURDATE() + INTERVAL 1 WEEK, " . App::Core()->weekstart . ")";
				break;
			case "thismonth":
				$start = new DateTime("first day of this month");
				$end = new DateTime("last day of this month");
				$clause .= " AND (t.due_on >= '" . $start->format('Y-m-d') . " 00:00:00' AND t.due_on <= '" . $end->format('Y-m-d') . " 23:59:59')";
				break;
			case "nextmonth":
				$start = new DateTime("first day of next month");
				$end = new DateTime("last day of next month");
				$clause .= " AND (t.due_on >= '" . $start->format('Y-m-d') . " 00:00:00' AND t.due_on <= '" . $end->format('Y-m-d') . " 23:59:59')";
				break;
			case "selected":
				if (Validator::notEmptyGet('duedate_select') and $duedate = Validator::sanitize($_GET['duedate_select'], "string", 24)) {
					$clause .= " AND DATE(t.due_on) = '" . Db::todate($duedate, false) . "'";
				}
				break;
			case "range":
				if (
					Validator::notEmptyGet('duedate_from') and $duefrom = Validator::sanitize($_GET['duedate_from'], "string", 24) and
					Validator::notEmptyGet('duedate_to') and $dueto = Validator::sanitize($_GET['duedate_to'], "string", 24)
				) {
					$clause .= " AND (DATE(t.due_on) BETWEEN '" . Db::todate($duefrom, false) . "' AND '" . Db::todate($dueto, false) . "')";
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['createdby_id']) {
			case "users":
				if (Validator::notEmptyGet('created_by_id') and $created_by_id = Validator::sanitize($_GET['created_by_id'], "int", 6)) {
					$clause .= " AND t.created_by_id = {$created_by_id}";
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['created_id']) {
			case "today":
				$clause .= " AND DATE(t.created) = '" . Date::today('', 'Y-m-d') . "'";
				break;
			case "yesterday":
				$clause .= " AND DATE(t.created) = '" . Date::NumberOfDays('-1 day', 'Y-m-d') . "'";
				break;
			case "thisweek":
				$clause .= " AND YEARWEEK(t.created, " . App::Core()->weekstart . ") = YEARWEEK(CURDATE(), " . App::Core()->weekstart . ")";
				break;
			case "lastweek":
				$clause .= " AND YEARWEEK(t.created, " . App::Core()->weekstart . ") = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, " . App::Core()->weekstart . ")";
				break;
			case "thismonth":
				$start = new DateTime("first day of this month");
				$end = new DateTime("last day of this month");
				$clause .= " AND (t.created >= '" . $start->format('Y-m-d') . " 00:00:00' AND t.created <= '" . $end->format('Y-m-d') . " 23:59:59')";
				break;
			case "lastmonth":
				$start = new DateTime("first day of previous month");
				$end = new DateTime("last day of previous month");
				$clause .= " AND (t.created >= '" . $start->format('Y-m-d') . " 00:00:00' AND t.created <= '" . $end->format('Y-m-d') . " 23:59:59')";
				break;
			case "selected":
				if (Validator::notEmptyGet('created_select') and $created = Validator::sanitize($_GET['created_select'], "string", 24)) {
					$clause .= " AND DATE(t.created) = '" . Db::todate($created, false) . "'";
				}
				break;
			case "range":
				if (
					Validator::notEmptyGet('created_from') and $createdfrom = Validator::sanitize($_GET['created_from'], "string", 24) and
					Validator::notEmptyGet('created_to') and $createdto = Validator::sanitize($_GET['created_to'], "string", 24)
				) {
					$clause .= " AND (DATE(t.created) BETWEEN '" . Db::todate($createdfrom, false) . "' AND '" . Db::todate($createdto, false) . "')";
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['completedby_id']) {
			case "users":
				if (Validator::notEmptyGet('completed_by_id') and $completed_by_id = Validator::sanitize($_GET['completed_by_id'], "int", 6)) {
					$clause .= " AND t.completed_by_id = {$completed_by_id}";
				}
				break;
			case "any":
			default:
				$clause .= null;
				break;
		}

		switch ($_GET['completed_id']) {
			case "today":
				$clause .= " AND DATE(t.completed) = '" . Date::today('', 'Y-m-d') . "'";
				break;
			case "yesterday":
				$clause .= " AND DATE(t.completed) = '" . Date::NumberOfDays('-1 day', 'Y-m-d') . "'";
				break;
			case "thisweek":
				$clause .= " AND YEARWEEK(t.completed, " . App::Core()->weekstart . ") = YEARWEEK(CURDATE(), " . App::Core()->weekstart . ")";
				break;
			case "lastweek":
				$clause .= " AND YEARWEEK(t.completed, " . App::Core()->weekstart . ") = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, " . App::Core()->weekstart . ")";
				break;
			case "thismonth":
				$start = new DateTime("first day of this month");
				$end = new DateTime("last day of this month");
				$clause .= " AND (t.completed >= '" . $start->format('Y-m-d') . " 00:00:00' AND t.completed <= '" . $end->format('Y-m-d') . " 23:59:59')";
				break;
			case "lastmonth":
				$start = new DateTime("first day of previous month");
				$end = new DateTime("last day of previous month");
				$clause .= " AND (t.completed >= '" . $start->format('Y-m-d') . " 00:00:00' AND t.completed <= '" . $end->format('Y-m-d') . " 23:59:59')";
				break;
			case "selected":
				if (Validator::notEmptyGet('completed_select') and $completed = Validator::sanitize($_GET['completed_select'], "string", 24)) {
					$clause .= " AND DATE(t.completed) = '" . Db::todate($completed, false) . "'";
				}
				break;
			case "range":
				if (
					Validator::notEmptyGet('completed_from') and $completedfrom = Validator::sanitize($_GET['completed_from'], "string", 24) and
					Validator::notEmptyGet('completed_to') and $completedto = Validator::sanitize($_GET['completed_to'], "string", 24)
				) {
					$clause .= " AND (DATE(t.completed) BETWEEN '" . Db::todate($completedfrom, false) . "' AND '" . Db::todate($completedto, false) . "')";
				}
				break;
			case "open":
			default:
				$clause .= " AND t.completed IS NULL";
				break;
		}

		$sql = "SELECT DISTINCT	t.name,
			p.name AS pname,
			t.labels,
			CONCAT(u.fname, ' ', u.lname) AS assagnee,
			t.due_on,
			t.created,
			t.completed,
			t.id,
			t.project_id,
			t.assigned_id,
			t.task_list_id,
			t.body,
			t.sorting,
			DATEDIFF(UTC_TIMESTAMP(), t.created) AS 'age',
			t.created_by_id,
			t.created_by_name,
			t.completed_by_id,
			t.completed_by_name,
			t.is_priority
		  FROM `" . Task::tTable . "` AS t
			LEFT JOIN `" . Project::pTable . "` AS p ON p.id = t.project_id
			LEFT JOIN `" . Users::mTable . "` AS u ON u.id = t.assigned_id
		  WHERE t.status <> 3
		  {$clause}
		  ORDER BY t.is_priority DESC,
			t.sorting;";

		$row = Db::run()->pdoQuery($sql)->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Stats::getTasksWorkload()
	 *
	 * @return
	 */
	public static function getTasksWorkload($status = 1, $user_id = false)
	{
		$uid = ($user_id) ? ' AND t.assigned_id = ?' : null;
		$sql = "SELECT
			t.name,
			t.created,
			t.completed,
			t.completed_by_name,
			t.due_on,
			t.labels,
			t.is_priority,
			t.id,
			t.assigned_id,
			t.project_id,
			CONCAT(m.fname,' ',m.lname) as fullname
		  FROM `" . Task::tTable . "` t
			LEFT JOIN `" . Users::mTable . "` AS m ON t.assigned_id = m.id
      WHERE t.status = ?
		  $uid
		  ORDER BY t.sorting, t.created;";

		$row = Db::run()->pdoQuery($sql, array($status, $user_id))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Stats::getTimeRecords()
	 *
	 * @return
	 */
	public static function getTimeRecords()
	{

		$sql = "SELECT
			p.name,
			p.company_name,
			t.title,
			t.description,
			CONCAT(u.fname,' ',u.lname) as assagnee,
			j.name as jobname,
			t.hours,
			t.amount,
			p.currency,
			t.user_id,
			p.id,
			DATE(t.created) as date
		  FROM	`" . Project::pTable . "` AS p
			LEFT JOIN `" . Project::trTable . "` AS t ON t.project_id = p.id
			LEFT JOIN `" . Users::mTable . "` AS u ON t.user_id = u.id
			LEFT JOIN `" . Project::jtTable . "` AS j ON t.job_id = j.id
		  WHERE t.is_billable = ?
		  ORDER BY t.hours DESC;";

		$row = Db::run()->pdoQuery($sql, array(1))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Stats::getExpenses()
	 *
	 * @return
	 */
	public static function getExpenses()
	{

		$sql = "SELECT
			p.name,
			p.company_name,
			e.title,
			e.description,
			CONCAT(u.fname,' ',u.lname) as assagnee,
			c.name as category,
			e.amount,
			p.currency,
			e.user_id,
			p.id,
			DATE(e.created) as date
		  FROM `" . Project::pTable . "` AS p
			LEFT JOIN `" . Project::exTable . "` AS e ON e.project_id = p.id
			LEFT JOIN `" . Users::mTable . "` AS u ON e.user_id = u.id
			LEFT JOIN `" . Project::excTable . "` AS c ON e.category_id = c.id
		  WHERE e.is_billable = ?
		  ORDER BY e.amount DESC;";

		$row = Db::run()->pdoQuery($sql, array(1))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Stats::getProjectTimeRecords()
	 *
	 * @return
	 */
	public static function getProjectTimeRecords($project_id, $billable = 1, $jobs = true)
	{


		$sql = ($jobs) ?
			"SELECT
			tr.job_id,
			SUM(tr.hours) AS total_hours,
			SUM(tr.amount) AS total_amount,
			SUM(tr.amount * tr.hours) AS sub_amount,
			j.name,
			j.hrate
		  FROM
			`" . Project::trTable . "` AS tr
			LEFT JOIN `" . Project::jtTable . "` AS j
			  ON j.id = tr.job_id
		  WHERE project_id = ?
		  AND tr.is_billable = ?
		  GROUP BY tr.job_id
		  ORDER BY tr.job_id;"
			: "SELECT
			tr.amount AS hrate,
			SUM(tr.hours) AS total_hours,
			SUM(tr.amount) AS total_amount,
			SUM(tr.amount * tr.hours) AS sub_amount
		  FROM
			`" . Project::trTable . "` AS tr
		  WHERE project_id = ?
		  AND tr.is_billable = ?
		  GROUP BY tr.amount
		  ORDER BY tr.hours;";

		$row = Db::run()->pdoQuery($sql, array($project_id, $billable))->results();
		return $row;
	}

	/**
	 * Stats::getBudget()
	 *
	 * @return
	 */
	public static function getBudget($project_id)
	{

		$sql = "SELECT j.id, j.name, j.hrate FROM `" . Project::jtTable . "` AS j
		ORDER BY j.name;";
		$q = Db::run()->pdoQuery($sql)->results();


		$sql2 = "SELECT	t.job_id,SUM(t.hours) as total_hours,	SUM(t.amount * t.hours) as total_amount
		  FROM	`" . Project::trTable . "` AS t
			WHERE t.is_billable = ?
			AND t.project_id =?
			GROUP BY job_id;";

		$q1 = Db::run()->pdoQuery($sql2, array(1, $project_id))->results();


		$sql3 = "SELECT	IFNULL(SUM(amount), 0)  as total_amount
		  FROM `" . Project::exTable . "`
			WHERE is_billable = ?
			AND project_id =?;";

		$q2 = Db::run()->pdoQuery($sql3, array(1, $project_id))->result();

		$data = array();
		if ($q) {
			foreach ($q as $i => $row) {
				$data[$i]['name'] = $row->name;
				$data[$i]['hrate'] = $row->hrate;
				if ($result = Utility::findInArray($q1, "job_id", $row->id)) {
					$data[$i]['hours'] = $result[0]->total_hours;
					$data[$i]['amount'] = $result[0]->total_amount;
				} else {
					$data[$i]['hours'] = '0:00';
					$data[$i]['amount'] = '0.00';
				}
			}
			$j = count($q);
			$data[$j]['name'] = Lang::$word->REP_SUB30;
			$data[$j]['hours'] = '-';
			$data[$j]['hrate'] = '-';
			$data[$j]['amount'] = $q2->total_amount;
		}

		$data = json_decode(json_encode($data), false);
		return ($data) ? $data : 0;
	}

	/**
	 * Stats::setExpenseField()
	 *
	 * @return
	 */
	public static function setExpenseField($project_id)
	{
		$exp = self::getProjectTotalExpense($project_id);
		$edata['expenses'] = number_format($exp->total_expense, 2);
		return Db::run()->update(Project::pTable, $edata, array("id" => $project_id));
	}

	/**
	 * Stats::doArraySum($array, $key)
	 *
	 * @return
	 */
	public static function doArraySum($array, $key, $format = true)
	{
		if (is_array($array)) {
			return ($format)
				? (number_format(array_sum(array_map(
					function ($item) use ($key) {
						return $item->$key;
					},
					$array
				)), 2))
				: (round(array_sum(array_map(
					function ($item) use ($key) {
						return $item->$key;
					},
					$array
				)), 2));
		}

		return 0;
	}
}
