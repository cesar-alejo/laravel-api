<?php

namespace App\Services;

use Microsoft\Graph\GraphServiceClient;
use Microsoft\Kiota\Abstractions\ApiException;
use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;

class GraphAuthService
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
        //Create a Token Request Context | Crea un TokenRequestContext que obtiene acceso sin un usuario:
        return new ClientCredentialContext(
            config('graph.tenantId'),
            config('graph.clientId'),
            config('graph.clientSecret')
        );
    }

    public function validateCredentials($username, $password)
    {
        $result = [];

        try {

            //throw new \Exception("Authentication in development: $username | $password");

            // Obtener todos los usuarios
            $user = $this->client->users($username)->get()->wait();

            // Obtener propiedades del usuario con la sesión iniciada
            //$result = $this->client->me()->get()->wait();

            // Validate User and Password | https://graph.microsoft.com/beta/users/{userPrincipalName}/validatePassword
            //$requestBody = new ValidatePasswordPostRequestBody();
            //$requestBody->setPassword($password);
            //$result = $this->client->users($username)->validatePassword()->post($requestBody)->wait();
            //$result = $this->client->users($username)->validatePassword($password)->get();

            $result = [
                'error' => false,
                'usuario' => $result
            ];
        } catch (ApiException $ex) {

            $result = [
                'error' => true,
                'code' => $ex->getError()->getCode(),
                'message' => $ex->getError()->getMessage()
            ];

            // Log the error message and code
            //\Log::error('Microsoft Graph error: ' . $errorMessage . ' (code: ' . $errorCode . ')');

        } catch (\Exception $e) {

            $result = [
                'error' => true,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return $result;
    }
}
