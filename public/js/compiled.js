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

    // CKEDITOR-FUCNTIONALITY
    // ================================================================================
    if (document.body.querySelectorAll('.editor')) {
        [...document.querySelectorAll('.editor')].map((item) => {
            CKEDITOR.replace(item);
        });
    }

    // SELECT-2-FUCNTIONALITY
    // ================================================================================
    if (document.body.querySelector('.select2-multiple')) {
        let dropdowns = [...document.body.querySelectorAll('.select2-multiple')];
        dropdowns.map((item) => {
            $(item).select2({
                placeholder: 'Ketikkan jika tidak ada',
                width: '100%',
                dropdownAutoWidth: true,
                theme: 'bootstrap-5',
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
                theme: 'bootstrap-5',
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
        tables.map((item) => {
            $(item).DataTable({
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
                    emptyTable: "Data tidak ditemukan",
                    processing: "Mohon menunggu..."
                }
            });
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
                    let columnTypes = response.columnTypes;
                    let columnDefs = [];

                    for (let i = 0; i < columns.length; i++) {
                        if (columns[i] == 'edit') {
                            columnDefs.push({
                                data: columns[2],
                                render: function(data, type, row, meta) {
                                    return '<a href="/master/'+ meta.settings.oInit.meta.code +'/edit/'+ row.id +'" onclick="event.preventDefault();" class="dotted" data-bs-route="/master/'+ meta.settings.oInit.meta.code +'/edit/'+ row.id +'" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-code="'+ meta.settings.oInit.meta.code +'" data-bs-table="'+ meta.settings.oInit.meta.table +'" data-bs-type="Edit"><i class="bi bi-pencil-square"></i></a>';
                                }
                            });
                        } else if (columns[i] == 'delete') {
                            columnDefs.push({
                                data: columns[2],
                                render: function(data, type, row, meta) {
                                    return '<a href="/master/'+ meta.settings.oInit.meta.code +'/delete/'+ row.id +'" class="dotted btn-delete" data-bs-id="'+ row.id +'" data-bs-code="'+ meta.settings.oInit.meta.code +'" data-bs-table="'+ meta.settings.oInit.meta.table +'"><i class="bi bi-trash"></i></a>';
                                }
                            });
                        } else if (columns[i] == 'on_image' || columns[i] == 'off_image' || columns[i] == 'user_agent') {
                            columnDefs.push({
                                visible: false,
                                data: columns[i],
                                orderable: true,
                                searchable: true
                            });
                        } else if (columns[i] == 'name') {
                            columnDefs.push({
                                data: columns[i],
                                render: function(data, type, row) {
                                    return data.toUpperCase();
                                },
                                orderable: true,
                                searchable: true
                            });
                        } else if (columns[i] == 'icon') {
                            columnDefs.push({
                                data: columns[i],
                                render: function(data, type, row) {
                                    return '<i class="bi '+ data + '"></i>';
                                },
                                orderable: true,
                                searchable: true
                            });
                        } else if (columnTypes[i] == 'text') {
                            columnDefs.push({
                                data: columns[i],
                                render: function(data, type, row) {
                                    return data.substring(0, 64) + '...';
                                },
                                orderable: true,
                                searchable: true
                            });
                        } else if (columnTypes[i] == 'date' || columnTypes[i] == 'datetime') {
                                columnDefs.push({
                                    data: columns[i],
                                    render: function(data, type, row) {
                                        if (data == null || data == '') {
                                            return '<em>null</em>';
                                        }
                                        return dateFormat(data);
                                    },
                                    orderable: true,
                                    searchable: true
                                });
                        } else {
                            columnDefs.push({
                                data: columns[i],
                                render: function(data, type, row) {
                                    if (data == null || data == '') {
                                        data = '<em>null</em>';
                                    }
                                    return data;
                                },
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
                            emptyTable: "Data tidak ditemukan",
                            processing: ""
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
    $(document).on('click', '.btn-delete', function(event) {
        event.preventDefault();
        let id = $(this).data('bsId');
        let code = $(this).data('bsCode');

        $('#vanisher').attr('action', `/master/${code}/delete/${id}`);

        Swal.fire({
            title: 'Konfirmasi',
            text: `Hapus data ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Gak jadi',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loader').fadeIn();
                $('#vanisher').submit();
            }
        });
    });

    // TRIGGERING-ANY-MODAL
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
                    // ABLE-TO-DEFINE-NEW-ARTICLES
                    $('.select2-multiple-modal').select2({
                        placeholder: 'Ketikkan jika tidak ada',
                        tags: true,
                        theme: 'bootstrap-5',
                        width: '100%',
                        dropdownAutoWidth: true,
                        dropdownParent: modalControl,
                        cache: true,
                        allowClear: true,
                        debug: true
                    });

                    // INCAPABLE-OF-DEFINING-NEW-ARTICLES
                    $('.select2-single-modal').select2({
                        placeholder: 'Pilih satu',
                        theme: 'bootstrap-5',
                        width: '100%',
                        dropdownAutoWidth: true,
                        dropdownParent: modalControl,
                        cache: true,
                        allowClear: true,
                        debug: true
                    });

                    // STATUS
                    console.log('Fetched successfully...');
                },
                timeout: 4296
            });
        });
    }

    // SELECT-2-FUNCTIONALITY
    // ====================================================================================
    $('.select2-ajax-school').select2({
        placeholder: 'Pilih satu',
        minimumInputLength: 3,
        theme: 'bootstrap-5',
        width: '100%',
        dropdownAutoWidth: true,
        allowClear: true,
        cache: true,
        debug: true,
        tags: true,
        ajax: {
            url: function(params) {
                return 'https://api-sekolah-indonesia.vercel.app/sekolah/s?sekolah=' + params.term
            },
            type: 'GET',
            dataType: 'json',
            delay: 250,
            processResults: function(response) {
                return {
                    results: response.dataSekolah.map(function(item) {
                        return {
                            id: item.id,
                            text: item.sekolah
                        }
                    })
                };
            },
            cache: true
        }
    });

    if ($('.select2-server')) {
        let table = $('.select2-server').data('bsTable');
        $('.select2-server').select2({
            placeholder: 'Pilih satu',
            // minimumInputLength: 3,
            theme: 'bootstrap-5',
            width: '100%',
            dropdownAutoWidth: true,
            allowClear: true,
            cache: true,
            debug: true,
            ajax: {
                url: '/server/' + table,
                data: function(params) {
                    return {
                        keyword: params.term
                    }
                },
                type: 'GET',
                dataType: 'json',
                delay: 250,
                processResults: function(response) {
                    return {
                        results: response.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    };
                },
                cache: true
            }
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

function chooseResume() {
    $('#resumeOnModal').trigger('click');
}

$("[type=file]").on("change", function() {
    let file = this.files[0].name;
    if($(this).val()!=""){ $(this).next().text(file); }
    else { $(this).next().text("Tidak ada berkas terpilih"); }
});

function dateFormat(date) {
    let dateString = new Date(date);
    let day = dateString.getDay();
    let dateOfDate = dateString.getDate();
    let month = dateString.getMonth();
    let yearOfDate = dateString.getYear();

    let dayTuple = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    let monthTuple = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'];

    let year = (yearOfDate < 1000) ? yearOfDate + 1900 : yearOfDate;

    if (dateOfDate < 10) {
        dateOfDate = '0' + dateOfDate;
    }

    return dateOfDate + ' ' + monthTuple[month] + ' ' + year;
}

function plsConfirm(event) {
    event.preventDefault();
    let go = event.currentTarget.getAttribute('href');
    Swal.fire({
        title: 'Konfirmasi',
        text: `Ingin melanjutkan?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $('#loader').fadeIn();
            window.location.href = go;
        }
    });
}

// VARIABLE
// ================================================================================

function applyJob(event) {
    event.preventDefault();
}