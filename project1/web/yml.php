<?php

use Symfony\Component\Yaml\Yaml;

$loader = require __DIR__.'/../vendor/autoload.php';

$yaml = <<<EOT
order_homepage:
    path:     /
    defaults: { _controller: OrderBundle:Default:index }

order:
    resource: routing/order.yml
    prefix: /order

customer:
    resource: routing/customer.yml
    prefix: /customer
EOT;

$result = Yaml::parse($yaml);

$result['order_homepage']['path'];
$result['order_homepage']['defaults']['_controller'];

header('Content-Type: text/plain');
echo var_export($result);

$result = array (
    'order_homepage' => array (
        'path' => '/',
        'defaults' => array (
            '_controller' => 'OrderBundle:Default:index',
        ),
    ),
    'order' => array (
        'resource' => 'routing/order.yml',
        'prefix' => '/order',
    ),
    'customer' => array (
        'resource' => 'routing/customer.yml',
        'prefix' => '/customer',
    ),
);