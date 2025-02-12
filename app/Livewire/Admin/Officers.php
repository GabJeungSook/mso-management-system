<?php

namespace App\Livewire\Admin;

use App\Models\Officer;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class Officers extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Officer::query())
            ->columns([
                TextColumn::make('member.fullName')->searchable()->label('FULL NAME'),
                TextColumn::make('position.name')->label('POSITION'),
                ImageColumn::make('image')
                    ->label('IMAGE')->width(100)->height(100),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                ->label('Update Officer')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'name' => $record->name,
                        'number_of_members' => $record->number_of_members,
                    ];
                })
                ->form([
                    Select::make('member_id')
                    ->relationship(
                        name: 'member',
                        modifyQueryUsing: fn (Builder $query) => $query->orderBy('first_name')->orderBy('last_name'),
                    )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->first_name} {$record->last_name}")
                    ->preload()
                    ->searchable(['first_name', 'last_name']),
                    Select::make('position_id')
                    ->relationship(
                        name: 'position',
                        modifyQueryUsing: fn (Builder $query) => $query->whereRaw('
                            positions.number_of_members > (
                                SELECT COUNT(*)
                                FROM officers
                                WHERE officers.position_id = positions.id
                            )
                        ')
                    )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name}")
                    ->label('Positions'),
                    FileUpload::make('image')
                    ->preserveFileNames()
                    ->disk('public')
                    ->directory('officers')
                    ->label('Upload Image')
                    ->uploadingMessage('Uploading image...')
                    ->image()
                ]),
            ])
            ->headerActions([
                CreateAction::make('add_officer')
                ->label('Add New Officer')
                ->modalHeading('Add New Officer')
                ->icon('heroicon-o-plus-circle')
                ->form([
                    Select::make('member_id')
                        ->label('Members')
                        ->required()
                        ->relationship(
                            name: 'member',
                            modifyQueryUsing: fn (Builder $query) => $query->whereDoesntHave('officer')->orderBy('first_name')->orderBy('last_name'),
                        )
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->first_name} {$record->last_name}")
                        ->preload()
                        ->searchable(['first_name', 'last_name']),
                        Select::make('position_id')
                        ->required()
                        ->relationship(
                            name: 'position',
                            modifyQueryUsing: fn (Builder $query) => $query->whereRaw('
                                positions.number_of_members > (
                                    SELECT COUNT(*)
                                    FROM officers
                                    WHERE officers.position_id = positions.id
                                )
                            ')
                        )
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name}")
                        ->label('Positions'),
                    FileUpload::make('image')
                    ->preserveFileNames()
                    ->disk('public')
                    ->directory('officers')
                    ->label('Upload Image')
                    ->uploadingMessage('Uploading image...')
                    ->image()
                    ])->after(function (Model $record) {
                        $record->member->user->update([
                            'role' => 'officer',
                        ]);
                    }),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.officers');
    }
}
