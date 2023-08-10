$(document).ready(function(event) {
    // FADE-OUT-LOADER
    // ================================================================================
	$('#loader').fadeOut();

    // SB-PANEL
    // ================================================================================
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        if (localStorage.getItem('sb|sidebar-toggle') === true) {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', (event) => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // MASKING-TEXT-TO-PASSWORD
    // ================================================================================
	$('#remember').click(function(event) {
		$(this).is(':checked') ? $('.password').attr('type', 'text') : $('.password').attr('type', 'password');
	});

    // CLICK-TO-ANCHOR-BY-SCROLL
    // ================================================================================
    $("a[href*='#']:not(a[href='#'])").click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
            || location.hostname == this.hostname) {
            let target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 0,
                }, 860);
                return false;
            }
        }
    });

    // SELECT-2-FUCNTIONALITY
    // ================================================================================
    if (document.body.querySelector('.select2-multiple')) {
        let dropdowns = [...document.body.querySelectorAll('.select2-multiple')];
        dropdowns.map((item) => {
            $(item).select2({
                placeholder: 'Ketikkan jika tidak ada',
                width: '100%',
                dropdownAutoWidth: true,
                language: 'id',
                allowClear: true,
                tags: true,
                debug: true,
                cache: true,
            });
        });
    }
    if (document.body.querySelector('.select2-single')) {
        let dropdowns = [...document.body.querySelectorAll('.select2-single')];
        dropdowns.map((item) => {
            $(item).select2({
                placeholder: 'Pilih satu',
                width: '100%',
                dropdownAutoWidth: true,
                language: 'id',
                allowClear: true,
                debug: true,
                cache: true,
            });
        });
    }

    // DATATABLE
    // ================================================================================
    if ($('table.fetch')) {
        let tables = [...document.body.querySelectorAll('table.fetch')];
        let objDataTable = $('table.fetch').dataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                paginate: {
                    previous: '<i class="bi bi-caret-left-fill"></i>',
                    next: '<i class="bi bi-caret-right-fill"></i>'
                },
                infoFiltered: '',
                lengthMenu: '_MENU_',
                search: '',
                searchPlaceholder: "Pencarian",
                emptyTable: "Data tidak ditemukan"
            }
        });
        // $('.dataTables_length select').addClass('mb-2');
        // $('.dataTables_filter').addClass('mb-2');
    }

    if ($('table.server-side')) {
        const fetch = [...document.querySelectorAll('table.server-side')];
        fetch.map((item) => {
            let href = window.location.href + '/fetch';
            let table = document.querySelector('#table-name').textContent;
            let code = href.split('/')[4];
            $.ajax({
                url: href,
                type: 'GET',
                success: (response) => {
                    let columns = response.columns;
                    let columnDefs = [];

                    for (let i = 0; i < columns.length; i++) {
                        if (columns[i] == 'edit') {
                            columnDefs.push({
                                data: columns[2],
                                render: function(data, type, row, meta) {
                                    return '<a href="/master/'+ meta.settings.oInit.meta.code +'/edit/'+ row.id +'" onclick="event.preventDefault();" class="dotted" data-bs-route="/master/'+ meta.settings.oInit.meta.code +'/edit/'+ row.id +'" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="'+ meta.settings.oInit.meta.table +'" data-bs-type="Edit"><i class="bi bi-pencil-square"></i></a>';
                                }
                            });
                        } else if (columns[i] == 'delete') {
                            columnDefs.push({
                                data: columns[2],
                                render: function(data, type, row, meta) {
                                    return '<a href="/master/'+ meta.settings.oInit.meta.code +'/delete/'+ row.id +'" class="dotted" data-bs-id="'+ row.id +'" data-bs-table="'+ meta.settings.oInit.meta.table +'" onclick="deleteConfirmation(event);"><i class="bi bi-trash"></i></a>';
                                }
                            });
                        } else if (columns[i] == 'on_image' || columns[i] == 'off_image' || columns[i] == 'user_agent') {
                            columnDefs.push({
                                visible: false,
                                data: columns[i],
                                orderable: true,
                                searchable: true
                            });
                        } else if (columns[i] == 'url') {
                            columnDefs.push({
                                data: columns[i],
                                render: function(data, type, row) {
                                    return data.substring(0, 64) + '...';
                                },
                                orderable: true,
                                searchable: true
                            });
                        } else {
                            columnDefs.push({
                                data: columns[i],
                                orderable: true,
                                searchable: true
                            });
                        }
                    }

                    $('table.server-side').DataTable({
                        processing: true,
                        serverSide: true,
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                            paginate: {
                                previous: '<i class="bi bi-caret-left-fill"></i>',
                                next: '<i class="bi bi-caret-right-fill"></i>'
                            },
                            infoFiltered: '',
                            lengthMenu: '_MENU_',
                            search: '',
                            searchPlaceholder: "Pencarian",
                            emptyTable: "Data tidak ditemukan"
                        },
                        ajax: href,
                        scrollX: true,
                        columns: columnDefs,
                        meta: {
                            code: code,
                            table: table
                        },
                        orderCellsTop: true
                    });
                },
            });
        });
    }

    // DELETE-FUNCTIONALITY
    // ================================================================================
    $('.btn-delete').click(function(event) {
        event.preventDefault();
        let id = $(this).data('bsId');
        console.log(event, $(this));

        Swal.fire({
            title: id,
            text: "Hapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                })
            }
        });
    });

    // TRIGGERING-FROM-ANY-MODAL
    // ================================================================================
    $(document).on('click', '#trigger', (event) => {
        $('#btn-modal').trigger('click');
    });

    // DYNAMIC-MODAL-INITIALIZATION
    // ================================================================================
    let modalControl = document.getElementById('modalControl');
    if (modalControl) {
        modalControl.addEventListener('show.bs.modal', function (event) {
            let btn = event.relatedTarget;

            // let route = btn.getAttribute('data-bs-route');
            let route = btn.getAttribute('href');
            let table = btn.getAttribute('data-bs-table');
            let type = btn.getAttribute('data-bs-type');

            modalControl.querySelector('.modal-title').textContent = table + '—' + type;

            $.ajax({
                url: route,
                async: true,
                type: 'GET',
                beforeSend: () => {
                    console.log('Fetching starts...');
                },
                success: (result) => {
                    $('#modalControlPlaceholders').html(result);
                },
                complete: () => {
                    console.log('Fetched successfully...');
                    $('.select2-multiple-modal').select2({
                        placeholder: 'Ketikkan jika tidak ada',
                        tags: true,
                        width: '100%',
                        dropdownAutoWidth: true,
                        dropdownParent: modalControl,
                        cache: true,
                        allowClear: true,
                        debug: true
                    });
                },
                timeout: 6000
            });
        });
    }
});

// SCROLL-FUNCTIONALITY
// ====================================================================================
$(window).on('scroll', function() {
    let currentScroll = $(this).scrollTop();
    let windowsHeight = $(this).height();
    let documentHeight = $(document).height();
    let scrollPercentage = 100 * (currentScroll / (documentHeight - windowsHeight));
    $('#move').css({ width: (scrollPercentage) + '%' });
});


// USER-DEFINED-FUCNTIONS
// ====================================================================================
function resendEmailVerification(event) {
    event.preventDefault();
    $('#loader').fadeIn();
    event.target.submit();
}

function deleteConfirmation(event) {
    event.preventDefault();
    let href = event.currentTarget.getAttribute('href');
    let id = event.currentTarget.dataset['bsId'];
    let table = event.currentTarget.dataset['bsTable'];
    let token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Hapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((response) => {
        console.log(response)
        if (response.isConfirmed) {
            $.ajax({
                url: href,
                type: 'DELETE',
                data: {
                    '_method': 'DELETE',
                    '_token': token
                },
                async: true,
                beforeSend: (result) => {
                    $('#loader').fadeIn();
                },
                success: (result) => {
                    Swal.fire('Berhasil', 'Data berhasil dihapus.', 'success');
                },
                complete: (result) => {
                    $('#loader').fadeOut();
                    console.log(result);
                    // window.location.reload();
                },
                error: (xhr, status, error) => {
                    Swal.fire('Kesalahan', 'Mohon coba lagi nanti.', 'error');
                }
            });
        }
    });
}