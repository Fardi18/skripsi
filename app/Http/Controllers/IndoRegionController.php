<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class IndoRegionController extends Controller
{
    public function province()
    {
        $data = Province::where('name', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }

    public function regency($id)
    {
        $data = Regency::where('province_id', $id)->where('name', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }
}
