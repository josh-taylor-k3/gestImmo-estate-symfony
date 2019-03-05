<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FacebookController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/facebook", name="connect_facebook_start")
     * @param ClientRegistry $clientRegistry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        return $clientRegistry
            ->getClient('facebook_main') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect([
                'public_profile', 'email' // the scopes you want to access
            ])
            ;
    }

    /**
     * After going to Facebook, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     *
     * @Route("/connect/facebook/check", name="connect_facebook_check")
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
//        // (read below)
//
//        /** @var \KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient $client */
//        $client = $clientRegistry->getClient('facebook_main');
//
//        try {
//            // the exact class depends on which provider you're using
//            /** @var \League\OAuth2\Client\Provider\FacebookUser $user */
//            $user = $client->fetchUser();
//            dump($user);
//
//            // get the access token and then user
//            $accessToken = $client->getAccessToken();
//            $user = $client->fetchUserFromToken($accessToken);
//
//            // access the underlying "provider" from league/oauth2-client
//            $provider = $client->getOAuth2Provider();
//            // if you're using Facebook, then this works:
//            $longLivedToken = $provider->getLongLivedAccessToken($accessToken);
//
//            // do something with all this new power!
//            // e.g. $name = $user->getFirstName();
//            dump($user);
//            dump($accessToken);
//            dump($provider);
//            dump($longLivedToken);
//            die;
//            // ...
//        } catch (IdentityProviderException $e) {
//            throw new \Exception('There is a problem, try again !');
//        }




        if (!$this->getUser()) {
            return new JsonResponse(array('status' => false, 'message' => "User not found!"));
        } else {
            return $this->redirectToRoute('default');
        }
    }
}
