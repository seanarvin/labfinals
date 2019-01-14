$(document).ready(function () {

    $('#rate').on('show.bs.modal',function(e){
        let sp_id = $(e.relatedTarget).data('id');
        $('#sp_id').val(sp_id);
    });

    // set current date as min
    const today = new Date();
    let currentDate = getDateToday();
    let maxdate = getDateinweek();
    let hour = today.getHours();
    let time = (hour + 1)  + ":" + today.getMinutes();
    let to = (hour + 2)  + ":" + today.getMinutes();
    $('#date').attr('max',maxdate).attr('min',currentDate).val(currentDate);
    $('#from').attr('min',time)
    $('#from').val(time);
    $('#to').attr('min',to).val(to);


    
    // on show bootstrap modal
    $('.modal').on('show.bs.modal', function (e) {
        let sid = $(e.relatedTarget).data('sid');
        let servid = $(e.relatedTarget).data('servid');
        let uid = $(e.relatedTarget).data('uid');
        let step = '<span class="step"></span>';
        // set service name
        $('#sname').text($(e.relatedTarget).data('servicename'));

        $('#nextBtn').attr('data-uid', uid);
        // set list for works
        $.ajax({
            url: "/serviceworks/" + sid,
            success: function (result) {
                let html = "";
                console.log(result);
                result.forEach(function (work) {
                    html +=
                    `<div class="custom-control custom-radio">
                    <input id=work"${work.work_id}" value="${work.work_id}" type="radio" 
                    class="custom-control-input" name="work">
                    <label for=work"${work.work_id}"  class="custom-control-label">${work.description} 
                    (PHP ${work.priceFrom} - ${work.priceTo})</label>
                    </div>`;
                });
                $('#workitems').html(html);
                step += '<span class="step"></span>';
            }
        });
    
    });

    $('#confirmation').on('show.bs.modal', function (e) {
        let id = $(e.relatedTarget).data('id');
        $('#confirm').val(id);
    });

    // on close of modal go to service provider list
    $('.modal').on('hidden.bs.modal', function () {
        window.location.hash = '#spdiv';
        window.location.reload(true);
    });

    //search for service provider

    $('#searchsp').on("submit",function (event) {
        event.preventDefault();
        search();
    });

    $('#passwordsubmit').on("click",function(event){
        let oldpass = $('#oldpass');
        let password = $('#password');
        let confirm = $("#confirm");

        let payload = {
            "oldpass": oldpass.val() 
        }
        $.ajax({
            url: "/validatepassword",
            type: "POST",
            data: JSON.stringify(payload),
            contentType: "application/JSON",
            success: function (result) {
                if(result === true){
                  oldpass.removeClass('is-invalid');
                  oldpass.addClass('is-valid');
                  $('#oldpasshelp').text("Password is correct.");
                  if(password.val() === confirm.val() && password.val() !== ""){
                      confirm.addClass('is-valid');
                      confirm.removeClass('is-invalid');
                      $('#confirmhelp').text("Password is the same.");
                      alert("Password has been changed.");
                      $('#changepassform').submit();
                  }else{
                    confirm.addClass('is-invalid');
                    confirm.removeClass('is-valid');
                    $('#confirmhelp').text("Password is not the same.");
                }
            }else{
                oldpass.addClass('is-invalid');
                oldpass.removeClass('is-valid');
                $('#oldpasshelp').text("Password is not correct.");
            }
        }
    });
    });

    $('#dataTables-example').DataTable({
        "order": [[ 5, "desc" ]],
    });



});


//on submit form
function submitRequest() {
    let work = $('input[name=work]:checked').val();
    let date = $('input[name=date]').val();
    let from = $('input[name=from]').val();
    let to = $('input[name=to]').val();
    let specifics = $('textarea[name=specifics]').val();
    let sp = $('#nextBtn').data('uid');

    if (!specifics) {
        specifics = 0;
    }

    let payload = {
        "work_id": work,
        "date": date,
        "from": from,
        "to": to,
        "specifics": specifics,
        "sp_id": sp
    }

    $.ajax({
        url: "/client/request",
        type: "POST",
        data: JSON.stringify(payload),
        contentType: "application/JSON",
        success: function (result) {
            window.location.href = "/transactions";
        }
    });
}

//search
function search(){
    let searchval = $('#searchinput').val();

    window.location.href = "#spdiv";

    let tabs = "";

    if (searchval) {
        $.ajax({
            url: "/search/" + searchval,
            success: function (result) {
                rate = result["data"];
                result = result["results"];
                if (result) {
                    result.forEach(function (user) {
                        sp_id = user.sp_id
                        tabs += `<div class="card">
                        <div class="card-header">${user.user}
                        <div class="text-left">
                        <small><i> Rating: ${rate[sp_id]} / 5 </i></small>
                        </div>
                        </div>
                        <h5 class="card-title">${user.service_name}</h5>
                        <p class="card-text">Address:  ${user.address}</p>
                        <p class="card-text">Contact Number:  ${user.contact_no}</p>
                        <button data-uid = "${user.user_id}" data-servicename = "${user.service_name}"
                        data-sid = "${user.id}" data-servid = "${user.service_id}" type="button" 
                        class="btn btn-primary inquire" data-toggle="modal" data-target=".modal">Schedule an appointment</button>
                        </div></div>`;
                    });
                    $('#servicep-list').html(tabs);
                } else {
                    $('#servicep-list').html("No results found.");
                }
            }
        });
    }else{
        $.ajax({
            url: "/search/all",
            success: function (result) {
                rate = result["data"];
                result = result["results"];
                result.forEach(function (user) {
                   sp_id = user.sp_id
                   console.log(rate)
                   tabs += `<div class="card">
                   <div class="card-header">${user.user}
                   <div class="text-left">
                    <small><i> Rating: ${rate[sp_id]} / 5 </i></small>
                    </div>
                    </div>
                    <div class="card-body">
                   <h5 class="card-title">${user.service_name}</h5>
                   <p class="card-text">Address:  ${user.address}</p>
                   <p class="card-text">Contact Number:  ${user.contact_no}</p>
                   <button data-uid = "${user.user_id}" data-servicename = "${user.service_name}"
                   data-sid = "${user.id}" data-servid = "${user.service_id}" type="button" 
                   class="btn btn-primary inquire" data-toggle="modal" data-target=".modal">Schedule an appointment</button>
                   </div></div>`;
               });
                $('#servicep-list').html(tabs);
            }
        });
    }
}

function getDateToday(){
    var today = new Date();
    var time = today.getHours()
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 
    if(time > 18){
        dd = dd + 1;
    }

    today = yyyy + '-' + mm + '-' + dd;
    return today
}
function getDateinweek(){
    var today = new Date();
    var dd = today.getDate() + 6;
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    week = yyyy + '-' + mm + '-' + dd;
    return week
}