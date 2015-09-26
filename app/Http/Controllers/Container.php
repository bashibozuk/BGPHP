<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Container extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = request()->all();

        if (!DB::table('containers')->insert(['container_code' => $data['container_code']])) {
            return response()->json([false]);
        }

        return response()->json([true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = request()->all();
        $code = $data['code'];
        if (!ctype_alnum($code)) {
            $response = [
                'status'  => 'ERROR',
                'message' => 'Invalid tracking number'
            ];

            return response()->json($response);
        }

        return $this->showRecord($code);
    }

    private function showRecord($code)
    {
        $container = DB::table('containers')->where('container_code', '=', $code)->first();
        if (empty($container)) {
            $response = [
                'status'  => 'ERROR',
                'message' => 'No data found'
            ];
        } else {
            $containerHistory = DB::table('history')->select(['longitude', 'latitude'])->where(
                'container_id',
                $container->id
            )->orderBy(
                'created_at',
                'desc'
            )->first();

            $response = [
                'status'  => 'OK',
                'message' => 'Container found',
                'data'    => $containerHistory
            ];
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
