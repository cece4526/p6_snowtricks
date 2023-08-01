<?php

namespace App\Security\Voter;

use App\Entity\Tricks;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TricksVoter extends Voter
{
    const EDIT = 'TRICK_EDIT';
    const DELETE = 'TRICK_DELETE';
    const CREATE = 'TRICK_CREATE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $trick) : bool
    {
        if (!in_array($attribute, [self::DELETE, self::EDIT, self::CREATE])) {
            return false;
        }

        if (!$trick instanceof Tricks) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $tricks, TokenInterface $token) : bool 
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) return false;

        if ($this->security->isGranted('ROLE_admin'))return true;

        if ($this->security->isGranted('ROLE_USER'))return true;
        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete();
                break;
            case self::EDIT:
                return $this->canEdit();
                break;
            case self::CREATE:
                return $this->canCreate();
                break;
        }
    }

    private function canEdit() : bool {
        return $this->security->isGranted('ROLE_USER');
    }

    private function canDelete() : bool {
        return $this->security->isGranted('ROLE_USER');
    }

    private function canCreate() : bool {
        return $this->security->isGranted('ROLE_USER');
    }
}