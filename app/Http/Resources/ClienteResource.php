<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cli_id' => $this->cli_id,
            'cli_nom' => $this->cli_nom,
            'cli_ape' => $this->cli_ape,
            'cli_tel' => $this->cli_tel,
            'cli_ema' => $this->cli_ema,
            'cli_dir' => $this->cli_dir,
            'cli_sex' => $this->cli_sex,
            'created_at' => $this->created_at ?? null,
            'updated_at' => $this->updated_at ?? null,
        ];
    }
}
