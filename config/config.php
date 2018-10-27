<?php declare(strict_types=1);

use App\Security\AccessManager;
use App\Security\Voter\VoterInterface;
use Symfony\Component\DependencyInjection\Definition;


$definition = new Definition();
$definition
    ->setAutoconfigured(true)
    ->setPublic(false);

$loader->registerClasses($definition, 'App\\', '../src/*', '../src/{Entity,DependencyInjection}');

$container
    ->registerForAutoconfiguration(VoterInterface::class)
    ->addTag('app.voter');

$container->getDefinition(AccessManager::class)
    ->setPublic(true);