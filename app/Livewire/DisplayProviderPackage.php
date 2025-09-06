<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Provider;
use App\Models\ProviderPackage;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;

class DisplayProviderPackage extends Component  implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public $record;

    public function mount($record)
    {
        $this->record = Provider::find($record->id);
    }
    public function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Provider Packages Found'))
            ->emptyStateIcon('icon-box')
            ->heading(__('Provider Packages'))
            ->description(__('List of packages offered by this provider'))
            ->striped()
            ->query(ProviderPackage::query()->where('provider_id', $this->record->id))
            ->columns([
                TextColumn::make('name')
                    ->label(__('اسم الباقة'))
                    ->sortable(),


                TextColumn::make('price')
                    ->label(__('سعر الباقة'))
                    ->sortable(),
                TextColumn::make('limit')
                    ->label(__('حد الاستخدام'))
                    ->sortable(),
                TextColumn::make('duration')
                    ->label(__('مدة الاشتراك'))
                    ->sortable(),
                TextColumn::make('type')
                    ->label(__('نوع الاشتراك'))
                    ->formatStateUsing(fn($record) => __($record->type))
                    ->sortable(),

                TextColumn::make('Club.name')
                    ->label(__('اسم النادي'))
                    ->sortable(),




            ])
            ->filters([
                SelectFilter::make('type')
                    ->label(__('نوع الاشتراك'))
                    ->options([
                        'monthly' => __('شهري'),
                        'yearly' => __('سنوي'),
                    ]),
                // SelectFilter::make('club_id')
                //     ->label(__('اسم النادي'))
                //     ->options(Club::all()->pluck('name', 'id')),

            ])
        ;
    }
    public function render()
    {
        return view('livewire.display-provider-package');
    }
}
