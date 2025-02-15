<?php

namespace App\Livewire\Officer;

use Livewire\Component;
use App\Models\Attendance as AttendanceModel;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Attendance extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(AttendanceModel::query())
            ->columns([
                TextColumn::make('registration.event.name')->label('EVENT NAME'),
                TextColumn::make('registration.event.type')->label('EVENT TYPE'),
                TextColumn::make('registration.user.member.fullName')->label('MEMBER NAME'),
                TextColumn::make('created_at')->datetime()->label('DATE ATTENDED'),

                // TextColumn::make('number_of_members')->label('NUMBER OF MEMBERS'),
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

    public function render()
    {
        return view('livewire.officer.attendance');
    }
}
