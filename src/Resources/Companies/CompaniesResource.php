<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Companies;

use JustSteveKing\Sevalla\Client;
use JustSteveKing\Sevalla\Resources\Companies\Requests\GetCompanyUsers;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

final readonly class CompaniesResource
{
    public function __construct(
        private string $id,
        private Client $connector,
    ) {}

    /**
     * Get a list of company users.
     *
     * @see https://api-docs.sevalla.com/tag/Company-Users
     * @return array<User>
     * @throws FatalRequestException|RequestException
     */
    public function users(): array
    {
        $response = $this->connector->send(
            request: new GetCompanyUsers(
                companyId: $this->id,
            ),
        );

        return $response->dto();
    }
}
