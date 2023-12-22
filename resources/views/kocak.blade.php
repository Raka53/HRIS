<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Calendar js</title>
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

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View/Update Event</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <input type="text" id="eventId">
              <div class="mb-3">
                  <label for="title" class="form-label">Event Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Event Title">
                  <span id="titleError" class="text-danger"></span>
              </div>
              <div class="mb-3">
                  <label for="province" class="form-label">Province</label>
                  <select class="form-select" id="province">
                      <option value="1">Province 1</option>
                      <option value="2">Province 2</option>
                      <!-- Add more options as needed -->
                  </select>
              </div>
              <div class="mb-3">
                  <label for="rs" class="form-label">RS</label>
                  <select class="form-select" id="rs">
                      <option value="1">RS 1</option>
                      <option value="2">RS 2</option>
                      <!-- Add more options as needed -->
                  </select>
              </div>
              <div class="mb-3">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select" id="department">
                      <option value="1">Department 1</option>
                      <option value="2">Department 2</option>
                      <!-- Add more options as needed -->
                  </select>
              </div>
              <div class="mb-3">
                  <label for="task" class="form-label">Task</label>
                  <input type="text" class="form-control" id="task" placeholder="Task">
              </div>
              <div class="mb-3">
                  <label for="startDate" class="form-label">Start Date</label>
                  <input type="datetime-local" class="form-control" id="startDate" placeholder="Start Date">
              </div>
              <div class="mb-3">
                  <label for="endDate" class="form-label">End Date</label>
                  <input type="datetime-local" class="form-control" id="endDate" placeholder="End Date">
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="updateBtn" class="btn btn-primary">Update Event</button>
          </div>
      </div>
  </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>
            <div class="col-md-11 offset-1 mt-5 mb-5">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var booking = @json($events);

        $('#calendar').fullCalendar({
            header: {
                left: 'prev, next today',
                center: 'title',
                right: 'month, agendaWeek, agendaDay',
            },
            events: booking,
            selectable: true,
            selectHelper: true,
            editable: true, // Enable drag and drop
            eventResize: function (event, delta, revertFunc) {
                handleEventResize(event, delta, revertFunc);
            },
            eventDrop: function (event) {
                handleEventDrop(event);
            },
            eventClick: function (event) {
                openEventModal(event);
            },
            // Other calendar options...
        });

        // Function to handle event drop (drag and drop)
        function handleEventDrop(event) {
    var id = event.id;
    var title = event.title;  // Add this line to get the title of the dropped event
   var rs = event.rs;
   var province = event.province;
   var department = event.department;
   var task = event.task;

    var start_date = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
    var end_date = moment(event.end).format('YYYY-MM-DD HH:mm:ss');

    $.ajax({
        url: "{{ route('events.update', '') }}" + '/' + id,
        type: "PATCH",
        dataType: 'json',
        data: {
            id: id,
            title: title,  // Include the title in the data
            province: province,
        rs: rs,
        department: department,
        task: task,
            start_date: start_date,
            end_date: end_date
        },
        success: function (response) {
            swal("Data Sudah Terupdate", "Terimakasih", "success");
        },
        error: function (error) {
            console.log(error);

            // Revert the event if there's an error
            $('#calendar').fullCalendar('refetchEvents');

            swal("Error", "Failed to update event", "error");
        },
    });
}


        // Function to open event modal for viewing/updating
        function openEventModal(event) {
            $('#eventId').val(event.id);
            $('#title').val(event.title);
           $('#province').val(event.province);
            $('#rs').val(event.rs);
          $('#department').val(event.department);
           $('#task').val(event.task);
            $('#startDate').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
            $('#endDate').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));

            $('#eventModal').modal('toggle');
        }

        // Function to handle modal close and update event
        $('#updateBtn').click(function () {
            var id = $('#eventId').val();
            var title = $('#title').val();
            var province = $('#province').val();
            var rs = $('#rs').val();
            var department = $('#department').val();
            var task = $('#task').val();
            var startDate = moment($('#startDate').val()).format('YYYY-MM-DD HH:mm:ss');
var endDate = moment($('#endDate').val()).format('YYYY-MM-DD HH:mm:ss');

            var eventData = {
        title: title,
        province: province,
        rs: rs,
        department: department,
        task: task,
        start_date: startDate,
        end_date: endDate
    };
            $.ajax({
                url: "{{ route('events.update', '') }}" + '/' + id,
                type: "PATCH",
                dataType: 'json',
                data: eventData,
                success: function (response) {
                    $('#eventModal').modal('hide');
                    swal("Data Sudah Terupdate", "Terimakasih", "success");
                    // Optionally, you can update the event in the calendar
                    // $('#calendar').fullCalendar('updateEvent', response);
                },
                error: function (error) {
                    if (error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        });

    });
</script>
</body>
</html>
