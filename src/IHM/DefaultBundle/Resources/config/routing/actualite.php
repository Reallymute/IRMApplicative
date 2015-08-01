<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('actualite', new Route('/', array(
    '_controller' => 'GrdfDefaultBundle:Actualite:index',
)));

$collection->add('actualite_show', new Route('/{id}/show', array(
    '_controller' => 'GrdfDefaultBundle:Actualite:show',
)));

$collection->add('actualite_new', new Route('/new', array(
    '_controller' => 'GrdfDefaultBundle:Actualite:new',
)));

$collection->add('actualite_create', new Route(
    '/create',
    array('_controller' => 'GrdfDefaultBundle:Actualite:create'),
    array('_method' => 'post')
));

$collection->add('actualite_edit', new Route('/{id}/edit', array(
    '_controller' => 'GrdfDefaultBundle:Actualite:edit',
)));

$collection->add('actualite_update', new Route(
    '/{id}/update',
    array('_controller' => 'GrdfDefaultBundle:Actualite:update'),
    array('_method' => 'post|put')
));

$collection->add('actualite_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'GrdfDefaultBundle:Actualite:delete'),
    array('_method' => 'post|delete')
));

return $collection;
