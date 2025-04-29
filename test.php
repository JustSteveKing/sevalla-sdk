<?php

declare(strict_types=1);

use JustSteveKing\Sevalla\Client;
use JustSteveKing\Sevalla\Enums\BuildType;
use JustSteveKing\Sevalla\Resources\Applications\Payloads\UpdateApplication;

require __DIR__ . '/vendor/autoload.php';

$sevalla = new Client(
    token: 'your-api-token',
);

// Get a list of users for a specific company.
$sevalla->companies(
    id: '1234',
)->users();

// Update an application's basic details.
$sevalla->applications(
    id: '1234',
)->update(UpdateApplication::make([
    'build_path' => 'path/to/build',
    'build_type' => BuildType::Nix,
    'docker_file_path' => 'path/to/dockerfile',
    'docker_context' => 'path/to/context',
    'display_name' => 'My Application',
    'auto_deploy' => true,
    'default_branch' => 'main',
]));
