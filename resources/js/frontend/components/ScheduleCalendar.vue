<script>

import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction';
import axios from "axios";

export default {
    components: {
        FullCalendar
    },
    props: ['stationId','userId'],
    mounted(){
        this.getEvents();
        console.log("StationId", this.stationId);
        console.log("UserId", this.userId);
    },
    methods: {
        getEvents () {
            axios.get('/sanctum/csrf-cookie').then(response => {
                console.log(response);
                axios.get(`${this.baseURL}/reservations/${this.stationId}/`)
                    .then(response => {
                        const data = response.data;
                        console.log(data);

                        this.calendarOptions.events = data.map(data => {
                            const color = (data.auth == this.userId) ? '#435258' : '#3E9CC2';
                            return { ...data, color: color };
                        });
                    });
            });
        },
        createReservation(data){
            // TODO: Create a reservation
            console.log("create: ", data);

        },
        deleteReservation(data){
            console.log("delete: ", data);

            const event = data.event;
            if (event.extendedProps.auth === this.userId) {
                // TODO: Make a modal popup
                if (confirm('Are you sure you want to delete this event?')) {
                    axios.delete(`${this.baseURL}/reservations/${event.id}`)
                        .then((resp) => {
                            alert('Deleted');
                        })
                        .then( ()=>{
                            this.getEvents();
                        })
                        .catch((error) => {
                            alert(error.response.status);
                        });
                }
            } else {
                // TODO: Make a modal popup
                alert("Permission Denied!", "You can not delete this event!", "warning");
            }
        },
        updateReservation(data){
            // TODO: Update event
            console.log("update: ", data);
        }
    },
    data() {
        return {
            baseURL: '',
            calendarEvents: [],
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                initialView: 'timeGridWeek',

                events: this.calendarEvents,

                selectable: true,
                selectHelper: true,
                editable: true,
                eventOverlap: false,

                height: "auto",
                expandRows: true,

                allDaySlot: false,
                firstDay: 0, // 0: Sunday
                nowIndicator: true,

                slotMinTime:"08:00:00",
                slotMaxTime:"19:00:00",
                slotDuyration: "00:30:00",
                
                // dayClick: function (date, jsEvent, view) {  },
                // eventRender: function eventRender(event, element, view) { },
                
                select: function (event) {
                    
                    console.log("eventCreate: ", event);
                },

                eventResize: this.updateReservation,
                eventDrop: this.updateReservation,
                eventClick: this.deleteReservation,
                // selectAllow: function (event) {}
            }
        }
    }
}

</script>

<template>
    <div>
      Station:  {{ stationId }}
    <FullCalendar :options="calendarOptions" />
    </div>
</template>