<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Models\Department;
use App\Models\User; // Import the User model
use Filament\Facades\Filament; // Correct import for Filament facade
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Resources\Resource;
use App\Filament\Resources\DepartmentResource\RelationManagers\CategoriesRelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn; // Correct namespace for TextColumn
use Illuminate\Support\Str; // Import for slug generation
use App\RolesEnum; // Make sure RolesEnum is properly imported

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->live(onBlur: true) // Ensures slug updates after the name field loses focus
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state)); // Generate slug from name
                    }),
                TextInput::make('slug')
                    ->required(),
                Checkbox::make('active'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name') // Correct namespace usage
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') // Sort descending by default
            ->filters([ 
                // Define any filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            CategoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        // Get the currently authenticated user
        $user = Filament::auth()->user();
    
        // Check if the user has the 'admin' role using RolesEnum
        return $user && $user->hasRole(RolesEnum::Admin);
    }
}
