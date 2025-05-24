<div> <!-- Root element starts here -->
    <div id="calendar-container" wire:ignore>
        <div id="calendar"></div>
    </div>

    <!-- Custom Alert Box -->
    <div id="custom-alert"
        style="display: none; background: #ff9800; color: white; padding: 10px; border-radius: 5px; z-index: 1000;">
        <span id="alert-message"></span>
        <button onclick="document.getElementById('custom-alert').style.display='none'"
            style="margin-left: 10px; background: none; border: none; color: white; font-weight: bold; cursor: pointer;">✖</button>
    </div>

    @push('calenderScripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

        <script>
            function showAlert(message, callback) {
                document.getElementById('alert-message').innerText = message;
                document.getElementById('custom-alert').style.display = 'block';

                let closeBtn = document.getElementById('custom-alert').querySelector('button');
                closeBtn.onclick = function() {
                    document.getElementById('custom-alert').style.display = 'none';
                    if (callback) callback(false);
                };
            }
            console.log("🚀 FullCalendar and Livewire script is loading...");
            document.addEventListener('livewire:initialized', function() {
                console.log("🚀 FullCalendar and Livewire script is initialized...");

                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                var data = @this.events;
                var calendar = new Calendar(calendarEl, {
                    events: JSON.parse(data),
                    dateClick(info) {
                        var title = prompt('Enter Event Title');
                        var date = new Date(info.dateStr + 'T00:00:00');
                        if (title != null && title != '') {
                            calendar.addEvent({
                                title: title,
                                start: date,
                                allDay: true
                            });
                            var eventAdd = {
                                title: title,
                                start: date
                            };
                            @this.addEvent(eventAdd);
                            showAlert('✅ Event added successfully. Update your database.');
                        } else {
                            showAlert('⚠️ Event Title is required.');
                        }
                    },
                    eventClick: function(info) {
                        let eventObj = info.event;
                        let answer = confirm('Do you want to delete this event?');
                        if (answer) {
                            @this.deleteEvent(eventObj.id);
                            info.event.remove();
                            showAlert('✅ Event deleted successfully.');
                        }
                    },
                    editable: true,
                    selectable: true,
                    displayEventTime: false,
                    droppable: true,
                    drop: function(info) {
                        if (checkbox.checked) {
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    },
                    eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
                    loading: function(isLoading) {
                        if (!isLoading) {
                            this.getEvents().forEach(function(e) {
                                if (e.source === null) {
                                    e.remove();
                                }
                            });
                        }
                    }
                });
                calendar.render();
                @this.on(`refreshCalendar`, () => {
                    calendar.refetchEvents()
                });
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
    @endpush
</div> <!-- Root element ends here -->
