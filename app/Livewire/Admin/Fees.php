<?php

namespace App\Livewire\Admin;

use App\Models\Fee;
use Filament\Forms\Get;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Fees extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Fee::query())
            ->columns([
                TextColumn::make('event.type')->searchable()->label('EVENT/ACTIVITY/MEETING'),
                TextColumn::make('event.name')->label('NAME'),
                TextColumn::make('reg_fee')
                ->label('REGISTRATION FEE')
                ->formatStateUsing(fn ($state) => '₱' . number_format($state, 2))
                ->searchable(),
                TextColumn::make('penalty_fee')
                ->label('PENALTY FEE')
                ->formatStateUsing(fn ($state) => '₱' . number_format($state, 2))
                ->searchable(),
                TextColumn::make('expensesRelation')
                ->label('EXPENSES')
                ->bulleted()
                ->formatStateUsing(fn ($state) => $state->description. ' - ₱ ' . number_format($state->amount, 2))
                ->searchable(),
                TextColumn::make('expenseTotal')
                ->formatStateUsing(fn ($state) => '₱ ' . number_format($state, 2)),
                // TextColumn::make('total_amount')->sum([
                //     'expensesRelation' => fn(Builder $query) => $query->whereNotNull('amount'),
                // ], 'amount')
                //     ->default(0)
                //     ->label('Payments')
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                ->label('Edit Fees')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                    'event_id' => $record->event_id,
                    'has_reg_fee' => $record->has_reg_fee,
                    'reg_fee' => $record->reg_fee,
                    'has_penalty_fee' => $record->has_penalty_fee,
                    'penalty_fee' => $record->penalty_fee,
                    ];
                })
                ->form([
                    Select::make('event_id')
                    ->required()
                    ->relationship('event', 'name'),
                Radio::make('has_reg_fee')
                    ->label('Does this event have a registration fee?')
                    ->boolean()
                    ->inline()
                    ->default(false)
                    ->live(),
                TextInput::make('reg_fee')
                    ->label('Registration Fee')
                    ->prefix('₱')
                    ->numeric()
                    ->required()->visible(fn (Get $get) => $get('has_reg_fee')),
                Radio::make('has_penalty_fee')
                    ->label('Does this event have a penalty fee?')
                    ->boolean()
                    ->inline()
                    ->default(false)
                    ->live(),
                TextInput::make('penalty_fee')
                    ->label('Penalty Fee')
                    ->prefix('₱')
                    ->numeric()
                    ->required()->visible(fn (Get $get) => $get('has_penalty_fee')),
                // Radio::make('has_expenses')
                //     ->label('Does this event have expenses?')
                //     ->boolean()
                //     ->inline()
                //     ->default(false)
                //     ->live(),
                // TextInput::make('expenses')
                //     ->label('Expenses')
                //     ->prefix('₱')
                //     ->numeric()
                //     ->required()->visible(fn (Get $get) => $get('has_expenses')),
                ]),
                EditAction::make('add_expenses')
                ->label('Add Expenses')
                ->color('primary')
                ->button()
                ->icon('heroicon-o-plus-circle')
                ->form([
                    Repeater::make('expensesRelation')
                    ->relationship('expenses')
                    ->schema([
                        Textarea::make('description')->required(),
                        TextInput::make('amount')
                        ->prefix('₱')
                        ->numeric()
                        ->required(),
                    ])
                ]),
            ])
            ->headerActions([
                CreateAction::make('add_fee')
                ->label('Add New Fee')
                ->modalHeading('Add New Fee')
                ->icon('heroicon-o-plus-circle')
                ->form([
                    Select::make('event_id')
                        ->required()
                        ->relationship('event', 'name'),
                    Radio::make('has_reg_fee')
                        ->label('Does this event have a registration fee?')
                        ->boolean()
                        ->inline()
                        ->default(false)
                        ->live(),
                    TextInput::make('reg_fee')
                        ->label('Registration Fee')
                        ->prefix('₱')
                        ->numeric()
                        ->required()->visible(fn (Get $get) => $get('has_reg_fee')),
                    Radio::make('has_penalty_fee')
                        ->label('Does this event have a penalty fee?')
                        ->boolean()
                        ->inline()
                        ->default(false)
                        ->live(),
                    TextInput::make('penalty_fee')
                        ->label('Penalty Fee')
                        ->prefix('₱')
                        ->numeric()
                        ->required()->visible(fn (Get $get) => $get('has_penalty_fee')),
                    // Radio::make('has_expenses')
                    //     ->label('Does this event have expenses?')
                    //     ->boolean()
                    //     ->inline()
                    //     ->default(false)
                    //     ->live(),
                    //     TextInput::make('expenses')
                    //     ->label('Expenses')
                    //     ->prefix('₱')
                    //     ->numeric()
                    //     ->required()->visible(fn (Get $get) => $get('has_expenses')),
                        // DatePicker::make('event_date')
                        //     ->required()
                        //     ->native(false)
                        //     ->default(Date::now()->format('Y-m-d')),
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.fees');
    }
}
