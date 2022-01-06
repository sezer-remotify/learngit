<?php
  /**
   * Core Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: core.class.php, v1.00 2019-06-05 10:12:05 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Core
  {

      const sTable = "settings";
	  const txTable = "trash";
      public static $language;

      public $_url;
      public $_urlParts;

      /**
       * Core::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          $this->getSettings();
          ($this->dtz) ? ini_set('date.timezone', $this->dtz) : date_default_timezone_set('UTC');
		  Locale::setDefault($this->locale);
      }

      /**
       * Core::Index()
       * 
       * @return
       */
      public function Index()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->NAV_30];
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->CFG_TITLE;
		  $tpl->tasklabels = Utility::jSonToArray($this->tasklabels);
		  $tpl->prjlabels = Utility::jSonToArray($this->prjlabels);
		  $tpl->prjcats = Utility::jSonToArray($this->prjcats);
		  $tpl->job_types = Utility::jSonToArray($this->job_types);
		  $tpl->expcats = Utility::jSonToArray($this->expcats);
		  $tpl->taxes = App::Content()->getTaxes();
      }

      /**
       * Core::Technical()
       * 
       * @return
       */
      public function Technical()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->NAV_30, Lang::$word->CFG_SUB1];
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->CFG_TITLE;
      }

      /**
       * Core::General()
       * 
       * @return
       */
      public function General()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->NAV_30, Lang::$word->CFG_SUB3];
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->CFG_TITLE;
		  $tpl->countries = App::Content()->getCountryList();
      }
	  
      /**
       * Core::Wide()
       * 
       * @return
       */
      public function Wide()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->NAV_30, Lang::$word->CFG_SUB2];
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->CFG_TITLE;
      }

      /**
       * Core::Project()
       * 
       * @return
       */
      public function Project()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->NAV_30, Lang::$word->CFG_SUB4];
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->CFG_TITLE;
		  $tpl->tasklabels = Db::run()->select(Task::tlbTable)->results();
		  $tpl->projectlabels = Db::run()->select(Project::plTable)->results();
		  $tpl->projectcats = Db::run()->select(Project::pcTable)->results();
      }

      /**
       * Core::Time()
       * 
       * @return
       */
      public function Time()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->NAV_30, Lang::$word->CFG_SUB5];
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->CFG_TITLE;
		  $tpl->jobs = Db::run()->select(Project::jtTable)->results();
		  $tpl->excats = Db::run()->select(Project::excTable)->results();
      }

      /**
       * Core::Invoicing()
       * 
       * @return
       */
      public function Invoicing()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->NAV_30, Lang::$word->CFG_SUB6];
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->CFG_TITLE;
		  $tpl->taxes = App::Content()->getTaxes(false);
		  $tpl->overdue = Utility::loopOptionsSimpleAlt(Date::overdueArray(), $this->overdue);
      }
	  
      /**
       * Core::getSettings()
       * 
       * @return
       */
      private function getSettings()
      {
          $row = Db::run()->select(self::sTable, null, array('id' => 1))->result();

          $this->company = $row->company;
          $this->site_dir = $row->site_dir;
          $this->site_email = $row->site_email;
          $this->logo = $row->logo;
          $this->short_date = $row->short_date;
          $this->long_date = $row->long_date;
          $this->time_format = $row->time_format;
          $this->dtz = $row->dtz;
          $this->locale = $row->locale;
          $this->lang = $row->lang;
          $this->weekstart = $row->weekstart;
          $this->theme = $row->theme;
          $this->perpage = $row->perpage;
          $this->invoice_number = $row->invoice_number;
          $this->invoice_info = $row->invoice_info;
          $this->invoice_view = $row->invoice_view;
          $this->project_view = $row->project_view;
          $this->pagesize = $row->pagesize;
          $this->overdue = $row->overdue;
		  
          $this->offline = $row->offline;
          $this->offline_msg = $row->offline_msg;
          $this->offline_d = $row->offline_d;
          $this->offline_t = $row->offline_t;
          $this->eucookie = $row->eucookie;
          $this->sbackup = $row->sbackup;

          $this->currency = $row->currency;
          $this->job_types = $row->job_types;
		  
          $this->prjlabels = $row->prjlabels;
          $this->prjcats = $row->prjcats;
          $this->tasklabels = $row->tasklabels;
          $this->expcats = $row->expcats;
          $this->file_ext = $row->file_ext;
          $this->file_size = $row->file_size;
		  $this->mapapi = $row->mapapi;
		  $this->privacy = $row->privacy;

          $this->mailer = $row->mailer;
          $this->smtp_host = $row->smtp_host;
          $this->smtp_user = $row->smtp_user;
          $this->smtp_pass = $row->smtp_pass;
          $this->smtp_port = $row->smtp_port;
          $this->sendmail = $row->sendmail;
          $this->is_ssl = $row->is_ssl;
		  
		  $this->social = json_decode($row->social_media);

          $this->wojov = $row->wojov;
          $this->wojon = $row->wojon;

      }

      /**
       * Core::processConfig()
       * 
       * @return
       */
      public function processConfig()
      {

          switch ($_POST['page']) {
              case "tech":
				  $rules = array(
					  'file_size' => array('required|numeric', Lang::$word->CFG_FILES),
					  'file_ext' => array('required|string', Lang::$word->CFG_FILEE),
					  'site_dir' => array('required|string', Lang::$word->CFG_LONGDATE),
					  'mailer' => array('required|string', Lang::$word->CFG_MAILER),
					  'theme' => array('required|string', Lang::$word->CFG_THEME),
					  );
					  
				  $filters = array(
					  'site_dir' => 'string',
					  'is_ssl' => 'numbers',
					  );

                  switch ($_POST['mailer']) {
                      case "SMTP":
						  $rules = array(
							  'smtp_host' => array('required|string', Lang::$word->CFG_SMTP_HOST),
							  'smtp_user' => array('required|string', Lang::$word->CFG_SMTP_USER),
							  'smtp_pass' => array('required|string', Lang::$word->CFG_SMTP_USER),
							  'smtp_port' => array('required|numeric', Lang::$word->CFG_SMTP_PORT),
							  );
                          break;

                      case "SMAIL":
						  $rules = array(
							  'sendmail' => array('required|string', Lang::$word->CFG_SMAILPATH),
							  );
                          break;
                  }
                  break;

              case "global":
				  $rules = array(
					  'company' => array('required|string', Lang::$word->CFG_COMPANY),
					  'site_email' => array('required|email', Lang::$word->EMAIL),
					  'locale' => array('required|string', Lang::$word->CFG_LOCALES),
					  );
					  
				  $filters = array(
					  'dtz' => 'string',
					  'short_date' => 'string',
					  'long_date' => 'string',
					  'time_format' => 'string',
					  'weekstart' => 'numbers',
					  'privacy' => 'basic_tags',
					  );
                  break;

              case "general":
				  $rules = array(
					  'currency' => array('required|string', Lang::$word->CFG_CURRENCY),
					  'lang' => array('required|string', Lang::$word->CFG_LANG),
					  'perpage' => array('required|numeric', Lang::$word->CFG_PERPAGE),
					  );
					  
				  $filters = array(
					  'eucookie' => 'numbers',
					  'twitter' => 'string',
					  'facebook' => 'string',
					  );
                  break;

              case "project":
				  $rules = array(
					  'project_view' => array('required|numeric', Lang::$word->CFG_PRJVIEW),
					  );
				  $filters = array(
					  'project_view' => 'numbers',
					  );
                  break;

              case "invoicing":
				  $rules = array(
					  'invoice_view' => array('required|numeric', Lang::$word->CFG_INVIEW),
					  );
					  
				  $filters = array(
					  'overdue' => 'string',
					  'invoice_number' => 'string',
					  'pagesize' => 'string',
					  'invoice_info' => 'string',
					  );
                  break;
				  
              case "time":
				  $rules = array(
					  'page' => array('required|string', "Invalid Page"),
					  );
				  $filters = array(
					  'page' => 'string',
					  );
                  break;
          }
		
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if (!empty($_FILES['logo']['name']) and empty(Message::$msgs)) {
			  $upl = Upload::instance(3145728, "png,jpg,svg");
			  $upl->process("logo", UPLOADS . "/", false, "logo", false);
		  }

		  if (!empty($_FILES['logoi']['name']) and empty(Message::$msgs)) {
			  $upl = Upload::instance(3145728, "png,jpg");
			  $upl->process("logoi", UPLOADS . "/", false, "print_logo", false);
		  }
		  
		  if (empty(Message::$msgs)) {
              switch ($_POST['page']) {
                  case "tech":
                      $data = array(
                          'site_dir' => $safe->site_dir,
                          'theme' => $safe->theme,
                          'mailer' => $safe->mailer,
                          'is_ssl' => $safe->is_ssl
						  );
                      switch ($_POST['mailer']) {
                          case "SMTP":
                              $data['smtp_host'] = $safe->smtp_host;
                              $data['smtp_user'] = $safe->smtp_user;
                              $data['smtp_pass'] = $safe->smtp_pass;
                              $data['smtp_port'] = $safe->smtp_port;
                              break;
                          case "SMAIL":
                              $data['sendmail'] = $safe->sendmail;
                              break;

                      }
                      break;

                  case "global":
                      $data = array(
                          'company' => $safe->company,
                          'site_email' => $safe->site_email,
                          'short_date' => $safe->short_date,
                          'long_date' => $safe->long_date,
                          'time_format' => $safe->time_format,
                          'locale' => $safe->locale,
                          'dtz' => $safe->dtz,
                          'weekstart' => $safe->weekstart,
						  'privacy' => $safe->privacy,
						  );
                      break;

                  case "general":
					  $smedia['facebook'] = $safe->facebook;
					  $smedia['twitter'] = $safe->twitter;
                      $data = array(
                          'currency' => $safe->currency,
                          'lang' => $safe->lang,
                          'perpage' => $safe->perpage,
						  'eucookie' => $safe->eucookie,
						  'social_media' => json_encode($smedia),
						  );
					  if (!empty($_FILES['logo']['name'])) {
						  $data['logo'] = $upl->fileInfo['fname'];
					  }
                      break;

                  case "project":
                      $data = array('project_view' => $safe->project_view);
                      // Process Task labels
                      if (array_key_exists('tasklabels', $_POST)) {
                          $tasklabels = array_filter($_POST['tasklabels']);
                          if ($tasklabels) {
                              foreach ($tasklabels as $key => $value) {
                                  $tasklabelsArray[] = array(
                                      'name' => $value,
                                      'color' => $key ? $key : "NULL",
                                      );
                              }
                              Db::run()->insertBatch(Task::tlbTable, $tasklabelsArray);
                              unset($key, $value);
                          }
                      }
					  $data['tasklabels'] = Db::run()->select(Task::tlbTable)->results('json');

                      // Process Project labels
                      if (array_key_exists('prjlabels', $_POST)) {
                          $prjlabels = array_filter($_POST['prjlabels']);
                          if ($prjlabels) {
                              foreach ($prjlabels as $key => $value) {
                                  $prjlabelsArray[] = array(
                                      'name' => $value,
                                      'color' => $key ? $key : "NULL",
                                      );
                              }
                              Db::run()->insertBatch(Project::plTable, $prjlabelsArray);
                              unset($key, $value);
                          }
                      }
					  $data['prjlabels'] = Db::run()->select(Project::plTable)->results('json');
					  
                      // Process Project Categories
                      if (array_key_exists('prjcats', $_POST)) {
                          $prjcats = array_filter($_POST['prjcats']);
                          if ($prjcats) {
                              foreach ($prjcats as $value) {
                                  $prjcatsArray[] = array('name' => $value, );
                              }
                              Db::run()->insertBatch(Project::pcTable, $prjcatsArray);
                              unset($key, $value);
                          }
                      }
					  $data['prjcats'] = Db::run()->select(Project::pcTable)->results('json');
                      break;

                  case "time":
                      // Process Job Types
                      if (array_key_exists('jtype', $_POST)) {
                          $result = array_filter(array_combine($_POST['jtype'], $_POST['jrate']), function ($v, $k) {
                              return $k == "" || $v == "" ? false : $v; 
							  }, ARRAY_FILTER_USE_BOTH);
                          if ($result) {
                              foreach ($result as $key => $value) {
                                  $jtypeArray[] = array(
                                      'name' => $key,
                                      'hrate' => $value,
                                      );
                              }
                              Db::run()->insertBatch(Project::jtTable, $jtypeArray);
                              unset($k, $v, $key, $value);
                          }
                      }
					  $data['job_types'] = Db::run()->select(Project::jtTable)->results('json');
					  
                      // Process Expense Categories
                      if (array_key_exists('excats', $_POST)) {
                          $excats = array_filter($_POST['excats']);
                          if ($excats) {
                              foreach ($excats as $value) {
                                  $excatsArray[] = array('name' => $value, );
                              }
                              Db::run()->insertBatch(Project::excTable, $excatsArray);
                              unset($k, $v, $key, $value);
                          }
                      }
					  $data['expcats'] = Db::run()->select(Project::excTable)->results('json');
                      break;
				  
                  case "invoicing":
                      $data = array(
                          'invoice_view' => $safe->invoice_view,
                          'overdue' => $safe->overdue,
                          'invoice_number' => $safe->invoice_number,
                          'pagesize' => $safe->pagesize,
						  'invoice_info' => $safe->invoice_info,
						  );
                      // Process Taxes
                      if (array_key_exists('taxName', $_POST)) {
                          $result = array_filter(array_combine($_POST['taxName'], $_POST['taxRate']), function ($v, $k) {
                              return $k == "" || $v == "" ? false : $v; 
							  }, ARRAY_FILTER_USE_BOTH);
                          if ($result) {
                              foreach ($result as $key => $value) {
                                  $taxNameArray[] = array(
                                      'name' => $key,
                                      'amount' => Validator::sanitize($value, "float"),
                                      );
                              }
                              Db::run()->insertBatch(Content::taxTable, $taxNameArray);
                              unset($k, $v, $key, $value);
                          }
                      }
                      break;
              }

              Db::run()->update(self::sTable, $data, array('id' => 1));

              $json['type'] = "success";
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = Lang::$word->CFG_UPDATED;
              $json['redirect'] = Url::url("/admin/configuration");
              print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
      }
	  
      /**
       * Core::restoreFromTrash()
       *
       * @return
       */
      public static function restoreFromTrash($array, $table)
      {
          if ($array) {
              $mapped = array_map(function($k) {
				  return "`".$k."` = ?";
				  },array_keys((array)$array
				  ));
              $stmt = Db::run()->prepare("INSERT INTO `" . $table . "` SET ".implode(", ",$mapped));
              $stmt->execute(array_values((array)$array));
			  
              $json['type'] = "success";
              print json_encode($json);
          }
      }
  }
