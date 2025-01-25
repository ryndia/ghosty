<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChirpResource\Pages;
use App\Filament\Resources\ChirpResource\RelationManagers;
use App\Models\Chirp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChirpResource extends Resource
{
    protected static ?string $model = Chirp::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('message'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListChirps::route('/'),
            'create' => Pages\CreateChirp::route('/create'),
            'view' => Pages\ViewChirp::route('/{record}'),
            'edit' => Pages\EditChirp::route('/{record}/edit'),
        ];
    }
}
