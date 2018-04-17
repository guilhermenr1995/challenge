<?php

namespace AuthBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class ClientController extends FOSRestController
{
    /**
     * Cria um cliente automaticamente, e retorna o access token
     * 
     * @Route("/client/create/auto")
     * @Method({"GET"})
    */
    public function createClient()
    {
        $container = $this->container;
        $oauthServer = $container->get('fos_oauth_server.server');

        $name = substr(md5(random_bytes(10)), 4, 10);
        $redirectUri = 'www.'.$name.'.com';
        $grantType = 'password';

        $clientManager = $container->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris([$redirectUri]);
        $client->setAllowedGrantTypes([$grantType]);
        $clientManager->updateClient($client);

        $userManager = $this->get('fos_user.user_manager');

        $email = substr(md5(random_bytes(10)), 4, 10).'@'.$name.'.com';
        $password = substr(md5(random_bytes(10)), 4, 10);

        $user = $userManager->createUser();
        $user->setUsername($name);
        $user->setEmail($email);
        $user->setEmailCanonical($email);
        $user->setLocked(0);
        $user->setEnabled(1);
        $user->setPlainPassword($password);
        $userManager->updateUser($user);

        $queryData = [];
        $queryData['client_id'] = $client->getPublicId();
        $queryData['redirect_uri'] = $client->getRedirectUris()[0];
        $queryData['response_type'] = 'code';
        $authRequest = new Request($queryData);

        $oauthServer->finishClientAuthorization(true, $user, $authRequest, $grantType);

        $url = $this->generateUrl('fos_oauth_server_token', array(
            'client_id'     => $client->getId().'_'.$client->getRandomId(),
            'client_secret' => $client->getSecret(),
            'username'      => $user->getUsername(),
            'password'      => $password,
            'grant_type'    => 'password',
            'redirect_uri'  => 'http://www.example.com',
            'response_type' => 'code'
        ));

        return $this->redirect($url);
    }
}
