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

namespace OpisColibri\Users\Impl;

use DateTime;
use OpisColibri\Users\{
    IAnonymousUser, IUser, IUserCredentials, IUserRepository, IUserSession
};
use function Opis\Colibri\Functions\{
    make, session
};

class UserSession implements IUserSession
{
    const USER_KEY = 'authenticated_user';

    /** @var  AnonymousUser|null */
    private $anonymous = null;

    /** @var IUser|null */
    private $user = null;

    /**
     * @inheritDoc
     */
    public function authenticate(IUser $user, IUserCredentials $credentials): bool
    {
        if ($user instanceof IAnonymousUser) {
            return false;
        }

        if ($credentials->validate($user)) {
            $user->setLastLogin(new DateTime());
            make(IUserRepository::class)->save($user);
            session()->set(self::USER_KEY, $user->id());
            $this->user = $user;
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function signOut(IUser $user): bool
    {
        if ($user instanceof IAnonymousUser) {
            return false;
        }
        $this->user = null;
        return session()->destroy();
    }

    /**
     * @inheritDoc
     */
    public function currentUser(): IUser
    {
        $session = session();
        if ($session->has(self::USER_KEY)) {
            if ($this->user !== null) {
                return $this->user;
            }
            $user = make(IUserRepository::class)
                ->getById($session->get(self::USER_KEY));

            if ($user !== null) {
                return $this->user = $user;
            } else {
                $session->delete(self::USER_KEY);
            }
        }

        if ($this->anonymous === null) {
            $this->anonymous = make(IAnonymousUser::class);
        }

        return $this->anonymous;
    }
}