<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiDerivedResource;

class BbvaPseList extends BbvaApiDerivedResource
{

    public function create($params)
    {
        return $this->add($params);
    }

}
