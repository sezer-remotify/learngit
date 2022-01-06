<?php
  /**
   * Class Task
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: task.class.php, v1.00 2019-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');


  class Task
  {

      const tTable = 'tasks';
      const tlTable = 'task_lists';
      const tlbTable = 'task_labels';
      const tlaTable = 'task_labels_assigned';


      /**
       * Project::TaskView()
       *
	   * @param int $id
       * @return
       */
	  public function TaskView($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->TSK_TITLE3;
		  $tpl->crumbs = ['admin', Lang::$word->NAV_27];

		  if (!$row = $this->getTaskByPermission($id)) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->row = $row;
			  $tpl->puserdata = App::Project()->getProjectUsers($row->project_id);
			  $tpl->tasklists = $this->getTaskLists(1, $row->project_id);
			  $tpl->taskusers = App::Project()->getSubscribedUsers("task_id", $tpl->row->id);
			  $tpl->filedata = App::Project()->getFiles("task_id", $row->id);
			  $tpl->terow = Stats::getTaskTimeExpense($row->id);
			  $tpl->messages = App::Comments()->TaskMessages("task", $row->id);
			  $tpl->tasklabels = Utility::jSonToArray(App::Core()->tasklabels);
			  $tpl->itemlabels = Utility::jSonToArray($row->labels);
			  $tpl->template = 'admin/tasks.tpl.php';
          }
	  }

      /**
       * Task::TaskCompleted($id)
       *
       * @param int $id
       * @return
       */
	  public function TaskCompleted($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->PRJ_SUB12;
		  $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_27];

		  if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->row = $row;
			  $tpl->data = $this->getAllTasks(3, $tpl->row->id);
			  $tpl->template = 'admin/tasks.tpl.php';
          }
	  }

      /**
       * Task::processTask()
       *
       * @return
       */
      public function processTask()
      {

          $rules = array(
              'name' => array(
                  'required|string|min_len,3|max_len,100',
                  Lang::$word->TSK_NAME
              ),
              'assignee' => array(
                  'required|numeric',
                  Lang::$word->TSK_INFO2
              ),
              'due_date' => array(
                  'required|string',
                  Lang::$word->TSK_INFO4
              ),
              'pid' => array(
                  'required|numeric',
                  Lang::$word->PRJ_INVALID_ID
              )
          );

          $filters = array(
              'name' => 'string',
              'assignee' => 'string',
              'body' => 'advanced_tags'
          );


          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
          $safe = $validate->doFilter($_POST, $filters);


          if (empty(Message::$msgs)) {
              $data = array(
                  'project_id' => $safe->pid,
                  'task_list_id' => empty($_POST['list_id']) ? 0 : intval($_POST['list_id']),
                  'name' => $safe->name,
                  'body' => $safe->body,
                  'assigned_id' => $safe->assignee,
                  'created_by_id' => App::Auth()->uid,
                  'created_by_name' => App::Auth()->name,
                  'due_on' => Db::toDate($safe->due_date, false),
                  'job_id' => empty($_POST['job_id']) ? 0 : intval($_POST['job_id']),
                  'job_hours' => empty($_POST['job_hours']) ? 0 : intval($_POST['job_hours']),
                  'is_hidden' => empty($_POST['is_hidden']) ? 0 : 1,
                  'is_priority' => empty($_POST['is_priority']) ? 0 : 1,
                  'status' => 1
              );

              if (Filter::$id) {
                  $data['updated'] = Db::toDate();
                  $data['updated_by_id'] = App::Auth()->uid;
                  $data['updated_by_name'] = App::Auth()->name;
              }

              if (isset($_POST['labels'])) {
                  $tasklabels = Utility::jSonToArray(App::Core()->tasklabels);
                  $ids = $_POST['labels'];
                  $result = array_filter($tasklabels, function($o) use ($ids)
                  {
                      return in_array($o->id, $ids);
                  });
                  $result = array_values($result);
                  $data['labels'] = json_encode($result);
              }

              (Filter::$id) ? Db::run()->update(self::tTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::tTable, $data)->getLastInsertId();

              $message = Filter::$id ? Message::formatSuccessMessage($data['name'], Lang::$word->TSK_UPDATE_OK) : Message::formatSuccessMessage($data['name'], Lang::$word->TSK_ADDED_OK);

              if (Db::run()->affected()) {
                  $json['type'] = 'success';
                  $json['title'] = Lang::$word->SUCCESS;
                  $json['message'] = $message;
                  $json['redirect'] = Url::url("/admin/projects/tasks", $safe->pid);
              } else {
                  $json['type'] = 'alert';
                  $json['title'] = Lang::$word->ALERT;
                  $json['message'] = Lang::$word->NOPROCCESS;
              }

              print json_encode($json);

              if (isset($_POST['labels'])) {
                  Db::run()->delete(self::tlaTable, array('task_id' => Filter::$id ? Filter::$id : $last_id));
                  foreach ($_POST['labels'] as $lid) {
                      $labelArray[] = array(
                          'task_id' => Filter::$id ? Filter::$id : $last_id,
                          'label_id' => $lid
                      );
                  }
                  Db::run()->insertBatch(self::tlaTable, $labelArray);
              }

              if (isset($_POST['subscribers'])) {
                  Db::run()->delete(self::sbTable, array('task_id' => Filter::$id ? Filter::$id : $last_id));
                  foreach ($_POST['subscribers'] as $sid) {
                      $sdataArray[] = array(
                          'task_id' => Filter::$id ? Filter::$id : $last_id,
                          'user_id' => $sid
                      );
                  }
                  Db::run()->insertBatch(self::sbTable, $sdataArray);
              }


              if (isset($_POST['attachment'])) {
                  $files = Db::run()->pdoQuery("SELECT * FROM `" . Project::ftTable . "` WHERE caption IN(" . Utility::implodeFields($_POST['attachment'], ",", true) . ")")->results();
                  if ($files) {
                      foreach ($files as $file) {
                          $fdataArray[] = array(
                              'caption' => $file->caption,
                              'parent' => $file->parent,
                              'project_id' => $file->project_id,
                              'task_id' => Filter::$id ? Filter::$id : $last_id,
                              'name' => $file->name,
                              'fsize' => $file->fsize,
                              'fext' => $file->fext,
                              'mime' => $file->mime,
                              'token' => Utility::randomString(16),
                              'created_by_id' => $file->created_by_id,
                              'created_by_name' => $file->created_by_name
                          );
                          Db::run()->insertBatch(self::fTable, $fdataArray);
                      }
                      Db::run()->pdoQuery("DELETE FROM `" . Project::ftTable . "` WHERE caption IN(" . Utility::implodeFields($_POST['attachment'], ",", true) . ")");
                  }
              }

              if (!Filter::$id) {
                  $adata = array(
                      'project_id' => $safe->pid,
                      'task_id' => $last_id,
                      'uid' => App::Auth()->uid,
                      'type' => "Tasks",
                      'title' => $safe->name,
                      'username' => '',
                      'fullname' => App::Auth()->name,
                      'groups' => "task",
                      'is_activity' => 1
                  );

                  Db::run()->insert(Users::aTable, $adata);
              }
          } else {
              Message::msgSingleStatus();
          }
      }

      /**
       * Task::processTaskList()
       *
       * @return
       */
      public function processTaskList()
      {

          $rules = array(
              'name' => array(
                  'required|string|min_len,3|max_len,100',
                  Lang::$word->TSK_LISTNAME
              ),
              'pid' => array(
                  'required|numeric',
                  Lang::$word->PRJ_INVALID_ID
              )
          );

          $filters = array(
              'name' => 'string'
          );


          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
          $safe = $validate->doFilter($_POST, $filters);

          if (empty(Message::$msgs)) {
              $data['name'] = $safe->name;
              $data['project_id'] = $safe->pid;

              (Filter::$id) ? Db::run()->update(self::tlTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::tlTable, $data)->getLastInsertId();

              $json['type'] = "success";
              $json['title'] = Lang::$word->SUCCESS;

              if (Filter::$id) {
                  $json['message'] = Lang::$word->TSK_LISTUPD_OK;
              } else {
                  Filter::$id = $last_id;
                  $row = Db::run()->first(self::tlTable, null, array('id' => Filter::$id));
                  $json['message'] = Lang::$word->TSK_LISTADD_OK;
                  $json['list_small'] = Utility::getSnippets(ADMINBASE . '/snippets/loadTaskListItem.tpl.php', $data = $row);
                  $json['list_big'] = Utility::getSnippets(ADMINBASE . '/snippets/loadTaskListEmpty.tpl.php', $data = $row);
              }
              print json_encode($json);

          } else {
              Message::msgSingleStatus();
          }

      }

      /**
       * Task::copyTaskList()
       *
       * @return
       */
      public function copyTaskList()
      {

          $rules = array(
              'cpid' => array(
                  'required|numeric',
                  Lang::$word->INV_SUB5_3
              ),
              'id' => array(
                  'required|numeric',
                  Lang::$word->PRJ_INVALID_ID
              )
          );

          $filters = array(
              'title' => 'string'
          );


          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
          $safe = $validate->doFilter($_POST, $filters);


          if (empty(Message::$msgs)) {
              $last_id = Db::run()->insert(self::tlTable, array("project_id" => $safe->cpid, "name" => $safe->title))->getLastInsertId();
              $tasks = Db::run()->select(self::tTable, null, array("task_list_id" => $safe->id, "status" => 1))->results();

              foreach ($tasks as $row) {
                  $dataArray[] = array(
                      'project_id' => $safe->cpid,
                      'task_list_id' => $last_id,
                      "name" => $row->name,
                      "body" => $row->body,
                      "assigned_id" => $row->assigned_id,
                      "created_by_id" => $row->created_by_id,
                      "created_by_name" => $row->created_by_name,
                      "due_on" => $row->due_on,
                      "job_id" => $row->job_id,
                      "job_hours" => $row->job_hours,
                      "labels" => $row->labels,
                      "status" => 1
                  );
              }
              Db::run()->insertBatch(self::tTable, $dataArray);

              Message::msgModalReply($last_id, 'success', str_replace("[NAME]", $safe->title, Lang::$word->TSK_COPY_OK), '');
          } else {
              Message::msgSingleStatus();
          }

      }


      /**
       * Task::getAllTasks()
       *
       * @param integer $status
       * @param bool $pid
       * @return
       */
      public function getAllTasks($status = 1, $id)
      {

          $sql = "SELECT
            t.name,
            t.created,
            t.completed,
            t.completed_by_name,
            t.due_on,
            t.labels,
            t.is_priority,
            t.id,
            t.task_list_id,
            t.is_hidden,
            m.avatar,
            m.id AS mid,
            CONCAT(m.fname,' ',m.lname) as fullname
          FROM `" . self::tTable . "` AS t
          LEFT JOIN `" . Users::mTable . "` AS m   ON t.assigned_id = m.id
          WHERE t.status = ?
          AND t.project_id = ?
          ORDER BY t.sorting, t.created;";

          $row = Db::run()->pdoQuery($sql, array($status, $id))->results();

          return ($row) ? $row : 0;
      }



      /**
       * Task::getTaskLists()
       *
       * @param integer $status
       * @param bool $pid
       * @return
       */
      public function getTaskLists($status = 1, $id)
      {

          $sql = "SELECT  tl.*, COUNT(IF(t.status = 1, 1, NULL)) AS total
          FROM `" . self::tlTable . "` AS tl
          LEFT JOIN `" . self::tTable . "` AS t  ON tl.id = t.task_list_id
          WHERE tl.project_id = ?
          AND tl.status = ?
          GROUP BY tl.id
          ORDER BY tl.sorting;";

          $row = Db::run()->pdoQuery($sql, array($id, $status))->results();

          return ($row) ? $row : 0;

      }

      /**
       * Project::getTaskByPermission()
       *
       * @param integer $id
       * @param bool $status
       * @return
       */
      public function getTaskByPermission($id, $status = 1)
      {

          if (App::Auth()->userlevel == 9) {
              $sql = "SELECT t.*, p.name as pname, p.currency, m.avatar FROM `" . self::tTable . "` AS t
					LEFT JOIN `" . Project::pTable . "` AS p ON t.project_id = p.id
					LEFT JOIN `" . Users::mTable . "` AS m  ON t.assigned_id = m.id
				  WHERE t.id = ?
				  AND t.status = ?
				  LIMIT 1;";

              $row = Db::run()->pdoQuery($sql, array($id, $status))->result();
          } else {
              $sql = "SELECT t.*, p.name as pname, m.avatar
              FROM `" . self::tTable . "` AS t
          LEFT JOIN `" . Project::pTable . "` AS p ON t.project_id = p.id
          LEFT JOIN `" . Users::mTable . "` AS m  ON t.assigned_id = m.id
				  WHERE t.id = ?
				  AND t.assigned_id = ?
				  AND t.status = ?
				  LIMIT 1;";

              $row = Db::run()->pdoQuery($sql, array($id, App::Auth()->uid, $status))->result();
          }

          return ($row) ? $row : 0;
      }

      /**
       * Task::getTaskTimeRecords()
       *
       * @param int $task_id
	   * @param int $status
       * @return
       */
      public function getTaskTimeRecords($task_id, $status = 1)
      {

		  $sql = "SELECT tr.*, DATE(tr.created) as trdate, t.name as taskname, CONCAT(m.fname,' ',m.lname) as uname, m.avatar
			  FROM `" . Project::trTable . "` AS tr
				LEFT JOIN `" . self::tTable . "` AS t ON t.id = tr.task_id
				LEFT JOIN `" . Users::mTable . "` AS m ON m.id = tr.user_id
			  WHERE tr.task_id = ?
			  AND tr.status = ?
			  ORDER BY tr.created DESC;";

          $row = Db::run()->pdoQuery($sql, array($task_id, $status))->results();

          return ($row) ? $row : 0;
      }

      /**
       * Project::getTaskExpenses()
       *
       * @param int $task_id
	   * @param int $status
       * @return
       */
      public function getTaskExpenses($task_id, $status = 1)
      {

		  $sql = "SELECT ex.*, DATE(ex.created) as exdate, t.name as taskname, CONCAT(m.fname,' ',m.lname) as uname, m.avatar
			  FROM `" . Project::exTable . "` AS ex
				LEFT JOIN `" . self::tTable . "` AS t  ON t.id = ex.task_id
				LEFT JOIN `" . Users::mTable . "` AS m ON m.id = ex.user_id
			  WHERE ex.task_id = ?
			  AND ex.status = ?
			  ORDER BY ex.created DESC;";

          $row = Db::run()->pdoQuery($sql, array($task_id, $status))->results();

          return ($row) ? $row : 0;
      }

      /**
       * Task::getTaskById()
       *
       * @param integer $id
       * @param bool $status
       * @return
       */
      public function getTaskById($id, $status = 1)
      {

          $row = Db::run()->first(self::tTable, null, array("id" => $id, "status" => $status));

          return ($row) ? $row : 0;
      }
  }
