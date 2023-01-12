      
       $("#custname").change(function (event) {
            event.preventDefault();
            var fname = document.getElementById("fname"); 
            var forfname = document.getElementById("forfname"); 
            var mname = document.getElementById("mname"); 
            var formname = document.getElementById("formname"); 
            var lname = document.getElementById("lname"); 
            var forlname = document.getElementById("forlname"); 
            var corp = document.getElementById("corp"); 
            var forcorp = document.getElementById("forcorp"); 
            var bdate = document.getElementById("forbdate");
            var bdateinc = document.getElementById("forbdateinc");
            var e = document.getElementById("custname");
            var text = e.options[e.selectedIndex].value;
            if(text == "Individual Account") {
                fname.style.display = "block";
                forfname.style.display = "block";
                mname.style.display = "block";
                formname.style.display = "block";
                lname.style.display = "block";
                forlname.style.display = "block";
                bdate.style.display = "block";
                bdateinc.style.display = "none";
                corp.style.display = "none";
                forcorp.style.display = "none";
                corp.removeAttribute("required");
                corp.required = false;  
                fname.setAttribute("required", "");
                mname.setAttribute("required", "");
                lname.setAttribute("required", "");
            }
            else if(text == "Corporate Account") {
                corp.style.display = "block";
                forcorp.style.display = "block";
                bdateinc.style.display = "block";
                bdate.style.display = "none";
                fname.style.display = "none";
                forfname.style.display = "none";
                mname.style.display = "none";
                formname.style.display = "none";
                lname.style.display = "none";
                forlname.style.display = "none"; 
                fname.removeAttribute("required");
                mname.removeAttribute("required");
                lname.removeAttribute("required");
                corp.setAttribute("required", "");
            }

        });
    //     $("#filterBy").change(function (event) {
        
    //     var e = document.getElementById("filterBy");
    //     var text = e.options[e.selectedIndex].value;
    //     if(text == "Name") {
    //         document.getElementById("filterHolder").placeholder = "Filter by Name";
    //     } else if(text == "Tin") {
    //         document.getElementById("filterHolder").placeholder = "Filter by Tin";
    //     }
    // });

        $('#region').on('change', function() {
            var region = this.value;
            $.ajax({
            url: "././address/province.php",
            type: "POST",
            data: {
                region: region
            },
            cache: false,
            success: function(result){
            $("#province").html(result);
            $("#city").html('<option readonly>City</option>');
            $("#barangay").html('<option readonly>Barangay</option>');
            }
            });
            });    

        $('#province').on('change', function() {
            var province = this.value;
            $.ajax({
            url: "././address/city.php",
            type: "POST",
            data: {
            province: province
            },
            cache: false,
            success: function(result){
            $("#city").html(result);
            $("#barangay").html('<option readonly>Barangay</option>');

            }
            });
            });

        $('#city').on('change', function() {
                var city = this.value;
                $.ajax({
                url: "././address/barangay.php",
                type: "POST",
                data: {
                    city: city
                },
                cache: false,
                success: function(result){
                $("#barangay").html(result);
                }
                });
                });

