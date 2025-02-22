<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use App\Models\Users;
use BladeUI\Icons\Components\Icon;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s') //bakal refresh setiap 5 detik sekali
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true) //by default bakal hilang
                    ->searchable(),
                TextColumn::make('name')
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->iconColor('primary')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                // TextColumn::make('departement')
                    // ->sortable()
                    // ->searchable(),
                TextColumn::make('generation')
                    ->sortable()
                    ->searchable()->label('angkatan'),
                TextColumn::make('gender')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('entry_date')
                    ->getStateUsing(function($record){
                        return $record->entry_date && $record->graduate_date ? $record->entry_date . ' -> ' . $record->graduate_date : ($record->entry_date ?? '') . ($record->graduate_date ? ' -> ' . $record->graduate_date : '');
                        }),    
                TextColumn::make('role')
                    ->searchable()
                    ->sortable()
                    ->badge() //biar warnanya kotak
                    ->color('danger')
                    ->color(function($record){
                        $role = $record->role;
                        switch ($role) {
                            case 'Santri':
                                return 'danger';
                            case 'Ustadz':
                                return 'info';
                            case 'Staff':
                                return 'green';
                            case 'Pengurus':
                                return 'slate';
                            default:
                                return 'primary';
                        }
                    }),

            ])

            ->defaultSort(
                fn($query) =>
                $query->orderby('generation','asc')
            )

            ->paginated([
                12,2,23,54,65,76
            ])
            ->filters([
                SelectFilter::make('role')
                ->label('Filter')
                    ->options([
                        'Santri' => 'santri',
                        "ustadz" => 'guru'
                ]),
                SelectFilter::make('departement_id')
                    ->label('Departemen'),
                    // ->option(),

                Filter::make('entry_date')
                    ->form([
                        DateTimePicker::make('start_date')
                            ->label('dari_tanggal')
                            ->native(true)
                            ->format('Y-m-d'),
                
                        DateTimePicker::make('end_date')
                            ->label('ke tanggal')
                            ->native(false)
                            ->format('Y-m-d'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['start_date']) && !empty($data['end_date'])) {
                            $query->whereBetween('entry_date', [
                                $data['start_date'],
                                $data['end_date']
                            ]);
                        }
                    })

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
