<?php

require_once('payment/Payment/PaymentManager.php');
require_once('membership_plan/Contract.php');
require_once('users/User/UserManager.php');

$errors = null;

$payment_id = SJB_Request::getVar('payment_id', null);
$payment = SJB_PaymentManager::getObjectBySID($payment_id);

if (!is_null($payment)) {
	$payment_status = $payment->getStatus();
	if ($payment_status == PAYMENT_STATUS_VERIFIED) {
		$product_info = $payment->getProductInfo();
		$user_sid = $payment->getUserSID();
		$membership_plan_id = $product_info['membership_plan_id'];
		$contract = new SJB_Contract(array('membership_plan_id' => $membership_plan_id));
		$contract->setUserSID($user_sid);
		if ($contract->saveInDB()) {
			$payment->SetStatus(PAYMENT_STATUS_COMPLETED);
			SJB_PaymentManager::savePayment($payment);
            if (SJB_UserNotifications::isUserNotifiedOnSubscriptionActivation($user_sid)) {
                $membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_id);
                SJB_Notifications::sendSubscriptionActivationLetter($user_sid, $membershipPlanInfo);
            }
			$page = SJB_Request::getVar('page', false);
			if ($page) {
				$page = base64_decode($page);
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . $page);
			}
		}

		$template_processor = SJB_System::getTemplateProcessor();
		$template_processor->assign('membership_plan_id', $membership_plan_id);
		
		
	} else {
		$errors['PAYMENT_IS_NOT_VERIFIED'] = 1;
		
		$template_processor = SJB_System::getTemplateProcessor();
		$template_processor->assign('errors', $errors);
		
	}
	
	
} else {
	$errors['INVALID_PAYMENT_ID'] = 1;
	$template_processor = SJB_System::getTemplateProcessor();
	$template_processor->assign('errors', $errors);
	
}

$template_processor->display('create_contract.tpl');

/*
 	} else {
		$errors['PAYMENT_IS_NOT_VERIFIED'] = 1;
	}
} else {
	$errors['INVALID_PAYMENT_ID'] = 1;
}

$template_processor = SJB_System::getTemplateProcessor();
$template_processor->assign('errors', $errors);
$template_processor->display('create_contract.tpl');


 */