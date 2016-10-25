<?php
// Routes

$app->post('/api/beer', 'App\Action\BeerAction:create');
$app->put('/api/beer', 'App\Action\BeerAction:update')->add(App\Middleware\AuthToken::class. ':auth');


$app->group('/api/beers', function ()
    {
        $this->get('', 'App\Action\BeerAction:fetch');
        $this->get('/{id:[0-9]+}', 'App\Action\BeerAction:fetchOne');

    })->add(App\Middleware\AuthToken::class. ':auth');