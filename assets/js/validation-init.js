var Script = function () {

    /*$.validator.setDefaults({
        submitHandler: function() { alert("submitted!"); }
    });*/

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });




///Register Business



  // validate signup form on keyup and submit
        $("#reg_business").validate({
			rules: {
              
                business_display_name: "required",
				 business_short_desc: "required",
				 business_cat_id: "required",
               
			    business_website: {
                    required: true,
                    url: true
                },
				
				 business_desc: "required",
				  business_stime: "required",
				   business_etime: "required",
               
			
                business_email: {
                    required: true,
                    email: true
                },
				business_phone: {
                    required: true,
                }
				/*img: {
                   accept: "image",
                },
               /* topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                }*/
                
            },
            messages: {
                business_name: "Please enter your business name",
                business_display_name: "Please enter business display name",
                
                business_email: "Please enter a valid email address"
				 
               
            }
			
        });
		

////// End register business


//

// validate signup form on keyup and submit
        $("#business_img").validate({
			rules: {
              
               
				photo: {
                    required: true,
                }
				/*img: {
                   accept: "image",
                },
               /* topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                }*/
                
            },
            
			
        });
//
////add/edit staff

// validate signup form on keyup and submit
        $("#add_staff").validate({
			rules: {
              
                location: "required",
				 fname: "required",
				 lname: "required",
               
			    business_website: {
                    required: true,
                    url: true
                },
				
				 password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
			
                email: {
                    required: true,
                    email: true
                },
				contact_number: {
                    required: true,
                }
				/*img: {
                   accept: "image",
                },
               /* topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                }*/
                
            },
            messages: {
                business_name: "Please enter your business name",
                business_display_name: "Please enter business display name",
                
                business_email: "Please enter a valid email address",
				password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long",
                    equalTo: "Please enter the same password as above"
                }
               
            }
			
        });

/////

/////////Add Locations

  $("#add_locations").validate({
		 rules: {
                searchTextField: "required",
				location_name:"required",
                city: "required",
				 state: "required",
				 country: "required"
				
			 }
        });
////////////////////

       // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();