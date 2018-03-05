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

namespace OpisColibri\Users\Credentials;

use function Opis\Colibri\Functions\make;
use OpisColibri\User\Entities\IUser;
use OpisColibri\User\IUserCredentials;
use OpisColibri\Users\Security\IPasswordHandler;
use OpisColibri\Users\Security\IPasswordRepository;

class PasswordCredentials implements IUserCredentials
{
    /** @var string */
    private $password;

    /**
     * PasswordCredentials constructor.
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function validate(IUser $user): bool
    {
        if (null === $password = make(IPasswordRepository::class)->getByUser($user)){
            return false;
        }

        return make(IPasswordHandler::class)->verify($this->password, $password->value());
    }
}