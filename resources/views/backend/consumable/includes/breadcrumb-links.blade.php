<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.consumable.items.index')"
        {{--        TODO: add route here and change each page to use this links--}}
        :text="__('Consumable Items')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>

<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.consumable.types.index')"
        :text="__('Consumable Types')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>


{{--@if ($logged_in_user->hasAllAccess())--}}
{{--    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />--}}
{{--@endif--}}
