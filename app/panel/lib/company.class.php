<?php
  /**
   * Company Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: company.class.php, v1.00 201-10-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');


  class Company
  {

	  const cTable = "companies";
	  const tmTable = "teams";
	  const tuTable = "teams_users";


      /**
       * Company::__construct()
       *
       * @return
       */
      public function __construct()
      {

      }

      /**
       * Company::TeamsIndex()
       *
       * @return
       */
      public function TeamsIndex()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->template = 'admin/teams.tpl.php';
		  $tpl->title = Lang::$word->TMS_TITLE;
		  $tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_2];
		  $tpl->data = $this->getAllTeams();
	  }

      /**
       * Company::newTeam()
       *
       * @return
       */
	  public function newTeam()
	  {

		  $rules = array('name' => array('required|string|min_len,3|max_len,100', Lang::$word->TMS_NAME));

		  $filters = array(
			  'name' => 'string',
			  'color' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if (empty(Message::$msgs)) {
			  $last_id = Db::run()->insert(self::tmTable, array('name' => $safe->name, 'color' => $safe->color))->getLastInsertId();

			  if (isset($_POST['uid'])) {
				  foreach ($_POST['uid'] as $uid) {
					  $dataArray[] = array('team_id' => $last_id, 'user_id' => $uid);
				  }
				  Db::run()->insertBatch(self::tuTable, $dataArray);
			  }

			  // Add activity
			  $data = array(
				  'uid' => App::Auth()->uid,
				  'type' => "Teams",
				  'groups' => "team",
				  'fullname' => Auth::$userdata->fname . ' ' . Auth::$userdata->lname,
				  'title' => $safe->name,
				  'is_activity' => 1,
				  'ip' => Url::getIP());
			  Db::run()->insert(Users::aTable, $data);

			  $html = Utility::getSnippets(BASEPATH . 'view/admin/snippets/loadTeam.tpl.php', $data = $this->getAllTeams($safe->name));
			  Message::msgModalReply(Db::run()->affected(), 'success', Lang::$word->TMS_PROCESS, $html);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Company::editTeam()
       *
       * @return
       */
	  public function editTeam()
	  {
		  $rules = array('name' => array('required|string|min_len,3|max_len,100', Lang::$word->TMS_NAME));

		  $filters = array(
			  'name' => 'string',
			  'color' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if (empty(Message::$msgs)) {
			  Db::run()->update(self::tmTable, array('name' => $safe->name, 'color' => $safe->color), array("id" => Filter::$id));
			  Db::run()->delete(self::tuTable, array("team_id" => Filter::$id));

			  if (isset($_POST['uid'])) {
				  foreach ($_POST['uid'] as $uid) {
					  $dataArray[] = array('team_id' => Filter::$id, 'user_id' => $uid);
				  }
				  Db::run()->insertBatch(self::tuTable, $dataArray);
			  }
			  $html = Utility::getSnippets(BASEPATH . 'view/admin/snippets/loadTeam.tpl.php', $data = $this->getAllTeams($safe->name));
			  Message::msgModalReply(Db::run()->affected(), 'success', Lang::$word->TMS_PROCESS, $html);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Company::CompanyNew()
       *
       * @return
       */
      public function CompanyNew()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->template = 'admin/companies.tpl.php';
		  $tpl->title = Lang::$word->CMP_NEW;
		  $tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_5];
		  $tpl->countries = App::Content()->getCountryList();
		  $tpl->jobs = Utility::jSonToArray(App::Core()->job_types);
	  }

      /**
       * Company::CompanyEdit()
       *
       * @return
       */
      public function CompanyEdit($id)
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->CMP_EDIT;
          $tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_5];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Users.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->data = $row;
			  $array1 = App::Core()->job_types ? Utility::jSonToArray(App::Core()->job_types) : array();
			  $array2 = $row->jobtypes ? Utility::jSonToArray($row->jobtypes) : array();
		      $tpl->countries = App::Content()->getCountryList();
		      $tpl->jobs = Project::compareJobTypes($array1, $array2);
              $tpl->template = 'admin/companies.tpl.php';
          }
	  }

      /**
       * Company::CompanyView()
       *
       * @return
       */
      public function CompanyView($id)
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->CMP_INFO;
          $tpl->crumbs = ['admin', Lang::$word->NAV_1, Lang::$word->NAV_5];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Users.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->row = $row;
			  $tpl->jobtypes = Utility::jSonToArray($row->jobtypes);
			  $tpl->members = $this->getUsersByCompany($row->id);
			  $tpl->projects = App::Project()->getProjectsByCompany($row->id);
			  $tpl->invoices = App::Project()->getInvoicesByCompany($row->id);
              $tpl->template = 'admin/companies.tpl.php';
          }
	  }

	  /**
	   * Company::processCompany()
	   *
	   * @return
	   */
	  public function processCompany()
	  {

		  $rules = array('name' => array('required|string|min_len,2|max_len,100', Lang::$word->CMP_NAME));

		  $filters = array(
			  'name' => 'string',
			  'address' => 'string',
			  'city' => 'string',
			  'state' => 'string',
			  'zip' => 'string',
			  'currency' => 'string',
			  'phone' => 'string',
			  'website' => 'string',
			  'note' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if (empty(Message::$msgs)) {
			  $iso = Utility::splitCurrency($safe->currency);
			  $data = array(
				  'name' => $safe->name,
				  'address' => $safe->address,
				  'city' => $safe->city,
				  'state' => $safe->state,
				  'zip' => $safe->zip,
				  'country' => $iso['country'],
				  'currency' => $iso['currency'],
				  'phone' => $safe->phone,
				  'website' => $safe->website,
				  'note' => $safe->note
				  );


	          if(!Filter::$id and Db::run()->first(self::cTable, null, array("owner" => 1))) {
				  $data['owner'] = 1;
			  }
			  if (isset($_POST['hrate']) and isset($_POST['dorates'])) {
				  $json = array();
				  $crates = array_filter($_POST['hrate']);
				  if($crates) {
					  foreach ($crates as $key => $rate) {
						  $json[] = array("name" => $key, "hrate" => $rate);
					  }
					  $data['jobtypes'] = json_encode($json);
				  }
			  }

			  (Filter::$id) ? Db::run()->update(self::cTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cTable, $data)->getLastInsertId();
              $message = Filter::$id ? Lang::$word->CMP_UPDATE_OK : Lang::$word->CMP_ADDED_OK1;

			  if (isset($_POST['nomodal'])) {
				  Message::msgReply(Db::run()->affected(), 'success', $message);
			  } else {
				  $html = '<option value="' . $last_id . '" selected="selected"> ' . $safe->name . ' </option>';
				  Message::msgModalReply($last_id, 'success', str_replace("[NAME]", $safe->name, Lang::$word->CMP_ADDED_OK), $html);
			  }

			  // Add activity
			  if(!Filter::$id) {
				  $acata = array(
					  'uid' => App::Auth()->uid,
					  'fullname' => App::Auth()->name,
					  'type' => "Companies",
					  'groups' => "company",
					  'title' => $safe->name,
					  'company_id' => $last_id,
					  'is_activity' => 1,
					  'ip' => Url::getIP()
					  );
				  Db::run()->insert(Users::aTable, $acata);
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Company::addToTeam()
       *
       * @return
       */
	  public function addToTeam()
	  {

		  Db::run()->delete(self::tuTable, array("user_id" => Filter::$id));

		  if (isset($_POST['teams'])) {
			  foreach ($_POST['teams'] as $id) {
				  $dataArray[] = array('team_id' => $id, 'user_id' => Filter::$id);
			  }
			  Db::run()->insertBatch(self::tuTable, $dataArray);
		  }

		  Message::msgReply(true, 'success', LANG::$word->TMS_PROCESS);
	  }

      /**
       * Company::getAllTeams()
       *
       * @return
       */
      public function getAllTeams($name = false)
      {
          $where = ($name == true) ? 'WHERE t.name = "' . $name . '"' : null;
		  $sql = "SELECT 	t.name,	t.color,	t.id,	m.username,	m.avatar,	m.id AS mid,	CONCAT(m.fname,' ',m.lname) as fullname FROM `" . self::tmTable . "` t
			LEFT JOIN `" . self::tuTable . "` tu  ON tu.team_id = t.id
			LEFT JOIN `" . Users::mTable . "` m  ON m.id = tu.user_id
      $where
		  ORDER BY m.userlevel DESC, t.name;";

		  $query = Db::run()->pdoQuery($sql)->results();

		  $data = array();
		  if ($query) {
			  foreach ($query as $i => $row) {
                  if (!array_key_exists($row->name, $data)) {
					  $data[$row->name]['name'] = $row->name;
					  $data[$row->name]['color'] = $row->color;
					  $data[$row->name]['id'] = $row->id;
                  }

				  $data[$row->name]['members'][$i]['fullname'] = $row->fullname;
				  $data[$row->name]['members'][$i]['avatar'] = $row->avatar;
				  $data[$row->name]['members'][$i]['username'] = $row->username;
				  $data[$row->name]['members'][$i]['user_id'] = $row->mid;
				  $data[$row->name]['usarr'][$i] = $data[$row->name]['members'][$i]['user_id'];
				  $data[$row->name]['usstr'] = implode(",", $data[$row->name]['usarr']);
				  $data[$row->name]['counter'] = count($data[$row->name]['members']);
			  }
		  }

		  return ($query) ? $data : 0;
      }

      /**
       * Company::getCompanies()
       *
       * @return
       */
      public function getCompanies($status = 1, $owner = true)
      {
		  $is_owner = $owner ? array("status" => $status) : array("status" => $status, "owner" => 1);

		  $row = Db::run()->select(self::cTable, null, $is_owner, 'ORDER BY owner DESC, name')->results();
          return ($row) ? $row : 0;

      }

      /**
       * Company::changeCompany()
       *
       * @return
       */
	  public function changeCompany()
	  {

		  $rules = array(
		      `company` => array('required|numeric', Lang::$word->MAC_SUB10),
			  'url' => array('required|string', "Invalid URL"),
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);

		  if (empty(Message::$msgs)) {
			  $data = array(`company` => $safe->company);

			  Db::run()->update(self::tmTable, $data, array('id' => Filter::$id));
			  if (Db::run()->affected()) {
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = LANG::$word->CMP_CHNAGED;
				  $json['redirect'] = Url::url($safe->url);
			  } else {
				  $json['type'] = "alert";
				  $json['title'] = Lang::$word->ALERT;
				  $json['message'] = Lang::$word->NOPROCCESS;
			  }
			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Company::getCompanyHistory()
       *
	   * @param int $id
       * @return
       */
      public function getCompanyHistory($id)
      {

          $row = Db::run()->select(Users::aTable, "*", array("company_id" => $id, "groups" => "history"), "ORDER BY created DESC")->results();

          return ($row) ? $row : 0;

      }

      /**
       * Company::getArchivedCompanies()
       *
       * @return
       */
      public function getArchivedCompanies()
      {
          $sql = "SELECT 	*  FROM `" . self::cTable . "`
		  WHERE status = ?
		  ORDER BY name;";
          $row = Db::run()->pdoQuery($sql, array(3))->results();

          return ($row) ? $row : 0;
      }

      /**
       * Company::getUsersByCompany()
       *
       * @return
       */
      public function getUsersByCompany($cid, $status = 1)
      {

		  $sql = "SELECT *,	CONCAT(fname,' ',lname) as fullname  FROM `". Users::mTable . "`
		  WHERE company = ?
			AND status = ?
		  ORDER BY userlevel DESC, fname;";

		  $row = Db::run()->pdoQuery($sql, array($cid, $status))->results();
          return ($row) ? $row : 0;

      }

      /**
       * Company::addCompanyHistory()
       *
	   * @param int $id
	   * @param string $title
       * @return
       */
      public static function addCompanyHistory($id, $title)
      {

		  $data = array(
			  'company_id' => $id,
			  'uid' => App::Auth()->uid,
			  'type' => "field",
			  'title' => $title,
			  'username' => App::Auth()->username,
			  'fullname' => App::Auth()->name,
			  'groups' => "history"
			  );

		  Db::run()->insert(Users::aTable, $data);

      }
  }
