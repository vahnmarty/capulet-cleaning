<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use App\Models\Checklist;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Pages\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ChecklistResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChecklistResource\RelationManagers;
use App\Filament\Resources\ChecklistResource\Pages\ChecklistItems;
use App\Filament\Resources\ChecklistResource\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\ChecklistResource\RelationManagers\ServicesRelationManager;

class ChecklistResource extends Resource
{
    protected static ?string $model = Checklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('description')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('services_count')->counts('services')->label('Items'),
                Tables\Columns\TextColumn::make('completed_at')->dateTime(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('complete')
                    ->button()
                    ->color('success')
                    ->label('Mark as Complete')
                    ->visible(fn(Checklist $record) => $record->completed_at ? false : true)
                    ->action(fn (Checklist $record) => $record->markComplete())
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('checklists')
                    ->icon('heroicon-s-cog')
                    ->color('primary')
                    ->button()
                    ->mountUsing(fn (Forms\ComponentContainer $form, Checklist $record) => $form->fill([
                        'services' => []
                    ]))
                    ->action(function (Checklist $record, array $data): void {
                        // Leave blank, Automatic;
                    })
                    ->form([
                        Forms\Components\CheckboxList::make('services')
                            ->relationship('services', 'name')
                            ->required(),
                    ]),
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
    
    public static function getRelations(): array
    {
        return [
            ServicesRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChecklists::route('/'),
            'edit' => Pages\EditChecklist::route('/{record}/edit'),
        ];
    }
    
}
