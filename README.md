# Sevalla PHP SDK

The unofficial PHP SDK for Sevalla's REST API.

## Installation

TBC.

## Usage

```php
use JustSteveKing\Sevalla\Client;
use JustSteveKing\Sevalla\Enums\BuildType;
use JustSteveKing\Sevalla\Resources\Applications\Payloads\UpdateApplication;

$sevalla = new Client(
    token: 'your-api-token',
);

// Get a list of users for a specific company.
$sevalla->companies(
    id: '1234',
)->users();

// Get a list of applications for a specific company.
$sevalla->applications(
    id: '1234',
)->list();

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
```
