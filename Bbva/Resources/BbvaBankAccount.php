<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;

class  BbvaBankAccount extends BbvaApiResourceBase
{
    protected $bank_code;
    protected $bank_name;
    protected $creation_date;

    public function delete()
    {
        $this->_delete();
    }
}

?>
