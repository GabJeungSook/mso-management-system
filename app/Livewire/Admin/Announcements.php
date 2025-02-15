<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Announcement;
use App\Models\Member;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use App\Services\TeamSSProgramSmsService;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\CreateAction;
use Filament\Notifications\Notification;
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
                ->after(function (array $data) {
                    $smsService = new TeamSSProgramSmsService();
                    $message = strip_tags($data['content']);

                    $members = Member::whereDoesntHave('officer')->get();

                    if ($members->isEmpty()) {
                        Notification::make()
                            ->title('No Recipients')
                            ->danger()
                            ->body('No members found')
                            ->send();
                        return;
                    }

                    $phoneNumbers = $members->map(function ($user) {
                        return $user->phone_number;
                    })->filter()->toArray();

                    if (empty($phoneNumbers)) {
                        Notification::make()
                            ->title('No Recipients')
                            ->danger()
                            ->body('No valid phone numbers found in the members.')
                            ->send();
                        return;
                    }

                    $response = $smsService->sendBulkSms($phoneNumbers, $message);

                    if (isset($response['error']) && $response['error']) {
                        Notification::make()
                            ->title('SMS Failed')
                            ->danger()
                            ->body('Failed to send SMS: ' . $response['message'])
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Success')
                            ->success()
                            ->body('Announcement was sent to users')
                            ->send();
                    }
                })
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
