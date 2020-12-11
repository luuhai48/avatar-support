<?php

/*
 * This file is part of luuhai48/avatar-support.
 *
 * Copyright (c) 2020 Luuhai48.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Luuhai48\AvatarSupport\Controller;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Api\Controller\AbstractShowController;
use GuzzleHttp\Client;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Luuhai48\AvatarSupport\Command\HeicUploadAvatar;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class AvatarSupportController extends AbstractShowController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = UserSerializer::class;

    /**
     * @var Dispatcher
     */
    protected $bus;

    /**
     * @var SettingsRepositoryInterface
     * @param Dispatcher $bus
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings, Dispatcher $bus)
    {
        $this->settings = $settings;
        $this->bus = $bus;
    }

    /**
     * {@inheritdoc}
     */
    public function data(ServerRequestInterface $request, Document $document)
    {
        $id = Arr::get($request->getQueryParams(), 'id');
        $actor = $request->getAttribute('actor');

        $processorUrl = $this->settings->get('luuhai48-avatar-support.processor_url');

        $file = Arr::get($request->getUploadedFiles(), 'img');

        $client = new Client(['headers' => ['Authorization' => 'auth_trusted_header']]);

        $response = $client->post(
            $processorUrl,
            [
                'multipart' => [
                    [
                        'Content-Type' => 'multipart/form-data',
                        'name' => 'img',
                        'contents' => $file->getStream(),
                        'filename' => 'avatar.heic'
                    ]
                ]
            ]
        );

        $converted_file = $response->getBody();

        return $this->bus->dispatch(
            new HeicUploadAvatar($id, $converted_file, $actor)
        );
    }
}
