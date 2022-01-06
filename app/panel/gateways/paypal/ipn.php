<?php
  /**
   * PayPal IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: ipn.php, v1.00 2019-06-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');

  if (isset($_POST['payment_status'])) {
      require_once ("../../init.php");
      require_once ("paypal.class.php");

	  $pp = Db::run()->first(Admin::gTable, array("live", "extra"), array("name" => "paypal"));

      $listener = new IpnListener();
      $listener->use_live = $pp->live;
      $listener->use_ssl = true;
      $listener->use_curl = true;

      try {
          $listener->requirePostMethod();
          $ppver = $listener->processIpn();
      }
      catch (exception $e) {
		  error_log('Process IPN failed: ' . $e->getMessage() . " [".$_SERVER['REMOTE_ADDR']."] \n" . $listener->getResponse(), 3, "pp_errorlog.log");
          exit(0);
      }

      $payment_status = $_POST['payment_status'];
      $receiver_email = $_POST['receiver_email'];
	  $mc_currency = Validator::sanitize($_POST['mc_currency']);
      list($invoice_id, $user_id) = explode("_", $_POST['item_number']);
      $mc_gross = $_POST['mc_gross'];
      $txn_id = Validator::sanitize($_POST['txn_id']);

      if ($ppver) {
          if ($_POST['payment_status'] == 'Completed') {
			  if (strtolower($receiver_email) == strtolower($pp->extra)) {
				  $row = Db::run()->first(Project::ivTable, null, array("id" => intval($invoice_id)));
				  $user = Db::run()->first(Users::mTable, null, array("id" => intval($user_id)));
				  $data = array(
					  'txn_id' => $txn_id,
					  'invoice_id' => $row->id,
					  'company_id' => $row->company_id,
					  'user_id' => $user->id,
					  'user' => $user->fname . " " . $user->lname,
					  'amount' => Validator::sanitize($mc_gross, "float"),
					  'currency' => $row->currency,
					  'pp' => "PayPal",
					  'created' => Db::toDate(),
					  'ip' => Url::getIP(),
					  'status' => 1
					  );
				  
				  $last_id = Db::run()->insert(Project::pyTable, $data)->getLastInsertId();

				  $sum = Db::run()->pdoQuery("SELECT COALESCE(SUM(amount), 0) as total FROM " . Project::pyTable . " WHERE invoice_id = " . $row->id)->result();
				  $datax = array('paid_amount' => $sum->total, 'pstatus' => (Validator::compareNumbers($sum->total, $row->balance_due, "gte") ? 2 : ($sum->total == 0 ? 0 : 1)));
				  Db::run()->update(Project::ivTable, $datax, array("id" => $row->id));

				  /* == Notify Administrator == */
				  $mailer = Mailer::sendMail();
				  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'payComplete'));
				  $core = App::Core();
				  $body = str_replace(array(
					  '[LOGO]',
					  '[COMPANY]',
					  '[DATE]',
					  '[SITEURL]',
					  '[NAME]',
					  '[ITEMNAME]',
					  '[PRICE]',
					  '[STATUS]',
					  '[PP]',
					  '[IP]',
					  '[FB]',
					  '[TW]'), array(
					  Utility::getLogo(),
					  $core->company,
					  date('Y'),
					  SITEURL,
					  $usr->fname . ' ' . $usr->lname,
					  $row->title,
					  $data['amount'] . ' ' . $row->currency,
					  "Completed",
					  "PayPal",
					  Url::getIP(),
					  $core->social->facebook,
					  $core->social->twitter), $tpl->body);
	
				  $msg = Swift_Message::newInstance()
						->setSubject($tpl->subject)
						->setTo(array($core->site_email => $core->company))
						->setFrom(array($usr->email => $usr->fname . ' ' . $usr->lname))
						->setBody($body, 'text/html');
				  $mailer->send($msg);
              }
          } else {
              /* == Failed Transaction= = */
          }
      }
  }