<?php

namespace Soved\Laravel\Ecologi\Jobs;

class PurchaseATree extends PurchaseTrees
{
    public function __construct()
    {
        parent::__construct(quantity: 1);
    }
}
