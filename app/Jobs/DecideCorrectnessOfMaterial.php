<?php

namespace App\Jobs;

use App\Models\Material\Material;
use App\Services\Material\HandleDecideCorrectness;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DecideCorrectnessOfMaterial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Material
     */
    protected $material;

    /**
     * Create a new job instance.
     *
     * @param Material $material
     */
    public function __construct(Material $material)
    {
        $this->material = $material;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $decideCorrectness = new HandleDecideCorrectness($this->material);
        return $decideCorrectness->index();
    }

}
