<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Filament\Tables\Table;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

class DisplayUserSubscription extends Component  implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public $record;

    public function mount($record)
    {


        $this->record = Customer::find($record->id);
    }
    public function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No User Subscriptions Found'))
            ->emptyStateIcon('icon-students')
            ->heading(__('User Subscriptions'))
            ->description(__('List of user subscriptions'))
            ->striped()
            ->query(UserSubscription::query()->where('user_id', $this->record->id))
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
        return view('livewire.display-user-subscription');
    }
}
