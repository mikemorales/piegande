<?php

namespace App\Http\Controllers;

use App\Models\SizeProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SizeProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $size = SizeProduct::all();

        return response()->json( $size );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store( Request $request ): JsonResponse {
        //
        $data = $request->all();
        if ( SizeProduct::create( $data ) ):
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
        //
        $except = [ 'id' ];
        $data   = $request->except( $except );
        $size   = SizeProduct::find( $id );
        if ( $size->update( $data ) ):
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
        //
        $size = SizeProduct::find( $id );
        if ( $size->delete() ):
            return response()->json( [ 'process' => 'deleted' ] );
        else:
            return response()->json( [ 'process' => 'fail' ] );
        endif;
    }
}
