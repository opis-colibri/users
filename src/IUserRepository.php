<?php
/* ===========================================================================
 * Copyright 2018 Zindex Software
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

namespace Opis\Colibri\Modules\Users;

interface IUserRepository
{
    /**
     * Create user
     * @return IUser
     */
    public function create(): IUser;

    /**
     * @param int $start
     * @param int $count
     * @param array $filters
     * @return iterable|IUser[]
     */
    public function getAll(int $start = 0, int $count = 25, array $filters = []): iterable;

    /**
     * Load a user by id
     *
     * @param string $id
     * @return IUser|null
     */
    public function getById(string $id): ?IUser;

    /**
     * Load a user using their email address
     * @param string $email
     * @return null|IUser
     */
    public function getByEmail(string $email): ?IUser;

    /**
     * Save modified user
     *
     * @param IUser $user
     * @return bool
     */
    public function save(IUser $user): bool;

    /**
     * Delete user
     *
     * @param IUser $user
     * @return bool
     */
    public function delete(IUser $user): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function deleteById(string $id): bool;

    /**
     * @param string[] $ids
     * @return int
     */
    public function deleteMultipleById(array $ids): int;
}
