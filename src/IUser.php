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

namespace OpisColibri\User\Entities;

use DateTime;
use OpisColibri\Permissions\{
    IRole,
    IPermission
};

interface IUser
{
    /**
     * User's id
     *
     * @return  string
     */
    public function id(): string;

    /**
     * Check if the user is admin
     *
     * @return  boolean
     */
    public function isAdmin(): bool;

    /**
     * Registration date
     *
     * @return  DateTime
     */
    public function registrationDate(): DateTime;

    /**
     * @param DateTime $date
     * @return IUser
     */
    public function setRegistrationDate(DateTime $date): self;

    /**
     * User's last login time
     *
     * @return  DateTime|null
     */
    public function lastLogin(): ?DateTime;

    /**
     * @param DateTime $date
     * @return IUser
     */
    public function setLastLogin(DateTime $date): self;

    /**
     * Check if user is active
     *
     * @return  boolean
     */
    public function isActive(): bool;

    /**
     * @param bool $value
     * @return IUser
     */
    public function setIsActive(bool $value): self;

    /**
     * Check if user is an anonymous user
     *
     * @return  boolean
     */
    public function isAnonymous(): bool;

    /**
     * Get user's roles
     *
     * @return iterable|IRole[]
     */
    public function roles(): iterable;

    /**
     * @param iterable $roles
     * @return IUser
     */
    public function setRoles(iterable $roles): self;

    /**
     * Get user's permissions
     *
     * @return iterable|IPermission[]
     */
    public function permissions(): iterable;

    /**
     * Check if the user have the required permissions
     *
     * @param   iterable|IPermission[] $permissions
     *
     * @return  boolean
     */
    public function hasPermissions(iterable $permissions);
}