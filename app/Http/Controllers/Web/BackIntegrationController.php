<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Database\OauthClientRepositories;

use App\Repositories\Option\OptionRepositoryInterface;

class BackIntegrationController extends Controller
{
    protected $optionRepo;
    protected $clientRepositories;

    public function __construct(OptionRepositoryInterface $optionRepo)
    {
      $this->optionRepo = $optionRepo;
      $this->OauthclientRepositories = new OauthClientRepositories;
    }

    public function get()
    {
      $data = $this->OauthclientRepositories->get();
      $clientCredential = $data->where('name','client')->first();
      $clientPassword = $data->where('provider','client')->first();

      $data = [
        'clients' => $clientCredential,
        'password' => $clientPassword,
      ];

      return response()->json(resp(true, 200, "get success", $data ));
    }

    public function generateSignatureToken(Request $request)
    {
      if(isset($request->access_token)){
        $storeToken = $this->optionRepo->createOrUpdateBackendSignature($request->access_token);

        cache_gateway($this->optionRepo)->cached();

        $data = [
            'token' => $storeToken->option_value
        ];

        return response()->json(resp(true, 200, "Post Token success", $data ));
      }else {
        return response()->json(resp(false, 200, "Post Token failed", [] ));
      }
    }
}
