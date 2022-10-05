<?php

namespace App\DataAccess\Cache;

interface CacheableInterface
{
    public function toCache();
    public function getKeyName();
}
