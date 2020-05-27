<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'FrontEnd/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// FrontEnd
//$route[''] = "FrontEnd/index";
//$route['login'] = "FrontEnd/login";
//$route['logout'] = 'FrontEnd/logout';
$route['logout'] = 'login/logout';
$route['register'] = 'BackEnd/register';
$route['view_user_info'] = "BackEnd/view_user_info";
$route['update_user_records'] = "BackEnd/update_user_records";
$route['AddNewRole'] = 'FrontEnd/AddNewRole';
$route['view_role_permission'] = 'BackEnd/view_role_permission';
$route['ViewUserRole'] = 'FrontEnd/ViewUserRole';
$route['ViewSection'] = 'FrontEnd/ViewSection';
$route['UpdateSection'] = 'FrontEnd/UpdateSection';
$route['view_setting'] = 'BackEnd/view_setting';

// QAN
$route['machinebreakdown'] = "FrontEnd/machinebreakdown";
$route['homepage'] = "FrontEnd/homepage";
$route['machinebreakdownform'] = "FrontEnd/machinebreakdownform";
$route['materialreviewboardform'] = "FrontEnd/materialreviewboardform";
$route['materialreviewboardform/(:any)'] = "FrontEnd/materialreviewboardform/$1";
$route['rootcausefailureform'] = "FrontEnd/rootcausefailureform";
$route['qareviewform'] = "FrontEnd/qareviewform";
$route['updateduserinfo'] = "FrontEnd/updateduserinfo";
$route['viewmachinerecords/([0-9]*)'] = "FrontEnd/viewmachinerecords/$1";
$route['viewallbyqamachinebreakdown/([0-9]*)'] = "FrontEnd/viewallbyqamachinebreakdown/$1";
//$route['viewproductionrecords'] = "FrontEnd/viewproductionrecords";
$route['viewproductionrecords/([0-9]*)'] = "FrontEnd/viewproductionrecords/$1";
$route['successmachinebreakdown'] = "FrontEnd/successmachinebreakdown";
$route['successproduction'] = "FrontEnd/successproduction";
$route['viewlistform/([0-9]*)'] = "FrontEnd/viewlistform/$1";
$route['viewlistnewbyproductionform/([0-9]*)'] = "FrontEnd/viewlistnewbyproductionform/$1";
// $route['viewmaterialrecords'] = "FrontEnd/viewmaterialrecords";
$route['successmaterialreviewboard'] = "FrontEnd/successmaterialreviewboard";
$route['DashboardMachineBreakdown'] = "FrontEnd/DashboardMachineBreakdown";
$route['ViewListMachineBreakdownByQA'] = "FrontEnd/ViewListMachineBreakdownByQA";
$route['ViewMachineBreakdownByQA/([0-9]*)'] = "FrontEnd/ViewMachineBreakdownByQA/$1";
$route['dashboard'] = "FrontEnd/dashboard";
$route['ViewListMachineBreakdownByProduction'] = "FrontEnd/ViewListMachineBreakdownByProduction";
$route['ViewMachineBreakdownByProduction/([0-9]*)'] = "FrontEnd/ViewMachineBreakdownByProduction/$1";
$route['DashboardMaterialReviewBoard'] = "FrontEnd/DashboardMaterialReviewBoard";
$route['ViewListCompleteMachineBreakdown'] = "FrontEnd/ViewListCompleteMachineBreakdown";
$route['ViewMaterialReviewBoardByMRB/([0-9]*)'] = "FrontEnd/ViewMaterialReviewBoardByMRB/$1";
$route['ViewMaterialReviewBoardRecords/([0-9]*)'] = "FrontEnd/ViewMaterialReviewBoardRecords/$1";
$route['ViewMaterialReviewBoard'] = "FrontEnd/ViewMaterialReviewBoard";
$route['DashboardRootCauseFailure'] = "FrontEnd/DashboardRootCauseFailure";
$route['ViewListCompleteMaterialReviewBoard'] = "FrontEnd/ViewListCompleteMaterialReviewBoard";
$route['ViewRootCauseFailureByEngineering/([0-9]*)'] = "FrontEnd/ViewRootCauseFailureByEngineering/$1";
$route['ViewRootCauseFailureRecords/([0-9]*)'] = "FrontEnd/ViewRootCauseFailureRecords/$1";
$route['ViewRootCauseFailure'] = "FrontEnd/ViewRootCauseFailure";
$route['DashboardForQAUseOnly'] = "FrontEnd/DashboardForQAUseOnly";
$route['ViewListCompleteRootCauseFailure'] = "FrontEnd/ViewListCompleteRootCauseFailure";
$route['ViewForQAUseOnlyByQAEngineer/([0-9]*)'] = "FrontEnd/ViewForQAUseOnlyByQAEngineer/$1";
$route['ViewForQAUseOnlyRecords/([0-9]*)'] = "FrontEnd/ViewForQAUseOnlyRecords/$1";
$route['ViewForQAUseOnly'] = "FrontEnd/ViewForQAUseOnly";
$route['DashboardFinalReviewQAEngineer'] = "FrontEnd/DashboardFinalReviewQAEngineer";
$route['ViewListCompleteForQAUseOnly'] = "FrontEnd/ViewListCompleteForQAUseOnly";
$route['ViewFinalReviewByQAEngineer/([0-9]*)'] = "FrontEnd/ViewFinalReviewByQAEngineer/$1";
$route['ViewFinalReviewRecords/([0-9]*)'] = "FrontEnd/ViewFinalReviewRecords/$1";
$route['ViewFinalReview'] = "FrontEnd/ViewFinalReview";
$route['dashboardlistmrbform'] = "FrontEnd/dashboardlistmrbform";
$route['viewlistmrbform/([0-9]*)'] = "FrontEnd/viewlistmrbform/$1";
$route['viewrootcauserecords/([0-9]*)'] = "FrontEnd/viewrootcauserecords/$1";
$route['successrootcausefailure'] = "FrontEnd/successrootcausefailure";
$route['dashboardlistrootcauseform'] = "FrontEnd/dashboardlistrootcauseform";
$route['viewlistrootcauseform/([0-9]*)'] = "FrontEnd/viewlistrootcauseform/$1";
$route['viewforqaonlyrecords/([0-9]*)'] = "FrontEnd/viewforqaonlyrecords/$1";
$route['successforqaonly'] = "FrontEnd/successforqaonly";
$route['viewlistforqaonlyform/([0-9]*)'] = "FrontEnd/viewlistforqaonlyform/$1";
$route['viewreviewbyqarecords/([0-9]*)'] = "FrontEnd/viewreviewbyqarecords/$1";
$route['successreviewbyqa'] = "FrontEnd/successreviewbyqa";
