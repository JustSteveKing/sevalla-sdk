<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla;

use JustSteveKing\Sevalla\Resources\Applications\ApplicationsResource;
use JustSteveKing\Sevalla\Resources\Companies\CompaniesResource;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\PendingRequest;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use SensitiveParameter;

final class Client extends Connector implements HasPagination
{
    use AlwaysThrowOnErrors;

    public const string VERSION = '1.0.0';

    public function __construct(
        #[SensitiveParameter]
        private readonly string $token,
    ) {}

    public function applications(string $id): ApplicationsResource
    {
        return new ApplicationsResource(
            id: $id,
            connector: $this,
        );
    }

    public function companies(string $id): CompaniesResource
    {
        return new CompaniesResource(
            id: $id,
            connector: $this,
        );
    }

    public function boot(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add(
            key: 'User-Agent',
            value: 'Sevalla-PHP-SDK/' . self::VERSION,
        );
    }

    public function paginate(Request $request): OffsetPaginator
    {
        return new class (connector: $this, request: $request) extends OffsetPaginator {
            protected ?int $perPageLimit = 100;

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('items');
            }

            protected function isLastPage(Response $response): bool
            {
                return false;
            }
        };
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.sevalla.com/v2';
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(
            token: $this->token,
        );
    }
}
