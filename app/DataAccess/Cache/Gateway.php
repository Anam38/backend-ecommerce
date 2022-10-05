<?php

namespace App\DataAccess\Cache;

use Illuminate\Support\Facades\Cache;

class Gateway
{
    protected $repository;

    public function __construct(CacheableInterface $repository)
    {
        $this->repository = $repository;
    }

    public function cached()
    {
        Cache::store('redis_ecommerce_backend')->put($this->repository->getKeyName(), collect($this->repository->toCache()));
    }

    public function retrieveCache()
    {
        return Cache::store('redis_ecommerce_backend')->get($this->repository->getKeyName()) ?? collect();
    }
}
