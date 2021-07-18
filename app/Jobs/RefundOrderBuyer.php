<?php

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Models\Pay\Order;
use App\Services\User\Money\Balance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class RefundOrderBuyer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Order
     */
    protected $order;

    /**
     * Create a new job instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @throws \Throwable
     */
    public function handle()
    {
        $order = $this->order;
        DB::transaction(function() use ($order) {
            $balanceService = new Balance($this->order->user);
            $balanceService->refund($this->order->pay_money);
            $order->status = OrderStatus::REFUNDED;
            $order->save();
        });
    }
}
