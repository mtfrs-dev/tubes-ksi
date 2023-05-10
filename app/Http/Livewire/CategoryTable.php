<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;

    protected $listeners = ['deleteCategory'];

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
        return Category::query();
    }

    // CATEGORY UPDATE
    public function showUpdateModal($id)
    {
        $category = Category::find($id);
        $this->dispatchBrowserEvent('showUpdateForm:category', [
            'id' => $id,
            'name' => $category->name,
            'code' => $category->code,
        ]);
    }

    // CATEGORY DELETION
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('delete:category', [
            'id' => $id
        ]);
    }

    public function deleteCategory($id)
    {
        Category::find($id)->delete();
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
