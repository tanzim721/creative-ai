<?php

namespace App;

trait AuthenticatableUser
{
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthIdentifier()
    {
        return $this->email;
    }

    // Add method to check if user is main user or subuser
    public function isMainUser()
    {
        return $this instanceof User;
    }

    public function isSubuser()
    {
        return $this instanceof Subuser;
    }

    // Get the main user (returns self if main user, parent if subuser)
    public function getMainUser()
    {
        return $this->isMainUser() ? $this : $this->parentUser;
    }
}
