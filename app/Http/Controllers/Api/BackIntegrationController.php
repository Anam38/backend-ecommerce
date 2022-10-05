<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Option\OptionRepositoryInterface;

class BackIntegrationController extends Controller
{
    protected $optionRepo;

    public function __construct(OptionRepositoryInterface $optionRepo)
    {
      $this->optionRepo = $optionRepo;
    }

    public function credentialToken()
    {
      $data = cache_gateway($this->optionRepo)->retrieveCache();
      $data = $data->where('option_key', '_backend_signature')->first();

      return response()->json(resp(true, 200, "get success", $data ));
    }
}
