<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class TransactionTable extends DataTableComponent
{
    protected $model = Transaction::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSortingEnabled();
        $this->setTableWrapperAttributes([
            'class' => 'custom-scrollbar',
        ]);
    }

    public function builder(): Builder
    {
        return Transaction::query()
            ->with([
                'user'
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(auth()->user()->role != "CUSTOMER"),
            Column::make("Kode", "code")
                ->sortable(),
            Column::make("Tipe Transaksi", "type")
                ->sortable(),
            Column::make("Pembeli/Penyedia", "user.name")
                ->format(
                    fn($value) => view('components.datatable.capitalize')->withValue($value)
                )
                ->sortable()
                ->searchable(),
            Column::make("Total Harga", "total_price")
                ->sortable(),
            Column::make("Invoice", "invoice")
                ->hideIf(auth()->user()->role != "CUSTOMER"),
        ];
    }
}
