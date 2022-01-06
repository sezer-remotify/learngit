<?php
  /**
   * Stripe IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: ipn.php, v1.00 2019-08-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../init.php");

  if (!App::Auth()->is_User())
      exit;

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');

  if (isset($_POST['processStripePayment'])) {
	  $rules = array(
		  'id' => array('required|numeric', "Invalid Invoice ID"),
		  'payment_method' => array('required|string', "Invalid Payment Method"),
		  );
			  
	  $validate = Validator::instance();
	  $safe = $validate->doValidate($_POST, $rules);

      if (empty(Message::$msgs)) {
          require_once BASEPATH . "/gateways/stripe/vendor/autoload.php";

          $key = Db::run()->first(Admin::gTable, array("extra", "extra2"), array("name" => "stripe"));

          \Stripe\Stripe::setApiKey($key->extra);
          try {
              //Create a client
              $client = \Stripe\Customer::create(array(
			      "payment_method" => $safe->payment_method,
                  "description" => App::Auth()->name,
                  ));

			  $row = Db::run()->first(Project::ivTable, null, array("id" => $safe->id));
			  $user = Db::run()->first(Users::mTable, null, array("id" => App::Auth()->uid));
			  $data = array(
				  'txn_id' => time(),
				  'invoice_id' => $row->id,
				  'company_id' => $row->company_id,
				  'user_id' => $user->id,
				  'user' => $user->fname . " " . $user->lname,
				  'amount' => Validator::sanitize($row->balance_due - $row->paid_amount, "float"),
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
				  

              $jn['type'] = 'success';
			  $jn['title'] = Lang::$word->SUCCESS;
              $jn['message'] = Lang::$word->INV_POK;
              print json_encode($jn);

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
				  $user->fname . ' ' . $user->lname,
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
					->setFrom(array(App::Auth()->email => App::Auth()->name))
					->setBody($body, 'text/html');
              $mailer->send($msg);

          }
          catch (\Stripe\Error\Card $e) {
              $body = $e->getJsonBody();
              $err = $body['error'];
              $json['type'] = 'error';
              Message::$msgs['msg'] = 'Message is: ' . $err['message'] . "\n";
              Message::msgSingleStatus();
          }
      } else {
          Message::msgSingleStatus();
      }
  }