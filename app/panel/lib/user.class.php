<?php

/**
 * Users Class
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: user.class.php, v1.00 201-10-20 18:20:24 gewa Exp $
 */
if (!defined("_WOJO"))
	die('Direct access to this location is not allowed.');


class Users
{

	const mTable = "users";
	const rfTable = 'user_references';
	const mPTable = 'user_portfolios';
	const rTable = "roles";
	const cLTable = "contact_list";
	const rpTable = "role_privileges";
	const pTable = "privileges";
	const blTable = 'banlist';
	const aTable = 'activity';
	const smTable = 'skills_users';
	const lmTable = 'languages_users';
	const nTable = 'notes_user';


	/**
	 * Users::__construct()
	 *
	 * @return
	 */
	public function __construct()
	{
	}

	/**
	 * Users::Index()
	 *
	 * @return
	 */
	public function Index($from = false)
	{

		if (isset($_GET['letter']) and (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '')) {
			$enddate = date("Y-m-d");
			$letter = Validator::sanitize($_GET['letter'], 'default', 2);
			$fromdate = (empty($from)) ? Validator::sanitize($_POST['fromdate']) : $from;
			$fromdate = Db::toDate($fromdate, false);
			if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
				$enddate = Validator::sanitize($_POST['enddate']);
				$enddate = Db::toDate($enddate, false);
			}
			$and = "AND c.created BETWEEN '" . $fromdate . "' AND '" . $enddate . " 23:59:59' AND c.name REGEXP '^" . $letter . "'";
		} elseif (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '') {
			$enddate = date("Y-m-d");
			$fromdate = (empty($from)) ? Validator::sanitize($_POST['fromdate']) : $from;
			$fromdate = Db::toDate($fromdate, false);
			if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
				$enddate = Validator::sanitize($_POST['enddate']);
				$enddate = Db::toDate($enddate, false);
			}
			$and = "AND c.created BETWEEN '" . $fromdate . "' AND '" . $enddate . " 23:59:59'";
		} elseif (isset($_GET['letter'])) {
			$letter = Validator::sanitize($_GET['letter'], 'default', 2);
			$and = "AND c.name REGEXP '^" . $letter . "' OR u.fname REGEXP '^" . $letter . "' OR u.lname REGEXP '^" . $letter . "'";
		} else {
			$and = null;
		}

		if (isset($_GET['order'])) {
			list($sort, $order) = explode("/", $_GET['order']);
			$sort = Validator::sanitize($sort, "default", 14);
			$order = Validator::sanitize($order, "default", 4);
			if (in_array($sort, array(
				"name",
				"city",
				"email",
				"currency",
				"created"
			))) {
				$ord = ($order == 'DESC') ? " DESC" : " ASC";
				$sorting = $sort . $ord;
			} else {
				$sorting = " c.owner DESC, c.name, u.userlevel DESC";
			}
		} else {
			$sorting = " c.owner DESC, c.name, u.userlevel DESC";
		}

		$sql = "SELECT c.id, c.name,	c.created AS cdate,	c.address,	c.email AS cmail, c.logo,	c.owner, CONCAT(u.fname, ' ', u.lname) AS fullname,	u.id AS mid,	u.userlevel, u.avatar,	u.active,
			u.invite_by,
			u.invite_on,
			u.email
		  FROM `" . Company::cTable . "`  AS c
			LEFT JOIN `" . self::mTable . "` AS u ON u.company = c.id
		  WHERE c.status = ?
		  AND u.status = ?
		  $and
		  ORDER BY $sorting;";
		$query = Db::run()->pdoQuery($sql, array(1,1 ))->results();

		$sql2 = "SELECT	CONCAT(u.fname, ' ', u.lname) AS fullname,	u.id, u.userlevel,	u.avatar,	u.active,	u.invite_by,	u.invite_on, u.email
		  FROM `" . self::mTable . "`  AS u
		  WHERE u.status = 1
		  AND u.company = 0
		  ORDER BY u.fname;";
		$query2 = Db::run()->pdoQuery($sql2)->results();
		//AND u.userlevel NOT IN (20,21)
		$data = array();
		if ($query) {
			$cid = null;
			foreach ($query as $i => $row) {
				if ($cid != $row->name) {
					$cid = $row->name;
					$data['hcmp'][$row->id]['name'] = $row->name;
					$data['hcmp'][$row->id]['address'] = $row->address;
					$data['hcmp'][$row->id]['logo'] = $row->logo;
					$data['hcmp'][$row->id]['cdate'] = $row->cdate;
					$data['hcmp'][$row->id]['owner'] = $row->owner;
					$data['hcmp'][$row->id]['id'] = $row->id;
				}
				$data['hcmp'][$row->id]['members'][$i]['fullname'] = $row->fullname;
				$data['hcmp'][$row->id]['members'][$i]['avatar'] = $row->avatar;
				$data['hcmp'][$row->id]['members'][$i]['email'] = $row->email;
				$data['hcmp'][$row->id]['members'][$i]['userlevel'] = $row->userlevel;
				$data['hcmp'][$row->id]['members'][$i]['invite_on'] = $row->invite_on;
				$data['hcmp'][$row->id]['members'][$i]['invite_by'] = $row->invite_by;
				$data['hcmp'][$row->id]['members'][$i]['active'] = $row->active;
				$data['hcmp'][$row->id]['members'][$i]['uid'] = $row->mid;
			}
		}

		$data['ncmp'] = $query2 ? $query2 : null;

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->template = 'admin/members.tpl.php';
		$tpl->title = Lang::$word->MAC_TITLE;
		$tpl->crumbs = ['admin', Lang::$word->NAV_1];
		$tpl->data = $data;
	}

	/**
	 * Users::invitePople()
	 *
	 * @return
	 */
	public function invitePople()
	{

		$filters = array(
			'role' => 'string',
			'company' => 'numbers'
		);

		if (!array_filter($_POST['email'])) {
			Message::$msgs['email'] = LANG::$word->MAC_ONEMAIL;
		}

		if (array_filter($_POST['email'])) {
			$pemails = array_filter($_POST['email']);
			$in_string = '';
			foreach ($pemails as $i => $email) {
				$in_string .= "'" . Validator::sanitize($email, "emailalt") . "',";
			}
			$in_string = substr($in_string, 0, -1);

			$sql = "SELECT email, CONCAT(fname,' ',lname) as name  FROM `" . self::mTable . "` WHERE email IN (" . $in_string . ")";
			if ($emails = Db::run()->pdoQuery($sql)->results()) {
				$res = '<ul>';
				foreach ($emails as $value) {
					$res .= '<li>' . $value->email . ' - ' . $value->name . '</li>';
				}
				$res .= '</ul>';
				Message::$msgs['email'] = LANG::$word->MAC_MAILIN_USE . $res;
			}
		}

		$validate = Validator::instance();
		$safe = $validate->doFilter($_POST, $filters);

		if (empty(Message::$msgs)) {
			$emails = array_filter($_POST['email']);
			foreach ($emails as $email) {
				$dataArray[] = array(
					'username' => $email,
					'email' => $email,
					'company' => ($safe->company) ? $safe->company : 0,
					'type' => $safe->role,
					'userlevel' => ($safe->role == "owner" ? 9 : ($safe->role == "staff" ? 8 : 1)),
					'status' => 1,
					'active' => "t",
					'invite_by' => Auth::$userdata->fname . ' ' . Auth::$userdata->lname,
					'invite_on' => Db::toDate(),
					'invite_token' => Utility::randomString(32)
				);
			}
			$last_id = Db::run()->insertBatch(self::mTable, $dataArray)->getAllLastInsertId();
			$datapArray = array();
			if (isset($_POST['projects'])) {
				foreach ($last_id as $uid) {
					foreach ($_POST['projects'] as $k => $pid) {
						$datapArray[] = array(
							'user_id' => $uid,
							'project_id' => $pid,
						);
					}
				}
				Db::run()->insertBatch(Project::pxTable, $datapArray);
			}

			$tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'userInvite'));
			$mailer = Mailer::sendMail();
			$mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
			$replacements = array();
			$numSent = 0;
			$failedRecipients = array();

			$core = App::Core();
			$userrow = Db::run()->pdoQuery("SELECT email, invite_token FROM `" . self::mTable . "` WHERE id IN(" . Utility::implodeFields($last_id) . ")")->results();

			foreach ($userrow as $cols) {
				$replacements[$cols->email] = array(
					'[LOGO]' => Utility::getLogo(),
					'[EMAIL]' => $cols->email,
					'[DATE]' => date('Y'),
					'[COMPANY]' => $core->company,
					'[LOGINURL]' => Url::url('/join', $cols->invite_token),
					'[SITEURL]' => SITEURL,
					'[CEMAIL]' => $core->site_email,
					'[FB]' => $core->social->facebook,
					'[TW]' => $core->social->twitter,
				);
			}

			$decorator = new Swift_Plugins_DecoratorPlugin($replacements);
			$mailer->registerPlugin($decorator);

			$message = Swift_Message::newInstance()
				->setSubject(str_replace("[COMPANY]", $core->company, $tpl->subject))
				->setFrom(array($core->site_email => $core->company))
				->setBody($tpl->body, 'text/html');
			$dataAcArray = array();
			foreach ($userrow as $row) {
				$message->setTo(array($row->email));
				$numSent++;
				$mailer->send($message, $failedRecipients);

				$dataAcArray[] = array(
					'uid' => App::Auth()->uid,
					'type' => "Members",
					'groups' => "invite",
					'fullname' => $row->email,
					'is_activity' => 1,
					'ip' => Url::getIP()
				);
			}
			Db::run()->insertBatch(self::aTable, $dataAcArray);

			unset($row);

			if ($numSent) {
				$json['type'] = 'success';
				$json['title'] = Lang::$word->SUCCESS;
				$json['message'] = $numSent . ' ' . Lang::$word->MAC_SENDINV_OK;
				$json['redirect'] = Url::url("/admin/members");
			} else {
				$json['type'] = 'error';
				$json['title'] = Lang::$word->ERROR;
				$res = '';
				$res .= '<ul class="wojo list">';
				foreach ($failedRecipients as $failed) {
					$res .= '<li>' . $failed . '</li>';
				}
				$res .= '</ul>';
				$json['message'] = Lang::$word->EMN_ALERT . $res;
			}
			exit(json_encode($json));
		} else {
			Message::msgSingleStatus();
		}
	}

	/**
	 * Users::Archive()
	 *
	 * @return
	 */
	public function Archive()
	{
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->title = Lang::$word->MAC_ARCHIVE;
		$tpl->members = $this->getArchivedMembers();
		$tpl->companies = App::Company()->getArchivedCompanies();
		$tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_3];
		$tpl->template = 'admin/members.tpl.php';
	}

	/**
	 * Users::Details()
	 *
	 * @param int $id
	 * @return
	 */
	public function Details($id)
	{

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->title = Lang::$word->MAC_TITLE2;
		$tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_16];

		if (!$row = Db::run()->first(self::mTable, null, array("id =" => $id))) {
			$tpl->template = 'admin/error.tpl.php';
			$tpl->error = DEBUG ? "Invalid ID ($id) detected [users.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		} else {
			$tpl->row = $row;
			$tpl->data = Utility::groupToLoop($this->getUserActivity($id), "day");
			$tpl->template = 'admin/members.tpl.php';
		}
	}

	/**
	 * Users::invite()
	 *
	 * @return
	 */
	public function Invite()
	{
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->title = Lang::$word->MAC_INVPEOPLE;
		$tpl->projects = App::Project()->getProjects();
		$tpl->companies = App::Company()->getCompanies();
		$tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_4];
		$tpl->template = 'admin/members.tpl.php';
	}

	/**
	 * Users::Activity()
	 *
	 * @return
	 */
	public function Activity()
	{

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->template = 'admin/activity.tpl.php';
		$tpl->title = Lang::$word->ACT_TITLE;
		$tpl->data = $this->getAllUserActivity(Date::doDate("yyyy-MM-dd", Date::today()));
	}

	/**
	 * Users::getUserActivity()
	 *
	 * @param int $id
	 * @return
	 */
	public function getUserActivity($id)
	{

		$sql = "SELECT	*,	DATE(created) AS day, TIME(created) AS hour
		  FROM	`" . self::aTable . "`
		  WHERE uid = ?
		  AND is_activity = ?
		  ORDER BY created DESC;";

		$row = Db::run()->pdoQuery($sql, array($id, 1))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Users::getAllUserActivity()
	 *
	 * @param str $date
	 * @return
	 */
	public function getAllUserActivity($date)
	{

		$sql = "SELECT *,	DATE(created) AS cdate, TIME(created) AS hour
		  FROM `" . self::aTable . "`
		  WHERE uid = ?
		  AND DATE(created) = ?
		  ORDER BY created DESC;";

		$row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, $date))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Users::addSmallActivity()
	 *
	 * @param array $data
	 * @return
	 */
	public static function addSmallActivity($data)
	{

		$data2 = array(
			'username' => App::Auth()->username,
			'fullname' => App::Auth()->name,
		);
		$result = array_merge($data, $data2);

		Db::run()->insert(self::aTable, $result);
	}

	/**
	 * Users::getArchivedMembers()
	 *
	 * @return
	 */
	public function getArchivedMembers()
	{
		$sql = "SELECT	*, CONCAT(fname, ' ', lname) AS name
		  FROM `" . self::mTable . "`
		  WHERE status = ?
		  ORDER BY fname;";
		$row = Db::run()->pdoQuery($sql, array(3))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Users::activityStatus()
	 *
	 * @param array $array
	 * @return
	 */
	public static function activityStatus($array, $dir = 'admin')
	{
		switch ($array->groups) {
			case "invoice":
				return Lang::$word->ACT_CRINV . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/invoices/view", $array->invoice_id) . '">' .  $array->title . ' </a>');
				break;
			case "estimate":
				return Lang::$word->ACT_CREST . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/estimates/view", $array->estimate_id) . '">' .  $array->title . ' </a>');
				break;
			case "invite":
				return Lang::$word->ACT_INVUSR . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/members/details", $array->userid) . '">' .  $array->comment . ' </a>');
				break;
			case "company":
				return Lang::$word->ACT_CRCOMPANY . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/companies/view", $array->company_id) . '">' .  $array->title . ' </a>');
				break;
			case "project":
				return Lang::$word->ACT_CRPROJECT . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/view", $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			case "projectc":
				return Lang::$word->ACT_CRPROJECTC . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/view", $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			case "task":
				return Lang::$word->ACT_CRTASK . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/tasks", $array->task_id) . '">' .  $array->title . ' </a>');
				break;
			case "team":
				return Lang::$word->ACT_CRTEAM . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/teams") . '">' .  $array->title . ' </a>');
				break;
			case "message":
				return Lang::$word->ACT_CRDIS . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/discussions/" . $array->project_id, $array->message_id) . '">' .  $array->title . ' </a>');
				break;
			case "note":
				return Lang::$word->ACT_CRNOTE . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/notes/view/" . $array->project_id, $array->note_id) . '">' .  $array->title . ' </a>');
				break;
			case "file":
				return Lang::$word->ACT_UPLFILE . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/files/list", $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			case "calendar":
				return Lang::$word->ACT_CRCAL . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/calendar") . '">' .  $array->title . ' </a>');
				break;
			case "time":
				return Lang::$word->ACT_CRTIME . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/time", $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			case "expense":
				return Lang::$word->ACT_CREXPENSE . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/expenses", $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			default:
				return '';
				break;
		}
	}

	/**
	 * Users::Freelancer()
	 * This Function gets the list of freelancers
	 * @return
	 */
	public function Freelancers()
	{
		$sql = "SELECT
            CONCAT(u.fname, ' ', u.lname) AS fullname,
            u.username,
            u.id AS uid,
            u.userlevel,
            u.email,
						u.is_completed,
            u.active,
						u.headline,
						u.short_CV,
						u.approvalStatus,
            u.hourly_rate,
						u.available_hour,
						u.emp_type,
            u.currency,
            u.emp_prefer,
            n.note AS note,
            GROUP_CONCAT(DISTINCT sk.name SEPARATOR ', ') AS skills,
						GROUP_CONCAT(DISTINCT p.id SEPARATOR ', ') AS project
          	FROM `" . self::mTable . "`  AS u
            LEFT JOIN `" . self::nTable . "` AS n ON n.uid = u.id
            LEFT JOIN `" . Users::smTable . "` AS su ON u.id = su.uid
            LEFT JOIN `" . Project::sTable . "` AS sk ON su.sid = sk.id AND su.confirmed=1
						LEFT JOIN `" . Project::pxTable . "` AS px ON px.user_id = u.id
						LEFT JOIN `" . Project::pTable . "` AS p ON px.project_id = p.id AND p.status=1
           WHERE u.userlevel = 21
           Group BY u.id
           Order BY u.id DESC;";
		$query = Db::run()->pdoQuery($sql)->results();
		$data = array();
		$data['ncmp'] = $query ? $query : null;
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->template = 'admin/freelancer_list.tpl.php';
		$tpl->title = Lang::$word->MAC_TITLE;
		$tpl->crumbs = ['admin', Lang::$word->NAV_1];
		$tpl->skills = Db::run()->select(Project::sTable, array('id','name'))->results();
		$tpl->sql = $sql;
		$tpl->data = $data;
	}


	/**
	 * Users::Freelancer()
	 * This Function gets the list of freelancers
	 * @return
	 */
	public function advancedSearch()
	{
		$rules = array(
			'fullname' => array('string', 'Invalid Name'),
			'approvedStatus' => array('string', 'Invalid Status'),
			'empPref'  => array('string', 'Invalid Employment Prefer'),
			'empType'  => array('string', 'Invalid Employment Type'),
			'from'  => array('int', 'Invalid Value of Price'),
			'to'  => array('int', 'Invalid Value of Price'),
			'hours' => array('int', 'Ivalid Hour Value'),
			'skills' => array('int', 'Invalid Skill Values'),
			'sortName' => array('string', 'Invalid sortName Value'),
			'sortHourPrice' => array('string', 'Invalid sortHourPrice Value'),
			'sortHour' => array('string', 'Invalid sortHour Value'),
		);
		$filters = array('sortHour' => 'string', 'sortHourPrice' => 'string', 'sortName' => 'string','fullname' => 'string', 'approvedStatus' => 'string','empPref' => 'string','empType' => 'string','from' => 'int','to' => 'int','hours' => 'int','skills' => 'int',);
		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);
		$safe = $validate->doFilter($_POST, $filters);
		$orderby = 0;
		$sql = "SELECT
            CONCAT(u.fname, ' ', u.lname) AS fullname,
            u.username,
						u.remoTitle,
            u.id AS uid,
            u.userlevel,
            u.email,
						u.is_completed,
            u.active,
						u.approvalStatus,
            u.hourly_rate,
						u.available_hour,
						u.emp_type,
            u.currency,
            u.emp_prefer,
            u.headline AS headline,
            n.note AS note,
            GROUP_CONCAT(sk.name SEPARATOR ', ') AS skills,
						GROUP_CONCAT(px.project_id SEPARATOR ', ') AS project
          	FROM  `" . self::mTable . "`  AS u
            LEFT JOIN `" . self::nTable . "` AS n ON n.uid = u.id
            LEFT JOIN `" . Users::smTable . "` AS su  ON u.id = su.uid
            LEFT JOIN `" . Project::sTable . "` AS sk  ON su.sid = sk.id AND su.confirmed=1
						LEFT JOIN `" . Project::pxTable . "` AS px	ON px.user_id = u.id
          	WHERE u.userlevel = 21";
			if(isset($_POST["skills"]) && $_POST["skills"] != "")
			{
					$skillQuery = json_encode($_POST["skills"]);
					$replace = array("[","]");
					$with = array("","");
					$skillQuery = str_replace($replace,$with,$skillQuery);

				$sql = $sql." AND su.sid IN (".$skillQuery.")";
			}
			if(isset($_POST["fullname"]) && $_POST["fullname"] != "")
			{
				$sql = $sql.' AND CONCAT(u.fname, " ", u.lname) LIKE "%'.$safe->fullname.'%"';
			}
			if(isset($_POST["approvedStatus"]) && $_POST["approvedStatus"] != "")
			{
					$approvedStatusQuery = json_encode($_POST["approvedStatus"]);
					$replace = array("[","]");
					$with = array("","");
					$approvedStatusQuery = str_replace($replace,$with,$approvedStatusQuery);

				$sql = $sql." AND u.approvalStatus IN (".$approvedStatusQuery.")";
			}
			if(isset($_POST["from"]) && $_POST["from"] != "")
			{
				$sql = $sql." AND u.hourly_rate >=".$safe->from;
			}
			if(isset($_POST["to"]) && $_POST["to"] != "")
			{
				$sql = $sql." AND u.hourly_rate <=".$safe->to;
			}
			if(isset($_POST["hours"]) && $_POST["hours"] != "")
			{
				$sql = $sql." AND u.available_hour >=".$safe->hours;
			}
			if(isset($_POST["empType"]) && $_POST["empType"] != "")
			{
				$sql = $sql.' AND u.emp_type LIKE "%'.$safe->empType.'%"';
			}
			if(isset($_POST["empPref"]) && $_POST["empPref"] != "")
			{
				$sql = $sql.' AND u.emp_prefer LIKE "%'.$safe->empPref.'%"';
			}
		  $sql = $sql." Group BY u.id ";
		  	if(isset($_POST["sortName"]) && $_POST["sortName"] != "")
			{
				if($orderby==0)
				{
					$sql = $sql."ORDER BY";
					$orderby= 1;
				}else
				{
					$sql = $sql.",";
				}
				$sql = $sql." CONCAT(u.fname, ' ', u.lname) ".$safe->sortName;
			}
			if(isset($_POST["sortHourPrice"]) && $_POST["sortHourPrice"] != "")
			{
				if($orderby==0)
				{
					$sql = $sql."ORDER BY";
					$orderby= 1;
				}else
				{
					$sql = $sql.",";
				}
				$sql = $sql." u.hourly_rate ".$safe->sortHourPrice;
			}
			if(isset($_POST["sortHour"]) && $_POST["sortHour"] != "")
			{
				if($orderby==0)
				{
					$sql = $sql."ORDER BY";
					$orderby= 1;
				}else
				{
					$sql = $sql.",";
				}
				$sql = $sql." u.available_hour ".$safe->sortHour;
			}

			if($orderby==0)
			{
				$sql = $sql."ORDER BY";
				$orderby= 1;
			}else
			{
				$sql = $sql.",";
			}
			$sql = $sql." u.id DESC";
		$query = Db::run()->pdoQuery($sql)->results();
		$data = array();
		$data['ncmp'] = $query ? $query : null;
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->template = 'admin/freelancer_list.tpl.php';
		$tpl->title = Lang::$word->MAC_TITLE;
		$tpl->crumbs = ['admin', Lang::$word->NAV_1];
		$tpl->skills = Db::run()->select(Project::sTable, array('id','name'))->results();
		$tpl->data = $data;
	}


	/**
	 * Users::Projects()
	 * This Function gets the list of client projects level 20
	 * @return
	 */
	public function Projects()
	{
		$sql = "SELECT
						p.id,
            p.name,
            p.description,
            p.created_by_name,
						p.budget_type_id,
						p.minimum_budget,
						p.maximum_budget,
						p.work_type,
						p.skill,
						p.required_dev,
            GROUP_CONCAT(sk.name SEPARATOR ', ') AS skills
           FROM `" . Project::pTable . "`  AS p
            LEFT JOIN `" . Project::psTable . "` AS ps ON p.id = ps.pid
            LEFT JOIN `" . Project::sTable . "` AS sk ON ps.sid = sk.id
						LEFT JOIN `" . Users::mTable . "` AS u ON u.id = p.created_by_id
          	WHERE u.userlevel = 20	AND p.status = 1
          	Group BY p.id
          	Order BY p.created DESC;";
		$query = Db::run()->pdoQuery($sql)->results();
		$data = array();
		$data['ncmp'] = $query ? $query : null;
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->template = 'admin/freelancer_list.tpl.php';
		$tpl->title = Lang::$word->MAC_TITLE;
		$tpl->crumbs = ['admin', Lang::$word->NAV_1];
		$tpl->data = $data;
	}

	/**
	 * Users::Index()
	 *
	 * @return
	 */
	public function ProjectView($id)
	{

		$core = App::Core();
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->template = 'admin/_project_view.tpl.php';
		$tpl->title = Lang::$word->PRJ_SUB7;
		if (!$row = App::Project()->getClientProjects(intval($id))) {
			$tpl->template = 'admin/404.tpl.php';
			$tpl->error = DEBUG ? "Invalid ID ($id) detected [users.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		} else {
			$tpl->row = $row;
			$tpl->uRow = App::Auth()->getUserInfoById($row->created_by_id);
			$tpl->files =  Db::run()->select(Project::fTable, null, array("project_id" => $id), ' AND `parent` IS NULL ORDER BY id')->results();
			$tpl->skills = App::Master()->getProjectSkills($id);
			$tpl->budget = Db::run()->select(Project::bTable, array('minimum', 'type', 'maximum'), array('id' => intval($row->budget_type_id)))->result();
			if ($tpl->row->budget_type_id == 16) {
				$tpl->budget->minimum = $tpl->row->minimum_budget;
				$tpl->budget->maximum = $tpl->row->maximum_budget;
				$tpl->budget->type = $tpl->row->project_type;
			}

			$tpl->isProjectBased =  false;
			if (strtolower($tpl->row->work_type) === 'project based')
				$tpl->isProjectBased =  true;
		}
	}



	/**
	 * Users::AddUserNotes
	 * This function will add and edit notes for freelancers
	 * @return
	 */
	public function addUserNotes()
	{
		$rules = array(
			'note' => array('string|min_len,0|max_len,1000', Lang::$word->NOTE),
			'id' => array('required|numeric', 'invalid id'),
		);
		$filters = array('note' => 'string', 'id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);
		$safe = $validate->doFilter($_POST, $filters);
		if (empty(Message::$msgs)) {
			if (isset($safe->note)) {
				Db::run()->delete(self::nTable, array("uid" => Filter::$id));
				$dataArray = array(
					'uid' => Filter::$id,
					'note' => $safe->note,
				);
				Db::run()->insert(self::nTable, $dataArray);
			}
			$json['type'] = 'success';
			$json['title'] = Lang::$word->SUCCESS;
			$json['message'] = Lang::$word->NOT_ADDED_OK;
			$json['redirect'] = Url::url('/admin/members', 'freelancers');
			print json_encode($json);
		} else {
			Message::msgSingleStatus();
		}
	}

		/**
	 * Users::addUserNotesAtPage
	 * This function will add and edit notes for freelancers at their pages.
	 * @return
	 */
	public function addUserNotesAtPage()
	{
		$rules = array(
			'note' => array('string|min_len,0|max_len,1000', Lang::$word->NOTE),
			'id' => array('required|numeric', 'invalid id'),
		);
		$filters = array('note' => 'string', 'id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);
		$safe = $validate->doFilter($_POST, $filters);
		$row1 = Db::run()->select(Users::nTable, array("uid"),array("uid" => $_POST["id"]))->results();

			if (isset($safe->note)) {
				$data = array(
				'note' => $safe->note);
				if(isset($row1[0]->uid))
				{
			Db::run()->update(self::nTable, $data, array("uid" => $_POST["id"]));
				}else
				{
				$dataArray = array(
					'uid' => $_POST["id"],
					'note' => $safe->note,
				);
				Db::run()->insert(self::nTable, $dataArray);
				}
			}

			$row = Db::run()->select(Users::mTable, array("username"),array("id" => $_POST["id"]))->results();
			$url = '/admin/members/'.$row[0]->username;
			$json['type'] = 'success';
			$json['title'] = Lang::$word->SUCCESS;
			$json['message'] = Lang::$word->NOT_ADDED_OK;
			$json['redirect'] = Url::url($url);
			print json_encode($json);
	}


	/**
	 * Users::processSkillConfirm
	 * This function will confirm the skills of freelancers
	 * @return
	 */
	public function processSkillConfirm()
	{

		$wipe = array(
			'confirmed' => 0,
		);
		$data = array(
			'confirmed' => 1,
		);
			Db::run()->update(Users::smTable, $wipe, array("uid" => $_POST["id"]));
		foreach ($_POST['confirmSkill'] as $skill) {
			Db::run()->update(Users::smTable, $data, array("sid" => $skill,"uid" => $_POST["id"]));
            }

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->CONF_SKILL_OK;
		//$json['redirect'] = Url::url('/admin/members', 'freelancers');
		print json_encode($json);
	}

		/**
	 * Users::approvalStatus
	 * This function will confirm the skills of freelancers
	 * @return
	 */
	public function approvalStatus()
	{
		$rules = array(
			'approvalStatus' => array('string', 'Ivalid Status'),
			'id' => array('required|numeric', 'invalid id'),
		);
		$filters = array('approvalStatus' => 'string', 'id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);
		$safe = $validate->doFilter($_POST, $filters);

		$data = array(
			'approvalStatus' => $safe->approvalStatus,
		);
			Db::run()->update(Users::mTable, $data, array("id" => $_POST["id"]));

		$row = Db::run()->select(Users::mTable, array("username"),array("id" => $_POST["id"]))->results();
		$url = '/admin/members/'.$row[0]->username;

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->UPDATED;
		$json['redirect'] = Url::url($url);
		print json_encode($json);
	}

	/**
	 * Users::remoTitleUpdate
	 * This function will confirm the skills of freelancers
	 * @return
	 */
	public function remoTitleUpdate()
	{
		$rules = array(
			'remoTitle' => array('string', 'Ivalid Status'),
			'id' => array('required|numeric', 'invalid id'),
		);
		$filters = array('remoTitle' => 'string', 'id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);
		$safe = $validate->doFilter($_POST, $filters);

		$data = array(
			'remoTitle' => $safe->remoTitle,
		);
			Db::run()->update(Users::mTable, $data, array("id" => $_POST["id"]));

		$row = Db::run()->select(Users::mTable, array("username"),array("id" => $_POST["id"]))->results();
		$url = '/admin/members/'.$row[0]->username;

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->UPDATED;
		$json['redirect'] = Url::url($url);
		print json_encode($json);
	}

		/**
	 * Users::updateShortCV
	 * This function will update the short_CV value of freelancers.
	 * @return
	 */
	public function updateShortCV()
	{
		$rules = array(
			'short_CV' => array('string', 'Invalid Form'),
			'id' => array('required|numeric', 'invalid id'),
		);
		$filters = array('note' => 'string', 'id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);
		$safe = $validate->doFilter($_POST, $filters);

		$data = array(
			'short_CV' => $safe->shortCV
		);
		Db::run()->update(Users::mTable, $data, array("id" => $_POST["id"]));
		$row = Db::run()->select(Users::mTable, array("username"),array("id" => $_POST["id"]))->results();
		$url = '/admin/members/'.$row[0]->username;
		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->UPDATED;
		$json['redirect'] = Url::url($url);
		print json_encode($json);
	}

		/**
	 * Users::updateReferenceStatus
	 * This function will update the referenceStatus value of freelancers.
	 * @return
	 */
	public function updateReferenceStatus()
	{
		$rules = array(
			'referenceStatus' => array('string', 'Invalid Form'),
			'id' => array('required|numeric', 'invalid id'),
		);
		$filters = array('note' => 'string', 'id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);
		$safe = $validate->doFilter($_POST, $filters);


		$referenceUpdate = [];
		foreach($_POST['referenceStatus'] as $reference)
		{
			$referenceData = explode("-",$reference);
			$referenceArray["id"] = $referenceData[0];
			$referenceArray["status"] = $referenceData[1];
			$referenceUpdate[] = $referenceArray;
		}
		foreach($referenceUpdate as $reference)
		{
			$data = array(
				'status' => $reference["status"]
			);
			Db::run()->update(Users::rfTable, $data, array("id" => $reference["id"]));
		}
		$row = Db::run()->select(Users::mTable, array("username"),array("id" => $_POST["id"]))->results();
		$url = '/admin/members/'.$row[0]->username;
		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->UPDATE;
		$json['redirect'] = Url::url($url);
		print json_encode($json);
	}

	/**
	 * Users::activityTypeStatus()
	 *
	 * @param mixed $type
	 * @return
	 */
	public static function activityTypeStatus($type)
	{
		switch ($type) {
			case "Invoices":
				return Lang::$word->INV_INVOICES;
				break;

			case "Estimates":
				return Lang::$word->EST_ESTIMATES;
				break;
			case "Teams":
				return Lang::$word->TMS_TEAMS;
				break;
			case "Members":
				return Lang::$word->PEOPLE;
				break;
			case "Companies":
				return Lang::$word->CMP_COMPANIES;
				break;
			case "Tasks":
				return Lang::$word->TSK_TASKS;
				break;
			case "Notes":
				return Lang::$word->NOT_NOTES;
				break;
			case "Projects":
				return Lang::$word->PRJ_PROJECTS;
				break;
			case "Calendar":
				return Lang::$word->CAL_CALENDAR;
				break;
		}
	}

	/**
	 * Users::resendInvitation()
	 *
	 * @return
	 */
	public function resendInvitation()
	{

		$row = Db::run()->first(Users::mTable, array("email", "invite_token", "id"), array('id' => Filter::$id));
		$tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'userInvite'));

		$data = array(
			'invite_by' => Auth::$userdata->fname . ' ' . Auth::$userdata->lname,
			'invite_on' => Db::toDate(),
			'invite_token' => Utility::randomString(32),
		);
		Db::run()->update(self::mTable, $data, array("id" => $row->id));

		$mailer = Mailer::sendMail();
		$core = App::Core();

		$body = str_replace(array(
			'[LOGO]',
			'[EMAIL]',
			'[DATE]',
			'[COMPANY]',
			'[LOGINURL]',
			'[FB]',
			'[TW]',
			'[SITEURL]'
		), array(
			Utility::getLogo(),
			$row->email,
			date('Y'),
			$core->company,
			Url::url("/join", "?token=" . $data['invite_token']),
			$core->social->facebook,
			$core->social->twitter,
			SITEURL
		), $tpl->body);

		$msg = Swift_Message::newInstance()
			->setSubject(str_replace("[COMPANY]", $core->company, $tpl->subject))
			->setTo(array($row->email))
			->setFrom(array($core->site_email => $core->company))
			->setBody($body, 'text/html');

		if ($mailer->send($msg)) {
			$json['type'] = 'success';
			$json['title'] = Lang::$word->SUCCESS;
			$json['message'] = Lang::$word->MAC_RESEND_OK;
		} else {
			$json['type'] = 'error';
			$json['title'] = Lang::$word->ERROR;
			$json['message'] = Lang::$word->SENDERROR;
		}
		print json_encode($json);
	}

	/**
	 * Users::updateRoleDescription()
	 *
	 * @return
	 */
	public static function updateRoleDescription()
	{

		$rules = array(
			'name' => array('required|string|min_len,2|max_len,60', Lang::$word->NAME),
			'description' => array('required|string|min_len,2|max_len,150', Lang::$word->DESCRIPTION),
		);

		$validate = Validator::instance();
		$safe = $validate->doValidate($_POST, $rules);

		if (empty(Message::$msgs)) {
			$data = array(
				'name' => $safe->name,
				'description' => $safe->description
			);

			Db::run()->update(self::rTable, $data, array('id' => Filter::$id));
			Message::msgModalReply(Db::run()->affected(), 'success', Lang::$word->ACC_ROLE_UPDATED, Validator::truncate($data['description'], 80));
		} else {
			Message::msgSingleStatus();
		}
	}

	/**
	 * Users::getAllStaff()
	 *
	 * @param int $status
	 * @param string $active
	 * @param string $is_owner
	 * @return
	 */
	public function getAllStaff($status = 1, $active = "y", $is_owner = false)
	{
		$owner = ($is_owner) ? "AND type = 'owner' OR type= 'staff'" : "AND type = 'staff'";
		$sql = "SELECT
			  id,
			  username,
			  email,
			  avatar,
			  CONCAT(fname, ' ', lname) AS name
				FROM `" . self::mTable . "`
				WHERE status = ?
				$owner
				AND active = ?
				ORDER BY fname;";
		$row = Db::run()->pdoQuery($sql, array($status, $active, 0))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Users::getAllClients()
	 *
	 * @param int $status
	 * @param string $active
	 * @return
	 */
	public function getAllClients($status = 1, $active = "y")
	{
		$sql = "SELECT
			id,
			username,
			email,
			avatar,
			CONCAT(fname, ' ', lname) AS name
		  FROM `" . self::mTable . "`
		  WHERE status = ?
		  AND type = ?
		  AND active = ?
		  ORDER BY fname;";
		$row = Db::run()->pdoQuery($sql, array($status, "member", $active))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Users::getRoles()
	 *
	 * @return
	 */
	public function getRoles()
	{

		$row = Db::run()->select(self::rTable)->results();

		return ($row) ? $row : 0;
	}

		/**
	 * Users::getSkills()
	 *
	 * @return
	 */
	public function getSkills()
	{
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->title = Lang::$word->SKILLS;
		$tpl->data = Db::run()->select(Project::sTable)->results();
		$tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_3];
		$tpl->template = 'admin/addSkills.tpl.php';
	}

		/**
	 * Users::ajaxSkills()
	 *
	 * @return
	 */
	public function ajaxSkills()
	{
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$skillData["data"] = Db::run()->select(Project::sTable)->results();
		foreach($skillData["data"] as $skill)
		{
			$skill->options = '<a class="delete-icon" id="'.$skill->id.'" onClick="deleteSkill('."'".$skill->name."',"."'".$skill->id."'".')"><i class="icon trash alt"></i></a>';
		}
		$tpl->template = 'admin/snippets/ajax.tpl.php';
		echo json_encode($skillData);
	}

			/**
	 * Users::addSkills()
	 *
	 * @return
	 */
	public function addSkills()
	{
		$rules = array(
			'name' => array('required|string|min_len,2|max_len,60', Lang::$word->SKILL),
		);
		$filters = array('name' => 'string');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_REQUEST, $rules);
		$safe = $validate->doFilter($_REQUEST, $filters);

		$data = [
			"name" => $safe->name,
		];

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		Db::run()->insert(Project::sTable, $data);
		$tpl->template = 'admin/snippets/ajax.tpl.php';

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->SKILL_SCS;
		print json_encode($json);
	}


			/**
	 * Users::deleteSkills()
	 *
	 * @return
	 */
	public function deleteSkills()
	{
		$rules = array(
			'id' => array('int', Lang::$word->SKILL),
		);
		$filters = array('id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_REQUEST, $rules);
		$safe = $validate->doFilter($_REQUEST, $filters);

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		Db::run()->delete(Project::sTable,  array("id" => $safe->id));
		$tpl->template = 'admin/snippets/ajax.tpl.php';

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = $safe->id;
		print json_encode($json);
	}


		/**
	 * Users::getContactList()
	 *
	 * @return
	 */
	public function getContactList()
	{
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$tpl->title = Lang::$word->contactList;
		$tpl->data = Db::run()->select(Users::cLTable)->results();
		$tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_3];
		$tpl->template = 'admin/contactList.tpl.php';
	}

		/**
	 * Users::ajaxContactList()
	 *
	 * @return
	 */
	public function ajaxContactList()
	{
		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$contactList = Db::run()->select(Users::cLTable)->results();
		foreach($contactList as $contact)
		{
			if($contact->feedback == '1')
			{
				$feedback = '<span class="badge badge-success">Yes</span>';
			}
			else
			{
				$feedback = '<span class="badge badge-danger">No</span>';
			}
			if($contact->messageStatus == '1')
			{
				$message = '<span class="badge badge-success">Yes</span>';
			}
			else
			{
				$message = '<span class="badge badge-danger">No</span>';
			}

		$options = '
		<a class="delete-icon" id="'.$contact->id.'" onClick="deleteContact('."'".$contact->fullname."',"."'".$contact->id."'".')"><i class="icon trash alt"></i></a>
		<a class="invite-icon" id="'.$contact->id.'" onClick="invite('.$contact->id.')"><i class="icon clipboard alt"></i></a>
		<a class="feedback-icon" id="'.$contact->id.'" onClick="feedback('.$contact->id.')"><i class="icon comment alt"></i></a>
		';


		$data["data"][] = [
			"id" => $contact->id,
			"Name" => $contact->fullname,
			"Invite" => $message,
			"Registered" => $feedback,
			"Date" => date("d/m/Y h:i:s", strtotime($contact->update_date)),
			"Options" => $options
		];

		}
		$tpl->template = 'admin/snippets/ajax.tpl.php';
		echo json_encode($data);
	}

			/**
	 * Users::addContactList()
	 *
	 * @return
	 */
	public function addContactList()
	{
		$rules = array(
			'name' => array('required|string|min_len,2|max_len,60', Lang::$word->SKILL),
		);
		$filters = array('name' => 'string');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_REQUEST, $rules);
		$safe = $validate->doFilter($_REQUEST, $filters);

		$data = [
			"fullname" => $safe->name,
			"update_date" => date("Y-m-d h:i:s")
		];

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		Db::run()->insert(Users::cLTable, $data);
		$tpl->template = 'admin/snippets/ajax.tpl.php';

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->SUCCESS;
		print json_encode($json);
	}


			/**
	 * Users::deleteContactList()
	 *
	 * @return
	 */
	public function deleteContactList()
	{
		$rules = array(
			'id' => array('int', Lang::$word->SKILL),
		);
		$filters = array('id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_REQUEST, $rules);
		$safe = $validate->doFilter($_REQUEST, $filters);

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		Db::run()->delete(Users::cLTable,  array("id" => $safe->id));
		$tpl->template = 'admin/snippets/ajax.tpl.php';

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->SUCCESS;
		print json_encode($json);
	}

			/**
	 * Users::inviteContactList()
	 *
	 * @return
	 */
	public function inviteContactList()
	{
		$rules = array(
			'id' => array('int', Lang::$word->SKILL),
		);
		$filters = array('id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_REQUEST, $rules);
		$safe = $validate->doFilter($_REQUEST, $filters);

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";

		$contactList = Db::run()->select(Users::cLTable, array("messageStatus"),array("id" => $safe->id))->results();
		if($contactList[0]->messageStatus == "0")
		{
			$data =[
				"messageStatus" => '1',
				"update_date" => date("Y-m-d h:i:s")
			];
		}else{
			$data =[
				"messageStatus" => '0',
				"update_date" => date("Y-m-d h:i:s")
			];
		}


		Db::run()->update(self::cLTable, $data, array("id" => $safe->id));
		$tpl->template = 'admin/snippets/ajax.tpl.php';

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->SUCCESS;
		print json_encode($json);
	}

		/**
	 * Users::feedbackContactList()
	 *
	 * @return
	 */
	public function feedbackContactList()
	{
		$rules = array(
			'id' => array('int', Lang::$word->SKILL),
		);
		$filters = array('id' => 'int');
		$validate = Validator::instance();
		$safe = $validate->doValidate($_REQUEST, $rules);
		$safe = $validate->doFilter($_REQUEST, $filters);

		$tpl = App::View(BASEPATH . 'view/');
		$tpl->dir = "admin/";
		$contactList = Db::run()->select(Users::cLTable, array("feedback"),array("id" => $safe->id))->results();
		if($contactList[0]->feedback == "0")
		{
			$data =[
				"feedback" => '1',
				"update_date" => date("Y-m-d h:i:s")
			];
		}else{
			$data =[
				"feedback" => '0',
				"update_date" => date("Y-m-d h:i:s")
			];
		}

		Db::run()->update(self::cLTable, $data, array("id" => $safe->id));
		$tpl->template = 'admin/snippets/ajax.tpl.php';

		$json['type'] = 'success';
		$json['title'] = Lang::$word->SUCCESS;
		$json['message'] = Lang::$word->SUCCESS;
		print json_encode($json);
	}

	/**
	 * Users::getPrivileges()
	 *
	 * @return
	 */
	public function getPrivileges($id)
	{
		$sql = "SELECT
			rp.id,
			rp.active,
			p.id as prid,
			p.name,
			p.type,
			p.description,
			p.mode
		  FROM `" . self::rpTable . "` as rp
			INNER JOIN `" . self::rTable . "` as r ON rp.rid = r.id
			INNER JOIN `" . self::pTable . "` as p ON rp.pid = p.id
		  WHERE rp.rid = ?
		  ORDER BY p.type;";

		$row = Db::run()->pdoQuery($sql, array($id))->results();

		return ($row) ? $row : 0;
	}

	/**
	 * Users::activityHistoryStatus()
	 *
	 * @param array $array
	 * @return
	 */
	public static function activityHistoryStatus($array, $dir = 'admin')
	{
		switch ($array->type) {
			case "Tasks":
				return $array->comment . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/tasks", $array->task_id) . '">' .  $array->title . ' </a>');
				break;
			case "Messages":
				return $array->comment . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/discussions/view/" . $array->project_id, $array->message_id) . '">' .  $array->title . ' </a>');
				break;
			case "Notes":
				return $array->comment . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/notes/view/" . $array->project_id, $array->note_id) . '">' .  $array->title . ' </a>');
				break;
			case "Files":
				return $array->comment . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/files/list/" . $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			case "Times":
				return $array->comment . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/time/" . $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			case "Expenses":
				return $array->comment . ((isset($array->removed)) ? '<span class="color-blue">' . " \"" .  $array->title . "\"" . '</span>' : ' <a href="' . Url::url("/" . $dir . "/projects/expenses/" . $array->project_id) . '">' .  $array->title . ' </a>');
				break;
			default:
				return '';
				break;
		}
	}

	/**
	 * Users::accountLevelToTypeLabel()
	 *
	 * @param mixed $level
	 * @return
	 */
	public static function accountLevelToTypeLabel($level)
	{
		switch ($level) {
			case 21:
				return '<span class="wojo small inverted positive label">' . Lang::$word->FREELANCER . '</span>';
			case 20:
				return '<span class="wojo small inverted positive label">' . Lang::$word->CLIENT . '</span>';
			case 9:
				return '<span class="wojo small inverted positive label">' . Lang::$word->OWNER . '</span>';

			case 8:
				return '<span class="wojo small inverted primary label">' . Lang::$word->LEV8_1 . '</span>';

			case 7:
				return '<span class="wojo small inverted secondary label">' . Lang::$word->LEV7 . '</span>';

			case 1:
				return '<span class="wojo small inverted dark label">' . Lang::$word->LEV1 . '</span>';
		}
	}

	/**
	 * Users::accountLevelToType()
	 *
	 * @param mixed $level
	 * @return
	 */
	public static function accountLevelToType($level)
	{
		switch ($level) {
			case 21:
				return '<span class="wojo small demi grey text">' . Lang::$word->FREELANCER . '</span>';
			case 20:
				return '<span class="wojo small demi grey text">' . Lang::$word->CLIENT . '</span>';
			case 9:
				return '<span class="wojo small demi positive text">' . Lang::$word->OWNER . '</span>';

			case 8:
				return '<span class="wojo small demi primary text">' . Lang::$word->LEV8_1 . '</span>';

			case 7:
				return '<span class="wojo small demi secondary text">' . Lang::$word->LEV7 . '</span>';

			case 1:
				return '<span class="wojo small demi dark text">' . Lang::$word->LEV1 . '</span>';
		}
	}
}
