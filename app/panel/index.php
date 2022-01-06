<?php

/**
 * Index
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: index.php, v1.00 2019-06-05 10:12:05 gewa Exp $
 */
define("_WOJO", true);

include 'init.php';
$router = new Router();
$tpl = App::View(BASEPATH . 'view/');
$core = App::Core();

//admin routes
$router->mount('/admin', function () use ($router, $tpl) {
	//admin login
	$router->match('GET|POST', '/login', function () use ($tpl) {
		if (App::Auth()->is_Admin()) {
			Url::redirect(SITEURL . '/admin/');
			exit;
		}


		// $tpl->template = 'admin/login.tpl.php';
		// $tpl->title = Lang::$word->LOGIN;
		Url::redirect(SITEURL . '/');
		exit;
	});

	//admin index
	$router->get('/', 'Admin@Index');

	$router->get('/newYearEveryone', 'master@newYear');
	//admin members
	$router->mount('/members', function () use ($router, $tpl) {
		$router->match('GET|POST', '/', 'Users@Index');
		$router->match('GET|POST', '/grid', 'Users@Index');
		$router->get('/archive', 'Users@Archive');
		$router->get('/details/(\d+)', 'Users@Details');
		$router->get('/invite', 'Users@Invite');
		$router->get('/freelancers', 'Users@Freelancers');
		$router->match("GET|POST",'/search', 'Users@advancedSearch');
		$router->get('/project', 'Users@Projects');
		$router->match('GET|POST', '/project/(\d+)', 'Users@ProjectView');
		$router->match('GET', '/([a-zA-Z0-9]+)', 'Admin@ViewAsFreelancer');
	});

	//admin companies
	$router->mount('/companies', function () use ($router, $tpl) {
		$router->match('GET|POST', '/new', 'Company@CompanyNew');
		$router->match('GET|POST', '/view/(\d+)', 'Company@CompanyView');
		$router->match('GET|POST', '/edit/(\d+)', 'Company@CompanyEdit');
	});

	//admin projects
	$router->mount('/projects', function () use ($router, $tpl) {
		$router->match('GET|POST', '/', 'Project@Index');
		$router->match('GET|POST', '/list', 'Project@Index');
		$router->get('/edit/(\d+)', 'Project@Edit');
		$router->get('/new', 'Project@Save');
		$router->get('/bids/(\d+)', 'Project@ProjectBids');
		$router->get('/archive', 'Project@Archive');
		$router->get('/invite/(\d+)', 'Project@Invite');
		$router->get('/tasks/(\d+)', 'Project@Tasks');
		$router->get('/discussions/(\d+)', 'Comments@Project');
		$router->get('/contract/list/(\d+)', 'Project@Files');
		$router->get('/contract/(\d+)', 'Project@Files');
		$router->get('/weekly-update/(\d+)', 'Project@Notes');
		$router->get('/time/(\d+)', 'Project@TimeRecords');
		$router->get('/expenses/(\d+)', 'Project@ExpenseRecords');
		$router->get('/activity/(\d+)', 'Project@Activity');
	});

	//admin email templates
	$router->mount('/templates', function () use ($router, $tpl) {
		$router->get('/', 'Content@Templates');
		$router->get('/edit/(\d+)', 'Content@TemplateEdit');
	});

	//admin permissions
	$router->mount('/permissions', function () use ($router, $tpl) {
		$router->get('/', 'Admin@Permissions');
		$router->get('/privileges/(\d+)', 'Admin@Privileges');
	});

	//admin gateways
	$router->mount('/gateways', function () use ($router, $tpl) {
		$router->get('/', 'Admin@Gateways');
		$router->get('/edit/(\d+)', 'Admin@GatewayEdit');
	});

	//admin tasks
	$router->mount('/tasks', function () use ($router, $tpl) {
		$router->match('GET|POST', '/(\d+)', 'Task@TaskView');
		$router->match('GET|POST', '/completed/(\d+)', 'Task@TaskCompleted');
	});

	//admin discussions
	$router->mount('/discussions', function () use ($router, $tpl) {
		$router->match('GET|POST', '/new/(\d+)', 'Comments@Save');
		$router->match('GET|POST', '/view/(\d+)/(\d+)', 'Comments@View');
		$router->match('GET|POST', '/edit/(\d+)', 'Comments@Edit');
	});

	//admin notes
	$router->mount('/notes', function () use ($router, $tpl) {
		$router->get('/new/(\d+)', 'Project@NoteNew');
		$router->get('/view/(\d+)/(\d+)', 'Project@NoteView');
		$router->get('/edit/(\d+)', 'Project@NoteEdit');
	});

	//admin skills
	$router->mount('/skills', function () use ($router, $tpl) {
		$router->match('GET|POST','/', 'Users@getSkills');
		$router->match('GET|POST','/data', 'Users@ajaxSkills');
		$router->match('GET|POST','/addNew', 'Users@addSkills');
		$router->match('GET|POST','/delete', 'Users@deleteSkills');
	});

	//admin skills
	$router->mount('/contact_list', function () use ($router, $tpl) {
		$router->match('GET|POST','/', 'Users@getContactList');
		$router->match('GET|POST','/data', 'Users@ajaxContactList');
		$router->match('GET|POST','/addNew', 'Users@addContactList');
		$router->match('GET|POST','/delete', 'Users@deleteContactList');
		$router->match('GET|POST','/invite', 'Users@inviteContactList');
		$router->match('GET|POST','/feedback', 'Users@feedbackContactList');
	});

	//admin invoices
	$router->mount('/invoices', function () use ($router, $tpl) {
		$router->match('GET|POST', '/', 'Project@Invoices');
		$router->match('GET|POST', '/grid', 'Project@Invoices');
		$router->get('/view/(\d+)', 'Project@InvoiceView');
		$router->get('/canceled', 'Project@InvoicesCanceled');
		$router->get('/project/(\d+)', 'Project@InvoicesProject');
		$router->get('/new', 'Project@InvoicesNew');
		$router->get('/newr', 'Project@InvoicesNew');
		$router->get('/edit/(\d+)', 'Project@InvoiceEdit');
		$router->get('/duplicate/(\d+)', 'Project@InvoiceEdit');
	});

	//admin estimates
	$router->mount('/estimates', function () use ($router, $tpl) {
		$router->match('GET|POST', '/', 'Content@Estimates');
		$router->get('/view/(\d+)', 'Content@EstimateView');
		$router->get('/archive', 'Content@EstimatesArchived');
		$router->get('/project/(\d+)', 'Content@EstimateProject');
		$router->get('/new', 'Content@EstimateNew');
		$router->get('/edit/(\d+)', 'Content@EstimateEdit');
		$router->get('/invoice/(\d+)', 'Content@EstimateInvoice');
		$router->get('/duplicate/(\d+)', 'Content@EstimateEdit');
	});

	//admin teams
	$router->get('/teams', 'Company@TeamsIndex');

	//admin language manager
	$router->get('/language', 'Lang@Index');

	//admin calendar
	$router->get('/calendar', 'Content@Calendar');

	//admin system
	$router->get('/system', 'Admin@System');

	//admin account
	$router->get('/myaccount', 'Admin@Account');
	$router->get('/mypassword', 'Admin@Password');
	$router->get('/myactivity', 'Users@Activity');

	//admin configuration
	$router->mount('/configuration', function () use ($router, $tpl) {
		$router->get('/', 'Core@Index');
		$router->get('/global', 'Core@Wide');
		$router->get('/general', 'Core@General');
		$router->get('/technical', 'Core@Technical');
		$router->get('/project', 'Core@Project');
		$router->get('/time', 'Core@Time');
		$router->get('/invoicing', 'Core@Invoicing');
	});

	//admin reports
	$router->mount('/reports', function () use ($router, $tpl) {
		$router->get('/', 'Admin@Reports');
		$router->match('GET|POST', '/payments', 'Admin@ReportsPayments');
		$router->match('GET|POST', '/uninvoiced', 'Admin@ReportsUninvoiced');
		$router->match('GET|POST', '/tasks', 'Admin@ReportsTasks');
		$router->match('GET|POST', '/workload', 'Admin@ReportsWorkload');
		$router->match('GET|POST', '/time', 'Admin@ReportsTime');
		$router->match('GET|POST', '/expense', 'Admin@ReportsExpense');
		$router->match('GET|POST', '/budget', 'Admin@ReportsBudget');
	});
	//admin trash
	$router->get('/trash', 'Admin@Trash');

	//logout
	$router->before('GET', '/logout', function () {
		if (App::Auth()->logged_in) {
			App::Auth()->logout();
		}
		Url::redirect(SITEURL . '/admin/');
	});
});
	//admin members
	$router->get('/auth/linkedin/callback/', 'Front@LinkedinCallback');

//frontend routes
$router->get('/', 'Front@Index');
$router->match('GET|POST', '/register', 'Front@registration');
$router->match('GET|POST', '/join/([a-zA-Z0-9]+)', 'Front@Join');
$router->match('GET|POST', '/verify/([a-zA-Z0-9]+)', 'Front@Verify');
$router->match('GET|POST', '/password/([a-z0-9_-]+)', 'Front@passwordUpdate');


//frontend dashboard
$router->mount('/dashboard', function () use ($router, $tpl) {
	$router->match('GET|POST', '/', 'Front@Dashboard');
	$router->match('GET|POST', '/projects', 'Front@Projects');
	$router->match('GET|POST', '/projects/tasks/(\d+)', 'Front@ProjectTasks');
	$router->match('GET|POST', '/projects/discussions/(\d+)', 'Front@ProjectDiscussions');
	$router->match('GET|POST', '/projects/archive', 'Front@Archive');
	$router->match('GET|POST', '/projects/notes/(\d+)', 'Front@ProjectNotes');
	$router->match('GET|POST', '/projects/files/(\d+)', 'Front@ProjectFiles');
	$router->match('GET|POST', '/projects/files/list/(\d+)', 'Front@ProjectFiles');
	$router->match('GET|POST', '/projects/time/(\d+)', 'Front@ProjectTimeRecords');
	$router->match('GET|POST', '/projects/expenses/(\d+)', 'Front@ProjectExpenseRecords');
	$router->match('GET|POST', '/discussions/view/(\d+)/(\d+)', 'Front@ViewDiscussion');
	$router->match('GET|POST', '/discussions/new/(\d+)', 'Front@SaveDiscussion');
	$router->match('GET|POST', '/notes/view/(\d+)/(\d+)', 'Front@ProjectNotesView');
	$router->match('GET|POST', '/notes/new/(\d+)', 'Front@ProjectNotesNew');
	$router->match('GET|POST', '/task/(\d+)/(\d+)', 'Front@Task');
	$router->match('GET|POST', '/tasks/completed/(\d+)', 'Front@TaskCompleted');
	$router->match('GET|POST', '/invoices', 'Front@Invoices');
	$router->match('GET|POST', '/invoices/view/(\d+)', 'Front@InvoiceView');
	$router->match('GET|POST', '/estimates', 'Front@Estimates');
	$router->match('GET|POST', '/estimates/view/(\d+)', 'Front@EstimateView');

	$router->match('GET|POST', '/calendar', 'Front@Calendar');
	$router->match('GET|POST', '/myaccount', 'Front@Account');
	$router->match('GET|POST', '/mypassword', 'Front@Password');
	//$router->match('GET|POST', '/myactivity', 'Front@Activity');
});


$router->match('GET|POST', '/startProject', 'Master@ProjectNew');
//Master for freelancer and clients
$router->mount('/master', function () use ($router, $tpl) {
	// $router->match('GET|POST', '/profile/edit/', 'Master@PorfileEdit');
	$router->match('GET|POST', '/profile/edit/', function () use ($tpl) {
		if (App::Auth()->is_Freelancer())
			App::Master()->PorfileEdit();
		else if (App::Auth()->is_Client())
			App::Master()->PorfileEditClient();
		else {
			Url::redirect(SITEURL . '/');
			exit;
		}
	});
	$router->match('GET|POST', '/mypassword', 'Master@Password');
	$router->match('GET|POST', '/', 'Master@Index');
	$router->match('GET|POST', '/profile/complete', 'Master@Signup');
	$router->match('GET', '/profile/view/([a-zA-Z0-9]+)', 'Master@ViewAs');
	// freelancer manage bids
	$router->get('/bids', 'Master@Bids');


	//master projects
	$router->mount('/projects', function () use ($router, $tpl) {
		$router->match('GET|POST', '/view/(\d+)', 'Master@ProjectView');
		$router->match('GET|POST', '/new', 'Master@ProjectNew');
		$router->match('GET|POST', '/plan_meeting', 'Master@ProjectPlanMeet');
		$router->match('GET|POST', '/', 'Master@Projects');
		$router->match('GET|POST', '/list', 'Master@Projects');
		$router->get('/bids/(\d+)', 'Master@ProjectBids');
		$router->get('/notes/(\d+)', 'masterProject@Notes');
		$router->get('/activity/(\d+)', 'masterProject@Activity');
		$router->get('/files/list/(\d+)', 'masterProject@Files');
		$router->get('/files/(\d+)', 'masterProject@Files');
		$router->get('/time/(\d+)', 'masterProject@TimeRecords');
		$router->get('/expenses/(\d+)', 'masterProject@ExpenseRecords');

		$router->get('/archive', 'masterProject@Archive');
		$router->get('/invite/(\d+)', 'masterProject@Invite');
		$router->get('/tasks/(\d+)', 'masterProject@Tasks');

		$router->get('/contract/list/(\d+)', 'masterProject@Files');
		$router->get('/contract/(\d+)', 'masterProject@Files');
		$router->get('/weekly-update/(\d+)', 'masterProject@Notes');
		$router->get('/time/(\d+)', 'masterProject@TimeRecords');
		$router->get('/expenses/(\d+)', 'masterProject@ExpenseRecords');
		$router->get('/activity/(\d+)', 'masterProject@Activity');
	});


	//master notes
	$router->mount('/notes', function () use ($router, $tpl) {
		$router->get('/new/(\d+)', 'masterProject@NoteNew');
		$router->get('/view/(\d+)/(\d+)', 'masterProject@NoteView');
		$router->get('/edit/(\d+)', 'masterProject@NoteEdit');
	});

		//master notes
		$router->mount('/pdf', function () use ($router, $tpl) {
			$router->get('/download/(\d+)', 'file@downloadPDF');
		});

	//logout
	$router->get('/logout', function () {
		App::Auth()->logout();
		Url::redirect(SITEURL . '/');
	});
});

//logout
$router->get('/logout', function () {
	App::Auth()->logout();
	Url::redirect(SITEURL . '/');
});

//404
$router->set404(function () use ($core, $router) {
	$tpl = App::View(BASEPATH . 'view/');
	$tpl->core = App::Core();
	$tpl->dir = $router->segments[0] == "admin" ? "admin/" : "front/themes/" . $tpl->core->theme . "/";
	$tpl->segments = $router->segments;
	$tpl->data = null;
	$tpl->pageclass = 'error';
	$tpl->core = $core;
	$tpl->title = Lang::$word->META_ERROR;
	$tpl->keywords = null;
	$tpl->description = null;
	$tpl->template = $router->segments[0] == "admin" ? 'admin/404.tpl.php' : "front/themes/" . $tpl->core->theme . "/404.tpl.php";
	echo $tpl->render();
});

// Maintenance mode
if ($core->offline == 1 && !App::Auth()->is_Admin() && !preg_match("#admin/#", $_SERVER['REQUEST_URI'])) {
	Url::redirect(SITEURL . "/maintenance.php");
	exit;
}

// Run router
$router->run(function () use ($tpl, $router) {
	$tpl->segments = $router->segments;
	$tpl->core = App::Core();
	echo $tpl->render();
});
