<?php

/*
 * This file is part of luuhai48/avatar-support.
 *
 * Copyright (c) 2020 Luuhai48.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Luuhai48\AvatarSupport;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
];
