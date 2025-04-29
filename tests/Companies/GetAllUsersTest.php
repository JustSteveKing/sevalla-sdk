<?php

declare(strict_types=1);

use JustSteveKing\Sevalla\Client;
use JustSteveKing\Sevalla\Resources\Companies\Requests\GetCompanyUsers;
use JustSteveKing\Sevalla\Resources\Companies\User;

describe('it can get all users from a specific company', function (): void {
    test('it can build the endpoint correctly')
        ->expect(new GetCompanyUsers(
            companyId: '1234',
        )->resolveEndpoint())
        ->toEqual('/company/1234/users');

    test('it can create an array of DTOs from the response', function (): void {
        $connector = new Client(
            token: '1234',
        );

        $connector->withMockClient(mockClient([
            GetCompanyUsers::class => fakeResponse('company/users'),
        ]));


        $response = $connector->companies(
            id: '1234',
        )->users();

        expect($response)->toBeArray()->each->toBeInstanceOf(User::class);
    });
});
