<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Applications\Requests;

use JustSteveKing\Sevalla\Enums\BuildType;
use JustSteveKing\Sevalla\Resources\Applications\Application;
use JustSteveKing\Sevalla\Resources\Applications\Payloads\UpdateApplication;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

final class UpdateBasicDetails extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        private readonly string $id,
        private readonly UpdateApplication $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/applications/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): Application
    {
        $data = $response->json();

        if ( ! is_array($data['app']['id'])) {
            throw new JsonException('Invalid response from API');
        }

        return new Application(
            id: $data['app']['id'],
            name: $data['app']['name'],
            display_name: $data['app']['display_name'],
            status: $data['app']['status'],
            build_path: $data['app']['build_path'] ?? null,
            build_type: BuildType::from(
                value: $data['app']['build_type'],
            ),
            docker_file_path: $data['app']['docker_file_path'] ?? null,
            docker_context: $data['app']['docker_context'] ?? null,
            default_branch: $data['app']['default_branch'] ?? null,
            auto_deploy: $data['app']['auto_deploy'] ?? null,
        );
    }

    protected function defaultBody(): array
    {
        return [
            'build_path' => $this->payload->build_path,
            'build_type' => $this->payload->build_type->value,
            'docker_file_path' => $this->payload->docker_file_path,
            'docker_context' => $this->payload->docker_context,
            'display_name' => $this->payload->display_name,
            'auto_deploy' => $this->payload->auto_deploy,
            'default_branch' => $this->payload->default_branch,
        ];
    }
}
