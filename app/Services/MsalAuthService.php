<?php

namespace App\Services;

use Microsoft\Graph\GraphServiceClient;

use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;
use Microsoft\Kiota\Abstractions\ApiException;

class MsalAuthService
{
    protected $client;

    public function __construct()
    {
        $this->client = $this->getGraphClient();
    }

    protected function getGraphClient()
    {

        //tenantId | clientId | clientSecret
        $credentials = config('graph');

        $oAuthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => $credentials['clientId'],
            'clientSecret' => $credentials['clientSecret'],
            'urlAuthorize' => 'https://login.microsoftonline.com/' . $credentials['tenantId'] . '/oauth2/v2.0/authorize',
            'urlAccessToken' => 'https://login.microsoftonline.com/' . $credentials['tenantId'] . '/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => '',
            'scopeSeparator' => ' ',
        ]);

        $tokenRequestContext = new ClientCredentialContext(
            config('graph.tenantId'),
            config('graph.clientId'),
            config('graph.clientSecret')
        );

        $graphClient = new GraphServiceClient($tokenRequestContext);

        return $graphClient;
    }

    public function validateCredentials($username, $password)
    {
        $result = [];

        try {
            $user = $this->client->users($username)->get();

            $result = [
                'usuario' => $user,
                'error' => false
            ];
        } catch (ApiException $ex) {

            $result = [
                'error' => true,
                'code' => $ex->getError()->getCode(),
                'message' => $ex->getError()->getMessage()
            ];
        }

        return $result;
    }
}
