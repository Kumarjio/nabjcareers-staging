<?php

require_once("membership_plan/MembershipPlanManager.php");
require_once('membership_plan/Package.php');
require_once('classifieds/_InputForm.php');

$package = new SJB_Package($_REQUEST);
$package_fields = $package->getFieldsInfo();
$package_input_form = new SJB_InputForm($package_fields);

$action = SJB_Request::getVar('action', 'null');
if ($action == 'save_package') {
	$package_input_form->submit();
	if ( $package_input_form->isValidData() ) {
		$package->saveInDB();
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/membership-plan/?id=".$package->membership_plan_id);
	}
} elseif ($action == 'delete') {
	$package = new SJB_Package(array('id'=>$_REQUEST['id']));
	$package->delete();
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/membership-plan/?id=".$package->membership_plan_id);
}
$tp = SJB_System::getTemplateProcessor();
$package_input_form_elements = $package_input_form->getFormFields();
$tp->assign("package_input_form_elements", $package_input_form_elements);
$tp->assign("class_name", $package->class_name);
$tp->assign("membership_plan_id", $package->membership_plan_id);
$tp->assign("membership_plan_info", SJB_MembershipPlanManager::getMembershipPlanInfoByID($package->membership_plan_id));

if ( !is_null($package->id) ) {
	$tp->assign("id", $package->id);
	$package_input_form_block = $tp->fetch("package_update_form.tpl");
	$tp->assign("package_update_form_block", $package_input_form_block);
	$tp->display("package.tpl");
} else {
	$tp->display("add_package.tpl");
}
