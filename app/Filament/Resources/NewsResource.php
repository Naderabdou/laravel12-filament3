<?php

namespace App\Filament\Resources;

use App\Models\Blog;
use Filament\Tables;
use App\Enums\BlogType;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NewsResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class NewsResource extends Resource
{
    protected static ?string $model = Blog::class;


    protected static ?string $navigationIcon = 'icon-blogger';
    protected static ?int $navigationSort = 3;


    public static function getModelLabel(): string
    {
        return __('News');
    }

    public static function getPluralModelLabel(): string
    {
        return __('News');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('News Information'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('name_ar')
                                ->label(__('Name (Arabic)'))
                                ->minLength(3)
                                ->maxLength(255)
                                ->required(),

                            TextInput::make('name_en')
                                ->required()
                                ->label(__('Name (English)'))
                                ->minLength(3)
                                ->maxLength(255)
                                ->autofocus(),

                        ])->columns(2),


                    Section::make(__('Description Information'))
                        ->collapsible(true)

                        ->schema([
                            Textarea::make('desc_ar')
                                ->label(__('Description (Arabic)'))
                                ->minLength(3)
                                ->rows(10)
                                ->cols(20)
                                ->required(),
                            Textarea::make('desc_en')
                                ->label(__('Description (English)'))
                                ->minLength(3)
                                ->rows(10)
                                ->cols(20)
                                ->required(),
                        ]),

                    Section::make(__('Images Information'))
                        ->collapsible(true)
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('image')
                                ->collection(BlogType::NEWS->value)
                                ->label(__('Image'))
                                ->disk('public')
                                ->image()
                                ->maxSize(10024)
                                ->columnSpanFull()
                                ->required(),
                        ]),




                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No News Found'))
            ->emptyStateDescription(__('Try creating a new news.'))
            ->emptyStateIcon('icon-news')
            ->striped()
            ->heading(__('News'))
            ->description(__('News are the main content of the website.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('type', BlogType::NEWS)->latest('created_at');
            })
            ->columns([

                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('Image'))
                    ->circular()
                    ->collection(BlogType::NEWS->value)
                    ->stacked(),
                TextColumn::make('name_' . app()->getLocale())
                    ->searchable()
                    ->label(__('Name')),
                TextColumn::make('desc_' . app()->getLocale())
                    ->searchable()
                    ->label(__('Description'))
                    ->wrap()
                    ->html()
                    ->words(50),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),

                ]),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
