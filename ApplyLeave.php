<?php include("Includes/Header.php") ?>


<?php
// Include the database connection file
include('Includes/db_connection.php');

// Execute an SQL query
$sql = 'SELECT * FROM erp_faculty';
$result = mysqli_query($conn, $sql);
$EventRows = array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($EventRows, $row);
}
// print_r($EventRows);
// Close the database connection



mysqli_close($conn);
?>




<div class="card m-3 w-50">
    <div class="card-header">
        Apply Leave
    </div>
    <div class="card-body">
        <!-- <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a> -->



            <div class="form-group">
                <label for="Evnet">Select Staff</label>
                <select class="form-control" id="Staff" name="Staff" required="required">
                    <?php
                    foreach ($EventRows as $Event) {
                        echo "<option value=" . $Event['f_id'] . ">" . $Event['f_fname'] . " " . $Event['f_lname'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="LeaveType">Select Leave Type</label>
                <select class="form-control" id="LeaveType" name="LeaveType" required="required">
                    <option value="ml">Medical Leave</option>";
                    <option value="cl">Casual Leave</option>";
                    <option value="permission">Permission</option>";
                </select>
            </div>
                <div class="form-group">
                <label for="LeaveStartDate">Leave Start Date</label>    
                <input type="date" id="LeaveStartDate" name="LeaveStartDate" class="form-control range_flatpicker"
                        placeholder="Range Date Picker">
                </div>
                <div class="form-group">
                <label for="LeaveEndDate">Leave End Date</label>    
                <input type="date" id="LeaveEndDate" name="LeaveEndDate" class="form-control range_flatpicker"
                        placeholder="Range Date Picker">
                </div>
                <div class="form-group">
                <label for="LeaveStartTime">Leave Start Time</label>    
                <input type="time" id="LeaveStartTime" name="LeaveStartTime" class="form-control time_flatpicker" placeholder="Time Picker">
                </div>
                <div class="form-group">
                <label for="LeaveEndTime">Leave End Time</label>    
                <input type="time" id="LeaveEndTime" name="LeaveEndTime" class="form-control time_flatpicker" placeholder="Time Picker">
                </div>


            <div class="form-group">
                <label for="LeaveReason" required="required">Leave Reason</label>
                <textarea type="text" name="LeaveReason" class="form-control" id="LeaveReason" 
                    placeholder="" ></textarea>
            </div>
            <button type="button" class="btn btn-primary" 
                        onclick="create()">Apply Leave</button>

        <div id="Result" class="m-3">
        </div>

    </div>
</div>
<!-- JavaScript code to handle form submission with AJAX -->
<script>
            function create() {
                var StaffId = $("#Staff").val();
                var LeaveType = $("#LeaveType").val();
                var LeaveStartDate = $("#LeaveStartDate").val();
                var LeaveEndDate = $("#LeaveEndDate").val();
                var LeaveStartTime = $("#LeaveStartTime").val();
                var LeaveEndTime = $("#LeaveEndTime").val();
                var LeaveReason = $("#LeaveReason").val();

                console.log(StaffId+
LeaveType+
LeaveStartDate+
LeaveEndDate+
LeaveStartTime+
LeaveEndTime+
LeaveReason);
// console.log('test');
                $.ajax({
                    url: 'Functions.php',
                    type: 'POST',
                    data: { StaffId:StaffId,LeaveType:LeaveType,LeaveStartDate:LeaveStartDate,LeaveEndDate:LeaveEndDate,LeaveStartTime:LeaveStartTime,LeaveEndTime:LeaveEndTime,LeaveReason:LeaveReason, Function: "CreateLeave" },
                    success: function (response) {
                        console.log(response);
                        if (response == "OK") {
                            $("#Result").html(`<div class="alert alert-success fade show" role="alert"> Leave Created Successfully</div>`);
                            setTimeout(function () {
                                $("#Result").html('');
                                location.reload();
                            }, 5000);
                        } else {
                            $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                            setTimeout(function () {
                                $("#Result").html('');
                            }, 5000);

                        }

                    }
                });
            }
</script>









<?php include("Includes/Footer.php") ?>