<?php

namespace App\Filament\Resources\BrancheResource\Pages;

use App\Filament\Resources\BrancheResource;
use App\Models\Branche;
use App\Models\Config;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBranches extends ListRecords
{
    protected static string $resource = BrancheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->disabled(function(){
                $config=Config::select('num_branches')
                ->where('id',1)->first();
                $countBranches=Branche::get()->count();
                if($countBranches>$config->num_branches){
                    return true;
                }
                return false;
            }),
        ];
    }
}
