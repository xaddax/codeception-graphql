# Codeception GraphQL
#### A codeception extension for calling GraphQL endpoints

This requires a running server, you can use [Codeception PhpBuiltInServer](https://github.com/tiger-seo/PhpBuiltinServer)
if needed.

#### To configure

In your acceptance.suite.yml file
```yaml
modules:
    enabled:
        - GraphQL:
            url: 'http://localhost:8080/'
```

#### Testing

To use it in a test
```php

class PingCest
{
    public function testPing(AcceptanceTester $I)
    {
        $query = 'query{ping {response}}';
        $I->sendGraphQL($query);
        $expected = [
            'ping' => [
                'response' => 'pong',
            ],
        ];
        $I->assertEquals($expected, $I->grabResponseData());
    }
}

```


