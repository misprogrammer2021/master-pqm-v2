$(function () {
    skinChanger();
    activateNotificationAndTasksScroll();

    setSkinListHeightAndScroll(true);
    setSettingListHeightAndScroll(true);
    $(window).resize(function () {
        setSkinListHeightAndScroll(false);
        setSettingListHeightAndScroll(false);
    });
});

//Skin changer
function skinChanger() {
    $('.right-sidebar .demo-choose-skin li').on('click', function () {
        var $body = $('body');
        var $this = $(this);

        var existTheme = $('.right-sidebar .demo-choose-skin li.active').data('theme');
        $('.right-sidebar .demo-choose-skin li').removeClass('active');
        $body.removeClass('theme-' + existTheme);
        $this.addClass('active');

        $body.addClass('theme-' + $this.data('theme'));
    });
}

//Skin tab content set height and show scroll
function setSkinListHeightAndScroll(isFirstTime) {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.demo-choose-skin');

    if (!isFirstTime){
      $el.slimScroll({ destroy: true }).height('auto');
      $el.parent().find('.slimScrollBar, .slimScrollRail').remove();
    }

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '6px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Setting tab content set height and show scroll
function setSettingListHeightAndScroll(isFirstTime) {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    if (!isFirstTime){
      $el.slimScroll({ destroy: true }).height('auto');
      $el.parent().find('.slimScrollBar, .slimScrollRail').remove();
    }

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '6px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Activate notification and task dropdown on top right menu
function activateNotificationAndTasksScroll() {
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

$('.chosen_section').chosen({ width: '100%' });

//Datatables Initialization New Task
var table_task= $('#qan_task_list').DataTable({
    "ajax": '/FrontEnd/ajax_get_task',
    "searching": false,
    "columns" : [
        {data : null,
         render: function( data, type, row, meta ){
             return meta.row+1;
         }
        },
        {data : null,
         searchable: true,
         render: function( data, type, row, meta ){
             //return data.0.
           
            var section = '#section1';
            if(row.section=='S1') section = '#section1';
            if(row.section=='S2') section = '#section2';
            if(row.section=='S3') section = '#section3';
            if(row.section=='S4') section = '#section4';
            if(row.section=='S5') section = '#section5';

            // return '<a href="/FrontEnd/mastertemplate/'+ link + '/' + row.details.id +'">'+ row.details.qan_no +'</a>';
            
            return '<a href="/FrontEnd/mastertemplate/' + row.details.id + '/' + section + '">'+ row.details.qan_no +'</a>';
         }
        },
        // {data : null,
        //     searchable: true,
        //     render: function( data, type, row, meta ){
        //         //return data.0.
        //        return row.details.status_name;
        //     }
        // },
        {data : 'status_name',
        render: function( data, type, row, meta ){
            var label = 'warning';
            if(row.details.status_name=="NEW") label = 'info';
            if(row.details.status_name=="ACKNOWLEDGMENT") label = 'warning';
            if(row.details.status_name=="SOLVED") label = 'success';

            return '<div class="display: inline-block;"><span class="label label-'+ label +'">'+row.details.status_name+'</span></div>';
        }
       },
    //    {
    //     "data": null,
    //     orderable: false,
    //     searchable: false,
    //     render: function( data, type, row, meta ){
    //         var qa_s = data.ack.ack_qa_user>0?'teal':'red';
    //         var prod_s = data.ack.ack_prod_user>0?'teal':'red';
    //         var eng_s = data.ack.ack_eng_user>0?'teal':'red';

    //         return '<div class="btn-toolbar" role="toolbar" aria-label="ACK Groups">' +
    //                     '<div class="btn-group btn-group-xs" role="group" aria-label="QA">' +
    //                         '<button type="button" class="btn bg-'+qa_s+'" data-toggle="tooltip" data-placement="top" title="QA">Q</button>' +
    //                         '<button type="button" class="btn bg-'+prod_s+'" data-toggle="tooltip" data-placement="top" title="Production">P</button>' +
    //                         '<button type="button" class="btn bg-'+eng_s+'" data-toggle="tooltip" data-placement="top" title="Engineering">E</button>' +
    //                     '</div>' +
    //                '</div>';
    //     }
    //     },
        {
         data : null,
         searchable: false,
         render: function( data, type, row, meta ){
            return row.desc;
         }
        }
    ],
    responsive: true
});

//Datatables Initialization
var table_active = $('#qan_active_list').DataTable({
    "ajax": '/FrontEnd/ajax_active_list',
    "columns" : [
        {
            "className":      'details-control',
            "data":           null,
            "orderable":      false,
            "searchable":     false,
            "defaultContent": '<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>'
        },
        {data : null,
         render: function( data, type, row, meta ){
             return meta.row+1;
         }
        },
        {data : null,
         searchable: true,
         render: function( data, type, row, meta ){
            return '<a href="/FrontEnd/mastertemplate/'+ row.id +'">'+ row.qan_no +'</a>';
         }
        },
        {data : 'status_name',
         render: function( data, type, row, meta ){
             var label = 'warning';
             var machine_icon_status = 'pause_circle_filled';
             var machine_tooltip = 'Machine Stop';
             if(data=="NEW") label = 'info';
             if(data=="SOLVED" || (data=="MRB")){
                label = 'success';
            }
            if( (parseInt(row.status) < 4) || row.machine_status==1)  {
                machine_icon_status = 'play_circle_filled';
                machine_tooltip = 'Machine Run';
            }
            //  return '<span class="label label-'+ label +'">'+data+'</span>'+machine_running_status;
             return '<div class="display: inline-block;"><a class="my-tool-tip" data-toggle="tooltip" data-placement="top" title="'+machine_tooltip+'"><i class="material-icons col-teal" style="vertical-align: middle;cursor: pointer;">'+machine_icon_status+'</i></a><span class="label label-'+ label +'">'+data+'</span></div>';
         }
        },
        {"data": 'defect.defect_description_name'
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var qa_s = data.ack.ack_qa_user>0?'teal':'red';
                var prod_s = data.ack.ack_prod_user>0?'teal':'red';
                var eng_s = data.ack.ack_eng_user>0?'teal':'red';

                return '<div class="btn-toolbar" role="toolbar" aria-label="ACK Groups">' +
                            '<div class="btn-group btn-group-xs" role="group" aria-label="QA">' +
                                '<button type="button" class="btn bg-'+qa_s+'" data-toggle="tooltip" data-placement="top" title="QA">Q</button>' +
                                '<button type="button" class="btn bg-'+prod_s+'" data-toggle="tooltip" data-placement="top" title="Production">P</button>' +
                                '<button type="button" class="btn bg-'+eng_s+'" data-toggle="tooltip" data-placement="top" title="Engineering">E</button>' +
                            '</div>' +
                       '</div>';
            }
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var percent = (row.status / 8)*100;
                var bar_colour = 'bar-info ';//'bg-red'
                if(percent < 100) bar_colour = 'bar-success';//'bg-green'
                if(percent < 65) bar_colour = 'bar-warning';//'bg-orange';
                if(percent < 26) bar_colour = 'bar-info';//'bg-red'
                
                return '<div class="progress"><div class="progress-bar progress-'+bar_colour+' progress-bar-striped active" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: '+ percent +'%"></div></div>'
            }
        },
        {
            "data": "aff_rej",
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                
                return data.total_rej_qty+" / "+data.total_aff_qty;
            }
        },
        {data : 'created_date',
         searchable: false
        },
        {data : null,
         searchable: false,
         render: function( data, type, row, meta ){
            var now  = moment().format('YYYY-MM-DD H:mm:ss'); 
            var then = row.created_date;
            var ms = moment(now,"YYYY-MM-DD H:mm:ss").diff(moment(then,"YYYY-MM-DD H:mm:ss"));
            var d = moment.duration(ms);
            return setDiffTimeString(d);
         }
        }
        // {data : 'id',
        //  searchable: false,
        //  render: function( data, type, row, meta ){
        //     return '<a href="/FrontEnd/mastertemplate/'+ data +'"><i class="material-icons">pageview</i></a>';
        //  }
        // }
    ],
    "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    
        //Popover
        $('[data-toggle="popover"]').popover();
    },
    responsive: true
});


//Datatables Closed Ticket
var table_close = $('#qan_closed_ticket_list').DataTable({
    "ajax": '/FrontEnd/ajax_closed_list',
    "columns" : [
        {
            "className":      'details-control',
            "data":           null,
            "orderable":      false,
            "searchable":     false,
            "defaultContent": '<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>'
        },
        {data : null,
         render: function( data, type, row, meta ){
             return meta.row+1;
         }
        },
        {data : null,
         searchable: true,
         render: function( data, type, row, meta ){
            return '<a href="/FrontEnd/mastertemplate/'+ row.id +'">'+ row.qan_no +'</a>';
         }
        },
        {data : 'status_name',
         render: function( data, type, row, meta ){
             var label = 'success';
             var machine_icon_status = 'pause_circle_filled';
             var machine_tooltip = 'Machine Stop';
   
            if( (parseInt(row.status) < 4) || row.machine_status==1)  {
                machine_icon_status = 'play_circle_filled';
                machine_tooltip = 'Machine Run';
            }
            //  return '<span class="label label-'+ label +'">'+data+'</span>'+machine_running_status;
             return '<div class="display: inline-block;"><a class="my-tool-tip" data-toggle="tooltip" data-placement="top" title="'+machine_tooltip+'"><i class="material-icons col-teal" style="vertical-align: middle;cursor: pointer;">'+machine_icon_status+'</i></a><span class="label label-'+ label +'">'+data+'</span></div>';
         }
        },
        {"data": 'defect.defect_description_name'
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var qa_s = data.ack.ack_qa_user>0?'teal':'red';
                var prod_s = data.ack.ack_prod_user>0?'teal':'red';
                var eng_s = data.ack.ack_eng_user>0?'teal':'red';

                return '<div class="btn-toolbar" role="toolbar" aria-label="ACK Groups">' +
                            '<div class="btn-group btn-group-xs" role="group" aria-label="QA">' +
                                '<button type="button" class="btn bg-'+qa_s+'" data-toggle="tooltip" data-placement="top" title="QA">Q</button>' +
                                '<button type="button" class="btn bg-'+prod_s+'" data-toggle="tooltip" data-placement="top" title="Production">P</button>' +
                                '<button type="button" class="btn bg-'+eng_s+'" data-toggle="tooltip" data-placement="top" title="Engineering">E</button>' +
                            '</div>' +
                       '</div>';
            }
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var percent = (row.status / 8)*100;
                var bar_colour = 'bar-success ';
                // var bar_colour = 'bar-info ';//'bg-red'
                // if(percent < 100) bar_colour = 'bar-success';//'bg-green'
                // if(percent < 65) bar_colour = 'bar-warning';//'bg-orange';
                // if(percent < 26) bar_colour = 'bar-info';//'bg-red'
                
                return '<div class="progress"><div class="progress-bar progress-'+bar_colour+' progress-bar-striped active" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: '+ percent +'%"></div></div>'
            }
        },
        {
            "data": "aff_rej",
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                
                return data.total_rej_qty+" / "+data.total_aff_qty;
            }
        },
        {data : 'datetime',
         searchable: false
        },
        {data : null,
         searchable: false,
         render: function( data, type, row, meta ){
            var first  = row.closed_datetime; 
            var last = row.datetime;
            var ms = moment(first,"YYYY-MM-DD H:mm:ss").diff(moment(last,"YYYY-MM-DD H:mm:ss"));
            var d = moment.duration(ms);
            return setDiffTimeString(d);
         }
        }
    ],
    "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    
        //Popover
        $('[data-toggle="popover"]').popover();
    },
    responsive: true
});

//Datatables Initialization
var table_superuseractive = $('#superuser_qan_active_list').DataTable({
    "ajax": '/SuperUser/superuser_ajax_active_list',
    "columns" : [
        {
            "className":      'details-control',
            "data":           null,
            "orderable":      false,
            "searchable":     false,
            "defaultContent": '<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>'
        },
        {data : null,
         render: function( data, type, row, meta ){
             return meta.row+1;
         }
        },
        {data : null,
         searchable: true,
         render: function( data, type, row, meta ){
            return '<a href="/SuperUser/index/'+ row.id +'">'+ row.qan_no +'</a>';
         }
        },
        {data : 'status_name',
         render: function( data, type, row, meta ){
             var label = 'warning';
             var machine_icon_status = 'pause_circle_filled';
             var machine_tooltip = 'Machine Stop';
             if(data=="NEW") label = 'info';
             if(data=="SOLVED" || (data=="MRB")){
                label = 'success';
            }
            if( (parseInt(row.status) < 4) || row.machine_status==1)  {
                machine_icon_status = 'play_circle_filled';
                machine_tooltip = 'Machine Run';
            }
            //  return '<span class="label label-'+ label +'">'+data+'</span>'+machine_running_status;
             return '<div class="display: inline-block;"><a class="my-tool-tip" data-toggle="tooltip" data-placement="top" title="'+machine_tooltip+'"><i class="material-icons col-teal" style="vertical-align: middle;cursor: pointer;">'+machine_icon_status+'</i></a><span class="label label-'+ label +'">'+data+'</span></div>';
         }
        },
        {"data": 'defect.defect_description_name'
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var qa_s = data.ack.ack_qa_user>0?'teal':'red';
                var prod_s = data.ack.ack_prod_user>0?'teal':'red';
                var eng_s = data.ack.ack_eng_user>0?'teal':'red';

                return '<div class="btn-toolbar" role="toolbar" aria-label="ACK Groups">' +
                            '<div class="btn-group btn-group-xs" role="group" aria-label="QA">' +
                                '<button type="button" class="btn bg-'+qa_s+'" data-toggle="tooltip" data-placement="top" title="QA">Q</button>' +
                                '<button type="button" class="btn bg-'+prod_s+'" data-toggle="tooltip" data-placement="top" title="Production">P</button>' +
                                '<button type="button" class="btn bg-'+eng_s+'" data-toggle="tooltip" data-placement="top" title="Engineering">E</button>' +
                            '</div>' +
                       '</div>';
            }
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var percent = (row.status / 8)*100;
                var bar_colour = 'bar-info ';//'bg-red'
                if(percent < 100) bar_colour = 'bar-success';//'bg-green'
                if(percent < 65) bar_colour = 'bar-warning';//'bg-orange';
                if(percent < 26) bar_colour = 'bar-info';//'bg-red'
                
                return '<div class="progress"><div class="progress-bar progress-'+bar_colour+' progress-bar-striped active" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: '+ percent +'%"></div></div>'
            }
        },
        {
            "data": "aff_rej",
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                
                return data.total_rej_qty+" / "+data.total_aff_qty;
            }
        },
        {data : 'created_date',
         searchable: false
        },
        {data : null,
         searchable: false,
         render: function( data, type, row, meta ){
            var now  = moment().format('YYYY-MM-DD H:mm:ss'); 
            var then = row.created_date;
            var ms = moment(now,"YYYY-MM-DD H:mm:ss").diff(moment(then,"YYYY-MM-DD H:mm:ss"));
            var d = moment.duration(ms);
            return setDiffTimeString(d);
         }
        }
        // {data : 'id',
        //  searchable: false,
        //  render: function( data, type, row, meta ){
        //     return '<a href="/FrontEnd/mastertemplate/'+ data +'"><i class="material-icons">pageview</i></a>';
        //  }
        // }
    ],
    "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    
        //Popover
        $('[data-toggle="popover"]').popover();
    },
    responsive: true
});

//Datatables SuperUserClosed Ticket
var table_superuserclose = $('#superuser_qan_closed_ticket_list').DataTable({
    "ajax": '/SuperUser/superuser_ajax_closed_list',
    "columns" : [
        {
            "className":      'details-control',
            "data":           null,
            "orderable":      false,
            "searchable":     false,
            "defaultContent": '<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>'
        },
        {data : null,
         render: function( data, type, row, meta ){
             return meta.row+1;
         }
        },
        {data : null,
         searchable: true,
         render: function( data, type, row, meta ){
            return '<a href="/SuperUser/index/'+ row.id +'">'+ row.qan_no +'</a>';
         }
        },
        {data : 'status_name',
         render: function( data, type, row, meta ){
             var label = 'success';
             var machine_icon_status = 'pause_circle_filled';
             var machine_tooltip = 'Machine Stop';
   
            if( (parseInt(row.status) < 4) || row.machine_status==1)  {
                machine_icon_status = 'play_circle_filled';
                machine_tooltip = 'Machine Run';
            }
            //  return '<span class="label label-'+ label +'">'+data+'</span>'+machine_running_status;
             return '<div class="display: inline-block;"><a class="my-tool-tip" data-toggle="tooltip" data-placement="top" title="'+machine_tooltip+'"><i class="material-icons col-teal" style="vertical-align: middle;cursor: pointer;">'+machine_icon_status+'</i></a><span class="label label-'+ label +'">'+data+'</span></div>';
         }
        },
        {"data": 'defect.defect_description_name'
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var qa_s = data.ack.ack_qa_user>0?'teal':'red';
                var prod_s = data.ack.ack_prod_user>0?'teal':'red';
                var eng_s = data.ack.ack_eng_user>0?'teal':'red';

                return '<div class="btn-toolbar" role="toolbar" aria-label="ACK Groups">' +
                            '<div class="btn-group btn-group-xs" role="group" aria-label="QA">' +
                                '<button type="button" class="btn bg-'+qa_s+'" data-toggle="tooltip" data-placement="top" title="QA">Q</button>' +
                                '<button type="button" class="btn bg-'+prod_s+'" data-toggle="tooltip" data-placement="top" title="Production">P</button>' +
                                '<button type="button" class="btn bg-'+eng_s+'" data-toggle="tooltip" data-placement="top" title="Engineering">E</button>' +
                            '</div>' +
                       '</div>';
            }
        },
        {
            "data": null,
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                var percent = (row.status / 8)*100;
                var bar_colour = 'bar-success ';
                // var bar_colour = 'bar-info ';//'bg-red'
                // if(percent < 100) bar_colour = 'bar-success';//'bg-green'
                // if(percent < 65) bar_colour = 'bar-warning';//'bg-orange';
                // if(percent < 26) bar_colour = 'bar-info';//'bg-red'
                
                return '<div class="progress"><div class="progress-bar progress-'+bar_colour+' progress-bar-striped active" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: '+ percent +'%"></div></div>'
            }
        },
        {
            "data": "aff_rej",
            orderable: false,
            searchable: false,
            render: function( data, type, row, meta ){
                
                return data.total_rej_qty+" / "+data.total_aff_qty;
            }
        },
        {data : 'datetime',
         searchable: false
        },
        {data : null,
         searchable: false,
         render: function( data, type, row, meta ){
            var first  = row.closed_datetime; 
            var last = row.datetime;
            var ms = moment(first,"YYYY-MM-DD H:mm:ss").diff(moment(last,"YYYY-MM-DD H:mm:ss"));
            var d = moment.duration(ms);
            return setDiffTimeString(d);
         }
        }
    ],
    "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    
        //Popover
        $('[data-toggle="popover"]').popover();
    },
    responsive: true
});

// Add event listener for opening and closing details
$('#qan_active_list tbody').on('click', 'td.details-control', function () {
    var table = table_active;
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        $('div.slider', row.child()).slideUp( function () {
            row.child.hide();
            tr.find('td:eq(0)').html('<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>');
        } );
    }
    else {
        // Open this row
        row.child( details_format(row.data()), 'no-padding' ).show();
        tr.find('td:eq(0)').html('<i class="material-icons col-pink" style="cursor: pointer;">remove_circle</i>');
        $('div.slider', row.child()).slideDown();
    }
} );

// Add event listener for opening and closing details
//CLOSED TICKET
$('#qan_closed_ticket_list tbody').on('click', 'td.details-control', function () {
    var table = table_close;
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        $('div.slider', row.child()).slideUp( function () {
            row.child.hide();
            tr.find('td:eq(0)').html('<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>');
        } );
    }
    else {
        // Open this row
        row.child( details_format(row.data()), 'no-padding' ).show();
        tr.find('td:eq(0)').html('<i class="material-icons col-pink" style="cursor: pointer;">remove_circle</i>');
        $('div.slider', row.child()).slideDown();
    }
} );

//QA SUPERUSER ACTIVE TICKET
$('#superuser_qan_active_list tbody').on('click', 'td.details-control', function () {
    var table = table_superuseractive;
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        $('div.slider', row.child()).slideUp( function () {
            row.child.hide();
            tr.find('td:eq(0)').html('<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>');
        } );
    }
    else {
        // Open this row
        row.child( details_format(row.data()), 'no-padding' ).show();
        tr.find('td:eq(0)').html('<i class="material-icons col-pink" style="cursor: pointer;">remove_circle</i>');
        $('div.slider', row.child()).slideDown();
    }
} );

//QA SUPERUSER CLOSED TICKET
$('#superuser_qan_closed_ticket_list tbody').on('click', 'td.details-control', function () {
    var table = table_superuserclose;
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        $('div.slider', row.child()).slideUp( function () {
            row.child.hide();
            tr.find('td:eq(0)').html('<i class="material-icons col-teal" style="cursor: pointer;">add_circle</i>');
        } );
    }
    else {
        // Open this row
        row.child( details_format(row.data()), 'no-padding' ).show();
        tr.find('td:eq(0)').html('<i class="material-icons col-pink" style="cursor: pointer;">remove_circle</i>');
        $('div.slider', row.child()).slideDown();
    }
} );

function setDiffTimeString(diffDuration) {
    var str = [];
    diffDuration.years() > 0 ? str.push(diffDuration.years() + ' year(s)') : null;
    diffDuration.months() > 0 ? str.push(diffDuration.months() + ' month(s)') : null;
    diffDuration.days() > 0 ? str.push(diffDuration.days() + ' day(s)') : null;
    diffDuration.hours() > 0 ? str.push(diffDuration.hours() + ' hour(s)') : null;
    diffDuration.minutes() > 0 ? str.push(diffDuration.minutes() + ' minute(s)') : null;
    console.log(str.join(', '));
    return str.join(', ');
  } 

  /* Formatting function for row details - modify as you need */
function details_format ( d ) {
    // `d` is the original data object for the row
    
    var rows='';
    
    var table = '<div class="slider">'+
        '<table class="table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Submission No</th>'+
            '<th>Total Inspection</th>'+
            '<th>Overall Result</th>'+
            '<th>Total Passed</th>'+
            '<th>Total Failed</th>'+
        '</tr>'+
        '</div>';
        
    $.each(d.submission,function( i, val ){
        
        rows += '<tr>'+
                '<td class="text-center"><b>'+(d.submission.length-(i))+'</b></td>'+
                '<td class="text-center"><b>'+val.TOTAL_INSP+'</b></td>'+
                '<td class="text-center"><span class="label label-'+(val.Status=='Pass'?'success':'danger')+'">'+val.Status+'</span></td>'+
                '<td class="text-center"><b>'+val.Passed+'</b> ('+ parseFloat(val.Per_Pass).toFixed(2) +'%)'+'</td>'+
                '<td class="text-center"><b>'+val.Failed+'</b> ('+ parseFloat(val.Per_Fail).toFixed(2) +'%)'+'</td>'+
            '</tr>';
    });

    if(rows.length <1){
        rows = '<tr>'+
                    '<td class="text-center">NA</td>'+
                    '<td class="text-center">NA</td>'+
                    '<td class="text-center">NA</td>'+
                    '<td class="text-center">NA</td>'+
                    '<td class="text-center">NA</td>'+
                '</tr>';
    }
    
    return table + rows + '</table>';
}

