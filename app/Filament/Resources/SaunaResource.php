<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaunaResource\Pages;
use App\Models\Sauna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SaunaResource extends Resource
{
    protected static ?string $model = Sauna::class;

    protected static ?string $navigationGroup = 'Works Management';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'phone_name')
                    ->searchable(['names', 'phone_number'])
                    ->preload()
                    ->placeholder('Select employee')
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('names')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter employee names'),

                        Forms\Components\TextInput::make('phone_number')
                            ->label('Phone number')
                            ->unique()
                            ->required()
                            ->placeholder('Enter phone number'),
                        Forms\Components\Hidden::make('user_id')
                            ->default(Auth::user()->id),

                    ])
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Forms\Components\TextInput::make('sauna')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        $total = $get('sauna') + $get('massage') + $get('gym') + $get('bar_and_kicthen');
                        $set('total', $total);
                    })
                    ->numeric()
                    ->placeholder('Enter sauna amount'),
                Forms\Components\TextInput::make('massage')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        $total = $get('sauna') + $get('massage') + $get('gym') + $get('bar_and_kicthen');
                        $set('total', $total);
                    })
                    ->numeric()
                    ->placeholder('Enter massage amount'),
                Forms\Components\TextInput::make('gym')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        $total = $get('sauna') + $get('massage') + $get('gym') + $get('bar_and_kicthen');
                        $set('total', $total);
                    })
                    ->numeric()
                    ->placeholder('Enter gym amount'),
                Forms\Components\TextInput::make('bar_and_kitchen')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        $total = $get('sauna') + $get('massage') + $get('gym') + $get('bar_and_kicthen');
                        $set('total', $total);
                    })
                    ->numeric()
                    ->placeholder('Enter bar and kitchen amount'),
                Forms\Components\TextInput::make('cash_in')
                    ->label('Cash In')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        $total = $get('total', 0);
                        $cashIn = $get('cash_in', 0);
                        $cashOut = $get('cash_out', 0);
                        $payout = ($total / 10) + $cashIn - $cashOut;
                        $set('payout', $payout);
                    })
                    ->numeric()
                    ->placeholder('Enter cash in'),

                Forms\Components\TextInput::make('cash_out')
                    ->label('Cash Out')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        $total = $get('total', 0);
                        $cashIn = $get('cash_in', 0);
                        $cashOut = $get('cash_out', 0);
                        $payout = ($total / 10) + $cashIn - $cashOut;
                        $set('payout', $payout);
                    })
                    ->numeric()
                    ->placeholder('Enter cash out'),

                Forms\Components\Hidden::make('payout')
                    ->label('Payout')
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->disabled()
                    ->dehydrated()
                    ->numeric()
                    ->placeholder('Total will be calculated'),
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.names')
                    ->numeric()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sauna')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('massage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gym')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bar_and_kitchen')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cash_in')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cash_out')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payout')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sauna')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),
                Tables\Columns\TextColumn::make('massage')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),
                Tables\Columns\TextColumn::make('gym')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),
                Tables\Columns\TextColumn::make('bar_and_kitchen')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),
                Tables\Columns\TextColumn::make('cash_in')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),
                Tables\Columns\TextColumn::make('cash_out')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),
                Tables\Columns\TextColumn::make('total')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),
                Tables\Columns\TextColumn::make('payout')
                    ->summarize(Sum::make()->label('Total')->money('rwf')),

            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSaunas::route('/'),
        ];
    }
}
