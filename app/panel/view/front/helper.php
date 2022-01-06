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
  
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == GET Actions == */
  switch ($gAction) :
	  /* == Get Time Record Weekly == */
	  case "getTimeRecordWeekly":
		  if(!App::Auth()->is_User()) exit;
		  $tpl = App::View(THEMEBASE . '/snippets/'); 
		  $tpl->pheader = Utility::renderTimeRecordHeader(Validator::sanitize($_GET['date'], "date"));  
		  $dates = iterator_to_array($tpl->pheader);
		  $tpl->results = App::Project()->getProjectTimeRecords(Filter::$id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
		  $tpl->template = 'loadTimeWeekly.tpl.php'; 
		  $json['html'] = $tpl->render();
		  print json_encode($json);
	  break;

	  /* == Get Expense Record Weekly == */
	  case "getExpRecordWeekly":
		  if(!App::Auth()->is_User()) exit;
		  $tpl = App::View(THEMEBASE . '/snippets/'); 
		  $tpl->pheader = Utility::renderTimeRecordHeader(Validator::sanitize($_GET['date'], "date"));  
		  $dates = iterator_to_array($tpl->pheader);
		  $tpl->results = App::Project()->getProjectExpenseRecords(Filter::$id, 1, $dates[0]->format('Y-m-d'), $dates[6]->format('Y-m-d'));
		  $tpl->currency = (isset($_GET['currency'])) ? Validator::sanitize($_GET['currency']) : App::Core()->currency;
		  $tpl->template = 'loadExpensesWeekly.tpl.php'; 
		  $json['html'] = $tpl->render();
		  print json_encode($json);
	  break;
		  
	  /* == View Policy == */
	  case "viewPolicy":
		  $tpl = App::View(THEMEBASE . '/snippets/'); 
		  $tpl->row = App::Core()->privacy;
		  $tpl->template = 'viewPolicy.tpl.php'; 
		  echo $tpl->render(); 
	  break;
	  
	  /* == Get Main Activity == */
	  case "getFullActivity":
	      if(!App::Auth()->is_User()) exit;
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
		  $tpl->template = 'loadActivity.tpl.php'; 
		  $tpl->data = $tpl->data = App::Users()->getAllUserActivity(isset($_GET['date']) ? Validator::sanitize($_GET['date'], "date") : '');
		  $json['html'] = $tpl->render();
		  
		  print json_encode($json);
	  break;
	  
	  /* == Load Gateway == */
	  case "gateway":
	      if(!App::Auth()->is_User()) exit;
          if(Filter::$id) :
		      if($gateway = Db::run()->first(Admin::gTable, null, array("id" => Filter::$id, "active" => 1))):
				  $tpl = App::View(BASEPATH . 'gateways/' . $gateway->dir . '/');
				  $tpl->gateway = $gateway;
				  $tpl->core = App::Core();
				  $tpl->row = Db::run()->first(Project::ivTable, null, array("id" => intval($_GET['inv'])));
				  $tpl->template = 'form.tpl.php';
				  $json['message'] = $tpl->render();
		      else:
				  $json['message'] = Message::msgSingleError(Lang::$word->SYSERROR, false);
		      endif;
		  else:
			  $json['message'] = Message::msgSingleError(Lang::$word->SYSERROR, false);
		  endif;
		  print json_encode($json);
	  break;

	  /* == Get Calendar Records == */
	  case "getCalendarRecords":
	      if(!App::Auth()->is_User()) exit;
		  if(empty($_GET['year']) or empty($_GET['month'])):
			  $year = Date::doDate("yyyy", Date::today());
			  $month = Date::doDate("MM", Date::today());
			  $ids = null;
		  else:
			  $year = Validator::sanitize($_GET['year'], "time");
			  $month = Validator::sanitize($_GET['month'], "time"); 
			  $ids = Validator::sanitize($_GET['ids'], "implode");
		  endif;
			  $data = App::Content()->getCalendarEvents($ids);
			  $json['events'] = $data;
		  print json_encode($json); 
	  break;
	  
	  /* == Download Invoice == */
	  case "downloadInvoice":
	      if(!App::Auth()->is_User()) exit;
		  if ($row = Db::run()->first(Project::ivTable, null, array("company_id" => App::Auth()->company, "recurring" => 0, 'id' => Filter::$id))):
			  $title = "invoice-" . Content::invoiceID($row->id, $row->custom_id) . "-from_" . App::Core()->company;
	
			  ob_start();
			  require_once (ADMINBASE . '/snippets/Pdf_Invoice.tpl.php');
			  $pdf_html = ob_get_contents();
			  ob_end_clean();
	
			  require_once (BASEPATH . 'lib/mPdf/vendor/autoload.php');
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => App::Core()->pagesize]);
			  $mpdf->SetTitle($title);
			  $mpdf->WriteHTML($pdf_html);
			  $mpdf->Output($title . ".pdf", "D");
			  exit;
		  else:
			  exit;
		  endif;
	  break;
	  
	  /* == Download Estimate == */
	  case "downloadEstimate":
	      if(!App::Auth()->is_User()) exit;
		  if ($row = Db::run()->first(Content::esTable, null, array("company_id" => App::Auth()->company, "id" => Filter::$id))):
			  $title = "estimate-" . $row->title . "-from_" . App::Core()->company;
	
			  ob_start();
			  require_once (ADMINBASE . '/snippets/Pdf_Estimate.tpl.php');
			  $pdf_html = ob_get_contents();
			  ob_end_clean();
	
			  require_once (BASEPATH . 'lib/mPdf/vendor/autoload.php');
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => App::Core()->pagesize]);
			  $mpdf->SetTitle($title);
			  $mpdf->WriteHTML($pdf_html);
			  $mpdf->Output($title . ".pdf", "D");
			  exit;
		  else:
			  exit;
		  endif;
  endswitch;

  /* == Instant Actions == */
  switch ($iAction) :
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
	  
	  /* == Process Attachments == */
	  case "taskFiles":
	  case "discussionFiles":
	  case "projectFiles":
	  case "noteFiles":
		  if (!empty($_FILES['file']['name'])):
			  $upl = Upload::instance(App::Core()->file_size, App::Core()->file_ext);
			  $upl->process("file", UPLOADS . "/files/", "file_");
			  if (empty(Message::$msgs)):
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
			  else:
				  $json['type'] = "error";
				  $json['message'] = Message::$msgs['name'];
			  endif;
			  print json_encode($json);
		  endif;
	  break;
  endswitch;
  
  /* == Clear Session Temp Queries == */
  if (isset($_GET['ClearSessionQueries'])):
      App::Session()->remove('debug-queries');
	  App::Session()->remove('debug-warnings');
	  App::Session()->remove('debug-errors');
	  print 1;
  endif;