<?php

namespace App\Providers;

use App\Model\Expense;
use App\Model\Order;
use App\Model\Saving;
use App\Services\frontend\ExpenseService;
use App\Services\frontend\OrderService;
use App\Services\System\SavingService;
use Illuminate\Support\ServiceProvider;

class HeaderServiceProvider extends ServiceProvider
{
    protected $orderService, $expenseService, $savingService;
    public function register()
    {
        $this->orderService = new OrderService(new Order());
        $this->expenseService = new ExpenseService(new Expense());
        $this->savingService = new SavingService(new Saving());
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('frontend.include.header', function ($view) {
            $data = [
                'orders' => $this->orderService->getIncomes(),
                'expenses' => $this->expenseService->getAllData($view),
                'savings' => $this->savingService->getAllData($view)

            ];
            $view->with($data);
        });
    }
}
