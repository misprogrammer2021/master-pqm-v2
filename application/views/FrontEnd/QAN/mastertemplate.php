<?php 

if(@$show_section1 == TRUE OR @$show_allsection == TRUE)
include('D:\xampp\htdocs\PQM\application\views\FrontEnd\section1.php');
if(@$show_section3 == TRUE OR @$show_allsection == TRUE)
include('D:\xampp\htdocs\PQM\application\views\FrontEnd\section3.php');
if(@$show_section4 == TRUE OR @$show_allsection == TRUE)
include('D:\xampp\htdocs\PQM\application\views\FrontEnd\section4.php');
if(@$show_section2 == TRUE OR @$show_allsection == TRUE)
include('D:\xampp\htdocs\PQM\application\views\FrontEnd\section2.php');
if(@$show_section5 == TRUE OR @$show_allsection == TRUE)
include('D:\xampp\htdocs\PQM\application\views\FrontEnd\section5.php');



?>;

<!-- Jquery Core Js -->
<script src="<?=base_url('assets/templates/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('/assets/templates/plugins/momentjs/moment.js')?>"></script>
<!-- Bootstrap Date Time Picker Js -->
<script src="<?=base_url('/assets/templates/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')?>"></script>


<script>
$( document ).ready(function() {
    if(!$('#scrap').length == 0) enableDisableAll();
    
    $('input[data-type="spc"],input[data-type="visual"]').click(function() {
        if($(this).attr('data-type') !="spc") $('input[data-type="spc"]').prop('checked', false);
        else $('input[data-type="visual"]').prop('checked', false);
    });

   
    $("#select_sector").on('change', function() {
            var selected_sector_id = this.value
            $.post("get_machine",{ sector_id: selected_sector_id })
            .done(function(data) {

                $("#select_machine_no").html('');
                $.each(JSON.parse(data),function(key, value) 
                {
                    $("#select_machine_no").append('<option value="'+ value.id +'">'+ value.machine_name +'</option>')
                    .selectpicker('refresh');
                });
                
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                //alert( "finished" );
            });
                // var sector=$("#select_sector").val();
                // $.ajax({
                // type:"post",
                // url:"/FrontEnd/get_sector",
                // data:"select_sector="+sector,
                // success:function(data){
                //         $("#select_machine_no").html(data);
                // }
                // });
    });

        $("div#defect_checkbox input[type='checkbox']").on('change', defect_desc_dropdown);

        defect_desc_dropdown();
    
});


//Function Populate Defect Description Dropdown

function defect_desc_dropdown(){
    var types = '';
    var showOrHide;
    $("div#defect_checkbox input[type='checkbox']").each(function () {
        if (this.checked){
            types +=  $(this).attr('data-type') + ',';
        }
        
    });
    if(types == ''){
        showOrHide = false;
    }else{
        types = types.replace(/,\s*$/, "");
        $.post("<?=base_url('FrontEnd/get_defect_desc');?>",{ defect_type: types })
        .done(function(data) {
            showOrHide = true;
            $("#select_defect").html('<option value="">--Please Select--</option>');//'<option value="">--Please Select--</option>'
            // $("#defect_description").append('<option value="">--Others--</option>')
            $.each(JSON.parse(data),function(key, value) 
            {
                $("#select_defect").append('<option value="'+ value.id +'">'+ value.defect_description_name +'</option>')
                .selectpicker('refresh');
                
            });
            <?php 
            
                if(@$data->defect_description_id) {
                    
            ?>
                $('#select_defect').val(<?php echo @$data->defect_description_id;?>).selectpicker('refresh');
            <?php        
                }

            ?>
            

        })
        
        .fail(function() {
            alert( "error" );
        })
        .always(function() {
            //alert( "finished" );
        });
            
    }
    // $("#defectives").toggle(showOrHide);
    // $('[name="defect_description_name"]').toggleClass('required',showOrHide )
}

//Datetimepicker plugin
$('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        clearButton: true,
        weekStart: 1
});

$('.datepicker').bootstrapMaterialDatePicker({
    format: 'dddd DD MMMM YYYY',
    clearButton: true,
    weekStart: 1,
    time: false
});

$('.timepicker').bootstrapMaterialDatePicker({
    format: 'HH:mm A',
    clearButton: true,
    date: false
});

$('#issued_by_user').attr('disabled', true);

$('#reported_by_mrb').attr('disabled', true);

$('table.mrb-form').find('input.form-control').hide();

$('table.mrb-form').find("input.checkbox-active:checked").parents('tr').find('input.form-control').show();

  
$('table.mrb-form').find('input.qasample-qty').show();
$('table.mrb-form').find('input.total_affected_qty').show();
$('table.mrb-form').find('input.total_good_qty').show();
$('table.mrb-form').find('input.total_rej_qty').show();

//total aff QA Sample Qty
var totalPoints = 0;
$('input.input_qty_qasample').each(function(){
    if($(this).val())
    totalPoints = parseFloat($(this).val()) + totalPoints;
});
$('#total_qa_sample').val(totalPoints);
$('input[name="qa_sample_affected_qty"]').val(totalPoints);

//Prod Qty disabled first on sect 1
// totalPoints = 0;
// $('input.input_qty_prod').each(function(){
//     totalPoints = parseFloat($(this).val()) + totalPoints;
// });
// if(totalPoints > 0)
// $('#total_prod').val(totalPoints);

//total column of affected qty
var totalAffQty = 0;
$('input#total-affqty').each(function(){
    if($(this).val())
    totalAffQty = parseFloat($(this).val()) + totalAffQty;
});
$('#total_affected_qty').val(totalAffQty);

//total column good qty
var totalGoodQty = 0;
$('input#total-goodqty').each(function(){
    if($(this).val())
    totalGoodQty = parseFloat($(this).val()) + totalGoodQty;
});
$('#total_good_qty').val(totalGoodQty);

//total column rej qty
var totalRejQty = 0;
$('input#total-rejqty').each(function(){
    if($(this).val())
    totalRejQty = parseFloat($(this).val()) + totalRejQty;
});
$('#total_rej_qty').val(totalRejQty);


// $(function() { 
//     $('#defect_opt').change(function() {
//          $('#defect_description').val($(this).val());
//     }).change(); // Trigger the event
// });

$("input.checkbox-active").click(function(){
    if ($(this).prop('checked')) {
        $(this).parents('tr').find('input.form-control').fadeIn();
    } else {
        $(this).parents('tr').find('input.form-control').hide();
    }
});

$(".with-gap").click(function() {
    $("#reject_reason").attr("disabled", true);
        if ($("#qa_reinsp_status_reject:checked").val() == "0") {
            $("#reject_reason").attr("disabled", false);
    }
});


$('div.selectresult, table.rootcause-form input.form-control').each(function(){
    var a = $(this).parents('td').index();
    var b = $(this).parents('tr').siblings('tr').find('th:eq('+a+') input').prop( "checked" );
    var c = $(this).parents('tr').siblings('tr').find('th:eq('+a+') input').prop( "disabled" );
    // console.log(b);
    if (!b) 
    $(this).hide();

    // $(this).prop('disabled', function(i, v) { return !v; });

    $(this).prop('disabled', !b || c);
});

$('#eng_content2').on('change','input.checkbox-tab',function(e){
    
    var indexCheckbox = $(this).parents('th').index();
    var theId = parseInt($(this).attr('id').replace(/[^\d]/g, ''), 10);
    // alert(theId);
    // $('div#sub'+theId).find('input.form-control, div.selectresult').slideToggle('slow');
    $(this).parents('tr').siblings('tr').find('td:eq('+indexCheckbox+') input.form-control, td:eq('+indexCheckbox+') div.selectresult').slideToggle('slow').prop('disabled', function(i, v) { return !v; });
    // $('div.selectresult, table.rootcause-form input.form-control').each(function(){
    // $(this).slideToggle('slow');
    // });


    // $(this).parents().find().each(function(){
        // alert($(this).attr('id'));
    // $(this).parents('tr').siblings().find('td:eq('+indexCheckbox+') input.form-control').slideToggle('slow');
    // $('tr.selectresult.dropdown').find('td:eq('+indexCheckbox+')').slideToggle('slow');
    // $('td div.selectresult:eq('+(indexCheckbox-1)+')').slideToggle('slow');
    // $(this).parents('tr').siblings().find('td:eq('+indexCheckbox+') div.selectresult').slideToggle('slow');
    // });
});

// $('td.header2').hide(); // hide the column header th

// $('tr').each(function(){
//     $(this).find('td:eq('+$('td.header2').index()+')').hide();
// });

// $('#add_sub1').click(function (e) {
//     $('#asma').html('<a href="javascript:;" id="add_sub2"><span class="btn btn-success">Show</span></a>');
//     $('#asma').append('<div id="asma2"><select class="form-control show-tick" name="inspect_by[1]"><option value="" disabled selected>-- Please Select --</option><option value="8">Jaydul Hasan</option><option value="13">Anggia Permata</option><option value="14">Tannya Rahmadani</option><option value="15">Rabiul Islam</option><option value="18">Abu Sayd</option><option value="19">Joy Ahamed</option><option value="21">Ade Rahmadani</option><option value="23">Syarifah Wahyuni</option><option value="24">Santa Klara Barus</option><option value="26">Riaz Uddin</option><option value="27">MD. Azaharul</option></select></div>');
//     $('div#asma2').each(function(){
//     $(this).hide();
//         $( "#add_sub2" ).on( "click", function() {
//             $('div#asma2').slideToggle('slow');
//         });
//     });
//     // $.AdminBSB.browser.activate();
//     // $.AdminBSB.leftSideBar.activate();
//     // $.AdminBSB.rightSideBar.activate();
//     // $.AdminBSB.navbar.activate();
//     $.AdminBSB.dropdownMenu.activate();
//     $.AdminBSB.input.activate();
//     $.AdminBSB.select.activate();
//     $.AdminBSB.search.activate();
// });


$('#add_sub').click(function (e) {
    var nextTab = $('#eng_tab2 li').size();

    // create the tab
    $(this).closest('li')
    .before('<li role="presentation"><a href="#sub'+nextTab+'" data-toggle="tab"><i class="material-icons">insert_drive_file</i>'+ordinal_suffix_of(nextTab)+' Submission</a></li>');

    //var $clone = $("#sub").clone();    // Create your clone

    var $clone;
     $.ajax({
     url: "",
     type: "POST",
     dataType : "html",
     success: function (data){
         
        var $html = $('<html />').html(data);
        $clone = $html.find("div#sub").clone();//$(data).find("#sub").clone();
        $clone.attr('id',$clone.attr('id')+nextTab ); 

        $clone.find('b.qasubmission').text('QA Inspection Data - ' + ordinal_suffix_of(nextTab)+' Submission Data')
        $clone.find('input[name^="submission_no"]').val(nextTab);
        $clone.find('input[name^="completion_datetime"]').val(moment().format('YYYY-MM-DD h:mm:ss A'));
        // Find all elements in $clone that have an ID, and iterate using each()
        $clone.find('[id]').each(function() { 

        //Perform the same replace as above
        var $th = $(this);
        var $thname = $th.attr('name');
        var $thname_array = $thname.split('[');
        $thname = $thname_array[0]+'['+nextTab+']['+$thname_array[1];
        $(this).attr('name', $thname);
        var $tfor = $(this).siblings('label');
        var $select_button = $(this).siblings('button');
        //var newID = $th.attr('id').replace(/\d+$/, function(str) { return parseInt(str) + 1; });
        // var newID = $th.attr('id')+nextTab; 

        var newID = $th.attr('id'); 
        $thname_array = newID.split("_0_");
        newID = $thname_array[0]+'_' +nextTab+'_' +$thname_array[1];

        $th.attr('id', newID);

        if($select_button.data('id') != null){
            $select_button.attr('data-id',newID);
            console.log($select_button.data('id'))
        }

        if($tfor.attr('for') != null)
        {
            $tfor.attr('for', newID);
        }
            
        });

        // $clone.find('[id]').each(function(i,e){
        //     var $th = $(this).siblings('button');
        //     $th.data('id',123)
        //     console.log($th.data('id'))
        // })
           
        

        $clone.find('div.selectresult, table.rootcause-form input.form-control').each(function(){
            $(this).hide();
            $(this).prop('disabled', function(i, v) { return !v; });
        });


        $clone.appendTo('#eng_content2');

        // make the new tab active
        $('#eng_tab2 li:nth-child('+nextTab+') a').click();

        //$('#add_sub').hide();

        $('.timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            date: false
        });

        $.AdminBSB.dropdownMenu.activate();
        $.AdminBSB.input.activate();
        $.AdminBSB.select.activate();

     }
     })


    
});

// function CheckOthers(val){
// //  var element=document.getElementById('others');
// var element=$("#defectives option:selected").text();
//  if(val=='Others')
//    element.style.display='block';
//  else  
//    element.style.display='none';
// }

function ordinal_suffix_of(i) {
    var j = i % 10,
        k = i % 100;
    if (j == 1 && k != 11) {
        return i + "st";
    }
    if (j == 2 && k != 12) {
        return i + "nd";
    }
    if (j == 3 && k != 13) {
        return i + "rd";
    }
    return i + "th";
};

function enableDisableAll() {
    cb1 = document.getElementById('scrap').checked;
    cb2 = document.getElementById('rework').checked;
    cb3= document.getElementById('uai').checked;

    document.getElementById('scrap_no').disabled = !cb1;
    document.getElementById('rework_order_no').disabled = !cb2;
    document.getElementById('uai_no').disabled = !cb3;

   
    document.getElementById('rework_dispo_input').disabled = !((cb2 || cb3) && !cb1);
    document.getElementById('rework_dispo_output').disabled = !((cb2 || cb3) && !cb1);
    document.getElementById('rework_dispo_rej_scrap').disabled = !((cb2 || cb3) && !cb1);

    $("#scrap_no:disabled").val('');
    $("#rework_order_no:disabled").val('');
    $("#uai_no:disabled").val('');
    $("#rework_dispo_input:disabled").val('');
    $("#rework_dispo_output:disabled").val('');
    $("#rework_dispo_rej_scrap:disabled").val('');

}

</script>

