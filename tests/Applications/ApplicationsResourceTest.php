<?php

declare(strict_types=1);

use JustSteveKing\Sevalla\Client;
use JustSteveKing\Sevalla\Enums\BuildType;
use JustSteveKing\Sevalla\Resources\Applications\Application;
use JustSteveKing\Sevalla\Resources\Applications\Payloads\UpdateApplication;
use JustSteveKing\Sevalla\Resources\Applications\Requests\GetListOfApplications;
use JustSteveKing\Sevalla\Resources\Applications\Requests\UpdateBasicDetails;

describe('Applications By Company ID', function (): void {
    test('it can get a list of applications by company ID.', function (): void {
        $connector = new Client(
            token: '1234',
        );

        $connector->withMockClient(mockClient([
            GetListOfApplications::class => fakeResponse('applications/list'),
        ]));


        $response = $connector->applications(
            id: '1234',
        )->list();

        expect($response)->toBeArray()->each->toBeInstanceOf(Application::class);
    });
    test('it can update an application', function (): void {
        $connector = new Client(
            token: '1234',
        );

        $connector->withMockClient(mockClient([
            UpdateBasicDetails::class => fakeResponse('applications/update'),
        ]));

        $response = $connector->applications(
            id: '1234',
        )->update(data: UpdateApplication::make([
            'build_path' => 'path/to/build',
            'build_type' => BuildType::Nix,
            'docker_file_path' => 'path/to/dockerfile',
            'docker_context' => 'path/to/context',
            'display_name' => 'My Application',
            'auto_deploy' => true,
            'default_branch' => 'main',
        ]));

        expect($response)->toBeInstanceOf(Application::class);
    });
});
