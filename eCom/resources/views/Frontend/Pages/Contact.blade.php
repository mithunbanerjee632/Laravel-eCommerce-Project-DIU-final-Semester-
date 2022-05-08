@extends('Frontend.Layout.app')
@section('title','Contact Us')
@section('content')

  <main id="main" class="main-site left-sidebar">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>Contact us</span></li>
                </ul>
            </div>
            <div class="row">
                <div class=" main-content-area">
                    <div class="wrap-contacts ">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="contact-box contact-form">
                                <h2 class="box-title">Leave a Message</h2>
                                  <div class="contact-frm">

                                    <label for="name">Name<span>*</span></label>
                                    <input type="text" value="" id="contact_name" name="name" >

                                    <label for="email">Email<span>*</span></label>
                                    <input type="text" value="" id="contact_email" name="email" >

                                    <label for="phone">Number Phone</label>
                                    <input type="text" value="" id="contact_phone" name="phone" >

                                    <label for="comment">Message</label>
                                    <textarea name="comment" id="contact_message"></textarea>

                                    <button type="submit" class="btn btn-block btn-danger w-100 mt-3" name="ok" id="ContactSendBtn" >Send</button>

                                  </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="contact-box contact-info">
                                <div class="wrap-map">
                                    <div class="mercado-google-maps">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7306.00450850547!2d90.42967377424429!3d23.711613538433884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9cc7d566d03%3A0x2472a49ac0504cd2!2sJatra%20Bari%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1651986569636!5m2!1sen!2sbd" width="600" height="263" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        {{-- data-zoom="16"
                                         data-map-type="ROADMAP"
                                         data-map-height="263">--}}
                                    </div>
                                </div>
                                <h2 class="box-title">Contact Detail</h2>
                                <div class="wrap-icon-box">

                                    <div class="icon-box-item">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>Email</b>
                                            <p>Support1@multivendorstore.com</p>
                                        </div>
                                    </div>

                                    <div class="icon-box-item">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>Phone</b>
                                            <p>01713574869</p>
                                        </div>
                                    </div>

                                    <div class="icon-box-item">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>Mail Office</b>
                                            <p>Sed ut perspiciatis unde omnis<br />Street Name, Los Angeles</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end main products area-->

            </div><!--end row-->

        </div><!--end container-->

    </main>


@endsection

@section('script')
    <script type="text/javascript">
        $('#ContactSendBtn').click(function(){
           var c_name =  $('#contact_name').val();
           var c_email =  $('#contact_email').val();
           var c_phone = $('#contact_phone').val();
           var c_message = $('#contact_message').val();

            SendContact(c_name,c_email,c_phone,c_message);
        });

        function SendContact(contactName,contactEmail,contactPhone,contactMessage){
            if(contactName.length == 0){
                $('#ContactSendBtn').html('Please Write Your Name');
                setTimeout(function(){
                    $('#ContactSendBtn').html('Send');
                },2000);
            }else if(contactEmail.length == 0){
                $('#ContactSendBtn').html('Please Write Your Email!');
                setTimeout(function(){
                    $('#ContactSendBtn').html('Send');
                },2000);
            }else if(contactPhone.length == 0){
                $('#ContactSendBtn').html('Please Write Your Phone Number!');
                setTimeout(function(){
                    $('#ContactSendBtn').html('Send');
                },2000);
            }else if(contactMessage.length == 0){
                $('#ContactSendBtn').html('Please Write Your Message!');
                setTimeout(function(){
                    $('#ContactSendBtn').html('Send');
                },2000);
            }else{
                $('#ContactSendBtn').html('Sending...!');
                axios.post('/ContactSend',{
                    name:contactName,
                    email:contactEmail,
                    phone:contactPhone,
                    message:contactMessage
                })
                    .then(function(response){
                     if(response.status == 200){
                         if(response.data == 1){
                             $('#ContactSendBtn').html('Successfully Sent!');
                             setTimeout(function(){
                                 $('#ContactSendBtn').html('Send');
                             },3000);
                         }else{
                             $('#ContactSendBtn').html('Sending Failed!Try Again...');
                             setTimeout(function(){
                                 $('#ContactSendBtn').html('Send');
                             },3000);
                         }
                     }
                }).catch(function(error){
                    $('#ContactSendBtn').html('Sending Failed!!!');
                    setTimeout(function(){
                        $('#ContactSendBtn').html('Send');
                    },3000);
                });
            }

        }
    </script>
    @endsection
