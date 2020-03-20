<?php

namespace App\PlanningBiblio;

use Symfony\Component\HttpFoundation\Request;
use League\OAuth2\Client\Provider\GenericProvider;

class OAuth {

    # Prérequis:
    # 
    # L'instance PlanningBiblio doit être en HTTPS.
    #
    # Configurer son compte Microsoft pour l'API Graph:
    #
    # Créer ou utiliser un compte Microsoft.
    # Se rendre sur le portail Microsoft Azur (https://portal.azure.com) avec le même compte.
    # Cliquer sur Azure Active Directory pour créer l'annuaire de l'organisation (compte gratuit de 30 jours ou payant).
    # 
    # Inscrire l'application (toujours sur Azure) 
    # Dans la même page (AD) cliquer sur "inscriptions d'applications".
    #     => nouvelle inscription,
    #     => cocher "compte dans cette annuaire d'organisation uniquement,
    #     => renseigner l'url de redirection (pour le retour),
    #     => cliquer sur "s'inscrire" pour valider.
    #
    # Sur le dashborad de l'application qui apparait, noter:
    #     - L'id d'application (client) => $this->clientid,
    #     - L'id de l'annuaire (locataire) => Tenant: l'identifiant dans l'url (467158a5-8844-4109-a16a-79d35a612a5a/oauth2/token),
    #     - Id de l'objet => on sait pas au moment de l'écriture de cette doc :^),
    #
    # Cliquer sur certificats secrets:
    # Cliquer sur "nouveau secret client"
    # Mettre la valeur dans $this->clientsecret.

    private $clientid;

    private $clientsecret;

    private $tokenURL = "https://login.microsoftonline.com/{tenant}/oauth2/token";

    private $authURL = "https://login.microsoftonline.com/{tenant}/oauth2/authorize";

    private $redirectURL = "https://my.planningbiblio.fr/graphauth";

    function __construct() {

	// Application client id
        $this->clientid = 'e99dfb02-a369-4443-9c6a-b92e430ba7c5';

	// Application client secret
        $this->clientsecret = 'ZGgAw0:8AJ_e=Tjv-hemqnbB97:xkr:I';

	// Tenant id
	$this->tokenURL = "https://login.microsoftonline.com/467158a5-8844-4109-a16a-79d35a612a5a/oauth2/v2.0/token";
	$this->authURL = "https://login.microsoftonline.com/467158a5-8844-4109-a16a-79d35a612a5a/oauth2/v2.0/authorize";

	$this->redirectURL = "https://graph-planningb.test.biblibre.eu/";
    }

    function getToken() {


	$options = [
	     //'scope' => 'https://graph.microsoft.com/'
	     'scope' => 'https://graph.microsoft.com/.default'
	     //'scope' => 'https://graph.windows.net'
	];

        //$provider = new \League\OAuth2\Client\Provider\GenericProvider([
        $provider = new GenericProvider([
            'clientId'                => $this->clientid,
            'clientSecret'            => $this->clientsecret,
            'urlAuthorize'            => $this->authURL,
            'urlAccessToken'          => $this->tokenURL,
	    'redirectUri'             => $this->redirectURL,
            'urlResourceOwnerDetails' => '',
            'scopes'                  => 'openid profile offline_access user.read calendars.read'
        ]);

	$authUrl = $provider->getAuthorizationUrl();
	$state = $provider->getState();
	var_dump($this->authURL . "<br /><br />");
	var_dump($state . "<br /><br />");


        //if (!array_key_exists("oauthToken", $_SESSION)) {
	// For debug purposes, ask the token every time
        if (1) {
            try {

                // Try to get an access token using the client credentials grant.
                $accessToken = $provider->getAccessToken('client_credentials', $options);

            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

                // Failed to get the access token
		echo("Unable to get token: \n");
		echo ("<pre>");
                var_dump($e->getResponseBody());
		echo ("</pre>");
                echo("Message: " . $e->getMessage() . " code: " . $e->getCode());
		exit();

            }
        } else {
            $existingAccessToken = unserialize($_SESSION['oauthToken']);
            if ($existingAccessToken->hasExpired()) {
		$refresh_token = $existingAccessToken->getRefreshToken();
		if ($refresh_token != null) {
			$newAccessToken = $provider->getAccessToken('refresh_token', [
			    'refresh_token' => $refresh_token
			]);
		} else {
			$newAccessToken = $provider->getAccessToken('client_credentials');
		}
                $accessToken = $newAccessToken;
            } else {
                $accessToken = $existingAccessToken;
            }
        }
        $_SESSION['oauthToken'] = serialize($accessToken);
        return $accessToken;
    }
}

