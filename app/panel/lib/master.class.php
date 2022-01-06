<?php

/**
 * Master Class
 *
 * @package Wojo Framework
 * @author https://ilyaskohistani.github.io/
 * @copyright 2021
 * @version $Id: master.class.php, v1.00 2021-04-20 18:20:24 gewa Exp $
 */

if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');

class Master
{

    const ciTable = "client_info";
    const bTable = "bids";
    const bmTable = "bid_milestones";

    /**
     * Master::__construct()
     *
     * @return
     */
    public function __construct()
    {
    }

    /**
     * Master::Index()
     *
     * @return
     */
    public function Index()
    {

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->template = 'master/maintainance.tpl.php';
        $tpl->title = Lang::$word->DASH;
    }



    /**
     * Master::Index()
     *
     * @return
     */
    public function ProjectView($id)
    {

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->template = 'master/projects.tpl.php';
        $tpl->title = Lang::$word->PRJ_SUB7;
        $tpl->row = Db::run()->first(Project::pTable, null, array('id' => intval($id)));
        $tpl->uRow = App::Auth()->getUserInfoById($tpl->row->created_by_id);
        $tpl->puRow = Db::run()->select(Project::pxTable, array('user_id'), array('project_id' => intval($id)))->results();
        $tpl->files = Db::run()->select(Project::fTable, null, array("project_id" => $id), ' AND `parent` IS NULL ORDER BY id')->results();
        $tpl->skills = $this->getProjectSkills($id);
        $tpl->budget = Db::run()->select(Project::bTable, array('minimum', 'type', 'maximum'), array('id' => intval($tpl->row->budget_type_id)))->result();
        if ($tpl->row->budget_type_id == 16) {
            $tpl->budget->minimum = $tpl->row->minimum_budget;
            $tpl->budget->maximum = $tpl->row->maximum_budget;
            $tpl->budget->type = $tpl->row->project_type;
        }

        $tpl->isProjectBased =  false;
        if (strtolower($tpl->row->work_type) === 'project based')
            $tpl->isProjectBased =  true;


        $bid = Db::run()->first(self::bTable, null, array('project_id' => intval($tpl->row->id), 'user_id' => App::Auth()->uid));
        $tpl->bid =  ($bid) ? $bid : null;
        $tpl->milestone = null;
        if ($tpl->isProjectBased && $bid) {
            $milestone = Db::run()->select(self::bmTable, array('task', 'amount'), array('project_id' => intval($tpl->row->id), 'bid_id' => $bid->id), ' ORDER BY milestone_order')->results();
            $tpl->milestone =  ($milestone) ? $milestone : null;
        }
    }

    /**
     * Front::PostProjectIndex()
     *
     * @return
     */
    public function ProjectNew()
    {

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->template = 'master/projects.tpl.php';
        $tpl->title =  Lang::$word->ADDPROJECT;
        $tpl->skills = App::Content()->getSkillList();
        $tpl->budgets = App::Content()->getBudgetList();
        $tpl->isLoggedIn = App::Auth()->logged_in;
    }

    /**
     * Master::ViewAs()
     *
     * @return
     */
    public function ViewAs($username)
    {

        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->template = 'master/profile.tpl.php';
        if (!$row = App::Auth()->getUserInfo($username)) {
            $tpl->template = 'admin/404.tpl.php';
            $tpl->title = Lang::$word->ERROR;
        } else {
            $tpl->row = $row;
            $tpl->title = ucwords($tpl->row->fname);
            $tpl->irow = Db::run()->first(self::ciTable, null, array('user_id' => intval($tpl->row->id)));
            $tpl->skills = $this->getUserSkills($tpl->row->id);
            $tpl->languages = $this->getUserLanguages($tpl->row->id);
            $tpl->countries = App::Content()->getCountryList("name");
        }
    }

    /**
     * Master::Signup()
     * freelancer signup
     * @return
     */
    public function Signup()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->template = 'master/profile.tpl.php';

        $tpl->title = Lang::$word->FREELANCER_SIGNUP;
        $tpl->skills = App::Content()->getSkillList();
        $tpl->languages = App::Content()->getLanguageList();
        $tpl->countries = App::Content()->getCountryList("name");


    }

    /**
     * Master::ProfileEdit()
     * freelancer profile edit
     * @return
     */
    public function PorfileEdit()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->template = 'master/profile.tpl.php';
        $tpl->title = Lang::$word->ACC_TITLE;
        $tpl->skills = App::Content()->getSkillList();
        $tpl->languages = App::Content()->getLanguageList();
        $tpl->countries = App::Content()->getCountryList("name");
        $tpl->row = App::Auth()->getUserInfo(Auth::$udata->username);
        $tpl->uSkills = $this->getUserSkills($tpl->row->id);
        $tpl->references = App::Content()->getReferences($tpl->row->id);
        $tpl->uLanguages = $this->getUserLanguages($tpl->row->id);
    }

    /**
     * Master::Password()
     *
     * @return
     */
    public function Password()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->template = 'admin/mypassword.tpl.php';
        $tpl->crumbs = ['master', array(0 => Lang::$word->NAV_14, 1 => Lang::$word->NAV_15), Lang::$word->NAV_13];
        $tpl->title = Lang::$word->ACC_PASS_CHANGE;
    }

    /**
     * Master::PorfileEditClient()
     * client profile edit
     * @return
     */
    public function PorfileEditClient()
    {
        $core = App::Core();
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->template = 'master/profile.tpl.php';
        $tpl->title = Lang::$word->ACC_TITLE;
        $tpl->irow = Db::run()->first(self::ciTable, null, array('user_id' => intval(Auth::$udata->uid)));
        $tpl->skills = App::Content()->getSkillList();
        $tpl->languages = App::Content()->getLanguageList();
        $tpl->countries = App::Content()->getCountryList("name");
        $tpl->row = App::Auth()->getUserInfo(Auth::$udata->username);
        $tpl->uSkills = $this->getUserSkills($tpl->row->id);
        $tpl->uLanguages = $this->getUserLanguages($tpl->row->id);
    }

    /**
     * Master::CompleteProfile()
     * freelancer CompleteProfile
     * @return
     */
    public function CompleteProfile()
    {


        $rules = array(
            'name' => array('required|string|min_len,2|max_len,70', Lang::$word->FNAME),
            'promo_code' => array('alpha_numeric|max_len,50', Lang::$word->PROMOTION_CODE),
            'surname' => array('required|alpha|min_len,2|max_len,70', Lang::$word->LNAME),
            'headline' => array('required|string|min_len,3|max_len,100', Lang::$word->HEADLINE),
            'country' => array('required|alpha', Lang::$word->COUNTRY),
            'about' => array('required|string|min_len,10|max_len,1000', Lang::$word->ABOUT),
            'skills' => array('required', Lang::$word->SKILLS),
            'hourly_rate' => array('required|int|min_len,1|max_len,150', Lang::$word->REP_SUB31),
            'languages' => array('required', Lang::$word->LANGUAGE),
            'experience' => array('required', Lang::$word->EXPERIENCE),
            'weekly_hours' => array('required|numeric|min_len,1|max_len,40', Lang::$word->WEEKLY_HOURS),
            'phone' => array('required', Lang::$word->CFG_PHONE),
            'current_employment' => array('required', Lang::$word->CURRENT_EMP),
            'preferred_employment' => array('required', Lang::$word->PREFERRED_EMP),
            'references_name' => array('string', Lang::$word->REFER_NAME),
            'references_phone' => array('string', Lang::$word->REFER_NUM),
            'references_email' => array('string', Lang::$word->REFER_MAIL),
            'hearAbout' => array('string', Lang::$word->HEAR_ABOUT),
            'portfolio' => array('required', Lang::$word->PORTFOLIO_LINK),
        );


        $validate = Validator::instance();
        $_POST['name'] = $validate->sanitize($_POST['name'], 'default');
        $_POST['surname'] = $validate->sanitize($_POST['surname'], 'default');
        $_POST['headline'] = $validate->sanitize($_POST['headline'], 'default');
        $_POST['about'] = $validate->sanitize($_POST['about'], 'default');
        $safe = $validate->doValidate($_POST, $rules);
        $maxsize    = 2097152;
        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/png'
        );


        $reference = [];
        foreach($_POST["references_name"] as $referName)
        {
            $reference[] = array([
                "name" => $validate->sanitize($referName, 'default'),
                "phone" =>  $validate->sanitize($_POST["references_phone"][$z], 'default'),
                "email" => $validate->sanitize($_POST["references_email"][$z], 'default')
                ]);
            $z++;
        }

        /**
        if (!empty($_POST['portfolio'])) {
            if (!filter_var($portfolio, FILTER_VALIDATE_URL))
                Message::$msgs['portfolio'] = '"' . Lang::$word->PORTFOLIO_LINK . '" ' . Lang::$word->FU_ERROR15;
        }
        **/

        //check if files exist
        if (isset($_FILES['profile']) and !empty($_FILES['profile']) and isset($_FILES['cv']) and !empty($_FILES['cv'])) {
            if ($_FILES['profile']['size'] > 524288) {
                Message::$msgs['file_1'] = '"Profile" ' . Lang::$word->FU_ERROR10 . " 512KB.";
            }
            if (!in_array($_FILES['profile']['type'], $acceptable)) {
                Message::$msgs['file_1'] = '"Profile" ' . Lang::$word->CFG_LOGO_R;
            }
            if ($_FILES['cv']['size'] > $maxsize) {
                Message::$msgs['file_2'] = '"CV" ' . Lang::$word->FU_ERROR10 . " 2MB.";
            }
            if (!in_array($_FILES['cv']['type'], array('application/pdf'))) {
                Message::$msgs['file_2'] = '"CV" ' . Lang::$word->FU_ERROR8 . 'pdf';
            }

            if (!file_exists($_FILES['profile']['tmp_name']) || !is_uploaded_file($_FILES['profile']['tmp_name'])) {
                Message::$msgs['file_1'] = Lang::$word->FIELD_R0 . ' "Profile ' . Lang::$word->PICTURE . '" ' . Lang::$word->FIELD_R100;
            }

            if (!file_exists($_FILES['cv']['tmp_name']) || !is_uploaded_file($_FILES['cv']['tmp_name'])) {
                Message::$msgs['file_2'] = Lang::$word->FIELD_R0 . ' "CV ' . Lang::$word->FILE . '" ' . Lang::$word->FIELD_R100;
            }
        } else {
            if (!isset($_FILES['profile']) and empty($_FILES['profile']))
                Message::$msgs['file_1'] =  '"Profile ' . Lang::$word->PICTURE . '" ' . Lang::$word->FIELD_R0 . ' ' . Lang::$word->FIELD_R100;
            if (!isset($_FILES['cv']) and empty($_FILES['cv']))
                Message::$msgs['file_2'] =  '"CV ' . Lang::$word->FILE . '" ' . Lang::$word->FIELD_R0 . ' ' . Lang::$word->FIELD_R100;
        }



        if (empty(Message::$msgs)) {
            $upl = Upload::instance($maxsize, "png,jpg,jpeg,pdf");
            //data for project
            $data = array(
                'fname' => $safe->name,
                'lname' => $safe->surname,
                'headline' => $safe->headline,
                'currency' => $safe->fixed_currency,
                'about' => $safe->about,
                'country' => $safe->country,
                'hourly_rate' => $safe->hourly_rate,
                'experience' => $safe->experience,
                'available_hour' => $safe->weekly_hours,
                'emp_type' => $safe->current_employment,
                'emp_prefer' => $safe->preferred_employment,
                'phone' => $safe->phone,
                'portfolio' => $safe->portfolio,
                'hearAbout' => $safe->hearAbout,
                'is_completed' => 1,
            );

            $upl->process("profile", UPLOADS . "/avatars/", "AVT_");
            if (isset($upl->fileInfo['fname'])) {
                $data['avatar'] = $upl->fileInfo['fname'];
            }
            $upl->process("cv", UPLOADS . "/files/", "CV_");
            if (isset($upl->fileInfo['fname'])) {
                $data['cv'] = $upl->fileInfo['fname'];
            }

            //update user data
            if (Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid))) {
                $session = App::Session();
                $session->set('fullname', $data['fname'] . ' ' . $data['lname']);
                $session->set('fname', $data['fname']);
                $session->set('lname', $data['lname']);
                $session->set('country', $data['country']);
                $session->set('avatar', $data['avatar']);
                $session->set('cv', $data['cv']);
                $session->set('is_completed', $data['is_completed']);
                //add user skills
                $users_skills = array();
                if (isset($safe->skills)) {
                    foreach ($safe->skills as $k => $sid) {
                        $users_skills[] = array(
                            'uid' => Auth::$udata->uid,
                            'sid' => $sid,
                        );
                    }
                    Db::run()->insertBatch(Users::smTable, $users_skills);
                }

                //add user languages
                $user_languages = array();
                if (isset($safe->languages)) {
                    foreach ($safe->languages as $k => $lid) {
                        $user_languages[] = array(
                            'uid' => Auth::$udata->uid,
                            'lid' => $lid,
                        );
                    }
                    Db::run()->insertBatch(Users::lmTable, $user_languages);
                }

                if(count($reference)>0)
                {
                    foreach($reference as $refer)
                    {

                        $data =
                        [
                            "reference" => $refer[0]["name"],
                            "phone" => $refer[0]["phone"],
                            "email" => $refer[0]["email"],
                            "uid" => Auth::$udata->uid,
                            "status" => '0'
                        ];
                        Db::run()->insert(Users::rfTable, $data);
                    }
                }


                $json['type'] = 'success';
                $json['redirect'] = Url::url('/master');
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->ACC_UPDATED;
            } else {
                $json['message'] = Lang::$word->FU_ERROR11;
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
            }


            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Master::UpdateProfile()
     * freelancer UpdateProfile
     * @return
     */
    public function UpdateProfile()
    {
        $z = 0;


        $rules = array(
            'name' => array('required|string|min_len,3|max_len,70', Lang::$word->FNAME),
            'surname' => array('required|alpha|min_len,3|max_len,70', Lang::$word->LNAME),
            'headline' => array('required|string|min_len,3|max_len,100', Lang::$word->HEADLINE),
            'country' => array('required|alpha', Lang::$word->COUNTRY),
            'about' => array('required|string|min_len,10|max_len,1000', Lang::$word->ABOUT),
            'skills' => array('required', Lang::$word->SKILLS),
            'hourly_rate' => array('required|int|min_len,1|max_len,150', Lang::$word->REP_SUB31),
            'languages' => array('required', Lang::$word->LANGUAGE),
            'experience' => array('required', Lang::$word->EXPERIENCE),
            'weekly_hours' => array('required|numeric|min_len,1|max_len,40', Lang::$word->WEEKLY_HOURS),
            'phone' => array('required', Lang::$word->CFG_PHONE),
            'current_employment' => array('required', Lang::$word->CURRENT_EMP),
            'preferred_employment' => array('required', Lang::$word->PREFERRED_EMP),
            'references_name' => array('string', Lang::$word->REFER_NAME),
            'references_phone' => array('string', Lang::$word->REFER_NUM),
            'references_email' => array('string', Lang::$word->REFER_MAIL),
            'hearAbout' => array('string', Lang::$word->HEAR_ABOUT),
            'portfolio' => array('required', Lang::$word->PORTFOLIO_LINK),
        );

        $validate = Validator::instance();
        $_POST['name'] = $validate->sanitize($_POST['name'], 'default');
        $_POST['surname'] = $validate->sanitize($_POST['surname'], 'default');
        $_POST['headline'] = $validate->sanitize($_POST['headline'], 'default');
        $_POST['about'] = $validate->sanitize($_POST['about'], 'default');

        $safe = $validate->doValidate($_POST, $rules);
        $maxsize    = 2097152;
        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/png'
        );

        $reference = [];
        foreach($_POST["references_name"] as $referName)
        {
            $reference[] = array([
                "name" => $validate->sanitize($referName, 'default'),
                "phone" =>  $validate->sanitize($_POST["references_phone"][$z], 'default'),
                "email" => $validate->sanitize($_POST["references_email"][$z], 'default')
                ]);
            $z++;
        }

        /**
        if (!empty($_POST['portfolio'])) {
            if (!filter_var($_POST['portfolio'], FILTER_VALIDATE_URL))
                Message::$msgs['portfolio'] = '"' . Lang::$word->PORTFOLIO_LINK . '" ' . Lang::$word->FU_ERROR15 . $_POST['phone'];
        }
        **/

        //check if files exist
        if (isset($_FILES['profile']) and !empty($_FILES['profile'])) {
            if ($_FILES['profile']['size'] > 524288) {
                Message::$msgs['file_1'] = '"Profile" ' . Lang::$word->FU_ERROR10 . " 512KB.";
            }
            if (!in_array($_FILES['profile']['type'], $acceptable)) {
                Message::$msgs['file_1'] = '"Profile" ' . Lang::$word->CFG_LOGO_R;
            }
            if (!file_exists($_FILES['profile']['tmp_name']) || !is_uploaded_file($_FILES['profile']['tmp_name'])) {
                Message::$msgs['file_1'] = Lang::$word->FIELD_R0 . ' "Profile ' . Lang::$word->FILE . '" ' . Lang::$word->FIELD_R100;
            }
        }

        if (isset($_FILES['cv']) and !empty($_FILES['cv'])) {
            if ($_FILES['cv']['size'] > $maxsize) {
                Message::$msgs['file_2'] = '"CV" ' . Lang::$word->FU_ERROR10 . " 2MB.";
            }
            if (!in_array($_FILES['cv']['type'], array('application/pdf'))) {
                Message::$msgs['file_2'] = '"CV" ' . Lang::$word->FU_ERROR8 . 'pdf';
            }
            if (!file_exists($_FILES['cv']['tmp_name']) || !is_uploaded_file($_FILES['cv']['tmp_name'])) {
                Message::$msgs['file_2'] = Lang::$word->FIELD_R0 . ' "CV ' . Lang::$word->FILE . '" ' . Lang::$word->FIELD_R100;
            }
        }


        if (empty(Message::$msgs)) {
            $upl = Upload::instance($maxsize, "png,jpg,jpeg,pdf");
            //user data
            $data = array(
                'fname' => $safe->name,
                'lname' => $safe->surname,
                'headline' => $safe->headline,
                'about' => $safe->about,
                'country' => $safe->country,
                'hourly_rate' => $safe->hourly_rate,
                'experience' => $safe->experience,
                'available_hour' => $safe->weekly_hours,
                'emp_type' => $safe->current_employment,
                'emp_prefer' => $safe->preferred_employment,
                'phone' => $safe->phone,
                'portfolio' => $safe->portfolio,
                'hearAbout' => $safe->hearAbout,
                'is_completed' => 1,
            );

            if (isset($_FILES['profile']) and !empty($_FILES['profile'])) {
                File::deleteFile(UPLOADS . "/avatars/" . Auth::$udata->avatar);
                $upl->process("profile", UPLOADS . "/avatars/", "AVT_");
                if (isset($upl->fileInfo['fname'])) {
                    $data['avatar'] = $upl->fileInfo['fname'];
                }
            }
            if (isset($_FILES['cv']) and !empty($_FILES['cv'])) {
                File::deleteFile(UPLOADS . "/files/" . Auth::$udata->cv);
                $upl->process("cv", UPLOADS . "/files/", "CV_");
                if (isset($upl->fileInfo['fname'])) {
                    $data['cv'] = $upl->fileInfo['fname'];
                }
            }
            //update user data
            if (Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid))) {
                $session = App::Session();
                $session->set('fullname', $data['fname'] . ' ' . $data['lname']);
                $session->set('fname', $data['fname']);
                $session->set('lname', $data['lname']);
                $session->set('country', $data['country']);
                if (array_key_exists('avatar', $data))
                    $session->set('avatar', $data['avatar']);
                if (array_key_exists('cv', $data))
                    $session->set('cv', $data['cv']);
                $session->set('is_completed', $data['is_completed']);
                //remove skills and add new ones
                Db::run()->delete(Users::smTable, array('uid' => intval(Auth::$udata->uid)));
                //add user skills
                $users_skills = array();
                if (isset($safe->skills)) {
                    foreach ($safe->skills as $k => $sid) {
                        $users_skills[] = array(
                            'uid' => Auth::$udata->uid,
                            'sid' => $sid,
                        );
                    }
                    Db::run()->insertBatch(Users::smTable, $users_skills);
                }
                //remove languages
                Db::run()->delete(Users::lmTable, array('uid' => intval(Auth::$udata->uid)));
                //add user languages
                $user_languages = array();
                if (isset($safe->languages)) {
                    foreach ($safe->languages as $k => $lid) {
                        $user_languages[] = array(
                            'uid' => Auth::$udata->uid,
                            'lid' => $lid,
                        );
                    }
                    Db::run()->insertBatch(Users::lmTable, $user_languages);
                }
                if(count($reference)>0)
                {

                    Db::run()->delete(Users::rfTable, array('uid' => Auth::$udata->uid));

                    foreach($reference as $refer)
                    {

                        $data =
                        [
                            "reference" => $refer[0]["name"],
                            "phone" => $refer[0]["phone"],
                            "email" => $refer[0]["email"],
                            "uid" => Auth::$udata->uid,
                            "status" => '0'
                        ];
                        if($refer[0]["name"] != "")
                        {
                            Db::run()->insert(Users::rfTable, $data);
                        }

                    }
                }

                $json['debug'] = $data;
                $json['type'] = 'success';
                $json['redirect'] = Url::url('/master');
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->ACC_UPDATED;
            } else {
                $json['message'] = Lang::$word->FU_ERROR11;
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
            }

            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * Master::UpdateProfileClient()
     * freelancer UpdateProfileClient
     * @return
     */
    public function UpdateProfileClient()
    {

        $rules = array(
            'name' => array('required|string|min_len,3|max_len,70', Lang::$word->FNAME),
            'surname' => array('required|alpha|min_len,3|max_len,70', Lang::$word->LNAME),
            'headline' => array('required|string|min_len,3|max_len,100', Lang::$word->HEADLINE),
            'phone' => array('required|min_len,10', Lang::$word->CFG_PHONE),
            // 'about' => array('required|string|min_len,10|max_len,1000', Lang::$word->ABOUT),
            // 'cmp_name' => array('required|string|min_len,3|max_len,75', Lang::$word->CMP_NAME),
            // 'cmp_web' => array('required|min_len,10|max_len,100', Lang::$word->CMP_WEB),
            // 'cmp_linkedin' => array('required|min_len,10|max_len,200', Lang::$word->CMP_LINKEDIN),
            // 'cmp_desc' => array('required|min_len,10|max_len,1000', Lang::$word->CMP_DESC),
            'skills' => array('required', Lang::$word->SKILLS),
        );


        $validate = Validator::instance();
        $_POST['name'] = (isset($_POST['name'])) ? $validate->sanitize($_POST['name'], 'default') : "";
        $_POST['surname'] = (isset($_POST['surname'])) ? $validate->sanitize($_POST['surname'], 'default') : "";
        $_POST['headline'] = (isset($_POST['headline'])) ? $validate->sanitize($_POST['headline'], 'default') : "";
        $_POST['cmp_name'] = (isset($_POST['cmp_name'])) ? $validate->sanitize($_POST['cmp_name'], 'default') : "";
        $_POST['cmp_linkedin'] = (isset($_POST['cmp_linkedin'])) ? $validate->sanitize($_POST['cmp_linkedin'], 'default') : "";
        $_POST['cmp_desc'] = (isset($_POST['cmp_desc'])) ?  $validate->sanitize($_POST['cmp_desc'], 'default') : "";
        $safe = $validate->doValidate($_POST, $rules);
        $maxsize    = 2097152;
        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/png'
        );

        //check if files exist
        if (isset($_FILES['profile']) and !empty($_FILES['profile']) and file_exists($_FILES['profile']['tmp_name'])) {
            if ($_FILES['profile']['size'] > 524288) {
                Message::$msgs['file_1'] = '"Profile" ' . Lang::$word->FU_ERROR10 . " 512KB.";
            }
            if (!in_array($_FILES['profile']['type'], $acceptable)) {
                Message::$msgs['file_1'] = '"Profile" ' . Lang::$word->CFG_LOGO_R;
            }
            if (!file_exists($_FILES['profile']['tmp_name']) || !is_uploaded_file($_FILES['profile']['tmp_name'])) {
                Message::$msgs['file_1'] = Lang::$word->FIELD_R0 . ' "Profile ' . Lang::$word->FILE . '" ' . Lang::$word->FIELD_R100;
            }
        }


        if (empty(Message::$msgs)) {
            $upl = Upload::instance($maxsize, "png,jpg,jpeg,pdf");
            //user data
            $data = array(
                'fname' => $safe->name,
                'lname' => $safe->surname,
                'phone' => $safe->phone,
                'headline' => $safe->headline,
                'about' => $safe->about,
                'is_completed' => 1,
            );

            //company data
            $cmp_data = array(
                'cmp_name' => $safe->cmp_name,
                'cmp_website' => $safe->cmp_web,
                'cmp_linkedin' => $safe->cmp_linkedin,
                'cmp_desc' => $safe->cmp_desc,
            );

            if (isset($_FILES['profile']) and !empty($_FILES['profile']) and file_exists($_FILES['profile']['tmp_name'])) {
                File::deleteFile(UPLOADS . "/avatars/" . Auth::$udata->avatar);
                $upl->process("profile", UPLOADS . "/avatars/", "AVT_");
                if (isset($upl->fileInfo['fname'])) {
                    $data['avatar'] = $upl->fileInfo['fname'];
                }
            }

            //update user data
            if (
                Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid))
                && Db::run()->update(self::ciTable, $cmp_data, array("user_id" => Auth::$udata->uid))
            ) {
                $session = App::Session();
                $session->set('fullname', $data['fname'] . ' ' . $data['lname']);
                $session->set('fname', $data['fname']);
                $session->set('lname', $data['lname']);
                if (array_key_exists('avatar', $data))
                    $session->set('avatar', $data['avatar']);
                $session->set('is_completed', $data['is_completed']);

                //remove skills and add new ones
                Db::run()->delete(Users::smTable, array('uid' => intval(Auth::$udata->uid)));
                //add user skills
                $users_skills = array();
                if (isset($safe->skills)) {
                    foreach ($safe->skills as $k => $sid) {
                        $users_skills[] = array(
                            'uid' => Auth::$udata->uid,
                            'sid' => $sid,
                        );
                    }
                    Db::run()->insertBatch(Users::smTable, $users_skills);
                }

                $json['type'] = 'success';
                $json['redirect'] = Url::url('/master');
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->ACC_UPDATED;
            } else {
                $json['message'] = Lang::$word->FU_ERROR11;
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
            }

            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }


    /**
     * Master::getUserSkills()
     *
     * @param mixed $id
     * @return
     */
    public function getUserSkills($id = '')
    {
        $sql = "SELECT s.name,  s.id
		  FROM `" . Users::smTable . "` su
			INNER JOIN `" . Project::sTable . "` s ON su.sid = s.id
			INNER JOIN `" . Users::mTable . "` u ON su.uid = u.id
		  WHERE u.id = ? ;";


        return Db::run()->pdoQuery($sql, array($id))->results();
    }

    /**
     * Master::getUserLanguages()
     *
     * @param mixed $id
     * @return
     */
    public function getUserLanguages($id = '')
    {
        $sql = "SELECT l.name, l.id
		  FROM `" . Users::lmTable . "` lu
			INNER JOIN `" . Content::lTable . "` l ON lu.lid = l.id
			INNER JOIN `" . Users::mTable . "` u ON lu.uid = u.id
		  WHERE u.id = ? ;";


        return Db::run()->pdoQuery($sql, array($id))->results();
    }






    /************************************************************************************************************************
     ************************************************************************************************************************
     ******************************************* CLIENT AND FREELANCER PROJECT PART *****************************************
     ************************************************************************************************************************
     ***********************************************************************************************************************/


    /**
     * Master::PostProject()
     *
     * @return
     */
    public function PostProject()
    {


        $rules = array(
            'work_type' => array('required', Lang::$word->WORK_TYPE),
            'promo_code' => array('alpha_numeric|max_len,50', Lang::$word->PROMOTION_CODE),
            'name' => array('required|string|min_len,10|max_len,100', Lang::$word->TITLE),
            'description' => array('required|string|min_len,50|max_len,4000', Lang::$word->DESCRIPTION),
            'no_devs' => array('required|integer', Lang::$word->NO_DEVS),
            'start_time' => array('required|date', Lang::$word->START_TIME),
            'skill_level' => array('required|string|max_len,20', Lang::$word->SKILL_LEV),
            'project_type' => array('required', Lang::$word->PRJ_TYPE),
            'fixed_currency' => array('required', Lang::$word->CFG_SCURRENCY_S),
            'hourly_currency' => array('required', Lang::$word->CFG_SCURRENCY_S),
            'hourly_budget' => array('required', Lang::$word->PRJ_BUDGET),
        );


        $validate = Validator::instance();
        $_POST['name'] = $validate->sanitize($_POST['name'], 'default');
        $_POST['description'] = $validate->sanitize($_POST['description'], 'default');
        $_POST['skill_level'] = $validate->sanitize($_POST['skill_level'], 'default');

        $safe = $validate->doValidate($_POST, $rules);
        $budget_type = '';
        $maxsize    = 2097152;
        $acceptable = array(
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'image/png'
        );


        if (empty(Message::$msgs) && $safe->work_type === "Project Based" && (!file_exists($_FILES['file']['tmp_name'][0]) || !is_uploaded_file($_FILES['file']['tmp_name'][0]))) {
            Message::$msgs['file'] = Lang::$word->FIELD_R0 . ' "' . Lang::$word->FILE . '" ' . Lang::$word->FIELD_R100;
        }
        if (file_exists($_FILES['file']['tmp_name'][0])) {
            foreach ($_FILES['file']['type'] as $key => $value) {
                if (!in_array($value, $acceptable)) {
                    Message::$msgs['file'] = Lang::$word->INVALID_FILE_T;
                }
            }
            foreach ($_FILES['file']['size'] as $key => $value) {
                if ($value > $maxsize) {
                    Message::$msgs['file'] = Lang::$word->FU_ERROR10 . " 2MB.";
                }
            }
        }


        if (empty(Message::$msgs) && ($safe->{$safe->project_type . "_budget"} == 16 || $safe->{$safe->project_type . "_budget"} == 17)) {
            if (!isset($_POST['min']) || !isset($_POST['max']) || $_POST['min'] <= 0 || $_POST['max'] <= 0) {
                Message::$msgs['min_max'] = Lang::$word->FIELD_R0 . ' "' . Lang::$word->MIN_R1 . " " . Lang::$word->AND . " " . Lang::$word->MAX_R1 . '" ' . Lang::$word->FIELD_R100;
            } else if ($_POST['min'] >= $_POST['max']) {
                Message::$msgs['min_max'] =  Lang::$word->MIN_MAX_ER;
            } else if ($_POST['max'] > 50000) {
                Message::$msgs['min_max'] = str_replace("[NAME]", 50000, Lang::$word->MAX_ER);
            }
        }


        if (empty(Message::$msgs)) {
            if (App::Auth()->logged_in && App::Auth()->is_completed) {
                if (!App::Auth()->is_Client()) {
                    $json['type'] = 'alert';
                    $json['title'] = Lang::$word->ALERT;
                    $json['message'] = Lang::$word->CLIENT_ONLY_ERR;
                    $json['redirect'] = URL::url('/master');
                    print json_encode($json);
                    exit;
                }
                //data for project
                $data = array(
                    'name' => $safe->name,
                    'description' => $safe->description,
                    'label_id' => 1,
                    'created_by_id' => App::Auth()->uid,
                    'created_by_name' => App::Auth()->name,
                    'currency' => $safe->{$safe->project_type . "_currency"},
                    'promo_code' => $safe->promo_code,
                    'project_type' => $safe->project_type,
                    'work_type' => $safe->work_type,
                    'start_date' => $safe->start_time,
                    'required_dev' => $safe->no_devs,
                    'budget_type_id' => $safe->{$safe->project_type . "_budget"},
                );
                if ($safe->{$safe->project_type . "_budget"} == 16 || $safe->{$safe->project_type . "_budget"} == 17) {
                    $data['minimum_budget'] = $_POST['min'];
                    $data['maximum_budget'] = $_POST['max'];
                }


                //insert project details
                $last_id = Db::run()->insert(Project::pTable, $data)->getLastInsertId();

                if (file_exists($_FILES['file']['tmp_name'][0])) {
                    //upload files
                    $files = array();
                    foreach ($_FILES['file']['name'] as $key => $value) {
                        $upl = Upload::instance(2097152, "png,jpg,jpeg,pdf");
                        $upl->process("file", UPLOADS . "/files/", "FILE_", false, true, $key);
                        if (isset($upl->fileInfo['fname'])) {
                            $files[] = array(
                                'name' => $upl->fileInfo['fname'],
                                'fsize' => $upl->fileInfo['size'],
                                'fext' => $upl->fileInfo['ext'],
                                'project_id' => $last_id,
                                'is_hidden' => 1,
                            );
                        }
                    }
                }

                if ($last_id) {
                    //insert default note
                    $dataDefaultNote = [
                      "name" => "Example Note #1",
                      "project_id" => $last_id,
                      "body" => "This is an example note.",
                      "created" => date("Y-m-d H:i:s"),
                      "created_by_id" => 1,
                      "created_by_name" => "Remotify",
                      "created_by_email" => "info@remotify.co",
                      "is_hidden" => 0,
                      "status" => 1
                    ];
                    Db::run()->insert(Project::nTable,$dataDefaultNote);

                    //insert project user
                    Db::run()->insert(Project::pxTable, array("user_id" => App::Auth()->uid, "project_id" => $last_id));


                    //add project files
                    if (isset($files)) {
                        $last_files = Db::run()->insertBatch(Project::fTable, $files);
                        //receive latest files added for project
                        $last_files =  Db::run()->select(Project::fTable, array('id'), array("project_id" => $last_id), ' ORDER BY id')->results();
                    }
                    //add project files
                    if (isset($last_files) && $last_files && $last_id) {
                        foreach ($last_files as $fid) {
                            $datapArray[] = array(
                                'fid' => $fid->id,
                                'pid' => $last_id,
                            );
                        }
                        Db::run()->insertBatch(Project::pfTable, $datapArray);
                    }

                    //Project Mail
                    Master::newProjectMail(App::Auth()->uid, $last_id);

                    $json['redirect'] = URL::url('/master/projects');
                    $json['type'] = 'success';
                    $json['title'] = Lang::$word->SUCCESS;
                    $json['message'] = Lang::$word->PRJ_ADDED;
                } else {
                    $json['message'] = Lang::$word->FU_ERROR11;
                    $json['type'] = "error";
                    $json['title'] = Lang::$word->ERROR;
                }
            } else {
                $json['registration'] = true;
                $json['redirect'] = "register";
                $json['message'] = Lang::$word->PRJ_ADD_ERR1;
                $json['type'] = "alert";
                $json['title'] = Lang::$word->ALERT;
                if (App::Auth()->logged_in && !App::Auth()->is_completed)
                    $json['redirect'] = "profile";
            }

            print json_encode($json);
        } else {
            Message::msgSingleStatus();
        }
    }

    /**
     * freelancer place bid on project
     * Master::PlaceBid()
     *
     * @return
     */
    public function PlaceBid()
    {


        $row = Db::run()->first(Project::pTable, array('work_type', 'label_id', 'id'), array('id' => intval($_POST['project_id'])));
        $user = Db::run()->first(Project::pxTable, array('user_id'), array('user_id' => Auth::$udata->uid, 'project_id' => (isset($row->id)) ? $row->id : 0));
        $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'projectBid'));
        if (isset($user->user_id)  && $row->label_id == 1) {

            if ($row->work_type === 'Project Based') {
                $rules = array(
                    'bid_amount' => array('required|float|min_numeric,1|max_numeric,50000', Lang::$word->BID_AMOUNT),
                    'delivery_time' => array('required|integer|min_numeric,1|max_numeric,1000', Lang::$word->TIME),
                    'time_type' => array('required|alpha|contains_list,hour;day', Lang::$word->TIME),
                    'proposal' => array('required|string|min_len,50|max_len,10000', Lang::$word->PROPOSAL),
                );
                $total = 0;
                if (!isset($_POST['milestone_task']) || !isset($_POST['milestone_price']) || count($_POST['milestone_price']) != count($_POST['milestone_task']))
                    Message::$msgs['milestone_task_price'] =  Lang::$word->INV_MILESTONE;
                else {
                    foreach ($_POST['milestone_task'] as $k => $v) {
                        $total = $total + floatval($_POST['milestone_price'][$k]);
                        if (floatval($_POST['milestone_price'][$k]) <= 0)
                            Message::$msgs['milestone_price' . $k] =  'The "Milestone Price ' . ($k + 1) . '" field needs to be a numeric value, equal to, or higher than 0';

                        if (strlen($v) <= 15)
                            Message::$msgs['milestone_task' . $k] =  Lang::$word->FIELD_R0 . ' "Milestone Task ' . ($k + 1) . '" ' . str_replace("[X]", 15, Lang::$word->FIELD_R2);
                        if (strlen($v) >= 1000)
                            Message::$msgs['milestone_task'] =  Lang::$word->FIELD_R0 . ' "Milestone Task ' . ($k + 1) . '" ' . str_replace("[X]", 1000, Lang::$word->FIELD_R1);
                    }
                    if ($total != floatval($_POST['bid_amount']) && empty(Message::$msgs))
                        Message::$msgs['milestone_price_total'] =  Lang::$word->MILESTONE_PRICE_ERR;
                }
            } else
                $rules = array(
                    'bid_amount' => array('required|float|min_numeric,1|max_numeric,50000', Lang::$word->BID_AMOUNT),
                    'payment_type' => array('required|alpha|contains_list,hourly;daily;monthly', Lang::$word->ADM_PAYMENTS),
                    'proposal' => array('required|string|min_len,50|max_len,10000', Lang::$word->PROPOSAL),
                );

            $validate = Validator::instance();
            $safe = $validate->doValidate($_POST, $rules);
            if (empty(Message::$msgs)) {
                $bid =  Db::run()->first(self::bTable, array('id'), array('user_id' => Auth::$udata->uid, 'project_id' => $row->id));


                $data = array(
                    'project_id' => $row->id,
                    'user_id' => $user->user_id,
                    'bid_amount' => $safe->bid_amount,
                    'proposal' => $safe->proposal,
                    'work_type' => $row->work_type,
                );
                if ($row->work_type === 'Project Based') {
                    $data['delivery_time'] = $safe->delivery_time;
                    $data['time_type'] = $safe->time_type;
                    $data['total_time_hour'] = ($safe->time_type === "hour") ? $safe->delivery_time : (intval($safe->delivery_time) * 24);
                } else {
                    $data['payment_type'] = $safe->payment_type;
                }

                $mailer = Mailer::sendMail();
                $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                $replacements = array();
                $numSent = 0;
                $failedRecipients = array();
                $core = App::Core();



                $userrow =  Db::run()->first(Users::mTable, null, array('id' => intval($user->user_id)));

                $prname =  Db::run()->first(Project::pTable, null, array('id' => intval($_POST['project_id'])));
                $prUser =  Db::run()->first(Users::mTable, null, array('id' => intval($prname->created_by_id)));



                $body = str_replace(array(
                    '[USER]',
                    '[LOGO]',
                    '[DATE]',
                    '[COMPANY]',
                    '[SNAME]',
                    '[PROJECT]',
                    '[LINK]',
                    '[CEMAIL]',
                    '[FB]',
                    '[TW]',
                    '[SITEURL]'
                ), array(
                    $userrow->fname.' '.$userrow->lname,
                    Utility::getLogo(),
                    date('Y'),
                    $core->company,
                    App::Auth()->name,
                    $prname->name,
                    Url::url("/master/projects"),
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


                //insert or update bid data
                if (!$bid){

                    $message->setTo(array($prUser->email => $userrow->fname.' '.$userrow->lname));

                    $numSent++;

                    if ($mailer->send($message)) {
                        $last_id = Db::run()->insert(self::bTable, $data)->getLastInsertId();
                    }

                }else {
                    Db::run()->update(self::bTable, $data, array('id' => $bid->id));
                    Db::run()->delete(self::bmTable, array('bid_id' => $bid->id));
                    $message->setTo(array($prUser->email => $userrow->fname.' '.$userrow->lname));

                    $numSent++;

                    if ($mailer->send($message)) {
                        $last_id = $bid->id;
                    }
                }


                if ($last_id) {

                    if ($row->work_type === 'Project Based') {
                        $bid_milestones = array();
                        $x = 1;
                        foreach ($_POST['milestone_task'] as $k => $v) {
                            $bid_milestones[] = array(
                                'bid_id' => $last_id,
                                'project_id' => $row->id,
                                'task' => $v,
                                'milestone_order' => $x,
                                'amount' => $_POST['milestone_price'][$k],
                                'total' => $safe->bid_amount,
                            );
                            $x++;
                        }
                        Db::run()->insertBatch(self::bmTable, $bid_milestones);
                    }

                    $json['type'] = 'success';
                    $json['redirect'] = Url::url('/master/bids');
                    $json['title'] = Lang::$word->SUCCESS;
                    $json['message'] = ($bid) ? Lang::$word->BID_UPDATED : Lang::$word->BID_SUCCESS;
                } else {
                    $json['message'] = Lang::$word->FU_ERROR11;
                    $json['type'] = "error";
                    $json['title'] = Lang::$word->ERROR;
                }
                print json_encode($json);
            } else {
                Message::msgSingleStatus();
            }
        } else {
            Message::$msgs['wrong_project'] =  Lang::$word->PRJ_INVALID_ID;
            Message::msgSingleStatus();
        }
    }

    public function ProjectPlanMeet()
    {


    $mailer = Mailer::sendMail();
                $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                $replacements = array();
                $numSent = 0;
                $failedRecipients = array();
                $core = App::Core();

        $auserrow =  Db::run()->first(Users::mTable, null, array('id' => intval($_POST['aUsr'])));
        $biduserrow =  Db::run()->first(Users::mTable, null, array('id' => intval($_POST['bidderID'])));
        $prname =  Db::run()->first(Project::pTable, null, array('id' => intval($_POST['projectID'])));

        $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'planMeeting'));
        $core = App::Core();
        $body = str_replace(array(
            '[AUSER]',
            '[AUSERMAIL]',
            '[BUSER]',
            '[BUSERMAIL]',
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
            $biduserrow->fname.' '.$biduserrow->lname,
            $biduserrow->email,
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
        $message->setTo(array('info@remotify.co','sezer@remotify.co', 'sueda@remotify.co'));

        $numSent++;

        if ($mailer->send($message)) {
           echo 'ok';
        }


    }

    public function newProjectMail($aUsr, $projectID)
    {
    $mailer = Mailer::sendMail();
                $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                $replacements = array();
                $numSent = 0;
                $failedRecipients = array();
                $core = App::Core();

        $auserrow =  Db::run()->first(Users::mTable, null, array('id' => $aUsr));
        $prname =  Db::run()->first(Project::pTable, null, array('id' => $projectID));

        $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'projectOpened'));
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
        $message->setTo(array('info@remotify.co','sezer@remotify.co', "hasancan@remotify.co", "isiner@remotify.co"));

        $numSent++;

        if ($mailer->send($message)) {

        }


    }

    public function newYear()
    {
    $mailer = Mailer::sendMail();
                $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                $replacements = array();
                $numSent = 0;
                $failedRecipients = array();
                $core = App::Core();

        $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'newYear'));
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
        $message->setTo(array('sezer@remotify.co', 'isiner@remotify.co'));

        $numSent++;

        if ($mailer->send($message)) {
          return "Great";
        }
    }
    /**
     * Master::approveBid()
     * accept freelancer bid
     * @return
     */
    public function approveBid()
    {
        $bid_id = intval(Filter::$id);
        $bid = Db::run()->first(Master::bTable, array('id', 'user_id', 'project_id'), array('id' => $bid_id));
        if ($bid) {
            $project = Db::run()->first(Project::pTable, array('id', 'created_by_id', 'created_by_name', 'label_id', 'name'), array('id' => $bid->project_id, 'created_by_id' => Auth::$udata->uid));
            $user = Db::run()->first(Users::mTable, array('email', 'fname', 'lname'), array('id' => $bid->user_id));
        } else $project = null;

        if ($bid_id && $bid && $project && $project->label_id == 1) {
            //remove all other users from this project
            Db::run()->pdoQuery("DELETE FROM `" . Project::pxTable . "` WHERE `user_id` NOT IN (" . $project->created_by_id . "," . $bid->user_id . ") AND `project_id` = ? ;", array($project->id));
            //set project label to in progress
            Db::run()->update(Project::pTable, array('label_id' => 2), array('id' => $project->id));
            //set all other bids status to declined except this bid
            Db::run()->update(Master::bTable, array('status' => 4), array('project_id' => $project->id));
            Db::run()->update(Master::bTable, array('status' => 2), array('id' => $bid->id));

            $mailer = Mailer::sendMail();
            $core = App::Core();
            $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'bidApproval'));

            $body = str_replace(array(
                '[LOGO]',
                '[DATE]',
                '[COMPANY]',
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
                ucwords(App::Auth()->name),
                ucwords($project->name),
                Url::url("/master/projects/view", $project->id),
                $core->site_email,
                $core->social->facebook,
                $core->social->twitter,
                SITEURL
            ), $tpl->body);

            $msg = Swift_Message::newInstance()
                ->setSubject(str_replace("[COMPANY]", $core->company, $tpl->subject))
                ->setTo(array($user->email => ucwords($user->fname . ' ' . $user->lname)))
                ->setFrom(array($core->site_email => $core->company))
                ->setBody($body, 'text/html');

            if ($mailer->send($msg)) {
                $json['type'] = 'success';
                $json['redirect'] = Url::url('/master/bids', $project->id);
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = Lang::$word->BID_ACCEPTED;
            } else {
                $json['type'] = "error";
                $json['title'] = Lang::$word->ERROR;
                $json['message'] = Lang::$word->SENDERROR;
            }
            print json_encode($json);
        } else {
            Message::$msgs['wrong_bid'] =  Lang::$word->INV_BID_ID;
            Message::msgSingleStatus();
        }
    }


    /**
     * Master::getProjectSkills()
     *
     * @param mixed $id
     * @return
     */
    public function getProjectSkills($id = '')
    {
        $sql = "SELECT s.name, s.id
		  FROM `" . Project::psTable . "` ps
			INNER JOIN `" . Project::sTable . "` s ON ps.sid = s.id
			INNER JOIN `" . Project::pTable . "` p ON ps.pid = p.id
		  WHERE p.id = ? ;";


        return Db::run()->pdoQuery($sql, array($id))->results();
    }


    /**
     * Master::Projects()
     *
     * @return
     */
    public function Projects()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->title = Lang::$word->PRJ_PROJECTS;
        $tpl->core = App::Core();
        $tpl->data = App::Project()->getProjectsByPermissions();
        $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
        $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
        $tpl->crumbs = ['master', Lang::$word->NAV_25];
        $tpl->template = 'master/projects.tpl.php';
    }

    /**
     * freelancer manage bids
     * Master::Bids()
     *
     * @return
     */
    public function Bids()
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->title = Lang::$word->BIDS;
        $tpl->core = App::Core();
        $tpl->row = $this->getUserBids(App::Auth()->uid);
        $sql = "SELECT user_id,COUNT(*) AS total_bids,
        SUM(case when status = 1 then 1 else 0 end) as active_bids,
        SUM(case when status = 2 then 1 else 0 end) as accepted_bids,
        SUM(case when status = 4 then 1 else 0 end) as declined_bids
        FROM `" . self::bTable . "` WHERE user_id = ? GROUP BY user_id;";
        $tpl->bidCount = Db::run()->pdoQuery($sql, array(App::Auth()->uid))->result();
        $tpl->template = 'master/bids.tpl.php';
    }
    /**
     * Master::ProjectBids()
     *
     * @return
     */
    public function ProjectBids($id)
    {
        $tpl = App::View(BASEPATH . 'view/');
        $tpl->dir = "master/";
        $tpl->title = Lang::$word->PROJECT_BIDS;
        $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_38];
        $tpl->core = App::Core();

        if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
            $tpl->template = 'master/404.tpl.php';
            $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
        } else {
            if ($row->label_id == 2) {
                $row = App::Project()->getProjectWithBidBudget(1, $id);
                $row->budget = $row->bid_amount;
            }
            $tpl->row = $row;
            $tpl->pID = $id;
            $tpl->puserdata = App::Project()->getProjectUsers($id);
            $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
            $tpl->bids = $this->getProjectBids($row->id);
            $tpl->countryList = App::Content()->getCountryList('sorting DESC', ' name ,iso_alpha2 ');
            $tpl->milestones = Db::run()->select(self::bmTable, null, array('project_id' => $row->id))->results();
            $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
            $tpl->template = 'master/projects.tpl.php';
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
        $sql = "SELECT b.*, p.name name, p.currency currency FROM`" . self::bTable . "` AS b
                LEFT JOIN `" . Project::pTable . "` AS p ON b.project_id = p.id
                WHERE b.user_id=? AND b.status =? {$order_by};";
        $row = Db::run()->pdoQuery($sql, array(intval($user_id), $status))->results();

        if (count((array)$row) > 0) {
            $bided_projects = implode(',', array_column((array)$row, 'project_id'));
            $sRow = Db::run()->select(self::bTable, array('project_id,COUNT(id) as total_bids', 'SUM(bid_amount) as total_bid_amount'), array(), ' WHERE project_id IN (' . $bided_projects . ') GROUP BY project_id')->results();

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

        $sql = "SELECT b.*, u.country, CONCAT(u.fname,' ',u.lname) as uname,u.id  as user_id, u.email, u.username, u.phone, u.avatar FROM `" . self::bTable . "` AS b
                LEFT JOIN `" . Users::mTable . "` AS u ON b.user_id = u.id
                WHERE b.project_id=?
				        {$order_by};";

        $row = Db::run()->pdoQuery($sql, array(intval($id)))->results();

        return ($row) ? $row : 0;
    }
}
