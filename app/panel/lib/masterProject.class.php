<?php

/**
 * Project App
 *
 * @package Wojo Framework
 * @author https://ilyaskohistani.github.io/
 * @copyright 2021
 * @version $Id: masterProject.class.php, v1.00 2021-05-20 18:20:24 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

class masterProject
{


  /**
   * masterProject::__construct()
   * 
   * @return
   */
  public function __construct()
  {
  }


  /**
   * masterProject::Notes()
   * 
   * @param int $id
   * @return
   */
  public function Notes($id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->PRJ_TITLE2;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_39];
    $tpl->core = App::Core();

    if (!$row = App::Project()->getProjectWithBidBudget(1, $id)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } else {
      $tpl->row = $row;
      $tpl->puserdata = App::Project()->getProjectUsers($id);
      $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
      $tpl->data = Db::run()->select(Project::nTable, null, array("project_id" => $id))->results();
      $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
      $tpl->template = 'master/notes.tpl.php';
    }
  }


  /**
   * Project::NoteView()
   * 
   * @param int $pid
   * @param int $id
   * @return
   */
  public function NoteView($pid, $id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->PRJ_TITLE2;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_39];
    $tpl->core = App::Core();

    if (!$prow = App::Project()->getProjectWithBidBudget(1, $pid)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($pid) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } elseif (!$row = Db::run()->first(Project::nTable, null, array('id' => $id, 'project_id' => $pid))) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($pid) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } else {
      $tpl->crumbs = ['master', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $pid), Lang::$word->NAV_19];
      $tpl->row = $row;
      $tpl->prow = $prow;
      $tpl->puserdata = App::Project()->getProjectUsers($pid);
      $tpl->noteusers = App::Project()->getSubscribedUsers("note_id", $id);
      $tpl->filedata = App::Project()->getFiles("note_id", $id);
      $tpl->template = 'master/notes.tpl.php';
    }
  }

  /**
   * Project::NoteEdit()
   * 
   * @param int $id
   * @return
   */
  public function NoteEdit($id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->PRJ_TITLE2;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_39];
    $tpl->core = App::Core();

    if (!$row = Db::run()->first(Project::nTable, null, array('id' => $id, 'created_by_id' => App::auth()->uid))) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } elseif (!$prow = App::Project()->getProjectWithBidBudget(1, $row->project_id)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($row->project_id) detected [Project.class.php, ln.:" . __line__ . "]" : Message::msgError(Lang::$word->NOACCESS);
    } else {
      $tpl->crumbs = ['master', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $row->project_id), Lang::$word->NAV_11];
      $tpl->row = $row;
      $tpl->prow = $prow;
      $tpl->filedata = App::Project()->getFiles("note_id", $id);
      $tpl->template = 'master/notes.tpl.php';
    }
  }

  /**
   * Project::NoteNew()
   * 
   * @param int $id
   * @return
   */
  public function NoteNew($id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->PRJ_TITLE2;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_39];
    $tpl->core = App::Core();

    if (!$row = App::Project()->getProjectWithBidBudget(1, $id)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Message::msgError(Lang::$word->NOACCESS);
    } else {
      $tpl->crumbs = ['master', Lang::$word->NAV_25, array(0 => Lang::$word->NAV_39, 1 => "notes/" . $id), Lang::$word->NAV_18];
      $tpl->row = $row;
      $tpl->puserdata = App::Project()->getProjectUsers($id);
      $tpl->template = 'master/notes.tpl.php';
    }
  }


  /**
   * masterProject::Activity()
   * 
   * @param int $id
   * @return
   */
  public function Activity($id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->PRJ_TITLE3;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_41];
    $tpl->core = App::Core();

    if (!$row = App::Project()->getProjectWithBidBudget(1, $id)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } else {
      $tpl->row = $row;
      $tpl->puserdata = App::Project()->getProjectUsers($id);
      $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
      $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
      $tpl->data = Utility::groupToLoop(App::Project()->getProjectActivity($id), "cdate");
      $tpl->template = 'master/projects.tpl.php';
    }
  }


  /**
   * masterProject::Files()
   * 
   * @param int $id
   * @return
   */
  public function Files($id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->FMG_TITLE;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_38];
    $tpl->core = App::Core();

    if (!$row = App::Project()->getProjectWithBidBudget(1, $id)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } else {
      $tpl->row = $row;
      $tpl->puserdata = App::Project()->getProjectUsers($id);
      $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
      $tpl->result = App::Project()->getFilesByProject($row->id);
      $tpl->data = Utility::groupToLoop($tpl->result, "fdate");
      $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
      $tpl->template = 'master/files.tpl.php';
    }
  }

  /**
   * masterProject::TimeRecords()
   * 
   * @param int $id
   * @return
   */
  public function TimeRecords($id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->INV_SUB5_1;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_40];
    $tpl->core = App::Core();

    if (!$row = App::Project()->getProjectWithBidBudget(1, $id)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } else {
      $row->budget = $row->bid_amount;
      $tpl->row = $row;
      $tpl->puserdata = App::Project()->getProjectUsers($id);
      $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
      $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
      $tpl->stats = Stats::getProjectTimeRecords($row->id, 1, false);
      $tpl->total_hours = Utility::decimalToHour(Stats::doArraySum($tpl->stats, "total_hours"));
      $tpl->total_amount = Stats::doArraySum($tpl->stats, "total_amount", false);
      $tpl->sub_total = Stats::doArraySum($tpl->stats, "sub_amount", false);
      $tpl->grand_total = ($row->expenses + $tpl->sub_total);
      $tpl->data = Utility::groupToLoop(App::Project()->getProjectTimeRecords($row->id), "trdate");
      $tpl->pheader = Utility::renderTimeRecordHeader();
      $dates = iterator_to_array($tpl->pheader);
      $tpl->results = App::Project()->getProjectTimeRecords($id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
      $tpl->template = 'master/times.tpl.php';
    }
  }

  /**
   * MasterProject::ExpenseRecords()
   * 
   * @param int $id
   * @return
   */
  public function ExpenseRecords($id)
  {

    $tpl = App::View(BASEPATH . 'view/');
    $tpl->dir = "master/";
    $tpl->title = Lang::$word->EXP_TITLE;
    $tpl->crumbs = ['master', Lang::$word->NAV_25, Lang::$word->NAV_36];
    $tpl->core = App::Core();

    if (!$row = App::Project()->getProjectWithBidBudget(1, $id)) {
      $tpl->template = 'master/404.tpl.php';
      $tpl->error = DEBUG ? "Invalid ID ($id) detected [Project.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
    } else {
      $row->budget = $row->bid_amount;
      $tpl->row = $row;
      $tpl->puserdata = App::Project()->getProjectUsers($id);
      $tpl->labels = Utility::jSonToArray($tpl->core->prjlabels);
      $tpl->cats = Utility::jSonToArray($tpl->core->prjcats);
      $tpl->stats = Stats::getProjectTimeRecords($row->id, 1, false);

      $tpl->total_hours = Utility::decimalToHour(Stats::doArraySum($tpl->stats, "total_hours"));
      $tpl->total_amount = Stats::doArraySum($tpl->stats, "total_amount");
      $tpl->sub_total = Stats::doArraySum($tpl->stats, "sub_amount");
      $tpl->grand_total = ($row->expenses + $tpl->sub_total);

      $tpl->data = Utility::groupToLoop(App::Project()->getProjectExpenseRecords($row->id), "trdate");
      $tpl->pheader = Utility::renderTimeRecordHeader();
      $dates = iterator_to_array($tpl->pheader);
      $tpl->results = App::Project()->getProjectExpenseRecords($id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
      $tpl->currency = ($tpl->row->currency) ? $tpl->row->currency  : $tpl->core->currency;

      $tpl->template = 'master/expenses.tpl.php';
    }
  }


  /**
   * MasterProject::processTimeRecord()
   * 
   * @return
   */
  public function processTimeRecord()
  {

    $rules = array(
      'title' => array('required|string|min_len,3|max_len,100', Lang::$word->TITLE),
      'hours' => array('required|float', Lang::$word->_HOURS),
      'amount' => array('required|float', Lang::$word->INV_AMOUNT),
      'task_id' => array('required|numeric', "Invalid Task ID"),
      'project_id' => array('required|numeric', Lang::$word->PRJ_INVALID_ID),
    );

    $filters = array(
      'description' => 'string',
      'taskname' => 'string',
    );

    if (isset($_POST['is_billable']) and empty($_POST['amount'])) {
      Message::$msgs['is_billable'] = Lang::$word->TSK_BILL_ERR;
    }

    $validate = Validator::instance();
    $safe = $validate->doValidate($_POST, $rules);
    $safe = $validate->doFilter($_POST, $filters);


    if (empty(Message::$msgs)) {
      $amount = isset($_POST['is_billable']) ? $safe->amount : 0;
      $data = array(
        'title' => $safe->title,
        'description' => $safe->description,
        'project_id' => $safe->project_id,
        'user_id' => empty($_POST['user_id']) ? App::Auth()->uid : intval($_POST['user_id']),
        'task_id' => $safe->task_id,
        'job_id' => 0,
        'hours' => $safe->hours,
        'created' => isset($_POST['created']) ? Db::toDate($_POST['created']) : Db::toDate(),
        'amount' => number_format($amount, 2),
        'is_billable' => isset($_POST['is_billable']) ? 1 : 0
      );

      if (Filter::$id) {
        $data['updated'] = Db::toDate();
      }
      (Filter::$id) ? Db::run()->update(Project::trTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(Project::trTable, $data)->getLastInsertId();
      $message = Filter::$id ? Lang::$word->TMR_UPDATE_OK : Lang::$word->TMR_ADDED_OK;

      if (isset($_POST['is_modal'])) {
        $timerecords = Utility::groupToLoop(App::Task()->getTaskTimeRecords($safe->task_id), "trdate");
        $html = Utility::getSnippets(
          ADMINBASE . '/snippets/' . $_POST['tpl'] . '.tpl.php',
          $data = array('data' => $timerecords, 'row' => array('task_id' => $safe->task_id, 'taskname' => $safe->taskname))
        );
      }

      if (Db::run()->affected()) {
        $json['type'] = "success";
        $json['title'] = Lang::$word->SUCCESS;

        if (isset($_POST['is_modal'])) {
          $h = Db::run()->first(Project::trTable, array("COALESCE(SUM(hours), 0) as hours"), array("task_id" => $safe->task_id));
          $json['html'] = $html;
          $json['hours'] = Utility::decimalToHour($h->hours);
        }

        $json['message'] = $message;
        if (isset($_POST['not_modal'])) {
          $json['redirect'] = $_POST['return'];
        }
      } else {
        $json['type'] = 'alert';
        $json['title'] = Lang::$word->ALERT;
        if (isset($_POST['is_modal'])) {
          $json['html'] = $html;
        }
        $json['message'] = Lang::$word->NOPROCCESS;
      }

      print json_encode($json);

      //Update Expense field
      Stats::setExpenseField($safe->project_id);

      //Add Acctivity
      if (!Filter::$id) {
        $time = Utility::decimalToReadableHour($safe->hours);
        $adata = array(
          'company_id' => 0,
          'project_id' => $safe->project_id,
          'invoice_id' => 0,
          'note_id' => 0,
          'task_id' => $safe->task_id,
          'uid' => App::Auth()->uid,
          'type' => "Times",
          'title' => $safe->title,
          'comment' => $last_id,
          'groups' => "time",
          'ip' => Url::getIP(),
          'is_activity' => 1,
        );
        Users::addSmallActivity($adata);
      }
    } else {
      Message::msgSingleStatus();
    }
  }
}
