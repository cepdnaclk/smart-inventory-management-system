
<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.equipments.items.index')"
        :text="__('Equipment Items')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>

<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.equipments.types.index')"
        :text="__('Equipment Types')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>



{{--@if ($logged_in_user->hasAllAccess())--}}
{{--    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />--}}
{{--@endif--}}
