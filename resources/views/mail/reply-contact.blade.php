<x-mail::message>

    <div style="text-align: center;">
        <a target="__blank" href="/">
            <img src="{{ asset('storage/' . getSetting('logo')) }}" alt="Logo" style="width: 100px; height: 100px;">
        </a>
    </div>
    <h1 style="text-align: center;">الرد من خلال موقع {{ getSetting('site_name', app()->getLocale()) }}</h1>
    <x-mail::panel>
        <p style="font-size: 16px; color: #333;">{{ $data['reply'] }}</p>
    </x-mail::panel>
</x-mail::message>
