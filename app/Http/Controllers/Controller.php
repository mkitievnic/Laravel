<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function make_exception($e)
    {
        return response()->json([
            'success' => false,
            "message" => "Ha ocurrido un error! Vuelva a intentarlo o comuníquese con el administrador",
            'e' => $e->getMessage()]);
    }

}
