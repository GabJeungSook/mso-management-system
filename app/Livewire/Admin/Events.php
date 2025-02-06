<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Date;

class Events extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Event::query())
            ->columns([
                TextColumn::make('type')->searchable()->label('TYPE'),
                TextColumn::make('name')->label('NAME'),
                TextColumn::make('event_date')->date()->label('EVENT DATE'),
                ToggleColumn::make('is_active')->label('STATUS')
                ->beforeStateUpdated(function ($record, $state) {
                    $active = Event::where('is_active', true)->exists();
                    if($record->is_active)
                    {
                        $record->update(['is_active' => false]);
                    }else{
                        if($active)
                        {
                            Notification::make()
                            ->title('Oops')
                            ->body('You can only activate one (1) event at a time.')
                            ->warning()
                            ->send();
                        } else {
                            $record->is_active == false ? $record->update(['is_active' => true]) : $record->update(['is_active' => false]);
                        }
                    }
                })->afterStateUpdated(function ($record, $state) {
                    if($record->is_active)
                    {
                        Event::where('id', '!=', $record->id)->update(['is_active' => false]);
                    }
                }),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                ->label('Edit Event')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'type' => $record->type,
                        'name' => $record->name,
                        'event_date' => $record->event_date,
                    ];
                })
                ->form([
                    Select::make('type')
                        ->required()
                        ->options([
                            'Event' => 'Event',
                            'Activity' => 'Activity',
                            'Meeting' => 'Meeting',
                        ]),
                    TextInput::make('name')
                        ->required(),
                    DatePicker::make('event_date')
                        ->required()
                        ->native(false)
                        ->default(Date::now()->format('Y-m-d')),
                ]),
            ])
            ->headerActions([
                CreateAction::make('add_event')
                ->label('Add New Event')
                ->modalHeading('Add New Event')
                ->icon('heroicon-o-plus-circle')
                ->form([
                    Select::make('type')
                        ->required()
                        ->options([
                            'Event' => 'Event',
                            'Activity' => 'Activity',
                            'Meeting' => 'Meeting',
                        ]),
                    TextInput::make('name')
                        ->required(),
                    DatePicker::make('event_date')
                        ->required()
                        ->native(false)
                        ->default(Date::now()->format('Y-m-d')),
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }


    public function render()
    {
        return view('livewire.admin.events');
    }
}
