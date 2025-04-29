<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Applications\Requests;

use JsonException;
use JustSteveKing\Sevalla\Resources\Applications\Application;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

final class GetListOfApplications extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $companyId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/applications';
    }

    /**
     * @param Response $response
     * @return array<int,Application>
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): array
    {
        $data = $response->json();

        if ( ! is_array($data['company']['apps']['items'])) {
            throw new JsonException('Invalid response from API');
        }

        return array_map(
            callback: static fn(array $item): Application => new Application(
                id: $item['id'],
                name: $item['name'],
                display_name: $item['display_name'],
                status: $item['status'],
            ),
            array: $data['company']['apps']['items'],
        );
    }

    protected function defaultQuery(): array
    {
        return [
            'company' => $this->companyId,
        ];
    }
}
