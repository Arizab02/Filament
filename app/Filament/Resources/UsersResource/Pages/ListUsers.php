<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UsersResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Santri')
            ->icon('heroicon-o-user-plus'),
        ];
    }

        public function getTabs() : array
        {
            return [
                'Santri' => Tab::make()->query(fn($query) => $query->where('role','santri')),
                'Ustadz' => Tab::make()->query(fn($query) => $query->where('role','ustadz')),
                'Pengurus' => Tab::make()->query(fn($query) => $query->where('role','pengurus')),
                'All' => Tab::make(),
            ];
        }
}
