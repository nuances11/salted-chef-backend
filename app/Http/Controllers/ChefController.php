<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChefController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function show(Chef $chef)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function edit(Chef $chef)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chef $chef)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chef $chef)
    {
        //
    }

    public function getChef($type) { // chef_to_screen or current_chef
        $chefs = Chef::where('chef_type', $type)
                        ->get();
            return response()->json($chefs);
    }

    public function upload(Request $request) {
        $data = [];
        if ($request->has('data')) {
            $chef_data = $request->data;
            foreach ($chef_data as $key => $value) {
                $value = $this->snakeCase($value);
                if(!Chef::where('email',$value['email'])->exists()){
                    Chef::Create($value);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Chef data successfully saved',
        ], 201);
    }

    public function snakeCase(array $array): array
    {
        return array_map(
            function($item) {
                if (is_array($item)) {
                    $item = $this->snakeCase($item);
                }

                return $item;
            },
            $this->doSnakeCase($array)
        );
    }

    private function doSnakeCase(array $array): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $key = strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $key));
            $key = Str::snake($key);

            $result[$key] = $value;
        }

        return $result;
    }
}
