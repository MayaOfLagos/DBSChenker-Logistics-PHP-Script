<?php

namespace Unicodeveloper\Paystack\Facades;

use GuzzleHttp\Client;
use RuntimeException;

class Paystack
{
    protected static ?array $response = null;
    protected static ?string $authorizationUrl = null;

    public static function getAuthorizationUrl(?array $data = null): self
    {
        $data ??= array_filter([
            'amount' => intval(request('amount')) * intval(request('quantity', 1)),
            'reference' => request('reference'),
            'email' => request('email'),
            'plan' => request('plan'),
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'callback_url' => request('callback_url'),
            'currency' => request('currency') ?: 'NGN',
            'subaccount' => request('subaccount'),
            'transaction_charge' => request('transaction_charge'),
            'split_code' => request('split_code'),
            'split' => request('split'),
            'metadata' => request('metadata'),
        ]);

        static::$response = static::request('POST', '/transaction/initialize', $data);
        static::$authorizationUrl = static::$response['data']['authorization_url'] ?? null;

        if (! static::$authorizationUrl) {
            throw new RuntimeException('Paystack authorization URL was not returned.');
        }

        return new static();
    }

    public function redirectNow()
    {
        return redirect(static::$authorizationUrl);
    }

    public static function getPaymentData(): array
    {
        $reference = request()->query('trxref') ?: request()->query('reference');

        if (! $reference) {
            throw new RuntimeException('Missing Paystack transaction reference.');
        }

        $response = static::request('GET', '/transaction/verify/' . rawurlencode($reference));

        if (($response['status'] ?? false) !== true) {
            throw new RuntimeException('Invalid Paystack transaction reference.');
        }

        return $response;
    }

    protected static function request(string $method, string $uri, array $payload = []): array
    {
        $baseUrl = rtrim((string) config('paystack.paymentUrl'), '/');
        $secretKey = (string) config('paystack.secretKey');

        if ($baseUrl === '' || $secretKey === '') {
            throw new RuntimeException('Paystack is not configured.');
        }

        $client = new Client([
            'base_uri' => $baseUrl,
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
