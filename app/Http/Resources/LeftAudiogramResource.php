<?php

namespace App\Http\Resources;

use App\Models\LeftInterpretasi;
use Illuminate\Http\Resources\Json\JsonResource;

class LeftAudiogramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //Left Interpretasi, Left Low
        $li_ll = LeftInterpretasi::where('left_id', $this->id)->first()->l_low;
        if($li_ll == 'R'){
            $l_low = 1;
        }
        if($li_ll == 'N'){
            $l_low = 2;
        }
        if($li_ll == 'T'){
            $l_low = 3;
        }
        //Left Interpretasi, Left High
        $li_lh = LeftInterpretasi::where('left_id', $this->id)->first()->l_high;
        $l_high = $li_lh === 'R' ? 1 : ($li_lh === 'N' ? 2 : ($li_lh === 'T' ? 3:null));
        
        return [
            'id' => $this->id,
            'l_lowi' => $l_low,
            'l_highi' => $l_high
        ];
    }
}
