<?php

namespace App\Forms\Components;

use App\Models\User;
use Filament\Forms\Components\Select;

class RoleSelect extends Select
{
    public static function make(String $name) : static
    {
        return parent::make($name)
            ->label('Role')
            ->searchable(true)
            ->prefixIcon('heroicon-o-tag')
            ->prefixiconColor('icon')
            ->native(false)
            ->options([
                'Santri' => 'Santri',
                'Ustadz'=> 'Ustadz',
                'Pengurus'=> 'Pengurus'
            ]);
    }
}