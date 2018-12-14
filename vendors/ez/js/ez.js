/**
 * Created by administrator on 10/28/16.
 */

function filterGlobal () {
    $('#ez_table').DataTable().search(
        $('#global_filter').val()
    ).draw();
}


$(document).ready(
    function() {

        if (!$().multiselect) {
            alert('Warning - bootstrap-multiselect.js is not loaded.');
            return;
        }

        // Image lightbox
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        $('.multiselect').multiselect();
        // Dropdown selectors
        $('.pickadate').pickadate({
            format: 'YYYY-MM-DD',
            selectYears: true,
            selectMonths: true
        });

        var base_url = $('#ez_content').attr('surl');
        var ez_tbl_url = base_url.slice(0,-1);

        $('.ez-link').on('click', function(){

            var target  = $(this).attr('target');
            var action  = $(this).attr('action');
            var args    = $(this).attr('args');

            // clear targets contents
            $('#'+target).html('');

            // set
            $('.p_link').removeClass('p_link_sel');
            $(this).addClass('p_link_sel');

            // put loader
            //$('#'+target).html('<img src="http://127.0.0.1/dataManager/assets/images/loader.gif">');

            $.post(action, args, function(data) {
                $('#' + target).html(data);
                $('.multiselect').multiselect('refresh');
            });

        });

        $('input.global_filter').on( 'keyup, click', function () {
            filterGlobal();
        } );

        $(document).on('click', '#add_cntr submit', function(event) {

            //alert('submit');
            // get the form
            var form = $(this).closest("form");
            var action = form.attr('action');
            var method = form.attr('method');

            var id = form.attr('id');

            var data = new FormData( $("#"+id)[0] );

            alert(data);
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
                type:method,
                url:action,
                data:data,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success:function(data) {

                    $(dark_4).unblock();
                    $('#add_cntr').html(data);
                }
            });

            // Avoid submit event to continue normal execution
            event.preventDefault();
            return false;
        });


        $(document).on(
            'click',
            '.dp_n .ez_del',
            function(event){
                alert('You do not have permission to delete this');
                return;

            });

        $(document).on(
            'click',
            '.tab', function(event){

                var url = $(this).attr('u');
                var did  = $(this).attr('href');


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

                $.get(url, function(data) {

                    $(dark_4).unblock();
                    $(did).html(data);
                    $('.multiselect').multiselect('refresh');
                    $('.pickadate').pickadate('refresh');
                });

            }
        )

$(document).on(
            'click',
            '.dp_y .ez_del',
            function(event) {

                var tbl_id  	= $(this).attr('tbl_id');
                var tbl_name	= $('#ez_table_prop').attr('tn');
                var burl		= "http://ad2.local/";

                var retVal = confirm("Do you want to delete this item ?");

                if(retVal == true){

                    // delete item on server
                    $.post(burl+'api/aplus/delete_row', {table: tbl_name, id: tbl_id}, function(data) {

                        if(data == 'Delete Success!'){
                            //$('#list_'+tbl_id).remove();
                            //table.ajax.reload( null, false );
                            //alert('#row_'+tbl_id);
                            $('#row_'+tbl_id).fadeOut();
                            alert('Delete Success!');
                        }else{
                            alert('Delete Failed!');
                        }
                    });
                }

                return;
            });

        var table =$('#ez_table').DataTable({
                deferRender:    true,
                scrollY:        400,
                scrollCollapse: true,
                scroller:       true,
                select:         true,
                responsive: true,
                    "columnDefs": [ {
                    "targets": 1,
                    "orderable": false,
                    "width": '30px',
                    "data": null,
                    "render": function ( data, type, row, meta ) {

                        return '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu9"></i></a><div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"><a href="'+ez_tbl_url+'m/'+data[0]+'" class="dropdown-item"><i class="icon-file-text"></i>View</a><span tbl_id="'+data[0]+'" class="ez_del dropdown-item"><i class="icon-trash"></i> Delete </span></div></div></div>';

                    }
                },
                        {"targets": "ez-upl",
                        "render": function(data,type,row,meta){
                            return '<a href="http://ad2.local/assets/uploads/'+data+'" download>'+data+'</a>';
                        }}],
                ajax: {
                    "url": "http://ad2.local/ez/data_table_processing",
                        "data": function ( d ) {
                        d.column = $('#ez_table_prop').attr('column');
                        d.cond 	 = $('#ez_table_prop').attr('cond');
                            d.tn 	 = $('#ez_table_prop').attr('tn');
                            d.q1 	 = $('#ez_table_prop').attr('q1');
                    }
                },
                dom: '<"datatable-header"f><"datatable-scroll-wrap"t><"datatable-footer"i>',
                language: {
                search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });

        $('#modal_remote').on('show.bs.modal', function() {

            var mtype   = $(this).attr('mtype');
            var opt     = $(this).attr('opt');

            alert(mtype+' jembe '+opt);


            $(this).find('.modal-body').load('http://ad2.local/api/ez/'+mtype+'/?o='+opt, function() {

            });
        });

        $('.tasks-list').DataTable({
            autoWidth: false,
            columnDefs: [
                {
                    type: "natural",
                    width: 20,
                    targets: 0
                },
                {
                    visible: false,
                    targets: 1
                },
                {
                    width: '55%',
                    targets: 2
                },
                {
                    width: '17%',
                    targets: 3
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string',
                    targets: 4
                }
            ],
            order: [[ 0, 'desc' ]],
            dom: '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            },
            lengthMenu: [ 15, 25, 50, 75, 100 ],
            displayLength: 15,
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({page:'current'}).nodes();
                var last=null;

                // Grouod rows
                api.column(1, {page:'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="table-active table-border-double"><td colspan="8" class="font-weight-semibold">'+group+'</td></tr>'
                        );

                        last = group;
                    }
                });

                // Initialize components
                //_componentUiDatepicker();
                //_componentSelect2();
            }
        });


        function postToIframe(data,url,target){

            $('body').append('<form action="'+url+'" method="post" target="'+target+'" id="postToIframe"></form>');
            //var obj = jQuery.parseJSON(data);

            var split = data.split('&');
            split.forEach(function (pair){
                var parts = pair.split('=');
                $('#postToIframe').append('<input type="hidden" name="'+parts[0]+'" value="'+parts[1]+'" />');
            });
            $('#postToIframe').submit().remove();
        }


        $(document).on(
            'click',
            '.authorize .btn-auth',
            function (event) {

                //alert('sema');
                var sta      = $(this).attr('sta');
                var request_id  = $(this).attr('req_id');
                var comment     = $('#comment').val();
                var created_by  = $('#comment').attr('created_by');
                //call ajax request
                $.post('http://ad2.local/api/obox/authorize_request', {status: sta, request_id: request_id, comment: comment, created_by: created_by}, function(data) {
                    //alert(data);
                    $('#authorize_response').html(data);
                });
            });

        $(document).on(
            'click',
            '.act_deny, .act_approve',
            function (event) {

                var tr       = $(this).closest('tr')
                var bid      = tr.attr('bid');
                var btb      = tr.attr('btb');
                var sta      = $(this).attr('sta');
                var cla      = 'bg-'+$(this).attr('cla');

                //call ajax request
                $.post('http://ad2.local/api/obox/approve_activity', {id: bid, tbl: btb, sta: sta }, function(data) {
                    if(data){
                        // success
                        tr.find('.badge').removeClass('bg-success').removeClass('bg-warning').addClass(cla).html(sta);

                    }else{
                        alert('oh snap, something went wrong, try again later');
                    }
                });
            });

        $(document).on(
            'click',
            '#obox_comment',
            function (event) {

                var comment     = $('#ref_comment').val();
                $('#ref_comment').val('');
                var ref_data    = $(this).attr('ref_data');

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

                //call ajax request
                $.post('http://ad2.local/api/obox/add_comment', {comment: comment, ref_data: ref_data }, function(data) {


                    $(dark_4).unblock();
                    if(data != 0){
                        $('#obox_chat_list').prepend(data).slideUp();
                    }else{
                        alert('Oh snap! something is not right, please try again later');
                    }
                });
            });





    });

