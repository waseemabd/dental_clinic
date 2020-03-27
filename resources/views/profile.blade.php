@extends('layouts.layout')

@push('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">
    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios {
            border-radius: 20px;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
        }
    </style>


@endpush



@section('content')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-7 col-6">
                    <h4 class="page-title">My Profile</h4>
                </div>

                <div class="col-sm-5 col-6 text-right m-b-30">
                    <a href="edit-profile.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
                </div>
            </div>
            <div class="card-box profile-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img class="avatar" src="assets/img/doctor-03.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">Cristina Groves</h3>
                                            <small class="text-muted">Gynecologist</small>
                                            <div class="staff-id">Employee ID : DR-0001</div>
                                            <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text"><a href="#">770-889-6484</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text"><a href="#">cristinagroves@example.com</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Birthday:</span>
                                                <span class="text">3rd March</span>
                                            </li>
                                            <li>
                                                <span class="title">Address:</span>
                                                <span class="text">714 Burwell Heights Road, Bridge City, TX, 77611</span>
                                            </li>
                                            <li>
                                                <span class="title">Gender:</span>
                                                <span class="text">Female</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="about-cont">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h3 class="card-title">Education Informations</h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">International College of Medical Science (UG)</a>
                                                        <div>MBBS</div>
                                                        <span class="time">2001 - 2003</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">International College of Medical Science (PG)</a>
                                                        <div>MD - Obstetrics & Gynaecology</div>
                                                        <span class="time">1997 - 2001</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-box mb-0">
                                    <h3 class="card-title">Experience</h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Consultant Gynecologist</a>
                                                        <span class="time">Jan 2014 - Present (4 years 8 months)</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Consultant Gynecologist</a>
                                                        <span class="time">Jan 2009 - Present (6 years 1 month)</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Consultant Gynecologist</a>
                                                        <span class="time">Jan 2004 - Present (5 years 2 months)</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-tab2">
                        Tab content 2
                    </div>
                    <div class="tab-pane" id="bottom-tab3">
                        Tab content 3
                    </div>
                </div>
            </div>
        </div>
        <div class="notification-box">
            <div class="msg-sidebar notifications msg-noti">
                <div class="topnav-dropdown-header">
                    <span>Messages</span>
                </div>
                <div class="drop-scroll msg-list-scroll" id="msg_list">
                    <ul class="list-box">
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">R</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Richard Miles </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item new-message">
                                    <div class="list-left">
                                        <span class="avatar">J</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">John Doe</span>
                                        <span class="message-time">1 Aug</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">T</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Tarah Shropshire </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">M</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Mike Litorus</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">C</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Catherine Manseau </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">D</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Domenic Houston </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">B</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Buster Wigton </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">R</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Rolland Webber </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">C</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Claire Mapes </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">M</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Melita Faucher</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">J</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Jeffery Lalor</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">L</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Loren Gatlin</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">T</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Tarah Shropshire</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="chat.html">See all messages</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_scripts')
    <script src="/js/select2.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/bootstrap-toggle.min.js"></script>
    <script>


        $(document).ready(function () {
            $('#edit_status').on('show.bs.modal', function (e) {

                let status = $(e.relatedTarget).data('status');

                $(e.currentTarget).find('input[name="status_id"]').val(status.id);
                $(e.currentTarget).find('input[name="title"]').val(status.title);
                $(e.currentTarget).find('textarea[name="description"]').val(status.description);
                $(e.currentTarget).find('textarea[name="note"]').val(status.notes);
                $(e.currentTarget).find('input[name="session_num"]').val(status.expected_sessions_number);
                if (status.is_active == '1') {
                    $(e.currentTarget).find('input[name="is_active"]').bootstrapToggle('on')
                } else {
                    $(e.currentTarget).find('input[name="is_active"]').bootstrapToggle('off')
                }


            });

            $('#add_status').on('show.bs.modal', function (e) {

                $(this).find('form').trigger('reset');

            });


            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#submit").on('click', function (e) {

                e.preventDefault();
                let noteSelector = $('#edit_status').find('textarea[name="note"]');
                let titleSelector = $('#edit_status').find('input[name="title"]');
                let session_numberSelector = $('#edit_status').find('input[name="session_num"]');
                let edit_statusSelector = $('#edit_status').find('input[name="is_active"]:checked');
                let descriptionSelector = $('#edit_status').find('textarea[name="description"]');
                let status_id = $('#edit_status').find('input[name="status_id"]').val();
                let patient_id = $("#submit").data('id');

                $.ajax({
                    type: 'POST',
                    url: "/update-status/" + status_id,
                    data: {
                        patient_id : patient_id,
                        title: titleSelector.val(),
                        description: descriptionSelector.val(),
                        note: noteSelector.val(),
                        session_num: session_numberSelector.val(),
                        is_active: edit_statusSelector.length > 0,
                    },

                    success: function (response) {
                        if (response.status === 1) {
                            $('#edit_status').modal('hide');
                            console.log(response.status + " | " + response.message);
                            $('#title_' + status_id).html(titleSelector.val());
                            $('#Desc_' + status_id).html(descriptionSelector.val());
                            $('#note_' + status_id).html(noteSelector.val());

                            $('#session_num_' + status_id).html(session_numberSelector.val());
                            if (edit_statusSelector.length > 0) {
                                $('#circle_' + status_id).css('background-color', '#10e617');
                            } else {
                                $('#circle_' + status_id).css('background-color', '#e61010');
                            }

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            });

            $("#store_status").on('click', function (e) {

                e.preventDefault();
                let noteSelector = $('#add_status').find('textarea[name="note"]');
                let session_numberSelector = $('#add_status').find('input[name="session_num"]');
                let add_statusSelector = $('#add_status').find('input[name="is_active"]:checked');
                let descriptionSelector = $('#add_status').find('textarea[name="description"]');
                let titleSelector = $('#add_status').find('input[name="title"]');

                let patient_id = $("#store_status").data('id');

                $.ajax({
                    type: 'POST',
                    url: "/add-status",
                    data: {
                        patient_id: patient_id,
                        title: titleSelector.val(),
                        description: descriptionSelector.val(),
                        note: noteSelector.val(),
                        session_num: session_numberSelector.val(),
                        is_active: add_statusSelector.length > 0,
                    },
                    success: function (response) {
                        if (response.status === 1) {
                            $('#add_status').modal('hide');
                            // console.log(response.last_added.id);
                            let status = response.last_added;

                            let data = {
                                title: status.title,
                                description: status.description,
                                notes: status.notes,
                                expected_sessions_number: status.expected_sessions_number,
                                is_active: status.is_active,
                                id:status.id
                            }

                            $("#status_list").append('<li id="li-'+status.id+'">' +
                                '                                                    <div class="experience-user">' +
                                '                                                        <div class="before-circle" id="circle_'+status.id+'" ></div>' +
                                '                                                    </div>' +
                                '                                                    <div class="experience-content">' +
                                '                                                        <div class="timeline-content">' +
                                '' +                                '                        <h3 class="name" id="title_'+status.id+'">' + titleSelector.val() + '</h3>' +
                                '                                                            <div class="float-right ml-2"><a' +
                                '                                                                        class="btn btn-outline-danger"' +
                                '                                                                        href="/#" data-toggle="modal"' +
                                '                                                                        data-target="#delete_status"' +
                                '                                                                        data-id="'+status.id+'">Delete' +
                                '                                                                        Status</a></div>'+
                                '                                                            <div class="float-right"><a class="btn btn-outline-primary" id="btnedit" href="/#" data-toggle="modal" data-target="#edit_status" >Edit Status</a></div>' +
                                '' +                                '                        <h3 class="name" id="Desc_'+status.id+'">' + descriptionSelector.val() + '</h3>' +

                                '                                                           <div style="display: grid">' +
                                '                                                                <label>Note: </label>' +
                                '                                                                <h3 id="note_'+status.id+'">' + noteSelector.val() + '</h3>' +
                                '                                                            </div>' +
                                '                                                            <div><label>Expected Sessions</label>' +
                                '                                                                <h3 id="session_num_'+status.id+'">' + session_numberSelector.val() + '</h3>' +
                                '' +
                                '                                                            </div>' +
                                '' +
                                '' +
                                '                                                        </div>' +
                                '                                                    </div>' +
                                '                                                </li>');

                            $('#btnedit').attr('data-status',  JSON.stringify(data));

                            if (add_statusSelector.length > 0) {
                                $('#circle_' + status.id).css('background-color', '#10e617');
                            } else {
                                $('#circle_' + status.id).css('background-color', '#e61010');
                            }

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);
                    }
                });
            });

            $('#delete_status').on('show.bs.modal', function (e) {

                let supplier_id = $(e.relatedTarget).data('id');

                $('#delete_btn').data('id', supplier_id);



            });

            $("#delete_btn").on('click', function (e) {

                e.preventDefault();

                let status_id = $("#delete_btn").data('id');
                console.log();

                $.ajax({
                    type: 'delete',
                    url: "/delete-status/" + status_id,


                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#delete_status').modal('hide');
                            $('#li-'+status_id).hide();
                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            });

        });


    </script>
@endpush





