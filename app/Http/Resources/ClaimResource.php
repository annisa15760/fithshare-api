<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaimResource extends JsonResource
{
    protected $message;

    public function __construct($resource, $message = 'Data klaim berhasil diproses')
    {
        parent::__construct($resource);
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'cloth_id' => $this->cloth_id,
            'status' => $this->status,
            'cloth' => new ClothResource($this->whenLoaded('cloth')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function with(Request $request): array
    {
        return [
            'message' => $this->message,
        ];
    }
}