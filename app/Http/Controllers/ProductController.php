<?php

namespace App\Http\Controllers;

use App\Helpers\SavingFile\savingFile;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller {
    protected string $path_storage = 'public/product/';

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $rel     = [ 'relmodelshoe', 'relbrandshoe', 'relcategoryshoe' ];
        $product = Product::with( $rel )->get();

        return response()->json( $product );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store( Request $request ): JsonResponse {
        $picture = '';

        if ( $request->hasFile( 'picture' ) ):
            if ( $this->validate( $request, [ 'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000' ] ) ) :
                $picture = savingFile::saveFile( $request->file( 'picture' ), $this->path_storage );
            else :
                return response()->json( [ 'process' => 'error_picture' ] );
            endif;
        endif;

        $array_size = $request->input( 'size' );

        $data            = $request->all();
        $data['size']    = implode( ",", $array_size );
        $data['picture'] = $picture;

        if ( Product::create( $data ) ):
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
     * @throws ValidationException
     */
    public function update( Request $request, int $id ): JsonResponse {
        $except  = [ 'id' ];
        $picture = '';
        $prod    = Product::find( $id );
        if ( $request->hasFile( 'picture' ) ):
            if ( $this->validate( $request, [ 'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000' ] ) ) :
                $currentPicture = $request->input( 'currentPicture' );
                savingFile::deleteFile( $currentPicture, $this->path_storage );
                $picture = savingFile::saveFile( $request->file( 'picture' ), $this->path_storage );
            else :
                return response()->json( [ 'process' => 'error_picture' ] );
            endif;
        endif;

        $data            = $request->except( $except );
        $data['size']    = json_encode( $request->input( 'size' ) );
        $data['picture'] = $picture;

        if ( $prod->update( $data ) ):

            return response()->json( [ 'process' => 'updated' ], 200 );
        else:
            savingFile::deleteFile( $picture, $this->path_storage );

            return response()->json( [ 'process' => 'fail' ], 404 );
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
        $prod = Product::find( $id );
        if ( $prod->delete() ):
            //BORRAMOS LOS TAMAÑOS
            $prod->relproductsize()->detach();
            savingFile::deleteFile( $prod->picture, $this->path_storage );

            return response()->json( [ 'process' => 'deleted' ], 200 );
        else:
            return response()->json( [ 'process' => 'fail' ], 404 );
        endif;
    }

    public function getByCategory( int $id ): JsonResponse {
        $rel     = [ 'relmodelshoe', 'relbrandshoe', 'relcategoryshoe' ];
        $product = Product::with( $rel )->where( 'category_id', $id )->get();

        return response()->json( $product );
    }
}
