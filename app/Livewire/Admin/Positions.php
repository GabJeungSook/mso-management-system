<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Position;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Positions extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Position::query())
            ->columns([
                TextColumn::make('name')->searchable()->label('POSITION NAME'),
                TextColumn::make('number_of_members')->label('NUMBER OF MEMBERS'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                ->label('Update Position')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'name' => $record->name,
                        'number_of_members' => $record->number_of_members,
                    ];
                })
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('number_of_members')
                        ->required()
                        ->numeric()
                ]),
            ])
            ->headerActions([
                CreateAction::make('add_position')
                ->label('Add New Position')
                ->modalHeading('Add New Position')
                ->icon('heroicon-o-plus-circle')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('number_of_members')
                        ->required()
                        ->numeric()
                        ->default(1)
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.positions');
    }
}
