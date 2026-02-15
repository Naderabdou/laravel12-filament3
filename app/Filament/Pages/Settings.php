<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;

class Settings extends SettingsPage
{
    protected static string $settings = GeneralSettings::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?int $navigationSort = 7;

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('Settings');
    }

    public function getTitle(): string
    {
        return __('Settings');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Settings')
                ->tabs([
                    // General Info
                    Tabs\Tab::make(__('General'))
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            TextInput::make('site_name_ar')->label(__('Site Name (Arabic)'))->required(),
                            TextInput::make('site_name_en')->label(__('Site Name (English)'))->required(),
                            FileUpload::make('logo')->label(__('Logo'))->image()->disk('public')->directory('settings')->required(),
                            FileUpload::make('logo_footer')->label(__('Footer Logo'))->image()->disk('public')->directory('settings')->required(),
                            FileUpload::make('favicon')->label(__('Favicon'))->image()->disk('public')->directory('settings')->required(),
                        ])->columns(2),

                    // Default Section
                    Tabs\Tab::make(__('Default'))
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            TextInput::make('title_default_ar')->label(__('Title Arabic'))->required(),
                            TextInput::make('title_default_en')->label(__('Title English'))->required(),
                            RichEditor::make('desc_default_ar')->label(__('Description Arabic'))->required(),
                            RichEditor::make('desc_default_en')->label(__('Description English'))->required(),
                        ])->columns(2),

                    // Hero Section
                    // Tabs\Tab::make(__('Hero'))
                    //     ->icon('heroicon-o-image')
                    //     ->schema([
                    //         FileUpload::make('hero_image')->label(__('Hero Image'))->image()->disk('public')->directory('settings')->required(),
                    //         TextInput::make('hero_span_ar')->label(__('Span Arabic'))->required(),
                    //         TextInput::make('hero_span_en')->label(__('Span English'))->required(),
                    //         TextInput::make('hero_title_one_ar')->label(__('Title One Arabic'))->required(),
                    //         TextInput::make('hero_title_one_en')->label(__('Title One English'))->required(),
                    //         TextInput::make('hero_title_two_ar')->label(__('Title Two Arabic'))->required(),
                    //         TextInput::make('hero_title_two_en')->label(__('Title Two English'))->required(),
                    //         RichEditor::make('hero_desc_ar')->label(__('Hero Description Arabic'))->required(),
                    //         RichEditor::make('hero_desc_en')->label(__('Hero Description English'))->required(),
                    //     ])->columns(2),

                    // About Section
                    Tabs\Tab::make(__('About'))
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TextInput::make('title_about_ar')->label(__('Title Arabic'))->required(),
                            TextInput::make('title_about_en')->label(__('Title English'))->required(),
                            RichEditor::make('desc_about_ar')->label(__('Description Arabic'))->required(),
                            RichEditor::make('desc_about_en')->label(__('Description English'))->required(),
                            FileUpload::make('image_about_one')->label(__('Image One'))->image()->disk('public')->directory('settings'),
                            FileUpload::make('image_about_two')->label(__('Image Two'))->image()->disk('public')->directory('settings'),
                            FileUpload::make('image_about_three')->label(__('Image Three'))->image()->disk('public')->directory('settings'),
                            TextInput::make('about_years')->label(__('Established Year'))->required(),
                            TextInput::make('our_value_ar')->label(__('Our Values Arabic'))->required(),
                            TextInput::make('our_value_en')->label(__('Our Values English'))->required(),
                            RichEditor::make('vision_ar')->label(__('Vision Arabic'))->required(),
                            RichEditor::make('vision_en')->label(__('Vision English'))->required(),
                            RichEditor::make('goals_ar')->label(__('Goals Arabic'))->required(),
                            RichEditor::make('goals_en')->label(__('Goals English'))->required(),
                            TextInput::make('des_goals_one_ar')->label(__('Goal 1 Description Arabic'))->required(),
                            TextInput::make('title_goals_one_ar')->label(__('Goal 1 Title Arabic'))->required(),
                            TextInput::make('des_goals_one_en')->label(__('Goal 1 Description English'))->required(),
                            TextInput::make('title_goals_one_en')->label(__('Goal 1 Title English'))->required(),
                            TextInput::make('des_goals_two_ar')->label(__('Goal 2 Description Arabic'))->required(),
                            TextInput::make('title_goals_two_ar')->label(__('Goal 2 Title Arabic'))->required(),
                            TextInput::make('des_goals_two_en')->label(__('Goal 2 Description English'))->required(),
                            TextInput::make('title_goals_two_en')->label(__('Goal 2 Title English'))->required(),
                            TextInput::make('des_goals_three_ar')->label(__('Goal 3 Description Arabic'))->required(),
                            TextInput::make('title_goals_three_ar')->label(__('Goal 3 Title Arabic'))->required(),
                            TextInput::make('des_goals_three_en')->label(__('Goal 3 Description English'))->required(),
                            TextInput::make('title_goals_three_en')->label(__('Goal 3 Title English'))->required(),
                            TextInput::make('des_goals_four_ar')->label(__('Goal 4 Description Arabic'))->required(),
                            TextInput::make('title_goals_four_ar')->label(__('Goal 4 Title Arabic'))->required(),
                            TextInput::make('des_goals_four_en')->label(__('Goal 4 Description English'))->required(),
                            TextInput::make('title_goals_four_en')->label(__('Goal 4 Title English'))->required(),
                        ])->columns(2),

                    // Blog, FAQ, News Tabs (مثال واحد)
                    Tabs\Tab::make(__('Blog'))
                        ->icon('heroicon-o-newspaper')
                        ->schema([
                            TextInput::make('blog_title_ar')->label(__('Title Arabic'))->required(),
                            TextInput::make('blog_title_en')->label(__('Title English'))->required(),
                            RichEditor::make('blog_desc_ar')->label(__('Description Arabic'))->required(),
                            RichEditor::make('blog_desc_en')->label(__('Description English'))->required(),
                        ])->columns(2),

                    Tabs\Tab::make(__('FAQ'))
                        ->icon('heroicon-o-question-mark-circle')
                        ->schema([
                            TextInput::make('faq_title_ar')->label(__('Title Arabic'))->required(),
                            TextInput::make('faq_title_en')->label(__('Title English'))->required(),
                            RichEditor::make('faq_desc_ar')->label(__('Description Arabic'))->required(),
                            RichEditor::make('faq_desc_en')->label(__('Description English'))->required(),
                        ])->columns(2),

                    Tabs\Tab::make(__('News'))
                        ->icon('heroicon-o-bell')
                        ->schema([
                            TextInput::make('news_title_ar')->label(__('Title Arabic'))->required(),
                            TextInput::make('news_title_en')->label(__('Title English'))->required(),
                            RichEditor::make('news_desc_ar')->label(__('Description Arabic'))->required(),
                            RichEditor::make('news_desc_en')->label(__('Description English'))->required(),
                        ])->columns(2),

                    // Contact Section
                    Tabs\Tab::make(__('Contact'))
                        ->icon('heroicon-o-phone')
                        ->schema([
                            TextInput::make('email')->label(__('Email'))->email()->required(),
                            TextInput::make('phone')->label(__('Phone'))->required(),
                            TextInput::make('whatsapp')->label(__('Whatsapp'))->required(),
                            TextInput::make('facebook')->label(__('Facebook'))->required(),
                            TextInput::make('twitter')->label(__('Twitter'))->required(),
                            TextInput::make('linkedin')->label(__('LinkedIn'))->required(),
                            TextInput::make('instagram')->label(__('Instagram'))->required(),
                            TextInput::make('appStore')->label(__('App Store'))->required(),
                            TextInput::make('googlePlay')->label(__('Google Play'))->required(),
                            TextInput::make('address')->label(__('Address'))->required()->columnSpanFull(),
                            Map::make('location')->hiddenLabel()->columnSpanFull()->defaultZoom(5)->height('400px'),
                        ])->columns(2),

                    // Footer Section
                    Tabs\Tab::make(__('Footer'))
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            RichEditor::make('footer_desc_ar')->label(__('Footer Description Arabic'))->required(),
                            RichEditor::make('footer_desc_en')->label(__('Footer Description English'))->required(),
                            TextInput::make('footer_copyright_ar')->label(__('Copyright Arabic'))->required(),
                            TextInput::make('footer_copyright_en')->label(__('Copyright English'))->required(),
                            FileUpload::make('footer_image')->label(__('Footer Image'))->image()->disk('public')->directory('settings'),
                        ])->columns(2),
                ]),
        ])->columns(1);
    }
}
