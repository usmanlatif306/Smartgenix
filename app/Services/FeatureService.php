<?php

namespace App\Services;

use App\Models\Feature;

class FeatureService
{

    public function features($take = null, $page = 'website')
    {
        $indipendent_features = Feature::select(['title', 'description'])->whereType('individual')->when(isset($take), fn ($q) => $q->take($take))->get();
        $recovery_features = Feature::select(['title', 'description'])->whereType('recovery')->when(isset($take), fn ($q) => $q->take($take))->get();
        $enterprise_features = Feature::select(['title', 'description'])->whereType('enterprise')->when(isset($take), fn ($q) => $q->take($take))->get();

        return [
            [
                'name' => $page === 'website'  ? trans('general.independent_garage') : trans('general.independent'),
                'route' => 'independent',
                'features' => $indipendent_features,
            ],
            [
                'name' => $page === 'website' ? trans('general.recovery_companies') : trans('general.recovery'),
                'route' => 'recovery',
                'features' => $recovery_features,
            ],
            [
                'name' => 'Enterprise',
                'route' => 'enterprise',
                'features' => $enterprise_features,
            ],
        ];
    }
}
