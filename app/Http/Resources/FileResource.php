<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'file',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'expiration' => $this->resource->expiration,
                'details' => $this->resource->details,
            ],
            [
                'links' => [
                    'self' => url('/api/v1/file/' . $this->resource->getRouteKey()),
                ]
            ]
        ];
    }
}
