<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\Member;
use App\Models\Fee;
use App\Models\Penalty;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use App\Services\TeamSSProgramSmsService;
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
                ->disabled(fn (Event $record) => $record->has_ended)
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
                ])
                ->visible(fn (Event $record) => !$record->has_ended),
                Action::make('end_event')
                ->label('End Event')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->action(function (Event $record) {
                    $record->has_ended = true;
                    $record->is_active = false;
                    $record->save();
                    
                  
                    $fee = Fee::where('event_id', $record->id)->first();
                    
                    if($fee != null && $fee->has_penalty_fee === 1)
                    {
                        //add penalties
                        $members = Member::whereDoesntHave('officer')->whereHas('user', function ($query) use ($record){
                            $event = $record;    
                            $query->whereDoesntHave('registrations.attendances', function ($subQuery) use ($event) {
                                $subQuery->where('event_id', $event->id);
                            });
                        })->get();

                        foreach($members as $member)
                        {
                            Penalty::create([
                                'event_id' => $record->id,
                                'member_id' => $member->id,
                                'amount' => $fee->penalty_fee,
                            ]);
                        }
                        $fee = Fee::where('event_id', $record->id)->first();
                        $smsService = new TeamSSProgramSmsService();
                        $message = 'MSO MANAGEMENT SYSTEM SMS\nPenalty\nYou have not attended the event '.$record->name.'\nYou can view your penalty in your account.;

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
                                ->body('Penalty message was sent to absent members.')
                                ->send();
                        }
                    }

                    Notification::make()
                    ->title('Success')
                    ->body('Event has successfully ended')
                    ->success()
                    ->send();
                })
                ->button()
                ->visible(fn (Event $record) => !$record->has_ended && $record->is_active),
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
