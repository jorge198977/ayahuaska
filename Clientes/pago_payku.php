<?php
print_r($_POST['order_id']);
if (isset($_POST['order_id'])) {$order_id = $_POST['order_id']; } else { $order_id = 0; }
if (isset($_POST['transaction_id'])) { $transaction_id = $_POST['transaction_id']; } else { $transaction_id = 0; }
if (isset($_POST['status'])) {$status = $_POST['status']; } else {$status = 2; }
if (isset($_POST['verification_key'])) { $verification_key = $_POST['verification_key']; } else {$verification_key = 0; }
$payku= new Paykulib($order_id);
$payku->setContext($this);
if (!empty($payku->order)) {
$order_total = (int)($payku->getOrderTotal());
$order_total_additonal = $order_total + round(($order_total * (float)$payku->getIncremOrder())/100.0);
$validate_parameters = $payku->validate_parameters($transaction_id, $verification_key, $order_total_additonal);
if($status == 0)
{
error_log("A. Estatus no fue recibido: ".$status.", Para la orden : ".$order_id);
$payku->order->update_status( 'failed', ( 'Pago con Payku rechazado', 'woocommerce' ));
}

}

?>