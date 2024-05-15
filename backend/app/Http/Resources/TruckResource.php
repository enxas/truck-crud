<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TruckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'unit_number' => $this['unit_number'],
            'year' => $this['year'],
            'notes' => $this['notes'],
			'trucks' => $this['trucks'],
        ];
    }
}
