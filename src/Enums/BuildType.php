<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Enums;

enum BuildType: string
{
    case Docker = 'dockerfile';
    case Pack = 'pack';
    case Nix = 'nixpacks';
}
