<?php

namespace App\Filament\Resources\SelfAssesmentResource\Pages;

use App\Filament\Resources\SelfAssesmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use App\Models\SelfAssesment;

class CreateSelfAssesment extends CreateRecord
{
    protected static string $resource = SelfAssesmentResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
                    
        foreach($data as $key =>$val){
            $explode = explode('|',$key);
            $skp = DB::table('buku_karus')->where(array('skp_code'=>$explode[0],'id'=>$explode[2]))->first();
            // echo "<pre>";
            // print_r($skp);
            $skp1=1;
            $skp2=1;
            $i =0;
            //dd(json_decode($skp->sub_kompetensi_dan_kode));
             $x = json_decode($skp->sub_kompetensi_dan_kode,true);
             foreach($x as $keys=>$detail){
              
                 $datas['record_self_assesment'][$keys]['index'] = $key;
                 $datas['record_self_assesment'][$keys]['flag_skp'] = $explode[0];
                 $datas['record_self_assesment'][$keys]['hasil_jawaban_self_assesment'] = $val;
                 $datas['record_self_assesment'][$keys]['pertanyaan'] = $detail['detail_sub_kompetensi'];
                 $datas['record_self_assesment'][$keys]['jawaban_buku_karu_tingkat_kemapuan_vokasi'] = $detail['tingkat_kemapuan_vokasi'];
                 $datas['record_self_assesment'][$keys]['jawaban_buku_karu_tingkat_kemapuan_ners'] = $detail['tingkat_kemapuan_ners'];
               
                
             }
            
        }
        $uid = DB::table('profil_perawats')->where(array('user_id'=>auth()->id()))->first();
        $datas['perawat_id'] = $uid->id;
        $datas['tanggal_self_assesment'] = date('Y-m-d');
        $datas['is_vokasi_or_ners'] =$uid->is_vokasi_ners;
        $datas['hasil'] ='Baik';
        
        // Notification::make()
        // ->title('hasil Assesment anda adalah Baik')
        // ->success()
        // ->send();
       
        return $datas;
    }
  
    protected function handleRecordCreation(array $data): SelfAssesment
    {
        
        foreach ($data['record_self_assesment'] as $key=>$itemData) {
            $jawaban_konversi='';
            if($data['is_vokasi_or_ners'] === 'vokasi'){
                if($itemData['hasil_jawaban_self_assesment'] === $itemData['jawaban_buku_karu_tingkat_kemapuan_vokasi']){
                    $jawaban_konversi = 1;
                }else{
                    $jawaban_konversi = 0;
                }
            }else if($data['is_vokasi_or_ners'] === 'ners'){
                if($itemData['hasil_jawaban_self_assesment'] === $itemData['jawaban_buku_karu_tingkat_kemapuan_ners']){
                    $jawaban_konversi = 1;
                }else{
                    $jawaban_konversi = 0;
                }
            }
            //if($itemData['hasil_jawaban_self_assesment'])
            SelfAssesment::create([
                'perawat_id' => $data['perawat_id'],
                'tanggal_self_assesment' => $data['tanggal_self_assesment'],
                'index' => $key,
                'flag_skp' => $itemData['flag_skp'],
                'hasil_jawaban_self_assesment' => $itemData['hasil_jawaban_self_assesment'],
                'jawaban_buku_karu_tingkat_kemapuan_vokasi' => $itemData['jawaban_buku_karu_tingkat_kemapuan_vokasi'],
                'jawaban_buku_karu_tingkat_kemapuan_ners' => $itemData['jawaban_buku_karu_tingkat_kemapuan_ners'],
                'pertanyaan' =>$itemData['pertanyaan'] ,
                'jawaban_konversi' =>$jawaban_konversi,
                'is_vokasi_or_ners' => $data['is_vokasi_or_ners'],
            ]);
        }
        return new SelfAssesment();
        
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    // ...
 
    protected function beforeFill(): void
    {
        // Runs before the form fields are populated with their default values.
    }
 
    protected function afterFill(): void
    {
        // Runs after the form fields are populated with their default values.
    }
 
    protected function beforeValidate(): void
    {
        // Runs before the form fields are validated when the form is submitted.
    }
 
    protected function afterValidate(): void
    {
        // Runs after the form fields are validated when the form is submitted.
    }
 
    protected function beforeCreate(): void
    {
        // Runs before the form fields are saved to the database.
    }
 
    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
         $recipient = auth()->user();
        
        Notification::make()
             ->title('Self Assesment Sudah dilakukan')
             ->sendToDatabase($recipient);
    }
}
