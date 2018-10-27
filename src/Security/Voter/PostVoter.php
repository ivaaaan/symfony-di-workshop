<?php declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\Post;
use App\Entity\User;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

final class PostVoter implements VoterInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    public const READ = 'post_read';

    public const WRITE = 'post_write';

    public const SUPPORTED_ATTRIBUTES = [
        self::READ,
        self::WRITE,
    ];


    public function vote(string $attribute, $subject, User $user): bool
    {
        $this->logger->debug(sprintf("%s executed", self::class));
        switch ($attribute) {
            case self::READ:
                return $user->hasRole(User::ROLE_USER);
            case self::WRITE:
                return $user->hasRole(User::ROLE_ADMIN);
                break;
            default:
                throw new \LogicException(sprintf('Attribute "%s" is not supported.', $attribute));
        }
    }

    public function supports(string $attribute, $subject, User $user): bool
    {
        return in_array($attribute, self::SUPPORTED_ATTRIBUTES) && $subject instanceof Post;
    }

}