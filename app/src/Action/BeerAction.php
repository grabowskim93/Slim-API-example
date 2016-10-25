<?php

namespace App\Action;

use App\Entity\AccessTokens;
use App\Entity\Beers;
use App\Resource\BeerResource;
use App\Resource\TokenResource;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class BeerAction
{
    private $beerResource;
    private $tokenResource;

    public function __construct(BeerResource $beerResource, TokenResource $tokenResource)
    {
        $this->beerResource = $beerResource;
        $this->tokenResource = $tokenResource;
    }

    public function fetch(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $beers = $this->beerResource->get();
        return $response->withJSON($beers);
    }

    public function fetchOne(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $beer = $this->beerResource->get($args['id']);
        if ($beer) {
            return $response->withJSON($beer);
        }
        return $response->withStatus(404, 'Beer not found.');
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $parseBody = $request->getParsedBody();
        $beer = new Beers();
        $beer->setName($parseBody['name']);
        $beer->setIbu($parseBody['IBU']);
        $beer->setGravity($parseBody['Gravity']);
        $beer->setColor($parseBody['Color']);
        $beer = $this->beerResource->post($beer);
        $token = new AccessTokens();
        $token->setAccessTokens(bin2hex(openssl_random_pseudo_bytes(20, getenv('SECRET'))));
        $token->setbeer($beer);
        $token = $this->tokenResource->post($token);
        $accessToken = $this->tokenResource->get($token->getAccessTokens());
        $data = array_merge($beer->getArrayCopy(),$accessToken);
        return $response->withJSON($data, 201);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return mixed
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $parseBody = $request->getParsedBody();
        $beer = $this->beerResource->update($parseBody);

        return $response->withJSON($beer, 204);

    }
}
