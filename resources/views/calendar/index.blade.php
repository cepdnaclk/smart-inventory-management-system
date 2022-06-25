<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schedule</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 
</head>
<body>

    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="title">
        <span id="titleError" class="text-danger"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="saveBtn" class="btn btn-primary">Save event</button>
      </div>
    </div>
  </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">Schedule Reservation</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
            var booking = @json($events);
            
            $('#calendar').fullCalendar({
                header: {
                    left:'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay'

                },
                events: booking,
                selectable: true,
                selectHelper: true,

                dayClick: function(date, jsEvent, view) {
                    if(view.name == 'month'){
                        $('#calendar').fullCalendar('gotoDate', date);
                        $('#calendar').fullCalendar('changeView', 'agendaDay');
                    }

                    
                },

                
                select: function(start, end, allDays, view){

                    if(view.name == 'agendaDay' || view.name == 'agendaWeek'){
                        $('#bookingModal').modal('toggle');
                    

                        $('#saveBtn').click(function(){
                            var title = $('#title').val();
                            var start_date = moment(start).format('YYYY-MM-DD HH:MM:SS');
                            var end_date = moment(end).format('YYYY-MM-DD HH:MM:SS');

                            //Send to the database
                            $.ajax({
                                url:"{{ route('calendar.store') }}",
                                type:"POST",
                                dataType:'json',
                                data:{ title, start_date, end_date  },
                                success:function(response)
                                {
                                    //console.log(response)
                                    $('#bookingModal').modal('hide')
                                    $('#calendar').fullCalendar('renderEvent', {
                                        'title': response.title,
                                        'start' : response.start,
                                        'end'  : response.end,
                                        'color' : response.color
                                    });

                                },
                                error:function(error)
                                {
                                    if(error.responseJSON.errors) {
                                        $('#titleError').html(error.responseJSON.errors.title);
                                    }
                                },
                            });
                        });
                    }else{
                        

                    }

                },


                editable: true,
                eventResize: function(event){
                     
                    var title = event.title;
                    var id = event.id;

                    var start_date = moment(event.start).format('YYYY-MM-DD HH:MM:SS');
                    var end_date = moment(event.end).format('YYYY-MM-DD HH:MM:SS');

                    $.ajax({
                        url: "{{ route('calendar.update', '') }}" +'/' + id,
                        type: "PATCH",
                        dataType: 'json', 
                        data: {
                            start_date,
                            end_date,
                        },
                        success: function(response){
                            $('#calendar').fullCalendar('refetchEvents', response);
                            swal("Done!", "Event Updated!", "success");
                        },
                        error:function(error)
                        {
                            // if(error.responseJSON.errors) {
                            //     $('#titleError').html(error.responseJSON.errors.title);
                            // }
                            console.log(error)
                        },
                    });

                },

                editable: true,
                eventDrop: function(event){
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD HH:MM:SS');
                    var end_date = moment(event.end).format('YYYY-MM-DD HH:MM:SS');

                    $.ajax({
                            url:"{{ route('calendar.update', '') }}" +'/' + id,
                            type:"PATCH",
                            dataType:'json',
                            data:{ start_date, end_date  },
                            success:function(response)
                            {
                                //calendar.fullCalendar('refetchEvents', response);
                                swal("Done!", "Event Updated!", "success");
                                // $('#bookingModal').modal('hide')
                                // $('#calendar').fullCalendar('renderEvent', {
                                //     'title': response.title,
                                //     'start' : response.start_date,
                                //     'end'  : response.end_date,
                                //    // 'color' : response.color
                                // });

                            },
                            error:function(error)
                            {
                                // if(error.responseJSON.errors) {
                                //     $('#titleError').html(error.responseJSON.errors.title);
                                // }
                                console.log(error)
                            },
                        });

                },    

                eventClick: function(event){
                    var id = event.id;
                    
                    if(confirm('Are you sure you want to delete this event?')){
                        $.ajax({
                            url:"{{ route('calendar.destroy', '') }}" +'/' + id,
                            type:"DELETE",
                            dataType:'json',
                            success:function(response)
                            {

                                // var id = response;
                                // console.log(id);
                                $('#calendar').fullCalendar('removeEvents', response);

                                swal("Done!", "Event Deleted!", "success");
                                // $('#bookingModal').modal('hide')
                                // $('#calendar').fullCalendar('renderEvent', {
                                //     'title': response.title,
                                //     'start' : response.start_date,
                                //     'end'  : response.end_date,
                                //    // 'color' : response.color
                                // });

                            },
                            error:function(error)
                            {
                                // if(error.responseJSON.errors) {
                                //     $('#titleError').html(error.responseJSON.errors.title);
                                // }
                                console.log(error)
                            },
                        });
                    }


                },
                //Not allowing to choose multiple events
                selectAllow: function(event){
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                }


            });

            $("#bookingModal").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
            });

            //css properties

            $('.fc-event').css('font-size', '14px');
            $('.fc-event').css('width', '20');
            $('.fc-event').css('border-radius', '50%');

        });
    </script>

</body>
</html>
