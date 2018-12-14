/**
 * 
 */
/**
 * Created by Eric Beda on 2/24/2016.
 */

$(document).ready(function() {


    $(document).on('click', '.dbx_submit', function(event) {

        //alert('submit');
        // get the form
        var form = $(this).closest("form");
        var action = form.attr('action');
        var target ;

        if(!form.attr('target')){
            target = form.parent();
        }else{
            target = $('#'+form.attr('target'));
        }


        var id = form.attr('id');

        var ajax = form.attr('ajax');

        if( ajax === 'no'){
            return true;
        }

        var data = new FormData( $("#"+id)[0] );

        //alert(data);
        // dim & progress
        var dark_4 = $(this).closest('.card');
        $(dark_4).block({
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#1B2024',
                opacity: 0.85,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none',
                color: '#fff'
            }
        });

        $.ajax({
            type:"POST",
            url:action,
            data:data,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data) {

                $(dark_4).unblock();
                target.html(data);//.multiselect('refresh');

                //target.children('.multiselect').multiselect('refresh');
            }
        });

        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });

    $(document).on('click', '.dbx_insert', function(event) {

        //alert('submit');
        // get the form
        var target = $(this).closest(".dbx_wrapper").attr('id');
        var action = $(this).attr('action');

        // dim & progress
        var dark_4 = $(this).closest('.card');
        $(dark_4).block({
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#1B2024',
                opacity: 0.85,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none',
                color: '#fff'
            }
        });


        $.get(action, function(data, status){

            $(dark_4).unblock();
            $('#'+target).html(data);

            $('#'+target+' .multiselect').multiselect('refresh');
        });

        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });


    $(document).on('click', '.dbx_arg_link', function(event) {

        // get the form
        var arg    = $(this).attr('arg');
        var target = $(this).attr('target');
        var action = $(this).attr('action');
        if(!target) target = "_blank";
        if(!action) action = 'http://ad2.local/'+$(this).closest("table").attr('action');
        action = action+'&'+arg;

        // dim & progress
        var dark_4 = $('#'+target);
        $(dark_4).block({
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#1B2024',
                opacity: 0.85,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none',
                color: '#fff'
            }
        });


        $.get(action, function(data, status){

            $(dark_4).unblock();
            $('#'+target).html(data);

            $('#'+target+' .multiselect').multiselect('refresh');

        });

        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });

    $(document).on('click', '.dbx_act_link', function(event) {

        // get the form
        var act    = $(this).attr('act');
        var id     = $(this).attr('id');
        var target = $(this).closest(".dbx_wrapper").attr('id');
        var action = 'http://ad2.local/'+$(this).closest("table").attr('action')+'&action='+act+'&id='+id;

        // dim & progress
        var dark_4 = $(this).closest('.card');
        $(dark_4).block({
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#1B2024',
                opacity: 0.85,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none',
                color: '#fff'
            }
        });


        $.get(action, function(data, status){

            $(dark_4).unblock();
            $('#'+target).html(data);

            $('#'+target+' .multiselect').multiselect('refresh');

        });

        // Avoid submit event to continue normal execution
        event.preventDefault();
        return false;
    });

    $('.dbx_table').DataTable({
        autoWidth: false,
        deferRender:    true,
        scrollY:        400,
        scrollCollapse: true,
        scroller:       true,
        select:         true,
        responsive: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '→', 'previous': '←' }
        }
    });



});

