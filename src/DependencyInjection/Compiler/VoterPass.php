<?php declare(strict_types=1);

namespace App\DependencyInjection\Compiler;

use App\Security\AccessManager;
use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class VoterPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $accessManagerDefinition = $container->getDefinition(AccessManager::class);
        $accessManagerDefinition->addArgument(new TaggedIteratorArgument('app.voter'));
    }
}