<?php

namespace App\Events;

use App\Models\Material\Material;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DecidedCorrectnessOfMaterial
{
    use Dispatchable, SerializesModels;

    /**
     * @var Material
     */
    public $material;

    /**
     * Create a new event instance.
     *
     * @param Material $material
     */
    public function __construct(Material $material)
    {
        $this->material = $material;
    }
}
