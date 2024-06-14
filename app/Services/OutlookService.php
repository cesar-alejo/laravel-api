<?php

namespace App\Services;

use Microsoft\Graph\GraphServiceClient;
use Microsoft\Kiota\Abstractions\ApiException;
use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;

//use Microsoft\Graph\Graph;
//use Microsoft\Graph\Model;

class OutlookService
{
    protected $client;

    public function __construct()
    {
        // With specific scopes
        //$scopes = ['User.Read', 'Mail.ReadWrite'];
        $this->client = new GraphServiceClient($this->getAccessToken());
    }

    protected function getAccessToken()
    {
        //solicitudes sin un usuario registrado (utilizando los permisos de la aplicación)
        return new ClientCredentialContext(
            config('graph.tenantId'),
            config('graph.clientId'),
            config('graph.clientSecret')
        );
    }

    public function getEmails()
    {
        try {

            $user = $this->client->users()->byUserId('[userPrincipalName]')->get()->wait();
        } catch (ApiException $ex) {

            return [
                'error' => $ex->getError()->getMessage()
            ];
        }

        //$emailMessages = $this->client->createRequest('GET', '/me/mailfolders/inbox/messages')
        //    ->setReturnType(Model\Message::class)
        //    ->execute();

        $emailMessages = [
            'userPrincipalName' => $user->getGivenName()
        ];

        return $emailMessages;
    }
}
