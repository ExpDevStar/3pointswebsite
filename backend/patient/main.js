$(document).ready(function () {

    $(document).on('click', '.editPatient', function () {
        var medicalRecord = $(this).data('medicalrecord');
        var patientname = $(this).data('patientname');
        var patient_id = $(this).data('id');
        
        $.ajax({
            url: 'backend/patient/Controller.php',
            type: 'POST',
            data: {action: 'getPatientDetail', id: patient_id},
            success: function (data) {
                var data = JSON.parse(data);
                console.log(data);
                var firstname = data.data[0].firstname;
                var lastname = data.data[0].lastname;
                var medicalrecord = data.data[0].medicalrecord;
                var hospital = data.data[0].hospital;
                $("#firstname").val(firstname);
                $("#lastname").val(lastname);
                $("#medicalrecord").val(medicalrecord);
                $("#hospital").val(hospital);
                $("#patient_id").val(patient_id);
                $('#editPatient').modal('show');

                $("#code_result").html(data.code_result);
				
				//CB
				/* $('.patient_code_sort li').sort(function(a, b)
				{
					 return $(a).data('order') - $(b).data('order');
				}).appendTo('.patient_code_sort'); */
				
                if(data.medicalrecordinput !='' && data.medicalrecordinput!=null) {
                    $("#medicalrecordinput").val(data.medicalrecordinput);
                }
                
                $('.js-data-example-ajax').select2('data', null);
                $('.js-data-example-ajax').empty().trigger("change"); 
                
                $(".patient_code_sort").sortable({
                    tolerance: 'touch',
                    placeholder: "ui-state-highlight",
                    stop: function (evt, ui) {
                        //console.log("stop event");    
                        var code_list = '';
                        $('#sortable li').each(function (i, obj) {
                            console.log(obj);
                            var code_id = $(obj).attr('data-cart-id');
                            //console.log(code_id);
                            code_list += "," + code_id;
                        });
                        if (code_list != "") {
                            code_list = code_list.slice(1);
                        }
                        console.log(code_list);
                        $("#medicalrecordinput").val(code_list);
						$("#customsorting").val('1');
						
						
						
                    },
                }); 

                //$("#sortable").disableSelection();

            }
        });

    });
    
    /******************Edit code *******************/
    $('.filter-modal select').css('width', '100%');
    $('.js-data-example-ajax').select2({
        placeholder: "Please select code",
        //dropdownParent: $("#editPatient"),
        //tags: [],
        multiple: true,
        ajax: {
            url: 'getcode_select.php',
            dataType: 'json',
            quietMillis: 50,
            type: "GET",
            data: function (term) {
                return {
                    term: term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.items, function (item) {
                        return {
                            text: item.text,
                            slug: item.slug,
                            id: item.id,
                            icd_secondary_ranking: item.icd_secondary_ranking,
                            icd_ranking: item.icd_ranking
                        }
                    })
                };
            }
        }
    });
	
	//CB10-10
	$(document).on('click','.select2-selection__choice__remove',function(){
		
		var gh = $(this).closest('li').attr('title');
		$('#code_result').find('li').each(function(){
			// this is inner scope, in reference to the .phrase element
			var codeExists = '';
							
			var g = $(this).data('cart-id');
			console.log(g);
			if(g === gh){
				$(this).remove();
			}			
		});
		
	});
	//CB10-10
	$(document).on('click','.removeC',function(){
		
		$(this).closest('li').remove();
		var t = $(this).closest('li').data('cart-id');
		  	$('.select2-selection__rendered').find('li').each(function(){
										
			var g = $(this).attr('title');
			if(g === t){
				$(this).find('.select2-selection__choice__remove').trigger('click');
			}			
		});
		
		var medicalrecordinput = $("#medicalrecordinput").val();
		var medicalrecordinputArr = medicalrecordinput.split(',');
		for (var i = medicalrecordinputArr.length - 1; i >= 0; i--) {
			if(medicalrecordinputArr[i] == t){
				medicalrecordinputArr.splice(i,1);
			}
		}
		var finalVal = medicalrecordinputArr.join(',');
		$("#medicalrecordinput").val(finalVal);
		
	});
    
    $('.js-data-example-ajax').on("select2:select", function (e) {
        console.log("selected tag");
        console.log(e.params.data);
        var id = e.params.data.id;
        var slug = e.params.data.slug;
        var text = e.params.data.text;
        var icd_secondary_ranking = e.params.data.icd_secondary_ranking;
        var icd_ranking = e.params.data.icd_ranking;
		//CB10-10
        var full_text = '<b>'+text+'-'+slug+'</b>&nbsp;&nbsp;<button type="button" class="removeC close" aria-label="Close"><span aria-hidden="true">×</span></button></li>';
		
		
			
		//CB10-10
		var codeExist = [];

		$('#code_result').find('li').each(function(){
			// this is inner scope, in reference to the .phrase element
			var codeExists = '';
							
			var g = $(this).data('cart-id');
			console.log(g);
			if(g === id){
				codeExists += id;
				codeExist.push(codeExists);
			}			
		});
		
		//CB10-10
		if(codeExist.length == 0){	
		
		
			if ( icd_secondary_ranking == '0' || icd_secondary_ranking == '' || icd_secondary_ranking == 'undefined' || icd_secondary_ranking == null )
			{
				  if(icd_ranking != 'N/A'){
					var ranking = icd_ranking;
				  }
				  else{
					  var ranking = '';
				  }
			}
			else {
				// var cartRankAdjusted = + 9.0 + icd_secondary_ranking;
				var ranking = icd_secondary_ranking;
             
			}
		
			var $li = $("<li  class='ui-state-default' data-cart-id='"+id+"' data-order='"+ranking+"' />").html(full_text);
			$(".patient_code_sort").append($li);
			//alert("rere");
			$(".patient_code_sort").sortable('refresh');
			if($('#customsorting').val() == '')
			{
				
				$('.patient_code_sort li').sort(function(a, b)
				{
					return $(a).data('order') - $(b).data('order');
					 
				}).appendTo('.patient_code_sort');
			}
			
			var medicalrecordinput = $("#medicalrecordinput").val();
			$("#medicalrecordinput").val(medicalrecordinput+','+id);
		
		}
		else{
			//CB10-10
			/* $('.select2-selection').find('li.select2-selection__choice').each(function(){
									
				var g = $(this).attr('title');
			
				if(g === id){
					//$(this).find('.select2-selection__choice__remove').trigger('click');
					$(this).closest('li').remove();
				}			
			}); */
			alert("Code is already exists");
			return false;
		}
        
    });
    
    /*var source1 = new Bloodhound({
       datumTokenizer: Bloodhound.tokenizers.obj.whitespace('icd_code'),
       queryTokenizer: Bloodhound.tokenizers.whitespace,
       remote: {
           url: 'getautocomplete.php?st=%QUERY',
           wildcard: '%QUERY'
       }
    });

    // Initialize the Bloodhound suggestion engine
    source1.initialize();
    //source2.initialize();
    $('#suggest').typeahead(null,
    { 
        name: 'source1',
        display: 'icd_code',
        highlight:true,
        source: source1.ttAdapter(),
        templates:
        {
          suggestion: function(data)
          {
            // lists all suggestions
            var details = "<div>" + data +"</div>";
            return details
          }

        }
    });   
    
    
    
    // Listen to when a selection is made
    $('#suggest').on('typeahead:selected', function(e, datum)
    { 
      var datumConvert = JSON.stringify(datum);
      if (datumConvert.includes(":")) {
          var stripDatum2 = datumConvert.substring(0, datumConvert.lastIndexOf(":"));
          var stripDatum3 = stripDatum2.replace(/[\[\]""]+/g, '');
          $('.hidden-cat').val(stripDatum3)
          $('.hidden-id').val(stripDatum3)
      } else {
        var stripDatum = datumConvert.replace(/[{()}]/g, '');
        var stripDatum3 = stripDatum.replace(/[\[\]""]+/g, '');
        $('.hidden-cat').val(stripDatum3)
        $('.hidden-id').val(stripDatum3)
      }
      var hiddenCat = $('.hidden-cat').val();
      var hiddenID = $('.hidden-id').val();
      $('#suggest').val('test');
    }); */

    /**********************************/

    $(document).on('click', '.deletePatient', function () {
        var medicalRecord = $(this).data('medicalrecord');
        var patientname = $(this).data('patientname');
        var patient_id = $(this).data('id');
        $.ajax({
            url: 'backend/patient/Controller.php',
            type: 'POST',
            data: {action: 'deletePatient', id: patient_id},
            success: function (data) {
                var data = JSON.parse(data);
                if (data.status == "1") {
                    
                } else {
                    
                }
                getpatient();
            }
        });

    });

    $(document).on('click', '.submitPatient', function () {
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var medicalrecord = $("#medicalrecord").val();
        var hospital = $("#hospital").val();
        var patient_id = $("#patient_id").val();
        
        
        /*var code_data = $(".js-data-example-ajax").select2("val");
        $("#medicalrecordinput").val(code_data);*/
        var medicalrecordinput = $("#medicalrecordinput").val();
        
        var error_count = 0;
        if (firstname == '') {
            $("#firstname").addClass('has-error');
            error_count++;
        } else {
            $("#firstname").removeClass('has-error');
        }
        if (lastname == '') {
            $("#lastname").addClass('has-error');
            error_count++;
        } else {
            $("#lastname").removeClass('has-error');
        }
        if (medicalrecord == '') {
            $("#medicalrecord").addClass('has-error');
            error_count++;
        } else {
            $("#medicalrecord").removeClass('has-error');
        }
        if (hospital == '') {
            $("#hospital").addClass('has-error');
            error_count++;
        } else {
            $("#hospital").removeClass('has-error');
        }
        if (error_count == 0) {
            $.ajax({
                url: 'backend/patient/Controller.php',
                type: 'POST',
                data: {action: 'savePatient', id: patient_id, firstname: firstname, lastname: lastname, medicalrecord: medicalrecord, hospital: hospital,medicalrecordinput:medicalrecordinput},
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.status == "1") {
                        $('#editPatient').modal('hide');
                        getpatient();
                    } else {
                        $(".alert-danger").show();
                        $(".alert-danger").text(data.msg);
                        //$('#editPatient').modal('hide');
                    }
                }
            });
        } else {
            return false;
        }

    });
});
