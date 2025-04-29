<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Companies\Requests;

use JsonException;
use JustSteveKing\Sevalla\Resources\Companies\User;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class GetCompanyUsers extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $companyId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/company/{$this->companyId}/users";
    }

    /**
     * @param Response $response
     * @return array<int,User>
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): array
    {
        $data = $response->json();

        if ( ! is_array($data['company']['users'])) {
            throw new JsonException('Invalid response from API');
        }

        return array_map(
            callback: static fn(array $user): User => new User(
                id: $user['user']['id'],
                email: $user['user']['email'],
                image: $user['user']['image'],
                full_name: $user['user']['full_name'],
            ),
            array: $data['company']['users'],
        );
    }
}
