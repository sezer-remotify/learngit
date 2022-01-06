<?php

/**
 * Controller
 *
 * 
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: controller.php, v1.00 2019-08-05 10:12:05 gewa Exp $
 */
define("_WOJO", true);
require_once("../../init.php");

$delete = Validator::post('delete');
$action = Validator::post('action');
$title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

/* == Actions == */
switch ($action):
        /* == Admin Login == */
    case "adminLogin":
    case "userLogin":
        App::Auth()->login($_POST['username'], $_POST['password']);
        break;

        /* == Admin Password Reset == */
    case "aResetPass":
        App::Front()->passReset(true);
        break;

    case "uResetPass":
        App::Front()->passReset(false);
        break;

        /* == User Join == */
    case "userJoin":
        App::Front()->Register();
        break;

        /* == post project == */
    case "postproject":
        App::Master()->PostProject();
        break;

        /* == freelancer complete profile == */
    case "doSignup":
        if (!App::Auth()->is_Freelancer()) exit;
        App::Master()->UpdateProfile();
        break;
        /* == freelancer update profile == */
    case "doUpdate":
        if (App::Auth()->is_Freelancer())
            App::Master()->UpdateProfile();
        else if (App::Auth()->is_Client())
            App::Master()->UpdateProfileClient();
        else exit;
        break;
        /* == freelancer place bid == */
    case "placeBid":
        if (!App::Auth()->is_Freelancer()) exit;
        App::Master()->PlaceBid();
        break;

        /* == freelancer place bid == */
    case "approveBid":
        if (!App::Auth()->is_Client()) exit;
        App::Master()->approveBid();
        break;

        /* == User Register == */
    case "userRegister":
        App::Auth()->register($_POST['username'], $_POST['password'], $_POST['agreement']);
        break;

        /* == User check verification == */
    case "userIsVerified":
        App::Auth()->checkVerification($_POST['username'], $_POST['password'], $_POST['resend']);
        break;

        /* == User update username == */
    case "uSetUsername":
        App::Auth()->setUsername($_POST['email'], $_POST['username'], $_POST['password']);
        break;

        /* == USER UPDATE TYPE == */
    case "uSetType":
        App::Auth()->setType($_POST['email'], $_POST['type'], $_POST['password']);
        break;


        /* == Update Account == */
    case "updateAccount":
        if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client()) exit;
        App::Front()->updateAccount();
        break;

        /* == Update Password == */
    case "updatePassword":
        if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client()) exit;
        App::Front()->updatePassword();
        break;

        /* == Process Message == */
    case "processMessage":
        if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client()) exit;
        App::Comments()->processMessage();
        break;

        /* == Process Discussion == */
    case "processDiscussion":
        if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client()) exit;
        App::Comments()->processDiscussion(true);
        break;

        /* == Process Project Temp Files == */
    case "tempProjectFiles":
        if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client()) exit;
        App::Project()->tempProjectFiles(true);
        break;

        /* == Process Note == */
    case "processNote":
        if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client()) exit;
        App::Content()->processNote(false, true);
        break;
        /* == Process Timerecord == */
    case "processTimeRecord":
        App::MasterProject()->processTimeRecord();
        break;
        /* == Process Expense Record == */
    case "processExpenseRecord":
        App::Project()->processExpenseRecord();
        break;
endswitch;

/* == Delete Actions == */
switch ($delete):
        /* == Delete Bid == */
    case "deleteBid":
        $res = null;
        if ($res = Db::run()->first(Master::bTable, array('id'), array("id" => Filter::$id, 'user_id' => App::Auth()->uid))) {
            $res = Db::run()->delete(Master::bTable, array("id" => Filter::$id, 'user_id' => App::Auth()->uid));
            Db::run()->delete(Master::bmTable, array("bid_id" => Filter::$id));
        }
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->BID_DEL_OK));
        break;

        /* == Delete File == */
    case "deleteFile":
        if ($row = Db::run()->first(Project::fTable, null, array("id" => Filter::$id, 'created_by_id' => App::Auth()->uid))) {
            Db::run()->update(Users::aTable, array('removed' => 1), array('project_id' => $row->project_id, 'comment' => $row->name));
            $res = Db::run()->delete(Project::fTable, array('id' => Filter::$id));
            File::deleteFile(UPLOADS . "/files/" . $_POST['name']);
            $adata = array(
                'project_id' => $row->project_id,
                'uid' => App::Auth()->uid,
                'type' => "Files",
                'title' => $row->caption,
                'comment' => Lang::$word->ACT_RMFILE,
                'username' => App::Auth()->username,
                'fullname' => App::Auth()->fname . ' ' . App::Auth()->lname,
                'groups' => "history",
                'ip' => Url::getIP(),
                'is_activity' => 1,
                'removed' => 1
            );
            Db::run()->insert(Users::aTable, $adata);
            Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->FMG_DEL_OK));
        }
        break;
        /* == Delete Time Record == */
    case "deleteTimeRecord":
        if ($row = Db::run()->first(Project::trTable, null, array("id" => Filter::$id, 'user_id' => App::Auth()->uid))) :
            $res = Db::run()->delete(Project::trTable, array("id" => $row->id));
            if ($_POST['is_billable']) :
                Stats::setExpenseField($row->project_id);
            endif;

            if ($res) :
                Db::run()->update(Users::aTable, array('removed' => 1), array('project_id' => $row->project_id, 'comment' => $row->id, 'type' => 'Times'));
                $adata = array(
                    'company_id' => 0,
                    'project_id' => $row->project_id,
                    'invoice_id' => 0,
                    'note_id' => 0,
                    'task_id' => 0,
                    'uid' => App::Auth()->uid,
                    'username' => App::Auth()->username,
                    'fullname' => App::Auth()->fname . ' ' . App::Auth()->lname,
                    'type' => "Times",
                    'title' => $row->title,
                    'comment' => Lang::$word->ACT_RMTIME,
                    'groups' => "history",
                    'ip' => Url::getIP(),
                    'is_activity' => 1,
                    'removed' => 1
                );
                Db::run()->insert(Users::aTable, $adata);
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_TR_DEL_OK);
            else :
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            endif;
            print json_encode($json);
        endif;
        break;


        /* == Delete Expense Record == */
    case "deleteExpenseRecord":
        if ($row = Db::run()->first(Project::exTable, null, array("id" => Filter::$id, 'user_id' => App::Auth()->uid))) :
            $res = Db::run()->delete(Project::exTable, array("id" => $row->id));
            if ($_POST['is_billable']) :
                Stats::setExpenseField($row->project_id);
            endif;

            if ($res) :
                Db::run()->update(Users::aTable, array('removed' => 1), array('project_id' => $row->project_id, 'comment' => $row->id, 'type' => 'Expenses'));
                $adata = array(
                    'company_id' => 0,
                    'project_id' => $row->project_id,
                    'invoice_id' => 0,
                    'note_id' => 0,
                    'task_id' => 0,
                    'uid' => App::Auth()->uid,
                    'username' => App::Auth()->username,
                    'fullname' => App::Auth()->fname . ' ' . App::Auth()->lname,
                    'type' => "Expenses",
                    'title' => $row->title,
                    'comment' => Lang::$word->ACT_RMEXPENSE,
                    'groups' => "history",
                    'ip' => Url::getIP(),
                    'is_activity' => 1,
                    'removed' => 1
                );
                Db::run()->insert(Users::aTable, $adata);
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_ER_DEL_OK);
            else :
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            endif;
            print json_encode($json);
        endif;
        break;

endswitch;

/* == Clear Session Temp Queries == */
if (isset($_GET['ClearSessionQueries'])) :
    App::Session()->remove('debug-queries');
    App::Session()->remove('debug-warnings');
    App::Session()->remove('debug-errors');
    print 1;
endif;
