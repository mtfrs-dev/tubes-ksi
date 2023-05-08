<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Medicine;

class MedicineTable extends DataTableComponent
{
    protected $model = Medicine::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Code", "code")
                ->sortable(),
            Column::make("Qr code", "qr_code")
                ->sortable(),
            Column::make("Buy price", "buy_price")
                ->sortable(),
            Column::make("Sell price", "sell_price")
                ->sortable(),
            Column::make("Quantity", "quantity")
                ->sortable(),
            Column::make("Unit", "unit")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
