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

use Flarum\Foundation\DispatchEventsTrait;
use Flarum\User\AvatarUploader;
use Flarum\User\Event\AvatarSaving;
use Flarum\User\UserRepository;
use Illuminate\Contracts\Events\Dispatcher;
use Intervention\Image\ImageManager;

class HeicUploadAvatarHandler
{
    use DispatchEventsTrait;

    /**
     * @var \Flarum\User\UserRepository
     */
    protected $users;

    /**
     * @var AvatarUploader
     */
    protected $uploader;

    /**
     * @param Dispatcher $events
     * @param UserRepository $users
     * @param AvatarUploader $uploader
     */
    public function __construct(Dispatcher $events, UserRepository $users, AvatarUploader $uploader)
    {
        $this->events = $events;
        $this->users = $users;
        $this->uploader = $uploader;
    }

    /**
     * @param HeicUploadAvatar $command
     * @return \Flarum\User\User
     * @throws \Flarum\User\Exception\PermissionDeniedException
     */
    public function handle(HeicUploadAvatar $command)
    {
        $actor = $command->actor;

        $user = $this->users->findOrFail($command->userId);

        if ($actor->id !== $user->id) {
            $actor->assertCan('edit', $user);
        }

        $image = (new ImageManager)->make($command->file);

        $this->events->dispatch(
            new AvatarSaving($user, $actor, $image)
        );

        $this->uploader->upload($user, $image);

        $user->save();

        $this->dispatchEventsFor($user, $actor);

        return $user;
    }
}
