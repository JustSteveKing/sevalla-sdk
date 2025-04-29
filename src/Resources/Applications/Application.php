<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Applications;

use JustSteveKing\Sevalla\Enums\BuildType;

final readonly class Application
{
    public function __construct(
        public string $id,
        public string $name,
        public string $display_name,
        public string $status,
        public string|null $build_path = null,
        public BuildType|null $build_type = null,
        public string|null $docker_file_path = null,
        public string|null $docker_context = null,
        public string|null $default_branch = null,
        public bool|null $auto_deploy = null,
    ) {}
}
