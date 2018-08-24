<?php
/* ===========================================================================
 * Copyright 2018 The Opis Project
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

namespace Opis\Colibri\Modules\Users\Impl;

use DateTime;
use Opis\Colibri\Modules\Permissions\{IPermission, IRole, IRoleRepository};
use Opis\Colibri\Modules\Users\IAnonymousUser;
use Opis\Colibri\Modules\Users\IUser;
use function Opis\Colibri\Functions\make;

class AnonymousUser implements IAnonymousUser
{
    /**
     * @inheritDoc
     */
    public function id(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'Anonymous';
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): IUser
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function email(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function setEmail(string $email): IUser
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function avatar(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function setAvatar(string $avatar = null): IUser
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isAdmin(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function registrationDate(): DateTime
    {
        return new DateTime();
    }

    /**
     * @inheritDoc
     */
    public function setRegistrationDate(DateTime $date): IUser
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lastLogin(): ?DateTime
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function setLastLogin(DateTime $date): IUser
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isActive(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(bool $value): IUser
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isAnonymous(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function roles(): iterable
    {
        return [make(IRoleRepository::class)->getByName('anonymous')];
    }

    /**
     * @inheritDoc
     */
    public function setRoles(iterable $roles): IUser
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function permissions(): iterable
    {
        $permissions = [];

        /** @var IRole $role */
        foreach ($this->roles() as $role) {
            foreach ($role->permissions() as $permission) {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }

    /**
     * @inheritDoc
     */
    public function hasPermissions(iterable $permissions)
    {
        /** @var IPermission $user_permission */
        foreach ($this->permissions() as $user_permission) {
            /** @var IPermission $permission */
            foreach ($permissions as $permission) {
                if ($user_permission->name() !== $permission->name()) {
                    return false;
                }
            }
        }

        return true;
    }
}