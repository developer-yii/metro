<x-mail::message>
# Offer Price Changed

Offer price changed for follwing product from €{{ $oldPrice }} to €{{ $newPrice }}.

<h4>{{ $offerName }}</h4>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
