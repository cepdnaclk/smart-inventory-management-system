<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.consumable.items.index')"
        :text="__('Consumable Items')"
></x-utils.link>

<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.consumable.types.index')"
        :text="__('Consumable Types')"
></x-utils.link>


{{--@if ($logged_in_user->hasAllAccess())--}}
{{--    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />--}}
{{--@endif--}}
