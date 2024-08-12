<?php

require_once 'ExchangeRateApi.php';
require_once 'GoogleAnalytics.php';

$measurementId = getenv('GA4_MEASUREMENT_ID');
$apiSecret = getenv('GA4_API_SECRET');

$exchangeRate = (new ExchangeRateApi())->getRate('USD');
if (isset($exchangeRate)) {
    $googleAnalytics = new GoogleAnalytics($measurementId, $apiSecret);

    $googleAnalytics->sendEvent('exchange_rate_update', [
            'currency_pair' => 'UAH/USD',
            'exchange_rate' => $exchangeRate
    ]);
    echo "Exchange rate sent to Google Analytics successfully.\n";
} else {
    echo "Failed to retrieve the exchange rate.\n";
}