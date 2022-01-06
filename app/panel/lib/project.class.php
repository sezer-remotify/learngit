<?php

/**
 * Project App
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: app.class.php, v1.00 2019-04-20 18:20:24 gewa Exp $
 */
if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');

class Project
{

    const pTable = 'projects';
    const pxTable = "project_users";
    const plTable = "project_labels";
    const pcTable = "project_categories";
    const psTable = 'projects_skills';
    const pfTable = 'project_files';
    const sTable = 'skills';
    const ivTable = 'invoice';
    const iveTable = 'invoice_entries';
    const ivaTable = 'invoice_access';
    const sbTable = 'subsribers';
    const trTable = 'timerecord';
    const bTable = 'budgets';
    const bidsTable = "bids";
    const bmTable = "bid_milestones";
    const exTable = 'expenses';
    const excTable = 'expenses_categories';
    const pyTable = 'payments';
    const fTable = 'files';
    const ftTable = 'files_temp';
    const nTable = 'notes';
    const jtTable = 'job_types';


    /**
     * Project::__construct()
     *
     * @return
     */
    public function __construct()
    {
    }

    /**
     * Project::Index()
     *
     * @return
     */
    public function Index()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_PROJECTS;
        $tpl->core = App::Core();
        $tpl->data = $this->getProjectsByPermissions();
        $tpl->companies = App::Company()->getCompanies();
        $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
        $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
        $tpl->crumbs = ['admin', Lang::$word->NAV_25];
        $tpl->template = 'admin/projects.tpl.php';
    }

    /**
     * Project::Save()
     *
     * @return
     */
    public function Save()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_TITLE1;
        $tpl->core = App::Core();

        $tpl->companies = App::Company()->getCompanies();
        $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
        $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
        $tpl->jobtypes = Utility::jSonToArray($tpl->core->job_types);
        $tpl->countries = App::Content()->getCountryList();
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_18];
        $tpl->template = 'admin/projects.tpl.php';
    }

    /**
     * Project::Edit()
     *
     * @param int $id
     * @return
     */
    public function Edit($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->CFG_SUB12;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_11];

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->core = App::Core();
            $array1 = $tpl->core->job_types ? Utility::jSonToArray($tpl->core->job_types) : array();
            $array2 = $tpl->row->jobtypes ? Utility::jSonToArray($tpl->row->jobtypes) : array();

            $tpl->companies = App::Company()->getCompanies();
            $tpl->countries = App::Content()->getCountryList();
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->jobtypes = self::compareJobTypes($array1, $array2);
            $tpl->label_selected = Utility::searchForValueName("id", $tpl->row->label_id, "name", $tpl->labels);
            $tpl->category_selected = Utility::searchForValueName("id", $tpl->row->category_id, "name", $tpl->cats);
            $tpl->company_selected = Utility::searchForValueName("id", $tpl->row->company_id, "name", $tpl->companies);
            $tpl->template = 'admin/projects.tpl.php';
        }
    }

    /**
     * Project::processProject()
     *
     * @return
     */
    public function processProject()
    {

        $rules = array(
            'name' => array('required|string', Lang::$word->PRJ_PRJNAME),
        );

        $filters = array(
            'description' => 'string',
            'label' => 'numbers',
            'category' => 'numbers',
            'company' => 'numbers',
        );

        if (isset($_POST['dorates']) and $_POST['dorates'] == 1) {
            $rules['budget'] = array('required|float', Lang::$word->PRJ_BUDGET);
        }

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $data = array(
                'name' => $safe->name,
                'description' => $safe->description,
                'label_id' => $safe->label,
                'category_id' => $safe->category,
                'company_id' => $safe->company,
                'company_name' => $safe->company ? Db::run()->getValueById(Company::cTable, "name", $safe->company) : '',
                'created_by_id' => App::Auth()->uid,
                'created_by_name' => App::Auth()->name
            );

            if (isset($_POST['dorates']) and $_POST['dorates'] == 1) {
                $iso = Utility::splitCurrency($_POST['currency']);
                $data['country'] = $iso['country'];
                $data['currency'] = $iso['currency'];
                $data['budget'] = $safe->budget;

                $hrate = array();
                $crates = array_filter($_POST['hrate']);
                if ($crates) {
                    foreach ($crates as $key => $rate) {
                        $jsonc[] = array("name" => $key, "hrate" => $rate);
                    }
                    $hrate = $jsonc;
                }
                $xhrate = array();
                if (isset($_POST['xhrate'])) {
                    $xrates = array_filter($_POST['xhrate']);
                    if ($xrates) {
                        foreach ($xrates as $key => $xrate) {
                            $jsonx[] = array("name" => $_POST['xname'][$key], "hrate" => $xrate);
                        }
                        $xhrate = $jsonx;
                    }
                }
                $data['jobtypes'] = json_encode(array_merge($hrate, $xhrate));
            }

            if (!Filter::$id) {
                $data['leader_id'] = App::Auth()->uid;
                $data['leader_name'] = App::Auth()->name;
            }

            (Filter::$id) ? Db::run()->update(self::pTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::pTable, $data)->getLastInsertId();

            if (Filter::$id) {
                Message::msgReply(Db::run()->affected(), 'success', Lang::$word->PRJ_UPDATED);
            } else {
                if (Db::run()->affected()) {
                    $json['type'] = "success";
                    $json['title'] = Lang::$word->SUCCESS;
                    $json['message'] = Lang::$word->PRJ_ADDED;
                    $json['redirect'] = Url::url("/admin/projects/invite", $last_id);
                } else {
                    $json['type'] = "alert";
                    $json['title'] = Lang::$word->ALERT;
                    $json['message'] = Lang::$word->NOPROCCESS;
                }
                print json_encode($json);

                $udata = array(
                    'uid' => App::Auth()->uid,
                    'type' => "Projects",
                    'project_id' => $last_id,
                    'groups' => "project",
                    'username' => App::Auth()->name,
                    'title' => $safe->name,
                    'is_activity' => 1,
                    'ip' => Url::getIP()
                );

                Db::run()->insert(Users::aTable, $udata);
                Db::run()->insert(self::pxTable, array("user_id" => Auth::$udata->uid, "project_id" => $last_id));

                $tldata = array(
                    'project_id' => $last_id,
                    'name' => Lang::$word->INBOX,
                    'sorting' => 1
                );
                Db::run()->insert(Task::tlTable, $tldata);

                if (isset($_POST['is_estimate'])) {
                    Db::run()->delete(Content::esTable, array("id" => intval($_POST['eid'])));
                }
            }
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::Tasks()
     *
     * @param int $id
     * @return
     */
    public function Tasks($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->TSK_TITLE1;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_26];

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->core = App::Core();
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->tasklabels = Utility::jSonToArray($tpl->core->tasklabels);
            $tpl->job_types = Utility::jSonToArray($tpl->core->job_types);
            $tpl->stats = Stats::getTaskStatus($id);
            $tpl->tasklists = App::Task()->getTaskLists(1, $id);
            $tpl->taskdata = App::Task()->getAllTasks(1, $id);
            $tpl->assignees = ($tpl->taskdata) ? Utility::groupToLoop($tpl->taskdata, "fullname") : null;
            $tpl->plabels = ($tpl->taskdata) ? Utility::groupToLoop(Utility::jSonMergeToArray($tpl->taskdata, "labels"), "name") : null;
            $tpl->template = 'admin/projects.tpl.php';
        }
    }

    /**
     * Project::Archive()
     *
     * @return
     */
    public function Archive()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_SUB9;
        $tpl->core = App::Core();

        $tpl->data = $this->getProjectsByPermissions(4);
        $tpl->companies = App::Company()->getCompanies();
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_20];
        $tpl->template = 'admin/projects.tpl.php';
    }

    /**
     * Project::Invite()
     *
     * @param int $id
     * @return
     */
    public function Invite($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->MAC_INVPEOPLE;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_4];

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->staffdata = App::Users()->getAllStaff();
            $tpl->clientdata = App::Users()->getAllClients();
            $tpl->teamdata = App::Company()->getAllTeams();
            $tpl->template = 'admin/projects.tpl.php';
        }
    }

    /**
     * Project::Notes()
     *
     * @param int $id
     * @return
     */
    public function Notes($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_TITLE2;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_39];
        $tpl->core = App::Core();

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->data = Db::run()->select(self::nTable, null, array("project_id" => $id))->results();
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->template = 'admin/notes.tpl.php';
        }
    }

    /**
     * Project::NoteView()
     *
     * @param int $pid
     * @param int $id
     * @return
     */
    public function NoteView($pid, $id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_TITLE2;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_39];
        $tpl->core = App::Core();

        if (!$prow = $this->getProjectByPermissions(1, $pid)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } elseif (!$row = Db::run()->first(Project::nTable, null, array('id' => $id, 'project_id' => $pid))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($pid) detected [Project.class.php, ln.:" . __line__ . "]" : Message::msgError(Lang::$word->NOACCESS);
        } else {
            $tpl->crumbs = ['admin', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $pid), Lang::$word->NAV_19];
            $tpl->row = $row;
            $tpl->prow = $prow;
            $tpl->puserdata = $this->getProjectUsers($pid);
            $tpl->noteusers = $this->getSubscribedUsers("note_id", $id);
            $tpl->filedata = $this->getFiles("note_id", $id);
            $tpl->template = 'admin/notes.tpl.php';
        }
    }

    /**
     * Project::NoteEdit()
     *
     * @param int $id
     * @return
     */
    public function NoteEdit($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_TITLE2;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_39];
        $tpl->core = App::Core();

        if (!$row = Db::run()->first(Project::nTable, null, array('id' => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } elseif (!$prow = $this->getProjectByPermissions(1, $row->project_id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($pid) detected [Project.class.php, ln.:" . __line__ . "]" : Message::msgError(Lang::$word->NOACCESS);
        } else {
            $tpl->crumbs = ['admin', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $row->project_id), Lang::$word->NAV_11];
            $tpl->row = $row;
            $tpl->prow = $prow;
            $tpl->filedata = $this->getFiles("note_id", $id);
            $tpl->template = 'admin/notes.tpl.php';
        }
    }

    /**
     * Project::NoteNew()
     *
     * @param int $id
     * @return
     */
    public function NoteNew($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_TITLE2;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_39];
        $tpl->core = App::Core();

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Message::msgError(Lang::$word->NOACCESS);
        } else {
            $tpl->crumbs = ['admin', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $id), Lang::$word->NAV_18];
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->template = 'admin/notes.tpl.php';
        }
    }

    /**
     * Project::TimeRecords()
     *
     * @param int $id
     * @return
     */
    public function TimeRecords($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_SUB5_1;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_40];
        $tpl->core = App::Core();

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->stats = Stats::getProjectTimeRecords($row->id);
            $tpl->total_hours = Utility::decimalToHour(Stats::doArraySum($tpl->stats, "total_hours"));
            $tpl->total_amount = Stats::doArraySum($tpl->stats, "total_amount", false);
            $tpl->sub_total = Stats::doArraySum($tpl->stats, "sub_amount", false);
            $tpl->grand_total = ($row->expenses + $tpl->sub_total);
            $tpl->data = Utility::groupToLoop($this->getProjectTimeRecords($row->id), "trdate");
            $tpl->pheader = Utility::renderTimeRecordHeader();
            $dates = iterator_to_array($tpl->pheader);
            $tpl->results = $this->getProjectTimeRecords($id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
            $tpl->template = 'admin/times.tpl.php';
        }
    }

    /**
     * Project::moveTimeToProject()
     *
     * @return
     */
    public function moveTimeToProject()
    {

        $rules = array(
            'id' => array('required|numeric', "Invalid ID"),
            'cpid' => array('required|numeric', "Invalid Project ID"),
        );


        if (isset($_POST['is_billable']) and empty($_POST['job_id'])) {
            Message::$msgs['is_billable'] = Lang::$word->TSK_BILL_ERR;
        }

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);

        if (empty(Message::$msgs)) {
            if ($row = Db::run()->first(self::trTable, null, array("id" => Filter::$id))) {
                Db::run()->update(self::trTable, array("project_id" => $safe->cpid), array("id" => Filter::$id));
                if ($row->is_billable) {
                    Stats::setExpenseField($safe->cpid);
                    Stats::setExpenseField($row->project_id);
                }
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = str_replace("[NAME]", $row->title, Lang::$word->TMR_INFO1);
                $json['redirect'] = Url::url("/admin/projects/time", $row->project_id);
            } else {
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
                $json['message'] = Lang::$word->TMR_INFO2;
            }
            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::getProjectTimeRecords()
     *
     * @param int $project_id
     * @param int $status
     * @param str $from
     * @param str $to
     * @return
     */
    public function getProjectTimeRecords($project_id, $status = 1, $from = '', $to = '')
    {
        $range = '';
        if ($from and $to) {
            $range .=  "AND tr.created BETWEEN '$from 00:00:00' AND '$to 23:59:59'";
        }

        $permission = '';
        if (App::Auth()->usertype == "staff") {
            $permission = "AND tr.user_id = " . App::Auth()->uid;
        }

        $sql = "SELECT tr.*, DATE(tr.created) as trdate, CONCAT(m.fname,' ',m.lname) as uname, m.username, m.avatar, j.name as jobname FROM	`" . self::trTable . "` AS tr
				LEFT JOIN `" . Users::mTable . "` AS m  ON m.id = tr.user_id
				LEFT JOIN `" . self::jtTable . "` AS j  ON j.id = tr.job_id
			  WHERE tr.project_id = ?
			  AND tr.status = ?
			  $permission
			  $range
			  ORDER BY tr.created DESC;";

        $row = Db::run()->pdoQuery($sql, array($project_id, $status))->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::ExpenseRecords()
     *
     * @param int $id
     * @return
     */
    public function ExpenseRecords($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->EXP_TITLE;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_36];
        $tpl->core = App::Core();

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->stats = Stats::getProjectTimeRecords($row->id);

            $tpl->total_hours = Utility::decimalToHour(Stats::doArraySum($tpl->stats, "total_hours"));
            $tpl->total_amount = Stats::doArraySum($tpl->stats, "total_amount");
            $tpl->sub_total = Stats::doArraySum($tpl->stats, "sub_amount");
            $tpl->grand_total = ($row->expenses + $tpl->sub_total);

            $tpl->data = Utility::groupToLoop($this->getProjectExpenseRecords($row->id), "trdate");
            $tpl->pheader = Utility::renderTimeRecordHeader();
            $dates = iterator_to_array($tpl->pheader);
            $tpl->results = $this->getProjectExpenseRecords($id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
            $tpl->currency = ($tpl->row->currency) ? $tpl->row->currency  : $tpl->core->currency;

            $tpl->template = 'admin/expenses.tpl.php';
        }
    }

    /**
     * Project::getProjectExpenseRecords()
     *
     * @param int $project_id
     * @param int $status
     * @param str $from
     * @param str $to
     * @return
     */
    public function getProjectExpenseRecords($project_id, $status = 1, $from = '', $to = '')
    {
        $range = '';
        if ($from and $to) {
            $range .=  "AND ex.created BETWEEN '$from 00:00:00' AND '$to 23:59:59'";
        }
        $permission = '';
        if (App::Auth()->usertype == "staff") {
            $permission = "AND ex.user_id= " . App::Auth()->uid;
        }
        $sql = "SELECT ex.*, DATE(ex.created) as trdate, CONCAT(m.fname,' ',m.lname) as uname, m.username, m.avatar, exc.name as category FROM `" . self::exTable . "` AS ex
				LEFT JOIN `" . Users::mTable . "` AS m ON m.id = ex.user_id
				LEFT JOIN `" . self::excTable . "` AS exc ON exc.id = ex.category_id
			  WHERE ex.project_id = ?
			  AND ex.status = ?
			  {$permission}
			  {$range}
			  ORDER BY ex.created DESC;";

        $row = Db::run()->pdoQuery($sql, array($project_id, $status))->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::Activity()
     *
     * @param int $id
     * @return
     */
    public function Activity($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_TITLE3;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_41];
        $tpl->core = App::Core();

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->data = Utility::groupToLoop($this->getProjectActivity($id), "cdate");
            $tpl->template = 'admin/projects.tpl.php';
        }
    }

    /**
     * Project::getProjectActivity()
     *
     * @param mixed $project_id
     * @return
     */
    public function getProjectActivity($project_id)
    {

        $row = Db::run()->select(Users::aTable, array("*, DATE(created) as cdate, TIME(created) as hour"), array("project_id" => $project_id), "ORDER BY created DESC")->results();
        return ($row) ? $row : 0;
    }

    /**
     * Project::projectInvite()
     *
     * @return
     */
    public function projectInvite()
    {
        if (empty($_POST['users'])) {
            Message::$msgs['users'] = Lang::$word->PRJ_INV_ERR;
        } else {
            $ausers = array_unique($_POST['users']);
            $users = Utility::implodeFields($ausers);
        }
        if (empty(Message::$msgs)) {
            foreach ($ausers as $k => $uid) {
                Db::run()->delete(self::pxTable, array('user_id' => $uid, 'project_id' => FIlter::$id));
                $datapArray[] = array(
                    'user_id' => $uid,
                    'project_id' => FIlter::$id,
                );
            }
            Db::run()->insertBatch(self::pxTable, $datapArray);
            $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'userInvite'));

            $mailer = Mailer::sendMail();
            $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
            $replacements = array();
            $numSent = 0;
            $failedRecipients = array();
            $core = App::Core();

            $userrow = Db::run()->pdoQuery("SELECT CONCAT(fname,' ',lname) as name, type, email FROM `" . Users::mTable . "` WHERE id IN($users)")->results();

            foreach ($userrow as $cols) {
                $lurl = $cols->type == "staff" ? ADMINURL : SITEURL;
                $replacements[$cols->email] = array(
                    '[LOGO]' => Utility::getLogo(),
                    '[NAME]' => $cols->name,
                    '[SNAME]' => App::Auth()->name,
                    '[PROJECT]' => Validator::sanitize($_POST['project']),
                    '[DATE]' => date('Y'),
                    '[COMPANY]' => $core->company,
                    '[FB]' => $core->social->facebook,
                    '[TW]' => $core->social->twitter,
                    '[LOGINURL]' => $lurl,
                    '[SITEURL]' => SITEURL
                );
            }

            $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
            $mailer->registerPlugin($decorator);

            $message = Swift_Message::newInstance()
                ->setSubject($tpl->subject)
                ->setFrom(array($core->site_email => $core->company))
                ->setBody($tpl->body, 'text/html');

            foreach ($userrow as $row) {
                $message->setTo(array($row->email => $row->name));
                $numSent++;
                $mailer->send($message, $failedRecipients);
            }
            unset($row);

            if ($numSent) {
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = $numSent . ' ' . Lang::$word->MAC_SENDINV_OK;
                $json['redirect'] = Url::url("/admin/projects/view", FIlter::$id);
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
            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::addToProjects()
     *
     * @return
     */
    public function addToProjects($masterUrl = false)
    {

        $rules = array(
            'fullname' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
            'email' => array('required|email', Lang::$word->EMAIL),
        );

        $filters = array('fullname' => 'string',);

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            if (isset($_POST['projects'])) {
                $preProjects = Db::run()->select(self::pxTable, array('project_id'), array("user_id" => Filter::$id))->results();
                Db::run()->delete(self::pxTable, array("user_id" => Filter::$id));
                foreach ($_POST['projects'] as $project) {
                    $dataArray[] = array(
                        'user_id' => Filter::$id,
                        'project_id' => $project,
                    );
                }
                Db::run()->insertBatch(self::pxTable, $dataArray);

                $prevProjects = array_column((array)$preProjects, 'project_id');
                $newProjects = array_diff($_POST['projects'], $prevProjects);

                if (isset($_POST['notify']) && count($newProjects) > 0) {
                    $prname = Db::run()->pdoQuery("SELECT GROUP_CONCAT(name SEPARATOR ' | ') as name FROM `" . self::pTable . "` WHERE id IN(" . Utility::implodeFields($newProjects) . ")")->result();

                    $mailer = Mailer::sendMail();
                    $core = App::Core();
                    $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'projectInvite'));

                    $body = str_replace(array(
                        '[LOGO]',
                        '[DATE]',
                        '[COMPANY]',
                        '[NAME]',
                        '[SNAME]',
                        '[PROJECT]',
                        '[LINK]',
                        '[CEMAIL]',
                        '[FB]',
                        '[TW]',
                        '[SITEURL]'
                    ), array(
                        Utility::getLogo(),
                        date('Y'),
                        $core->company,
                        Validator::sanitize($_POST['fullname']),
                        App::Auth()->name,
                        $prname->name,
                        ($masterUrl) ? Url::url("/master/projects") : Url::url("/admin/projects"),
                        $core->site_email,
                        $core->social->facebook,
                        $core->social->twitter,
                        SITEURL
                    ), $tpl->body);

                    $msg = Swift_Message::newInstance()
                        ->setSubject($tpl->subject)
                        ->setTo(array($safe->email => $safe->fullname))
                        ->setFrom(array($core->site_email => $core->company))
                        ->setBody($body, 'text/html');

                    if ($mailer->send($msg)) {
                        $json['type'] = "success";
                        $json['title'] = Lang::$word->SUCCESS;
                        $json['message'] = Lang::$word->MAC_JOIN_PRE_OK;
                    } else {
                        $json['type'] = "error";
                        $json['title'] = Lang::$word->ERROR;
                        $json['message'] = Lang::$word->SENDERROR;
                    }
                    print json_encode($json);
                } else {
                    Message::msgReply(true, 'success', Lang::$word->MAC_JOIN_PR_OK);
                }
            } else {
                Db::run()->delete(self::pxTable, array("user_id" => Filter::$id));
                Message::msgReply(true, 'success', Lang::$word->MAC_JOIN_PR_OK);
            }
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::getProjects()
     *
     * @param integer $status
     * @return
     */
    public function getProjects($status = 1)
    {

        $row = Db::run()->select(self::pTable, null, array("status" => $status), "ORDER BY created DESC")->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::getProjectsByCompany()
     *
     * @param mixed $cid
     * @param integer $status
     * @return
     */
    public function getProjectsByCompany($cid, $status = 1)
    {

        $row = Db::run()->select(self::pTable, null, array("status" => $status, "company_id" => $cid), "ORDER BY created DESC")->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::getAssignedProjects()
     *
     * @param integer $status
     * @return
     */
    public function getAssignedProjects($status = 1)
    {

        $row = Db::run()->select(self::pTable, "*", array("leader_id" => App::Auth()->uid, "status" => $status), "ORDER BY created DESC")->results();

        return ($row) ? $row : 0;
    }
    /**
     * Project::getClientProjects()
     *
     * @param integer $status
     * @return
     */
    public function getClientProjects($id = 0)
    {
        $others = ' AND p.status = 1';

        if ($id)
            $others .= " AND p.id =?";

        $sql = "SELECT p.* FROM `" . self::pTable . "` AS p
        LEFT JOIN `" . USERS::mTable . "` AS u ON u.id = p.created_by_id
        Where u.userlevel = 20
            {$others};";
        if ($id)
            $row = Db::run()->pdoQuery($sql, array($id))->result();
        else
            $row = Db::run()->pdoQuery($sql, array($id))->results();
        return ($row) ? $row : 0;
    }
    /**
     * Project::getTasksByUser()
     *
     * @param integer $status
     * @return
     */
    public function getTasksByUser($status = 1)
    {

        $sql = "SELECT t.name,	t.created,	t.due_on,	t.is_priority,	t.id,	t.project_id,	t.task_list_id,	t.is_hidden,	p.name as pname FROM `" . Task::tTable . "` t
			LEFT JOIN `" . self::pTable . "` p ON p.id = t.project_id
      WHERE t.assigned_id = ?
		  AND t.status = ?
		  ORDER BY t.sorting, t.created;";

        $query = Db::run()->pdoQuery($sql, array(App::Auth()->uid, $status))->results();
        $data = array();
        if ($query) {
            $pid = null;
            foreach ($query as $i => $row) {
                if ($pid != $row->project_id) {
                    $pid = $row->project_id;
                    $data[$row->project_id]['pname'] = $row->pname;
                    $data[$row->project_id]['pid'] = $row->project_id;
                }
                $data[$row->project_id]['tasks'][$i]['id'] = $row->id;
                $data[$row->project_id]['tasks'][$i]['name'] = $row->name;
                $data[$row->project_id]['tasks'][$i]['created'] = $row->created;
                $data[$row->project_id]['tasks'][$i]['due_on'] = $row->due_on;
                $data[$row->project_id]['tasks'][$i]['is_hidden'] = $row->is_hidden;
                $data[$row->project_id]['tasks'][$i]['task_list_id'] = $row->task_list_id;
                $data[$row->project_id]['tasks'][$i]['is_priority'] = $row->is_priority;
            }
        }
        return ($query) ? $data : 0;
    }

    /**
     * Project::getTimeRecordsByUser()
     *
     * @param int $status
     * @return
     */
    public function getTimeRecordsByUser($status = 1)
    {

        $sql = "SELECT tr.*, DATE(tr.created) as trdate, p.name as pname, j.name as jobname FROM `" . self::trTable . "` AS tr
				LEFT JOIN `" . self::pTable . "` AS p ON p.id = tr.project_id
				LEFT JOIN `" . self::jtTable . "` AS j ON j.id = tr.job_id
			  WHERE tr.user_id = ?
			  AND tr.status = ?
			  ORDER BY tr.created DESC;";

        $query = Db::run()->pdoQuery($sql, array(App::Auth()->uid, $status))->results();
        $data = array();
        if ($query) {
            $pid = null;
            foreach ($query as $i => $row) {
                if ($pid != $row->project_id) {
                    $pid = $row->project_id;
                    $data[$row->project_id]['pname'] = $row->pname;
                    $data[$row->project_id]['pid'] = $row->project_id;
                }
                $data[$row->project_id]['times'][$i]['id'] = $row->id;
                $data[$row->project_id]['times'][$i]['title'] = $row->title;
                $data[$row->project_id]['times'][$i]['created'] = $row->created;
                $data[$row->project_id]['times'][$i]['description'] = $row->description;
                $data[$row->project_id]['times'][$i]['hours'] = $row->hours;
                $data[$row->project_id]['times'][$i]['amount'] = $row->amount;
                $data[$row->project_id]['times'][$i]['job_id'] = $row->job_id;
                $data[$row->project_id]['times'][$i]['jobname'] = $row->jobname;
                $data[$row->project_id]['times'][$i]['is_billable'] = $row->is_billable;
            }
        }
        return ($query) ? $data : 0;
    }

    /**
     * Project::getExpensesByUser()
     *
     * @param int $task_id
     * @param int $status
     * @return
     */
    public function getExpensesByUser($status = 1)
    {

        $sql = "SELECT ex.*, DATE(ex.created) as exdate, p.name as pname, p.currency, c.name as catname FROM `" . self::exTable . "` AS ex
				LEFT JOIN `" . self::pTable . "` AS p ON p.id = ex.project_id
				LEFT JOIN `" . self::excTable . "` AS c ON c.id = ex.category_id
			  WHERE ex.user_id = ?
			  AND ex.status = ?
			  ORDER BY ex.created DESC;";

        $query = Db::run()->pdoQuery($sql, array(App::Auth()->uid, $status))->results();
        $data = array();
        if ($query) {
            $pid = null;
            foreach ($query as $i => $row) {
                if ($pid != $row->project_id) {
                    $pid = $row->project_id;
                    $data[$row->project_id]['pname'] = $row->pname;
                    $data[$row->project_id]['pid'] = $row->project_id;
                }
                $data[$row->project_id]['exp'][$i]['id'] = $row->id;
                $data[$row->project_id]['exp'][$i]['title'] = $row->title;
                $data[$row->project_id]['exp'][$i]['created'] = $row->created;
                $data[$row->project_id]['exp'][$i]['description'] = $row->description;
                $data[$row->project_id]['exp'][$i]['amount'] = $row->amount;
                $data[$row->project_id]['exp'][$i]['category_id'] = $row->category_id;
                $data[$row->project_id]['exp'][$i]['catname'] = $row->catname;
                $data[$row->project_id]['exp'][$i]['is_billable'] = $row->is_billable;
                $data[$row->project_id]['exp'][$i]['currency'] = $row->currency;
            }
        }
        return ($query) ? $data : 0;
    }

    /**
     * Project::getProjectsByPermissions()
     *
     * @param integer $status
     * @return
     */
    public static function getProjectsByPermissions($status = 1, $not_in = '')
    {

        $and = null;
        $parts = parse_url($_SERVER['REQUEST_URI']);
        isset($parts['query']) ? parse_str($parts['query'], $qs) : $qs = array();

        $required = array(
            "company" => 0,
            "label" => 1,
            "category" => 2,
            "type" => '',
            "project" => '',
        );

        if (array_intersect_key($qs, $required)) {
            if (Validator::notEmptyGet('company') and $company = Validator::sanitize($_GET['company'], "int", 11)) {
                $and .= " AND p.company_id = {$company}";
            }
            if (Validator::notEmptyGet('label') and $label = Validator::sanitize($_GET['label'], "int", 11)) {
                $and .= " AND p.label_id = {$label}";
            }
            if (Validator::notEmptyGet('category') and $category = Validator::sanitize($_GET['category'], "int", 11)) {
                $and .= " AND p.category_id = {$category}";
            }
            if (Validator::notEmptyGet('type') and $category = Validator::sanitize($_GET['type'], "string", 11)) {
                $and .= " AND p.work_type = '{$category}' ";
            }
            if (Validator::notEmptyGet('project') and $category = Validator::sanitize($_GET['project'], "string", 11)) {
                $and .= " AND p.project_type = '{$category}' ";
            }
        }

        $nid = '';
        if ($not_in) {
            $nid = "AND id != " . intval($not_in);
        }

        if (App::Auth()->usertype == "owner") {
            $sql = "SELECT p.* FROM	`" . self::pTable . "` AS p
            INNER JOIN `" . Users::mTable . "` AS u
					  ON p.created_by_id = u.id
				    WHERE p.status = ?
            {$and}
            {$nid}
            ORDER BY p.created DESC;";

            $row = Db::run()->pdoQuery($sql, array($status))->results();
        } else {
            $sql = "SELECT p.* FROM	`" . self::pTable . "` AS p
					INNER JOIN `" . self::pxTable . "` AS pu ON p.id = pu.project_id
				  WHERE p.status = ?
				  AND pu.user_id = ?
				  {$nid}
				  {$and}
				  ORDER BY p.created DESC;";


            $row = Db::run()->pdoQuery($sql, array($status, App::Auth()->uid))->results();
        }

        return ($row) ? $row : 0;
    }

    /**
     * Project::getSubscribedUsers()
     *
     * @param type $type
     * @param integer $tid
     * @return
     */
    public function getSubscribedUsers($type, $id)
    {
        $row = Db::run()->select(self::sbTable, array("GROUP_CONCAT(user_id) as uid"), array($type => $id), 'GROUP BY ' . $type)->result();

        return ($row) ? $row : 0;
    }

    /**
     * Project::Invoices()
     *
     * @return
     */
    public function Invoices()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_INVOICES;
        $tpl->data = Utility::groupToLoop($this->getInvoicesByGroup(), "pstatus");
        $tpl->crumbs = ['admin', Lang::$word->NAV_17];
        $tpl->template = 'admin/invoices.tpl.php';
    }

    /**
     * Project::InvoiceView()
     *
     * @param int $id
     * @return
     */
    public function InvoiceView($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_INVOICES;
        $tpl->crumbs = ['admin', Lang::$word->NAV_17, Lang::$word->NAV_19];

        if (!$row = Db::run()->first(self::ivTable, null, array("id" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = $this->getInvoiceEntries($row->id);
            $tpl->taxes = App::Content()->getTaxes();
            $tpl->company = Db::run()->first(Company::cTable, null, array('owner' => 1));
            $tpl->payments = $row->pstatus ? $this->getInvoicePayments($row->id) : null;
            $tpl->template = 'admin/invoices.tpl.php';
        }
    }

    /**
     * Project::InvoicesNew()
     *
     * @return
     */
    public function InvoicesNew()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_TITLE1;
        $tpl->taxes = App::Content()->getTaxes();
        $tpl->companies = Utility::loopOptions(App::Company()->getCompanies(1, 1), "id", "name");
        $tpl->countries = App::Content()->getCountryList();
        $tpl->projects = $this->getProjects();
        $tpl->crumbs = ['admin', Lang::$word->NAV_17, Lang::$word->NAV_18];
        $tpl->template = 'admin/invoices.tpl.php';
    }

    /**
     * Project::InvoiceEdit()
     *
     * @return
     */
    public function InvoiceEdit($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_INVOICES;
        $tpl->crumbs = ['admin', Lang::$word->NAV_17, Lang::$word->NAV_11];

        if (!$row = Db::run()->first(self::ivTable, null, array("id" => $id, "recurring" => 0))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = $this->getInvoiceEntries($row->id);;
            $tpl->taxes = App::Content()->getTaxes();
            $tpl->companies = Utility::loopOptions(App::Company()->getCompanies(1, 1), "id", "name", $row->company_id);
            $tpl->countries = App::Content()->getCountryList();
            $tpl->template = 'admin/invoices.tpl.php';
        }
    }

    /**
     * Project::InvoicesCanceled()
     *
     * @return
     */
    public function InvoicesCanceled()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_TITLE6;
        $tpl->crumbs = ['admin', Lang::$word->NAV_17, Lang::$word->NAV_20];
        $tpl->data = $this->getCanceledInvoices();
        $tpl->template = 'admin/invoices.tpl.php';
    }

    /**
     * Project::InvoicesProject()
     *
     * @param int $id
     * @return
     */
    public function InvoicesProject($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_TITLE1;
        $tpl->crumbs = ['admin', Lang::$word->NAV_17, Lang::$word->NAV_24];

        if (!$row = Db::run()->first(self::pTable, null, array("id" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->taxes = App::Content()->getTaxes();
            $tpl->companies = Utility::loopOptions(App::Company()->getCompanies(1, 1), "id", "name", $row->company_id);
            $tpl->countries = App::Content()->getCountryList();
            $tpl->company = Db::run()->first(Company::cTable, null, array('id' => $tpl->row->company_id));
            $tpl->projects = $this->getProjects();
            $tpl->template = 'admin/invoices.tpl.php';
        }
    }

    /**
     * Project::processInvoice()
     *
     * @return
     */
    public function processInvoice()
    {

        $rules = array(
            'company_id' => array('required|numeric', Lang::$word->INV_CLCMP),
            'company_address' => array('required|string', Lang::$word->ADDRESS),
            'currency' => array('required|string', Lang::$word->CFG_SCURRENCY_S),
            'due_date' => array('required|date', Lang::$word->INV_DUEON),
            'taxes' => array('required|numeric', Lang::$word->TAXES),
            'subtotal' => array('required|numeric', Lang::$word->SUBTOTAL),
            'total_amount' => array('required|numeric', Lang::$word->TOTALAMT),
        );

        if (isset($_POST['is_recurring'])) {
            $rules['recurring_t'] = array('required|numeric|min_len,1|max_len,3', Lang::$word->INV_REC_T);
            $rules['recurring_p'] = array('required|string|min_len,1|max_len,5', Lang::$word->INV_REC_P);
            $rules['title'] = array('required|string|min_len,3|max_len,30', Lang::$word->INV_REC_NAME);
        }

        if (!empty($_POST['custom_id'])) {
            $rules['custom_id'] = array('required|numeric|min_len,1|max_len,8', Lang::$word->INV_INVOICE);
        }

        $filters = array(
            'reference' => 'string',
            'created_submit' => 'trim|string',
            'custom_id' => 'string',
            'note' => 'string',
            'company_address' => 'string',
            'comment' => 'string',
            'discount' => 'numbers',
        );


        if (!array_key_exists('item', $_POST)) {
            Message::$msgs['item'] = LANG::$word->PRJ_DESC;
        }

        if (array_key_exists('item', $_POST)) {
            if (!array_filter($_POST['item'])) {
                Message::$msgs['item'] = LANG::$word->PRJ_DESC;
            }

            if (!array_filter($_POST['price'])) {
                Message::$msgs['price'] = LANG::$word->INV_ITEMCST;
            }
        }

        (Filter::$id) ? $this->_updateInvoice($rules, $filters) : $this->_addInvoice($rules, $filters);
    }

    /**
     * Project::_updateInvoice()
     *
     * @param array $rules
     * @param array $filters
     * @return
     */
    private function _updateInvoice($rules, $filters)
    {

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $iso = explode(",", $safe->currency);
            $data = array(
                'company_id' => $safe->company_id,
                'company_name' => Db::run()->getValueById(Company::cTable, "name", $safe->company_id),
                'company_address' => $safe->company_address,
                'currency' => $iso[0],
                'country' => $iso[1],
                'issued_by' => App::Auth()->uid,
                'custom_id' => $safe->custom_id,
                'created' => Db::toDate($safe->created_submit, false),
                'discount' => $safe->discount,
                'due_date' => !empty($_POST['due_date']) ? Db::toDate($_POST['due_date'], false) : Db::toDate($safe->due_date, false),
                'reference' => $safe->reference,
                'subtotal' => $safe->subtotal,
                'tax' => $safe->taxes,
                'total' => $safe->total_amount,
                'balance_due' => $safe->total_amount,
                'comment' => $safe->comment,
                'note' => $safe->note,
            );

            Db::run()->update(self::ivTable, $data, array("id" => Filter::$id));
            $result = Db::run()->delete(self::iveTable, array("invoice_id" => Filter::$id));

            foreach ($_POST['item'] as $i => $row) {
                $tax = ($_POST['taxes'][$i]) ? Db::run()->first(Content::taxTable, null, array("id" => $_POST['taxes'][$i])) : 0;
                $dataArray[] = array(
                    'invoice_id' => Filter::$id,
                    'amount' => $_POST['price'][$i],
                    'quantity' => $_POST['quantity'][$i],
                    'tax_id' => $tax ? $tax->id : 0,
                    'tax_amount' => $tax ? $tax->amount : 0,
                    'tax_name' => $tax ? $tax->name : "",
                    'description' => $row
                );
            }
            Db::run()->insertBatch(self::iveTable, $dataArray);
            Project::addInvoiceAccess(Filter::$id);
            Message::msgReply($result, 'success', Lang::$word->INV_UPDATED);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::_addInvoice()
     *
     * @param array $rules
     * @param array $filters
     * @return
     */
    private function _addInvoice($rules, $filters)
    {
        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $iso = explode(",", $safe->currency);
            $data = array(
                'company_id' => $safe->company_id,
                'company_name' => Db::run()->getValueById(Company::cTable, "name", $safe->company_id),
                'company_address' => $safe->company_address,
                'currency' => $iso[0],
                'country' => $iso[1],
                'issued_by' => App::Auth()->uid,
                'custom_id' => $safe->custom_id,
                'created' => Db::toDate($safe->created_submit, false),
                'discount' => $_POST['discount'],
                'due_date' => !empty($_POST['due_date']) ? Db::toDate($_POST['due_date'], false) : Db::toDate($safe->due_date, false),
                'reference' => $safe->reference,
                'title' => isset($_POST['is_recurring']) ? $safe->title : "",
                'recurring' => isset($_POST['is_recurring']) ? 1 : 0,
                'recurring_p' => isset($_POST['is_recurring']) ? $safe->recurring_p : "",
                'recurring_t' => isset($_POST['is_recurring']) ? $safe->recurring_t : 0,
                'subtotal' => $safe->subtotal,
                'tax' => $safe->taxes,
                'total' => $safe->total_amount,
                'balance_due' => $safe->total_amount,
                'comment' => $safe->comment,
                'note' => $safe->note,
            );

            if (isset($_POST['is_recurring'])) {
                $data['due_date'] = Utility::NumberOfDays('+ ' . $safe->recurring_t . ' ' . $safe->recurring_p);
            }
            $last_id = Db::run()->insert(self::ivTable, $data)->getLastInsertId();

            foreach ($_POST['item'] as $i => $row) {
                $tax = ($_POST['taxes'][$i]) ? Db::run()->first(Content::taxTable, null, array("id" => $_POST['taxes'][$i])) : 0;
                $dataArray[] = array(
                    'invoice_id' => $last_id,
                    'amount' => $_POST['price'][$i],
                    'quantity' => $_POST['quantity'][$i],
                    'tax_id' => $tax ? $tax->id : 0,
                    'tax_amount' => $tax ? $tax->amount : 0,
                    'tax_name' => $tax ? $tax->name : "",
                    'description' => $row
                );

                if (isset($_POST['is_timerecord'][$i])) {
                    Db::run()->update(self::trTable, array('invoiced' => 1), array("id" => $_POST['is_timerecord'][$i]));
                }

                if (isset($_POST['is_expense'][$i])) {
                    Db::run()->update(self::exTable, array('invoiced' => 1), array("id" => $_POST['is_expense'][$i]));
                }
            }
            Db::run()->insertBatch(self::iveTable, $dataArray);
            if (isset($_POST['is_estimate'])) {
                Db::run()->delete(Content::esTable, array("id" => intval($_POST['eid'])));
            }
            if ($last_id) {
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->INV_ADDED;
                $json['redirect'] = Url::url("/admin/invoices/view", $last_id);
            } else {
                $json['type'] = "alert";
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            }
            print json_encode($json);

            $acata = array(
                'uid' => App::Auth()->uid,
                'type' => "Invoices",
                'groups' => "invoice",
                'title' => $data['company_name'],
                'invoice_id' => $last_id,
                'is_activity' => 1,
                'ip' => Url::getIP()
            );
            Db::run()->insert(Users::aTable, $acata);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::getInvoicePayments()
     *
     * @param mixed $invoice_id
     * @return
     */
    public function getInvoicePayments($invoice_id)
    {

        $row = Db::run()->select(self::pyTable, null, array("invoice_id" => $invoice_id))->results();
        return ($row) ? $row : 0;
    }

    /**
     * Project::getInvoicesByGroup()
     *
     * @return
     */
    public function getInvoicesByGroup()
    {
        $sql = "SELECT iv.* FROM	`" . self::ivTable . "` AS iv
				WHERE iv.status BETWEEN 0 AND 1
				AND iv.recurring = 0
				ORDER BY iv.created DESC;";

        $row = Db::run()->pdoQuery($sql)->results();
        return ($row) ? $row : 0;
    }

    /**
     * Project::getPaidInvoices()
     *
     * @return
     */
    public function getPaidInvoices()
    {
        $sql = "SELECT	iv.* FROM	`" . self::ivTable . "` AS iv
				WHERE iv.status = 2
				AND iv.pstatus = 2
				ORDER BY iv.created DESC;";

        $row = Db::run()->pdoQuery($sql)->results();
        return ($row) ? $row : 0;
    }

    /**
     * Project::getCanceledInvoices()
     *
     * @return
     */
    public function getCanceledInvoices()
    {
        $sql = "SELECT	iv.* FROM	`" . self::ivTable . "` AS iv
				WHERE iv.status = 2
				ORDER BY iv.created DESC;";

        $row = Db::run()->pdoQuery($sql)->results();
        return ($row) ? $row : 0;
    }

    /**
     * Project::getInvoicesByCompany()
     *
     * @param mixed $cid
     * @return
     */
    public function getInvoicesByCompany($cid)
    {
        $sql = "SELECT iv.* FROM	`" . self::ivTable . "` AS iv
			  WHERE iv.company_id = ?
			  AND iv.status <> 2
			  ORDER BY iv.created DESC;";

        $row = Db::run()->pdoQuery($sql, array($cid))->results();
        return ($row) ? $row : 0;
    }

    /**
     * Project::invoiceMarkSent()
     *
     * @return
     */
    public function invoiceMarkSent()
    {
        $rules = array('id' => array('required|numeric|min_len,1|max_len,11', "Invalid ID"));

        $filters = array(
            'tlp' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            Db::run()->update(self::ivTable, array('status' => 1), array("id" => Filter::$id));
            $row = Db::run()->first(self::ivTable, null, array("id" => Filter::$id));

            $html = Utility::getSnippets(ADMINBASE . "/snippets/" . $safe->tpl . '.tpl.php', $data = $row);
            Message::msgModalReply(Db::run()->affected(), 'success', Lang::$word->INV_MASEND_OK, $html);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::invoiceReminder()
     *
     * @return
     */
    public function invoiceReminder()
    {

        $filters = array(
            'reminder' => 'numbers',
        );

        $validate = Validator::instance();
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            Db::run()->update(self::ivTable, array('reminder' => $safe->reminder), array("id" => Filter::$id));
            $row = Db::run()->first(self::ivTable, null, array("id" => Filter::$id));

            $html = Utility::getSnippets(ADMINBASE . "/snippets/loadIvReminder.tpl.php", $data = $row);
            Message::msgModalReply(Db::run()->affected(), 'success', Lang::$word->INV_REM_OK, $html);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::sendInvoice()
     *
     * @return
     */
    public function sendInvoice()
    {

        $rules = array(
            'recepients' => array('required|string', Lang::$word->INV_SELREC),
        );

        $filters = array(
            'message' => 'string',
            'tpl' => 'string'
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $numSent = 0;
            $failedRecipients = array();
            $core = App::Core();

            $mailer = Mailer::sendMail();
            $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
            $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'invoiceMessage'));

            $recepients = Validator::sanitize($_POST['recepients']);
            $userrow = Db::run()->pdoQuery("SELECT email, CONCAT(fname,' ',lname) as name FROM `" . Users::mTable . "` WHERE id IN($recepients)")->results();

            $replacements = array();
            if ($userrow) {
                $row = Db::run()->first(self::ivTable, null, array("id" => Filter::$id));
                $title = "invoice-" . Content::invoiceID($row->id, $row->custom_id) . "-from_" . $core->company;

                ob_start();
                require_once(ADMINBASE . '/snippets/Pdf_Invoice.tpl.php');
                $pdf_html = ob_get_contents();
                ob_end_clean();

                require_once(BASEPATH . 'lib/mPdf/vendor/autoload.php');
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $core->pagesize]);
                $mpdf->SetTitle($title);
                $mpdf->WriteHTML($pdf_html);
                $pdf_content = $mpdf->Output($title . ".pdf", "S");

                foreach ($userrow as $cols) {
                    $replacements[$cols->email] = array(
                        '[COMPANY]' => $core->company,
                        '[LOGO]' => Utility::getLogo(),
                        '[NAME]' => $cols->name,
                        '[INVID]' => Content::invoiceID($row->id, $row->custom_id),
                        '[CLIENT]' => $row->company_name,
                        '[AMOUNT]' => Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency),
                        '[DUEDATE]' => Date::doDate("short_date", $row->due_date),
                        '[MESSAGE]' => $safe->message,
                        '[CEMAIL]' => $core->site_email,
                        '[FB]' => $core->social->facebook,
                        '[TW]' => $core->social->twitter,
                        '[SITEURL]' => SITEURL,
                        '[DATE]' => date('Y')
                    );
                }

                $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                $mailer->registerPlugin($decorator);

                $message = Swift_Message::newInstance()
                    ->setSubject(str_replace("[COMPANY]", $core->company, $tpl->subject))
                    ->setFrom(array($core->site_email => $core->company))
                    ->setBody($tpl->body, 'text/html')
                    ->attach(Swift_Attachment::newInstance($pdf_content, $title . '.pdf', 'application/pdf'));

                foreach ($userrow as $usr) {
                    $message->setTo(array($usr->email => $usr->name));
                    $numSent++;
                    $mailer->send($message, $failedRecipients);
                }
                unset($row);
            }

            if ($numSent) {
                Db::run()->update(self::ivTable, array("status" => 1, "sent_on" => Db::toDate()), array("id" => Filter::$id));
                $row = Db::run()->first(self::ivTable, null, array("id" => Filter::$id));

                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = $numSent . ' ' . Lang::$word->EMN_SENT;
                $json['html'] = Utility::getSnippets(ADMINBASE . "/snippets/" . $safe->tpl . '.tpl.php', $data = $row);
            } else {
                $json['type'] = 'error';
                $json['title'] = Lang::$word->ERROR;
                $res = '';
                $res .= '<ul>';
                foreach ($failedRecipients as $failed) {
                    $res .= '<li>' . $failed . '</li>';
                }
                $res .= '</ul>';
                $json['message'] = Lang::$word->EMN_ALERT . $res;

                unset($failed);
            }

            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::invoiceAddPayment()
     *
     * @return
     */
    public function invoiceAddPayment()
    {

        $rules = array(
            'paydate_submit' => array('required|date', Lang::$word->INV_PAYDATE),
            'amount' => array('required|numeric', Lang::$word->INV_AMOUNT),
            'id' => array('required|numeric', "ID"),
        );

        $filters = array(
            'paydate' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $row = Db::run()->first(self::ivTable, null, array("id" => Filter::$id));
            $pdata = array(
                'txn_id' => "MAN_" . Utility::randNumbers(),
                'invoice_id' => $row->id,
                'company_id' => $row->company_id,
                'user_id' => App::Auth()->uid,
                'user' => App::Auth()->name,
                'amount' => $safe->amount,
                'tax' => $row->tax,
                'discount' => $row->discount,
                'currency' => $row->currency,
                'pp' => Lang::$word->CUSTOM,
                'created' => Db::toDate($safe->paydate_submit, date('H:i:s')),
                'ip' => Url::getIP()
            );

            $last_id = Db::run()->insert(self::pyTable, $pdata)->getLastInsertId();
            $sum = Db::run()->pdoQuery("SELECT COALESCE(SUM(amount), 0) as total FROM " . self::pyTable . " WHERE invoice_id = " . $row->id)->result();

            $data = array('paid_amount' => $sum->total, 'pstatus' => (Validator::compareNumbers($sum->total, $row->balance_due, "gte") ? 2 : ($sum->total == 0 ? 0 : 1)));
            Db::run()->update(self::ivTable, $data, array("id" => $row->id));

            $json['message'] = Lang::$word->INV_PAY_OK;
            $json['title'] = Lang::$word->SUCCESS;
            $json['type'] = "success";
            $json['redirect'] = SITEURL . '/' . $_POST['url'];
            print json_encode($json);
            Project::addInvoiceAccess($row->id);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::getInvoiceEntries()
     *
     * @param mixed $invoice_id
     * @return
     */
    public function getInvoiceEntries($invoice_id)
    {

        $row = Db::run()->select(self::iveTable, null, array("invoice_id" => $invoice_id))->results();
        return ($row) ? $row : 0;
    }

    /**
     * Project::addInvoiceAccess()
     *
     * @param mixed $id
     * @return
     */
    public static function addInvoiceAccess($id)
    {

        $data = array(
            'invoice_id' => $id,
            'user' => App::Auth()->name,
            'ip' => Url::getIP()
        );

        Db::run()->insert(self::ivaTable, $data);
    }

    /**
     * Project::getInvoiceAccess()
     *
     * @return
     */
    public function getInvoiceAccess()
    {
        $sql = "SELECT *,	DATE(created) AS day, TIME(created) AS hour FROM `" . Project::ivaTable . "`
		  WHERE invoice_id = ?
		  ORDER BY created DESC
		  LIMIT 0, 30;";

        $row = Db::run()->pdoQuery($sql, array(Filter::$id))->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::Files()
     *
     * @param int $id
     * @return
     */
    public function Files($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->FMG_TITLE;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_38];
        $tpl->core = App::Core();

        if (!$row = $this->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = $this->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->result = $this->getFilesByProject($row->id);
            $tpl->data = Utility::groupToLoop($tpl->result, "fdate");
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->template = 'admin/files.tpl.php';
        }
    }

    /**
     * Project::getFiles()
     *
     * @param mixed $type
     * @param int $id
     * @return
     */
    public function getFiles($type, $id)
    {

        $row = Db::run()->select(self::fTable, "*", array($type => $id), "ORDER BY created DESC")->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::getFilesByProject()
     *
     * @param int $id
     * @param bool $hidden
     * @return
     */
    public function getFilesByProject($id, $hidden = true)
    {
        $permission = '';
        if (App::Auth()->usertype == "staff") {
            $permission = "AND f.created_by_id = " . App::Auth()->uid;
        }

        $is_hidden = ($hidden == false) ? 'AND f.is_hidden = 0' : null;

        $sql = "SELECT f.*, DATE(f.created) as fdate, c.name as commentname, n.name as notename, t.name as taskname,u.username, c.is_hidden as chidden, t.is_hidden as thidden, n.is_hidden as nhidden FROM `" . self::fTable . "` AS f
				LEFT JOIN `" . Task::tTable . "` AS t ON t.id = f.task_id
				LEFT JOIN `" . Comments::mTable . "` AS c ON c.id = f.comment_id
				LEFT JOIN `" . self::nTable . "` AS n ON n.id = f.note_id
        LEFT JOIN `" . Users::mTable . "` AS u ON u.id = f.created_by_id
			  WHERE f.project_id = ?
			  {$permission}
			  {$is_hidden}
			  ORDER BY f.created DESC;";

        $row = Db::run()->pdoQuery($sql, array($id))->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::tempProjectFiles()
     *
     * @return
     */
    public function tempProjectFiles($front = false)
    {

        $rules = array(
            'id' => array('required|numeric', "Invalid Project ID"),
        );
        /*
		  $filters = array(
			  'tlp' => 'string',
			  );
*/
        if (!array_filter($_POST['files'])) {
            Message::$msgs['files'] = LANG::$word->FU_ERROR14;
        }

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        //$safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            if ($result = Db::run()->select(self::ftTable, null, array("project_id" => $safe->id, 'parent' => 'project'), " AND name IN(" . Utility::implodeFields($_POST['files'], ',', true) . ");")->results()) {
                foreach ($result as $row) {
                    $dataArray[] = array(
                        'caption' => $row->caption,
                        'parent' => "project",
                        'project_id' => $safe->id,
                        'name' => $row->name,
                        'fsize' => $row->fsize,
                        'fext' => $row->fext,
                        'mime' => $row->mime,
                        'created_by_id' => $row->created_by_id,
                        'created_by_name' => $row->created_by_name
                    );

                    $adataArray[] = array(
                        'project_id' => $safe->id,
                        'uid' => App::Auth()->uid,
                        'type' => "Files",
                        'title' => $row->caption,
                        'comment' => $row->name,
                        'username' => App::Auth()->username,
                        'fullname' => App::Auth()->name,
                        'groups' => "file",
                        'ip' => Url::getIP(),
                        'is_activity' => 1
                    );
                }
                Db::run()->insertBatch(self::fTable, $dataArray);
                Db::run()->insertBatch(Users::aTable, $adataArray);
                Db::run()->delete(self::ftTable, array("project_id" => $safe->id));
            }
            //$is_front = ($front == true) ? FRONTBASE : ADMINBASE ;

            //$sql = "SELECT * FROM `" . self::fTable . "` WHERE parent = ? AND project_id = ? AND name IN(" . Utility::implodeFields($_POST['files'],',', true) . ");";
            //$rows = Db::run()->pdoQuery($sql, array("project", $safe->id))->results();
            $json['type'] = "success";
            $json['title'] = Lang::$word->SUCCESS;
            //$json['html'] = Utility::getSnippets(ADMINBASE . '/snippets/' . $safe->tpl . '.tpl.php', $data = $rows);
            $json['message'] = Lang::$word->NOPROCCESS;

            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::processTimeRecord()
     *
     * @return
     */
    public function processTimeRecord()
    {

        $rules = array(
            'title' => array('required|string|min_len,3|max_len,100', Lang::$word->TITLE),
            'hours' => array('required|float', Lang::$word->_HOURS),
            'task_id' => array('required|numeric', "Invalid Task ID"),
            'project_id' => array('required|numeric', Lang::$word->PRJ_INVALID_ID),
        );

        $filters = array(
            'job_id' => 'numbers',
            'description' => 'string',
            'taskname' => 'string',
        );

        if (isset($_POST['is_billable']) and empty($_POST['job_id'])) {
            Message::$msgs['is_billable'] = Lang::$word->TSK_BILL_ERR;
        }

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);


        if (empty(Message::$msgs)) {
            $amount = isset($_POST['is_billable']) ? Utility::searchForValueName('id', $safe->job_id, 'hrate', Utility::jSonToArray(App::Core()->job_types)) : 0;
            $data = array(
                'title' => $safe->title,
                'description' => $safe->description,
                'project_id' => $safe->project_id,
                'user_id' => empty($_POST['user_id']) ? App::Auth()->uid : intval($_POST['user_id']),
                'task_id' => $safe->task_id,
                'job_id' => $safe->job_id,
                'hours' => $safe->hours,
                'created' => isset($_POST['created']) ? Db::toDate($_POST['created']) : Db::toDate(),
                'amount' => number_format($amount, 2),
                'is_billable' => isset($_POST['is_billable']) ? 1 : 0
            );

            if (Filter::$id) {
                $data['updated'] = Db::toDate();
            }
            (Filter::$id) ? Db::run()->update(self::trTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::trTable, $data)->getLastInsertId();
            $message = Filter::$id ? Lang::$word->TMR_UPDATE_OK : Lang::$word->TMR_ADDED_OK;

            if (isset($_POST['is_modal'])) {
                $timerecords = Utility::groupToLoop(App::Task()->getTaskTimeRecords($safe->task_id), "trdate");
                $html = Utility::getSnippets(
                    ADMINBASE . '/snippets/' . $_POST['tpl'] . '.tpl.php',
                    $data = array('data' => $timerecords, 'row' => array('task_id' => $safe->task_id, 'taskname' => $safe->taskname))
                );
            }

            if (Db::run()->affected()) {
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;

                if (isset($_POST['is_modal'])) {
                    $h = Db::run()->first(Project::trTable, array("COALESCE(SUM(hours), 0) as hours"), array("task_id" => $safe->task_id));
                    $json['html'] = $html;
                    $json['hours'] = Utility::decimalToHour($h->hours);
                }

                $json['message'] = $message;
                if (isset($_POST['not_modal'])) {
                    $json['redirect'] = $_POST['return'];
                }
            } else {
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                if (isset($_POST['is_modal'])) {
                    $json['html'] = $html;
                }
                $json['message'] = Lang::$word->NOPROCCESS;
            }

            print json_encode($json);

            //Update Expense field
            Stats::setExpenseField($safe->project_id);

            //Add Acctivity
            if (!Filter::$id) {
                $time = Utility::decimalToReadableHour($safe->hours);
                $adata = array(
                    'company_id' => 0,
                    'project_id' => $safe->project_id,
                    'invoice_id' => 0,
                    'note_id' => 0,
                    'task_id' => $safe->task_id,
                    'uid' => App::Auth()->uid,
                    'type' => "Times",
                    'title' => $safe->title,
                    'comment' => $last_id,
                    'groups' => "time",
                    'ip' => Url::getIP(),
                    'is_activity' => 1,
                );
                Users::addSmallActivity($adata);
            }
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::processExpenseRecord()
     *
     * @return
     */
    public function processExpenseRecord()
    {

        $rules = array(
            'title' => array('required|string|min_len,3|max_len,100', Lang::$word->TITLE),
            'amount' => array('required|float', Lang::$word->INV_AMOUNT),
            'task_id' => array('required|numeric', "Invalid Task ID"),
            'project_id' => array('required|numeric', Lang::$word->PRJ_INVALID_ID),
        );

        $filters = array(
            'category_id' => 'numbers',
            'description' => 'string',
            'taskname' => 'string',
            'currency' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);


        if (empty(Message::$msgs)) {
            $data = array(
                'title' => $safe->title,
                'description' => $safe->description,
                'project_id' => $safe->project_id,
                'user_id' => empty($_POST['user_id']) ? App::Auth()->uid : intval($_POST['user_id']),
                'task_id' => $safe->task_id,
                'category_id' => $safe->category_id,
                'amount' => $safe->amount,
                'created' => isset($_POST['created']) ? Db::toDate($_POST['created']) : Db::toDate(),
                'is_billable' => isset($_POST['is_billable']) ? 1 : 0
            );

            if (Filter::$id) {
                $data['updated'] = Db::toDate();
            }
            (Filter::$id) ? Db::run()->update(self::exTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::exTable, $data)->getLastInsertId();

            $message = Filter::$id ? Lang::$word->EXP_UPDATE_OK : Lang::$word->EXP_ADDED_OK;

            if (isset($_POST['is_modal'])) {
                $exprecords = Utility::groupToLoop(App::Task()->getTaskExpenses($safe->task_id), "exdate");
                $html = Utility::getSnippets(
                    ADMINBASE . '/snippets/' . $_POST['tpl'] . '.tpl.php',
                    $data = array('data' => $exprecords, 'row' => array('task_id' => $safe->task_id, 'taskname' => $safe->taskname, "currency" => $safe->currency,))
                );
            }

            if (Db::run()->affected()) {
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
                if (isset($_POST['is_modal'])) {
                    $a = Db::run()->first(Project::exTable, array("COALESCE(SUM(amount), 0) as amount"), array("task_id" => $safe->task_id));
                    $json['html'] = $html;
                    $json['amount'] = Utility::formatNumber($a->amount);
                }
                if (isset($_POST['not_modal'])) {
                    $json['redirect'] = $_POST['return'];
                }
                $json['message'] = $message;
            } else {
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                if (isset($_POST['is_modal'])) {
                    $json['html'] = $html;
                }
                $json['message'] = Lang::$word->NOPROCCESS;
            }

            print json_encode($json);

            //Update Expense field
            Stats::setExpenseField($safe->project_id);

            if (!Filter::$id) {
                $adata = array(
                    'company_id' => 0,
                    'project_id' => $safe->project_id,
                    'invoice_id' => 0,
                    'note_id' => 0,
                    'task_id' => $safe->task_id,
                    'uid' => App::Auth()->uid,
                    'type' => "Expenses",
                    'title' => $safe->title,
                    'comment' => $last_id,
                    'groups' => "expense",
                    'ip' => Url::getIP(),
                    'is_activity' => 1,
                );
                Users::addSmallActivity($adata);
            }
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Project::getTimeRecordById()
     *
     * @param integer $id
     * @param bool $status
     * @return
     */
    public function getTimeRecordById($id, $status = 1)
    {

        $row = Db::run()->first(self::trTable, null, array("id" => $id, "status" => $status));

        return ($row) ? $row : 0;
    }

    /**
     * Project::getExpenseRecordById()
     *
     * @param integer $id
     * @param bool $status
     * @return
     */
    public function getExpenseRecordById($id, $status = 1)
    {

        $row = Db::run()->first(self::exTable, "*", array("id" => $id, "status" => $status));

        return ($row) ? $row : 0;
    }

    /**
     * Project::invoiceStatus()
     *
     * @param mixed $status
     * @return
     */
    public static function invoiceStatus($status)
    {
        switch ($status) {

            case 2:
                return '<span class="wojo small secondary inverted label">' . Lang::$word->ARCHIVED . '</span>';

            case 1:
                return '<span class="wojo small inverted dark label">' . Lang::$word->INV_SENT . '</span>';

            default:
                return '<span class="wojo small inverted dark label">' . Lang::$word->INV_UNSENT . '</span>';
        }
    }

    /**
     * Project::invoicepStatus()
     *
     * @param mixed $status
     * @return
     */
    public static function invoicepStatus($status)
    {
        switch ($status) {
            case 3:
                return '<span class="wojo small inverted negative label">' . Lang::$word->INV_PAIDO . '</span>';

            case 2:
                return '<span class="wojo small inverted positive label">' . Lang::$word->INV_PAID . '</span>';

            case 1:
                return '<span class="wojo small inverted primary label">' . Lang::$word->INV_PAIDP . '</span>';

            default:
                return '<span class="wojo small inverted secondary label">' . Lang::$word->INV_PAIDN . '</span>';
        }
    }

    /**
     * Project::compareJobTypes()
     *
     * @param mixed $array1
     * @param mixed $array2
     * @return
     */
    public static function compareJobTypes($array1, $array2)
    {
        for ($i = 0; $i < sizeof($array1); $i++) {
            $count = 0;
            for ($j = 0; $j < sizeof($array2); $j++) {
                if ($array1[$i]->name == $array2[$j]->name) {
                    $count++;
                }
            }

            if ($count == 0) {
                array_push($array2, (object)array("name" => $array1[$i]->name, "hrate" => $array1[$i]->hrate));
            }
        }
        return $array2;
    }

    /**
     * Project::getProjectUsers()
     *
     * @param integer $id
     * @return
     */
    public function getProjectUsers($id)
    {

        $sql = "SELECT m.id, m.email, CONCAT(m.fname,' ',m.lname) as name, m.username, m.avatar, m.type FROM	`" . Users::mTable . "` AS m
			INNER JOIN `" . self::pxTable . "` AS pu ON pu.user_id = m.id
		  WHERE pu.project_id = ?;";

        $row = Db::run()->pdoQuery($sql, array($id))->results();

        return ($row) ? $row : 0;
    }

    /**
     * Project::getProjectPermissions()
     *
     * @param mixed $uid
     * @return
     */
    public static function getProjectPermissions($uid)
    {
        $sql = "SELECT GROUP_CONCAT(p.project_id) AS projects FROM `" . self::pxTable . "` AS p
				LEFT JOIN `" . Users::mTable . "` AS m ON m.id = p.user_id
			  WHERE p.user_id = ?
			  GROUP BY p.user_id;";

        $query = Db::run()->pdoQuery($sql, array($uid))->result();
        $array = array();

        if ($query) {
            $array = explode(",", $query->projects);
        }

        return $array;
    }

    /**
     * Project::getProjectByPermissions()
     *
     * @param integer $status
     * @param integer $id
     * @return
     */
    public static function getProjectByPermissions($status = 1, $id)
    {

        if (App::Auth()->userlevel == 9) {
            $sql = "SELECT p.*, cp.name as company FROM `" . self::pTable . "` AS p
					LEFT JOIN `" . Company::cTable . "` AS cp ON cp.id = p.company_id
				  WHERE p.status = ?
				  AND p.id = ?
				  LIMIT 1;";

            $row = Db::run()->pdoQuery($sql, array($status, $id))->result();
        } else {
            $sql = "SELECT p.*, cp.name as company FROM
					`" . self::pTable . "` AS p
					INNER JOIN `" . self::pxTable . "` AS pu ON p.id = pu.project_id
					LEFT JOIN `" . Company::cTable . "` AS cp ON cp.id = p.company_id
				  WHERE p.status = ?
				  AND pu.user_id = ?
				  AND p.id = ?
				  LIMIT 1;";

            $row = Db::run()->pdoQuery($sql, array($status, App::Auth()->uid, $id))->result();
        }

        return ($row) ? $row : 0;
    }

    /**
     * Project::getProjectWithBidBudget()
     *
     * @param integer $status
     * @param integer $id
     * @return
     */
    public static function getProjectWithBidBudget($status = 1, $id, $bid_status = 2)
    {
        $sql = "SELECT p.*, b.bid_amount FROM	`" . self::pTable . "` AS p
					INNER JOIN `" . self::pxTable . "` AS pu  ON p.id = pu.project_id
					LEFT JOIN `" . Master::bTable . "` AS b ON b.project_id = p.id AND b.status = ?
				  WHERE p.status = ?
				  AND pu.user_id = ?
				  AND p.id = ?
          AND b.status
				  LIMIT 1;";

        $row = Db::run()->pdoQuery($sql, array($bid_status, $status, App::Auth()->uid, $id))->result();


        return ($row) ? $row : 0;
    } public function Bids()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->BIDS;
        $tpl->core = App::Core();
        $tpl->row = $this->getUserBids(App::Auth()->uid);
        $sql = "SELECT user_id,COUNT(*) AS total_bids,
        SUM(case when status = 1 then 1 else 0 end) as active_bids,
        SUM(case when status = 2 then 1 else 0 end) as accepted_bids,
        SUM(case when status = 4 then 1 else 0 end) as declined_bids
        FROM `" . self::bidsTable . "` WHERE user_id = ? GROUP BY user_id;";
        $tpl->bidCount = Db::run()->pdoQuery($sql, array(App::Auth()->uid))->result();
        $tpl->template = 'admin/bids.tpl.php';
    }
    /**
     * Admin::ProjectBids()
     *
     * @return
     */
    public function ProjectBids($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PROJECT_BIDS;
        $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_38];
        $tpl->core = App::Core();

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/404.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            /*if ($row->label_id == 2) {
                $row = App::Project()->getProjectWithBidBudget(1, $id);
                $row->budget = $row->bid_amount;
            }*/
            $tpl->row = $row;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->bids = $this->getProjectBids($row->id);
            $tpl->countryList = App::Content()->getCountryList('sorting DESC', ' name ,iso_alpha2 ');
            $tpl->milestones = Db::run()->select(self::bmTable, null, array('project_id' => $row->id))->results();
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->template = 'admin/projects.tpl.php';
        }
    }

    /**
     * Project::getUserBids()
     *
     * @param integer $status
     * @param integer $id
     * @return
     */
    public static function getUserBids($user_id, $status = 1)
    {

        $order_by = ' ORDER BY b.created_at DESC';
        $status = 1;
        $parts = parse_url($_SERVER['REQUEST_URI']);
        isset($parts['query']) ? parse_str($parts['query'], $qs) : $qs = array();

        $required = array(
            "order" => '',
            "cat" => 0,
        );

        if (array_intersect_key($qs, $required)) {
            if (Validator::notEmptyGet('order') and $order = Validator::sanitize($_GET['order'], "string", 11)) {
                switch ($order) {
                    case 'highest':
                        $order_by = " ORDER BY b.bid_amount DESC";
                        break;
                    case 'lowest':
                        $order_by = " ORDER BY b.bid_amount ASC";
                        break;
                    case 'fastest':
                        $order_by = " ORDER BY  b.total_time_hour ASC";
                        break;
                    case 'title':
                        $order_by = " ORDER BY  name ASC";
                        break;
                }
            }
            if (Validator::notEmptyGet('cat') and $cat = Validator::sanitize($_GET['cat'], "string", 11)) {
                switch ($cat) {
                    case 'active':
                        $status = 1;
                        break;
                    case 'accepted':
                        $status = 2;
                        break;
                    case 'declined':
                        $status = 4;
                        break;
                }
            }
        }
        $sql = "SELECT b.*, p.name name, p.currency currency  FROM	`" . self::bidsTable . "` AS b
        LEFT JOIN `" . Project::pTable . "` AS p ON b.project_id = p.id
        WHERE b.user_id=?
        AND b.status =?
				{$order_by};";
        $row = Db::run()->pdoQuery($sql, array(intval($user_id), $status))->results();

        if (count((array)$row) > 0) {
            $bided_projects = implode(',', array_column((array)$row, 'project_id'));
            $sRow = Db::run()->select(self::bidsTable, array('project_id,COUNT(id) as total_bids', 'SUM(bid_amount) as total_bid_amount'), array(), ' WHERE project_id IN (' . $bided_projects . ') GROUP BY project_id')->results();

            foreach ($row as $k => $v) {
                foreach ($sRow as $v2) {
                    if ($v->project_id === $v2->project_id) {
                        $v->average_bids_amount = $v2->total_bid_amount / $v2->total_bids;
                        $v->project_total_bids = $v2->total_bids;
                    }
                }
            }
        }

        return ($row) ? $row : 0;
    }
    /**
     * Project::getProjectBids()
     *
     * @param integer $status
     * @param integer $id
     * @return
     */
    public static function getProjectBids($id)
    {

        $order_by = ' ORDER BY b.created_at DESC';
        $parts = parse_url($_SERVER['REQUEST_URI']);
        isset($parts['query']) ? parse_str($parts['query'], $qs) : $qs = array();

        $required = array(
            "order" => '',
        );

        if (array_intersect_key($qs, $required)) {
            if (Validator::notEmptyGet('order') and $order = Validator::sanitize($_GET['order'], "string", 11)) {
                switch ($order) {
                    case 'highest':
                        $order_by = " ORDER BY b.bid_amount DESC";
                        break;
                    case 'lowest':
                        $order_by = " ORDER BY b.bid_amount ASC";
                        break;
                    case 'fastest':
                        $order_by = " ORDER BY  b.total_time_hour ASC";
                        break;
                    case 'payment':
                        $order_by = " ORDER BY  b.payment_type DESC";
                        break;

                    default:
                        $order_by = " ORDER BY b.created_at DESC";
                        break;
                }
            }
        }

        $sql = "SELECT b.*, u.country, CONCAT(u.fname,' ',u.lname) as uname, u.email, u.username, u.phone, u.avatar FROM `" . self::bidsTable . "` AS b
        LEFT JOIN `" . Users::mTable . "` AS u ON b.user_id = u.id
        WHERE b.project_id=?
				{$order_by};";

        $row = Db::run()->pdoQuery($sql, array(intval($id)))->results();

        return ($row) ? $row : 0;
    }
}
