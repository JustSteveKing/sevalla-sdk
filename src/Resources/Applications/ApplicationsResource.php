<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Applications;

use JustSteveKing\Sevalla\Client;
use JustSteveKing\Sevalla\Resources\Applications\Payloads\UpdateApplication;
use JustSteveKing\Sevalla\Resources\Applications\Requests\GetListOfApplications;
use JustSteveKing\Sevalla\Resources\Applications\Requests\UpdateBasicDetails;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

final readonly class ApplicationsResource
{
    public function __construct(
        private string $id,
        private Client $connector,
    ) {}

    /**
     * Get a list of applications by Company ID.
     *
     * @see https://api-docs.sevalla.com/tag/Applications
     * @return array<int,Application>
     * @throws FatalRequestException|RequestException
     */
    public function list(): array
    {
        $response =  $this->connector->send(
            request: new GetListOfApplications(
                companyId: $this->id,
            ),
        );

        return $response->dto();
    }

    public function update(UpdateApplication $data): Application
    {
        $response = $this->connector->send(
            request: new UpdateBasicDetails(
                id: $this->id,
                payload: $data,
            ),
        );

        return $response->dto();
    }
}
