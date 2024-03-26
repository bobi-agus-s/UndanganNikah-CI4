/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";



// datatables
$(document).ready(function() {
    $('#table1').DataTable()
})

$(document).ready(function() {
    $('.swal-6').click(function(e) {
        e.preventDefault()
        var id = $(this).val()

        $(".swal-6").click(function() {
            swal({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover this imaginary file!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: location.href + "/" + id,
                        success: function(response) {
                            swal({
                                title: response.status,
                                text: response.status_text,
                                icon: response.status_icon,
                                buttons: "OK"
                            }).then((confirmed) => {
                                // window.location.reload()
                                location.reload()
                            })
                        }
                    })
                } else {
                    swal('data ga jadi dihapus');
                }
            });
        });
    })
})

var path = location.pathname.split('/')
var url = location.origin + "/" + path[1]

$('ul.sidebar-menu li a').each(function() {
    if ($(this).attr('href').indexOf(url) !== -1) {
        $(this).parent().addClass('active').parent().parent('li').addClass('active')
    }
})

// modal konfirm
function submitDel(id) {
    $('#del-'+id).submit()
}

function returnLogout() {
    var link = $('#logout').attr('href')
    $(location).attr('href', link)
}

