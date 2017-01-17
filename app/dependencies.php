<?php
// DIC configurationn

$container = $app->getContainer();


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

// Doctrine
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// -----------------------------------------------------------------------------
// Action 
// -----------------------------------------------------------------------------


$container['App\Action\BeerAction'] = function ($c) {
    $beerResource = new \App\Resource\BeerResource($c->get('em'));
    $tokenResource = new \App\Resource\TokenResource($c->get('em'));
    return new App\Action\BeerAction($beerResource, $tokenResource);
};

//Token
$container['App\Middleware\AuthToken'] = function ($c) {
    $tokenResource = new \App\Resource\TokenResource($c->get('em'));
    return new App\Middleware\AuthToken($tokenResource);
};
