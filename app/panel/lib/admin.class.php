<?php

/**
 * Class Admin
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: app.class.php, v1.00 2019-04-20 18:20:24 gewa Exp $
 */
if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');


class Admin
{

    const gTable = "gateways";
    const ciTable = "client_info";

    /**
     * Admin::Index()
     *
     * @return
     */
    public function Index()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->ADM_MYWORK];
        $tpl->template = 'admin/index.tpl.php';
        $tpl->title = Lang::$word->ADM_MYWORK;
        $tpl->projects = App::Project()->getAssignedProjects();
        $tpl->tasks = App::Project()->getTasksByUser();
        $tpl->times = App::Project()->getTimeRecordsByUser();
        $tpl->expense = App::Project()->getExpensesByUser();
    }


    /**
     * Admin::ViewAsFreelancer()
     *
     * @return
     */
    public function ViewAsFreelancer($username)
    {

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->template = 'admin/_freelancer_view.tpl.php';
        if (!$row = App::Auth()->getUserInfo($username)) {
            $tpl->template = 'admin/404.tpl.php';
            $tpl->title = Lang::$word->ERROR;
        } else {
            $tpl->row = $row;
            $tpl->title = ucwords($tpl->row->fname);
            $tpl->irow = Db::run()->first(Admin::ciTable, null, array('user_id' => intval($tpl->row->id)));
            $tpl->skills = App::Admin()->getUserSkills($tpl->row->id);
            $tpl->languages = App::Admin()->getUserLanguages($tpl->row->id);
            $tpl->countries = App::Content()->getCountryList("name");
            $tpl->projects = App::Admin()->getUserProjects($tpl->row->id);
        }
    }
      /**
     * Admin::getUserSkills()
     *
     * @param mixed $id
     * @return
     */
    public function getUserSkills($id = '')
    {
      $sql = "SELECT s.name, s.id, su.confirmed FROM `" . Users::smTable . "` su
        INNER JOIN `" . Project::sTable . "` s ON su.sid = s.id
        INNER JOIN `" . Users::mTable . "` u ON su.uid = u.id
        WHERE u.id = ? ;";

        return Db::run()->pdoQuery($sql, array($id))->results();
    }
      /**
     * Admin::getUserProjects()
     *
     * @param mixed $id
     * @return
     */
    public function getUserProjects($id = '')
    {
        $sql = "SELECT * FROM `" . Project::pTable . "` p
  			INNER JOIN `" . Project::pxTable . "` px ON px.project_id = p.id
		    WHERE px.user_id = ? ;";

        return Db::run()->pdoQuery($sql, array($id))->results();
    }

 /**
     * Admin::getUserLanguages()
     *
     * @param mixed $id
     * @return
     */
    public function getUserLanguages($id = '')
    {
        $sql = "SELECT l.name, l.id FROM `" . Users::lmTable . "` lu
			INNER JOIN `" . Content::lTable . "` l ON lu.lid = l.id
			INNER JOIN `" . Users::mTable . "` u ON lu.uid = u.id
		  WHERE u.id = ? ;";

      return Db::run()->pdoQuery($sql, array($id))->results();
    }




    /**
     * Admin::Account()
     *
     * @return
     */
    public function Account()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_15];
        $tpl->template = 'admin/myaccount.tpl.php';
        $tpl->data = Db::run()->first(Users::mTable, null, array('id' => App::Auth()->uid));
        $tpl->title = Lang::$word->ACC_TITLE;
    }

    /**
     * Admin::Password()
     *
     * @return
     */
    public function Password()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', array(0 => Lang::$word->NAV_14, 1 => Lang::$word->NAV_15), Lang::$word->NAV_13];
        $tpl->template = 'admin/mypassword.tpl.php';
        $tpl->title = Lang::$word->ACC_PASS_CHANGE;
    }

    /**
     * Admin::updateAdminPassword()
     *
     * @return
     */
    public function updateAdminPassword()
    {

        $rules = array(
            'password' => array('required|string|min_len,6|max_len,20', Lang::$word->NEWPASS),
            'password2' => array('required|string|min_len,6|max_len,20', Lang::$word->CONPASS),
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);

        if ($_POST['password'] != $_POST['password2']) {
            Message::$msgs['pass'] = Lang::$word->ACC_PASSMATCH;
        }

        if (empty(Message::$msgs)) {
            $salt = '';
            $hash = App::Auth()->create_hash($safe->password, $salt);
            $data['hash'] = $hash;
            $data['salt'] = $salt;

            Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid));
            Message::msgReply(Db::run()->affected(), 'success', Lang::$word->ACC_PASSUPDATED);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Admin::updateAccount()
     *
     * @return
     */
    public function updateAccount()
    {

        $rules = array(
            'email' => array('required|email', Lang::$word->EMAIL),
            'fname' => array('required|string|min_len,2|max_len,60', Lang::$word->FNAME),
            'lname' => array('required|string|min_len,2|max_len,60', Lang::$word->LNAME),
        );

        $filters = array(
            'fname' => 'string',
            'lname' => 'string',
        );

        $upl = Upload::instance(512000, "png,jpg");
        if (!empty($_FILES['avatar']['name']) and empty(Message::$msgs)) {
            $upl->process("avatar", UPLOADS . "/avatars/", "AVT_");
        }

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $data = array(
                'email' => $safe->email,
                'lname' => $safe->lname,
                'fname' => $safe->fname
            );

            if (isset($upl->fileInfo['fname'])) {
                $data['avatar'] = $upl->fileInfo['fname'];
                if (Auth::$udata->avatar != "") {
                    File::deleteFile(UPLOADS . "/avatars/" . Auth::$udata->avatar);
                    Auth::$udata->avatar = App::Session()->set('avatar', $upl->fileInfo['fname']);
                }
            }
            Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid));
            if (Db::run()->affected()) {
                Auth::$udata->fname = App::Session()->set('fname', $data['fname']);
                Auth::$udata->lname = App::Session()->set('lname', $data['lname']);
                Auth::$udata->email = App::Session()->set('email', $data['email']);
            }
            $message = str_replace("[NAME]", "", Lang::$word->ACC_UPDATED);
            Message::msgReply(Db::run()->affected(), 'success', $message);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Admin::Gateways()
     *
     * @return
     */
    public function Gateways()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_12];
        $tpl->data = Db::run()->select(self::gTable, null, null, 'ORDER BY name')->results();
        $tpl->template = 'admin/gateways.tpl.php';
        $tpl->title = Lang::$word->GWT_TITLE;
    }

    /**
     * Admin::GatewayEdit()
     *
     * @return
     */
    public function GatewayEdit($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->GWT_TITLE;
        $tpl->crumbs = ['admin', Lang::$word->NAV_12, Lang::$word->NAV_11];

        if (!$row = Db::run()->first(Content::gwTable, null, array("id =" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [admin.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->data = $row;
            $tpl->template = 'admin/gateways.tpl.php';
        }
    }

    /**
     * Admin::processGateway()
     *
     * @return
     */
    public function processGateway()
    {

        $rules = array(
            'displayname' => array('required|string|min_len,3|max_len,60', Lang::$word->GWT_NAME),
            'extra' => array('required|string', Lang::$word->GWT_NAME),
            'live' => array('required|numeric', Lang::$word->GWT_LIVE),
            'active' => array('required|numeric', Lang::$word->ACTIVE),
            'id' => array('required|numeric', "ID"),
        );

        $filters = array(
            'displayname' => 'string',
            'extra2' => 'string',
            'extra3' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $data = array(
                'displayname' => $safe->displayname,
                'extra' => $safe->extra,
                'extra2' => $safe->extra2,
                'extra3' => $safe->extra3,
                'live' => $safe->live,
                'active' => $safe->active,
            );

            Db::run()->update(Content::gwTable, $data, array("id" => Filter::$id));
            Message::msgReply(Db::run()->affected(), 'success', Message::formatSuccessMessage($data['displayname'], Lang::$word->GWT_UPDATED));
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Admin::System()
     *
     * @return
     */
    public function System()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_42];
        $tpl->core = App::Core();
        $tpl->template = 'admin/system.tpl.php';
        $tpl->title = Lang::$word->SYS_TITLE;
    }

    /**
     * Admin::Permissions()
     *
     * @return
     */
    public function Permissions()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_6];
        $tpl->data = App::Users()->getRoles();
        $tpl->template = 'admin/permissions.tpl.php';
        $tpl->title = Lang::$word->ACC_ROLE;
    }

    /**
     * Admin::Privileges()
     *
     * @return
     */
    public function Privileges($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->ACC_PRIV;
        $tpl->crumbs = ['admin', Lang::$word->NAV_6, Lang::$word->NAV_7];

        if (!$row = Db::run()->first(Users::rTable, null, array('id' => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [admin.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->role = $row;
            $tpl->result = Utility::groupToLoop(App::Users()->getPrivileges($id), "type");
            $tpl->template = 'admin/permissions.tpl.php';
        }
    }

    /**
     * Admin::Reports()
     *
     * @return
     */
    public function Reports()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
    }

    /**
     * Admin::ReportsPayments()
     *
     * @return
     */
    public function ReportsPayments()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31, Lang::$word->NAV_32];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
        $tpl->data = Stats::getPaymentTable();
    }

    /**
     * Admin::ReportsUninvoiced()
     *
     * @return
     */
    public function ReportsUninvoiced()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31, Lang::$word->NAV_33];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
        $tpl->data = Stats::getUninvoicedItems();
    }

    /**
     * Admin::ReportsTasks()
     *
     * @return
     */
    public function ReportsTasks()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31, Lang::$word->NAV_27];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
    }

    /**
     * Admin::ReportsWorkload()
     *
     * @return
     */
    public function ReportsWorkload()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31, Lang::$word->NAV_34];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
        $tpl->staff = App::Users()->getAllStaff(1, "y", true);
        $tpl->projects = App::Project()->getProjects();
        $tpl->data = Stats::getTasksWorkload();
    }

    /**
     * Admin::ReportsTime()
     *
     * @return
     */
    public function ReportsTime()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31, Lang::$word->NAV_35];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
        $tpl->result = Stats::getTimeRecords();
        $tpl->data = Utility::groupToLoop($tpl->result, "name");;
    }

    /**
     * Admin::ReportsExpense()
     *
     * @return
     */
    public function ReportsExpense()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31, Lang::$word->NAV_36];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
        $tpl->result = Stats::getExpenses();
        $tpl->data = Utility::groupToLoop($tpl->result, "name");;
    }

    /**
     * Admin::ReportsBudget()
     *
     * @return
     */
    public function ReportsBudget()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_31, Lang::$word->NAV_37];
        $tpl->template = 'admin/reports.tpl.php';
        $tpl->title = Lang::$word->REP_TITLE;
        $tpl->data = App::Project()->getProjects();
    }

    /**
     * Admin::Trash()
     *
     * @return
     */
    public function Trash()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->TRASH];
        $tpl->template = 'admin/trash.tpl.php';
        $tpl->title = Lang::$word->TRASH;
        $tpl->rows = Db::run()->select(Core::txTable, null, null, 'ORDER BY created DESC')->results();
        $tpl->data = Utility::groupToLoop($tpl->rows, "type");
    }
    /**
     * freelancer manage bids
     * Admin::Bids()
     *
     * @return
     */

}
