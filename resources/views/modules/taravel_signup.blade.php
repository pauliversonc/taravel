@extends('admin.layouts.taravel2')
@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations_responsive.css')}}">
@endsection
@section('content')

<style>
        .home{
            height:950px;
        }
        .jumbotron{
            background: grey; /* This is for ie8 and below */
            background: rgba(255,255,255, 0.3); 
        }
        .background_image{
            height: 100%;
        }
    </style>
    
<div class="home">
    <div class="background_image" style="background-image:url({{url('storage/hdpics/sinulog2.jpg')}});">
        <div class="container">
            <div class="row jumbotron" style="top:11em;">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">                                                     
                <form action="{{url('signup/information')}}" method="post" style="width: auto; ">
                    {{csrf_field()}}
                    <legend style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">Sign Up Now!</legend>
                    <br>
                    <div class="row"  style=" margin-left: 5%; ">
                        <div class="col-sm-5">
                        <input type="text" class="form-control" name="fname" value="{{empty($request['fname'])?'':$request['fname']}}" placeholder="Firstname" >
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="mname" placeholder="Middlename" >
                            </div>
                
                    </div>
                    <div class="row" style=" margin-left: 5%; margin-top:3%;">
                            <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lname" placeholder="Lastname" >
                                </div>
                    </div>
                    <div class="row" style=" margin-left: 5%; margin-top:3%;">
                            <div class="col-sm-10">
                                    <input type="email" required class="form-control" onblur="duplicateEmail(this)" id="email" name="email" placeholder="Email Address" >
                                    <small class="form-text" style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">Email Address will be used to log in</small><br>
                                </div>
                    </div><br>
                    <div class="row"  style=" margin-left: 5%; ">
                            <div class="col-sm-10">
                                    <label for="exampleInputPassword1"style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">Select user type</label>
                                        <select name="user_type" class="form-control" id="">
                                            @foreach ($role->where('id','!=',1) as $r)
                                            <option value="{{$r->id}}">{{$r->title}}</option>
                                            @endforeach
                                        </select>
                                </div>
                
                        </div>
                        <br>
                    <div class="row"  style=" margin-left: 5%; ">
                            <div class="col-sm-5">
                                    <label for="exampleInputPassword1"style="text-shadow: 4px 3px 3px #4d4d4d; color:white;" >Password</label>
                                    <input type="password" class="form-control" maxlength="16" required minlength="8" name="password" id="pwds" style=" " placeholder="8  to 16 characters">
                                </div>
                                <div class="col-sm-5">
                                        <label for="exampleInputPassword1"style="text-shadow: 4px 3px 3px #4d4d4d; color:white;" >Confirm Password</label>
                                        <input type="password" class="form-control" maxlength="16" required minlength="8" name="pwdchk" id="pwdchks" style=" ">
                                </div>
                
                        </div>
                
                
                
                <br>
                  <div class="form-check">
                    <label class="form-check-label" >
                      <input class="form-check-input" style="margin-left: 4%;" type="checkbox" onclick="myFunction()"><br>
                      <small id="emailHelp" class="form-text" style="margin-left: 40px; margin-top: -18px; text-shadow: 4px 3px 3px #4d4d4d; color:white;">Show Password</small><br>
                  </div>
                  <div style="text-align:center;">
                        <label style="text-shadow: 4px 3px 3px #4d4d4d; color:white; font-size:15px;">By clicking "Sign Up", you agree to the 
                          <a data-toggle="modal"data-target="#termsandconditon" ><u style="text-shadow: 4px 3px 3px blue; color:white;">Terms and Privacy Policy</u></a></label>
                    </div>
                
                 <script>
                function myFunction() {
                var x = document.getElementById("pwds");
                var y = document.getElementById("pwdchks");
                if (x.type === "password" && y.type === "password" ) {
                    x.type = "text";
                    y.type = "text";
                
                } else {
                    x.type = "password";
                    y.type = "password";
                
                }
                }
                
                function duplicateEmail(element){
                var email = $(element).val();
                
                $.ajax({
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                    type: "POST",
                    url: '{{url('checkemail')}}',
                    data: {email:email},
                    dataType: "json",
                    success: function(res) {
                        if(res.exists){
                            alert('Email already exist');
                            $('#submit').attr('disabled','true');
                        }else{
                            alert('Email Available');
                            $('#submit').removeAttr('disabled');
                        }
                    },
                    error: function (jqXHR, exception) {
                
                    }
                });
                }
                </script>
                
                <br><br>
                    <div style="text-align:center">
                  <button type="submit" id="submit" name="submit" class="btn btn-primary form-control" style=" text-shadow: 4px 3px 3px #4d4d4d; color:white;">Sign Up!</button> <br><br>
                    </div>
                    <div style="text-align:center; ">
                <label for="exampleInputPassword1"style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">Already have an account?<a style="text-shadow: 4px 3px 3px #4d4d4d; color:white;" href="{{route('login')}}"> Click here to Log in!</a></label>
                    </div>
                  </form>
                </div>
            </div>
                </div>
    </div>

</div>


{{-- 
      <!-- FULL WRAPPER -->
      <br><br><br><br>

      <div class="main-wrapper-full" style="max-width: 100%; height: auto; ">

        <img style="width:50%; height: 1130px; float: left;" src="{{asset('storage/signupleft.jpg')}}">

        <div style="width:50%; height: auto; float: right;  ">

            <fieldset>
        <div class="form-group">
            <br>
            <br>
        <legend style="padding: 20px;" >Sign up Now!</legend>

        <form action="{{url('signup/information')}}" method="post" style="width: auto; ">
            {{csrf_field()}}
            <div class="row"  style=" margin-left: 5%; ">
                <div class="col-sm-5">
                <input type="text" class="form-control" name="fname" value="{{empty($request['fname'])?'':$request['fname']}}" placeholder="Firstname" >
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mname" placeholder="Middlename" >
                    </div>

            </div>
            <div class="row" style=" margin-left: 5%; margin-top:3%;">
                    <div class="col-sm-10">
                            <input type="text" class="form-control" name="lname" placeholder="Lastname" >
                        </div>
            </div>
            <div class="row" style=" margin-left: 5%; margin-top:3%;">
                    <div class="col-sm-10">
                            <input type="email" required class="form-control" onblur="duplicateEmail(this)" id="email" name="email" placeholder="Email Address" >
                            <small class="form-text text-muted" style="margin-left: 15px;">Email Address will be used to log in</small><br>
                        </div>
            </div><br>
            <div class="row"  style=" margin-left: 5%; ">
                    <div class="col-sm-10">
                            <label for="exampleInputPassword1"style="">Select user type</label>
                                <select name="user_type" class="form-control" id="">
                                    @foreach ($role->where('id','!=',1) as $r)
                                    <option value="{{$r->id}}">{{$r->title}}</option>
                                    @endforeach
                                </select>
                        </div>

                </div>
                <br>
            <div class="row"  style=" margin-left: 5%; ">
                    <div class="col-sm-5">
                            <label for="exampleInputPassword1"style="" >Password</label>
                            <input type="password" class="form-control" maxlength="16" required minlength="8" name="password" id="pwds" style=" " placeholder="8  to 16 characters">
                        </div>
                        <div class="col-sm-5">
                                <label for="exampleInputPassword1"style="" >Confirm Password</label>
                                <input type="password" class="form-control" maxlength="16" required minlength="8" name="pwdchk" id="pwdchks" style=" ">
                        </div>

                </div>



<br>
          <div class="form-check">
            <label class="form-check-label" >
              <input class="form-check-input" style="margin-left: 4%;" type="checkbox" onclick="myFunction()"><br>
              <small id="emailHelp" class="form-text text-muted" style="margin-left: 40px; margin-top: -18px; ">Show Password</small><br>

          </div>

         <script>
    function myFunction() {
        var x = document.getElementById("pwds");
        var y = document.getElementById("pwdchks");
        if (x.type === "password" && y.type === "password" ) {
            x.type = "text";
            y.type = "text";

        } else {
            x.type = "password";
            y.type = "password";

        }
    }

    function duplicateEmail(element){
        var email = $(element).val();

        $.ajax({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
            type: "POST",
            url: '{{url('checkemail')}}',
            data: {email:email},
            dataType: "json",
            success: function(res) {
                if(res.exists){
                    alert('Email already exist');
                    $('#submit').attr('disabled','true');
                }else{
                    alert('Email Available');
                    $('#submit').removeAttr('disabled');
                }
            },
            error: function (jqXHR, exception) {

            }
        });
    }
    </script>

    <br><br>
            <div style="text-align:center">
          <button type="submit" id="submit" name="submit" class="btn btn-primary form-control" style="width: 90%;">Sign Up!</button> <br><br>
            </div>
        <label for="exampleInputPassword1"style="margin-left: 160px;">Already have an account?<a href="{{route('login')}}"> Click here to Log in!</a></label>

          </form> --}}
        {{-- </div>
      </fieldset>

         </div>

      </div> --}}
<script
  src="{{asset('js\jquery-3.3.1.min.js')}}"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
      <script>
            $(document).ready(function(){
                $("#pwdchks").mouseout(function(){
                   var pwd = $('#pwds').val();
                   var pwdchk = $('#pwdchks').val();
                   if(pwd === pwdchk){
                        $('#submit').removeAttr('disabled');
                   }
                   else{
                        alert('Password don\'t match!')
                        $('#submit').attr('disabled','true');
                   }
                });
                $("#pwds").mouseout(function(){
                   var pwd = $('#pwds').val();
                   var pwdchk = $('#pwdchks').val();
                   if(pwd === pwdchk){
                        $('#submit').removeAttr('disabled');
                   }
                   else{
                        alert('Password don\'t match!')
                        $('#submit').attr('disabled','true');
                   }
                });
            });
        </script>
  <!-- Modal -->
  <style>
        .modal{
            top:50px;
        }
        .modal-body{
            color:black;
            line-height: 1.5em;
        }
      </style>
    <div class="modal fade" id="termsandconditon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Terms and Privacy Policy</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" >
                 <p style="text-align:center; color:black;"><b> Republic of the Philippine <br>
                  Congress of the Philippines<br>
                  Metro Manila <br>
                  Fifteenth Congress<br>
                  Second Regular Session </b></p>
                  
                 <p style="color:black;"> Begun and held in Metro Manila, on Monday, the twenty-fifth day of July, two thousand eleven.</p>
                  <p style="text-align:center; color:black;">[REPUBLIC ACT NO. 10173]</p>
                  
                  <p style="color:black;"><b>AN ACT PROTECTING INDIVIDUAL PERSONAL INFORMATION IN INFORMATION AND COMMUNICATIONS SYSTEMS IN THE GOVERNMENT AND THE PRIVATE SECTOR, CREATING FOR THIS PURPOSE A NATIONAL PRIVACY COMMISSION, AND FOR OTHER PURPOSES</b></p>
                  
                 <p style="color:black;"> Be it enacted, by the Senate and House of Representatives of the Philippines in Congress assembled:</p>
                  
                 <p style="text-align:center; color:black;"><b> CHAPTER I <br>
                  GENERAL PROVISIONS </b> </p>
                  
                 <li> SECTION 1. Short Title. – This Act shall be known as the “Data Privacy Act of 2012”.</li>
                  
                 <li> SEC. 2. Declaration of Policy. – It is the policy of the State to protect the fundamental human right of privacy, of communication while ensuring free flow of information to promote innovation and growth. The State recognizes the vital role of information and communications technology in nation-building and its inherent obligation to ensure that personal information in information and communications systems in the government and in the private sector are secured and protected.</li>
                  
                 <li> SEC. 3. Definition of Terms. – Whenever used in this Act, the following terms shall have the respective meanings hereafter set forth:</li>
                  
                  <p style="text-indent:2em;"><ul>
                  <li>(a) Commission shall refer to the National Privacy Commission created by virtue of this Act.</li>
                  <li>(b) Consent of the data subject refers to any freely given, specific, informed indication of will, whereby the data subject agrees to the collection and processing of personal information about and/or relating to him or her. Consent shall be evidenced by written, electronic or recorded means. It may also be given on behalf of the data subject by an agent specifically authorized by the data subject to do so.</li>                    
                  <li>(c) Data subject refers to an individual whose personal information is processed.</li>                    
                  <li>(d) Direct marketing refers to communication by whatever means of any advertising or marketing material which is directed to particular individuals.</li>
                  <li>(e) Filing system refers to any act of information relating to natural or juridical persons to the extent that, although the information is not processed by equipment operating automatically in response to instructions given for that purpose, the set is structured, either by reference to individuals or by reference to criteria relating to individuals, in such a way that specific information relating to a particular person is readily accessible.</li>
                  <li>(f) Information and Communications System refers to a system for generating, sending, receiving, storing or otherwise processing electronic data messages or electronic documents and includes the computer system or other similar device by or which data is recorded, transmitted or stored and any procedure related to the recording, transmission or storage of electronic data, electronic message, or electronic document.</li>
                  <li>(g) Personal information refers to any information whether recorded in a material form or not, from which the identity of an individual is apparent or can be reasonably and directly ascertained by the entity holding the information, or when put together with other information would directly and certainly identify an individual.</li>                    
                  <li>(h) Personal information controller refers to a person or organization who controls the collection, holding, processing or use of personal information, including a person or organization who instructs another person or organization to collect, hold, process, use, transfer or disclose personal information on his or her behalf. The term excludes:</li>
                  
                  <li>(1) A person or organization who performs such functions as instructed by another person or organization; and</li>
                  
                  <li>(2) An individual who collects, holds, processes or uses personal information in connection with the individual’s personal, family or household affairs.</li>
                  
                  <li>(i) Personal information processor refers to any natural or juridical person qualified to act as such under this Act to whom a personal information controller may outsource the processing of personal data pertaining to a data subject.</li>
                  
                  <li>(j) Processing refers to any operation or any set of operations performed upon personal information including, but not limited to, the collection, recording, organization, storage, updating or modification, retrieval, consultation, use, consolidation, blocking, erasure or destruction of data.</li>
                  
                  <li>(k) Privileged information refers to any and all forms of data which under the Rules of Court and other pertinent laws constitute privileged communication.</li>
                  
                  <li>(l) Sensitive personal information refers to personal information:</li>
                  
                  <li>(1) About an individual’s race, ethnic origin, marital status, age, color, and religious, philosophical or political affiliations;</li>
                  
                  <li>(2) About an individual’s health, education, genetic or sexual life of a person, or to any proceeding for any offense committed or alleged to have been committed by such person, the disposal of such proceedings, or the sentence of any court in such proceedings;</li>
                  
                  <li>(3) Issued by government agencies peculiar to an individual which includes, but not limited to, social security numbers, previous or current health records, licenses or its denials, suspension or revocation, and tax returns; and</li>
                  
                  <li>(4) Specifically established by an executive order or an act of Congress to be kept classified.</li>
                 </ul>
                  </p>
                  
                  <li> 4. Scope. – This Act applies to the processing of all types of personal information and to any natural and juridical person involved in personal information processing including those personal information controllers and processors who, although not found or established in the Philippines, use equipment that are located in the Philippines, or those who maintain an office, branch or agency in the Philippines subject to the immediately succeeding paragraph: Provided, That the requirements of Section 5 are complied with.</li>
                  
                  <p>This Act does not apply to the following:
                  <ul>
                  <li>(a) Information about any individual who is or was an officer or employee of a government institution that relates to the position or functions of the individual, including:</li>
                  
                  <li>(1) The fact that the individual is or was an officer or employee of the government institution;</li>
                  
                  <li>(2) The title, business address and office telephone number of the individual;</li>
                  
                  <li>(3) The classification, salary range and responsibilities of the position held by the individual; and</li>
                  
                  <li>(4) The name of the individual on a document prepared by the individual in the course of employment with the government;,/

                  
                  <li>(b) Information about an individual who is or was performing service under contract for a government institution that relates to the services performed, including the terms of the contract, and the name of the individual given in the course of the performance of those services;</li>
                  
                  <li>(c) Information relating to any discretionary benefit of a financial nature such as the granting of a license or permit given by the government to an individual, including the name of the individual and the exact nature of the benefit;</li>
                  
                  <li>(d) Personal information processed for journalistic, artistic, literary or research purposes;</li>
                  
                  <li>(e) Information necessary in order to carry out the functions of public authority which includes the processing of personal data for the performance by the independent, central monetary authority and law enforcement and regulatory agencies of their constitutionally and statutorily mandated functions. Nothing in this Act shall be construed as to have amended or repealed Republic Act No. 1405, otherwise known as the Secrecy of Bank Deposits Act; Republic Act No. 6426, otherwise known as the Foreign Currency Deposit Act; and Republic Act No. 9510, otherwise known as the Credit Information System Act (CISA);</li>
                  
                  <li>(f) Information necessary for banks and other financial institutions under the jurisdiction of the independent, central monetary authority or Bangko Sentral ng Pilipinas to comply with Republic Act No. 9510, and Republic Act No. 9160, as amended, otherwise known as the Anti-Money Laundering Act and other applicable laws; and</li>
                  
                  <li>(g) Personal information originally collected from residents of foreign jurisdictions in accordance with the laws of those foreign jurisdictions, including any applicable data privacy laws, which is being processed in the Philippines.</li>

                  </ul>   
                  </p>
                  <li>SEC. 5. Protection Afforded to Journalists and Their Sources. – Nothing in this Act shall be construed as to have amended or repealed the provisions of Republic Act No. 53, which affords the publishers, editors or duly accredited reporters of any newspaper, magazine or periodical of general circulation protection from being compelled to reveal the source of any news report or information appearing in said publication which was related in any confidence to such publisher, editor, or reporter.</li>
                  
                  <li> 6. Extraterritorial Application. – This Act applies to an act done or practice engaged in and outside of the Philippines by an entity if:</li>
                  <p>
                      <ul>
                 <li> (a) The act, practice or processing relates to personal information about a Philippine citizen or a resident;</li>
                  
                  <li>(b) The entity has a link with the Philippines, and the entity is processing personal information in the Philippines or even if the processing is outside the Philippines as long as it is about Philippine citizens or residents such as, but not limited to, the following:</li>
                  
                  <li>(1) A contract is entered in the Philippines;</li>
                  
                  <li>(2) A juridical entity unincorporated in the Philippines but has central management and control in the country; and</li>
                  
                  <li>(3) An entity that has a branch, agency, office or subsidiary in the Philippines and the parent or affiliate of the Philippine entity has access to personal information; and</li>
                  
                  <li>(c) The entity has other links in the Philippines such as, but not limited to:</li>
                  
                  <li>(1) The entity carries on business in the Philippines; and</li>
                  
                  <li> (2) The personal information was collected or held by an entity in the Philippines.</li>
                      </ul>
                  </p>
              </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          </div>
        </div>
      </div>
    </div>

@include('admin.partials.footer')
@include('admin.partials.javascripts')
@endsection
