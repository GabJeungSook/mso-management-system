<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Member;
use App\Models\User;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use DB;

class Members extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Member::query())
            ->columns([
                TextColumn::make('fullName')->searchable()->label('FULL NAME'),
                TextColumn::make('user.email')->label('EMAIL'),
                TextColumn::make('gender')->label('GENDER'),
                TextColumn::make('address')->wrap()->label('ADDRESS'),
                TextColumn::make('phone_number')->label('PHONE NUMBER'),
                TextColumn::make('birth_date')->date()->label('BIRTH DATE'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')
                ->label('Update Member')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'first_name' => $record->first_name,
                        'last_name' => $record->last_name,
                        'gender' => $record->gender,
                        'address' => $record->address,
                        'phone_number' => $record->phone_number,
                        'birth_date' => $record->birth_date,
                    ];
                })
                ->form([
                    TextInput::make('first_name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('last_name')
                        ->required()
                        ->maxLength(255),
                    Select::make('gender')
                        ->required()
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female'
                        ]),
                    Textarea::make('address')
                        ->required(),
                    TextInput::make('phone_number')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('birth_date')
                        ->label('Birthday')
                        ->required()
                        ->native(false)

                ])->successNotificationTitle('Member information updated successfully'),
                Action::make('edit_account')
                ->label('Update Account')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'email' => $record->user->email,
                    ];
                })
                ->form([
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->revealable()
                        ->required(),
                    TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->password()
                        ->revealable()
                        ->required()
                ])
                ->action(function (array $data, Model $record) {

                    $user = User::find($record->user_id);
                    $user->update([
                        'email' => $data['email'],
                        'password' => Hash::make($data['password'])
                    ]);

                    Notification::make()
                    ->success()
                    ->title('Success')
                    ->body('Member account updated successfully')
                    ->send();
                })
            ])
            ->headerActions([
                Action::make('add_member')
                ->label('Add New Member')
                ->modalHeading('Add New Member')
                ->icon('heroicon-o-plus-circle')
                ->form([
                    Fieldset::make('Member Information')
                    ->schema([
                        Grid::make(2)
                        ->schema([
                            TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                            TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        ]),
                        Grid::make(2)
                        ->schema([
                            Select::make('gender')
                            ->required()
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female'
                            ]),
                            TextInput::make('phone_number')
                            ->required()
                            ->maxLength(255),
                        ]),
                        Textarea::make('address')
                        ->required(),

                        DatePicker::make('birth_date')
                        ->label('Birthday')
                        ->required()
                        ->native(false)
                    ])->columns(1),
                    Fieldset::make('Member Account')
                    ->schema([
                        TextInput::make('email')
                        ->required()
                        ->email()
                        ->maxLength(255),
                        Grid::make(2)
                        ->schema([
                            TextInput::make('password')
                            ->password()
                            ->confirmed()
                            ->revealable()
                            ->required(),
                            TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->revealable()
                            ->required()
                        ])

                    ])->columns(1)

                    // TextInput::make('number_of_members')
                    //     ->required()
                    //     ->numeric()
                    //     ->default(1)
                ])
                ->action(function (array $data) {

                    $user = User::create([
                        'name' => $data['first_name'] . ' ' . $data['last_name'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'role' => 'member'
                    ]);

                    $member = Member::create([
                        'user_id' => $user->id,
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'gender' => $data['gender'],
                        'address' => $data['address'],
                        'phone_number' => $data['phone_number'],
                        'birth_date' => $data['birth_date'],
                    ]);

                    Notification::make()
                    ->success()
                    ->title('Success')
                    ->body('Member added successfully')
                    ->send();
                })
            ])

            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.members');
    }
}
