<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?int $navigationSort = 11;

    protected static ?string $navigationIcon = 'icon-partners';

    public static function getModelLabel(): string
    {
        return __('Member');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Members');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Member Information'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('name_ar')
                                ->label(__('Name (Arabic)'))
                                ->required(),
                            TextInput::make('name_en')
                                ->label(__('Name (English)'))
                                ->required(),
                        ])->columns(2),
                    Section::make(__('Role Information'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('role_ar')
                                ->label(__('Role (Arabic)'))
                                ->required(),
                            TextInput::make('role_en')
                                ->label(__('Role (English)'))
                                ->required(),
                        ])->columns(2),
                    Section::make(__('Sort Order Information'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('sort_order')
                                ->label(__('Sort Order'))
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ]),
                    Section::make(__('Images Information'))
                        ->description(__('This is the images information about the member.'))
                        ->collapsible(true)
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('image')
                                ->collection('members')
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
            ->emptyStateHeading(__('No Member Found'))
            ->emptyStateDescription(__('Try creating a new member.'))
            ->emptyStateIcon('icon-partners')
            ->striped()
            ->heading(__('Members'))
            ->description(__('List of members'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('Image'))
                    ->collection('members')
                    ->stacked()
                    ->square(),
                TextColumn::make('name_' . app()->getLocale())
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role_' . app()->getLocale())
                    ->label(__('Role'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label(__('Sort Order'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
