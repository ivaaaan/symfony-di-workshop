<?php

use App\DependencyInjection\Compiler\VoterPass;
use App\Entity\Post;
use App\Entity\User;
use App\Security\AccessManager;
use App\Security\Voter\PostVoter;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Reference;

require __DIR__ . '/vendor/autoload.php';

$cachedContainerFile = __DIR__ . '/var/cache/CachedContainer.php';

$container = new ContainerBuilder();
$container->addCompilerPass(new VoterPass());


$loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load('parameters.php');
$loader->load('config.php');
$loader->load('monolog.php');

$container->compile();

file_put_contents($cachedContainerFile, (new PhpDumper($container))->dump(['class' => 'CachedContainer']));

/** @var AccessManager $accessManager */
$accessManager = $container->get(AccessManager::class);


$user = new User('Alex');
$admin = new User('Admin');

$admin->addRole(User::ROLE_ADMIN);

$post = new Post();

var_dump($accessManager->decide(PostVoter::WRITE, $post, $user));
var_dump($accessManager->decide(PostVoter::WRITE, $post, $admin));
