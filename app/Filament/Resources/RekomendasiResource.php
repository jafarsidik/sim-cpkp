<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RekomendasiResource\Pages;
use App\Filament\Resources\RekomendasiResource\RelationManagers;
use App\Models\Rekomendasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Forms\Components\CheckboxList;


class RekomendasiResource extends Resource
{
    protected static ?string $model = Rekomendasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        
                        
                        Select::make('feedback')->label('Feedback')->required()
                            ->options([
                                'perbaiki' => 'Perbaiki',
                                'tingkatkan' => 'Tingkatkan',
                                                          
                            ]),
                        TextInput::make('status_pelaporan')->label('Status Pelaporan')->readonly(),
                        Textarea::make('rekomendasi')->label('Kesimpulan')->required(),
                        TextInput::make('penilaian_rekomendasi.skp_1')->label('Penilaian Rekomendasi SKP 1')->readonly(),                        
                        TextInput::make('penilaian_rekomendasi.skp_2')->label('Penilaian Rekomendasi SKP 2')->readonly(),                        
                        TextInput::make('penilaian_rekomendasi.skp_3')->label('Penilaian Rekomendasi SKP 3')->readonly(),                        
                        TextInput::make('penilaian_rekomendasi.skp_4')->label('Penilaian Rekomendasi SKP 4')->readonly(),                        
                        TextInput::make('penilaian_rekomendasi.skp_5')->label('Penilaian Rekomendasi SKP 5')->readonly(),                        
                        TextInput::make('penilaian_rekomendasi.skp_6')->label('Penilaian Rekomendasi SKP 6')->readonly(),                        
                        
                    ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('perawat_id'),
                //Tables\Columns\TextColumn::make('simpulan'),
                Tables\Columns\TextColumn::make('rekomendasi'),
                //Tables\Columns\TextColumn::make('bidper_auth_id'),
                //Tables\Columns\TextColumn::make('bidper_date_auth_id'),
                //Tables\Columns\TextColumn::make('penilaian_rekomendasi'),
                Tables\Columns\TextColumn::make('feedback'),
                Tables\Columns\TextColumn::make('status_pelaporan'),
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
            'index' => Pages\ListRekomendasis::route('/'),
            'create' => Pages\CreateRekomendasi::route('/create'),
            'edit' => Pages\EditRekomendasi::route('/{record}/edit'),
        ];
    }
}
