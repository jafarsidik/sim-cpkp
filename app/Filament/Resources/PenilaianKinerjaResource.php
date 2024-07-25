<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianKinerjaResource\Pages;
use App\Filament\Resources\PenilaianKinerjaResource\RelationManagers;
use App\Models\PenilaianKinerja;
use App\Models\PenilaianKinerjaView;
use App\Models\ProfilPerawat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenilaianKinerjaResource extends Resource
{
    protected static ?string $model = PenilaianKinerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Penilaian Kinerja';
    protected static ?string $title = 'Penilaian Kinerja Perawat';
    protected ?string $heading = 'Penilaian Kinerja Perawat';
    protected ?string $subheading = 'Penilaian Kinerja Perawat';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Perawat')->schema([
                    Select::make('perawat_id')
                    ->label('Perawat')
                    ->options(ProfilPerawat::all()->pluck('namalengkap', 'id'))
                    ->searchable()
                ])->columns(1),
                    Fieldset::make('KOMUNIKASI')->schema([
                        Radio::make('pernyataan_a_1')->label('Selalu berkomunikasi dalam menjalankan tugas KP dengan baik kepada atasan (Karu,Ka instal dan Ka komwat)')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_a_2')->label('Selalu berkomunikasi dalam menjalankan tugas KP dengan baik kepada teman sejawat')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_a_3')->label('Selalu berkomunikasi dalam menjalankan tugas KP dengan baik kepada tim kesehatan lainnya')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_a_4')->label('Selalu berkomunikasi dalam menjalankan tugas KP dengan baik kepada pasien dan keluarganya')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                    ])->columns(1),
                    Fieldset::make('Pemahaman keselamatan pasien')->schema([
                        Radio::make('pernyataan_b_1')->label('Memahami Definisi Keselamatan Pasien')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_b_2')->label('memahami manfaat dari Keselamatan Pasien')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_b_3')->label('Memahami Insiden Keselamatan Pasien')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_b_4')->label('Memahami  6 Strategi menjaga Keselamatan Pasien')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                    ])->columns(1),
                    Fieldset::make('KEHANDALAN')->schema([ 
                        Radio::make('pernyataan_c_1')->label('Menjaga KP selama menjalankan tugasnya')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_c_2')->label('Melaksanakan 6 SKP slm menjalankan tugas sebagai perawat')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_c_3')->label('Menunjukkan kesadaran tentang pentingnya KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_c_4')->label('Mempunyai motivasi tinggi utk  menjaga KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_c_5')->label('Melakukan pelaporan insiden dengan kesadaran tinggi untuk menjaga KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_c_6')->label('Selalu mengevaluasi diri dalam  menjaga KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_c_7')->label('Mengupdate ilpeng & pemahamannya untuk menjaga KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_c_8')->label('Melakukan komunikasi yang efektif dengan teman sejawat, dengan klien & tim  kes lainnya dalam menjalankan tugas sehari2')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                    ])->columns(1),
                    Fieldset::make('KEPATUHAN')->schema([ 
                        Radio::make('pernyataan_d_1')->label('Kepatuhan melaksanakan SOP SKP 1 (Ketepatan Identifikasi Pasien)')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                         /* Radio::make('pernyataan_d_2')->label('Selalu mengevaluasi diri dalam  menjaga KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),*/
                        Radio::make('pernyataan_d_3')->label('Kepatuhan Melaksanakan SOP SKP 3 (pengelolaan Obat yg perlu diwaspadai )')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_d_4')->label('Kepatuhan Melaksanakan SOP SKP 4 (keTepatan Lokasi, prosedur dan pasien operasi )')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_d_5')->label('Kepatuhan Melaksanakan SOP SKP 5 (Mengurangi resiko Infeksi)')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_d_6')->label('Kepatuhan Melaksanakan SOP SKP 6  (Mengurangi resiko jatuh)')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                    ])->columns(1),
                    Fieldset::make('KERJA SAMA')->schema([ 
                        Radio::make('pernyataan_e_1')->label('Mampu menyelesaikan permasalahan keselamatan pasien sesuai perannya di dalam tim')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_e_2')->label('Melakukan Komunikasi efektif dengan teman sejawat/atasan dalam menyelesaiakn KP  di dalam tim')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                    ])->columns(1),
                    Fieldset::make('KEPEMIMPINAN')->schema([ 
                        Radio::make('pernyataan_f_1')->label('bertanggung jawab dalam menjaga KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                        Radio::make('pernyataan_f_2')->label('Melakukan budaya kerja positif dalam menjaga KP')
                        ->options(['1' => '1','2' => '2','3' => '3','4' => '4'])->columnSpan('full')->inline()->inlineLabel(false),
                    ])->columns(1)

              
                
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return PenilaianKinerjaView::query();
        
                 //->where('karu_id', auth()->id());
        /*$uid = DB::table('model_has_roles')->where(array('model_id'=>auth()->id()))->first();
        if($uid->role_id == 4){
            
        }else if($uid->role_id == 3){
            return parent::getEloquentQuery()->where('user_id', auth()->id());
        }else{
            return parent::getEloquentQuery();
        }*/
        
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('username'),
                TextColumn::make('namalengkap')->label('Perawat'),
                TextColumn::make('tanggal'),
                TextColumn::make('nilai_1'),
                TextColumn::make('nilai_2'),
                TextColumn::make('nilai_3'),
                TextColumn::make('nilai_4'),
                TextColumn::make('jumlah_total'),
                TextColumn::make('nilai_rata_rata'),
            ])
            ->filters([
                //
            ])
            ->actions([
               // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListPenilaianKinerjas::route('/'),
            'create' => Pages\CreatePenilaianKinerja::route('/create'),
            //'edit' => Pages\EditPenilaianKinerja::route('/{record}/edit'),
        ];
    }
}
