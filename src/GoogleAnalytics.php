<?php

class GoogleAnalytics
{
    private const API_URL = 'https://www.google-analytics.com/mp/collect';

    public function __construct(private string $measurementId, private string $apiSecret)
    {

    }

    public function sendEvent($eventName, array $eventParams): void
    {
        $url = self::API_URL . '?measurement_id=' . $this->measurementId . '&api_secret=' . $this->apiSecret;

        $eventData = [
                'client_id' => '555',
                'events' => [
                        [
                                'name' => $eventName,
                                'params' => $eventParams
                        ]
                ]
        ];

        $options = [
                'http' => [
                        'header'  => "Content-Type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => json_encode($eventData),
                ],
        ];

        try {
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);

            if ($result === false) {
                throw new Exception('Failed to send data to Google Analytics.');
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}