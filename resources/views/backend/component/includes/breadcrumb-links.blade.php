
<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.component.items.index')"
        :text="__('Component Items')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>

<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.component.types.index')"
        :text="__('Component Types')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>



{{--@if ($logged_in_user->hasAllAccess())--}}
{{--    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />--}}
{{--@endif--}}
