<?php

namespace BBVA\Resources;

use BBVA\Data\BbvaApiDerivedResource;

class BbvaTokenList extends BbvaApiDerivedResource
{
    public function create($params)
    {
        return $this->add($params);
    }

}
