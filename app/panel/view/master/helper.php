<?php

/**
 * Helper
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: helper.php, v1.00 2019-08-05 10:12:05 gewa Exp $
 */
define("_WOJO", true);
require_once("../../init.php");

if (!App::Auth()->is_Freelancer() && !App::Auth()->is_Client())
	exit;

$gAction = Validator::get('action');
$pAction = Validator::post('action');
$iAction = Validator::post('iaction');
$title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

switch ($gAction):
		/* == Get Expense Record Weekly == */
	case "getExpRecordWeekly":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->pheader = Utility::renderTimeRecordHeader(Validator::sanitize($_GET['date'], "date"));
		$dates = iterator_to_array($tpl->pheader);
		$tpl->results = App::Project()->getProjectExpenseRecords(Filter::$id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
		$tpl->currency = (isset($_GET['currency'])) ? Validator::sanitize($_GET['currency']) : App::Core()->currency;
		$tpl->template = 'loadExpensesWeekly.tpl.php';
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;
		/* == Get Time Record Weekly == */
	case "getTimeRecordWeekly":
		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->pheader = Utility::renderTimeRecordHeader(Validator::sanitize($_GET['date'], "date"));
		$dates = iterator_to_array($tpl->pheader);
		$tpl->results = App::Project()->getProjectTimeRecords(Filter::$id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
		$tpl->template = 'loadTimeWeekly.tpl.php';
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Edit Time Record == */
	case "editTimeRecord":
		if ($row = App::Project()->getTimeRecordById(Filter::$id)) :
			$json['type'] = "success";
			$json['short_date'] = Date::doDate("MMMM dd, yyyy", $row->created);
			$json['input_date'] = Date::doDate("MM/dd/yyyy", $row->created);
			$json['data'] = $row;
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Edit Expense Record == */
	case "editExpenseRecord":
		if ($row = App::Project()->getExpenseRecordById(Filter::$id)) :
			$json['type'] = "success";
			$json['short_date'] = Date::doDate("MMMM dd, yyyy", $row->created);
			$json['input_date'] = Date::doDate("MM/dd/yyyy", $row->created);
			$json['data'] = $row;
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;
endswitch;

/* == Instant Actions == */
switch ($iAction):
		/* == Remove Note == */
	case "removeNote":
		if (!$row = Db::run()->first(Project::nTable, null, array('created_by_id' => Auth::$udata->uid, 'id' => Filter::$id)))
			Message::msgReply(Db::run()->affected(), 'error', Lang::$word->NOT_INV);
		else {
			$frow =  Db::run()->select(Project::fTable, null, array('note_id' => Filter::$id))->results();
			foreach ($frow as $f) {
				File::deleteFile(UPLOADS . '/files/' . $f->name);
			}
			Db::run()->delete(Project::fTable, array('note_id' => Filter::$id));
			Db::run()->delete(Project::ftTable, array('note_id' => Filter::$id));
			Db::run()->delete(Project::sbTable, array('note_id' => Filter::$id));
			Db::run()->delete(Project::nTable, array('id' => Filter::$id));
			Db::run()->update(Users::aTable, array('removed' => 1), array('project_id' => $row->project_id, 'note_id' => Filter::$id));
			$adata = array(
				'project_id' => $row->project_id,
				'note_id' => Filter::$id,
				'uid' => App::Auth()->uid,
				'type' => "Notes",
				'comment' => Lang::$word->ACT_RMNOTE,
				'title' => $row->name,
				'username' => App::Auth()->username,
				'fullname' => App::Auth()->fname . ' ' . App::Auth()->lname,
				'groups' => "history",
				'ip' => Url::getIP(),
				'removed' => 1,
			);
			Db::run()->insert(Users::aTable, $adata);
			Message::msgReply(Db::run()->affected(), 'success', Lang::$word->NOT_REM_OK);
		}
		break;
		/* == Estimate Mark Won == */
	case "estimateMarkWon":
		if (Db::run()->update(Content::esTable, array("status" => 3), array("id" => filter::$id))) :
			$json['type'] = "success";
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Estimate Mark Lost == */
	case "estimateMarkLost":
		if (Db::run()->update(Content::esTable, array("status" => 2), array("id" => filter::$id))) :
			$json['type'] = "success";
		else :
			$json['type'] = "error";
		endif;
		print json_encode($json);
		break;

		/* == Set Note Hidden Status == */
	case "noteHiddenSatatus":
		Db::run()->update(Project::nTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'note_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Notes",
			'title' => Validator::sanitize($_POST['notename']),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_016 : Lang::$word->ACT_017,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Note Subscribers == */
	case "noteSubscribersStatus":
		if ($_POST['status']) :
			Db::run()->insert(Project::sbTable, array('user_id' => Validator::sanitize($_POST['uid'], "int"), 'note_id' => Filter::$id));
		else :
			Db::run()->delete(Project::sbTable, array('user_id' => Validator::sanitize($_POST['uid'], "int"), 'note_id' => Filter::$id));
		endif;
		break;

		/* == Set File Hidden Status== */
	case "fileHiddenSatatus":
		Db::run()->update(Project::fTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		$data['icon'] = $_POST['status'] ? '<i class="icon mask"></i>' : '';
		$data['html'] = $_POST['status'] ? Lang::$word->FMG_SUB2 : Lang::$word->FMG_SUB1;
		print json_encode($data);
		break;

		/* == Load Message Body == */
	case "getMessageBody":
		if ($row = Db::run()->first(Comments::mTable, array("body"), array("id" => Filter::$id))) :
			$json['type'] = 'success';
			$json['body'] = $row->body;
		else :
			$json['type'] = 'error';
		endif;
		print json_encode($json);
		break;

		/* == Set Message Hidden Status== */
	case "messageHiddenSatatus":
		Db::run()->update(Comments::mTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		Db::run()->update(Comments::mTable, array("is_hidden" => intval($_POST['status'])), array('parent_id' => Filter::$id));
		$data = array(
			'message_id' => Filter::$id,
			'project_id' => intval($_POST['pid']),
			'uid' => App::Auth()->uid,
			'type' => "Messages",
			'title' => Validator::sanitize($_POST['discname']),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_016 : Lang::$word->ACT_017,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Message Subscribers == */
	case "messageSubscribersStatus":
		if ($_POST['status']) :
			Db::run()->insert(Project::sbTable, array('user_id' => intval($_POST['uid']), 'message_id' => Filter::$id));
		else :
			Db::run()->delete(Project::sbTable, array('user_id' => intval($_POST['uid']), 'message_id' => Filter::$id));
		endif;
		break;

		/* == Update Project Permissions == */
	case "pperm":
		if ($_POST['field'] == "project_id") :
			Db::run()->delete(Project::pxTable, array('project_id' => Filter::$id, 'user_id' => intval($_POST['value'])));
		endif;
		break;

		/* == Update Project Leader Status == */
	case "pstatus":
		if ($_POST['field'] == "leader_id") :
			$data = array(
				'leader_id' => intval($_POST['value']),
				'leader_name' => Db::run()->getValueById(Users::mTable, "CONCAT(fname,' ',lname)", intval($_POST['value']))
			);
			Db::run()->update(Project::pTable, $data, array('id' => Filter::$id));
		endif;
		break;

		/* == Add Project Permissions == */
	case "addperm":
		if ($_POST['type'] == "staff" or $_POST['type'] == "client") :
			$data = array(
				'user_id' => intval($_POST['uid']),
				'project_id' => Filter::$id
			);
			Db::run()->insert(Project::pxTable, $data);
		else :
			if (!empty($_POST['uid'])) :
				$ausers = array_unique($_POST['uid']);
				foreach ($ausers as $k => $uid) :
					Db::run()->delete(Project::pxTable, array('user_id' => $uid, 'project_id' => Filter::$id));
					$datapArray[] = array(
						'user_id' => $uid,
						'project_id' => FIlter::$id,
					);
				endforeach;
			endif;
			Db::run()->insertBatch(Project::pxTable, $datapArray);
		endif;
		break;

		/* == Reopen Project == */
	case "reopenProject":
		$data = array(
			'status' => 1,
			'completed' => 'NULL',
			'completed_by_id' => 0,
			'completed_by_name' => 'NULL'
		);
		Db::run()->update(Project::pTable, $data, array('id' => Filter::$id));

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Complete Project == */
	case "completeProject":
		$data = array(
			'status' => 4,
			'completed' => Db::toDate(),
			'completed_by_id' => App::Auth()->uid,
			'completed_by_name' => App::Auth()->name
		);
		Db::run()->update(Project::pTable, $data, array('id' => Filter::$id));

		$udata = array(
			'uid' => App::Auth()->uid,
			'type' => "Projects",
			'project_id' => Filter::$id,
			'groups' => "projectc",
			'username' => App::Auth()->name,
			'title' => Validator::sanitize($_POST['name'], "string"),
			'is_activity' => 1,
			'ip' => Url::getIP()
		);
		Db::run()->insert(Users::aTable, $udata);

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Remove Files == */
	case "removeTaskFile":
	case "removeDiscFile":
	case "removeProjectFile":
	case "removeNoteFile":
		$name = Validator::sanitize($_POST['name']);
		File::deleteFile(UPLOADS . '/files/' . $name);
		Db::run()->delete(Project::fTable, array("name" => $name));
		Db::run()->delete(Project::ftTable, array("name" => $name));
		$json['type'] = "success";
		print json_encode($json);
		break;
		/* == remove temp project files == */
	case "removeProjectTempFile":
		$caption = Validator::sanitize($_POST['name']);
		$id = Filter::$id;
		if ($row = Db::run()->select(Project::ftTable, null, array('parent' => 'project', "caption" => $caption, 'project_id' => intval($id)), ' ORDER BY created DESC LIMIT 1')->result()) {
			File::deleteFile(UPLOADS . '/files/' . $row->name);
			Db::run()->delete(Project::ftTable, array("name" => $row->name));
			$json['type'] = "success";
			print json_encode($json);
		}
		break;

		/* == Process Attachments == */
	case "taskFiles":
	case "discussionFiles":
	case "projectFiles":
	case "noteFiles":
		if (!empty($_FILES['file']['name'])) :
			$upl = Upload::instance(App::Core()->file_size, App::Core()->file_ext);
			$upl->process("file", UPLOADS . "/files/", "FILE_");
			if (empty(Message::$msgs)) :
				$data = array(
					'caption' => $upl->fileInfo['name'],
					'parent' => strtolower(Validator::sanitize($_POST['type'], "alpha")),
					'project_id' => Filter::$id,
					'name' => $upl->fileInfo['fname'],
					'fsize' => $upl->fileInfo['size'],
					'fext' => $upl->fileInfo['ext'],
					'mime' => File::getMimeType(UPLOADS . "/files/" . $upl->fileInfo['fname']),
					'created_by_id' => Auth::$udata->uid,
					'created_by_name' => Auth::$udata->name,
				);

				$last_id = Db::run()->insert(Project::ftTable, $data)->getLastInsertId();

				$json['status'] = "success";
				$json['filename'] = $data['name'];
				$json['type'] = File::getFileType($data['name']);
				$json['icon'] = File::getFileIcon($data['name']);
				$json['color'] = File::getFileColor($data['name']);
				$json['id'] = $last_id;
			else :
				$json['status'] = "error";
				$json['message'] = Message::$msgs['name'];
			endif;
			print json_encode($json);
		endif;
		break;

		/* == Task hidden status == */
	case "taskHidden":
		Db::run()->update(Task::tTable, array("is_hidden" => intval($_POST['active'])), array("id" => Filter::$id));
		break;

		/* == Task priority == */
	case "taskPriority":
		Db::run()->update(Task::tTable, array("is_priority" => intval($_POST['active'])), array("id" => Filter::$id));
		break;

		/* == Update Tasks == */
	case "updateTasks":
		$is_add = ($_POST['add'] == "true") ?  "`task_list_id` = " . Filter::$id . "," : null;
		$i = 0;
		$query = "UPDATE `" . Task::tTable . "` SET $is_add `sorting` = CASE ";
		$idlist = '';
		foreach ($_POST['items'] as $item) :
			$i++;
			$query .= " WHEN id = " . $item . " THEN " . $i . " ";
			$idlist .= $item . ',';
		endforeach;
		$idlist = substr($idlist, 0, -1);
		$query .= "
			  END
			  WHERE id IN (" . $idlist . ")";
		Db::run()->pdoQuery($query);

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Update Task List == */
	case "updateTaskList":
		$i = 0;
		$query = "UPDATE `" . Task::tlTable . "` SET `sorting` = CASE ";
		$idlist = '';
		foreach ($_POST['items'] as $item) :
			$i++;
			$query .= " WHEN id = " . $item . " THEN " . $i . " ";
			$idlist .= $item . ',';
		endforeach;
		$idlist = substr($idlist, 0, -1);
		$query .= "
			  END
			  WHERE id IN (" . $idlist . ")";
		Db::run()->pdoQuery($query);

		$json['type'] = "success";
		print json_encode($json);
		break;

		/* == Complete Task == */
	case "completeTask":
		$data = array("status" => 3, "completed" => Db::toDate(), "completed_by_name" => App::Auth()->name, "completed_by_id" => App::Auth()->uid);
		Db::run()->update(Task::tTable, $data, array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Db::run()->getValueById(Task::tTable, "name", Filter::$id),
			'comment' => Lang::$word->ACT_001,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);

		$tpl = App::View(BASEPATH . 'view/admin/snippets/');
		$tpl->row = Stats::getTaskStatus(intval($_POST['pid']));
		$tpl->id = intval($_POST['pid']);
		$tpl->template = 'loadTaskProgress.tpl.php';

		$json['type'] = "success";
		$json['html'] = $tpl->render();
		print json_encode($json);
		break;

		/* == Set Task List == */
	case "taskUpdateList":
		Db::run()->update(Task::tTable, array("task_list_id" => intval($_POST['task_list_id'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Validator::sanitize($_POST['taskname']),
			'comment' => str_replace("[NAME]", Validator::sanitize($_POST['name'], "string"), Lang::$word->ACT_009),
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Assignee == */
	case "taskUpdateAssignee":
		$id = Validator::sanitize($_POST['assigned_id'], "int");
		Db::run()->update(Task::tTable, array("assigned_id" => $id), array('id' => Filter::$id));
		$ua = Db::run()->getValueById(Users::mTable, "avatar", $id);
		$avatar = ($ua) ? $ua : 'blank.svg';

		$json['avatar'] = UPLOADURL . '/avatars/' . $avatar;
		print json_encode($json);

		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Validator::sanitize($_POST['taskname']),
			'comment' => str_replace("[NAME]", Validator::sanitize($_POST['name'], "string"), Lang::$word->ACT_014),
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Update Label List == */
	case "taskUpdateLabels":
		$tasklabels = Utility::jSonToArray(App::Core()->tasklabels);
		$ids = explode(',', $_POST['labels']);
		$result = array_filter(
			$tasklabels,
			function ($o) use ($ids) {
				return in_array($o->id, $ids);
			}
		);
		$result = array_values($result);
		$labels = json_encode($result);

		Db::run()->update(Task::tTable, array("labels" => $labels), array('id' => Filter::$id));
		break;

		/* == Set Task Due Date == */
	case "taskDueDateSatatus":
		Db::run()->update(Task::tTable, array("due_on" => Db::toDate($_POST['duedate'], false)), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'title' => Validator::sanitize($_POST['taskname']),
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'comment' => str_replace("[DATE]", Date::doDate("short_date", $_POST['duedate']), Lang::$word->ACT_008),
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Task Hidden Status== */
	case "taskHiddenSatatus":
		Db::run()->update(Task::tTable, array("is_hidden" => intval($_POST['status'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Db::run()->getValueById(Task::tTable, "name", Filter::$id),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_016 : Lang::$word->ACT_017,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Task Priority Status== */
	case "taskPrioritySatatus":
		Db::run()->update(Task::tTable, array("is_priority" => intval($_POST['status'])), array('id' => Filter::$id));
		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Db::run()->getValueById(Task::tTable, "name", Filter::$id),
			'comment' => intval($_POST['status']) ? Lang::$word->ACT_003 : Lang::$word->ACT_004,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Set Task Subscribers == */
	case "taskSubscribersStatus":
		if ($_POST['status']) :
			Db::run()->insert(Project::sbTable, array('user_id' => intval($_POST['uid']), 'task_id' => Filter::$id));
		else :
			Db::run()->delete(Project::sbTable, array('user_id' => intval($_POST['uid']), 'task_id' => Filter::$id));
		endif;
		break;

		/* == Update Task Job == */
	case "taskUpdateJob":
		$job_hours = Validator::sanitize($_POST['job_hours'], "float");
		$job_id = Validator::sanitize($_POST['job_id'], "int");
		$category = Validator::sanitize($_POST['cat'], "string");
		Db::run()->update(
			Task::tTable,
			array(
				"job_hours" => $job_hours,
				"job_id" => $job_id
			),
			array('id' => Filter::$id)
		);

		$data = array(
			'project_id' => intval($_POST['pid']),
			'task_id' => Filter::$id,
			'uid' => App::Auth()->uid,
			'type' => "Tasks",
			'title' => Validator::sanitize($_POST['taskname']),
			'comment' => $job_id ? str_replace(array("[A]", "[B]"), array($job_hours, $category), Lang::$word->ACT_018) : Lang::$word->ACT_019,
			'groups' => "history",
			'ip' => Url::getIP(),
			'is_activity' => 0,
		);
		Users::addSmallActivity($data);
		break;

		/* == Mark Messages as Red == */
	case "markRed":
		if ($_POST['type'] == "note") :
			Db::run()->update(Project::sbTable, array("status" => 1), array('note_id' => intval($_POST['note_id']), 'user_id' => App::Auth()->uid));
			$json['success'] = true;
		elseif ($_POST['type'] == "message") :
			Db::run()->update(Project::sbTable, array("status" => 1), array('message_id' => intval($_POST['message_id']), 'user_id' => App::Auth()->uid));
			$json['success'] = true;
		else :
			Db::run()->update(Project::sbTable, array("status" => 1), array('task_id' => intval($_POST['task_id']), 'user_id' => App::Auth()->uid));
			$json['success'] = true;
		endif;
		print json_encode($json);
		break;

endswitch;

/* == Clear Session Temp Queries == */
if (isset($_GET['ClearSessionQueries'])) :
	App::Session()->remove('debug-queries');
	App::Session()->remove('debug-warnings');
	App::Session()->remove('debug-errors');
	print 1;
endif;
