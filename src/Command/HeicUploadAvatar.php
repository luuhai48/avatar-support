<?php

/*
 * This file is part of luuhai48/avatar-support.
 *
 * Copyright (c) 2020 Luuhai48.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Luuhai48\AvatarSupport\Command;

use Flarum\User\User;
use Psr\Http\Message\StreamInterface;

class HeicUploadAvatar
{
    /**
     * The ID of the user to upload the avatar for.
     *
     * @var int
     */
    public $userId;

    /**
     * The avatar file to upload.
     *
     * @var StreamInterface
     */
    public $file;

    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * @param int $userId The ID of the user to upload the avatar for.
     * @param StreamInterface $file The stream of avatar file to upload.
     * @param User $actor The user performing the action.
     */
    public function __construct($userId, StreamInterface $file, User $actor)
    {
        $this->userId = $userId;
        $this->file = $file;
        $this->actor = $actor;
    }
}
