<?php

namespace App\Services\API;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use RuntimeException;

abstract class BaseApi implements ApiInterface
{

    protected Client $httpClient;
    protected string $baseUrl;
    protected $exceptionClass = RuntimeException::class;

    public function __construct() {
        $this->httpClient = new Client();
    }

    public function get(string $endpoint): array {
        return $this->makeRequest('GET', $this->baseUrl . $endpoint);
    }

    public function post(string $endpoint, array $data = []): array {
        return $this->makeRequest('POST', $this->baseUrl . $endpoint, $data);
    }

    public function put(string $endpoint, array $data = []): array {
        return $this->makeRequest('PUT', $this->baseUrl . $endpoint, $data);
    }

    public function delete(string $endpoint): array {
        return $this->makeRequest('DELETE', $this->baseUrl . $endpoint);
    }

    protected function getDefaultHeaders(): array {
        return [
            'Accept' => 'application/json',
        ];
    }

    protected function prepareOptions(array $additionalOptions) {
        $options = ['headers' => $this->getDefaultHeaders()];
        if (isset($additionalOptions['headers'])) {
            $options['headers'] = array_merge($options['headers'], $additionalOptions['headers']);
            unset($additionalOptions['headers']);
        }

        return array_merge($options, $additionalOptions);
    }

    protected function makeRequest(string $method, string $url, array $options = []) {
        try {
            $finalOptions = $this->prepareOptions($options);
            $response = $this->httpClient->request($method, $url, $finalOptions);
            $data = json_decode($response->getBody()->getContents(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->throwException('Invalid JSON response from API.');
            }

            return $data;
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorMessage = $e->getResponse()->getBody()->getContents();
            $this->throwException("Client error ({$statusCode}): {$errorMessage}");
        } catch (ServerException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorMessage = $e->getResponse()->getBody()->getContents();
            $this->throwException("Server error ({$statusCode}): {$errorMessage}");
        } catch (RequestException $e) {
            $this->throwException('Connection error: ' . $e->getMessage());
        } catch ( Exception $e) {
            $this->throwException('An unexpected error occurred: ' . $e->getMessage());
        }
    }

    protected function throwException(string $message): void
    {
        $exceptionClass = $this->exceptionClass;

        if (!is_subclass_of($exceptionClass, Exception::class)) {
            throw new RuntimeException('Invalid exception class configured.');
        }

        throw new $exceptionClass($message);
    }
}
