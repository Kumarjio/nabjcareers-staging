<?php

require_once("membership_plan/MembershipPlan.php");
require_once("membership_plan/MembershipPlanManager.php");
require_once("classifieds/DisplayForm.php");
require_once("users/User/User.php");
require_once("users/User/UserManager.php");
require_once("payment/Payment/Payment.php");
require_once("payment/Payment/PaymentManager.php");
require_once("payment/Payment/PaymentFactory.php");
require_once("membership_plan/Contract.php");
require_once("classifieds/MetaDataProvider.php");

$tp = SJB_System::getTemplateProcessor();
$current_user = SJB_UserManager::getCurrentUser();

if (empty($current_user)) {
	$errors['NOT_LOGGED_IN'] = 1;
	$tp->assign("ERRORS", $errors);
	$tp->display("errors.tpl");
	return;
}

if ( $current_user->mayChooseContract() ) {
	$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
	if ( isset($_REQUEST['membership_plan_id']) ) {
		$membership_plan_id = (int)$_REQUEST['membership_plan_id'];
		
		$membership_plan = new SJB_MembershipPlan(array('id' => $membership_plan_id));
		$error = null;
		if ( $current_user->mayChooseMembershipPlan($membership_plan_id, $error) ) {
			
			if ($membership_plan->getPrice() && $ecommerce_mode) {
				$user_sid = $current_user->getSID();
				$product_info = serialize(
					array(	'membership_plan_id'	=> $membership_plan_id,
							'subscription_period'	=> $membership_plan->getSubscriptionPeriod()));
				$status = 'Pending';
				$payment_id = SJB_PaymentManager::getPaymentSID_By_UserID_and_ProductInfo_and_Status($user_sid, $product_info, $status);
				if (empty($payment_id)) {
					$payment_info = array(
											'user_sid' 			=> $user_sid,
											'product_info' 		=> $product_info,
											'price' 			=> $membership_plan->getPrice(),
											'name' 				=> 'Payment for subscription to "' . $membership_plan->getName() . '" plan',
											'success_page_url' 	=> SJB_System::getSystemSettings('SITE_URL') . "/create-contract/",
											'status' 			=> $status,
											'is_recurring'		=> $membership_plan->isRecurring()
										 );
					SJB_Event::dispatch('BeforePaymentSave', $payment_info, true);	
					$payment = SJB_PaymentFactory::createPayment($payment_info);
					SJB_PaymentManager::savePayment($payment);
					$payment_id = $payment->getSID();
				}
				$page = SJB_Request::getVar('page', false);
				if ($page) 
					$page = '&page='.$page;
				$payment_page_url = SJB_System::getSystemSettings('SITE_URL') . "/payment-page/?payment_id=" . $payment_id.$page;

				SJB_HelperFunctions::redirect($payment_page_url);
				return;
			}
			else {
				$contract = new SJB_Contract(array('membership_plan_id' => $membership_plan_id));
				$contract->setUserSID($current_user->getSID());
				$contract->saveInDB();

                if (SJB_UserNotifications::isUserNotifiedOnSubscriptionActivation($current_user->getSID())) {
                    $membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_id);
                    SJB_Notifications::sendSubscriptionActivationLetter($current_user->getSID(), $membershipPlanInfo);
                }

				$page = SJB_Request::getVar('page', false);
				if ($page) {
					$redirectUrl = base64_decode($page);
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . $redirectUrl);
				}
			}
		}
		else if (is_null($error)) {
			$error = "MEMBERSHIP_PLAN_IS_NOT_AVAILABLE";
		}

		$tp->assign("error", $error);
		$tp->display("result_choose_contract.tpl");
	}
	else {
		$user				= SJB_UserManager::getCurrentUser();
		$contractsInfo		= SJB_ContractManager::getAllContractsInfoByUserSID($user->sid);

		$cancelRecurringContract = SJB_Request::getVar('cancelRecurringContract', false);
		if ($cancelRecurringContract)
			$tp->assign('cancelRecurringContractId', $cancelRecurringContract);

		foreach ($contractsInfo as $key => $contractInfo) {
			$contractInfo['extra_info'] 	= unserialize($contractInfo['serialized_extra_info']);
			$contractInfo['countListings']	= SJB_ListingManager::getListingsNumberByUserSID($user->sid);
			$contractInfo['avalaibleViews']	= '';
			if (isset($contractInfo['extra_info']['page_access']))
				$contractInfo['avalaibleViews']	= array_sum($contractInfo['extra_info']['page_access']);
			// подсчитаем количество просмотров, уже имеющихся у пользователя
			$contractInfo['numOfViews']		= array_pop( SJB_DB::query("SELECT count(*) as `count` FROM `page_view` WHERE `id_user` = ?n GROUP BY `id_user`", $user->sid) );
			if (is_array($contractInfo['numOfViews'])) {
				$contractInfo['numOfViews'] = $contractInfo['numOfViews']['count'];
			}
			$contractsInfo[$key] = $contractInfo;
		}

		$contractMeta = array(	'creation_date'   => array('type'	=> 'date',),
								'expired_date'    => array('type'	=> 'date',));
		$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($current_user->getUserGroupSID());
		$available_membership_plan_ids = array_diff($available_membership_plan_ids, $current_user->getSubscribeOnceMembershipPlansIDByUserId());
		$available_membership_plan_ids = array_diff($available_membership_plan_ids, $current_user->getProhibitSubscribingTwiceMembershipPlansIDByUserIds($current_user->getID(), $current_user->getUserGroupSID()));
		// Remove "resume access" plan
		$available_membership_plan_ids = array_diff($available_membership_plan_ids, array('40'));

		$membership_plans_display_info = array();
		
		foreach ($available_membership_plan_ids as $id) {
			$membership_plan = new SJB_MembershipPlan(array('id' => $id));
			$membership_plan_info = $membership_plan->getFieldsInfo();
			$display_form = new SJB_DisplayForm($membership_plan_info);
			$membership_plan_display_fields = $display_form->getFormFields();
			$membership_plans_display_info[$id] = $membership_plan_display_fields;
		}
		
		if (isset($_REQUEST['page']))	
			$tp->assign("page", $_REQUEST['page']);
		$template = "subscription_page.tpl";
		SJB_Event::dispatch('RedefineTemplateName', $template, true);	
		SJB_Event::dispatch('RedefineMembershipPlansDisplayInfo', $membership_plans_display_info, true);
		$tp->assign("ecommerce_mode", $ecommerce_mode);	
		$tp->assign("contractsInfo", $contractsInfo);
		$tp->assign("available_membership_plans", $membership_plans_display_info);
		$tp->assign("METADATA", array_merge(array('membership_plan' => SJB_MetaDataProvider::getMembershipPlanMetaData('Membership Plan', current($membership_plans_display_info)), 'contractInfo' => $contractMeta)));
		$tp->display($template);
	}
}
else {
	$errors['ALREADY_SUBSCRIBED'] = 1;
	$tp->assign("ERRORS", $errors);
	$tp->display("errors.tpl");
}

