<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class IndonesiaController extends Controller
{
    public function regency(Request $request) {
        $regencies = Regency::where('name', 'LIKE', '%'.$request->q.'%')->paginate(10);

        return response()->json($regencies, 200);
    }
}
