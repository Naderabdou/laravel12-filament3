<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use App\Models\Document;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'icon-app';

    protected static ?int $navigationSort = 2;


    // }
    public static function getModelLabel(): string
    {
        return __('Category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Categories');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Category Information'))
                        ->description(__('This is the main information about the category.'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('name_ar')
                                ->label(__('name_ar'))
                                ->minLength(3)
                                ->regex('/^[\p{Arabic}\p{N}\s]+$/u')
                                ->maxLength(255)
                                ->unique(ignoreRecord: true)
                                ->autofocus()
                                ->required(),

                            TextInput::make('name_en')
                                ->label(__('name_en'))
                                ->minLength(3)
                                ->maxLength(255)
                                ->regex('/^[a-zA-Z0-9\s]+$/u')
                                ->unique(ignoreRecord: true)
                                ->autofocus()
                                ->required(),

                            FileUpload::make('icon')
                                ->required()
                                ->label(__('Icon'))
                                ->disk('public')->directory('categories')
                                ->columnSpanFull()
                                ->reorderable()
                                ->image()
                                ->circleCropper()
                                ->maxSize(2048),


                            Repeater::make('activities')
                                ->label(__('Activities'))
                                ->relationship()
                                ->grid(2)


                                ->collapsible()
                                ->addActionLabel(__('Add Activity'))
                                ->schema([
                                    TextInput::make('name_ar')
                                        ->label(__('name_ar'))
                                        ->minLength(3)
                                        ->unique(ignoreRecord: true)
                                        ->regex('/^[\p{Arabic}\p{N}\s]+$/u')
                                        ->maxLength(255)
                                        ->required(),
                                    TextInput::make('name_en')
                                        ->label(__('name_en'))
                                        ->minLength(3)
                                        ->unique(ignoreRecord: true)
                                        ->regex('/^[a-zA-Z0-9\s]+$/u')
                                        ->maxLength(255)
                                        ->required(),

                                ])->columns(2),




                        ])->columns(1),




                ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table

            ->emptyStateHeading(__('No Categories Found'))
            ->emptyStateDescription(__('Start by creating a new Category.'))
            ->emptyStateIcon('icon-app')
            ->striped()
            ->heading(__('Categories'))
            ->description(__('Categories are the main categories of the application.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([

                ImageColumn::make('icon')
                    ->label(__('Icon'))
                    ->circular()
                    ->stacked(),

                Tables\Columns\TextColumn::make('name_' . app()->getLocale())
                    ->label(__('name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('activities.name_' . app()->getLocale())
                    ->label(__('Activity Name'))
                    ->searchable()
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->sortable(),




                TextColumn::make('activities_count')->counts('activities')
                    ->badge()
                    ->label(__('Activities Count')),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),


                ])
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
