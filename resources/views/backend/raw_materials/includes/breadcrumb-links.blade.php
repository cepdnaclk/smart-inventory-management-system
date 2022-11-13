
<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.machines.index')"
        :text="__('Machines')"
></x-utils.link>

{{--@if ($logged_in_user->hasAllAccess())--}}
{{--    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />--}}
{{--@endif--}}
