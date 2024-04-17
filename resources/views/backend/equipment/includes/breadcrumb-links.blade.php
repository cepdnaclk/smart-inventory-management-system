
<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.equipment.items.index')"
        :text="__('Equipment Items')"
></x-utils.link>

<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.equipment.types.index')"
        :text="__('Equipment Types')"
></x-utils.link>



{{--@if ($logged_in_user->hasAllAccess())--}}
{{--    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />--}}
{{--@endif--}}
