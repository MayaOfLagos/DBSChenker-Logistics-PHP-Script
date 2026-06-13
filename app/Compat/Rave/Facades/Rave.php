<?php

namespace KingFlamez\Rave\Facades;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use RuntimeException;

class Rave
{
    public static function generateReference(): string
    {
        return 'flw_' . Str::random(24);
    }

    public static function initializePayment(array $data): array
    {
        return static::request('POST', '/payments', $data);
    }

    public static function getTransactionIDFromCallback(): ?string
    {
        return request('transaction_id') ?: request('tx_ref');
    }

    public static function verifyTransaction(?string $transactionId): array
    {
        if (! $transactionId) {
            throw new RuntimeException('Missing Flutterwave transaction ID.');
        }

        return static::request('GET', '/transactions/' . rawurlencode($transactionId) . '/verify');
    }

    protected static function request(string $method, string $uri, array $payload = []): array
    {
        $secretKey = (string) config('flutterwave.secretKey');

        if ($secretKey === '') {
            throw new RuntimeException('Flutterwave is not configured.');
        }

        $client = new Client([
            'base_uri' => 'https://api.flutterwave.com/v3',
            'headers' => [
                'Authorization' => 'Bearer ' . $secretKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);

        $options = [];

        if ($payload !== []) {
            $options['json'] = $payload;
        }

        $response = $client->request($method, $uri, $options);

        return json_decode((string) $response->getBody(), true) ?: [];
    }
}
