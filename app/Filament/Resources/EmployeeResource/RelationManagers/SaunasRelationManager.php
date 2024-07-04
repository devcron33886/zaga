<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use App\Models\Scopes\SaunaScope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SaunasRelationManager extends RelationManager
{
    protected static string $relationship = 'saunas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('payout')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScope(SaunaScope::class))
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
}
