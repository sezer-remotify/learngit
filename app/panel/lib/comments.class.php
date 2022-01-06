<?php
  /**
   * Comments Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: comments.class.php, v1.00 2019-04-20 18:20:24 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Comments
  {

	  const mTable = 'messages';
	  const nTable = 'notifications';


      /**
       * Comments::Project($id)
       *
       * @param int $id
       * @return
       */
	  public function Project($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->MSG_TITLE4;
		  $tpl->core = App::Core();
		  $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_28];

		  if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [comments.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->row = $row;
			  $tpl->data = $this->Discussions($id);
			  $tpl->puserdata = App::Project()->getProjectUsers($id);
			  $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
			  $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
			  $tpl->taskdata = App::Task()->getAllTasks(1, $id);
			  $tpl->template = 'admin/_project_discussions.tpl.php';
          }
	  }

      /**
       * Comments::Save($id)
       *
       * @param int $id
       * @return
       */
	  public function Save($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->MSG_TITLE4;
		  $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_28];

		  if (!$row = App::Project()->getProjectByPermissions(1, $id)) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [comments.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->row = $row;
			  $tpl->puserdata = App::Project()->getProjectUsers($row->id);
			  $tpl->template = 'admin/discussions.tpl.php';
          }
	  }

      /**
       * Comments::Edit($id)
       *
       * @param int $id
       * @return
       */
	  public function Edit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->MSG_TITLE4;
		  $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_28];

		  if (!$row = Db::run()->first(self::mTable, null, array('id' => $id, "status" => 1))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [comments.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->prow = App::Project()->getProjectByPermissions(1, $row->type_id);
			  $tpl->row = $row;
			  $tpl->puserdata = App::Project()->getProjectUsers($row->type_id);
			  $tpl->messageusers = App::Project()->getSubscribedUsers("message_id", $tpl->row->id);
			  $tpl->filedata = App::Project()->getFiles("comment_id", $tpl->row->id);
			  $tpl->template = 'admin/discussions.tpl.php';
          }
	  }

      /**
       * Comments::view($pid, $id)
       *
       * @param int $pid
       * @param int $id
       * @return
       */
	  public function View($pid, $id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->MSG_TITLE4;
		  $tpl->crumbs = ['admin', Lang::$word->NAV_25, Lang::$word->NAV_28];

		  if (!$row = Db::run()->first(self::mTable, null, array('id' => $id, 'type_id' => $pid))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [comments.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->prow = App::Project()->getProjectByPermissions(1, $pid);
			  $tpl->row = $row;
			  $tpl->data = $this->Messages($tpl->row->id);
			  $tpl->puserdata = App::Project()->getProjectUsers($pid);
			  $tpl->messageusers = App::Project()->getSubscribedUsers("message_id", $tpl->row->id);
			  $tpl->filedata = App::Project()->getFiles("comment_id", $tpl->row->id);
			  $tpl->template = 'admin/discussions.tpl.php';
          }
	  }

      /**
       * Comments::Messages()
       *
       * @param mixed $id
       * @param integer $status
	   * @param bool $hidden
       * @return
       */
      public function Messages($id, $status = 1, $hidden = false)
      {
		  $is_hidden = ($hidden == true) ? 'AND is_hidden = 0' : null;

          $sql = "SELECT c.*, m.avatarFROM`" . self::mTable . "` AS c
			LEFT JOIN `" . Users::mTable . "` AS m ON m.id = c.created_by_id
		  WHERE c.type = ? AND c.parent_id = ? AND c.status = ?
		  $is_hidden
		  ORDER BY c.created DESC;";

          $row = Db::run()->pdoQuery($sql, array("message", $id, $status))->results();

          return ($row) ? $row : 0;

      }

      /**
       * Comments::TaskMessages()
       *
       * @param mixed $type
       * @param mixed $id
       * @param integer $status
       * @return
       */
      public function TaskMessages($type, $id, $status = 1)
      {

          $sql = "SELECT c.*, m.avatarFROM`" . self::mTable . "` AS c
			LEFT JOIN `" . Users::mTable . "` AS m ON m.id = c.created_by_id
		  WHERE c.type = ? AND c.type_id = ? AND c.status = ?
		  ORDER BY c.created DESC;";

          $row = Db::run()->pdoQuery($sql, array($type, $id, $status))->results();

          return ($row) ? $row : 0;

      }

      /**
       * Comments::Discussions()
       *
       * @param integer $id
       * @param integer $status
	   * @param integer $hidden
       * @return
       */
      public function Discussions($id, $status = 1, $hidden = false)
      {
		  $is_hidden = ($hidden) ? 'AND is_hidden = 0' : null;

          $sql = "SELECT c.* FROM `" . self::mTable . "` AS c
			WHERE c.type = ?
			  AND c.type_id = ?
			  AND c.status = ?
			  $is_hidden
			ORDER BY parent_id, c.created DESC;";

          $data = Db::run()->pdoQuery($sql, array("message", $id, $status))->results();

          $result = array();
          if($data) {
			  foreach ($data as $i => $row) {
				  if ($row->parent_id == 0) {
					  $result[$row->id]['id'] = $row->id;
					  $result[$row->id]['name'] = $row->name;
					  $result[$row->id]['is_hidden'] = $row->is_hidden;
				  }	else {
					  $result[$row->parent_id]['message'][$i]['body'] = $row->body;
					  $result[$row->parent_id]['message'][$i]['parent_id'] = $row->parent_id;
					  $result[$row->parent_id]['message'][$i]['created'] = $row->created;
					  $result[$row->parent_id]['message'][$i]['user_id'] = $row->created_by_id;
					  $result[$row->parent_id]['message'][$i]['user'] = $row->created_by_name;
				  }
			  }
		  }
          return ($result) ? $result : 0;
      }

      /**
       * Comments::getDiscussions()
       *
       * @param integer $id
       * @param integer $status
	   * @param integer $hidden
       * @return
       */
      public function getDiscussions($id)
      {

		   $sql = "SELECT p.id, p.name, p.body, p.created, p.created_by_name, p.created_by_id, p.is_hidden, COUNT(c.id) AS total FROM `" . self::mTable . "` AS p
				LEFT JOIN `" . self::mTable . "` AS c ON c.parent_id = p.id
			  WHERE p.type_id = ?
				AND p.parent_id = ?
				AND p.type = ?
			  GROUP BY c.parent_id;";


		  $row = Db::run()->pdoQuery($sql,array($id, 0, "message"))->results();

          return ($row) ? $row : 0;
      }

      /**
       * Comments::processMessage()
       *
       * @return
       */
	  public function processMessage()
	  {


          $rules = array(
              'type_id' => array('required|numeric', "Invalid ID detected"),
              );

		  $filters = array(
			  'type' => 'string',
			  'taskname' => 'string',
			  'discname' => 'string',
			  'pid' => 'numbers',
			  'parent_id' => 'numbers',
			  'body' => 'basic_tags',
			  );

          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if (empty(Message::$msgs)) {
			  $data = array(
				  'type' => $safe->type,
				  'type_id' => $safe->type_id,
				  'parent_id' => $safe->parent_id,
				  'body' => $safe->body,
				  'created_by_id' => App::Auth()->uid,
				  'created_by_name' => App::Auth()->name,
				  'created_by_email' => App::Auth()->email,
				  'ip' => Url::getIP(),
				  'status' => 1,
				  );

			  if (Filter::$id) {
				  $data['updated'] = Db::toDate();
				  $data['updated_by_id'] = App::Auth()->uid;
				  $data['updated_by_name'] = App::Auth()->name;
				  $data['updated_by_email'] = App::Auth()->email;
			  }
			  (Filter::$id) ? Db::run()->update(self::mTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();

			  if (Db::run()->affected()) {
				  $view = (isset($_POST['is_front'])) ? THEMEBASE :  ADMINBASE;
				  $json['type'] = "success";
				  if (Filter::$id) {
					  $row = Db::run()->first(self::mTable, null, array("id" => Filter::$id));
					  if ($safe->type == "message") {
						  $json['html'] = Utility::getSnippets($view . '/snippets/loadDiscComment.tpl.php',
						  $data = array(
							'row' => $row,
							'items' =>array(
								'pid' => $safe->pid,
								'discname' => $safe->discname,
								'avatar' => App::Auth()->avatar,
								'id' => Filter::$id,
								)
							));
					  } else {
						  $json['html'] = Utility::getSnippets($view . '/snippets/loadTaskComment.tpl.php',
						  $data = array(
							'row' => $row,
							'items' =>array(
								'pid' => $safe->pid,
								'taskname' => $safe->taskname,
								'avatar' => App::Auth()->avatar,
								'id' => Filter::$id,
								)
							));
					  }
				  } else {
					  $row = Db::run()->first(self::mTable, null, array("id" => $last_id));
					  if ($safe->type == "message") {
						  $json['html'] = Utility::getSnippets($view . '/snippets/loadDiscComment.tpl.php',
						  $data = array(
							'row' => $row,
							'items' =>array(
								'pid' => $safe->pid,
								'discname' => $safe->discname,
								'avatar' => App::Auth()->avatar,
								'id' => $last_id,
								)
							));
						  self::doNotification(array("type" => "discussion", "parent_id" => $safe->parent_id, "type_id" => $safe->pid));
					  } else {
						  $json['html'] = Utility::getSnippets($view . '/snippets/loadTaskComment.tpl.php',
						  $data = array(
							'row' => $row,
							'items' =>array(
								'pid' => $safe->pid,
								'taskname' => $safe->taskname,
								'avatar' => App::Auth()->avatar,
								'id' => $last_id,
								)
							));
						  self::doNotification(array("type" => "task", "parent_id" => 0, "type_id" => $safe->type_id));
					  }
				  }
				  $json['type'] = "success";
			  } else {
				  $json['type'] = "error";
			  }

			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Comments::processDiscussion()
       *
       * @return
       */
      public function processDiscussion($front = false)
      {


          $rules = array(
              'pid' => array('required|numeric', Lang::$word->PRJ_INVALID_ID),
			  'name' => array('required|string', Lang::$word->MSG_INFO),
              );

		  $filters = array(
			  'body' => 'basic_tags',
			  );

          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);


          if (empty(Message::$msgs)) {
              $data = array(
			      'name' => $safe->name,
                  'type_id' => $safe->pid,
                  'type' => "message",
                  'body' => $safe->body,
                  'created_by_id' => App::Auth()->uid,
                  'created_by_name' => App::Auth()->name,
				  'created_by_email' => App::Auth()->email,
				  'is_hidden' => isset($_POST['is_hidden']) ? 1 : 0,
                  'status' => 1,
                  );

               if(Filter::$id) {
				   $data['updated'] = Db::toDate();
				   $data['updated_by_id'] = App::Auth()->uid;
				   $data['updated_by_name'] = App::Auth()->name;
				   $data['updated_by_email'] = App::Auth()->email;
			   }

              (Filter::$id) ? Db::run()->update(self::mTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();
			  $id = Filter::$id ? Filter::$id : $last_id;

              if (isset($_POST['subscribers'])) {
                  Db::run()->delete(Project::sbTable, array('message_id' => $id));
                  foreach ($_POST['subscribers'] as $sid) {
                      $sdataArray[] = array('message_id' => $id, 'user_id' => $sid);
                  }
                  Db::run()->insertBatch(Project::sbTable, $sdataArray);
              }

              if (isset($_POST['attachment'])) {
				  $files = Db::run()->pdoQuery("SELECT * FROM `" . Project::ftTable. "` WHERE caption IN(" . Utility::implodeFields($_POST['attachment'], ",", true) . ")")->results();
				  if($files) {
					  foreach ($files as $file) {
						  $fdataArray[] = array(
							  'caption' => $file->caption,
							  'parent' => $file->parent,
							  'project_id' => $file->project_id,
							  'comment_id' => $id,
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
					  Db::run()->pdoQuery("DELETE FROM `" . Project::ftTable. "` WHERE caption IN(" . Utility::implodeFields($_POST['attachment'], ",", true) . ")");
				  }
              }
			  self::doNotification(array("type" => "discussion", "parent_id" => 0, "type_id" => $safe->pid));

			  if(!Filter::$id) {
				  $adata = array(
					  'project_id' => $safe->pid,
					  'message_id' => $last_id,
					  'uid' => App::Auth()->uid,
					  'type' => "Messages",
					  'title' => $safe->name,
					  'username' => App::Auth()->username,
					  'fullname' => App::Auth()->name,
					  'groups' => "message",
					  'is_activity' => 1
					  );

				  Db::run()->insert(Users::aTable, $adata);
			  }

              $message = Filter::$id ? Lang::$word->MSG_UPDATE_OK : Lang::$word->MSG_ADDED_OK;
			  $is_front = ($front == true) ? "dashboard" : "admin";

              if (Db::run()->affected()) {
                  $json['type'] = 'success';
                  $json['title'] = Lang::$word->SUCCESS;
                  $json['message'] = $message;
				  $json['redirect'] = Url::url("/$is_front/discussions/view/" . $data['type_id'], $id);
              } else {
                  $json['type'] = 'alert';
                  $json['title'] = Lang::$word->ALERT;
                  $json['message'] = Lang::$word->NOPROCCESS;
              }

              print json_encode($json);
          } else {
              Message::msgSingleStatus();
          }
      }

      /**
       * Comments::convertDiscussionToTask()
       *
       * @return
       */
      public function convertDiscussionToTask()
      {

          $rules = array(
              'id' => array('required|numeric', "ID"),
			  'pid' => array('required|numeric', "Project ID"),
              );


          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);

          if (empty(Message::$msgs)) {
			  $row = Db::run()->first(Comments::mTable, null, array('id' => Filter::$id));
			  $data = array(
				  'project_id' => $safe->pid,
				  'name' => $row->name,
				  'body' => $row->body,
				  'assigned_id' => App::Auth()->uid,
				  'created_by_id' => App::Auth()->uid,
				  'created_by_name' => App::Auth()->name,
				  'status' => 1,
				  'is_hidden' => $row->is_hidden
				  );
			  $last_id = Db::run()->insert(Task::tTable, $data)->getLastInsertId();

			  $sql = "UPDATE `" . Project::sbTable . "` SET task_id = ?, message_id = ? WHERE message_id = ?;";
			  Db::run()->pdoQuery($sql, array($last_id, 0, $row->id));

			  $sql = "UPDATE `" . self::mTable . "` SET type = 'task', type_id = ?, parent_id = ? WHERE parent_id = ?;";
			  Db::run()->pdoQuery($sql, array($last_id, 0, $row->id));

			  $sql = "UPDATE `" . Project::fTable . "` SET parent = 'task', task_id = ?, comment_id = ? WHERE comment_id = ?;";
			  Db::run()->pdoQuery($sql, array($last_id, 0, $row->id));

			  Db::run()->delete(self::mTable, array("id" => $row->id));

			  $json['type'] = "success";
			  $json['title'] = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("[NAME]", $row->name, Lang::$word->MSG_INFO4);
			  $json['redirect'] = Url::url("/admin/tasks", $last_id);

              print json_encode($json);

          } else {
              Message::msgSingleStatus();
          }
      }

      /**
       * Comments::copyDiscussionToProject()
       *
       * @return
       */
      public function copyDiscussionToProject()
      {

          $rules = array(
              'id' => array('required|numeric', "Invalid ID"),
			  'pid' => array('required|numeric', "Project ID"),
			  'cpid' => array('required|numeric', "Copy Project ID"),
              );


          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);

          if (empty(Message::$msgs)) {
			  $row = Db::run()->first(Comments::mTable, null, array('id' => Filter::$id));
			  $data = array(
				  'name' => $row->name,
				  'body' => $row->body,
				  'type' => $row->type,
				  'type_id' => $row->type_id,
				  'parent_id' => $row->parent_id,
				  'created_by_id' => $row->created_by_id,
				  'created_by_name' => $row->created_by_name,
				  'created_by_email' => $row->created_by_email,
				  'status' => 1,
				  'is_hidden' => $row->is_hidden
				  );
			  $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();
			  Db::run()->update(self::mTable, array("type_id" => $safe->cpid), array("id" => $last_id));

			  if($messages = Db::run()->select(self::mTable, null, array("parent_id" => $row->id))->results()) {
				  foreach ($messages as $msg) {
					  $mdataArray[] = array(
						  'type' => "message",
						  'type_id' => $safe->cpid,
						  'parent_id' => $last_id,
						  'body' => $msg->body,
						  'created_by_id' => $msg->created_by_id,
						  'created_by_name' => $msg->created_by_name,
						  'created_by_email' => $msg->created_by_email,
						  );
				  }
				  Db::run()->insertBatch(self::mTable, $mdataArray);
			  }

			  if($subscribers = Db::run()->select(Project::sbTable, null, array("message_id" => $row->id))->results()) {
				  foreach ($subscribers as $sbc) {
					  $sdataArray[] = array(
						  'message_id' => $last_id,
						  'user_id' => $sbc->uid,
						  );
				  }
				  Db::run()->insertBatch(Project::sbTable, $sdataArray);
			  }

			  if($files = Db::run()->select(Project::fTable, null, array("comment_id" => $row->id))->results()) {
				  foreach ($files as $flr) {
					  $fdataArray[] = array(
						  'caption' => $flr->caption,
						  'parent' => "discussion",
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
				  Db::run()->delete(self::mTable, array("id" => $row->id));
				  Db::run()->delete(self::mTable, array("parent_id" => $row->id));

				  Db::run()->delete(Project::sbTable, array("message_id" => $row->id));
				  Db::run()->delete(Project::fTable, array("comment_id" => $row->id));
			  }

			  $json['type'] = "success";
			  $json['title'] = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("[NAME]", $row->name, Lang::$word->MSG_INFO5);
			  $json['redirect'] = Url::url("/admin/discussions/view/" . $safe->cpid, $last_id);

              print json_encode($json);

          } else {
              Message::msgSingleStatus();
          }
      }

      /**
       * Comments::getMessageHistory()
       *
	   * @param string $type
	   * @param int $id
       * @return
       */
      public function getMessageHistory($type, $id)
      {

          $row = Db::run()->select(Users::aTable, "*", array($type => $id, "groups" => "history"), "ORDER BY created DESC")->results();

          return ($row) ? $row : 0;

      }

      /**
       * Comments::doNotification()
       *
       * @param array $array
       * @return
       */
      public static function doNotification($array)
      {

		  $data = array(
			  'type' => $array['type'],
			  'type_id' => $array['type_id'],
			  'parent_id' => $array['parent_id'],
			  'user_id' => App::Auth()->uid
			  );

          $row = Db::run()->insert(self::nTable, $data);

      }

      /**
       * Comments::renderNotification()
       *
       * @return
       */
      public static function renderNotification()
      {

		  $sql = "SELECT n.name AS note, n.project_id AS npid, m.name AS message, m.type_id AS mpid, t.name AS task, t.project_id AS tpid, s.note_id, s.task_id, s.message_id FROM `" . Project::sbTable . "` AS s
			LEFT JOIN `" . Users::mTable . "` AS u ON u.id = s.user_id
			LEFT JOIN `" . Project::nTable . "` AS n ON n.id = s.note_id
			LEFT JOIN `" . self::mTable . "` AS m ON m.id = s.message_id
			LEFT JOIN `" . Task::tTable . "` AS t ON t.id = s.task_id
		  WHERE u.id = ?
		  AND s.status = ?;";

          $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, 0))->results();

          return ($row) ? $row : 0;

      }
  }
