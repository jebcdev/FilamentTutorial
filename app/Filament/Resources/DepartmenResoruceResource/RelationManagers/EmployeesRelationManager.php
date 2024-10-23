<?php

namespace App\Filament\Resources\DepartmenResoruceResource\RelationManagers;

use App\Models\City;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            /* Personal Information */
            Forms\Components\Section::make('Personal Information')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->label(__('First Name'))
                        ->required(),
                    Forms\Components\TextInput::make('last_name')
                        ->label(__('Last Name'))
                        ->required(),
                ])->columns(2),
            /* Personal Information */

            /* Location Information */
            Forms\Components\Section::make('Location Information')
                ->schema([
                    Forms\Components\Select::make('country_id')
                    ->label(__('Country'))
                        ->relationship('country', 'name')
                        ->searchable(true)
                        ->preload()
                        ->live()
                        ->afterStateUpdated(
                            function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            }

                        )

                        ->required(),

                    Forms\Components\Select::make('state_id')
                        ->label(__('State'))
                        ->options(
                            fn(Get $get): Collection => State::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id')
                        )
                        ->searchable(true)
                        ->preload()
                        ->live()
                        ->afterStateUpdated(
                            fn(Set $set) => $set('city_id', null)
                        )
                        ->required(),

                    Forms\Components\Select::make('city_id')
                        ->label(__('City'))
                        ->options(
                            fn(Get $get): Collection => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name', 'id')
                        )
                        ->searchable(true)
                        ->preload()
                        ->live()

                        ->required(),

                    Forms\Components\TextInput::make('address')
                    ->label(__('Address'))
                        ->required(),
                    Forms\Components\TextInput::make('zip_code')
                    ->label(__('Zip Code'))
                        ->required(),
                ])->columns(3),
            /* Location Information */

            /* Department Information */
            Forms\Components\Section::make('Department Information')
                ->schema([
                    Forms\Components\Select::make('department_id')
                    ->label(__('Department'))
                        ->relationship('department', 'name')
                        ->searchable(true)
                        ->preload()
                        ->required(),
                ])->columns(1),
            /* Department Information */

            /* Dates */
            Forms\Components\Section::make('Dates')
                ->schema([
                    Forms\Components\Datepicker::make('date_of_birth')
                        ->label(__('Date of Birth'))
                        ->native(false)
                        ->timezone('America/Bogota')

                        ->required(),
                    Forms\Components\Datepicker::make('date_hired')
                        ->label(__('Date Hired'))
                        ->native(false)
                        ->timezone('America/Bogota')

                        ->required(),
                ])->columns(2),
            /* Dates */

        ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('first_name')
                // ->translateLabel('First Name')
                ->label(__('First Name'))
                ->searchable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('last_name')
                ->label(__('Last Name'))
                ->searchable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('country.name')
                ->label(__('Country'))
                ->searchable()
                ->numeric()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('state.name')
                ->label(__('State'))
                ->searchable()
                ->numeric()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('city.name')
                ->label(__('City'))
                ->searchable()
                ->numeric()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('department.name')
                ->label(__('Department'))
                ->searchable()
                ->numeric()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('address')
                ->label(__('Address'))
                ->searchable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('zip_code')
                ->label(__('Zip Code'))
                ->searchable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('date_of_birth')
                ->label(__('Date of Birth'))
                ->searchable()
                ->date()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('date_hired')
                ->label(__('Date Hired'))
                ->searchable()
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label(__('Created At'))
                ->searchable()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->label(__('Updated At'))
                ->searchable()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('deleted_at')
                ->label(__('Deleted At'))
                ->searchable()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }
}
