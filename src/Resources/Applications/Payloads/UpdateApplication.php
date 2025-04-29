<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Applications\Payloads;

use JustSteveKing\Sevalla\Enums\BuildType;

final class UpdateApplication
{
    public function __construct(
        public string $build_path,
        public BuildType $build_type,
        public string $docker_file_path,
        public string $docker_context,
        public string $display_name,
        public bool $auto_deploy,
        public string $default_branch,
    ) {}

    /**
     * @param array{
     *     build_path:string,
     *     build_type:BuildType,
     *     docker_file_path:string,
     *     docker_context:string,
     *     display_name:string,
     *     auto_deploy:bool,
     *     default_branch:string,
     * } $data
     * @return UpdateApplication
     */
    public static function make(array $data): UpdateApplication
    {
        return new UpdateApplication(
            build_path: $data['build_path'],
            build_type: $data['build_type'],
            docker_file_path: $data['docker_file_path'],
            docker_context: $data['docker_context'],
            display_name: $data['display_name'],
            auto_deploy: $data['auto_deploy'],
            default_branch: $data['default_branch'],
        );
    }
}
