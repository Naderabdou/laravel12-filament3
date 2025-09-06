<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Onboarding;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OnboardingResource\Pages;

class OnboardingResource extends Resource
{
    protected static ?string $model = Onboarding::class;
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'icon-slideshow';





    public static function getModelLabel(): string
    {
        return __('Onboarding');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Onboarding');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Onboarding Information'))
                        ->description(__('This is the main information about the onboarding.'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('title_ar')
                                ->label(__('name_ar'))
                                ->minLength(3)
                                ->maxLength(255)
                                ->autofocus()
                                ->string()
                                ->required(),

                            TextInput::make('title_en')
                                ->required()
                                ->string()
                                ->label(__('name_en'))
                                ->minLength(3)
                                ->maxLength(255)

                                ->autofocus(),



                        ])->columns(2),


                    Section::make(__('Description Information'))
                        ->description(__('This is the description information about the onboarding.'))
                        ->collapsible(true)

                        ->schema([
                            Textarea::make('desc_ar')
                                ->label(__('desc_ar'))
                                ->minLength(3)
                                ->autofocus()

                                ->rows(5)
                                ->required(),


                            Textarea::make('desc_en')
                                ->label(__('desc_en'))
                                ->minLength(3)
                                ->autofocus()

                                ->rows(5)
                                ->required(),
                        ])->columns(2),

                    Section::make(__('Images Information'))
                        ->description(__('This is the images information'))
                        ->collapsible(true)

                        ->schema([



                            FileUpload::make('image')
                                ->required()
                                ->label(__('image'))
                                ->disk('public')->directory('onboardings')
                                ->columnSpanFull()
                                ->reorderable()
                                ->image()
                                ->circleCropper()
                                ->maxSize(10048)
                        ]),




                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                ImageColumn::make('image')
                    ->label(__('image'))
                    ->circular()
                    ->stacked(),
                TextColumn::make('title_' . app()->getLocale())
                    ->label(__('title'))

                    ->searchable()
                    ->sortable(),

                TextColumn::make('desc_' . app()->getLocale())
                    ->label(__('desc'))
                    ->wrap()
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn () => !auth()->user()->can('delete_onboarding')),
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
            'index' => Pages\ListOnboardings::route('/'),
            'create' => Pages\CreateOnboarding::route('/create'),
            'edit' => Pages\EditOnboarding::route('/{record}/edit'),
        ];
    }
}
