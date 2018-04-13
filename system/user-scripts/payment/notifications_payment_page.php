<?php

if (!preg_match("(.*/system/payment/notifications/([^/]+)/?)", $_SERVER['REQUEST_URI'], $matches)) {
    echo '<p class="error">Gateway parameter is missing</p>';
    exit();
}

require_once('payment/PaymentGateway/PaymentGatewayManager.php');
$gateway_id = $matches[1];
$gateway = SJB_PaymentGatewayManager::getObjectByID($gateway_id, true);
if (!$gateway) {
    echo '<p class="error">Invalid gateway</p>';
    exit;
}

$gateway->handleRecurringNotification($_REQUEST);