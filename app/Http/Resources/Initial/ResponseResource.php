<?php

namespace App\Http\Resources\Initial;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    protected $errors   = null;
    protected $success  = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(!isset($this['errors']) AND !isset($this['success'])){

            return parent::toArray($request);

        }
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        if(isset($this['errors'])){
            $this->errors = $this['errors'];
            $this->success = false;
        }

        elseif (isset($this['success'])){
            $this->errors = false;
            $this->success = true;
        }

        return [
            'success'   => $this->success,
            'errors'    => $this->errors
        ];
    }

    /*
         return new ResponseResource([
            'errors'    => ['deactivated' => ['User deactivated'], 'not_active' => ['User not_active']]
         ]);

        return new ResponseResource([
            'filters'   => $filter,
            'firms'     => $firms,
        ]);
    */
}
