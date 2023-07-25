<?php

namespace App\Security\Voter;

use App\Entity\Tricks;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TricksVoter extends Voter
{
    public const EDIT = 'TRICKS_EDIT';
    public const DELETE = 'TRICKS_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $tricks) : bool
    {
        if (!in_array($attribute, [self::DELETE])) {
            return false;
        }

        if (!$tricks instanceof Tricks) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $tricks, TokenInterface $token) : bool 
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) return false;

        if ($this->security->isGranted('ROLE_ADMIN'))return true;
        
        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete();
                break;
        }
    }

    // private function canEdit() : bool {
    //     return $this->security->isGranted('ROLE_USER');
    // }

    private function canDelete() : bool {
        return $this->security->isGranted('ROLE_USER');
    }
}