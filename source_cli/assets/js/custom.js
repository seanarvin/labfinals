$(document).ready(function () {

    $('#rate').on('show.bs.modal',function(e){
        let sp_id = $(e.relatedTarget).data('id');
        $('#sp_id').val(sp_id);
    });

    $('#services').DataTable();


    
    // on show bootstrap modal
    $('.modal').on('show.bs.modal', function (e) {
        let sid = $(e.relatedTarget).data('sid');
        let servid = $(e.relatedTarget).data('servid');
        let uid = $(e.relatedTarget).data('uid');
        // set service name
        $('#sname').text($(e.relatedTarget).data('servicename').toLowerCase());

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
                    (Starting price:  PHP ${work.priceFrom})</label>
                    </div>`;
                });
                $('#workitems').html(html);
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

    if (!searchval) {
        searchval = "all"
    }

        $.ajax({
            url: "/search/" + searchval,
            success: function (result) {
                rate = result["data"];
                result = result["results"];
                if (result) {
                    result.forEach(function (user) {
                        rating = rate[user.sp_id];
                        if (!rating){rating = 0 } 
                            tabs += ` 
                        <tr>
                        <td>${user.service_name}</td>
                        <td>${user.user}</td>
                        <td>${user.address}</td>
                        <td><a href="#" title="View comments"><i>${rating }/ 5</i> </a></td>
                        <td> <button data-uid = "${user.user_id}" 
                        data-servicename = "${user.service_name}"
                        data-sid = "${ user.service_id }" data-servid = "${ user.service_id }" 
                        type="button" class="btn btn-primary inquire" data-toggle="modal" 
                        data-target=".modal">Schedule an appointment</button>
                        </td>
                        </tr>`;
                    });
                    $('#servicep-list').html(tabs);
                } else {
                    $('#servicep-list').html(`<td valign="top" colspan="5" class="dataTables_empty">No matching records found</td>`);
                }
            }
        });
}

function validateSched(){
    // get date today
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = yyyy + '-' + mm + '-' + dd;
    week = yyyy + '-' + mm + '-' + (dd+7);

    let sched = $('#date');
    let from = $('#from');
    let to = $('#to');

    let dateValidate = false;
    let fromValidate = false;
    let toValidate = false;

    if (!sched.val() || !from.val() || !to.val()){
        alert("Please provide all the appointment info.");
    }
    if(sched.val()){
        if(sched.val() < today){
            sched.val(today);
            alert("Date must not be less than today's date.");
        }else if(sched.val() > week){
            sched.val(week);
            alert("Appointments can only be done 1 week in advance.");
        }else{
            dateValidate = true;
        }
    }
    if(from.val()){
        if(from.val() > "17:00"){
            from.val("17:00")
            alert("Maximum time for start time is 5:00 PM");
        }else if(from.val() < "08:00"){
            from.val("08:00")
            alert("Operating hours is at 8:00 AM. ");
        }
        fromValidate = true;

    }


    if(to.val()){
        if(to.val() > "18:00"){
            to.val("18:00")
            alert("Maximum time for end time is 6:00 PM");
        }else if(to.val() < "09:00"){
            to.val("09:00")
            alert("Operating hours is at 8:00 AM. End time must be greater than 8:00 AM ");
        }else{
            toValidate = true;
        }

    }


    if(dateValidate && fromValidate && toValidate){
        submitRequest();
    }
}