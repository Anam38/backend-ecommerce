<?php

namespace App\Repositories\Option;

use App\DataAccess\Cache\CacheableInterface;

use App\Models\Option;

class OptionRepository implements OptionRepositoryInterface, CacheableInterface
{
    protected $option;

    protected $frontendSignatureKey = '_frontend_signature';
    protected $backendSignatureKey = '_backend_signature';

    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    public function get($key)
    {
        return $this->option->where('option_key', $key)->get();
    }

    public function first($key)
    {
        return $this->option->where('option_key', $key)->first();
    }

    public function getFrontendSignature()
    {
        return $this->first($this->frontendSignatureKey);
    }

    public function createOrUpdateFrontendSignature($value)
    {
        return $this->option->updateOrCreate(
            ['option_key' => $this->frontendSignatureKey],
            ['option_value' => $value]
        );
    }

    public function getBackendSignature()
    {
        return $this->first($this->backendSignatureKey);
    }

    public function createOrUpdateBackendSignature($value)
    {
        return $this->option->updateOrCreate(
            ['option_key' => $this->backendSignatureKey],
            ['option_value' => $value]
        );
    }

    public function toCache()
    {
        return $this->option->all()->toArray();
    }

    public function getKeyName()
    {
        return $this->option->getTable();
    }
}
