<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\ProductStatusEnum;
use App\RolesEnum; // Added missing semicolon here
use Illuminate\Support\Str; // Import for slug generation
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        TextInput::make('title')
                            ->live(onBlur: true) // Ensure slug updates after title field loses focus
                            ->required()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state)); // Generate slug from the title
                            }),
                        TextInput::make('slug')
                            ->required(),
                        Select::make('department_id')
                            ->relationship('department', 'name') // Setup relationship
                            ->label(__('Department'))
                            ->preload()
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set) {
                                $set('category_id', null);
                            }),

                        Select::make('category_id')
                            ->relationship(
                                name: 'category',
                                titleAttribute: 'name',
                                modifyQueryUsing: function (Builder $query, callable $get) {
                                    $departmentId = $get('department_id'); // Fix missing semicolon here
                                    if ($departmentId) {
                                        $query->where('department_id', $departmentId); // Filter categories by department
                                    }
                                }
                            )
                            ->label(__('Category'))
                            ->preload()
                            ->searchable()
                            ->required(),
                    ]),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        'orderedList',
                        'unorderedList',
                        'quote',
                        'code',
                        'codeBlock',
                        'strike',
                        'subscript',
                        'superscript',
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'image',
                        'file',
                        'emoji',
                        'table',
                        'blockquote',
                        'clear',
                    ])
                    ->columnSpan(2),
                TextInput::make('price')
                    ->required()
                    ->numeric(), // Ensuring that price is a numeric input
                TextInput::make('quantity')
                    ->integer(), // Corrected typo here from inetregar() to integer()
                Select::make('status')
                    ->options(ProductStatusEnum::labels())
                    ->default(ProductStatusEnum::Draft->value)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->words(10)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors(ProductStatusEnum::colors()), // Fixed badge color usage
                Tables\Columns\TextColumn::make('department.name')
                    ->label(__('Department'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
            ])
            ->filters([ 
                selectFilter::make('status')
                ->options(ProductStatusEnum::labels()),
                selectFilter::make('department_id')
                ->relationship('department','name'),
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
            // Add relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        // Get the currently authenticated user
        $user = Filament::auth()->user();
    
        // Check if the user has the 'admin' role using RolesEnum
        return $user && $user->hasRole(RolesEnum::Vendor);
    }
}
