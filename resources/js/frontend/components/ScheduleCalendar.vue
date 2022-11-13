<script>

import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction';

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarPlugins: [dayGridPlugin, interactionPlugin]
        }
    }
}

</script>

<template>
    <FullCalendar defaultView="dayGridMonth" :plugins="calendarPlugins" />
</template>