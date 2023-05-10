<?php

namespace App\Http\Livewire;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class MedicineTable extends DataTableComponent
{
    protected $model = Medicine::class;

    protected $listeners = ['deleteMedicine'];

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
        return Medicine::query()
            ->with([
                'unit'
            ]);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Kategori')
                ->options(
                    array_merge(
                        ["" => "Semua"],
                        Category::all()->pluck('name', 'name')->toArray(),
                        ["Uncategorized" => "Tanpa Kategori"],
                    )
                )
                ->filter(function(Builder $builder, string $value) {
                    if($value != "Uncategorized") {
                        $builder->whereHas('categories', function($query) use ($value) {
                            $query->where('name', 'like', '%' . $value . '%');
                        });
                    } else {
                        $builder->whereDoesntHave('categories');
                    }
                }),
            SelectFilter::make('Satuan')
                ->options(
                    array_merge(
                        ["" => "Semua"],
                        Unit::all()->pluck('name', 'name')->toArray()
                    )
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->whereHas('unit', function($query) use ($value) {
                        $query->where('name', $value);
                    });
                }),
            NumberFilter::make('Harga Beli (dari)')
                ->config([
                    'min' => Medicine::min('buy_price'),
                    'max' => Medicine::max('buy_price')
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('buy_price', '>=', $value);
                }),
            NumberFilter::make('Harga Beli (sampai)')
                ->config([
                    'min' => Medicine::min('buy_price'),
                    'max' => Medicine::max('buy_price')
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('buy_price', '<=', $value);
                }),
            NumberFilter::make('Harga Jual (dari)')
                ->config([
                    'min' => Medicine::min('sell_price'),
                    'max' => Medicine::max('sell_price')
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('sell_price', '>=', $value);
                }),
            NumberFilter::make('Harga Jual (sampai)')
                ->config([
                    'min' => Medicine::min('sell_price'),
                    'max' => Medicine::max('sell_price')
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('sell_price', '<=', $value);
                }),
        ];
    }
    
    // MEDICINE DETAIL
    public function showDetailModal($id)
    {
        $medicine = Medicine::find($id);
        $this->dispatchBrowserEvent('showDetail:medicine', [
            'name' => $medicine->name,
            'code' => $medicine->code,
            'categories' => $medicine->categories,
            'qr_code' => $medicine->qr_code,
            'buy_price' => $medicine->buy_price,
            'sell_price' => $medicine->sell_price,
            'quantity' => $medicine->quantity,
            'unit' => $medicine->unit->name,
            'description' => $medicine->description,
        ]);
    }

    // MEDICINE UPDATE
    public function showUpdateModal($id)
    {
        $medicine = Medicine::find($id);
        $this->dispatchBrowserEvent('showUpdateForm:medicine', [
            'id' => $id,
            'name' => $medicine->name,
            'code' => $medicine->code,
            'categories' => $medicine->categories,
            'qr_code' => $medicine->qr_code,
            'buy_price' => $medicine->buy_price,
            'sell_price' => $medicine->sell_price,
            'quantity' => $medicine->quantity,
            'unit_id' => $medicine->unit_id,
            'description' => $medicine->description,
        ]);
    }

    // MEDICINE DELETION
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('delete:medicine', [
            'id' => $id
        ]);
    }

    public function deleteMedicine($id)
    {
        Medicine::find($id)->delete();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(auth()->user()->role != "CUSTOMER"),
            Column::make("Nama", "name")
                ->format(
                    fn($value) => view('components.datatable.capitalize')->withValue($value)
                )
                ->sortable()
                ->searchable(),
            Column::make("Kode", "code")
                ->format(
                    fn($value) => view('components.datatable.uppercase')->withValue($value)
                )
                ->sortable()
                ->searchable(),
            Column::make("Kategori")
                ->label(
                    function ($row) {
                        return view('components.datatable.medicine-categories', ['categories' => $row->categories]);
                    }
                )
                ->collapseOnTablet(),
            Column::make("Harga Beli", "buy_price")
                ->format(
                    fn($value) => view('components.datatable.price')->withValue($value)
                )
                ->sortable(),
            Column::make("Harga Jual", "sell_price")
                ->format(
                    fn($value) => view('components.datatable.price')->withValue($value)
                )
                ->sortable(),
            Column::make("Jumlah", "quantity")
                ->format(
                    fn($value) => view('components.datatable.quantity')->withValue($value)
                )
                ->sortable(),
            Column::make("Satuan", "unit.name")
                ->format(
                    fn($value) => view('components.datatable.capitalize')->withValue($value)
                )
                ->sortable()
                ->searchable(),
            Column::make("Aksi", "id")
                ->format(
                    fn($value) => view('components.datatable.actions')->withValue($value)
                )
                ->hideIf(auth()->user()->role != "ADMIN"),
        ];
    }
}
