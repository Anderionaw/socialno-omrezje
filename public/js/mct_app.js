jQuery( document ).ready( function( $ ) {

    mctConfirmOnDelete();
    mctConfirmOnChange();
    mctDeleteAll();
    mctOpenAjaxModal();
    mctDoAjaxModal(false);
    vseckajObjavo();
    dodajPrijatelja();
    sprejmiProsnjo();
    zavrniProsnjo();
    odstraniPrijatelja();
    shraniObjavo();

    // Intercept all empty (href="#") links.
    $( 'a[href="#"]' ).on( 'click', function ( e ) {
		e.preventDefault();
	});

    $('body').on('click', '.btn-spinner-loader', function(e) {
        mctAjaxSpinnerStart();
    });

    $('body').on('change', '.mct_selldesc_sell', function(event) {

        var has_text = $('option:selected', this).attr('data-desc');
        var desc_block = $(this).parents('.mct_selldesc_wrap').find('.mct_selldesc_desc');

        if (has_text == 1) {
            desc_block.show();
        } else {
            desc_block.hide();
        }
    
    });

    if ($('#mct_table_sortable').length) {

        $('#mct_table_sortable').sortable({
            handle: '.mct_move',
            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index+1)) {
                        $(this).attr('data-position', (index+1)).addClass('mct_updated');
                    }
                });
                var url = $(this).attr('data-url');
                if (url) {
                    mctsaveNewPositions(url);
                }
            }
        });
    }

});

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

// Ajax modal odpre okno
function mctOpenAjaxModal() {
    
    $('body').on('click', 'a.ajax_modal', function(event) {
            
        event.preventDefault();
        
        var heading = $( this ).attr( 'data-heading' ) ?? '';
        var size = $( this ).attr( 'data-size' ) ?? 'auto';
        var klasa = $( this ).attr( 'data-klasa' ) ?? '';
        var type = $( this ).attr( 'data-type' ) ?? '';
        var url = $( this ).attr( 'href' ) ?? '#';
        
        $.get( url, function( response ) {
        
            var formContent = $( response.html ).find( 'form' ).first();
            
            if( typeof formContent === 'undefined' || formContent.length == 0 ) {
                var formContent = $( response ).find( 'form' ).first();   
            }
            
            formContent = formContent.wrap('<div class="extra-wrapper"></div>').parent().html();
            
            doModal( heading, formContent, size, klasa, type );
            
        });

        $( this ).toggleClass( 'opened' );
        
    });

}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

// Ajax modal - Dodajanje elementa preko ajaxa - tukaj dejansko dodamo element
function mctDoAjaxModal( $toastr = true ) {

    $('body').on( 'click', '.form-modal .form-modal-btn', function( event ) {
            
        event.preventDefault();
        var form = $(this).parents('form').first();
        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            // data: form.serialize(),
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                if (data.ajax_text && $toastr == true) {
                    $.toast({
                        heading: 'Obvestilo!',
                        text: data.ajax_text,
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right',
                        hideAfter: 1000,
                        afterHidden: function () {
                            if (data.ajax_programs) {
                                $('#mct_ajax_points_total').html(data.ajax_points);
                            } else {
                                location.reload();
                            }
                        }
                    });
                } else {
                    location.reload();    
                }    
            },
            error: function (data) {
                var response = JSON.parse(data.responseText);
                var errorString = '<ul>';
                $.each( response.errors, function( key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';
                if ($toastr == true) {
                    $.toast({
                        heading: 'Napaka!',
                        text: errorString,
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right',
                        hideAfter: false
                    });
                }
            }
        });
        
    });

}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function mctFilterList( $toastr = true ) {
    
  var form = $( '.flt_frm' );
  
  $.ajax({
      url: form.attr( 'action' ),
      type: 'GET',
      data: form.serialize(),
      success: function( response ) {
        var content = $( response.html );
        $( '.ajax-table' ).parent().html( content );
        $( '#hdd_page' ).val( 1 );
        //confirmOnDel();
        //initAfterAjaxSuccess()
        //if ( $toastr == true ) {
            //toastr.success( 'Zapisi so bili uspešno filtrirani.', 'Uspešno!', { timeOut: 2500 } );
        //}
      }
  });
  
}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function mctConfirmOnDelete() {

    $('.mct_delbtn').click(function( event ) {

        event.preventDefault();
        var mct_url = $(this).attr('href');

        $.confirm({
            title: 'Opozorilo!',
            content: 'Ali res želite izbrisati izbran zapis?',
            type: 'red',
            icon: 'ik ik-alert-circle',
            typeAnimated: true,
            buttons: {
                confirm: {
                    text: 'Izbriši',
                    btnClass: 'btn-red',
                    action: function() {
                        window.location = mct_url;
                    }
                },
                abort: {
                    text: 'Prekini',
                    action: function() {}
                }
            }
        });

    });

}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function mctConfirmOnChange() {

    $('.mct_chngbtn').click(function( event ) {

        event.preventDefault();
        var mct_url = $(this).attr('href');
        var mct_desc = $( this ).attr( 'data-desc' ) ?? 'Ali ste prepričani?';

        $.confirm({
            title: 'Opozorilo!',
            content: mct_desc,
            type: 'red',
            icon: 'ik ik-alert-circle',
            typeAnimated: true,
            buttons: {
                confirm: {
                    text: 'Spremeni',
                    btnClass: 'btn-red',
                    action: function() {
                        window.location = mct_url;
                    }
                },
                abort: {
                    text: 'Prekini',
                    action: function() {}
                }
            }
        });

    });

}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function mctDeleteAll() {

    $('.mct_delall').on('click', function(e) {

        var $this = $(this);

        var allVals = [];  
        $(".mct_allchild:checked").each(function() { 
            allVals.push($(this).attr('data-id'));
        }); 
        
        if(allVals.length <=0) {  
            
            $.alert({
                title: 'Obvestilo!',
                content: 'Prosimo, da izberite zapise za izbris!',
                type: 'blue',
                icon: 'ik ik-check-square',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                    okay: {
                        text: 'V redu'
                    }
                }
            });

        } else {
            
            $.confirm({
                title: 'Opozorilo!',
                content: 'Ali res želite izbrisati izbrane zapise?',
                type: 'red',
                icon: 'ik ik-alert-circle',
                typeAnimated: true,
                buttons: {
                    confirm: {
                        text: 'Izbriši',
                        btnClass: 'btn-red',
                        action: function() {

                            var join_selected_values = allVals.join(",");

                            $.ajax({
                                url: $this.data('url'),
                                type: 'DELETE',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: 'ids='+join_selected_values,
                                success: function (data) {
                                    if (data['success']) {
                                        $(".mct_allchild:checked").each(function() {  
                                            $(this).parents("tr").remove();
                                        });
                                        // resetToastPosition();
                                        $.toast({
                                          heading: 'Obvestilo!',
                                          text: data['success'],
                                          showHideTransition: 'slide',
                                          icon: 'success',
                                          loaderBg: '#f96868',
                                          position: 'top-right'
                                        });
                                    }
                                },
                                error: function (data) {
                                    // resetToastPosition();
                                    $.toast({
                                        heading: 'Napaka!',
                                        text: data.responseText,
                                        showHideTransition: 'slide',
                                        icon: 'error',
                                        loaderBg: '#f2a654',
                                        position: 'top-right'
                                    });
                                }
                            });
                        }
                    },
                    abort: {
                        text: 'Prekini',
                        action: function() {}
                    }
                }
            });

        }

    });

}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function doModal( heading, formContent, size, klasa, type ) {
    
	var randomModalId = 'modal-' + makeid();
    
    html = '<div id="' + randomModalId + '" class="modal ' + klasa + '" role="dialog" aria-hidden="true">';
    html += '<div class="modal-dialog ' + type + '" style="width:' + size + '!important;" role="document">';
    html += '<div class="modal-content">';
    html += '<div class="modal-header">';
    html += '<h5 class="modal-title" id="CustomerAddLabel">' + heading + '</h5>';
    html += '<button type="button" class="close" data-dismiss="modal" aria-label="Zapri"><span aria-hidden="true">×</span></button>';
    html += '</div>';
    html += '<div class="modal-body">';
    html += formContent;
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    $('body').append(html);
    $('.mct_modl_form').addClass('form-modal');
    $('.mct_modl_btn').addClass('form-modal-btn');
    $( '#' + randomModalId ).modal( 'show' );

    $('.select2').select2();
    mctFileBrowseEnable();

    $('.modal .repeater').repeater({
        show: function() {
            //$('.select2-container').remove();
            $(this).slideDown();
            var d = new Date();
            var today = d.getFullYear() + '-' + ('0'+(d.getMonth()+1)).slice(-2) + '-' + ('0'+d.getDate()).slice(-2);
            $(this).find($("input[type='date']")).val(today);
            $(this).find($(".mct_funds_income_val")).val('income');
            $(this).find($(".mct_funds_outcome_val")).val('outcome');
            $(".select2").select2();
            $(".select2tags").select2({
                tags: true
            });
        },
        hide: function(deleteElement) {
            if (confirm('Ali res želite odstraniti izbrani element?')) {
                var mct_prev_rep = $(this).prev();
                $(this).slideUp(deleteElement);
                setTimeout(function() {
                    mct_prev_rep.find($(".mct_funds_table .mct_ajax_funds")).trigger("change");
                }, 1000);
            }
        },
        isFirstItemUndeletable: true
    });
    
	$('body').on('hidden.bs.modal', '#' + randomModalId, function() {
        $(this).remove();
        location.reload();
    });
    
}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function makeid() {
    
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 10; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
    
}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function mctsaveNewPositions(url) {

    var positions = [];

    $('.mct_updated').each(function () {
       positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
       $(this).removeClass('mct_updated');
    });

    if (url && url != '') {

        $.ajax({
            url: url + '/save-positions',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            dataType: 'text',
            data: {
            update: 1,
            positions: positions
            }, 
            success: function (response) {
                location.reload();
            }
        });

    }

}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function mctAjaxSpinnerStart() {
    $('#mct-main-loading').addClass('mct-main-loading');
    $('#mct-main-loading-content').addClass('mct-main-loading-content');
};

function mctAjaxSpinnerEnd() {
    $('#mct-main-loading').removeClass('mct-main-loading');
    $('#mct-main-loading-content').removeClass('mct-main-loading-content');
};

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function mctFileBrowseEnable() {

    $('.file-upload-browse').on('click', function() {
        var file = $(this).parent().parent().parent().find('.file-upload-default');
        file.trigger('click');
    });

    $('.file-upload-default').on('change', function() {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });

}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */


function vseckajObjavo( $toastr = true ) {
    $('body').on( 'click', '.objava-display-vsecki .objava-display-vsecki-button', function( event ) {
        event.preventDefault();
        var objava_id = $(this).attr("data-id");
        var url = $(this).attr("data-url");
        var $this = $(this);

        if(objava_id >= 0 && url){
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id: objava_id
                },
                success: function (data) {
                    $this.find(".vsecki-value").html(data.vsecki);
                },
                error: function (data) {
                    if ($toastr == true) {
                        $.toast({
                            heading: 'Napaka!',
                            text: "napaka",
                            showHideTransition: 'slide',
                            icon: 'error',
                            loaderBg: '#f2a654',
                            position: 'top-right',
                            hideAfter: false
                        });
                    }
                }
            }); 
        }else{
            $.toast({
                heading: 'Napaka!',
                text: "Ne najdem objave",
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right',
                hideAfter: false
            });
        }
    });
        
}


/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */


function dodajPrijatelja( $toastr = true ) {
    $('body').on( 'click', '.dodaj-prijatelja', function( event ) {
        event.preventDefault();
        var user_id1 = $(this).attr("data-id1");
        var user_id2 = $(this).attr("data-id2");
        var url = $(this).attr("data-url");

        if(user_id1 > 0 && user_id2 > 0 && url){
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id1: user_id1,
                    id2: user_id2
                },
                success: function (data) {
                    location.reload();
                },
                error: function (data) {
                    if ($toastr == true) {
                        $.toast({
                            heading: 'Napaka!',
                            text: "napaka",
                            showHideTransition: 'slide',
                            icon: 'error',
                            loaderBg: '#f2a654',
                            position: 'top-right',
                            hideAfter: false
                        });
                    }
                }
            }); 
        }else{
            $.toast({
                heading: 'Napaka!',
                text: "Neuspelo!",
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right',
                hideAfter: false
            });
        }
    });
        
}

/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function sprejmiProsnjo( $toastr = true ) {
    $('body').on( 'click', '.dodaj-uporabnika-button', function( event ) {
        event.preventDefault();
        var user_id1 = $(this).attr("data-id1");
        var user_id2 = $(this).attr("data-id2");
        var url = $(this).attr("data-url");
        

        if(user_id1 >= 0 && user_id2 >= 0 && url){
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id1: user_id1,
                    id2: user_id2
                },
                success: function (data) {
                    location.reload(); 
                },
                error: function (data) {
                    if ($toastr == true) {
                        $.toast({
                            heading: 'Napaka!',
                            text: "napaka",
                            showHideTransition: 'slide',
                            icon: 'error',
                            loaderBg: '#f2a654',
                            position: 'top-right',
                            hideAfter: false
                        });
                    }
                }
            }); 
        }else{
            $.toast({
                heading: 'Napaka!',
                text: "Neuspelo!",
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right',
                hideAfter: false
            });
        }
    });
        
}


/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function zavrniProsnjo( $toastr = true ) {
    $('body').on( 'click', '.zavrni-uporabnika-button', function( event ) {
        event.preventDefault();
        var user_id1 = $(this).attr("data-id1");
        var user_id2 = $(this).attr("data-id2");
        var url = $(this).attr("data-url");
        var $this = $(this);
        

        if(user_id1 >= 0 && user_id2 >= 0 && url){
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id1: user_id1,
                    id2: user_id2
                },
                success: function (data) {
                    location.reload(); 
                },
                error: function (data) {
                    if ($toastr == true) {
                        $.toast({
                            heading: 'Napaka!',
                            text: "napaka",
                            showHideTransition: 'slide',
                            icon: 'error',
                            loaderBg: '#f2a654',
                            position: 'top-right',
                            hideAfter: false
                        });
                    }
                }
            }); 
        }else{
            $.toast({
                heading: 'Napaka!',
                text: "Neuspelo!",
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right',
                hideAfter: false
            });
        }
    });
        
}


/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function odstraniPrijatelja( $toastr = true ) {
    $('body').on( 'click', '.odstrani-prijatelja-button', function( event ) {
        event.preventDefault();
        var user_id1 = $(this).attr("data-id1");
        var user_id2 = $(this).attr("data-id2");
        var url = $(this).attr("data-url");
        

        if(user_id1 >= 0 && user_id2 >= 0 && url){
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id1: user_id1,
                    id2: user_id2
                },
                success: function (data) {
                    location.reload(); 
                },
                error: function (data) {
                    if ($toastr == true) {
                        $.toast({
                            heading: 'Napaka!',
                            text: "napaka",
                            showHideTransition: 'slide',
                            icon: 'error',
                            loaderBg: '#f2a654',
                            position: 'top-right',
                            hideAfter: false
                        });
                    }
                }
            }); 
        }else{
            $.toast({
                heading: 'Napaka!',
                text: "Neuspelo!",
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right',
                hideAfter: false
            });
        }
    });
        
}


/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

function shraniObjavo( $toastr = true ) {
    $('body').on( 'click', '.objava-display-shrani-btn', function( event ) {
        event.preventDefault();
        
        var objava_id = $(this).attr("data-id");
        var url = $(this).attr("data-url");

        if(objava_id >= 0 && url){
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id: objava_id
                },
                success: function (data) {
                    location.reload();
                },
                error: function (data) {
                    if ($toastr == true) {
                        $.toast({
                            heading: 'Napaka!',
                            text: "napaka",
                            showHideTransition: 'slide',
                            icon: 'error',
                            loaderBg: '#f2a654',
                            position: 'top-right',
                            hideAfter: false
                        });
                    }
                }
            }); 
        }else{
            $.toast({
                heading: 'Napaka!',
                text: "Ne najdem objave",
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right',
                hideAfter: false
            });
        }
    });
        
    
}