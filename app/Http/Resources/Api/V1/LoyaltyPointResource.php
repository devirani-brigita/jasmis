<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\{
    Http\Resources\Json\JsonResource,
    Http\Request,
    Http\Response
};
use App\Api\{
    User,
    LoyaltyLevel,
    LoyaltyLevelLang
};
use FileHelper;
use Common;

class LoyaltyPointResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {        
        
        return [
            'user_key' => $this->user_key, 
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,           
            'card_number' => ($this->card_number !== null) ? $this->card_number : 0,
            'loyalty_points' => ($this->loyalty_points !== null) ? (int)$this->loyalty_points : 0,
            'loyalty_level_name' => $this->when(true,function() {
                $loyalty_level = LoyaltyLevel::where('from_point','<=',(int)$this->loyalty_points)->where('to_point','>=',(int)$this->loyalty_points);
                LoyaltyLevelLang::selectTranslation($loyalty_level);
                $loyalty_level = $loyalty_level->first();
                if($loyalty_level === null) {
                    $loyalty_level = LoyaltyLevel::select('loyalty_level_name');
                    LoyaltyLevelLang::selectTranslation($loyalty_level);
                    $loyalty_level = $loyalty_level->orderBy(LoyaltyLevel::tableName().'.loyalty_level_id','asc')->first();
                }
                return ($loyalty_level === null) ? '' : $loyalty_level->loyalty_level_name;
            }),  
            'card_image' => $this->when(true,function() {
                $result = LoyaltyLevel::select('card_image')->where('from_point','<=',(int)$this->loyalty_points)->where('to_point','>=',(int)$this->loyalty_points)->first();                
                if($result === null) {
                    $result = LoyaltyLevel::select('card_image')->orderBy('loyalty_level_id','asc')->first();                  
                }                
                return  FileHelper::loadImage( ($result === null) ? '' :  $result->card_image );
            }), 
        ];
    }
    
    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function  with($request)
    {
        return [
            'status' => Response::HTTP_OK,
            'time' => strtotime(date('Y-m-d H:i:s')),
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->header('X-Value', 'kjh');
    }
    
}
