
<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.station.index')"
        :text="__('Stations')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>




{{--@if ($logged_in_user->hasAllAccess())--}}
{{--    <x-utils.link class="c-subheader-nav-link" :href="route('admin.auth.user.deleted')" :text="__('Deleted Users')" />--}}
{{--@endif--}}
