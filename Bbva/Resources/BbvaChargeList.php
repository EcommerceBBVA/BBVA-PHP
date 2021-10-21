<?php

namespace BBVA\Resources;

class BbvaChargeList extends BbvaApiDerivedResource
{
    public function create($params)
    {
        return $this->add($params);
    }
}
