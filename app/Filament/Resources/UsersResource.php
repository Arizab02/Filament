<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Forms\Components\KelasIdSelect;
use App\Forms\Components\RoleSelect;
use App\Models\User;
use App\Models\Users;
use BladeUI\Icons\Components\Icon;
use \DateTime;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'santri';
    protected static ?string $navigationGroup = 'Santri Management';
    protected static ?string $slug = 'users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Data Santri')
                    ->icon('heroicon-o-document-text')
                        ->completedIcon('heroicon-m-clipboard-document-check')
                        ->columns(40)
                        ->schema([
                            
                            ToggleButtons::make('gender')
                                ->inline()
                                ->columnSpanFull()
                                ->grouped() //ada juga yang lain kalo ngga dikasih groued
                                ->required()
                                ->options([
                                    'Laki-laki' => 'Laki-laki', //input ke data => tampilan ke user
                                    'Perempuan' => 'Perempuan',
                                ])
                                ->icons([
                                    'male' => 'heroicon-o-user',
                                    'female' => 'heroicon-o-user-circle',
                                ])

                                ->colors([
                                    'male' => 'primary',
                                    'female' => 'warning',
                                ]),
                            Grid::make([
                                'md' => 1,
                                'lg' => 2,
                                'xl' => 4,
                            ])
                                ->schema([

                                    TextInput::make('name')
                                        ->placeholder('Nama')
                                        ->prefixIcon('heroicon-o-user')
                                        ->required()
                                        ->prefixiconColor('icon'),
                                    TextInput::make('email')
                                        ->prefixIcon('heroicon-o-envelope')
                                        ->email()
                                        ->prefixiconColor('icon'),
                                    TextInput::make('generation')
                                        ->prefixIcon('heroicon-o-academic-cap')
                                        ->prefixiconColor('icon'),
                                    TextInput::make('no_ktp')
                                        ->prefixIcon('heroicon-o-user')
                                        ->prefixiconColor('icon')
                                ]),

                            Grid::make([
                                'md' => 1,
                                'lg' => 2,
                                'xl' => 4,
                            ])
                                ->schema([
                                    RoleSelect::make('role'),

                                    TextInput::make('entry_date')
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->prefixiconColor('icon'),
                                    // TextInput::make('role')
                                    //     ->prefixIcon('heroicon-o-tag')
                                    //     ->prefixiconColor('icon'),
                                    TextInput::make('password')
                                        ->password()
                                        ->placeholder("888888")
                                        ->required()
                                        ->prefixIcon('heroicon-o-key')
                                        ->prefixiconColor('icon'),
                                    DatePicker::make('date_of_birth')
                                        ->date()
                                        ->placeholder('Enter your birth date')
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-cake')
                                        ->prefixiconColor('icon'),
                                ]),
                            // KelasIdSelect::make('kelas')
                            Grid::make([
                                'md' => 1,
                                'lg' => 2,
                                'xl' => 4,
                            ])
                                ->schema([
                                    Select::make('status_graduate')
                                        ->native(false)
                                        ->options([
                                            'Lulus' => 'Lulus',
                                            'Belum Lulus' => 'Belum Lulus',
                                            'Dropout' => 'Dropout',

                                        ])
                                        ->prefixIcon('heroicon-o-academic-cap')
                                        ->prefixiconColor('icon'),

                                    DatePicker::make('entry_date')
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-calendar-date-range')
                                        ->prefixiconColor('icon'),


                                    DatePicker::make('graduate_date')
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-calendar-days')
                                        ->prefixiconColor('icon'),
                                    Textarea::make('address')
                                        ->columnSpan(3),
                                ])
                        ]),
                        Wizard\Step::make("data wali santri")
                        ->icon('heroicon-o-clipboard-document-list')
                        ->completedIcon('heroicon-m-clipboard-document-check')
                        ->columns(4)
                        ->schema([
                            Grid::make()
                                ->relationship('santriFamily')
                                ->schema([
                                    Section::make()
                                        ->description("Santri's Family Information")
                                        ->schema([
                                            TextInput::make('no_kk')
                                                ->label('Nomor Kartu Keluarga')
                                                ->placeholder('Enter Family Card Number')
                                                ->prefixIcon('heroicon-o-identification')
                                                ->prefixIconColor('primary'),


                                        ]),

                                    Section::make()
                                        ->description("Father Information")
                                        ->schema([
                                            Grid::make([
                                                'md' => 1,
                                                'lg' => 2,
                                                'xl' => 4,
                                            ])
                                                ->schema([

                                                    TextInput::make('father_name')
                                                        ->label("Father's Name")
                                                        ->placeholder('Enter Father Name')
                                                        ->prefixIcon('heroicon-o-user')
                                                        ->prefixIconColor('primary'),
                                                    TextInput::make('father_job')
                                                        ->label("Father's Job")
                                                        ->placeholder('Enter Father Job')
                                                        ->prefixIcon('heroicon-o-briefcase')
                                                        ->prefixIconColor('primary'),
                                                    DatePicker::make('father_birth')
                                                        ->label("Father's Birth Date")
                                                        ->native(false)
                                                        ->prefixIcon('heroicon-o-calendar')
                                                        ->prefixIconColor('primary'),
                                                    TextInput::make('father_phone')
                                                        ->label("Father's Phone")
                                                        ->placeholder('Enter Father Phone Number')
                                                        ->tel()
                                                        ->prefixIcon('heroicon-o-phone')
                                                        ->prefixIconColor('primary'),

                                                ])
                                        ]),

                                ])
                        ])
                        ])
                        ->skippable()
                        ->contained(false)
                        ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s') //bakal refresh setiap 5 detik sekali
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true) //by default bakal hilang
                    ->searchable(),
                TextColumn::make('name')
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->iconColor('icon')
                    ->toggleable()
                    ->description(fn(User $record): string => "" . $record->email)
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->icon('heroicon-o-at-symbol')
                    ->iconColor('icon')
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
                    ->tooltip(function ($record) {
                        return $record->entry_date . ' -> ' . $record->graduate_date;
                    })
                    ->getStateUsing(function ($record) {
                        $tanggalMasuk = new DateTime($record->entry_date);
                        $tanggalKeluar = new DateTime($record->graduate_date);

                        $totalBulan =
                            $tanggalMasuk->diff($tanggalKeluar)->m +
                            ($tanggalKeluar->format('Y') - $tanggalMasuk->format('Y')) * 12;

                        return $totalBulan . ' Bulan'; //untuk mengemalikan dengan format bulan
                    })
                    ->label('Masa Santri'),
                TextColumn::make('kelas.major')
                    ->iconColor('icon')
                    ->icon('heroicon-o-academic-cap')
                    ->searchable(),
                TextColumn::make('role')
                    ->searchable()
                    ->icon('heroicon-o-tag')
                    ->sortable()
                    ->badge() //biar warnanya kotak
                    ->color('danger')
                    ->color(function ($record) {
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
                                TextColumn::make('created_at')
                                    ->date('Y-m-d')
                                    ->sortable()
                                    ->label('Created At')
                                    ->toggleable(isToggledHiddenByDefault: true);
                        }
                    }),

            ])

            ->defaultSort(
                fn($query) =>
                $query->orderby('generation', 'asc')
            )

            ->paginated([
                12,
                2,
                23,
                54,
                65,
                76
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter')
                    ->options([
                        'Santri' => 'Santri',
                        "ustadz" => 'guru'
                    ]),
                SelectFilter::make('departement_id')
                    ->label('Departemen'),
                // ->option(),

                // Filter::make('entry_date')
                //     ->form([
                //         DateTimePicker::make('start_date')
                //             ->label('dari_tanggal')
                //             ->native(true)
                //             ->format('Y-m-d'),

                //         DateTimePicker::make('end_date')
                //             ->label('ke tanggal')
                //             ->native(false)
                //             ->format('Y-m-d'),
                //     ])

                // ->query(function (Builder $query, array $data) {
                //     if (!empty($data['start_date']) && !empty($data['end_date'])) {
                //         $query->whereBetween('entry_date', [
                //             $data['start_date'],
                //             $data['end_date']
                //         ]);
                //     }q
                // }),
                Filter::make('entry_and_graduate_date')
                    ->form([
                        DatePicker::make('entry_from')
                            ->label('Filter tanggal masuk dari')
                            ->native(true),
                        DatePicker::make('entry_until')
                            ->native(true)
                            ->label('sampai'),
                        DatePicker::make('graduate_from')
                            ->label('Filter tanggal lulus dari')
                            ->native(true),
                        DatePicker::make('graduate_until')
                            ->native(true)
                            ->label('sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['entry_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('entry_date', '>=', $date),
                            )
                            ->when(
                                $data['entry_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('entry_date', '<=', $date),
                            )
                            ->when(
                                $data['graduate_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('graduate_date', '>=', $date),
                            )
                            ->when(
                                $data['graduate_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('graduate_date', '<=', $date),
                            );
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
            'view' => Pages\ViewUsers::route('/{record}'),
        ];
    }

    public static function getLabel(): string
    {
        return 'Santri';
    }

    public static function getNavigationBadge(): ?string
    {
        return $userData = User::all()->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Ini adalah tooltip';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }
    
    public static function infolist(Infolist $infolist): Infolist {
        return $infolist
        ->schema([
            TextEntry::make('name')
            ->helperText('Ini adalah nama lengkap kamu baik itu nama depan maupun nama belakang'),
            TextEntry::make('email')
            ->helperText(new HtmlString('<u>Ini bisa memakai <i><b>tag</b></u> html</i> juga loh')),
            TextEntry::make('nisn')
            ->default('N/A'),
            TextEntry::make('adress')
            ->label('Alamat Kamu')
            ->hint('Halo!!!, ini adalah hint')
            ->placeholder('ini adalah placeholder'),
            TextEntry::make('generation'),
            TextEntry::make('entry_date')
            ->placeholder('Ini adalah placeholdre'),

        ]);
    }
}
