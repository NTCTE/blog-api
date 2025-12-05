<?php

namespace App\Helpers\Structures\Like;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class EnumNameCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $enumClass = $property->type->type->name;

        foreach ($enumClass::cases() as $case) {
            if ($case->name === $value) {
                return $case;
            }
        }

        throw new \ValueError("No enum case '$value' found in enum $enumClass");
    }
}
