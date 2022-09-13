<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    const form_id = $('.form').attr('id');
    const sucess_input='#'+form_id+' input,'; 
    const sucess_select='#'+form_id+' select,';
    const sucess_textarea='#'+form_id+' textarea';
    const all =(sucess_input+sucess_select+sucess_textarea).toString();
   
    $(document).ready(function() {
        $('#' + form_id).on('submit', function(event) {
            event.preventDefault();
            const form = $(this);
            const url = form.attr('action');
            const data = form.serialize();
            $.ajax({
                url,
                method: 'post',
                data,
                error: function(result) {

                    $.each(result.responseJSON.errors, function(key, value) {
                        $('#' + key + '-error').text(value).show('slow');
                        document.getElementById(key).setAttribute("class", "form-control is-invalid");


                    })




                },
                success: function(result) {

                    $("#form-create input,#form-create select,#form-create textarea").each(
                        function(index) {
                            const input = $(this); 
                            // alert('Type: ' + input.attr('id') + 'Name: ' + input.attr('name') + 'Value: ' + input.val());
                            // alert('Name: ' + input.attr('name') + "  "+'class: ' + input.attr('class') );
                            // const test=(input.attr('name')).toString(); debugger;
                            // document.getElementById(test).innerHTML.setAttribute("class", "form-control");
                            // $(input.attr('class')).html('form-control');

                            if(input.attr('id') !=null){
                                document.getElementById(input.attr('id')).setAttribute("class", "form-control");
                                $('#' + input.attr('id') + '-' + 'error').text('');
                                input.val(' ');



                            }

                        }
                    );

                    // $('#form-create')[0].reset();



                }


            });
        });

    });
</script>