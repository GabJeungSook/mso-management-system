<?php

namespace App\Livewire\Admin;

use App\Models\Expense;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Expenses extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Expense::query())
            ->columns([
                TextColumn::make('event.type')->searchable()->label('EVENT/ACTIVITY/MEETING'),
                TextColumn::make('event.name')->label('NAME'),
                TextColumn::make('amount')
                ->label('EXPENSES')
                ->formatStateUsing(fn ($state) => '₱' . number_format($state, 2))
                ->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([

            ])
            ->headerActions([

            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.admin.expenses');
    }
}
