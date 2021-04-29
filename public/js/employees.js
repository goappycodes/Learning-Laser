$(document).ready(function(){
    $( ".date-mask-input" ).datepicker({ 
        dateFormat: 'dd/mm/yy'
    });

    $('.add_bonus').click(function(){

        $('#bonus_difference_modal').modal('show');
        $('.modal-title').html('Add Bonus');
        $('#bonus_difference_submit').attr('is-bonus',1);
        $('#bonus_difference_submit').attr('data-payroll-id',$(this).parent().attr('data-payroll-id'));

     });

     $('.add_difference').click(function(){

        $('#bonus_difference_modal').modal('show');
        $('.modal-title').html('Put Amount');
        $('#bonus_difference_submit').attr('is-bonus',0);
        $('#bonus_difference_submit').attr('data-payroll-id',$(this).parent().attr('data-payroll-id'));
        
     });

     $('#bonus_difference_submit').click(function(){
        var payroll_id = $(this).attr('data-payroll-id');
        var fetch_url = $(this).attr('data-remote');
        var is_bonus = $(this).attr('is-bonus');
        var amount = $('#bonus_difference_amount').val();
        if(amount)
        {
            $.ajax({
                type: "POST",
                url: fetch_url,
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'), 
                    payroll_id:payroll_id,
                    bonus : is_bonus,
                    amount : amount
                },
                dataType: "text",
                success: function(resultData) { 
                    if(is_bonus == 1)
                    {
                        alert('Bonus Added');
                    }
                    else
                    {
                        alert('Amount Reduced');
                    }
                    location.reload();
                }
            });
        }
        else
        {
            alert('Please enter amount.')
        }
     });

});