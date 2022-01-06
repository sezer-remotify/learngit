<?php

/**
 * Controller
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: controller.php, v1.00 2019-08-05 10:12:05 gewa Exp $
 */
define("_WOJO", true);
require_once("../../init.php");

if (!App::Auth()->is_Admin())
    exit;

$delete = Validator::post('delete');
$trash = Validator::post('trash');
$action = Validator::post('action');
$restore = Validator::post('restore');
$archive = Validator::post('archive');
$unarchive = Validator::post('unarchive');
$title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

/* == Actions == */
switch ($action):
    /* == Advanced Search ==*/
	case "advancedSearch":
		App::Users()->advancedSearch();
		break;
		/* == Confirm User Skill ==*/
	case "processSkillConfirm":
		App::Users()->processSkillConfirm();
		break;
		/* == Add Note Freelancer from Page==*/
	case "addUserNotesAtPage":
		App::Users()->addUserNotesAtPage();
		break;
		/* == Approval Status==*/
	case "approvalStatus":
		App::Users()->approvalStatus();
		break;
		/* == Update Short CV  ==*/
	case "updateShortCV":
		App::Users()->updateShortCV();
		break;
		/* == Update Reference Check  ==*/
	case "updateReferenceCheck":
		App::Users()->updateReferenceCheck();
		break;
        /* == Process Project Temp Files == */
    case "tempProjectFiles":
        App::Project()->tempProjectFiles();
        break;
        /* == Process Timerecord == */
    case "processTimeRecord":
        App::Project()->processTimeRecord();
        break;
        /* == Process Expense Record == */
    case "processExpenseRecord":
        App::Project()->processExpenseRecord();
        break;
        /* == Process Task == */
    case "processTask":
        App::Task()->processTask();
        break;
        /* == Process Task List == */
    case "processTaskList":
        App::Project()->processTaskList();
        break;
        /* == Process Message == */
    case "processMessage":
        App::Comments()->processMessage();
        break;
        /* == Process Discussion == */
    case "processDiscussion":
        App::Comments()->processDiscussion();
        break;
        /* == Process Project == */
    case "processProject":
        App::Project()->processProject();
        break;
        /* == Project Invite == */
    case "projectInvite":
        App::Project()->projectInvite();
        break;
        /* == Send Invitations == */
    case "invitePople":
        App::Users()->invitePople();
        break;
        /* == Process Company == */
    case "processCompany":
        App::Company()->processCompany();
        break;
        /* == Process Template == */
    case "processTemplate":
        App::Content()->processTemplate();
        break;
        /* == Process Gateway == */
    case "processGateway":
        App::Admin()->processGateway();
        break;
        /* == Update Account == */
    case "updateAccount":
        App::Admin()->updateAccount();
        break;
        /* == Update Password == */
    case "updatePassword":
        App::Admin()->updateAdminPassword();
        break;
        /* == Process Event == */
    case "processEvent":
        App::Content()->processEvent();
        break;
        /* == Process Note == */
    case "processNote":
        App::Content()->processNote();
        break;
        /* == Process Invoice == */
    case "processInvoice":
        App::Project()->processInvoice();
        break;
        /* == Process Estimate == */
    case "processEstimate":
        App::Content()->processEstimate();
        break;
        /* == Process Configuration == */
    case "processConfig":
        App::Core()->processConfig();
        break;
endswitch;

/* == Trash Actions == */
switch ($trash):
        /* == Trash Estimate == */
    case "trashEstimate":
        if ($row = Db::run()->first(Content::esTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "estimate", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            Db::run()->delete(Content::esTable, array("id" => $row->id));

            $adata = array(
                'invoice_id' => $row->id,
                'uid' => App::Auth()->uid,
                'type' => "Estimates",
                'title' => $title,
                'username' => Auth::$userdata->username,
                'fullname' => App::Auth()->name,
                'groups' => "estimate",
            );

            Db::run()->insert(Users::aTable, $adata);
            $json['type'] = "success";
        endif;

        $json['title'] = Lang::$word->SUCCESS;
        $json['message'] = str_replace("[NAME]", $title, Lang::$word->EST_TRASH_OK);
        print json_encode($json);
        break;

        /* == Trash Time Record == */
    case "trashTimeRecord":
        if ($row = Db::run()->first(Project::trTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "trecord", 'dataset' => json_encode($row));
            $res = Db::run()->delete(Project::trTable, array("id" => $row->id));
            Db::run()->insert(Core::txTable, $data);
            if ($_POST['is_billable']) :
                Stats::setExpenseField($row->project_id);
            endif;

            if ($res) :
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_TRASH1_OK);
            else :
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            endif;
            print json_encode($json);
        endif;
        break;

        /* == Trash Expense Record == */
    case "trashExpenseRecord":
        if ($row = Db::run()->first(Project::exTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "execord", 'dataset' => json_encode($row));
            $res = Db::run()->delete(Project::exTable, array("id" => $row->id));
            Db::run()->insert(Core::txTable, $data);
            if ($_POST['is_billable']) :
                Stats::setExpenseField($row->project_id);
            endif;

            if ($res) :
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_TRASH2_OK);
            else :
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            endif;
            print json_encode($json);
        endif;
        break;


        /* == Trash Note == */
    case "trashNote":
        if ($row = Db::run()->first(Project::nTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "note", 'dataset' => serialize($row));
            Db::run()->insert(Core::txTable, $data);
            $res = Db::run()->delete(Project::nTable, array("id" => $row->id));
            Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->NOT_TRASH_OK));

            $adata = array(
                'project_id' => intval($_POST['pid']),
                'note_id' => $row->id,
                'uid' => App::Auth()->uid,
                'type' => "Notes",
                'title' => $title,
                'username' => Auth::$userdata->username,
                'fullname' => App::Auth()->name,
                'groups' => "note"
            );

            Db::run()->insert(Users::aTable, $adata);
        endif;
        break;

        /* == Trash Time Record Task == */
    case "trashTimeRecordTask":
        if ($row = Db::run()->first(Project::trTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "trecord", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            $res = Db::run()->delete(Project::trTable, array("id" => $row->id));
            if ($_POST['is_billable']) :
                Stats::setExpenseField(intval($_POST['project_id']));
            endif;

            $h = Db::run()->first(Project::trTable, array("COALESCE(SUM(hours), 0) as hours"), array("task_id" => intval($_POST['task_id'])));
            if ($res) :
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_TRASH1_OK);
                $json['totalHours'] = Utility::decimalToHour($h->hours);
            else :
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            endif;
            print json_encode($json);

            $tdata = array(
                'project_id' => intval($_POST['project_id']),
                'task_id' => intval($_POST['task_id']),
                'uid' => App::Auth()->uid,
                'type' => "Tasks",
                'title' => "NULL",
                'comment' => str_replace(array("[A]", "[B]"), array($title, Validator::sanitize($_POST['taskname'], "string")), Lang::$word->ACT_012),
                'groups' => "tasks",
                'ip' => Url::getIP(),
                'is_activity' => 1,
            );
            Users::addSmallActivity($tdata);
        endif;
        break;

        /* == Trash Expense Record Task == */
    case "trashExpenseRecordTask":
        if ($row = Db::run()->first(Project::exTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "execord", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            $res = Db::run()->delete(Project::exTable, array("id" => $row->id));
            if ($_POST['is_billable']) :
                Stats::setExpenseField(intval($_POST['project_id']));
            endif;
            $a = Db::run()->first(Project::exTable, array("COALESCE(SUM(amount), 0) as amount"), array("task_id" => (int)$_POST['task_id']));
            if ($res) :
                $json['type'] = 'success';
                $json['title'] = Lang::$word->SUCCESS;
                $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_TRASH2_OK);
                $json['totalAmount'] = Utility::formatNumber($a->amount);
            else :
                $json['type'] = 'alert';
                $json['title'] = Lang::$word->ALERT;
                $json['message'] = Lang::$word->NOPROCCESS;
            endif;
            print json_encode($json);

            $tdata = array(
                'project_id' => intval($_POST['project_id']),
                'task_id' => Filter::$id,
                'uid' => App::Auth()->uid,
                'type' => "Tasks",
                'title' => "NULL",
                'comment' => str_replace(array("[A]", "[B]"), array($title, Validator::sanitize($_POST['taskname'], "string")), Lang::$word->ACT_013),
                'groups' => "tasks",
                'ip' => Url::getIP(),
                'is_activity' => 1,
            );
            Users::addSmallActivity($tdata);
        endif;
        break;

        /* == Trash Message == */
    case "trashMessage":
        if ($row = Db::run()->first(Comments::mTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "discussion", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            $res = Db::run()->delete(Comments::mTable, array("id" => $row->id));
            if ($result = Db::run()->select(Comments::mTable, null, array("parent_id" => $row->id))->results()) :
                foreach ($result as $usr) :
                    $dataArray[] = array(
                        'type' => "message",
                        'dataset' => json_encode($usr),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArray);
                Db::run()->delete(Comments::mTable, array("parent_id" => $row->id));
            endif;
            Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->MSG_TRASH2_OK));
        endif;
        break;

        /* == Trash Discussion Message == */
    case "trashDiscMessage":
        if ($row = Db::run()->first(Comments::mTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "message", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            $res = Db::run()->delete(Comments::mTable, array("id" => $row->id));
            Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->MSG_TRASH2_OK));

            $adata = array(
                'project_id' => intval($_POST['pid']),
                'message_id' => $row->parent_id,
                'uid' => App::Auth()->uid,
                'type' => "Messages",
                'title' => $title,
                'username' => Auth::$userdata->username,
                'fullname' => App::Auth()->name,
                'groups' => "discussion"
            );

            Db::run()->insert(Users::aTable, $adata);
        endif;
        break;

        /* == Trash Task List == */
    case "trashTaskList":
        $res = Db::run()->update(Task::tlTable, array("status" => 2), array("name" => $title, "project_id" => Filter::$id));
        $row = Db::run()->first(Task::tlTable, array("id"), array("name" => $title, "project_id" => Filter::$id));
        Db::run()->update(Task::tTable, array("status" => 2), array("task_list_id" => $row->id, "project_id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->TSK_TRASH_OK));
        break;

        /* == Trash Task == */
    case "trashTask":
        if ($row = Db::run()->first(Task::tTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "task", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            Db::run()->delete(Task::tTable, array("id" => $row->id));

            $adata = array(
                'project_id' => $row->id,
                'task_id' => Filter::$id,
                'uid' => App::Auth()->uid,
                'type' => "Tasks",
                'title' => $title,
                'comment' => Lang::$word->ACT_005,
                'groups' => "history",
                'ip' => Url::getIP(),
            );

            Users::addSmallActivity($adata);
            $json['type'] = "success";
        endif;

        $json['title'] = Lang::$word->SUCCESS;
        $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_TRASH1_OK);
        print json_encode($json);
        break;

        /* == Trash Project == */
    case "trashProject":
        if ($row = Db::run()->first(Project::pTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "project", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            Db::run()->delete(Project::pTable, array("id" => $row->id));
            //expenses
            if ($result = Db::run()->select(Project::exTable, null, array("project_id" => $row->id))->results()) :
                foreach ($result as $item) :
                    $dataArraye[] = array(
                        'type' => "execord",
                        'dataset' => json_encode($item),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArraye);
                Db::run()->delete(Project::exTable, array("project_id" => $row->id));
            endif;

            //files
            if ($result = Db::run()->select(Project::fTable, null, array("project_id" => $row->id))->results()) :
                foreach ($result as $item) :
                    $dataArrayf[] = array(
                        'type' => "files",
                        'dataset' => json_encode($item),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArrayf);
                Db::run()->delete(Project::fTable, array("project_id" => $row->id));
            endif;

            //notes
            if ($result = Db::run()->select(Project::nTable, null, array("project_id" => $row->id))->results()) :
                foreach ($result as $item) :
                    $dataArrayn[] = array(
                        'type' => "notes",
                        'dataset' => json_encode($item),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArrayn);
                Db::run()->delete(Project::nTable, array("project_id" => $row->id));
            endif;

            //tasks
            if ($result = Db::run()->select(Task::tTable, null, array("project_id" => $row->id))->results()) :
                foreach ($result as $item) :
                    $dataArrayt[] = array(
                        'type' => "task",
                        'dataset' => json_encode($item),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArrayt);
                Db::run()->delete(Task::tTable, array("project_id" => $row->id));
            endif;

            //timerecords
            if ($result = Db::run()->select(Project::trTable, null, array("project_id" => $row->id))->results()) :
                foreach ($result as $item) :
                    $dataArrayr[] = array(
                        'type' => "trecord",
                        'dataset' => json_encode($item),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArrayr);
                Db::run()->delete(Project::trTable, array("project_id" => $row->id));
            endif;

            $adata = array(
                'project_id' => $row->id,
                'uid' => App::Auth()->uid,
                'type' => "Projects",
                'title' => $title,
                'username' => App::Auth()->username,
                'fullname' => App::Auth()->name,
                'groups' => "project",
            );

            Db::run()->insert(Users::aTable, $adata);
            $json['type'] = "success";
        endif;
        $json['title'] = Lang::$word->SUCCESS;
        $json['message'] = str_replace("[NAME]", $title, Lang::$word->PRJ_TRASH_OK);
        print json_encode($json);
        break;

        /* == Trash User == */
    case "trashUser":
        if ($row = Db::run()->first(Users::mTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "user", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            Db::run()->delete(Users::mTable, array("id" => $row->id));
            $json['type'] = "success";
        endif;

        $json['title'] = Lang::$word->SUCCESS;
        $json['message'] = str_replace("[NAME]", $title, Lang::$word->MAC_TRASHED);
        print json_encode($json);
        break;

        /* == Trash Company == */
    case "trashCompany":
        if ($row = Db::run()->first(Company::cTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "company", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            $res = Db::run()->delete(Company::cTable, array("id" => $row->id));

            if ($result = Db::run()->select(Users::mTable, null, array("company" => $row->id))->results()) :
                $query = "UPDATE `" . Users::mTable . "` SET status = CASE ";
                $idlist = '';
                foreach ($result as $usr) :
                    $dataArray[] = array(
                        'type' => "user",
                        'dataset' => json_encode($usr),
                    );

                    $val = 1;
                    $query .= " WHEN id = " . $usr->id . " THEN status + " . $val . " ";
                    $idlist .= $usr->id . ',';
                endforeach;
                $idlist = substr($idlist, 0, -1);
                $query .= "
						  END
						  WHERE id IN (" . $idlist . ")";
                Db::run()->insertBatch(Core::txTable, $dataArray, true);
                Db::run()->pdoQuery($query);
                Db::run()->delete(Users::mTable, array("company" => $row->id));
                $json['type'] = "success";
                Company::addCompanyHistory(Filter::$id, Lang::$word->MOVTOTR);
            endif;

            $json['title'] = Lang::$word->SUCCESS;
            $json['type'] = "success";
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->CMP_TRASHED);
            print json_encode($json);
        endif;
        break;

        /* == Trash Calendar == */
    case "trashCalendar":
        if ($row = Db::run()->first(Content::clTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "calendar", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            Db::run()->delete(Content::clTable, array("id" => $row->id));

            //events
            if ($result = Db::run()->select(Content::cleTable, null, array("calendar_id" => $row->id))->results()) :
                foreach ($result as $item) :
                    $dataArraye[] = array(
                        'type' => "calevent",
                        'dataset' => json_encode($item),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArraye);
                Db::run()->delete(Content::cleTable, array("calendar_id" => $row->id));
            endif;

            //users
            if ($result = Db::run()->select(Content::cluTable, null, array("calendar_id" => $row->id))->results()) :
                foreach ($result as $item) :
                    $dataArrayu[] = array(
                        'type' => "calusers",
                        'dataset' => json_encode($item),
                    );
                endforeach;
                Db::run()->insertBatch(Core::txTable, $dataArrayu);
                Db::run()->delete(Content::cluTable, array("calendar_id" => $row->id));
            endif;
            $json['type'] = "success";
        endif;
        $json['message'] = str_replace("[NAME]", $title, Lang::$word->CAL_TRASHED);
        $json['title'] = Lang::$word->SUCCESS;
        print json_encode($json);
        break;

        /* == Trash Event == */
    case "trashEvent":
        if ($row = Db::run()->first(Content::cleTable, null, array("id" => Filter::$id))) :
            $data = array('type' => "event", 'dataset' => json_encode($row));
            Db::run()->insert(Core::txTable, $data);
            $res = Db::run()->delete(Content::cleTable, array("id" => $row->id));
            Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->CAL_ETRASHED));
        endif;
        break;
endswitch;

/* == Archive Actions == */
switch ($archive):
        /* == Archive User == */
    case "archiveUser":
        if (Db::run()->update(Users::mTable, array('status' => 3, 'active' => "n"), array("id" => Filter::$id))) :
            $json['type'] = "success";
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->MAC_ARCHIVED);
            print json_encode($json);
        endif;
        break;

        /* == Archive Company == */
    case "archiveCompany":
        $res = Db::run()->update(Company::cTable, array('status' => 3), array("id" => Filter::$id));
        if ($result = Db::run()->select(Users::mTable, null, array("company" => Filter::$id))->results()) :
            $query = "UPDATE `" . Users::mTable . "` SET status = CASE ";
            $idlist = '';
            foreach ($result as $usr) :
                $val = 2;
                $query .= " WHEN id = " . $usr->id . " THEN status + " . $val . " ";
                $idlist .= $usr->id . ',';
            endforeach;
            $idlist = substr($idlist, 0, -1);
            $query .= "
					  END
					  WHERE id IN (" . $idlist . ")";
            Db::run()->pdoQuery($query);
            $json['type'] = "success";
            Company::addCompanyHistory(Filter::$id, Lang::$word->MOVTOA);
        endif;

        $json['title'] = Lang::$word->SUCCESS;
        $json['message'] = str_replace("[NAME]", $title, Lang::$word->CMP_ARCHIVED);
        print json_encode($json);
        break;

        /* == Archive Invoice == */
    case "archiveInvoice":
        if (Db::run()->update(Project::ivTable, array('status' => 2), array("id" => Filter::$id))) :
            $json['type'] = "success";
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->INV_ARCH_OK);
            print json_encode($json);
        endif;
        break;

endswitch;

/* == Restore Actions == */
switch ($restore):
        /* == Restore Task == */
    case "restoreTask":
        if (Db::run()->update(Task::tTable, array('status' => 1), array("id" => Filter::$id))) :
            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_RESTORE_OK);
            $json['counter'] = Db::run()->count(Task::tTable, "status = 3 AND project_id = " . intval($_POST['pid']));
            $data = array(
                'project_id' => intval($_POST['pid']),
                'task_id' => Filter::$id,
                'uid' => App::Auth()->uid,
                'type' => "Tasks",
                'title' => "NULL",
                'comment' => Lang::$word->ACT_002,
                'groups' => "history",
                'ip' => Url::getIP(),
                'is_activity' => 0,
            );
            Users::addSmallActivity($data);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Company == */
    case "restoreCompany":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Users::cTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->CL_ARCH_COK1);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore User == */
    case "restoreUser":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Users::mTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->CL_ARCH_OK1);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Project == */
    case "restoreProject":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Project::pTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->PRJ_REST_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Task == */
    case "restoreTaskAlt":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Project::tTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_RESTORE_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Time Record == */
    case "restoreTrecord":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Project::trTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_REST_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Expense Record == */
    case "restoreErecord":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Project::exTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->TSK_REST1_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Note == */
    case "restoreNote":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Project::nTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->NOT_RES_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Discussion == */
    case "restoreMessage":
    case "restoreDiscussion":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Comments::mTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->MSG_RES_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Calendar == */
    case "restoreCalendar":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Content::clTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->CAL_RESTORED);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Event == */
    case "restoreEvent":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Content::cleTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->CAL_ERESTORED);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Invoice == */
    case "restoreInvoice":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Project::ivTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->INV_RES_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;

        /* == Restore Estimate == */
    case "restoreEstimate":
        if ($row = Db::run()->first(Core::txTable, null, array("id" => Filter::$id))) :
            $data = (array)Utility::jSonToArray($row->dataset);
            Db::run()->insert(Content::esTable, $data);
            Db::run()->delete(Core::txTable, array("id" => Filter::$id));

            $json['type'] = 'success';
            $json['title'] = Lang::$word->SUCCESS;
            $json['message'] = str_replace("[NAME]", $title, Lang::$word->EST_RES_OK);
        else :
            $json['type'] = 'alert';
            $json['title'] = Lang::$word->ALERT;
            $json['message'] = Lang::$word->NOPROCCESS;
        endif;

        print json_encode($json);
        break;
endswitch;

/* == Unarchive Actions == */
switch ($unarchive):
        /* == unArchive User == */
    case "unArchiveUser":
        $res = Db::run()->update(Users::mTable, array('status' => 1, 'active' => "y"), array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->MAC_RESTORED));
        break;

        /* == unArchive Company == */
    case "unArchiveCompany":
        $res = Db::run()->update(Company::cTable, array('status' => 1), array("id" => Filter::$id));
        if ($result = Db::run()->select(Users::mTable, null, array("company" => Filter::$id))->results()) :
            $query = "UPDATE `" . Users::mTable . "` SET status = CASE ";
            $idlist = '';
            foreach ($result as $usr) :
                $val = 0;
                $query .= " WHEN id = " . $usr->id . " THEN status + " . $val . " ";
                $idlist .= $usr->id . ',';
            endforeach;
            $idlist = substr($idlist, 0, -1);
            $query .= "
					  END
					  WHERE id IN (" . $idlist . ")";
            Db::run()->pdoQuery($query);
        endif;
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->CMP_RESTORED));
        Company::addCompanyHistory(Filter::$id, Lang::$word->RESFRA);
        break;
endswitch;

/* == Delete Actions == */
switch ($delete):
        /* == Delete File == */
    case "deleteFile":
        $res = Db::run()->delete(Project::fTable, array('id' => Filter::$id));
        File::deleteFile(UPLOADS . "/files/" . $_POST['name']);
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->FMG_DEL_OK));
        break;

        /* == Delete Team == */
    case "deleteTeam":
        if ($row = Db::run()->delete(Company::tmTable, array("id" => Filter::$id))) :
            Db::run()->delete(Company::tuTable, array("team_id" => Filter::$id));
            $json['type'] = "success";
        endif;

        $json['title'] = Lang::$word->SUCCESS;
        $json['message'] = str_replace("[NAME]", $title, Lang::$word->TMS_DELETED);
        print json_encode($json);
        break;

        /* == Delete Company == */
    case "deleteCompany":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->CL_COM_DEL_OK));
        break;

        /* == Delete User == */
    case "deleteUser":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->CL_USR_DEL_OK));
        break;

        /* == Delete Project == */
    case "deleteProject":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->PRJ_DEL_OK));
        break;

        /* == Delete Task == */
    case "deleteTask":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->TSK_DEL_OK));
        break;

        /* == Delete Time Record == */
    case "deleteTrecord":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->TSK_TR_DEL_OK));
        break;

        /* == Delete Expense Record == */
    case "deleteErecord":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->TSK_ER_DEL_OK));
        break;

        /* == Delete Note == */
    case "deleteNote":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->NOT_DEL_OK));
        break;

        /* == Delete Message == */
    case "deleteDiscussion":
    case "deleteMessage":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->MSG_DEL_OK));
        break;

        /* == Delete Calendar == */
    case "deleteCalendar":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->CAL_DELETED));
        break;

        /* == Delete Event == */
    case "deleteEvent":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->CAL_EDELETED));
        break;

        /* == Delete Invoice == */
    case "deleteInvoice":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->INV_DEL_OK));
        break;

        /* == Delete Estimate == */
    case "deleteEstimate":
        $res = Db::run()->delete(Core::txTable, array("id" => Filter::$id));
        Message::msgReply($res, 'success', str_replace("[NAME]", $title, Lang::$word->EST_DEL_OK));
        break;

        /* == Delete All == */
    case "trashAll":
        Db::run()->truncate(Core::txTable);
        Message::msgReply(true, 'success', Lang::$word->TRASH_DEL_OK);
        break;
endswitch;
