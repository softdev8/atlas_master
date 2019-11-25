@extends('layouts.admin')

@section('content')

    <div class="breadcrumb-block bg-white">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-active">
                    Activity Logs
                </li>
            </ol>
        </div>

        <div class="breadcrumb-element dateRange">  
            <div class="float-left">          
            <input id="start_date"  type="text" class="col-md-10 form-control datetimepicker " 
                name="start_date" value="" placeholder="From Date" >
                  </div><div class="float-left">      
            <input id="end_date" type="text" class="col-md-10 form-control datetimepicker " 
                name="end_date" value="" placeholder="To Date" >         
       </div>
            <a href="" class="btn btn-success btn-sm date-range-btn" title="Search">
                Search
            </a>
        
            <a href="" class="btn btn-success btn-sm export-activitylogs-btn" title="export">
                Export to CSV
            </a>
        </div>
    </div>

    <div class="content-block">
        {!! $dataTable->table() !!}
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>


    {!! $dataTable->scripts() !!}

    <script>   
        var table = $('#dataTableBuilder').DataTable();  
        table.on( 'error', function () { 
            console.log( 'ajax error' );
            table.draw()} 
        );
        $.fn.dataTable.ext.errMode = 'throw';

        $.datetimepicker.setLocale('en');
        $('.datetimepicker').datetimepicker({
            timepicker:false,
            format:'Y-m-d',
        
        });

        // CheckBox Event
        $("#checkAll").click(function(){
            if($(this).prop("checked") == true) {
                $(".log_check").each(function(index) {
                    $(this).prop('checked', true);
                })
            } else {
                $(".log_check").each(function(index) {
                    $(this).prop('checked', false);
                })
            }
        });
        
        // // DatePicker event

        $(".date-range-btn").on('click', function(e){
            e.preventDefault();
            table.draw();           
        });

        $("#start_date, #end_date").on('change', function(e) {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if(start_date && end_date) {
                e.preventDefault();
                table.draw();       
            }
        });

        //Export CSV data

        $(".export-activitylogs-btn").on('click', function(e){
            e.preventDefault();
            var selected_ids = [];
            $(".log_check").each(function(index) {
                if($(this).prop("checked") == true) {
                    selected_ids.push($(this).val());
                }
            })

            if (selected_ids.length == 0) {
                alert("Please select logs what you want to export as CSV.");
                return false;
            }

            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            
            if(start_date === '' || end_date === '') {
                alert('Please select date range.');
                return;
            }
            // Send Ajax Request To Get Logs

            $.ajax({
                /* the route pointing to the post function */
                url: '/admin/activity_logs/export',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: { selected_activitylog_ids:selected_ids, start_date, end_date},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) { 
                    if (data.success) {
                        // console.log(data.data.activitylogs)
                        export_csv(data.data.activitylogs)
                    }
                }
            }); 
        })

        function export_csv(data) {
            const header = [
            "User Name",
            "Date",
            "First Login Time",
            "Last Logout TIme",
            'Count of logins',
            'Count of searches run whilst logged in',
            'Count of Projects created',
            "Count of Projects exported to CSV",
            "Count of Saved Searches created",
            "Count of Firm profile links clicked",
            "Count of LinkedIn profile links clicked"
            ];

            let dataArrays = [];

            data.forEach(activityLog => {               
                let row = [
                    activityLog.name, 
                    activityLog.date, 
                    activityLog.first_login, 
                    activityLog.last_logout, 
                    activityLog.count_logins,
                    activityLog.count_searches, 
                    activityLog.count_projects_created, 
                    activityLog.count_projects_exported, 
                    activityLog.count_saved_searches, 
                    activityLog.count_firm_link_clicks, 
                    activityLog.count_linkedin_link_clicks                   
                ];

                dataArrays.push(row);
            });

            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += header.join(",") + "\r\n";
            
            dataArrays.forEach(function (rowObject) {               
                csvContent += rowObject.join(",") + "\r\n";
            });

            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", `Activitylogs-${Date.now()}.csv`);
            document.body.appendChild(link); // Required for FF
            link.click();
        }
       
    </script>

@endpush

