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

use Opis\Colibri\Collector as AbstractCollector;
use function Opis\Colibri\Functions\make;
use Opis\Colibri\ItemCollectors\ContractCollector;
use Opis\Colibri\ItemCollectors\RouterGlobalsCollector;
use Opis\Colibri\Modules\Users\Impl\{AnonymousUser, PasswordHandler, UserSession};
use Opis\Colibri\Modules\Users\Security\IPasswordHandler;

class Collector extends AbstractCollector
{
    /**
     * @inheritdoc
     */
    public function __invoke(): array
    {
        return [
            'contracts' => -1,
        ];
    }

    /**
     * @param RouterGlobalsCollector $global
     */
    public function routerGlobals(RouterGlobalsCollector $global)
    {
        $global->bind('user', function () {
            return make(IUserSession::class)->currentUser();
        });
    }

    /**
     * @param ContractCollector $contract
     */
    public function contracts(ContractCollector $contract)
    {
        $contract->singleton(IPasswordHandler::class, PasswordHandler::class);
        $contract->singleton(IUserSession::class, UserSession::class);
        $contract->singleton(IAnonymousUser::class, AnonymousUser::class);
    }
}
