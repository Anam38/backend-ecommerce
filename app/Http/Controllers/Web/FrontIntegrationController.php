<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Option\OptionRepositoryInterface;

class FrontIntegrationController extends Controller
{
    protected $optionRepo;

    public function __construct(OptionRepositoryInterface $optionRepo)
    {
        $this->optionRepo = $optionRepo;
    }

    public function getSignatureToken()
    {
      $data = $this->optionRepo->getFrontendSignature();
      
      return response()->json(resp(true, 200, "get success", $data ));
    }

    public function generateSignatureToken()
    {
      $signatureToken = md5(date('Ymdhis'));
      $storeToken = $this->optionRepo->createOrUpdateFrontendSignature($signatureToken);

      cache_gateway($this->optionRepo)->cached();

      $data = [
          'token' => $storeToken->option_value
      ];

      return response()->json(resp(true, 200, "Generate success", $data ));
    }
}
