(function($) {
'use strict';

    // Users data table
    $(document).ready(function() {

        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#user_table').DataTable({

            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Vse"]],
            processing: true,
            responsive: true,
            serverSide: true,
            processing: true,
			deferRender: true,
            language: {
				processing:     '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>',
				search:         'Iskanje:',
				decimal:        '',
				emptyTable:     'V tabeli ni podatkov',
				info:           'Prikazujem _START_ do _END_ od _TOTAL_ skupno',
				infoEmpty:      'Prikazujem 0 do 0 od 0 skupno',
				infoFiltered:   '(filtrirano od _MAX_ skupno)',
				infoPostFix:    '',
				thousands:      ',',
				lengthMenu:     'Prikaži _MENU_ zapisov',
				loadingRecords: 'Nalagam...',
				zeroRecords:    'Ne najdem iskanih zapisov',
				paginate: {
					first:      '<i class="ik ik-chevrons-left"></i>',
					last:       '<i class="ik ik-chevrons-right"></i>',
					next:       '<i class="ik ik-chevron-right"></i>',
					previous:   '<i class="ik ik-chevron-left"></i>'
				}
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
			ajax: {
                url: 'users/get-list',
                type: "get"
            },
            columns: [
                {data:'name', name: 'name'},
                {data:'email', name: 'email'},
                {data:'roles', name: 'roles'},
                {data:'permissions', name: 'permissions',orderable: false, searchable: false},
                {data:'action', name: 'action', orderable: false, searchable: false}

            ],
            buttons: [
                /*
				{
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Uporabniki',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Uporabniki',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
				*/
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Uporabniki',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Uporabniki',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Uporabniki',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ],
			fnDrawCallback : function() {
				mctConfirmOnDelete();
			},
            initComplete: function () {
                var api =  this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute('placeholder', $(column.header()).text());
                    input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');

                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });

                    $('input', this.column(column).header()).on('click', function(e) {
                        e.stopPropagation();
                    });
                });

                api.columns(selectable).every( function (i, x) {
                    var column = this;

                    var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function(e){
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^'+val+'$' : '', true, false ).draw();
                            e.stopPropagation();
							mctConfirmOnDelete();
                        });

                    $.each(dropdownList[i], function(j, v) {
                        select.append('<option value="'+v+'">'+v+'</option>')
                    });
                });
				
            }
        });
    });

    // Roles data table
    $(document).ready(function() {

        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#roles_table').DataTable({

            order: [[ 0, 'asc' ]],
            pageLength: 50,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Vse"]],
            processing: true,
            responsive: true,
            serverSide: true,
            processing: true,
			deferRender: true,
            language: {
				processing:     '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>',
				search:         'Iskanje:',
				decimal:        '',
				emptyTable:     'V tabeli ni podatkov',
				info:           'Prikazujem _START_ do _END_ od _TOTAL_ skupno',
				infoEmpty:      'Prikazujem 0 do 0 od 0 skupno',
				infoFiltered:   '(filtrirano od _MAX_ skupno)',
				infoPostFix:    '',
				thousands:      ',',
				lengthMenu:     'Prikaži _MENU_ zapisov',
				loadingRecords: 'Nalagam...',
				zeroRecords:    'Ne najdem iskanih zapisov',
				paginate: {
					first:      '<i class="ik ik-chevrons-left"></i>',
					last:       '<i class="ik ik-chevrons-right"></i>',
					next:       '<i class="ik ik-chevron-right"></i>',
					previous:   '<i class="ik ik-chevron-left"></i>'
				}
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: 'roles/get-list',
                type: "get"
            },
            columns: [
                {data:'name', name: 'name'},
                {data:'permissions', name: 'permissions', orderable: false, searchable: false},
                {data:'action', name: 'action', orderable: false, searchable: false}

            ],
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Uporabniški nivoji',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Uporabniški nivoji',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Uporabniški nivoji',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ],
            fnDrawCallback : function() {
				mctConfirmOnDelete();
			},
            initComplete: function () {
                var api =  this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute('placeholder', $(column.header()).text());
                    input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');

                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });

                    $('input', this.column(column).header()).on('click', function(e) {
                        e.stopPropagation();
                    });
                });

                api.columns(selectable).every( function (i, x) {
                    var column = this;

                    var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function(e){
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^'+val+'$' : '', true, false ).draw();
                            e.stopPropagation();
                        });

                    $.each(dropdownList[i], function(j, v) {
                        select.append('<option value="'+v+'">'+v+'</option>')
                    });
                });
            }
        });
    });

    // Permissions data table
    $(document).ready(function() {

        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#permissions_table').DataTable({

            order: [[ 0, 'asc' ]],
            pageLength: 50,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Vse"]],
            processing: true,
            responsive: true,
            serverSide: true,
            processing: true,
			deferRender: true,
            language: {
				processing:     '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>',
				search:         'Iskanje:',
				decimal:        '',
				emptyTable:     'V tabeli ni podatkov',
				info:           'Prikazujem _START_ do _END_ od _TOTAL_ skupno',
				infoEmpty:      'Prikazujem 0 do 0 od 0 skupno',
				infoFiltered:   '(filtrirano od _MAX_ skupno)',
				infoPostFix:    '',
				thousands:      ',',
				lengthMenu:     'Prikaži _MENU_ zapisov',
				loadingRecords: 'Nalagam...',
				zeroRecords:    'Ne najdem iskanih zapisov',
				paginate: {
					first:      '<i class="ik ik-chevrons-left"></i>',
					last:       '<i class="ik ik-chevrons-right"></i>',
					next:       '<i class="ik ik-chevron-right"></i>',
					previous:   '<i class="ik ik-chevron-left"></i>'
				}
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: 'permissions/get-list',
                type: "get"
            },
            columns: [
                {data:'name', name: 'name'},
                {data:'roles', name: 'roles', orderable: false, searchable: false},
                {data:'action', name: 'action', orderable: false, searchable: false}
            ],
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Pravice',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Pravice',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Pravice',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ],
            fnDrawCallback : function() {
				mctConfirmOnDelete();
			},
            initComplete: function () {
                var api =  this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute('placeholder', $(column.header()).text());
                    input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');

                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });

                    $('input', this.column(column).header()).on('click', function(e) {
                        e.stopPropagation();
                    });
                });

                api.columns(selectable).every( function (i, x) {
                    var column = this;

                    var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function(e){
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^'+val+'$' : '', true, false ).draw();
                            e.stopPropagation();
                        });

                    $.each(dropdownList[i], function(j, v) {
                        select.append('<option value="'+v+'">'+v+'</option>')
                    });
                });
            }
        });
    });

    // Postmails data table
    $(document).ready(function() {

        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#postmails_table').DataTable({

            order: [[ 1, 'asc' ]],
            pageLength: 50,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Vse"]],
            processing: true,
            responsive: true,
            serverSide: true,
            processing: true,
			deferRender: true,
            language: {
				processing:     '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>',
				search:         'Iskanje:',
				decimal:        '',
				emptyTable:     'V tabeli ni podatkov',
				info:           'Prikazujem _START_ do _END_ od _TOTAL_ skupno',
				infoEmpty:      'Prikazujem 0 do 0 od 0 skupno',
				infoFiltered:   '(filtrirano od _MAX_ skupno)',
				infoPostFix:    '',
				thousands:      ',',
				lengthMenu:     'Prikaži _MENU_ zapisov',
				loadingRecords: 'Nalagam...',
				zeroRecords:    'Ne najdem iskanih zapisov',
				paginate: {
					first:      '<i class="ik ik-chevrons-left"></i>',
					last:       '<i class="ik ik-chevrons-right"></i>',
					next:       '<i class="ik ik-chevron-right"></i>',
					previous:   '<i class="ik ik-chevron-left"></i>'
				}
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: 'postmails/get-list',
                type: "get"
            },
            columns: [
                {data:'zip', name: 'zip'},
                {data:'name', name: 'name'},
                {data:'action', name: 'action', orderable: false, searchable: false}
            ],
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Pošte',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Pošte',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Pošte',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ],
            fnDrawCallback : function() {
				mctConfirmOnDelete();
			},
            initComplete: function () {
                var api =  this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute('placeholder', $(column.header()).text());
                    input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');

                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });

                    $('input', this.column(column).header()).on('click', function(e) {
                        e.stopPropagation();
                    });
                });

                api.columns(selectable).every( function (i, x) {
                    var column = this;

                    var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function(e){
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^'+val+'$' : '', true, false ).draw();
                            e.stopPropagation();
                        });

                    $.each(dropdownList[i], function(j, v) {
                        select.append('<option value="'+v+'">'+v+'</option>')
                    });
                });
            }
        });
    });
	
    $('select').select2();
	
})(jQuery);