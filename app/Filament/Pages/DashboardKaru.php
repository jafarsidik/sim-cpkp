<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ProfilPerawat;
use App\Models\SelfAssesment;
use App\Models\Rekomendasi;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Button;
use Filament\Forms\Components\CheckboxList;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Actions\Action as FormAction;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Actions;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;

use Filament\Notifications\Notification;

class DashboardKaru extends Page implements Forms\Contracts\HasForms, Tables\Contracts\HasTable
{
    use Forms\Concerns\InteractsWithForms;
    use Tables\Concerns\InteractsWithTable;
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard-karu';
    
    public $perawat_id;
    public $simpulan;
    public $rekomendasi;
    public $data_penilaian_rekomendasi;

    protected function getTableQuery(): Builder
    {
        return SelfAssesment::select('id', 'perawat_id', 'flag_skp','jawaban_konversi','tanggal_self_assesment')
            ->when($this->perawat_id, function (Builder $query) {
                if(isset($this->perawat_id)){
                    $query->where('perawat_id', $this->perawat_id);
                }
                
                //$query->groupBy(');
            })->groupBy('tanggal_self_assesment');
    }

    protected function getTableColumns(): array
    {
        $persen_skp_1 = '';
        $persen_skp_2 = '';
        $persen_skp_3 = '';
        $persen_skp_4 = '';
        $persen_skp_5 = '';
        $persen_skp_6 = '';
        $denominator = 0;
        if(!empty($this->perawat_id)){
            
            $count_skp_1 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_1'))->count();
            $avg_skp_1 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_1','jawaban_konversi'=>1))->count();
            $persen_skp_1 = $count_skp_1 == 0 ? 0 : round(($avg_skp_1/$count_skp_1)*100);

            $count_skp_2 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_2'))->count();
            $avg_skp_2 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_2','jawaban_konversi'=>1))->count();
            $persen_skp_2 = $count_skp_2 == 0 ? 0 : round(($avg_skp_2/$count_skp_2)*100);

            $count_skp_3 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_3'))->count();
            $avg_skp_3 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_3','jawaban_konversi'=>1))->count();
            $persen_skp_3 = $count_skp_3 == 0 ? 0 : round(($avg_skp_3/$count_skp_3)*100);

            $count_skp_4 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_4'))->count();
            $avg_skp_4 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_4','jawaban_konversi'=>1))->count();
            $persen_skp_4 = $count_skp_4 == 0 ? 0 : round(($avg_skp_4/$count_skp_4)*100);
            
            $count_skp_5 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_5'))->count();
            $avg_skp_5 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_5','jawaban_konversi'=>1))->count();
            $persen_skp_5 = $count_skp_5 == 0 ? 0 : round(($avg_skp_5/$count_skp_5)*100);

            $count_skp_6 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_6'))->count();
            $avg_skp_6 = DB::table('self_assesments')->where(array('perawat_id'=>$this->perawat_id,'flag_skp'=>'skp_6','jawaban_konversi'=>1))->count();
            $persen_skp_6 = $count_skp_6 == 0 ? 0 : round(($avg_skp_6/$count_skp_6)*100);
            
            $nilai_simpulan = 0;
            if($persen_skp_1 == 100){
                $nilai_simpulan += 1;
            }else if($persen_skp_2 == 100){
                $nilai_simpulan += 1;
            }else if($persen_skp_3 == 100){
                $nilai_simpulan += 1;
            }else if($persen_skp_4 == 100){
                $nilai_simpulan += 1;
            }else if($persen_skp_5 == 100){
                $nilai_simpulan += 1;
            }else if($persen_skp_6 == 100){
                $nilai_simpulan += 1;
            }

            if($nilai_simpulan == 1){
                $this->rekomendasi = 'Tingkat Kepatuhan Perawat Tidak Baik.';
            }else if($nilai_simpulan == 2){
                $this->rekomendasi = 'Tingkat Kepatuhan Perawat Kurang Baik.';
            }else if($nilai_simpulan == 3){
                $this->rekomendasi = 'Tingkat Kepatuhan Perawat Cukup Baik.';
            }else if( ($nilai_simpulan >=4) and ($nilai_simpulan <=5) ){
                $this->rekomendasi = 'Tingkat Kepatuhan Perawat Baik.';
            }else if($nilai_simpulan == 6){
                $this->rekomendasi = 'Tingkat Kepatuhan Perawat Sangat Baik.';
            }else{
                $this->rekomendasi = '';
            }
           $this->penilaian_rekomendasi = json_encode(array(
            //'tanggal_self_assesment'=>date(),
            'skp_1'=>$persen_skp_1,
            'skp_2'=>$persen_skp_2,
            'skp_3'=>$persen_skp_3,
            'skp_4'=>$persen_skp_4,
            'skp_5'=>$persen_skp_5,
            'skp_6'=>$persen_skp_6,
           ));
        
        return [
            Tables\Columns\TextColumn::make('id')->label('ID'),
            Tables\Columns\TextColumn::make('tanggal_self_assesment')->label('Tanggal Self Assesment'),
            Tables\Columns\TextColumn::make('skp_1')->label('SKP 1')->default($persen_skp_1.'%'),
            Tables\Columns\TextColumn::make('skp_2')->label('SKP 2')->default($persen_skp_2.'%'),
            Tables\Columns\TextColumn::make('skp_3')->label('SKP 3')->default($persen_skp_3.'%'),
            Tables\Columns\TextColumn::make('skp_4')->label('SKP 4')->default($persen_skp_4.'%'),
            Tables\Columns\TextColumn::make('skp_5')->label('SKP 5')->default($persen_skp_5.'%'),
            Tables\Columns\TextColumn::make('skp_6')->label('SKP 6')->default($persen_skp_6.'%')
            // Add more columns as needed
        ];
        }else{
            return [];
        }
    }
    protected function getTableActions(): array
    {
        return [
           // Action::make('edit')
            //    ->url(fn (SelfAssesment $record): string => route('filament.resources.self-assessments.edit', $record)),
        ];
    }

    public function mount(): void
    {
        // Initialization code
        $this->form->fill();
    }
    public function search()
    {
        // Handle form submission
        // For example, save the data to the database
        // SelfAssessment::create([
        //     'perawat_id' => $this->perawat_id,
        //     'assessment' => 'Some assessment', // Adjust accordingly
        // ]);

        // // Optionally, reset the form
        // $this->resetForm();
        $this->resetTable(); // Reset the table to apply the new query
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Form Dashboard Karu')
                ->schema([
                    Select::make('perawat_id')
                        ->label('Daftar Nama Perawat')
                        ->options(ProfilPerawat::all()->pluck('namalengkap', 'id'))
                        ->searchable()
                        //->reactive()
                        ->loadingMessage('Loading Data Perawat...')
                        ->suffixAction(
                            FormAction::make('search')
                                ->button()
                                ->icon('heroicon-o-signal')
                                ->label('Search')
                                ->action('search')
                        )
                        ->required()->columns(2),
                    Textarea::make('rekomendasi')->default($this->rekomendasi)->readonly(),
                   
                    
                ])
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('evaluasi')->label('Simpan Evaluasi')
                ->action(function () {
                    //dd($this->penilaian_rekomendasi);
                    $perawat = DB::table('profil_perawats')->where('user_id', auth()->id())->first();
                    DB::table('rekomendasis')->insert([
                        'perawat_id' => auth()->id(),
                        'rekomendasi' => $this->rekomendasi,
                        'penilaian_rekomendasi' => $this->penilaian_rekomendasi,
                        'status_pelaporan' => 'Permohonan Rekomendasi Self Assesment Perawat Dari Karu Ke Kainstall'
                    ]);
                    
                    Notification::make()
                        ->title('Evaluasi Berhasil disimpan')
                        ->success()
                        ->send();
       
                })
        ];
    }
    
    
}
