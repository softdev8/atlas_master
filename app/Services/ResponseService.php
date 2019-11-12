<?php

namespace App\Services;

class ResponseService //extends TransformerAbstract
{
    /**
     * Response structure
     *
     * @param $input
     * @return array
     */
    public static function output($input)
    {
        if(isset($input['errors'])){
            if(isset($input['data'])){
                $data = $input['data'];
            } else {
                $data = null;
            }

            return [
                'success'   => false,
                'errors'    => $input['errors'],
                'data'      => $data
            ];
        }
        if(isset($input['data'])){
            return [
                'success'   => true,
                'errors'    => null,
                'data'      => $input['data']
            ];
        }

        if(!isset($input['errors']) AND !isset($input['data'])){
            return [
                'success'   => $input,
                'errors'    => null,
                'data'      => null,
            ];
        }
    }

    /**
     *  Examples
     */
     //   return response()->json(ResponseService::output([
     //   'data'      => [ 'candidates' => Candidate::paginate(5), 'company' =>  FilterType::all() ]
     //   ]), 200);
     //
     //   return response()->json(ResponseService::output([
     //   'errors'    => ['deactivated' => ['User deactivated']]
     //   ]), 400);


}