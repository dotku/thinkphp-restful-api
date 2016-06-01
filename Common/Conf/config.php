<?php
return array(
	'URL_ROUTER_ON'   => true, 
    'URL_ROUTE_RULES'=>array(
        'api/:table/[:field]/[:id]' => array('api/index'),
    ),
);