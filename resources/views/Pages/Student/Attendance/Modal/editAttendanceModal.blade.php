<!-- Single Reusable Modal -->
<div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalStudentName">Edit Attendance</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('teacher.attendance.update', ['attendance' => $item->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="student_id" id="modalStudentId">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input attend" type="radio" name="attendance_status" id="modalAttend"
                            value="attend">
                        <label class="form-check-label" for="modalAttend">{{ trans('student.attend') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input absent" type="radio" name="attendance_status" id="modalAbsent"
                            value="absent">
                        <label class="form-check-label" for="modalAbsent">{{ trans('student.absent') }}</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
