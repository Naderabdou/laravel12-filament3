<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuestionResource\Pages;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'icon-question1';
    protected static ?int $navigationSort = 10;


    public static function getModelLabel(): string
    {
        return __('Question');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Questions');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Question Information'))
                        ->description(__('This is the main information about the question.'))
                        ->collapsible(true)
                        ->schema([

                            TextInput::make('question_ar')
                                ->label(__('question in Arabic'))
                                ->required()
                                ->autofocus()
                                ->maxLength(255),

                            Textarea::make('answer_ar')
                                ->label(__('answer in Arabic'))
                                ->required()
                                ->autofocus()
                                ->rows(10)
                                ->cols(20),

                            TextInput::make('question_en')
                                ->label(__('question in English'))
                                ->required()
                                ->autofocus()
                                ->maxLength(255),

                            Textarea::make('answer_en')
                                ->label(__('answer in English'))
                                ->required()
                                ->autofocus()
                                ->rows(10)
                                ->cols(20),


                        ])->columns(1),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Questions Found'))
            ->emptyStateDescription(__('Try creating a new question.'))
            ->emptyStateIcon('icon-questions')
            ->striped()
            ->heading(__('Questions'))
            ->description(__('Questions are the most common questions that users ask.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                TextColumn::make('question_' . app()->getLocale())
                    ->label(__('question'))
                    ->words(10),

                TextColumn::make('answer_' . app()->getLocale())
                    ->label(__('answer'))
                    ->words(9)
                    ->limit(50),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
