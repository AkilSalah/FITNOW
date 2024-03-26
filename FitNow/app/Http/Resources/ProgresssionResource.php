<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgresssionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'mensurations' => [
                'poids' => $this->poids,
                'Mollet' => $this->Mollet,
                'Bras' => $this->Bras,
                'Poitrine' => $this->Poitrine,
                'Hauteur' => $this->Hauteur,
            ],
            'performances' => [
                'TempsDeCourse' => $this->TempsDeCourse,
                'PoidsLeve' => $this->PoidsLeve,
            ],
            'status' => (string) $this->status,

            'relationShips' => [
                'id' => $this->user->id,
                'user name' => $this->user->name,
            ],
        ];
    }
}
