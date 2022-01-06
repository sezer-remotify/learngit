<?php

/**
 * Authentication Class
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: auth.class.php, v1.00 2019-06-05 10:12:05 gewa Exp $
 */

if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');

class Auth
{
    public $logged_in = 0;
    public $is_completed = 0;
    public $uid = 0;
    public $username;
    public $sesid;
    public $email;
    public $name;
    public $fname;
    public $lname;
    public $company;
    public $country;
    public $avatar;
    public $usertype = null;
    public $cv = null;
    public $userlevel = 0;
    public $lastlogin;
    public $lastip;
    public $acl = array();
    public $access = null;
    public static $userdata = array();
    public static $udata = array();

    /**
     * Auth::__construct()
     *
     * @return
     */
    public function __construct()
    {
        $this->logged_in = $this->loginCheck();

        if (!$this->logged_in) {
            $this->username = App::Session()->set('WFM_username', '');
            $this->sesid = sha1(session_id());
            $this->userlevel = 0;
        }
    }

    /**
     * Auth::loginCheck()
     *
     * @return
     */
    private function loginCheck()
    {
        $session = App::Session();
        if ($session->isExists('WFM_username') and $session->get('WFM_username') != "") {
            $this->uid = $session->get('userid');
            $this->username = $session->get('WFM_username');
            $this->email = $session->get('email');
            $this->fname = $session->get('fname');
            $this->lname = $session->get('lname');
            $this->name = $session->get('fname') . ' ' . $session->get('lname');
            $this->country = $session->get('country');
            $this->company = $session->get('company');
            $this->avatar = $session->get('avatar');
            $this->lastlogin = $session->get('lastlogin');
            $this->lastip = $session->get('lastip');
            $this->cv = $session->get('cv');
            $this->sesid = sha1(session_id());
            $this->usertype = $session->get('type');
            $this->userlevel = $session->get('userlevel');
            $this->acl = $session->get('acl');
            $this->access = $session->get('access');
            $this->is_completed = $session->get('is_completed');
            self::$userdata = $session->get('userdata');
            self::$udata = $this;

            return true;
        } else {
            return false;
        }
    }

    /**
     * Auth::is_Admin()
     *
     * @return
     */
    public function is_Admin()
    {
        $level = array(9, 8, 7);
        return (in_array($this->userlevel, $level));
    }

    /**
     * Auth::is_User()
     *
     * @return
     */
    public function is_User()
    {
        $level = array(1);
        return (in_array($this->userlevel, $level) and $this->usertype == "member");
    }

    /**
     * Auth::is_Freelancer()
     *
     * @return
     */
    public function is_Freelancer($userlevel = 0, $usertype = '', $auto = true)
    {
        if ($auto) {
            $userlevel = $this->userlevel;
            $usertype = $this->usertype;
        }
        $level = array(21);
        return (in_array($userlevel, $level) and $usertype == "freelancer");
    }

    /**
     * Auth::is_Client()
     *
     * @return
     */
    public function is_Client($userlevel = 0, $usertype = '', $auto = true)
    {
        if ($auto) {
            $userlevel = $this->userlevel;
            $usertype = $this->usertype;
        }
        $level = array(20);
        return (in_array($userlevel, $level) and $usertype == "client");
    }

    /**
     * Auth::is_Verified()
     *
     * @param mixed $username
     * @return
     */
    public function is_Verified($email)
    {
        $where = array('email =' => $email);
        $row = Db::run()->first(Users::mTable, array(
            'active',
            'invite_token'
        ), $where);

        if ($row && ($row->active === "y" && ($row->invite_token === "" || $row->invite_token == NULL))) return true;
        else return false;
    }

    /**
     * Auth::login()
     *
     * @param mixed $username
     * @param mixed $password
     * @param bool $auto
     * @return
     */
    public function login($username, $password, $auto = true)
    {
        $json['registration'] = false;
        if ($username == "" && $password == "") {
            $json['message'] = Lang::$word->LOGIN_R5;
        } else {
            $status = $this->checkStatus($username, $password);

            switch ($status) {
                case "e":
                    $json['message'] = Lang::$word->LOGIN_R1;
                    break;

                case "b":
                    $json['message'] = Lang::$word->LOGIN_R2;
                    break;

                case "n":
                    $json['message'] = Lang::$word->LOGIN_R3;
                    break;

                case "t":
                    $json['message'] = Lang::$word->LOGIN_R4;
                    break;
            }
        }
        //check if freelancer or client hasn't finished their registration
        if ($username && $password && $status && $status !== 'e') {
            $row = $this->getUserInfo($username);
            if ($row->userlevel == 0 || $row->type === "undefined") {
                $json['registration'] = true;
                $json['redirect'] = 'type';
                $json['message'] = Lang::$word->DASH_INFO_5;
                if (!empty($row->invite_token) || $row->active === "t") {
                    $json['redirect'] = 'verification';
                } else if ($row->username === "" || $row->username === NULL) {
                    $json['redirect'] = 'username';
                }
            }
        }


        if (empty($json['message']) && $status == "y" && $row->userlevel != 0 && $row->type !== "undefined") {
            $session = App::Session();
            $this->uid = $session->set('userid', $row->id);
            $this->username = $session->set('WFM_username', $row->username);
            $this->fullname = $session->set('fullname', $row->fname . ' ' . $row->lname);
            $this->fname = $session->set('fname', $row->fname);
            $this->lname = $session->set('lname', $row->lname);
            $this->email = $session->set('email', $row->email);
            $this->country = $session->set('country', $row->country);
            $this->company = $session->set('company', $row->company);
            $this->userlevel = $session->set('userlevel', $row->userlevel);
            $this->usertype = $session->set('type', $row->type);
            $this->avatar = $session->set('avatar', $row->avatar);
            $this->cv = $session->set('cv', $row->cv);
            $this->is_completed = $session->set('is_completed', $row->is_completed);
            $this->lastlogin = $session->set('lastlogin', Db::toDate());
            $this->lastip = $session->set('lastip', Url::getIP());

            $result = self::getAcl($row->type);
            $privileges = array();
            for ($i = 0; $i < count($result); $i++) {
                $privileges[$result[$i]->code] = ($result[$i]->active == 1) ? true : false;
            }
            $this->acl = $session->set('acl', $privileges);

            $data = array('lastlogin' => Db::toDate(), 'lastip' => Validator::sanitize(Url::getIP()));
            Db::run()->update(Users::mTable, $data, array('id' => $row->id));
            self::$userdata = $session->set('userdata', $row);
            $this->access = $session->set('access', self::getPermissions($row->id));
            self::setUserCookies($session->get('WFM_username'), $session->get('fullname'), $session->get('avatar'));


            //specify redirect page based on user type
            $json['redirect'] = '/dashboard/';
            if (in_array($row->userlevel, array(9, 8, 7))) {
                $json['redirect'] = "/admin/";
            } else if (in_array($row->userlevel, array(21)) and $row->type === "freelancer") {
                if ($row->is_completed)
                    $json['redirect'] = "/master/";
                else  $json['redirect'] = "/master/profile/complete";
            } else if (in_array($row->userlevel, array(20)) and $row->type === "client") {

                if ($row->is_completed) {
                    if (Db::run()->first(Project::pxTable, array('user_id'), array('user_id' => $row->id)))
                        $json['redirect'] = "/master/";
                    else  $json['redirect'] = "/master/projects/new";
                } else $json['redirect'] = "/master/profile/edit";
            }


            $json['type'] = "success";
            $json['title'] = Lang::$word->SUCCESS;
        } else {
            $json['type'] = ($json['registration']) ? "alert" : "error";
            $json['title'] = ($json['registration']) ? Lang::$word->ALERT : Lang::$word->ERROR;
        }

        ($auto == true) ? print json_encode($json) : null;
    }

    /**
     * Auth::login()
     *
     * @param mixed $username
     * @param mixed $password
     * @param bool $auto
     * @return
     */
    public function register($username, $password, $agreement, $auto = true)
    {
        $username = Validator::sanitize($username, "email", 60);
        $password = Validator::sanitize($password, "default", 20);


        $rules = array(
            'email' => array('required|email|min_len,10|max_len,70', Lang::$word->EMAIL),
            'password' => array('required|string|min_len,6|max_len,30', Lang::$word->PASSWORD),
            'agreement' => array('checked', Lang::$word->USER_AGREEMENT),
        );


        $validate = Validator::instance();
        $safe = $validate->doValidate(array('email' => $username, 'password' => $password, 'agreement' => $agreement), $rules);
        if (empty(Message::$msgs)) {
            if ($this->emailExists($username)) $json['message'] = Lang::$word->EMAIL_R2;

            if (empty($json['message'])) {
                $salt = '';
                $hash = $this->create_hash(Validator::cleanOut($safe->password), $salt);

                $dataArray[] = array(
                    'email' => $safe->email,
                    'status' => 1,
                    'active' => "t",
                    'hash' => $hash,
                    'salt' => $salt,
                    'userlevel' => 0,
                    'type' => 'undefined',
                    'invite_on' => Db::toDate(),
                    'invite_token' => Utility::randomString(32)
                );
                $last_id = Db::run()->insertBatch(Users::mTable, $dataArray)->getAllLastInsertId();

                $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'emailVerify'));
                $mailer = Mailer::sendMail();
                $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                $replacements = array();
                $numSent = 0;
                $failedRecipients = array();

                $core = App::Core();
                $userrow = Db::run()->pdoQuery("SELECT email, invite_token FROM `" . Users::mTable . "` WHERE id IN(" . Utility::implodeFields($last_id) . ")")->results();

                foreach ($userrow as $cols) {
                    $replacements[$cols->email] = array(
                        '[LOGO]' => Utility::getLogo(),
                        '[EMAIL]' => $cols->email,
                        '[DATE]' => date('Y'),
                        '[COMPANY]' => $core->company,
                        '[VERIFYURL]' => Url::url('/verify', $cols->invite_token),
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
                foreach ($userrow as $row) {
                    $message->setTo(array($row->email));
                    $numSent++;
                    $mailer->send($message, $failedRecipients);
                }
                unset($row);

                if ($numSent) {
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->MAC_SENDVER_OK;
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
            } else {
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
            }

            ($auto == true) ? print json_encode($json) : null;
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Auth::checkStatus()
     *
     * @param mixed $username
     * @param mixed $pass
     * @return
     */
    public function checkStatus($username, $pass)
    {

        $username = Validator::sanitize($username, "default", 60);
        $pass = Validator::sanitize($pass, "default", 20);

        $where = array('username =' => $username, 'or email =' => $username);
        $row = Db::run()->first(Users::mTable, array(
            'salt',
            'hash',
            'active'
        ), $where);

        if (!$row)
            return "e";

        $validpass = $this->_validate_login($pass, $row->hash, $row->salt);

        if (!$validpass)
            return "e";

        switch ($row->active) {
            case "b":
                return "b";
                break;

            case "n":
                return "n";
                break;

            case "t":
                return "t";
                break;

            case "y" and $validpass == true:
                return "y";
                break;
        }
    }

    /**
     * Auth::checkStatus()
     *
     * @param mixed $username
     * @return
     */
    public function checkRegisterationStatus($username)
    {

        $username = Validator::sanitize($username, "email", 60);

        $row = $this->getUserInfo($username);

        if (!$row)
            return "n";


        switch ($row->active) {
            case "b":
                return "b";
                break;

            case "n":
                return "n";
                break;

            case "t":
                return "t";
                break;

            case "y":
                return "y";
                break;
        }
    }

    /**
     * Auth::checkVerification()
     *
     * @param mixed $username
     * @return
     */
    public function checkVerification($username, $password, $mail = false)
    {
        $username = Validator::sanitize($username, "email", 60);
        $password = Validator::sanitize($password, "default", 60);

        $rules = array(
            'email' => array('required|email|min_len,8|max_len,70', Lang::$word->EMAIL),
        );


        $validate = Validator::instance();
        $safe = $validate->doValidate(array('email' => $username), $rules);

        if (empty(Message::$msgs)) {
            $row =  Db::run()->select(Users::mTable, array('salt', 'hash', 'email', 'invite_token'), array("email" => $safe->email))->result();
            if (!$row || !$this->_validate_login($password, $row->hash, $row->salt))
                Message::$msgs['name'] = Lang::$word->LOGIN_R6;
        }

        if (empty(Message::$msgs)) {
            if ($this->is_Verified($safe->email)) {
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
            } else {
                if ($mail && $mail === 'true') {
                    $mailer = Mailer::sendMail();
                    $core = App::Core();
                    $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'emailVerify'));
                    $body = str_replace(array(
                        '[LOGO]',
                        '[EMAIL]',
                        '[DATE]',
                        '[COMPANY]',
                        '[VERIFYURL]',
                        '[SITEURL]',
                        '[CEMAIL]',
                        '[FB]',
                        '[TW]'
                    ), array(
                        Utility::getLogo(),
                        $row->email,
                        date('Y'),
                        $core->company,
                        Url::url('/verify', $row->invite_token),
                        SITEURL,
                        $core->site_email,
                        $core->social->facebook,
                        $core->social->twitter
                    ), $tpl->body);

                    $msg = Swift_Message::newInstance()
                        ->setSubject(str_replace("[COMPANY]", $core->company, $tpl->subject))
                        ->setTo(array($row->email))
                        ->setFrom(array($core->site_email => $core->company))
                        ->setBody($body, 'text/html');

                    if ($mailer->send($msg)) {
                        $json['type'] = 'success';
                        $json['title'] = Lang::$word->SUCCESS;
                        $json['message'] = Lang::$word->MAC_SENDVER_OK;
                    } else {
                        $json['type'] = 'error';
                        $json['title'] = Lang::$word->ERROR;
                        $json['message'] = Lang::$word->EMN_ALERT1;
                    }
                } else {
                    $json['message'] = Lang::$word->LOGIN_R4;
                    $json['type'] = "error";
                    $json['title'] = Lang::$word->ERROR;
                }
            }
            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Auth::setUsername()
     *
     * @param mixed $email
     * @param mixed $username
     * @return
     */
    public function setUsername($email, $username, $password)

    {
        $email = Validator::sanitize($email, "email", 60);
        $username = Validator::sanitize($username, "default", 20);
        $password = Validator::sanitize($password, "default", 60);

        $rules = array(
            'email' => array('required|email|min_len,10|max_len,70', Lang::$word->EMAIL),
            'username' => array('required|alpha_numeric|min_len,6|max_len,40', Lang::$word->USERNAME),
        );


        $validate = Validator::instance();
        $safe = $validate->doValidate(array('email' => $email, 'username' => $username), $rules);

        if (empty(Message::$msgs)) {
            $row =  Db::run()->select(Users::mTable, array('salt', 'hash'), array("email" => $safe->email))->result();
            if (!$row || !$this->_validate_login($password, $row->hash, $row->salt))
                Message::$msgs['name'] = Lang::$word->LOGIN_R6;
        }

        if (empty(Message::$msgs)) {

            $usernameExist = $this->usernameExists($username);

            if ($usernameExist != 3 && $this->is_Verified($email)) {
                Db::run()->update(Users::mTable, array('username' => $safe->username), array("email" => $safe->email));
                $json['message'] = Lang::$word->USERNAME_UP;
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
            } else {
                $json['message'] = Lang::$word->LOGIN_R4;
                if ($usernameExist == 3) $json['message'] = Lang::$word->USERNAME_R4;
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
            }
            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Auth::setType()
     *
     * @param mixed $email
     * @param mixed $type
     * @return
     */
    public function setType($email, $type, $password)

    {
        $email = Validator::sanitize($email, "default", 60);
        $type = Validator::sanitize($type, "default", 20);
        $password = Validator::sanitize($password, "default", 60);

        $rules = array(
            'email' => array('required|string|min_len,6|max_len,70', Lang::$word->EMAIL),
            'type' => array('required|string|min_len,4|max_len,4', Lang::$word->TYPE),
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate(array('email' => $email, 'type' => $type), $rules);
        if (empty(Message::$msgs)) {
            if ($type === "hire") {
                $userlevel = 20;
                $safe->type = "client";
            } else if ($type === "work") {
                $userlevel = 21;
                $safe->type = "freelancer";
            } else {
                $userlevel = 0;
                $safe->type = "undefined";
            }
        }


        if (empty(Message::$msgs)) {
            // $row =  Db::run()->select(Users::mTable, array('salt', 'hash'), array("email" => $safe->email, 'username' => $safe->email))->result();
            $row = $this->getUserInfo($safe->email);
            if (!$row || !$this->_validate_login($password, $row->hash, $row->salt))
                Message::$msgs['name'] = Lang::$word->LOGIN_R6;
        }

        if (empty(Message::$msgs)) {
            // $row = $this->getUserInfo($safe->email);


            if ($row->type === "undefined" && $row->userlevel == 0 && $row->username && empty($row->invite_token) && $row->active === "y") {
                Db::run()->update(Users::mTable, array('userlevel' => $userlevel, "type" => $safe->type), array("id" => $row->id));
                if ($safe->type === 'client')
                    Db::run()->insert(Master::ciTable, array('user_id' => $row->id), array("id" => $row->id));
                $json['message'] = "";
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
            } else {
                $json['message'] = Lang::$word->TYPE_R1;
                if (!$row->username) $json['message'] = Lang::$word->CHOOSE_U;
                if (!empty($row->invite_token) || $row->active !== "y") $json['message'] =  Lang::$word->LOGIN_R4;
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
            }
            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }


    /**
     * Auth::getUserInfo()
     *
     * @param mixed $username
     * @return
     */
    public function getUserInfo($username)
    {
        $username = Validator::sanitize($username, "string");
        $row = Db::run()->first(Users::mTable, null, array('username =' => $username, 'or email =' => $username));

        return ($row) ? $row : 0;
    }

    /**
     * Auth::getUserInfoById()
     *
     * @param mixed $ID
     * @return
     */
    public function getUserInfoById($id)
    {
        $id = Validator::sanitize($id, "int");
        $row = Db::run()->first(Users::mTable, null, array('id' => $id));

        return ($row) ? $row : 0;
    }


    /**
     * Auth::getPermissions()
     *
     * @return
     */
    public static function getPermissions($uid)
    {
        $sql = "SELECT GROUP_CONCAT(project_id) as projects FROM `" . Project::pxTable . "`
		  WHERE user_id = ?
		  GROUP BY user_id;";

        $row = Db::run()->pdoQuery($sql, array($uid))->result();
        return ($row) ? $row : 0;
    }

    /**
     * Auth::getAcl()
     *
     * @param mixed $role
     * @return
     */
    public static function getAcl($role = '')
    {
        $sql = "SELECT p.code, p.name, p.description, rp.active FROM `" . Users::rpTable . "` rp
			INNER JOIN `" . Users::rTable . "` r ON rp.rid = r.id
			INNER JOIN `" . Users::pTable . "` p ON rp.pid = p.id
		  WHERE r.code = ? ;";

        return Db::run()->pdoQuery($sql, array($role))->results();
    }

    /**
     * Auth::hasPrivileges()
     *
     * @param mixed $code
     * @param mixed $val
     * @return
     */
    public static function hasPrivileges($code = '', $val = '')
    {
        $privileges_info = App::Session()->get('acl');
        if (!empty($val)) {
            if (isset($privileges_info[$code]) && is_array($privileges_info[$code])) {
                return in_array($val, $privileges_info[$code]);
            } else {
                return ($privileges_info[$code] == $val);
            }
        } else {
            return (isset($privileges_info[$code]) && $privileges_info[$code] == true) ? true : false;
        }
    }

    /**
     * Auth::logout()
     *
     * @return
     */
    public function logout()
    {
        App::Session()->endSession();
        $this->logged_in = false;
        $this->username = "Guest";
        $this->userlevel = 0;
    }

    /**
     * Auth::usernameExists()
     *
     * @param mixed $username
     * @return
     */
    public static function usernameExists($username)
    {
        $username = Validator::sanitize($username, "string");
        if (strlen($username) < 4)
            return 1;

        //Username should contain only alphabets, numbers, or underscores.Should be between 4 to 15 characters long
        $valid_uname = "/^[a-zA-Z0-9_]{4,15}$/";
        if (!preg_match($valid_uname, $username))
            return 2;

        $row = Db::run()->select(Users::mTable, array('username'), array('username' => $username), 'LIMIT 1')->result();

        return ($row) ? 3 : false;
    }

    /**
     * Auth::emailExists()
     *
     * @param mixed $email
     * @return
     */
    public static function emailExists($email)
    {
        $row = Db::run()->select(Users::mTable, array('email'), array('email' => $email), ' LIMIT 1')->result();

        if ($row) {
            return true;
        } else
            return false;
    }

    /**
     * Auth::checkAcl()
     *
     * @return
     */
    public static function checkAcl()
    {

        $acctypes = func_get_args();
        foreach ($acctypes as $type) {
            $args = explode(',', $type);
            foreach ($args as $arg) {
                if (App::Auth()->usertype == $arg)
                    return true;
            }
        }
        return false;
    }

    /**
     * Auth::setUserCookies()
     *
     * @param mixed $username
     * @param mixed $name
     * @param mixed $avatar
     * @return
     */
    public static function setUserCookies($username, $name, $avatar)
    {
        $avatar = empty($avatar) ? "blank.png" : $avatar;
        setcookie("WFM_loginData[0]", $username, strtotime('+30 days'));
        setcookie("WFM_loginData[1]", $name, strtotime('+30 days'));
        setcookie("WFM_loginData[2]", $avatar, strtotime('+30 days'));
    }

    /**
     * Auth::getUserCookies()
     *
     * @return
     */
    public static function getUserCookies()
    {
        if (isset($_COOKIE['WFM_loginData'])) {
            $data = array(
                'username' => $_COOKIE['WFM_loginData'][0],
                'name' => $_COOKIE['WFM_loginData'][1],
                'avatar' => $_COOKIE['WFM_loginData'][2]
            );
            return $data;
        } else {
            return false;
        }
    }

    /**
     * Auth::generateToken()
     *
     * @return
     */
    public static function generateToken($length = 24)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }

    /**
     * Auth::create_hash()
     *
     * @param mixed $password
     * @param string $salt
     * @param integer $stretch_cost
     * @return
     */
    public function create_hash($password, &$salt = '', $stretch_cost = 10)
    {
        $salt = strlen($salt) != 21 ? $this->_create_salt() : $salt;
        if (function_exists('crypt') && defined('CRYPT_BLOWFISH')) {
            return crypt($password, '$2a$' . $stretch_cost . '$' . $salt . '$');
        }

        if (!function_exists('hash') || !in_array('sha512', hash_algos())) {
            Debug::AddMessage("errors", "hash", "You must have the PHP PECL hash module installed");
        }

        return $this->_create_hash($password, $salt);
    }


    /**
     * Auth::validate_hash()
     *
     * @param mixed $pass
     * @param mixed $hashed_pass
     * @param mixed $salt
     * @return
     */
    public function validate_hash($pass, $hashed_pass, $salt)
    {
        return $hashed_pass === $this->create_hash($pass, $salt);
    }

    /**
     * Auth::_validate_login()
     *
     * @param mixed $pass
     * @param mixed $hash
     * @param mixed $salt
     * @return
     */
    protected function _validate_login($pass, $hash, $salt)
    {
        if ($this->validate_hash($pass, $hash, $salt)) {
            return true;
        } else
            return false;
    }

    /**
     * Auth::_create_salt()
     *
     * @return
     */
    protected function _create_salt()
    {
        $salt = $this->_pseudo_rand(128);
        return substr(preg_replace('/[^A-Za-z0-9_]/is', '.', base64_encode($salt)), 0, 21);
    }

    /**
     * Auth::_pseudo_rand()
     *
     * @param mixed $length
     * @return
     */
    protected function _pseudo_rand($length)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $is_strong = false;
            $rand = openssl_random_pseudo_bytes($length, $is_strong);
            if ($is_strong === true)
                return $rand;
        }
        $rand = '';
        $sha = '';
        for ($i = 0; $i < $length; $i++) {
            $sha = hash('sha256', $sha . mt_rand());
            $chr = mt_rand(0, 62);
            $rand .= chr(hexdec($sha[$chr] . $sha[$chr + 1]));
        }
        return $rand;
    }

    /**
     * Auth::_create_hash()
     *
     * @param mixed $password
     * @param mixed $salt
     * @return
     */
    private function _create_hash($password, $salt)
    {
        $hash = '';
        for ($i = 0; $i < 20000; $i++) {
            $hash = hash('sha512', $hash . $salt . $password);
        }
        return $hash;
    }
}
