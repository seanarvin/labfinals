$(document).ready(function () {

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
                result.forEach(function (work) {
                    html +=
                    `<div class="custom-control custom-radio">
                    <input id=work"${work.work_id}" value="${work.work_id}" type="radio" 
                    class="custom-control-input" name="work">
                    <label for=work"${work.work_id}"  class="custom-control-label">${work.description}</label>
                    </div>`;
                });
                $('#workitems').html(html);
                step += '<span class="step"></span>';
            }
        });
        //set work specifics
        $.ajax({
            url: "/specifics/" + servid,
            success: function (result) {
                let list = "";

                if (result.length > 0) {
                    result.forEach(function (specifics) {
                        list +=
                        `<div class="custom-control custom-radio">
                        <input id=specifics"${specifics.specifics_id}" value="${specifics.specifics_id}" type="radio" 
                        class="custom-control-input" name="specifics">
                        <label for=specifics"${specifics.specifics_id}"  class="custom-control-label">${specifics.specifics}</label>
                        </div>`;

                    });

                    console.log(specifics)
                    $('#specifics').html(list);

                    step += '<span class="step"></span>';

                } else {
                    $('#specificstab').remove();
                }
                $('#steps').html(step);
            }
        });
    });

    // on close of modal go to service provider list
    $('.modal').on('hidden.bs.modal', function () {
        window.location.hash = '#spdiv';
        window.location.reload(true);
    });

    //search for service provider

    $('#searchsp').on("click",function (event) {
        event.preventDefault();
        search();
    });

    $('#searchinput').keypress(function(event){
        event.preventDefault();
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
         search();
        }
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



});


//on submit form
function submitRequest() {
    let work = $('input[name=work]:checked').val();
    let date = $('input[name=date]').val();
    let from = $('input[name=from]').val();
    let to = $('input[name=to]').val();
    let specifics = $('input[name=specifics]:checked').val();
    let sp = $('#nextBtn').data('uid');

    if (!specifics) {
        specifics = 0;
    }

    let payload = {
        "work_id": work,
        "date": date,
        "from": from,
        "to": to,
        "specifics_id": specifics,
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
                    if (result !== "No results found.") {
                        result.forEach(function (user) {
                            tabs += `<div class="card">
                            <div class="card-header">${user.user}</div><div class="card-body">
                            <h5 class="card-title">${user.service_name}</h5>
                            <p class="card-text">Address:  ${user.address}</p>
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
                    result.forEach(function (user) {
                        tabs += `<div class="card">
                        <div class="card-header">${user.user}</div><div class="card-body">
                        <h5 class="card-title">${user.service_name}</h5>
                        <p class="card-text">Address:  ${user.address}</p>
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