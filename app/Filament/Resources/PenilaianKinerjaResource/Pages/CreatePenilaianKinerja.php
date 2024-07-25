<?php

namespace App\Filament\Resources\PenilaianKinerjaResource\Pages;

use App\Filament\Resources\PenilaianKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\PenilaianKinerja;

class CreatePenilaianKinerja extends CreateRecord
{
    protected static string $resource = PenilaianKinerjaResource::class;

    protected function handleRecordCreation(array $data): PenilaianKinerja
    {
        $uniq =  uniqid();
        foreach ($data as $key=>$itemData) {
            
            
            PenilaianKinerja::create([
                'pernyataan' => $key,
                'jawaban' => $itemData,
                'user_id'=>auth()->id(),
                'tanggal'=>date('Y-m-d'),
                'is_group'=>$uniq,
                //$uid = DB::table('profil_perawats')->where(array('user_id'=>auth()->id()))->first();
                //$datas['perawat_id'] = $uid->id;
             ]);
        }
        return new PenilaianKinerja();
        
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
