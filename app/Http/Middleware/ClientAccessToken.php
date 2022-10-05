<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Repositories\Option\OptionRepositoryInterface;

class ClientAccessToken
{

    protected $optionRepo;

    public function __construct(OptionRepositoryInterface $optionRepo)
    {
      $this->optionRepo = $optionRepo;
    }

    public function handle(Request $request, Closure $next)
    {
      if($request->isJson() || isset($request->token)){
        if (isset($request->token)) {

          $data = cache_gateway($this->optionRepo)->retrieveCache();
          $data = $data->where('option_key', '_frontend_signature')->first();

          if ($request->token == $data['option_value']) {
            return $next($request);
          }

          return response()->json(resp(false, 401, "unauthenticated"));
        }
      }
      return redirect('/');
    }
}
