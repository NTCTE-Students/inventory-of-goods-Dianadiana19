<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class SupplieeditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Создание товара';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            \Orchid\Screen\Actions\Button::make('Создать товар')
            ->icon('bs.save')
            ->method('saveSupply'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            \Orchid\Support\Facades\Layout::rows([
                \Orchid\Screen\Fields\Input::make('supply.name')
                    ->title('Название')
                    ->required(),
                \Orchid\Screen\Fields\Input::make('supply.description')
                    ->title('Описание')
                    ->require()
                    ->rows(5),
                \Orchid\Screen\Fields\Input::make('supply.price')
                    ->title('Цена (в копейках)')
                    ->require(),
                \Orchid\Screen\Fields\Input::make('supply.amount')    
                    ->title('Количество')
                    ->require()
                    ->type('number'),
            ]),
        ];
    }

    public function saveSupply()
    {
        \App\Models\Supply::create(request() -> input('supply'));

        \Orchid\Support\Facades\Toast::success('Товар создан');
    }
}
