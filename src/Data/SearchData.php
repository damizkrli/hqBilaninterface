<?php

namespace App\Data;

use App\Entity\Branche;

class SearchData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var Branche[]
     */
    public $branches = [];
}
