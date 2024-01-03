<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Documentação das API's",
 *      description="Sistema Gerenciamento de Livraria",
 *      @OA\Contact(
 *          name="Everton Sena",
 *          email="evertonsena2009@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * ),
 * @OA\Server(
 *      url="/api",
 *      description="Book store api"
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponser;
}
