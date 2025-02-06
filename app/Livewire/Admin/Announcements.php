<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Announcement;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;

use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Announcements extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Announcement::query())
            ->columns([
                TextColumn::make('event.name')->searchable()->label('EVENT'),
                TextColumn::make('content')->label('CONTENT')->html()->wrap(),
                TextColumn::make('created_at')->dateTime()->searchable()->label('DATE CREATED'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                ->label('Edit Announcement')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'event_id' => $record->event_id,
                        'content' => $record->content,
                    ];
                })
                ->form([
                    Select::make('event_id')
                    ->required()
                    ->relationship('event', 'name'),
                RichEditor::make('content')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                ]),
            ])
            ->headerActions([
                CreateAction::make('add_announcement')
                ->label('Create Announcement')
                ->modalHeading('Create Announcement')
                ->icon('heroicon-o-plus-circle')
                ->form([
                    Select::make('event_id')
                        ->required()
                        ->relationship('event', 'name'),
                    RichEditor::make('content')
                        ->required()
                        ->toolbarButtons([
                            'bold',
                            'bulletList',
                            'italic',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.announcements');
    }
}
