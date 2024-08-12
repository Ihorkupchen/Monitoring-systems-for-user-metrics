<?php

class ExchangeRateApi
{
    private const API_URL = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange';

    public function getRate(string $currency = 'USD'): ?float
    {
        $url = self::API_URL . '?json&valcode=' . $currency;

        try {
            $response = file_get_contents($url);
            if (!$response) {
                throw new Exception('Failed to fetch exchange rate data.');
            }
            $data = json_decode($response, true);
            return $data[0]['rate'] ?? null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            return null;
        }
    }
}