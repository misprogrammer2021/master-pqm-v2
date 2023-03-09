<?php 

if(@$show_section1 == TRUE OR @$show_allsection == TRUE)
include(APPPATH .'views/FrontEnd/section1.php');
if(@$show_section2 == TRUE OR @$show_allsection == TRUE)
include(APPPATH .'views/FrontEnd/section2.php');
if(@$show_section3 == TRUE OR @$show_allsection == TRUE)
include(APPPATH .'views/FrontEnd/section3.php');
// if(@$show_section4 == TRUE OR @$show_allsection == TRUE)
// include(APPPATH .'views/FrontEnd/section4.php');
if(@$show_section5 == TRUE OR @$show_allsection == TRUE)
include(APPPATH .'views/FrontEnd/section5.php');
// if(@$test == TRUE OR @$show_allsection == TRUE)
// include(APPPATH .'views/FrontEnd/QAN/machinebreakdown.php');

?>;

<!-- Jquery Core Js -->
<script src="<?=base_url('assets/templates/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('/assets/templates/plugins/momentjs/moment.js')?>"></script>
<!-- Bootstrap Date Time Picker Js -->
<script src="<?=base_url('/assets/templates/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')?>"></script>


<script>

    $( document ).ready(function() {

        $(document).delegate('a.add-record-sublot', 'click', function(e) {
            e.preventDefault();    
            var content = $('#clone_tbl_sublot tr'),
            size = $('#tbl_sublot >tbody >tr').length + 1,
            element = null,    
            element = content.clone();
            element.attr('id', 'rec-'+size);
            element.find('.delete-record-sublot').attr('data-id', size);
            element.appendTo('#tbl_sublot_body');
            element.find('.sn').html(size);
        });
        $(document).delegate('a.delete-record-sublot', 'click', function(e) {
            e.preventDefault();    
            var didConfirm = confirm("Are you sure You want to delete");
            if (didConfirm == true) {
                var id = $(this).attr('data-id');
                var targetDiv = $(this).attr('targetDiv');
                $('#rec-' + id).remove();
                
                //regnerate index number on table
                $('#tbl_sublot_body tr').each(function(index){
                    $(this).find('input.sn').html(index+1);
                });
                return true;
            } else {
                return false;
            }
        });

        $(document).delegate('a.add-record-buyoff', 'click', function(e) {
            e.preventDefault();    
            var content = $('#clone_tbl_buyoff tr'),
            size = $('#tbl_buyoff >tbody >tr').length + 1,
            element = null,    
            element = content.clone();
            element.attr('id', 'rec-'+size);
            element.find('.delete-record-buyoff').attr('data-id', size);
            element.appendTo('#tbl_buyoff_body');
            element.find('.sn').html(size);
        });
        $(document).delegate('a.delete-record-buyoff', 'click', function(e) {
            e.preventDefault();    
            var didConfirm = confirm("Are you sure You want to delete");
            if (didConfirm == true) {
                var id = $(this).attr('data-id');
                var targetDiv = $(this).attr('targetDiv');
                $('#rec-' + id).remove();
                
                //regnerate index number on table
                $('#tbl_buyoff_body tr').each(function(index){
                    $(this).find('input.sn').html(index+1);
                });
                return true;
            } else {
                return false;
            }
        });

        // $(document).delegate('a.add-defect-decs', 'click', function(e) {
        //     e.preventDefault();    
        //     var content = $('#clone_tbl_defect tr'),
        //     size = $('#tbl_defect >tbody >tr').length + 1,
        //     element = null,    
        //     element = content.clone();
        //     element.attr('id', 'rec-'+size);
        //     element.appendTo('#tbl_defect_body');
        //     // $.AdminBSB.dropdownMenu.activate();
        //     // $.AdminBSB.input.activate();
        //     // $.AdminBSB.select.activate();
        // });


        /* https://stackoverflow.com/questions/33722048/how-to-add-dynamic-row-jquery-having-dynamic-dropdown-in-php */

       

        // $("a.add-defect").click(function(){
        //     $("span#defectives").clone().appendTo("#clonedefect");
        // });
      
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
            });
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
            });
        }
        
    }

    // function AddDropDownList() {

    //     $.ajax({
    //         url: '<?= base_url("FrontEnd/get_defect_desc") ?>',
    //         method: "post",
    //         dataType: 'html'
        
    //     //Build an array containing Customer records.
    //     var customers = [
    //         { CustomerId: 1, Name: "John Hammond", Country: "United States" },
    //         { CustomerId: 2, Name: "Mudassar Khan", Country: "India" },
    //         { CustomerId: 3, Name: "Suzanne Mathews", Country: "France" },
    //         { CustomerId: 4, Name: "Robert Schidner", Country: "Russia" }
    //     ];
    //     //Create a DropDownList element.
    //     var ddlCustomers = $("<select />");

    //     //Add the Options to the DropDownList.
    //     $(customers).each(function () {
    //         var option = $("<option />");

    //         //Set Customer Name in Text part.
    //         option.html(this.Name);

    //         //Set CustomerId in Value part.
    //         option.val(this.CustomerId);

    //         //Add the Option element to DropDownList.
    //         ddlCustomers.append(option);
    //     });

    //     //Reference the container DIV.
    //     var dvContainer = $("#dvContainer")

    //     //Add the DropDownList to DIV.
    //     var div = $("<div />");
    //     div.append(ddlCustomers);

    //     //Create a Remove Button.
    //     var btnRemove = $("<input type = 'button' value = 'Remove' />");
    //     btnRemove.click(function () {
    //         $(this).parent().remove();
    //     });

    //     //Add the Remove Buttton to DIV.
    //     div.append(btnRemove);

    //     //Add the DIV to the container DIV.
    //     dvContainer.append(div);
    // })
    // };

    // $('select.test').change(function () {
    //     $(this).next('select').show();
    //     //the rest is just simulate your ajax fill of the submenu
    //     var mySelect = $('.category-select-sub');
    //     /* $.each(myOptions, function (val, text) {
    //         mySelect.append(
    //         $('<option></option>').val(val).html(text));
    //     }); */
    // });

    // $('a.add-defect').click(function(e) {
    //     e.preventDefault();
    //     var $newdiv = $('span.new-defect:first').clone();
    //     $newdiv.children('select.category-select-sub').remove();
    //     $('div.new-defects').append($newdiv);
    // });

    // Bind the click event, to the Add button
    $("a.add-defect-decs").click(function () {

        // Create elements dynamically
        var newRow = '<tr><td><?php echo '<select id="select_defect" name="defect_description_id[]" data-show-subtext="true" data-live-search="true" class="show-tick form-control"><option value="">--Please Select--</option>';

                                            foreach($defect_desc as $index => $defect_desc_row){

                                                // echo '<option value="'.$defect_desc_row->id.'">'.$defect_desc_row->defect_description_name.'</option>';
                                                
                                                echo '<option value="'.$defect_desc_row->id.'">'.$defect_desc_row->defect_description_name.' ['.$defect_desc_row->defect_type.']</option>';
                                            }
                                        echo '</select>';
                                        ?>
                                    </td><td><input type="text" id="defect_description_others" name="defect_description_others[]" class="form-control" value=""></td><td><?php echo '<select id="select_osus" name="os_us_id[]" data-show-subtext="true" data-live-search="true" class="show-tick form-control"><option value="">--Please Select--</option>';

                                        foreach($os_us as $index => $os_us_row){

                                            echo '<option value="'.$os_us_row->id.'">'.$os_us_row->name.'</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td><td><?php echo '<select id="select_datum" name="datum_id[]" data-show-subtext="true" data-live-search="true" class="show-tick form-control"><option value="">--Please Select--</option>';

                                        foreach($datum as $index => $datum_row){

                                            echo '<option value="'.$datum_row->id.'">'.$datum_row->name.'</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td><td><?php echo '<select id="select_remarks" name="remarks_id[]" data-show-subtext="true" data-live-search="true" class="show-tick form-control"><option value="">--Please Select--</option>';

                                        foreach($remarks as $index => $remarks_row){

                                            echo '<option value="'.$remarks_row->id.'">'.$remarks_row->name.'</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td></tr>';
                                    


        // Add the new dynamic row after the last row
        $('#tbl_defect tr:last').after(newRow);
        $.AdminBSB.dropdownMenu.activate();
        $.AdminBSB.input.activate();
        $.AdminBSB.select.activate();
    });




//helper stuff
/* 
var myOptions = {
    val1: 'text1',
    val2: 'text2'
}; */
    

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

        if (!b) 
        $(this).hide();
        $(this).prop('disabled', !b || c);
    });

    $('#eng_content2').on('change','input.checkbox-tab',function(e){
        
        var indexCheckbox = $(this).parents('th').index();
        var theId = parseInt($(this).attr('id').replace(/[^\d]/g, ''), 10);
       
        $(this).parents('tr').siblings('tr').find('td:eq('+indexCheckbox+') input.form-control, td:eq('+indexCheckbox+') div.selectresult').slideToggle('slow').prop('disabled', function(i, v) { return !v; });
    });

    $('#add_sub').click(function (e) {

        var nextTab = $('#eng_tab2 li').size();

        // create the tab
        $(this).closest('li')
        .before('<li role="presentation"><a href="#sub'+nextTab+'" data-toggle="tab"><i class="material-icons">insert_drive_file</i>'+ordinal_suffix_of(nextTab)+' Submission</a></li>');

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

                $clone.find('div.selectresult, table.rootcause-form input.form-control').each(function(){
                    $(this).hide();
                    $(this).prop('disabled', function(i, v) { return !v; });
                });

                $clone.appendTo('#eng_content2');

                // make the new tab active
                $('#eng_tab2 li:nth-child('+nextTab+') a').click();

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

    // function yesnoCheck(that) {
    //     if (that.value == "14") {
    //         alert("check");
    //         document.getElementById("ifYes1").style.display = "block";
    //     } else {
    //         document.getElementById("ifYes1").style.display = "none";
    //     }
    // }

    // $(function () {
    //     $("#corrective_action").change(function () {
    //         if ($(this).val() == "14") {
    //             $("#dvothers").show();
    //         } else {
    //             $("#dvothers").hide();
    //         }
    //     });
    // });

</script>

