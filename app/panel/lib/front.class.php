<?php

/**
 * Front Class
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: front.class.php, v1.00 2019-04-20 18:20:24 gewa Exp $
 */

if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');

class Front
{

    /**
     * Front::__construct()
     *
     * @return
     */
    public function __construct()
    {
    }

    /**
     * Front::Index()
     *
     * @return
     */
    public function Index()
    {
        if (App::Auth()->is_User()) {
            Url::redirect(URL::url('/dashboard'));
            exit;
        }
        if (App::Auth()->is_Admin()) {
            Url::redirect(SITEURL . '/admin');
            exit;
        }

        if (App::Auth()->is_Freelancer() || App::Auth()->is_Client()) {
            Url::redirect(URL::url('/master'));
            exit;
        }

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->template = 'front/themes/' . $core->theme . '/loginNew.tpl.php';
        $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_WELCOME);
        $tpl->pageclass = "login";
        $tpl->skills = App::Content()->getSkillList();
        $tpl->loginform = true;
        $tpl->registerform = false;
    }

    /**
     * Front::Registration()
     *
     * @return
     */
    public function Registration()
    {
        if (App::Auth()->is_User()) {
            Url::redirect(URL::url('/dashboard/'));
            exit;
        }
        if (App::Auth()->is_Admin()) {
            Url::redirect(SITEURL . '/admin');
            exit;
        }
        if (App::Auth()->is_Freelancer() || App::Auth()->is_Client()) {
            Url::redirect(URL::url('/master/'));
            exit;
        }

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->template = 'front/themes/' . $core->theme . '/loginNew.tpl.php';
        $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_WELCOME);
        $tpl->pageclass = "login";
        $tpl->skills = App::Content()->getSkillList();
        $tpl->loginform = false;
        $tpl->registerform = true;
    }

    /**
     * Front::Dashboard()
     *
     * @return
     */
    public function Dashboard()
    {
        if (!App::Auth()->is_User()) {
            Url::redirect(Url::url('/'));
            exit;
        }

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->template = 'front/themes/' . $core->theme . '/dashboard.tpl.php';
        $tpl->title = Lang::$word->ACT_TITLE;
        $tpl->data = App::Users()->getAllUserActivity(Date::doDate("yyyy-MM-dd", Date::today()));
        $tpl->pageclass = "dashboard";
    }

    /**
     * Front::Join()
     *
     * @param str $token
     * @return
     */
    public function Join($token)
    {

        if (App::Auth()->is_User()) {
            Url::redirect(URL::url('/dashboard'));
            exit;
        }

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_WELCOME);

        if (!$row = Db::run()->first(Users::mTable, null, array('invite_token' => Validator::sanitize($token, "string")))) {
            $tpl->template = 'front/themes/' . $core->theme . '/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid token ($token) detected [Front.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->template = 'front/themes/' . $core->theme . '/join.tpl.php';
        }
        $tpl->pageclass = "login";
    }

    /**
     * Front::Verify()
     *
     * @param str $token
     * @return
     */
    public function Verify($token)
    {

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_WELCOME);

        if (!$row = Db::run()->first(Users::mTable, null, array('invite_token' => Validator::sanitize($token, "string")))) {
            $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
            $tpl->error = DEBUG ? "Invalid token ($token) detected [Front.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            Db::run()->update(Users::mTable, array('invite_token' => "NULL", 'active' => "y"), array("id" => $row->id));
            $tpl->template = 'front/themes/' . $core->theme . '/verify.tpl.php';
        }
        $tpl->pageclass = "login";
    }

    /**
   * Master::LinkedinCallBack()
   *
   * @return
   */
  public function LinkedinCallback()
  {

      $code = $_GET["code"];
      $urlencode = "https%3A%2F%2Fremotify.co%2Fapp%2Fpanel%2Fauth%2Flinkedin%2Fcallback";
      $param  = 'grant_type=authorization_code&code='.$code.'&redirect_uri='.$urlencode.'&client_id=78dqfnxibe34q2&client_secret=dhcEqKDwewF3Rf97';
      $url    = 'https://www.linkedin.com/uas/oauth2/accessToken';
      $ch = curl_init();
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);
      $response = json_decode($response);
      $accessToken = $response->access_token;

      curl_close($ch);

      $email = 'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))';
      $emailcrl = curl_init();

      curl_setopt($emailcrl, CURLOPT_URL, $email);
      curl_setopt($emailcrl, CURLOPT_FRESH_CONNECT, true);
      curl_setopt($emailcrl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($emailcrl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$accessToken));

      $email_response = curl_exec($emailcrl);

      $userEmail = json_decode($email_response,true);

      $userEmail = $userEmail['elements'][0]['handle~']['emailAddress'];

      curl_close($emailcrl);
      if($userEmail != "")
      {
          $rowFirst = Db::run()->select(Users::mTable,array('username') , array("email" => $userEmail))->results();
          $username= $rowFirst[0]->username;

          App::Auth()->loginLinkedin($userEmail, $username);
      }
  }

    /**
     * Front::Register()
     *
     * @param str $token
     * @return
     */
    public function Register()
    {

        $rules = array(
            'fname' => array('required|string|min_len,3|max_len,60', Lang::$word->FNAME),
            'lname' => array('required|string|min_len,3|max_len,60', Lang::$word->LNAME),
            'password' => array('required|string|min_len,6|max_len,20', Lang::$word->NEWPASS),
            'password2' => array('required|string|min_len,6|max_len,20', Lang::$word->CONPASS),
            'privacy' => array('required|numeric', Lang::$word->PRIVACY),
            'token' => array('required|string|min_len,3|max_len,60', Lang::$word->TOKEN),
        );

        $filters = array(
            'fname' => 'string',
            'lname' => 'string',
            'token' => 'string',
        );

        if ($_POST['password'] != $_POST['password2']) {
            Message::$msgs['pass'] = Lang::$word->ACC_PASSMATCH;
        }

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if (!$row = Db::run()->first(Users::mTable, null, array('invite_token' => $safe->token))) {
            Message::$msgs['token'] = Lang::$word->TOKEN;
        }

        $upl = Upload::instance(512000, "png,jpg");
        if (!empty($_FILES['avatar']['name']) and empty(Message::$msgs)) {
            $upl->process("avatar", UPLOADS . "/avatars/", "AVT_");
        }

        if (empty(Message::$msgs)) {
            $salt = '';
            $hash = App::Auth()->create_hash(Validator::cleanOut($_POST['password']), $salt);
            $username = Utility::randomString();
            $core = App::Core();

            $data = array(
                'username' => $username,
                'lname' => $safe->lname,
                'fname' => $safe->fname,
                'hash' => $hash,
                'salt' => $salt,
                'active' => "y",
                'invite_token' => "NULL"
            );

            if (isset($upl->fileInfo['fname'])) {
                $data['avatar'] = $upl->fileInfo['fname'];

                // try {
                //     $image = new Image(UPLOADS . "/avatars/" . $upl->fileInfo['fname']);
                //     $image->thumbnail(400, 400)->save(UPLOADS . "/avatars/" . $upl->fileInfo['fname']);
                // } catch (exception $e) {
                //     Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                // }
            }

            Db::run()->update(Users::mTable, $data, array("id" => $row->id));

            //login user
            App::Auth()->login($row->email, $safe->password, false);

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = Lang::$word->DASH_INFO_3;
            $json['redirect'] = Url::url('/dashboard');
            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Front::passReset()
     *
     * @return
     */
    public function passReset($admin = false)
    {

        $rules = array(
            'email' => array('required|email', Lang::$word->EMAIL),
        );


        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);

        if (!empty($safe->email)) {
            $row = ($admin == false) ?
                Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email' => $safe->email, "type" => "member", "active" => "y")) :
                Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email =' => $safe->email, "and type <>" => "member"));
            if (!$row) {
                Message::$msgs['email'] = Lang::$word->ACC_MSG40;
                $json['title'] = Lang::$word->ERROR;
                $json['message'] = Lang::$word->ACC_MSG40;
                $json['type'] = 'error';
            }
        }

        if (empty(Message::$msgs)) {
            $mailer = Mailer::sendMail();
            $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'passReset'));
            $token = substr(md5(uniqid(rand(), true)), 0, 10);

            $body = str_replace(array(
                '[LOGO]',
                '[NAME]',
                '[DATE]',
                '[COMPANY]',
                '[LINK]',
                '[IP]',
                '[SITEURL]'
            ), array(
                Utility::getLogo(),
                $row->fname . ' ' . $row->lname,
                date('Y'),
                App::Core()->company,
                Url::url('/password', $token),
                Url::getIP(),
                SITEURL
            ), $tpl->body);

            $msg = Swift_Message::newInstance()
                ->setSubject($tpl->subject)
                ->setTo(array($row->email => $row->fname . ' ' . $row->lname))
                ->setFrom(array(App::Core()->site_email => App::Core()->company))
                ->setBody($body, 'text/html');

            Db::run()->update(Users::mTable, array("token" => $token), array('id' => $row->id));
            if ($mailer->send($msg)) {
                $json['type'] = "success";
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->ACC_MSG41;
                print json_encode($json);
            }
        } else {
            $json['type'] = "error";
            $json['title'] = Lang::$word->ERROR;
            $json['message'] = Lang::$word->ACC_MSG30;
            print json_encode($json);
        }
    }

    /**
     * Front::Account()
     *
     * @return
     */
    public function Account()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->template = 'front/themes/' . $core->theme . '/myaccount.tpl.php';
        $tpl->crumbs = ['dashboard', Lang::$word->ACC_TITLE];
        $tpl->data = Db::run()->first(Users::mTable, null, array('id' => App::Auth()->uid));
        $tpl->title = Lang::$word->ACC_TITLE;
        $tpl->pageclass = "dashboard";
    }
    /**
     * Front::passwordChange()
     *
     * @return
     */
    public function passwordChange()
    {

        $rules = array(
            'token' => array('required|string|min_len,10|max_len,10', "Invalid Token"),
            'password' => array('required|string|min_len,6|max_len,20', Lang::$word->NEWPASS),
            );

        $filters = array(
            'token' => 'string',
        );

        $validate = Validator::instance();
        $safe = $validate->doValidate($_POST, $rules);
        $safe = $validate->doFilter($_POST, $filters);

        if(!$row = Db::run()->first(Users::mTable, array("id", "type"), array('token' => $safe->token))) {
            Message::$msgs['token'] = "Invalid Token.";
            $json['title'] = Lang::$word->ERROR;
            $json['message'] = "Invalid Token.";
            $json['type'] = 'error';
        }

        if (empty(Message::$msgs)) {
            $salt = '';
            $hash = App::Auth()->create_hash(Validator::cleanOut($safe->password), $salt);

            $data = array(
                  'hash' => $hash,
                  'salt' => $salt,
                  'token' => 0,
            );

            Db::run()->update(Users::mTable, $data, array("id" => $row->id));
            $json['type'] = "success";
            $json['title'] = Lang::$word->SUCCESS;
            $json['redirect'] = ($row->type == "member") ? Url::url('') : Url::url('/admin');
            $json['message'] = Lang::$word->ACC_PASSUPDATED;
            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }


    /**
     * Front::updateAccount()
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
       * Front::passwordUpdate()
       *
	   * @param string $token
       * @return
       */
      public function passwordUpdate($token)
      {
        if (App::Auth()->is_User()) {
            Url::redirect(URL::url('/dashboard'));
            exit;
        }
        if (App::Auth()->is_Admin()) {
            Url::redirect(SITEURL . '/admin');
            exit;
        }

        if (App::Auth()->is_Freelancer() || App::Auth()->is_Client()) {
            Url::redirect(URL::url('/master'));
            exit;
        }

		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
          $tpl->title = Lang::$word->NEWPASS;
		  $tpl->pageclass = "login";

          if (!$row = Db::run()->first(Users::mTable, null, array("token" => $token))) {
			  $tpl->dir = "front/";
			  $tpl->data = null;
			  $tpl->title = Lang::$word->META_ERROR;
              $tpl->template = "front/404.tpl.php";
              DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid token detected [front.class.php, ln.:" . __line__ . "] slug [" . $token ."]", "session") : Lang::$word->META_ERROR;
          } else {
			  $tpl->row = $row;
			  $tpl->template = 'front/themes/' . $core->theme . '/password.tpl.php';
          }
      }
    /**
     * Front::Password()
     *
     * @return
     */
    public function Password()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->template = 'front/themes/' . $core->theme . '/mypassword.tpl.php';
        $tpl->crumbs = ['dashboard', array(0 => Lang::$word->NAV_14, 1 => Lang::$word->NAV_15), Lang::$word->NAV_13];
        $tpl->title = Lang::$word->ACC_PASS_CHANGE;
        $tpl->pageclass = "dashboard";
    }

    /**
     * Front::updatePassword()
     *
     * @return
     */
    public function updatePassword()
    {

        $rules = array(
            'password' => array('required|string|min_len,6|max_len,25', Lang::$word->NEWPASS),
            'password2' => array('required|string|min_len,6|max_len,25', Lang::$word->CONPASS),
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
     * Front::Projects()
     *
     * @return
     */
    public function Projects()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->template = 'front/themes/' . $core->theme . '/projects.tpl.php';
        $tpl->title = Lang::$word->PRJ_PROJECTS;
        $tpl->data = App::Project()->getProjectsByPermissions();
        $tpl->labels = Utility::jSonToArray($core->prjlabels);
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25];
        $tpl->pageclass = "dashboard";
    }

    /**
     * Front::ProjectTasks()
     *
     * @param int $id
     * @return
     */
    public function ProjectTasks($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->PRJ_SUB12;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_27];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'admin/error.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Front.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->stats = Stats::getTaskStatus($id);
            $tpl->taskdata = App::Task()->getAllTasks(1, $id);
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/project_tasks.tpl.php';
        }
    }

    /**
     * Front::Archive()
     *
     * @return
     */
    public function Archive()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->PRJ_SUB9;

        $tpl->data = App::Project()->getProjectsByPermissions(4);
        $tpl->companies = App::Company()->getCompanies();
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_20];
        $tpl->template = 'front/themes/' . $tpl->core->theme . '/project_archive.tpl.php';
        $tpl->pageclass = "dashboard";
    }

    /**
     * Front::Invoices()
     *
     * @return
     */
    public function Invoices()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->INV_INVOICES;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_17];
        $tpl->pageclass = "dashboard";

        $tpl->rows =  Db::run()->select(Project::ivTable, null, array("company_id" => App::Auth()->company, "recurring" => 0))->results();
        $tpl->data = Utility::groupToLoop($tpl->rows, "pstatus");
        $tpl->template = 'front/themes/' . $tpl->core->theme . '/invoices.tpl.php';
    }

    /**
     * Front::InvoiceView()
     *
     * @return
     */
    public function InvoiceView($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->INV_INVOICES;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_17, Lang::$word->NAV_19];
        $tpl->pageclass = "dashboard";

        if (!$row = Db::run()->first(Project::ivTable, null, array("company_id" => App::Auth()->company, "recurring" => 0, "id" => $id))) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->payments = $row->pstatus ? App::Project()->getInvoicePayments($row->id) : null;
            $tpl->company = Db::run()->first(Company::cTable, null, array('owner' => 1));
            $tpl->data = App::Project()->getInvoiceEntries($row->id);
            $tpl->gateways = Db::run()->select(Admin::gTable, null, null, 'ORDER BY name')->results();
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/invoices.tpl.php';
        }
    }

    /**
     * Front::Estimates()
     *
     * @return
     */
    public function Estimates()
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->ADM_ESTIMATES;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_22];
        $tpl->pageclass = "dashboard";

        $tpl->rows =  Db::run()->select(Content::esTable, null, array("company_id" => App::Auth()->company))->results();
        $tpl->data = Utility::groupToLoop($tpl->rows, "status");
        $tpl->template = 'front/themes/' . $tpl->core->theme . '/estimates.tpl.php';
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
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->ADM_ESTIMATES;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_22, Lang::$word->NAV_19];
        $tpl->pageclass = "dashboard";

        if (!$row = Db::run()->first(Content::esTable, null, array("company_id" => App::Auth()->company, "id" => $id))) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = Utility::jSonToArray($row->items);
            $tpl->company = Db::run()->first(Company::cTable, null, array('owner' => 1));
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/estimates.tpl.php';
        }
    }

    /**
     * Front::Task()
     *
     * @param int $pid
     * @param int $id
     * @return
     */
    public function Task($pid, $id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->PRJ_SUB12;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_26];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $pid) or !$task = App::Task()->getTaskById($id, 1)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $pid . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->task = $task;
            if ($tpl->task) {
                $tpl->filedata = App::Project()->getFiles("task_id", $tpl->task->id);
                $tpl->messages = App::Comments()->TaskMessages("task", $tpl->task->id);
            }
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/task.tpl.php';
        }
    }

    /**
     * Front::TaskCompleted($id)
     *
     * @param int $id
     * @return
     */
    public function TaskCompleted($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->PRJ_SUB12;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_27];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = App::Task()->getAllTasks(3, $tpl->row->id);
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/task_completed.tpl.php';
        }
    }

    /**
     * Front::ProjectDiscussions()
     *
     * @param int $id
     * @return
     */
    public function ProjectDiscussions($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->MSG_TITLE4;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_28];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->data = App::Comments()->Discussions($id, 1, true);
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/project_discussions.tpl.php';
        }
    }

    /**
     * Front::ViewDiscussion()
     *
     * @param int $pid
     * @param int $id
     * @return
     */
    public function ViewDiscussion($pid, $id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->MSG_TITLE4;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_28, 1 => "discussions/" . $pid), Lang::$word->NAV_19];
        $tpl->pageclass = "dashboard";

        if (!$prow = App::Project()->getProjectByPermissions(1, $pid) or !$row = Db::run()->first(Comments::mTable, null, array('id' => $id, 'type_id' => $pid, 'status' => 1, 'is_hidden' => 0))) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->prow = $prow;
            if ($row) {
                $tpl->row = $row;
                $tpl->data = App::Comments()->Messages($tpl->row->id, 1, true);
                $tpl->messageusers = App::Project()->getSubscribedUsers("message_id", $tpl->row->id);
                $tpl->filedata = App::Project()->getFiles("comment_id", $tpl->row->id);
            }

            $tpl->template = 'front/themes/' . $tpl->core->theme . '/project_discussions.tpl.php';
        }
    }

    /**
     * Front::SaveDiscussion()
     *
     * @param int $id
     * @return
     */
    public function SaveDiscussion($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->MSG_TITLE4;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_28];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/project_discussions.tpl.php';
        }
    }

    /**
     * Front::ProjectFiles()
     *
     * @param int $id
     * @return
     */
    public function ProjectFiles($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->FMG_TITLE;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_38];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->result = App::Project()->getFilesByProject($row->id, false);
            $tpl->data = Utility::groupToLoop($tpl->result, "fdate");
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/files.tpl.php';
        }
    }

    /**
     * Front::ProjectNotes()
     *
     * @param int $id
     * @return
     */
    public function ProjectNotes($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->PRJ_TITLE2;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_39];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->data = Db::run()->select(Project::nTable, null, array("project_id" => $id))->results();
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/notes.tpl.php';
        }
    }

    /**
     * Front::ProjectNotesNew()
     *
     * @param int $pid
     * @param int $id
     * @return
     */
    public function ProjectNotesView($pid, $id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->PRJ_TITLE2;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_39];
        $tpl->pageclass = "dashboard";

        if (!$prow = App::Project()->getProjectByPermissions(1, $pid)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } elseif (!$row = Db::run()->first(Project::nTable, null, array('id' => $id, 'project_id' => $pid))) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $pid . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $pid), Lang::$word->NAV_19];
            $tpl->row = $row;
            $tpl->prow = $prow;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->filedata = App::Project()->getFiles("note_id", $id);
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/notes.tpl.php';
        }
    }

    /**
     * Front::ProjectNotesNew()
     *
     * @param int $id
     * @return
     */
    public function ProjectNotesNew($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->PRJ_TITLE2;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_39];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $id), Lang::$word->NAV_18];
            $tpl->row = $row;
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/notes.tpl.php';
        }
    }

    /**
     * Front::ProjectTimeRecords()
     *
     * @param int $id
     * @return
     */
    public function ProjectTimeRecords($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->INV_SUB5_1;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_40];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);

            $tpl->stats = Stats::getProjectTimeRecords($row->id);
            $tpl->total_hours = Utility::decimalToHour(Stats::doArraySum($tpl->stats, "total_hours"));
            $tpl->total_amount = Stats::doArraySum($tpl->stats, "total_amount");
            $tpl->sub_total = Stats::doArraySum($tpl->stats, "sub_amount");
            $tpl->grand_total = ($row->expenses + $tpl->sub_total);
            $tpl->data = Utility::groupToLoop(App::Project()->getProjectTimeRecords($row->id), "trdate");
            $tpl->pheader = Utility::renderTimeRecordHeader();
            $dates = iterator_to_array($tpl->pheader);
            $tpl->results = App::Project()->getProjectTimeRecords($id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/time.tpl.php';
        }
    }

    /**
     * Front::ProjectExpenseRecords()
     *
     * @param int $id
     * @return
     */
    public function ProjectExpenseRecords($id)
    {

        $tpl = App::View(BASEPATH . 'view/');
        $tpl->core = App::Core();
        $tpl->dir = "front/themes/" . $tpl->core->theme . "/";
        $tpl->title = Lang::$word->EXP_TITLE;
        $tpl->crumbs = ['dashboard', Lang::$word->NAV_25, Lang::$word->NAV_36];
        $tpl->pageclass = "dashboard";

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
            DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid ID detected [front.class.php, ln.:" . __line__ . "] id ['<b>" . $id . "</b>']") : Lang::$word->META_ERROR;
        } else {
            $tpl->row = $row;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);

            $tpl->stats = Stats::getProjectTimeRecords($row->id);
            $tpl->total_hours = Utility::decimalToHour(Stats::doArraySum($tpl->stats, "total_hours"));
            $tpl->total_amount = Stats::doArraySum($tpl->stats, "total_amount");
            $tpl->sub_total = Stats::doArraySum($tpl->stats, "sub_amount");
            $tpl->grand_total = ($row->expenses + $tpl->sub_total);

            $tpl->data = Utility::groupToLoop(App::Project()->getProjectExpenseRecords($row->id), "trdate");
            $tpl->pheader = Utility::renderTimeRecordHeader();
            $dates = iterator_to_array($tpl->pheader);
            $tpl->results = App::Project()->getProjectExpenseRecords($id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
            $tpl->currency = ($tpl->row->currency) ? $tpl->row->currency  : $tpl->core->currency;
            $tpl->template = 'front/themes/' . $tpl->core->theme . '/expenses.tpl.php';
        }
    }

    /**
     * Front::Calendar()
     *
     * @return
     */
    public function Calendar()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "front/themes/" . $core->theme . "/";
        $tpl->template = 'front/themes/' . $core->theme . '/calendar.tpl.php';
        $tpl->title = Lang::$word->CAL_CALENDAR;
        $tpl->data = App::Content()->getCalendars();
        $tpl->pageclass = "dashboard";
    }
}
