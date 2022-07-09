
<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.reservation.index')"
        :text="__('Reservations')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>


<x-utils.link
        class="c-subheader-nav-link"
        :href="route('admin.reservation.user.index')"
        :text="__('Reservation User')"
        {{--    permission="admin.access.user.reactivate"--}}
></x-utils.link>