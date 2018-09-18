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

namespace Opis\Colibri\Modules\Users\Security;

use Opis\Colibri\Modules\Users\IUser;

interface IPassword
{
    /**
     * @return string
     */
    public function id(): string;

    /**
     * @return IUser
     */
    public function user(): IUser;

    /**
     * @param IUser $user
     * @return IPassword
     */
    public function setUser(IUser $user): self;

    /**
     * @return string
     */
    public function value(): string;

    /**
     * @param string $value
     * @return IPassword
     */
    public function setValue(string $value): self;
}