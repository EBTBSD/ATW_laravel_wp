<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class LogController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'domain' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        Log::create($data);

        return response()->json(['ok' => true], 201);
    }

    public function incrementUpdateCount(Request $request){
        $request->validate([
            'domain' => ['required', 'string'],
        ]);

        $log = Log::where('domain', $request->input('domain'))->first();

        if(!$log){
            return response()->json(['message' => 'A Domain nem létezik!'], 404);
        }

        $log->increment('update_count');

        return response()->json([
            'ok' => true,
            'message' => 'Számláló növelve.',
            'current_count' => $log->update_count,
        ]);
    }
}
