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

$action = Validator::post('action');

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
        App::Front()->passReset(true);
        break;

        /* == User Join == */
    case "userJoin":
        App::Front()->Register();
        break;

      /* == Change Password == */
      case "password":
        if(App::Auth()->is_User()) exit;
        App::Front()->passwordChange();
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
        if (!App::Auth()->is_User()) exit;
        App::Front()->updateAccount();
        break;

        /* == Update Password == */
    case "updatePassword":
        if (!App::Auth()->is_User()) exit;
        App::Front()->updatePassword();
        break;

        /* == Process Message == */
    case "processMessage":
        if (!App::Auth()->is_User()) exit;
        App::Comments()->processMessage();
        break;

        /* == Process Discussion == */
    case "processDiscussion":
        if (!App::Auth()->is_User()) exit;
        App::Comments()->processDiscussion(true);
        break;

        /* == Process Project Temp Files == */
    case "tempProjectFiles":
        if (!App::Auth()->is_User()) exit;
        App::Project()->tempProjectFiles(true);
        break;

        /* == Process Note == */
    case "processNote":
        if (!App::Auth()->is_User()) exit;
        App::Content()->processNote(true);
        break;
endswitch;


/* == Clear Session Temp Queries == */
if (isset($_GET['ClearSessionQueries'])) :
    App::Session()->remove('debug-queries');
    App::Session()->remove('debug-warnings');
    App::Session()->remove('debug-errors');
    print 1;
endif;
