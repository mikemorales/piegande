<?php

namespace App\Helpers\SavingFile;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class savingFile {
    public static function saveFile( $file, $path_storage ): string {
        $name = '';

        if ( $file->getSize() > 0 ):

            $exp = explode( ".", $file->getClientOriginalName() );
            $ext = $file->getClientOriginalExtension();

            if ( count( $exp ) === 2 && $exp[1] == $ext ):
                $name = time() . '-' . self::clearNamePic( $file->getClientOriginalName() );
                Storage::disk( 'local' )->put( $path_storage . $name, file_get_contents( $file ) );
            endif;
        endif;

        return $name;
    }

    public static function deleteFile( $file, $path_storage ): JsonResponse {
        if ( $file != '' && Storage::disk( 'local' )->exists( $path_storage . $file ) ):
            Storage::disk( 'local' )->delete( $path_storage . $file );

            return response()->json( [ 'process' => 'success' ], 200 );
        else:
            return response()->json( [ 'process' => 'fail' ], 200 );
        endif;
    }

    public static function clearNamePic( $url ): array|string {

        $string = strtolower( trim( $url ) );

        $string = str_replace(
            array( 'á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä' ),
            array( 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A' ),
            $string
        );

        $string = str_replace(
            array( 'é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë' ),
            array( 'e', 'e', 'e', 'e', 'E', 'E', 'E', 'E' ),
            $string
        );

        $string = str_replace(
            array( 'í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î' ),
            array( 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I' ),
            $string
        );

        $string = str_replace(
            array( 'ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô' ),
            array( 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O' ),
            $string
        );

        $string = str_replace(
            array( 'ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü' ),
            array( 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U' ),
            $string
        );

        $string = str_replace(
            array( 'ñ', 'Ñ', 'ç', 'Ç' ),
            array( 'n', 'N', 'c', 'C', ),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array( "\\", "¨", "º", "_", "~", "#", "@", "|", "!", "\"", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ",", ":", " " ), '-', $string );


        return $string;
    }
}
