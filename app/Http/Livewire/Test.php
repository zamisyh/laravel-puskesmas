<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Test extends Component
{

    
    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Verified', 'email_verified_at')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }

    // public function render()
    // {
    //     return view('livewire.test')->extends('layouts.app')->section('content');
    // }
}
