<?php
// Include the PayPal SDK
require __DIR__ . '/vendor/autoload.php';

use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Payments\CapturesRefundRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

// Set up the PayPal API client
$clientId = '1223098';
$clientSecret = 'MzU2NDY5NTEwMzE2MDY5NjcwMDg2NzM2NzQ1MjA2OTUyMDY0NQ==';
$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);

// Get the order ID from the appointment record in your database
$orderId = 'uniqid()';

// Get the order details
$request = new OrdersGetRequest($orderId);
try {
    $response = $client->execute($request);
    $orderStatus = $response->result->status;
    $amount = $response->result->purchase_units[0]->amount->value;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Check if the order is eligible for refund
if ($orderStatus == 'COMPLETED') {
    // Create a refund request
    $refundRequest = new CapturesRefundRequest('YOUR_CAPTURE_ID');
    $refundRequest->body = [
        'amount' => [
            'value' => $amount,
            'currency_code' => 'LKR'
        ]
    ];
    try {
        // Execute the refund request
        $response = $client->execute($refundRequest);
        echo "Refund successful";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "Order is not eligible for refund";
}
?>
