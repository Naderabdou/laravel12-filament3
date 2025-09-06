<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Provider;
use Filament\Tables\Table;
use App\Models\UserSubscription;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class DisplayUserSubscriptionProvider extends Component  implements HasForms, HasTable
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
            ->emptyStateHeading(__('No User Subscriptions Found'))
            ->emptyStateIcon('icon-orders')
            ->heading(__('User Subscriptions'))
            ->description(__('List of user subscriptions for this provider'))
            ->striped()
            ->query(UserSubscription::query()->where('provider_id', $this->record->id))
            ->columns([
                TextColumn::make('order_number')
                    ->label(__('رقم الاشتراك'))
                    ->sortable(),

                TextColumn::make('provider.name')
                    ->label(__('اسم المزود'))
                    ->sortable(),
                TextColumn::make('package.name')
                    ->label(__('اسم الباقة'))
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label(__('حالة الدفع'))
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label(__('طريقة الدفع'))
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label(__('تاريخ البدء'))
                    ->formatStateUsing(fn($record) => Carbon::parse($record->start_date)->format('Y-m-d'))
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label(__('تاريخ الانتهاء'))
                    ->formatStateUsing(fn($record) => Carbon::parse($record->end_date)->format('Y-m-d'))
                    ->sortable(),

                TextColumn::make('total_price')
                    ->label(__('السعر الكلي'))
                    ->sortable(),


            ])
        ;
    }
    public function render()
    {
        return view('livewire.display-user-subscription-provider');
    }
}
