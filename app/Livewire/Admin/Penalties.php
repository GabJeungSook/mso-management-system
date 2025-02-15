<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Penalty;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Penalties extends Component implements HasForms, HasTable 
{
    
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Penalty::query())
            ->columns([
                TextColumn::make('event.name')->label('EVENT NAME'),
                TextColumn::make('event.type')->label('EVENT TYPE'),
                TextColumn::make('member.fullName')->searchable()->label('MEMBER NAME'),
                TextColumn::make('amount')->label('AMOUNT'),
                IconColumn::make('is_paid')
                ->label('IS PAID')
                ->boolean()

            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('pay')
                ->label('Mark as Paid')
                ->color('success')
                ->button()
                ->requiresConfirmation()
                ->action(function (Penalty $record) {
                    $record->is_paid = 1;
                    $record->save();

                    Notification::make()
                    ->success()
                    ->title('Success')
                    ->body('Member penalty is paid')
                    ->send();

                })->visible(fn (Penalty $record) => !$record->is_paid),
            ])
            ->headerActions([
                // CreateAction::make('add_position')
                // ->label('Add New Position')
                // ->modalHeading('Add New Position')
                // ->icon('heroicon-o-plus-circle')
                // ->form([
                //     TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //     TextInput::make('number_of_members')
                //         ->required()
                //         ->numeric()
                //         ->default(1)
                // ])
            ])
            ->bulkActions([
                // ...
            ]);
    }


    public function render()
    {
        return view('livewire.admin.penalties');
    }
}
