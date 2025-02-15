<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Penalty;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Services\TeamSSProgramSmsService;
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

                    $smsService = new TeamSSProgramSmsService();
                    $number = $record->member->phone_number;
                    $message = 'MSO MANAGEMENT SYSTEM SMS\nPenalty Payment\nYou have paid your penalty for the event '.$record->event->name.' with the amount of '.$record->amount;

                    if (!$number) {
                        Notification::make()
                            ->title('SMS Failed')
                            ->danger()
                            ->body('The phone number is missing or invalid.')
                            ->send();

                        return;
                    }

                    $response = $smsService->sendSms($number, $message);
                    if (isset($response['error']) && $response['error']) {
                        Notification::make()
                            ->title('SMS Failed')
                            ->danger()
                            ->body('Failed to send SMS: ' . $response['message'])
                            ->send();
                    } else {
                        Notification::make()
                            ->title('SMS Sent')
                            ->success()
                            ->body('SMS sent successfully to member')
                            ->send();
                    }

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
