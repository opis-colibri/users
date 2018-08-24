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

namespace Opis\Colibri\Modules\Users\Security;

use Opis\Colibri\Modules\Users\IUser;

interface IPasswordRepository
{
    /**
     * Create password
     *
     * @return IPassword
     */
    public function create(): IPassword;

    /**
     * @param string $id
     * @return null|IPassword
     */
    public function getById(string $id): ?IPassword;

    /**
     * Get a password by user
     *
     * @param IUser $user
     * @return null|IPassword
     */
    public function getByUser(IUser $user): ?IPassword;

    /**
     * Get a password by using a user id
     * @param string $id
     * @return null|IPassword
     */
    public function getByUserId(string $id): ?IPassword;

    /**
     * Save password
     *
     * @param IPassword $password
     * @return bool
     */
    public function save(IPassword $password): bool;

    /**
     * Delete password
     *
     * @param IPassword $password
     * @return bool
     */
    public function delete(IPassword $password): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function deleteById(string $id): bool;
}