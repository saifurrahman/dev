var cam_photo_url =  $('#cam_photo').attr('src');
$(function(){        
    $('#guestlist_li').addClass('active');
    $('#guestlist_date').datepicker({dateFormat: 'dd-mm-yy',minDate: -6,maxDate: -0});
    $('#guestlist_date').datepicker("setDate", new Date() );    
});

$(function(){
    cam_photo_url =  $('#cam_photo').attr('src');
    $('#guestlist_tb tbody').html('<tr><td colspan="10" class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></td></tr>');
    $.ajax({
        type: 'GET',
        url: 'guest/list',
        dataType: 'JSON',
        success: function(data){
            $('#guestlist_tb tbody').empty();            
            for(var i in data){
                var row = '<tr>'
                    +'<td style="width: 40px;"><img alt="" src='+data[i].image_url+' style=" width: 50px; height: 50px;"></td>'
                    +'<td class="id hidden">'+data[i].id+'</td>'                  
                    +'<td>'+data[i].room_no+'</td>'
                    +'<td>'+data[i].name+'</td>'
                    +'<td>'+data[i].mobile+'</td>'
                    +'<td>'+data[i].coming_from+'</td>'
                    +'<td>'+data[i].going_to+'</td>'
                    +'<td>'+data[i].id_type+'</td>'
                    +'<td>'+data[i].id_no+'</td>'
                    +'<td>'+data[i].checkin_date+'</td>'
                    +'<td style="width:8%;"><button class="checkedout btn btn-default btn-xs">Check-Out</button></td>'  
                    +'</tr>';
                $('#guestlist_tb tbody').append(row);                
            }
        }
    });
});

$("#guestlist_tb tbody").on("click", ".checkedout", function(){ 
     var $checkedout = $(this);     
     var id = $checkedout.closest("tr").find(".id").text();
     var cfr_token = $('#cfr_token').val();
     alertify.confirm("Want to checkout the guest?", function(e){
        if(e){
            $checkedout.closest("tr").addClass('warning');
            $checkedout.html('checking out...');
            $.ajax({
                type: 'POST',
                url: 'guest/checkedout',
                dataType: 'JSON',
                data: {'id':id, '_token':cfr_token},
                success: function(data){
                    $checkedout.closest("tr").remove();
                }
            });
        }
    });
}); 

$('#save_guest_btn').on('click',function(){
    var res = $('form#guest_form').data('bootstrapValidator').validate();
    var guestlist_date = $('#guestlist_date').val();
    if(res.isValid() == true){
        $('#save_guest_btn').attr('disabled',true);
        var formData = $('form#guest_form').serializeArray();
        formData.push({name: 'guestlist_date', value: guestlist_date});
        if(data_url != 0){
            formData.push({name: 'data_url', value: data_url});
        }
        $('#guest-form-row').addClass('blur');
        $('#loader').show();
        $.ajax({
            type: 'POST',
            url: 'guest/add',
            dataType: 'JSON',
            data: formData,
            success: function(data){                
                alertify.success("Add Successfully");
                $('#save_guest_btn').attr('disabled',false);
                $('form#guest_form').each(function(){this.reset();});
                $('#cam_photo').attr('src', cam_photo_url);
                $('#guest-form-row').removeClass('blur');
                $('#loader').hide();
                if(data_url == 0){
                    data_url = "http://localhost:8000/img/default_pic.jpg";
                }
                var row = '<tr>'
                    +'<td><img alt="" src="'+data_url+'" style=" width: 50px; height: 50px;"></td>'
                    +'<td class="id hidden">'+data['id']+'</td>'                  
                    +'<td>'+data['room_no']+'</td>'
                    +'<td>'+data['name']+'</td>'
                    +'<td>'+data['mobile']+'</td>'
                    +'<td>'+data['coming_from']+'</td>'
                    +'<td>'+data['going_to']+'</td>'
                    +'<td>'+data['id_type']+'</td>'
                    +'<td>'+data['id_no']+'</td>'
                    +'<td>'+data['checkin_date']+'</td>'
                    +'<td style="width:8%;"><button class="checkedout btn btn-default btn-xs">Check-Out</button></td>'  
                    +'</tr>';
                $('#guestlist_tb tbody').prepend(row);  
                data_url = 0              
            },
            error: function(xhr, textStatus, thrownError) {
                alertify.error("Something went to wrong.Please Try again later...");
                $('#save_guest_btn').attr('disabled',false);
                data_url = 0
            }
        });
    }
    else{
        alertify.error("Fill the form correctly");
        $('#save_guest_btn').attr('disabled',false);
    }
});

$(function(){
    $('form#guest_form').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            room_no: {
                validators: {
                    notEmpty: {
                        message: 'The room no is required and can\'t be empty',
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'The mobile is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The value can contain only digits. Don\'t add +91'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The name must be 10'
                    }
                }
            }
        }
    });
});

$("select[name='id_type'], select[name='coming_from'], select[name='going_to'], select[name='sex']").selectize({
    create: true,
    sortField: {field: 'text',direction: 'asc'},
    dropdownParent: 'body'
});

$("select[name='nationality']").selectize({
    create: true,
    sortField: {field: 'text',direction: 'asc'},
    dropdownParent: 'body'
});

/*upload*/
var data_url = 0;
var fname = 0;
function readURL(input){
    if(input.files[0].size <= 1048576){
           if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#cam_photo').attr('src', e.target.result).height(250);
                    data_url = e.target.result;
                    upImg(e.target.result); 
                };
                reader.readAsDataURL(input.files[0]);
            }
    }
    else{
        alert('File is too large. Upload file less than 1MB');
    }
}

function upImg(dataurl){
    fname = data_url.substr(data_url.length - 64);
    fname = fname.replace(/[^\w\s]/gi, '');            
    $.ajax({
        type: 'POST',
        url: 'http://localhost/cm/photoapi.php',
        dataType: 'JSON',
        data: {'fname':fname, 'dataurl': dataurl},
        success: function(data){
        }
    });
}

/*webcam*/

var canvasData;
function webcam(){
    window.URL = window.URL || window.webkitURL;
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia || navigator.msGetUserMedia;

    var intervalForReading;
    var onFailSoHard = function (e) {
        $('#sorryMsg').show();
    };
    var video = $('video')[0];
    var canvas = $('canvas')[0];
    var localMediaStream = null;
    function clearUI() {
        $("#stop-button").fadeOut(1000);
        var $photoCanvas = $("#photoCanvas");
        if (!$photoCanvas.data("photoTaken")) {
            $photoCanvas.hide();
        }
        document.getElementById('vi').src = '';
    }

    function stopWebCam(){
        clearUI();
        clearInterval(intervalForReading);
        video.pause();
        localMediaStream.stop();
        var context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    function snapshot($canvas) {
        var canvas = $canvas[0];
        if (localMediaStream) {
            var canvasContext = canvas.getContext('2d');
            canvasContext.drawImage(video, 0, 0, 400, 340);
            canvasData = canvas.toDataURL("image/jpeg");
            $canvas.data("photoTaken", true);
            document.getElementById('cam_photo').src = canvasData;
            data_url = canvasData;
            video.pause();
        }
    }

    if (navigator.getUserMedia){
        navigator.getUserMedia({video: true}, function (stream) {
            $('video').show();
            video.src = window.URL.createObjectURL(stream);
            localMediaStream = stream;
            startReading();
            $('video, #photoCanvas, #stop-button').fadeIn(500);
        }, onFailSoHard);
    }
    else{
        $('#sorryMsg').html('Not Supported').fadeIn(500);
    }
    $('#ok').click(function () {
        stopWebCam();
        $('#capture').show();
        $('#re_capture').hide();
    });
    $('#capture').click( function(){
        $('#capture').hide();
        $('#re_capture').show();
        snapshot($('#photoCanvas'));
    });
    
    $('#re_capture').click( function(){
        $('#capture').show();
        $('#re_capture').hide();
        snapshot($('#photoCanvas'));
        video.play(); 
    });
}
function addmember(input){
    var res = input.split("+");
    $("input[name='name']").val(res['0']);
    $("input[name='additional_member']").val(res['1']);
}
function set_additional_member(input){
    if(input == 0){
         $("input[name='additional_member']").val('');
    }
}

$("input[name='additional_member']").focusout(function(){
  var input = $(this).val();
  if(input == "" || input == null){
         $("input[name='additional_member']").val(0);
    }
});