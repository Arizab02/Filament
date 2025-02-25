<?php

namespace App\Forms\Components;

use App\Models\User;
use Filament\Forms\Components\Select;

class KelasIdSelect extends Select
{
    public static function make(String $name) : static
    {
        return parent::make($name)
            ->label('Kelas')
            ->searchable(true)
            ->prefixIcon('hericon-o-tag')
            ->prefixiconColor('icon')
            ->native(false)
            ->options(fn()=>User::all()->pluck('kelas','id')->toArray());
    }
}