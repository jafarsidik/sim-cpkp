<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuKaruResource\Pages;
use App\Filament\Resources\BukuKaruResource\RelationManagers;
use App\Models\BukuKaru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Enums\ActionsPosition;

class BukuKaruResource extends Resource
{
    protected static ?string $model = BukuKaru::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Buku Karu';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('skp_code')->label('SKP Code')->required()
                            ->options([
                                'skp_1' => 'SKP 1',
                                'skp_2' => 'SKP 2',
                                'skp_3' => 'SKP 3',
                                'skp_4' => 'SKP 4',
                                'skp_5' => 'SKP 5',
                                'skp_6' => 'SKP 6',                                
                            ]),
                        TextInput::make('skp_title')->label('Kegiatan Identifikasi Pasien sesuai Logbook')->required(),
                        TextInput::make('kompetensi_inti')->label('Kompetensi Inti')->required(),
                        Textarea::make('skp_desc')->label('Penjelesan Kegiatan Identifikasi Pasien sesuai Logbook'),
                        Repeater::make('sub_kompetensi_dan_kode')->label('Sub Kompetensi & Kode')
                            ->schema([
                                
                                Checkbox::make('is_d')->label('Ini Adalah Diagnosis?'),
                                TextInput::make('detail_sub_kompetensi'),
                                Select::make('tingkat_kemapuan_vokasi')->label('Nilai Jawaban Tingkat Kemampuan Vokasi')
                                    ->options([
                                        '4' => '4',
                                        '3' => '3',  
                                        '3B' => '3B',
                                        '3A' => '3A',                                                                      
                                        '2' => '2', 
                                        '1' => '1',      
                                    ]),
                                Select::make('tingkat_kemapuan_ners')->label('Nilai Jawaban  Tingkat Kemampuan Ners')
                                    ->options([
                                        '4' => '4',
                                        '3' => '3',  
                                        '3B' => '3B',
                                        '3A' => '3A',                                                                      
                                        '2' => '2', 
                                        '1' => '1',                                                        
                                    ]),
                            ])
                            ->columns(2)
                        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('skp_code')->searchable()->label('SKP Code'),
                Tables\Columns\TextColumn::make('kompetensi_inti')->searchable()->label('Kompetensi Inti'),
                Tables\Columns\TextColumn::make('skp_title')->searchable()->label('Kegiatan Identifikasi Pasien'),
                
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
            'index' => Pages\ListBukuKarus::route('/'),
            'create' => Pages\CreateBukuKaru::route('/create'),
            'edit' => Pages\EditBukuKaru::route('/{record}/edit'),
        ];
    }
}
