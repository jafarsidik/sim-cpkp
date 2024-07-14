<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SelfAssesmentResource\Pages;
use App\Filament\Resources\SelfAssesmentResource\RelationManagers;
use Illuminate\Support\Facades\DB;
use App\Models\SelfAssesment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Illuminate\Support\HtmlString;

class SelfAssesmentResource extends Resource
{
    protected static ?string $model = SelfAssesment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        
        $skp = DB::table('buku_karus')->select('skp_code')->groupBy('skp_code')->get();
        $skp_form = [];
        foreach($skp as $skp_val){
           
            $label_text_section = '';
            if($skp_val->skp_code == 'skp_1'){
                $label_text_section = 'SKP 1 (Mengidentifikasi pasien dengan benar)';
            }else if($skp_val->skp_code == 'skp_2'){
                $label_text_section = 'SKP 2 (Meningkatkan komunikasi yang efektif)';
            }else if($skp_val->skp_code == 'skp_3'){
                $label_text_section = 'SKP 3 (Meningkatkan keamanan obat-obatan yang harus diwaspadai)';
            }else if($skp_val->skp_code == 'skp_4'){
                $label_text_section = 'SKP 4 (Memastikan lokasi pembedahan yang benar, prosedur yang benar, pembedahan pada pasien yang benar)';
            }else if($skp_val->skp_code == 'skp_5'){
                $label_text_section = 'SKP 5 (Mengurangi resiko infeksi akibat perawatan kesehatan)';
            }else if($skp_val->skp_code == 'skp_6'){
                $label_text_section = 'SKP 6 (Mengurangi resiko cedera pasieb akibat terjatuh)';
            }

            $skp_form_fieldset = [];
            $skp_1 = DB::table('buku_karus')->where('skp_code',$skp_val->skp_code)->get();    
            foreach($skp_1 as $key=>$val){
                $skp_form_fieldset_detail = [];
                foreach(json_decode($val->sub_kompetensi_dan_kode) as $keys=>$detail){
                    if($detail->is_d == true){
                        //$is_d = ( ($detail->is_d == true) ? 'D':'K');
                        
                        $skp_form_fieldset_detail[] = Radio::make($skp_val->skp_code.'|D|'.$val->id.'|'.$keys)->label(new HtmlString("<span style='color:pink;'>".$detail->detail_sub_kompetensi."</span>"))
                        ->extraAttributes(['style' => 'background-color: pink; color: pink;'])
                        //->extraAttributes(['class'=>'fi-fo-field-wrp','style' => 'background-color: pink;'])
                        ->options([
                            '4' => '4',
                            '3B' => '3B',
                            '3A' => '3A',
                            '2' => '2',
                        ])->inline();
                    }else{
                        $skp_form_fieldset_detail[] = Radio::make($skp_val->skp_code.'|K|'.$val->id.'|'.$keys)->label(new HtmlString("&nbsp;&nbsp;&nbsp; ".$detail->detail_sub_kompetensi))
                        //->extraAttributes(['style' => 'background-color: ##FE00F3; color: ##FE00F3;'])
                        //->extraAttributes(['class'=>'fi-fo-field-wrp','style' => 'background-color: pink;'])
                        ->options([
                            '4' => '4',
                            '3' => '3',
                            '2' => '2',
                            '1' => '1',
                        ])->inline();
                    }
                    
                }
                $skp_form_fieldset[] = Fieldset::make($val->kompetensi_inti)->columns(1)->schema($skp_form_fieldset_detail);
            }
            $skp_form[] = Section::make($label_text_section)->schema($skp_form_fieldset)->collapsible()->collapsed();
        }
        
        return $form->schema($skp_form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_self_assesment'),
                Tables\Columns\TextColumn::make('perawat_id'),
                Tables\Columns\TextColumn::make('hasil'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
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
            'index' => Pages\CreateSelfAssesment::route('/'),
            //'create' => Pages\CreateSelfAssesment::route('/create'),
            //'edit' => Pages\EditSelfAssesment::route('/{record}/edit'),
        ];
    }
}
