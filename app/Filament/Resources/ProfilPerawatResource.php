<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilPerawatResource\Pages;
use App\Filament\Resources\ProfilPerawatResource\RelationManagers;
use App\Models\ProfilPerawat;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
//use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Filament\Tables\Enums\ActionsPosition;

class ProfilPerawatResource extends Resource 
{
    protected static ?string $model = ProfilPerawat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Profile Perawat';
    protected static ?string $title = 'Profile Perawat';
    protected ?string $heading = 'Profile Perawat';
    protected ?string $subheading = 'Profile Perawat';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                    TextInput::make('namalengkap')->label('Nama Lengkap')->required(),
                    Select::make('jeniskelamin')->label('Jenis Kelamin')->options([
                        'Laki-Laki' => 'Laki-Laki',
                        'Perempuan' => 'Perempuan'
                    ])->required(),
                    Textarea::make('alamat_ktp')->label('Alamat Domisili (Sesuai KTP)')->required(),
                    Textarea::make('alamat_tinggal')->label('Alamat Tinggal')->required(),
                    TextInput::make('unit_tempat_bekerja_terakhir')->label('Unit Tempat Bekerja Terakhir'),
                    DatePicker::make('mulai_bergabung_dirumah_sakit')->label('Mulai Bergabung di Rumah Sakit'),
                    DatePicker::make('mulai_bekerja_diunit_terakhir')->label('Mulai Bekerja di Unit Terakhir'),
                    Select::make('status_kepegawaian')->label('Status Kepegawaian')->options([
                        'Militer' => 'Militer',
                        'ASN' => 'ASN',
                        'P3K' => 'P3K',
                        'Pegawai tidak tetap/honorer lain' => 'Pegawai tidak tetap/honorer lain',
                        
                    ]),
                    Select::make('is_vokasi_ners')->label('Pendidikan Terakhir')
                        ->options([
                        'vokasi'=>'Vokasi',
                        'ners'=>'Ners',
                        ])->required(),
                    TextInput::make('asal_institusi_pendidikan_terakhir')->label('Asal Institusi Pendidikan Terakhir'),
                    DatePicker::make('kelulusan_tahun')->label('Kelulusan Tahun')->format('Y')->displayFormat('Y'),
                    DatePicker::make('tanggal_terbit_str')->label('Tanggal Terbit STR'),
                    DatePicker::make('tanggal_berakhir_masa_berlaku_str')->label('Tanggal Berakhir Masa Berlaku STR'),
                    Checkbox::make('berlaku_seumur_hidup')->label('Berlaku Seumur Hidup')->inline(),
                 
                    DatePicker::make('tanggal_terbit_sipp')->label('Tanggal Terbit SIPP'),
                    TextInput::make('jabatan_anda_saat_ini')->label('Jabatan Anda Saat Ini'),
                    Select::make('level_pk_anda_saat_ini')->label('Level PK Saat Ini')->options([
                        'Non PK/Belum Kredensial' => 'Non PK/Belum Kredensial',
                        'PK I' => 'PK I',
                        'PK II A' => 'PK II A',
                        'PK II B' => 'PK II B',
                        'PK II C' => 'PK II C',
                        'PK II D' => 'PK II D',
                        'PK III A' => 'PK III A',
                        'PK III B' => 'PK III B',
                        'PK III C' => 'PK III C',
                        'PK III D' => 'PK III D',
                        'PK IV A' => 'PK IV A',
                        'PK IV B' => 'PK IV B',
                        'PK IV C' => 'PK IV C',
                        'PK IV D' => 'PK IV D',
                        'PK V A' => 'PK V A',
                        'PK V B' => 'PK V B',
                        'PK V C' => 'PK V C',
                        'PK V D' => 'PK V D',
                        'PKSp A' => 'PKSp A',
                        'PKSp B' => 'PKSp B',
                    ]),
                    Select::make('level_pk_yang_diajukan')->label('Level PK yang diajukan')->options([
                        'Temporary' => 'Temporary',
                        'PK I' => 'PK I',
                        'PK II A' => 'PK II A',
                        'PK II B' => 'PK II B',
                        'PK II C' => 'PK II C',
                        'PK II D' => 'PK II D',
                        'PK III A' => 'PK III A',
                        'PK III B' => 'PK III B',
                        'PK III C' => 'PK III C',
                        'PK III D' => 'PK III D',
                        'PK IV A' => 'PK IV A',
                        'PK IV B' => 'PK IV B',
                        'PK IV C' => 'PK IV C',
                        'PK IV D' => 'PK IV D',
                        'PK V A' => 'PK V A',
                        'PK V B' => 'PK V B',
                        'PK V C' => 'PK V C',
                        'PK V D' => 'PK V D',
                        'PKSp A' => 'PKSp A',
                        'PKSp B' => 'PKSp B',
                    ]),
                    Select::make('level_perawat_manajer_saat_ini')->label('Level Perawat Manajer (Saat Ini)')->options([
                        'Non PM' => 'Non PM',
                        'PM I/Perawat Primer' => 'PM I/Perawat Primer',
                        'PM II/Kepala Ruangan atau Setara' => 'PM II/Kepala Ruangan atau Setara',
                        'PM III/Kepala Seksi atau Setara' => 'PM III/Kepala Seksi atau Setara',
                        'PM IV/Manajer atau Setara' => 'PM IV/Manajer atau Setara',
                        'PM V/Direktur atau Setara' => 'PM V/Direktur atau Setara',
                    ]),
                    
                    CheckboxList::make('orientasi')->label('Orientasi yang sudah diikuti dan dilampirkan buktinya dalam email (Jika Pelatihan Orientasi tergabung menjadi satu, lampirkan keterangan sertifikatnya)')
                        ->options([
                            'Pelatihan Sasaran Keselamatan Pasien (SKP)' => 'Pelatihan Sasaran Keselamatan Pasien (SKP)',
                            'Pelatihan Pencegahan dan Pengendalian Infeksi (PPI)' => 'Pelatihan Pencegahan dan Pengendalian Infeksi (PPI)',
                            'Pelatihan Komunikasi Efektif' => 'Pelatihan Komunikasi Efektif',
                            'Pelatihan Keselamatan Kerja Karyawan dan Lingkungan (K3L)' => 'Pelatihan Keselamatan Kerja Karyawan dan Lingkungan (K3L)',
                            'Bantuan Hidup Dasar (BHD)' => 'Bantuan Hidup Dasar (BHD)',
                            'Pelatihan Komunikasi efektif' => 'Pelatihan Komunikasi efektif',
                            'Pelatihan Dokumentasi menggunakan AFYA' => 'Pelatihan Dokumentasi menggunakan AFYA',
                        ]),
                    CheckboxList::make('cpd')->label('Continuing Professional Development (CPD) atau Pelatihan yang sudah diikuti dan dilampirkan buktinya dalam email')
                        ->options([
                            'Basic Cardian and Trauma Life Support (BTCLS)',
                            'Advanced Cardiac Life Support (ACLS)/Bantuan Hidup Lanjut (BLS)',
                            'Pelatihan Keterampilan ICU Dasar',
                            'Pelatihan Keterampilan ICU Lanjut',
                            'Pelatihan Keterampilan NICU Level 2/Level 3',
                            'Pelatihan Keterampilan PICU',
                            'Pelatihan Perawatan Luka',
                            'Pelatihan Keterampilan Kamar Bedah',
                            'Pelatihan Keterampilan Perawat Maternitas',
                        ]),
                    CheckboxList::make('cpd_pk_1')->label('CPD yang sudah diikuti untuk PK I (Boleh pilih lebih dari 1) Mengacu kepada PMK 40 Tahun 2020')
                        ->options([
                            '12 Core Competensi',
                            'Komunikasi Efektif',
                            'Caring',
                            'Etika Profesi',
                            'Keperawatan Bencana Basic',
                            'Keperawatan Gawat Darurat Dasar',
                            'Pencegahan dan Pengontrolan Infeksi',
                            'Sistem Informasi Keperawatan',
                        ]),
                    CheckboxList::make('cpd_pk_2')->label('CPD yang sudah diikuti untuk PK II (Boleh pilih lebih dari 1)')
                        ->options([
                            'Asuhan Keperawatan Umum',
                            'Pengelolaan Sistem Asuhan Keperawatan',
                            'Kerja Tim Keperawatan',
                            'Preceptorship',
                            'Pendidikan Kesehatan',
                            'Praktik Berbasis Bukti: diskusi refleksi kasus',
                            'Metodologi Riset Dasar (Deskriptif dan Survey)'
                        ]),
                    CheckboxList::make('cpd_pk_3')->label('CPD yang sudah diikuti untuk PK II dan atau PK III (Boleh pilih lebih dari 1)')
                        ->options([
                            'Asuhan Keperawatan pada Area Spesifik',
                            'Keperawatan Gawat Darurat Intermediate',
                            'Keperawatan Bencana Advance',
                            'Keperawatan Kritis Dasar',
                            'Pengelolaan Asuhan di Ruangan',
                            'Menerapkan agen pembaharu terkait asuhan melalui Evidence Based Practice',
                            'Audit Asuhan Keperawatan',
                            'Metode Mencari Akar Masalah/RCA',
                            'Manajemen Risiko Terkait Asuhan Keperawatan',
                            'Manajemen Konflik',
                            'Kolaborasi Intra dan Interdisiplin',
                            'Menyusun Satuan Pengajaran Pendidikan Kesehatan',
                            'Metodologi Riset lanjutan (Analitik dan Differensial)',
                        ]),
                    CheckboxList::make('cpd_pk_4')->label('CPD yang sudah diikuti untuk PK IV (Boleh pilih lebih dari 1)')
                        ->options([
                            'Asuhan Keperawatan Spesialistik',
                            'Keperawatan Gawat Darurat Advance',
                            'Keperawatan Kritis Advance',
                            'Keterampilan Klinis Spesialis',
                            'Nurse Clinical Case Management',
                            'Metodologi Pendidikan Kesehatan Sasaran Masalah Kompleks',
                            'Failure Mode and Effect Analysis (FMEA)',
                            'Praktik Berbasis Bukti Lanjutan',
                            'Teknik Penyusunan Jurnal'
                        ]),
                    CheckboxList::make('cpd_pk_5')->label('CPD yang sudah diikuti untuk PK V (Boleh pilih lebih dari 1)')
                        ->options([
                            'Asuhan Keperawatan Sub Spesialis',
                            'Keterampilan Klinis Sub spesialis',
                            'Manajemen Asuhan Keperawatan di RS',
                            'Manajemen Strategi Asuhan Keperawatan',
                            'Manajemen Konseling',
                            'Metodologi Pendidikan Kesehatan Sasaran Masyarakat Kompleks',
                            'Metodologi Riset Lanjut'
                        ]),
                    Select::make('program_mutu')->label('Apakah Anda pernah mengikuti Program Mutu, Pembahasan Kasus RCA atau FMEA ? Jika "Ya", Kirimkan bukti melalui email')
                        ->options([
                        'Ya',
                        'Tidak',
                        ]),
                    TextInput::make('ruangan'),
                    Select::make('user_id')
                        ->label('Akun Login')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()->required(),
                    Select::make('karu_id')
                        ->label('Kepala Ruangan')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()->required(),
                    Checkbox::make('setuju')->accepted()->inline()->label('Dengan ini Saya menyatakan bahwa data yang diisi adalah dibuat dengan sebenar-benarnya. Bukti sertifikat, logbook, penilaian kinerja  dan pengajuan ini telah disetujui oleh atasan saya.')
                ])
                ->columns(1)
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        $uid = DB::table('model_has_roles')->where(array('model_id'=>auth()->id()))->first();
        if($uid->role_id == 4){
            return parent::getEloquentQuery()->where('karu_id', auth()->id());
        }else if($uid->role_id == 3){
            return parent::getEloquentQuery()->where('user_id', auth()->id());
        }else{
            return parent::getEloquentQuery();
        }
        
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('namalengkap')->searchable(),
                Tables\Columns\TextColumn::make('status_kepegawaian')->searchable(),
                Tables\Columns\TextColumn::make('asal_institusi_pendidikan_terakhir')->searchable(),
                Tables\Columns\TextColumn::make('is_vokasi_ners')->searchable(),
                Tables\Columns\TextColumn::make('tanggal_terbit_str'),
                Tables\Columns\TextColumn::make('tanggal_berakhir_masa_berlaku_str'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ],position: ActionsPosition::BeforeColumns)
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
            'index' => Pages\ListProfilPerawats::route('/'),
            'create' => Pages\CreateProfilPerawat::route('/create'),
            'edit' => Pages\EditProfilPerawat::route('/{record}/edit'),
        ];
    }
}
