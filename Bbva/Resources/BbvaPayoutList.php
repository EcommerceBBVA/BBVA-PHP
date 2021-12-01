<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiDerivedResource;

class BbvaPayoutList extends BbvaApiDerivedResource
{
    public function create($params)
    {
        return $this->add($params);
    }
}
