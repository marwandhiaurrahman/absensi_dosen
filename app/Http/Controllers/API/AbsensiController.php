<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResorces;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;

class AbsensiController extends BaseController
{
    public function dashboard()
    {
        $user = User::find(1);

        if (is_null($user)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new UserResorces($user), 'Product retrieved successfully.');
    }
}
