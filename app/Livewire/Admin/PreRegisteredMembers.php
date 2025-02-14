<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\Registration;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class PreRegisteredMembers extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $event;

    public function mount()
    {
        $this->event = Event::where('is_active', 1)->first();
    }

    public function table(Table $table): Table
    {
        if($this->event)
        {
            return $table
            ->query(Registration::query()->where('event_id', $this->event->id))
            ->columns([
                TextColumn::make('event.name')->label('EVENT NAME'),
                TextColumn::make('event.type')->label('EVENT TYPE'),
                TextColumn::make('user.member.fullName')->label('MEMBER NAME'),
                TextColumn::make('user.email')->label('EMAIL'),
                TextColumn::make('created_at')->datetime()->label('REGISTERED AT'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // EditAction::make('edit')
                // ->label('Update Position')
                // ->color('success')
                // ->button()
                // ->fillForm(function(Model $record) {
                //     return [
                //         'name' => $record->name,
                //         'number_of_members' => $record->number_of_members,
                //     ];
                // })
                // ->form([
                //     TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //     TextInput::make('number_of_members')
                //         ->required()
                //         ->numeric()
                // ]),
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
        }else{
            return $table
            ->query(Registration::query())
            ->columns([
                TextColumn::make('event.name')->label('EVENT NAME'),
                TextColumn::make('event.type')->label('EVENT TYPE'),
                TextColumn::make('user.member.fullName')->label('MEMBER NAME'),
                TextColumn::make('user.email')->label('EMAIL'),
                TextColumn::make('created_at')->datetime()->label('REGISTERED AT'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // EditAction::make('edit')
                // ->label('Update Position')
                // ->color('success')
                // ->button()
                // ->fillForm(function(Model $record) {
                //     return [
                //         'name' => $record->name,
                //         'number_of_members' => $record->number_of_members,
                //     ];
                // })
                // ->form([
                //     TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //     TextInput::make('number_of_members')
                //         ->required()
                //         ->numeric()
                // ]),
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


    }

    public function render()
    {
        return view('livewire.admin.pre-registered-members');
    }
}
