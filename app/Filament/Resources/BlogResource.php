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
use App\Filament\Resources\BlogResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;


class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'icon-blogger';
    protected static ?int $navigationSort = 2;


    public static function getModelLabel(): string
    {
        return __('Blog');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Blogs');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Blog Information'))
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
                                ->collection(BlogType::BLOG->value)
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
            ->emptyStateHeading(__('No Blogs Found'))
            ->emptyStateDescription(__('Try creating a new blog.'))
            ->emptyStateIcon('icon-blogger')
            ->striped()
            ->heading(__('Blogs'))
            ->description(__('Blogs are the main content of the website.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('type', BlogType::BLOG)->latest('created_at');
            })
            ->columns([

                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('Image'))
                    ->circular()
                    ->collection(BlogType::BLOG->value)
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



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
