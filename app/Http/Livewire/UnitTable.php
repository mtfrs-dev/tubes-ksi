<?php

namespace App\Http\Livewire;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class UnitTable extends DataTableComponent
{
    protected $model = Unit::class;

    protected $listeners = ['deleteUnit'];

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
        return Unit::query();
    }

    // UNIT UPDATE
    public function showUpdateModal($id)
    {
        $unit = Unit::find($id);
        $this->dispatchBrowserEvent('showUpdateForm:unit', [
            'id' => $id,
            'name' => $unit->name,
            'code' => $unit->code,
        ]);
    }

    // UNIT DELETION
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('delete:unit', [
            'id' => $id
        ]);
    }

    public function deleteUnit($id)
    {
        Unit::find($id)->delete();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(auth()->user()->role != "CUSTOMER"),
            Column::make("Nama", "name")
                ->sortable(),
            Column::make("Kode", "code")
                ->sortable(),
            Column::make("Aksi", "id")
                ->format(
                    fn($value) => view('components.datatable.simple-actions')->withValue($value)
                )
                ->hideIf(auth()->user()->role != "ADMIN"),
        ];
    }
}
