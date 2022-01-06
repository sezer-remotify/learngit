<?php

/**
 * Content Class
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: user.class.php, v1.00 201-10-20 18:20:24 gewa Exp $
 */
if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');


class Content
{
    const eTable = "email_templates";
    const cTable = 'countries';
    const blTable = 'banlist';
    const taxTable = 'taxes';
    const clTable = 'calendars';
    const cluTable = 'calendar_users';
    const cleTable = 'calendar_events';
    const gwTable = "gateways";
    const esTable = 'estimate';
    const sTable = 'skills';
    const lTable = 'languages';
    const bTable = 'budgets';


    /**
     * Content::__construct()
     *
     * @return
     */
    public function __construct()
    {
    }


    /**
     * Content::getCountryList()
     *
     * @return
     */
    public function getCountryList($sort = 'sorting DESC', $columns = '*')
    {
        $sql = "SELECT {$columns}
		  FROM `" . self::cTable . "`
		  ORDER BY  " . $sort . ";";

        $row = Db::run()->pdoQuery($sql)->results();

        return ($row) ? $row : 0;
    }

    /**
     * Content::getLanguageList()
     *
     * @return
     */
    public function getLanguageList()
    {
        $sql = "SELECT *
		  FROM `" . self::lTable . "`
		  ORDER BY id;";

        $row = Db::run()->pdoQuery($sql)->results();

        return ($row) ? $row : 0;
    }

    /**
     * Content::getBudgetList()
     *
     * @return
     */
    public function getBudgetList()
    {
        $sql = "SELECT *
		  FROM `" . self::bTable . "`
		  ORDER BY id;";

        $row = Db::run()->pdoQuery($sql)->results();

        return ($row) ? $row : 0;
    }


    /**
     * Content::getSkillList()
     *
     * @return
     */
    public function getSkillList()
    {
        $sql = "SELECT *
		  FROM `" . self::sTable . "`
		  ORDER BY id;";

        $row = Db::run()->pdoQuery($sql)->results();

        return ($row) ? $row : 0;
    }

    /**
     * Content::getReferences(id)
     *
     * @return
     */
    public function getReferences($id)
    {
        $sql = "SELECT *
		  FROM `" . Users::rfTable . "`
		  WHERE uid=".$id." ORDER BY id";

        $row = Db::run()->pdoQuery($sql)->results();

        return ($row) ? $row : 0;
    }

    /**
     * Content::Templates()
     *
     * @return
     */
    public function Templates()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->crumbs = ['admin', Lang::$word->NAV_9];
        $tpl->template = 'admin/templates.tpl.php';
        $tpl->data = Db::run()->select(self::eTable, null, null, "ORDER BY name DESC")->results();
        $tpl->title = Lang::$word->EMT_TITLE;
    }

    /**
     * Content::TemplateEdit()
     *
     * @param mixed $id
     * @return
     */
    public function TemplateEdit($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->EMT_TITLE;
        $tpl->crumbs = ['admin', array(0 => Lang::$word->NAV_9, 1 => Lang::$word->NAV_10), Lang::$word->NAV_11];


        if (!$row = Db::run()->first(self::eTable, null, array("id =" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->data = $row;
            $tpl->template = 'admin/templates.tpl.php';
        }
    }

    /**
     * Content::processTemplate()
     *
     * @return
     */
    public function processTemplate()
    {

        $rules = array(
            'name' => array('required|string|min_len,3|max_len,60', Lang::$word->EMT_NAME),
            'subject' => array('required|string|min_len,3|max_len,100', Lang::$word->EMT_SUBJECT),
            'id' => array('required|numeric', "ID"),
        );

        $filters = array(
            'name' => 'string',
            'body' => 'advanced_tags',
            'help' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $data = array(
                'name' => $safe->name,
                'subject' => $safe->subject,
                'help' => $safe->help,
                'body' => Url::in_url($safe->body),
            );

            Db::run()->update(self::eTable, $data, array("id" => Filter::$id));
            Message::msgReply(Db::run()->affected(), 'success', Message::formatSuccessMessage($data['name'], Lang::$word->EMT_UPDATED));
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Content::Calendar()
     *
     * @return
     */
    public function Calendar()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->CAL_CALENDAR;
        $tpl->data = $this->getCalendars();
        $tpl->crumbs = ['admin', Lang::$word->NAV_29];
        $tpl->template = 'admin/calendar.tpl.php';
    }

    /**
     * Content::getCalendars()
     *
     * @return
     */
    public function getCalendars()
    {

        $sql = "SELECT c.*, clu.is_visible
		  FROM
			`" . self::clTable . "` AS c
			INNER JOIN `" . self::cluTable . "` clu
			  ON clu.calendar_id = c.id
		  WHERE clu.user_id = ?
		  ORDER BY c.created DESC;";

        $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid))->results();

        return ($row) ? $row : 0;
    }

    /**
     * Content::processEvent()
     *
     * @return
     */
    public function processEvent()
    {
        $rules = array(
            'name' => array('required|string', Lang::$word->CAL_ETITLE),
            'calendar_id' => array('required|numeric', Lang::$word->CAL_CALENDAR),
            'starts_on_submit' => array('required|date', Lang::$word->CAL_START_DATE),
            'ends_on_submit' => array('required|date', Lang::$word->CAL_END_DATE),
        );

        $filters = array(
            'ends_on_submit' => 'string',
            'starts_on_submit' => 'string',
            'starts_on_time' => 'string',
            'ends_on_time' => 'string',
            'comment' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $data = array(
                'calendar_id' => $safe->calendar_id,
                'name' => $safe->name,
                'starts_on' => Db::toDate($safe->starts_on_submit, false),
                'ends_on' => Db::toDate($safe->ends_on_submit, false),
                'starts_on_time' => (empty($safe->starts_on_time)) ? Date::doStime(Utility::today()) :  Date::doStime($safe->starts_on_time),
                'ends_on_time' => (empty($safe->ends_on_time) or $safe->ends_on_time == $safe->starts_on_time) ? 'NULL' :  Date::doStime($safe->ends_on_time),
                'created_by_id' => App::Auth()->uid,
                'created_by_name' => App::Auth()->name,
                'created_by_email' => App::Auth()->email,
                'comment' => $safe->comment
            );

            (Filter::$id) ? Db::run()->update(self::cleTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cleTable, $data)->getLastInsertId();
            $message = Filter::$id ?
                Message::formatSuccessMessage($data['name'], Lang::$word->CAL_EUPDATED) :
                Message::formatSuccessMessage($data['name'], Lang::$word->CAL_EADDED);

            Message::msgReply(Db::run()->affected(), 'success', $message);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Content::getCalendarEvents()
     *
     * @param str id IN $ids
     * @return
     */
    public function getCalendarEvents($ids)
    {

        $and = $ids ?  "AND cle.calendar_id IN ($ids)" : null;

        $sql = "SELECT cle.*,	c.color FROM `" . self::clTable . "` AS c
			INNER JOIN `" . self::cluTable . "` clu ON clu.calendar_id = c.id
			RIGHT JOIN `" . self::cleTable . "` cle ON cle.calendar_id = c.id
		  WHERE clu.user_id = ?
			$and
		  ORDER BY cle.starts_on DESC;";

        $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid))->results();

        return ($row) ? $row : 0;
    }

    /**
     * Content::processCalendar()
     *
     * @return
     */
    public function processCalendar()
    {

        $rules = array(
            'name' => array('required|string', Lang::$word->CAL_NAME),
        );

        $filters = array(
            'color' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $data = array(
                'name' => $safe->name,
                'color' => ($safe->color) ? $safe->color : '#000000',
                'created_by_id' => App::Auth()->uid,
                'created_by_name' => App::Auth()->name,
                'created_by_email' => App::Auth()->email
            );

            if (Filter::$id) {
                $data['updated'] = Db::toDate();
            }

            (Filter::$id) ? Db::run()->update(self::clTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::clTable, $data)->getLastInsertId();

            $message = Filter::$id ?
                Message::formatSuccessMessage($data['name'], Lang::$word->CAL_UPDATED) :
                Message::formatSuccessMessage($data['name'], Lang::$word->CAL_ADDED);
            if (Db::run()->affected()) {
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = $message;
                $json['html'] = $safe->name;
                if (!Filter::$id) {
                    $json['redirect'] = Url::url("/admin/calendar");
                }
            } else {
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
                $json['html'] = $safe->name;
            }

            print json_encode($json);

            $id = Filter::$id ? Filter::$id : $last_id;
            if (isset($_POST['user_id'])) {
                Db::run()->delete(self::cluTable, array('calendar_id' => $id));
                foreach ($_POST['user_id'] as $sid) {
                    $sdataArray[] = array('calendar_id' => $id, 'user_id' => $sid);
                }
                Db::run()->insertBatch(self::cluTable, $sdataArray);
            }

            if (!Filter::$id) {
                $adata = array(
                    'uid' => App::Auth()->uid,
                    'type' => "Calendar",
                    'title' => $safe->name,
                    'username' => '',
                    'fullname' => App::Auth()->name,
                    'groups' => "calendar",
                    'is_activity' => 1
                );

                Db::run()->insert(Users::aTable, $adata);
            }
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Comments::copyNoteToProject()
     *
     * @return
     */
    public function copyNoteToProject()
    {

        $rules = array(
            'id' => array('required|numeric', "Invalid ID"),
            'cpid' => array('required|numeric', Lang::$word->PRJ_INVALID_ID),
        );


        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);

        if (empty(Message::$msgs)) {
            $row = Db::run()->first(Project::nTable, null, array('id' => Filter::$id));
            $data = array(
                'name' => $row->name,
                'body' => $row->body,
                'created_by_id' => $row->created_by_id,
                'created_by_name' => $row->created_by_name,
                'created_by_email' => $row->created_by_email,
                'status' => 1,
                'is_hidden' => $row->is_hidden
            );
            $last_id = Db::run()->insert(Project::nTable, $data)->getLastInsertId();
            Db::run()->update(Project::nTable, array("project_id" => $safe->cpid), array("id" => $last_id));

            if ($subscribers = Db::run()->select(Project::sbTable, null, array("note_id" => $row->id))->results()) {
                foreach ($subscribers as $sbc) {
                    $sdataArray[] = array(
                        'note_id' => $last_id,
                        'user_id' => $sbc->user_id,
                    );
                }
                Db::run()->insertBatch(Project::sbTable, $sdataArray);
            }

            if ($files = Db::run()->select(Project::fTable, null, array("note_id" => $row->id))->results()) {
                foreach ($files as $flr) {
                    $fdataArray[] = array(
                        'caption' => $flr->caption,
                        'parent' => "note",
                        'comment_id' => $last_id,
                        'project_id' => $flr->project_id,
                        'name' => $flr->name,
                        'fsize' => $flr->fsize,
                        'fext' => $flr->fext,
                        'mime' => $flr->mime,
                        'created_by_id' => $flr->created_by_id,
                        'created_by_name' => $flr->created_by_name,
                    );
                }
                Db::run()->insertBatch(Project::fTable, $fdataArray);
            }

            if (empty($_POST['delete'])) {
                Db::run()->delete(Project::nTable, array("id" => $row->id));
                Db::run()->delete(Project::sbTable, array("note_id" => $row->id));
                Db::run()->delete(Project::fTable, array("note_id" => $row->id));
            }

            $json['type'] = "success";
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $row->name, Lang::$word->NOT_INFO1);
            $json['redirect'] = Url::url("/admin/notes/view/" . $safe->cpid, $last_id);

            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Content::processNote()
     *
     * @return
     */
    public function processNote($front = false, $master = false)
    {

        $rules = array(
            'name' => array('required|string', Lang::$word->NOT_NAME),
            'pid' => array('required|numeric', Lang::$word->PRJ_INVALID_ID),
        );

        $filters = array(
            'color' => 'string',
            'noteBody' => 'basic_tags',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $data = array(
                'project_id' => $safe->pid,
                'name' => $safe->name,
                'color' => $safe->color,
                'body' => $safe->noteBody,
                'created_by_id' => Auth::$udata->uid,
                'created_by_name' => Auth::$udata->name,
                'created_by_email' => (Auth::$udata->userlevel == 20 || Auth::$udata->userlevel == 21) ? Auth::$udata->username : Auth::$udata->email,
                'is_hidden' => empty($_POST['is_hidden']) ? 0 : 1,
                'status' => 1,
            );

            if (Filter::$id) {
                $data['updated'] = Db::toDate();
                $data['updated_by_id'] = Auth::$udata->uid;
                $data['updated_by_name'] = Auth::$udata->name;
                $data['updated_by_email'] = Auth::$udata->email;
            }

            (Filter::$id) ? Db::run()->update(Project::nTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(Project::nTable, $data)->getLastInsertId();
            $message = Filter::$id ? Lang::$word->NOT_UPDATE_OK : Lang::$word->NOT_ADDED_OK;
            $id = Filter::$id ? Filter::$id : $last_id;
            $is_front = ($front == true) ? "dashboard" : "admin";
            if ($master) $is_front = "master";

            if (Db::run()->affected()) {
                //Mailer
                $mail = Content::newNoteMail(Auth::$udata->uid, $safe->pid);

                $json['mail'] = $mail;
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = $message;
                $json['redirect'] = Url::url("/$is_front/notes/view/" . $safe->pid, $id);
            } else {
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            }



            if (isset($_POST['subscribers'])) {
                Db::run()->delete(Project::sbTable, array('note_id' => $id));
                foreach ($_POST['subscribers'] as $sid) {
                    $sdataArray[] = array('note_id' => $id, 'user_id' => $sid);
                }
                Db::run()->insertBatch(Project::sbTable, $sdataArray);
            }

            if (isset($_POST['attachment'])) {
                $files = Db::run()->pdoQuery("SELECT * FROM `" . Project::ftTable . "` WHERE caption IN(" . Utility::implodeFields($_POST['attachment'], ",", true) . ")")->results();
                if ($files) {
                    foreach ($files as $file) {
                        $fdataArray[] = array(
                            'caption' => $file->caption,
                            'parent' => $file->parent,
                            'project_id' => $file->project_id,
                            'note_id' => $id,
                            'name' => $file->name,
                            'fsize' => $file->fsize,
                            'fext' => $file->fext,
                            'mime' => $file->mime,
                            'token' => Utility::randomString(16),
                            'created_by_id' => $file->created_by_id,
                            'created_by_name' => $file->created_by_name,
                        );
                        Db::run()->insertBatch(Project::fTable, $fdataArray);
                    }
                    Db::run()->pdoQuery("DELETE FROM `" . Project::ftTable . "` WHERE caption IN(" . Utility::implodeFields($_POST['attachment'], ",", true) . ")");
                }
            }

            if (!Filter::$id) {
                $adata = array(
                    'project_id' => $safe->pid,
                    'note_id' => $last_id,
                    'uid' => App::Auth()->uid,
                    'type' => "Notes",
                    'title' => $safe->name,
                    'username' => App::Auth()->username,
                    'fullname' => App::Auth()->fname . ' ' . App::Auth()->lname,
                    'groups' => "note",
                    'is_activity' => 1
                );

                Db::run()->insert(Users::aTable, $adata);
            }

            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }


    /**
     * Content::newNoteMail()
     *
     * @param mixed $id, $projectID
     * @return
     */
    public function newNoteMail($aUsr, $projectID)
    {
        $userMails = array();

        $mailer = Mailer::sendMail();
        $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
        $replacements = array();
        $numSent = 0;
        $failedRecipients = array();
        $core = App::Core();

        $auserrow =  Db::run()->first(Users::mTable, null, array('id' => $aUsr));
        $prname =  Db::run()->first(Project::pTable, null, array('id' => $projectID));
        $prusers = Db::run()->select(ProjecT::pxTable, null, array("project_id" => $projectID))->results();

        foreach($prusers as $userID)
        {

          if($userID->user_id != $aUsr)
          {
            $user = Db::run()->first(Users::mTable, null, array("id" => $userID->user_id));

            array_push($userMails, $user->email);
          }
        }


        $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'weeklyUpdate'));
        $core = App::Core();
        $body = str_replace(array(
            '[AUSER]',
            '[AUSERMAIL]',
            '[LOGO]',
            '[DATE]',
            '[PROJECT]',
            '[CEMAIL]',
            '[FB]',
            '[TW]',
            '[SITEURL]'
        ), array(
            $auserrow->fname.' '.$auserrow->lname,
            $auserrow->email,
            Utility::getLogo(),
            date('Y'),
            $prname->name,
            $core->site_email,
            $core->social->facebook,
            $core->social->twitter,
            SITEURL
        ), $tpl->body);

        $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
        $mailer->registerPlugin($decorator);

        $message = Swift_Message::newInstance()
            ->setSubject($tpl->subject)
            ->setFrom(array($core->site_email => $core->company))
            ->setBody($body, 'text/html');
        $message->setTo($userMails);

        $numSent++;

        if ($mailer->send($message)) {
          return $userMails;
        }


    }

    /**
     * Content::invoiceID()
     *
     * @param mixed $id
     * @param string $cid
     * @return
     */
    public static function invoiceID($id, $cid = '')
    {

        return ($cid) ? $cid : App::Core()->invoice_number . $id;
    }

    /**
     * Content::getTaxes()
     *
     * @param bool $active
     * @return
     */
    public function getTaxes($active = true)
    {
        $is_active = $active ? array('active' => 1) : null;
        $row = Db::run()->select(self::taxTable, "*", $is_active)->results();

        return ($row) ? $row : 0;
    }

    /**
     * Content::Estimates()
     *
     * @return
     */
    public function Estimates()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->ADM_ESTIMATES;
        $tpl->data = Utility::groupToLoop($this->getEstimates(), "status");
        $tpl->crumbs = ['admin', Lang::$word->NAV_22];
        $tpl->template = 'admin/estimates.tpl.php';
    }

    /**
     * Content::EstimateNew()
     *
     * @return
     */
    public function EstimateNew()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->EST_TITLE4;
        $tpl->taxes = App::Content()->getTaxes();
        $tpl->companies = Utility::loopOptions(App::Company()->getCompanies(1, 0), "id", "name");
        $tpl->countries = App::Content()->getCountryList();
        $tpl->crumbs = ['admin', Lang::$word->NAV_22, Lang::$word->NAV_18];
        $tpl->template = 'admin/estimates.tpl.php';
    }

    /**
     * Content::EstimateEdit()
     *
     * @return
     */
    public function EstimateEdit($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->EST_TITLE2;
        $tpl->crumbs = ['admin', Lang::$word->NAV_22, Lang::$word->NAV_11];

        if (!$row = Db::run()->first(self::esTable, null, array("id" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = Utility::jSonToArray($row->items);
            $tpl->taxes = App::Content()->getTaxes();
            $tpl->companies = Utility::loopOptions(App::Company()->getCompanies(1, 0), "id", "name", $row->company_id);
            $tpl->countries = App::Content()->getCountryList();
            $tpl->template = 'admin/estimates.tpl.php';
        }
    }

    /**
     * Content::EstimateView()
     *
     * @param int $id
     * @return
     */
    public function EstimateView($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->ADM_ESTIMATES;
        $tpl->crumbs = ['admin', Lang::$word->NAV_22, Lang::$word->NAV_19];

        if (!$row = Db::run()->first(self::esTable, null, array("id" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = Utility::jSonToArray($row->items);
            $tpl->company = Db::run()->first(Company::cTable, null, array('owner' => 1));
            $tpl->template = 'admin/estimates.tpl.php';
        }
    }

    /**
     * Content::EstimateInvoice()
     *
     * @param int $id
     * @return
     */
    public function EstimateInvoice($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->INV_NEWINV;
        $tpl->crumbs = ['admin', Lang::$word->NAV_22, Lang::$word->NAV_13];

        if (!$row = Db::run()->first(self::esTable, null, array("id" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = Utility::jSonToArray($row->items);
            $tpl->taxes = App::Content()->getTaxes();
            $tpl->companies = Utility::loopOptions(App::Company()->getCompanies(1, 0), "id", "name", $row->company_id);
            $tpl->countries = App::Content()->getCountryList();
            $tpl->template = 'admin/estimates.tpl.php';
        }
    }

    /**
     * Content::EstimateProject()
     *
     * @param int $id
     * @return
     */
    public function EstimateProject($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->PRJ_PRJSTART;
        $tpl->crumbs = ['admin', Lang::$word->NAV_22, Lang::$word->NAV_24];

        if (!$row = Db::run()->first(self::esTable, null, array("id" => $id))) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->core = App::Core();
            $tpl->row = $row;
            $tpl->companies = App::Company()->getCompanies();
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->jobtypes = Utility::jSonToArray($tpl->core->job_types);
            $tpl->countries = $this->getCountryList();
            $tpl->template = 'admin/estimates.tpl.php';
        }
    }

    /**
     * Content::EstimatesArchived()
     *
     * @return
     */
    public function EstimatesArchived()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "admin/";
        $tpl->title = Lang::$word->EST_TITLE1;
        $tpl->data = Utility::groupToLoop($this->getEstimatesByGroup(), "cdate");
        $tpl->crumbs = ['admin', Lang::$word->NAV_22, Lang::$word->NAV_20];
        $tpl->template = 'admin/estimates.tpl.php';
    }

    /**
     * Content::processEstimate()
     *
     * @return
     */
    public function processEstimate()
    {

        $rules = array(
            'title' => array('required|string', Lang::$word->EST_NAME),
            'company_id' => array('required|numeric', Lang::$word->CMP_SELECT),
            'company_address' => array('required|string', Lang::$word->ADDRESS),
            'currency' => array('required|string', Lang::$word->CFG_SCURRENCY_S),
            'taxes' => array('required|numeric', Lang::$word->TAXES),
            'subtotal' => array('required|numeric', Lang::$word->SUBTOTAL),
            'total_amount' => array('required|numeric', Lang::$word->TOTALAMT),
        );

        $filters = array(
            'title' => 'string',
            'company_address' => 'trim|string',
            'note' => 'string',
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

        (Filter::$id) ? $this->_updateEstimate($rules, $filters) : $this->_addEstimate($rules, $filters);
    }

    /**
     * Content::_addEstimate()
     *
     * @param array $rules
     * @param array $filters
     * @return
     */
    private function _addEstimate($rules, $filters)
    {
        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $iso = explode(",", $safe->currency);
            $data = array(
                'title' => $safe->title,
                'company_id' => $safe->company_id,
                'company_name' => Db::run()->getValueById(Company::cTable, "name", $safe->company_id),
                'company_address' => $safe->company_address,
                'currency' => $iso[0],
                'country' => $iso[1],
                'issued_by' => App::Auth()->uid,
                'discount' => $safe->discount,
                'subtotal' => $safe->subtotal,
                'tax' => $safe->taxes,
                'total' => $safe->total_amount,
                'balance_due' => $safe->total_amount,
                'note' => $safe->note,
            );

            foreach ($_POST['item'] as $i => $row) {
                $tax = ($_POST['taxes'][$i]) ? Db::run()->first(Content::taxTable, null, array("id" => $_POST['taxes'][$i])) : 0;
                $dataArray[] = array(
                    'id' => $i,
                    'amount' => $_POST['price'][$i],
                    'quantity' => $_POST['quantity'][$i],
                    'tax_id' => $tax ? $tax->id : 0,
                    'tax_amount' => $tax ? $tax->amount : 0,
                    'tax_name' => $tax ? $tax->name : "",
                    'description' => $row
                );
            }
            $data['items'] = json_encode($dataArray);
            $last_id = Db::run()->insert(self::esTable, $data)->getLastInsertId();

            if ($last_id) {
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->EST_ADDED;
                $json['redirect'] = Url::url("/admin/estimates/view", $last_id);
            } else {
                $json['type'] = "alert";
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            }
            print json_encode($json);

            $acata = array(
                'uid' => App::Auth()->uid,
                'type' => "Estimates",
                'groups' => "estimate",
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
     * Content::_updateEstimate()
     *
     * @param array $rules
     * @param array $filters
     * @return
     */
    private function _updateEstimate($rules, $filters)
    {

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (empty(Message::$msgs)) {
            $iso = explode(",", $safe->currency);
            $data = array(
                'title' => $safe->title,
                'company_id' => $safe->company_id,
                'company_name' => Db::run()->getValueById(Company::cTable, "name", $safe->company_id),
                'company_address' => $safe->company_address,
                'currency' => $iso[0],
                'country' => $iso[1],
                'issued_by' => App::Auth()->uid,
                'discount' => $safe->discount,
                'subtotal' => $safe->subtotal,
                'tax' => $safe->taxes,
                'total' => $safe->total_amount,
                'balance_due' => $safe->total_amount,
                'note' => $safe->note,
            );

            foreach ($_POST['item'] as $i => $row) {
                $tax = ($_POST['taxes'][$i]) ? Db::run()->first(Content::taxTable, null, array("id" => $_POST['taxes'][$i])) : 0;
                $dataArray[] = array(
                    'id' => $i,
                    'amount' => $_POST['price'][$i],
                    'quantity' => $_POST['quantity'][$i],
                    'tax_id' => $tax ? $tax->id : 0,
                    'tax_amount' => $tax ? $tax->amount : 0,
                    'tax_name' => $tax ? $tax->name : "",
                    'description' => $row
                );
            }
            $data['items'] = json_encode($dataArray);

            Db::run()->update(self::esTable, $data, array("id" => Filter::$id));
            Message::msgReply(Db::run()->affected(), 'success', Lang::$word->EST_UPDATED);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Content::getEstimates()
     *
     * @return
     */
    public function getEstimates()
    {
        $sql = "SELECT * FROM `" . self::esTable . "`
				ORDER BY created DESC;";

        $row = Db::run()->pdoQuery($sql)->results();
        return ($row) ? $row : 0;
    }

    /**
     * Content::getEstimatesByGroup()
     *
     * @return
     */
    public function getEstimatesByGroup()
    {
        $sql = "SELECT es.*, YEAR(es.created) as cdate FROM	`" . self::esTable . "` AS es
				WHERE es.status BETWEEN 2 AND 3
				ORDER BY es.created DESC;";

        $row = Db::run()->pdoQuery($sql)->results();
        return ($row) ? $row : 0;
    }

    /**
     * Content::sendEstimate()
     *
     * @return
     */
    public function sendEstimate()
    {
        $rules = array(
            'recepients' => array('required|string', Lang::$word->INV_SELREC),
        );

        $filters = array(
            'message' => 'string',
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
            $tpl = Db::run()->first(self::eTable, array("body", "subject"), array('typeid' => 'estimateMessage'));

            $recepients = Validator::sanitize($_POST['recepients']);
            $userrow = Db::run()->pdoQuery("SELECT email, CONCAT(fname,' ',lname) as name FROM `" . Users::mTable . "` WHERE id IN($recepients)")->results();


            $replacements = array();
            if ($userrow) {
                $row = Db::run()->first(self::esTable, null, array("id" => Filter::$id));
                $title = "estimate-" . $row->title . "-from_" . $core->company;

                ob_start();
                require_once(ADMINBASE . '/snippets/Pdf_Estimate.tpl.php');
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
                        '[TITLE]' => $row->title,
                        '[CLIENT]' => $row->company_name,
                        '[AMOUNT]' => Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency),
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
                Db::run()->update(self::esTable, array("status" => 1, "sent_on" => Db::toDate()), array("id" => Filter::$id));

                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = $numSent . ' ' . Lang::$word->EMN_SENT;
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
     * Content::estimateStatus()
     *
     * @param mixed $status
     * @return
     */
    public static function estimateStatus($status)
    {
        switch ($status) {

            case 3:
                return '<span class="wojo small positive label">' . Lang::$word->EST_WON . '</span>';

            case 2:
                return '<span class="wojo small negative label">' . Lang::$word->EST_LOST . '</span>';

            case 1:
                return '<span class="wojo small black label">' . Lang::$word->INV_SENT . '</span>';

            default:
                return '<span class="wojo small label">' . Lang::$word->EST_DRAFT . '</span>';
        }
    }
}
