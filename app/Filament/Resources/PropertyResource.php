<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Property;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Livewire\TemporaryUploadedFile;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PropertyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Filament\Resources\PropertyResource\RelationManagers\BookingsRelationManager;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Heading')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('General')
                        ->schema([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('description'),
                            Forms\Components\TextInput::make('address1'),
                            Forms\Components\TextInput::make('address2'),
                            Forms\Components\TextInput::make('city'),
                            Forms\Components\TextInput::make('state'),
                            Forms\Components\TextInput::make('zip'),
                            Forms\Components\TextInput::make('contact_name'),
                            Forms\Components\TextInput::make('contact_phone'),
                            Forms\Components\TextInput::make('contact_email')->email(),
                            Forms\Components\TextInput::make('gate_code'),
                            Forms\Components\TextInput::make('door_code'),
                            Forms\Components\TextInput::make('notes'),
                            Forms\Components\TextInput::make('checklist_id'),
                        ])->columns(2),
                    Forms\Components\Tabs\Tab::make('Extra')
                        ->schema([
                            Forms\Components\TextInput::make('listing_title')->required(),
                            Forms\Components\TextInput::make('status'),
                            Forms\Components\TextInput::make('email2'),
                            Forms\Components\TextInput::make('preferred_contact_method'),
                            Forms\Components\TextInput::make('link'),
                            Forms\Components\TextInput::make('bedroom_count')->numeric(),
                            Forms\Components\TextInput::make('king_count')->numeric(),
                            Forms\Components\TextInput::make('queen_count')->numeric(),
                            Forms\Components\TextInput::make('twin_count')->numeric(),
                            Forms\Components\TextInput::make('full_count')->numeric(),
                            Forms\Components\TextInput::make('bunk_count')->numeric(),
                            Forms\Components\TextInput::make('bathrooms')->numeric(),
                            Forms\Components\TextInput::make('access_code'),
                            Forms\Components\TextInput::make('parking'),
                            Forms\Components\TextInput::make('alarm_code'),
                            Forms\Components\Toggle::make('sheets'),
                            Forms\Components\TextInput::make('trash_day'),
                            Forms\Components\TextInput::make('access_code'),
                            Forms\Components\TextInput::make('recycling'),
                            Forms\Components\TextInput::make('set_up_date'),
                            Forms\Components\TextInput::make('checkout_method'),
                            Forms\Components\TextInput::make('coffee_pot_type'),
                        ])->columns(2),
                    
                ])->columnSpan(2),
                SpatieMediaLibraryFileUpload::make('image')->collection('images')
                    ->image()
                    ->columnSpan(1),
                
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('bookings_count')->counts('bookings')
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            BookingsRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }  
      
}
