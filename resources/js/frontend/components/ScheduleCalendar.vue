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
        createReservation(event){
            const moment = require('moment');

            console.log("create: ", event);

            const start_date = moment(event.startStr);
            const end_date = moment(event.endStr);
            const duration = moment.duration(end_date.diff(start_date)).asMinutes();

            this.startTime = start_date.format("hh:mm A");
            this.endTime = end_date.format("hh:mm A");

            if (duration > this.maxSlotDuration){
                alert(`Maximum scheduling duration is ${this.maxSlotDuration} minutes !`);
                return false;
            }

            // TODO: Avoid some tmie intervals like Nights and Mornings
             
            if (event.view.type == "timeGridWeek") {
                this.$bvModal.show('schedule-modal')
            }

            //    if ((view.name === 'agendaDay' || view.name === 'agendaWeek') && (!isAnOverlapEvent(start, end))) {

            //     $('#bookingModal').modal('toggle');
            //     $('#saveBtn').click(function () {
            //         var title = $('#title').val();
            //         var start_date = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
            //         var end_date = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
            //         var loggedIn = @json($userLoggedin);
            //         var user = loggedIn['email'];
            //         var begin = moment(start).format('YYYY-MM-DD');

            //         // console.log(start, end);
            //         console.log(start_date, end_date);

            //         // count hours
            //         const date1 = new Date(start_date);
            //         const date2 = new Date(end_date);

            //         var ms = date2.getTime() - date1.getTime();
            //         var d = moment.duration(ms);
            //         var m = d.asMinutes();

            //         const time_limit = 300;

            //         console.log(ms, d, m);

            //         // TODO: Validate the E Numbers

            //         //Send to the database
            //         if (m < time_limit) {  //limit maximum time
            //             $.ajax({
            //                 url: "{{ route('frontend.calendar.store') }}",
            //                 type: "POST",
            //                 dataType: 'json',
            //                 data: { title, start_date, end_date, begin, m },
            //                 success: function (response) {

            //                     //fill the calendar when event is entered instantaneously
            //                     $('#bookingModal').modal('hide')
            //                     $('#calendar').fullCalendar('renderEvent', {
            //                         'title': response.title,
            //                         'start': response.start,
            //                         'end': response.end,
            //                         'color': response.color,
            //                         'auth': response.auth,
            //                     });
            //                     swal("Done!", "Event Created!", "success");

            //                     // TODO: This is a temporary fix. Find a better way to this
            //                     refreshPage();
            //                 },
            //                 error: function (error) {
            //                     if (error.responseJSON.errors) {
            //                         $('#titleError').html(error.responseJSON.errors.title);
            //                     } else {
            //                         $('#bookingModal').modal('hide')
            //                         swal("Denied!", "Can not make multiple reservations in a day!", "warning");
            //                     }
            //                     console.log(error);
            //                 },
            //             });
            //         } else {
            //             swal("Permission Denied!", "You can not exceed 4 hours!", "warning");
            //         }
            //     });
            // }
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
        },
        showModal() {
            this.$refs['schedule-modal'].show()
        },
        hideModal() {
            this.$refs[''].hide()
        },
        setupEvent(bvModalEvent){
            console.log("Creating....");
            const {startTime, endTime, eNumbers, description} = this;

            axios.get('/sanctum/csrf-cookie').then(response => {
                // console.log(response);
                axios.post(`${this.baseURL}/reservations/${this.stationId}/`,
                    { startTime, endTime, eNumbers, description })
                    .then(response => {
                        const data = response.data;

                        if (response.status == 200){
                            this.$bvModal.hide('schedule-modal');
                            console.log(data);
                        }else{
                            console.log(response.status, response.statusText);
                        }
                    });
            });

            
        }
    },
    data() {
        return {
            baseURL: '',
            startTime: "",
            endTime: "",
            eNumbers: "",
            description: "",
            maxSlotDuration: 300,
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
                
                select: this.createReservation,
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
    <FullCalendar :options="calendarOptions"/>

    <div>
       <b-modal id="schedule-modal" title="Create a schedule" centered @ok="setupEvent">
              <b-form-group
                 id="inputGroup-startTime"
                 label="Schedule start at"
                 label-for="input_Start"
                 >
                 <b-form-input id="input_Start" v-model="startTime" readonly ></b-form-input>
              </b-form-group>

                  <b-form-group
                     id="inputGroup-endTime"
                     label="Schedule end at"
                     label-for="input_End"
                     >
                     <b-form-input id="input_End" v-model="endTime" readonly ></b-form-input>
                  </b-form-group>

        <b-form-group
             id="inputGroup-Enumbers"
             label="Enter your/your group members' E-numbers (comma separated)"
             label-for="input_Enumbers"
             description=""
             >
             <b-form-input id="input_Enumbers" v-model="eNumbers" placeholder="E/YY/XXX, E/YY/XXX, ..." required></b-form-input>
          </b-form-group>
          <b-form-group
             id="inputGroup-Description"
             label="Reservation description"
             label-for="input_description"
             description=""
             >
             <b-form-textarea
                id="input_description"
                v-model="description"
                rows="3"
                ></b-form-textarea>
          </b-form-group>
       </b-modal>
    </div>
    
    </div>
</template>