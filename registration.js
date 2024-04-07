function match_password(pass, confirm)
{
    console.log('match password called', pass, confirm);
    var pass_text = document.getElementById(pass).value;
    var confirm_text = document.getElementById(confirm).value;
    var icon = document.getElementById(pass+'_icon');
    var span = document.getElementById(pass+'_span');
    var submit = document.getElementById(pass.replace('password', 'btn'));
    
    console.log(pass_text, confirm_text);
    if( confirm_text != pass_text && pass_text != '')
    {
        $("#"+span.id).show();
        $('#'+icon.id).hide();
        $('#'+submit.id).attr('disabled', 'disabled');
    }
    else if(confirm_text == pass_text && pass_text != '')
    {
        $('#'+icon.id).show();
        $("#"+span.id).hide();
        $('#'+submit.id).removeAttr('disabled');
    }
    else if(confirm_text != '')
    {
        $('#'+icon.id).hide();
        $("#"+span.id).hide();

    }
}

document.querySelector('.submit-button').addEventListener('hover', popover_span(this));

function popover_span(btn)
{
    console.log('pop over function called');
    var span = document.createElement('span');
    span.innerText = "entered password and confirm password doesn't match. Fill both to enable this button";
    span = btn.id+"_popover";
    $(span).insertAfter(btn);

    if($(btn).attr('disabled') == 'disabled')
    {

    }
}

function check_size(image)
{
    var max_size =  1024*1024*3;
    if(image.files.length>0 && image.files[0].size > max_size)
    {
        alert('You have uploaded a file('+parseInt(image.files[0].size/1024/1024)+'MB) larger than 3MB!!! Kindly select another smaller file');
        image.value = "";
    }
}