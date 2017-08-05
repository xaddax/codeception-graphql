<?php
declare(strict_types=1);

namespace Codeception\Module;

use Codeception\Module as CodeceptionModule;
use Codeception\TestInterface;
use EUAutomation\GraphQL\Client;
use EUAutomation\GraphQL\Response;

class GraphQL extends CodeceptionModule
{
    /** @var Client */
    public $client;

    /** @var Response */
    public $response;

    public function _before(TestInterface $test)
    {
        $this->client = new Client($this->_getConfig('url'));
        $this->resetVariables();
    }

    protected function resetVariables()
    {
        $this->response = null;
    }

    public function sendGraphQL($query, array $variables = [], array $headers = [])
    {
        $this->execute($query, $variables, $headers);

        return $this->response;
    }

    public function grabResponseData()
    {
        return json_decode($this->response->toJson(), true);
    }

    public function grabResponseDataJson()
    {
        return $this->response->toJson();
    }

    protected function execute($query, array $variables = [], array $headers = [])
    {
        $this->response = $this->client->response($query, $variables, $headers);
    }
}
