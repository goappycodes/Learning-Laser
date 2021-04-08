$(document).ready(function(){
    $( "#leave_from" ).datepicker({ 
        dateFormat: 'dd/mm/yy', 
        onSelect: function(dateText, inst) {
            var start_date = $(this).val();
            var dateAr = start_date.split('/');
            var start_date_new_format = new Date(dateAr[1]+'/'+dateAr[0]+'/'+dateAr[2]);
            $('#leave_to').datepicker({ 
                dateFormat: 'dd/mm/yy', 
                minDate: start_date,
                onSelect: function(dateText, inst) {
                    var end_date = $(this).val();
                    var dateAr = end_date.split('/');
                    var end_date_new_format = new Date(dateAr[1]+'/'+dateAr[0]+'/'+dateAr[2]);
                    var Difference_In_Time = end_date_new_format.getTime() - start_date_new_format.getTime();
                    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                    if($('#session').val() == '1st Half' || $('#session').val() == '2nd Half')
                    {
                        var duration = Difference_In_Days + 1;
                        $('#duration').val(parseFloat(duration/2));
                    }
                    else
                    {
                        $('#duration').val(Difference_In_Days + 1);
                    }
                }
            });
            $('#leave_to').val(start_date);
            $('#duration').val(1);
        }
    });
    $('#session').change(function(){
        var value = $(this).val();
        if(value == '1st Half' || value == '2nd Half')
        {
            if(!$(this).hasClass('half'))
            {
                $(this).addClass('half');
                var duration = $('#duration').val();
                $('#duration').val(parseFloat(duration/2));
            }
        }
        else
        {
            if($(this).hasClass('half'))
            {
                $(this).removeClass('half');
                var duration = $('#duration').val();
                $('#duration').val(parseFloat(duration*2));
            }
        }
    });

    $( "#holiday_date" ).datepicker({ 
        dateFormat: 'dd/mm/yy'
    });

});