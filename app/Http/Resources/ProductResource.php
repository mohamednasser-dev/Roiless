<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'body_ar' => $this->body_ar,
            'body_en' => $this->body_en,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'image_path' => $this->image_path,
            'type' => $this->type,
            'fund_id' => $this->fund_id,
            'seller_id' => $this->seller_id,
            'section' => $this->Section,
            'sub_section' => $this->SubSection,
//            'seller_product_count' => $this->SellerInfo->Products->count(),
            'seller' => $this->SellerInfo->makeHidden('Products'),

        ];
    }
}
