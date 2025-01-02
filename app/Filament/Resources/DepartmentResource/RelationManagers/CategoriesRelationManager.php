<?php
namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use App\Models\Category; 
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Checkbox; // Corrected import for Checkbox
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories'; // Relationship defined in the Department model

    public function form(Form $form): Form
    {
        $department = $this->getOwnerRecord(); // Get the department instance

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('parent_id')
                    ->label('Parent Category') 
                    ->options(function() use ($department) {
                        return Category::query()
                            ->where('department_id', $department->id)
                            ->pluck('name', 'id') 
                            ->toArray(); 
                    })
                    ->label('Parent Category')
                    ->searchable()
                    ->preload(),
                Checkbox::make('active') // Correct Checkbox component usage
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('active')
                ->boolean()
            ])
            ->filters([ 
                // You can add filters here if needed
            ])
            ->headerActions([ // This is where you enable the "Create" button
                Tables\Actions\CreateAction::make(),
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
}
