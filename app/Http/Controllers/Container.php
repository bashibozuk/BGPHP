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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data      = request()->all();
        $container = DB::table('containers')->insert(['container_code' => $data['container_code']]);

        /*
        DB::table('history')->insert(
            ['container_id' => $container, 'longitude' => '0', 'latitude' => '0']
        );
        */

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
        if (!ctype_alnum($data['code'])) {
            $response = [
                'status'  => 'ERROR',
                'message' => 'Invalid tracking number'
            ];

            return response()->json($response);
        }

        $container = DB::table('containers')->where('container_code', '=', $data['code'])->get();
        
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
