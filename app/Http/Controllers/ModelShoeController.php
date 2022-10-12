<?php

namespace App\Http\Controllers;

use App\Models\ModelShoe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModelShoeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $modelshoes = ModelShoe::all();

        return response()->json( $modelshoes );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store( Request $request ): JsonResponse {
        $data = $request->all();
        if ( ModelShoe::create( $data ) ):
            return response()->json( [ 'process' => 'success' ] );
        else:
            return response()->json( [ 'process' => 'fail' ] );
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update( Request $request, int $id ): JsonResponse {
        $except = [ 'id' ];
        $data   = $request->except( $except );
        $brand  = ModelShoe::find( $id );
        if ( $brand->update( $data ) ):
            return response()->json( [ 'process' => 'updated' ] );
        else:
            return response()->json( [ 'process' => 'fail' ] );
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy( int $id ): JsonResponse {
        $modelshoe = ModelShoe::find( $id );
        if ( $modelshoe->delete() ):
            return response()->json( [ 'process' => 'deleted' ] );
        else:
            return response()->json( [ 'process' => 'fail' ] );
        endif;
    }
}
