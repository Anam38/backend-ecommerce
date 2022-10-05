<?php

namespace App\Repositories\Option;

interface OptionRepositoryInterface
{
    public function get($key);
    public function first($key);

    public function getFrontendSignature();
    public function getBackendSignature();

    public function createOrUpdateFrontendSignature($value);
    public function createOrUpdateBackendSignature($value);
}
