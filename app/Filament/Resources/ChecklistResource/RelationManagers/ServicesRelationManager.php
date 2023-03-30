<?php

namespace App\Filament\Resources\ChecklistResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use App\Models\Checklist;
use Filament\Resources\Form;
use App\Models\ChecklistItem;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'services';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->columnSpan(2)
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('completed_at')
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('completed_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Add item to this Checklist'),
            ])
            ->actions([
                Tables\Actions\Action::make('complete')
                    ->button()
                    ->color('success')
                    ->label('Mark as Complete')
                    ->visible(fn(Service $record) => $record->completed_at ? false : true)
                    ->action(function($record){
                        $record->completed_at = now();
                        $record->save();
                    }),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
