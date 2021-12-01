<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;

class BbvaWebhook extends BbvaApiResourceBase
{

    protected $url;
    protected $event_types;

    public function save()
    {
        return $this->_update();
    }

    public function delete()
    {
        $this->_delete();
    }

}

?>
