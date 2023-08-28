$(document).ready(function(event) {
    // FADE-OUT-LOADER
    // ================================================================================
	$('#loader').fadeOut();

    // SB-PANEL
    // ================================================================================
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        if (localStorage.getItem('sidebar-toggle') === true) {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', (event) => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    const pills = document.body.querySelector('#pills-tab');
    if (pills) {
        $('.nav-pills .nav-link').on('click', function() {
            localStorage.setItem('active-tab', $(this).attr('id'));
        });
        let activeTab = localStorage.getItem('active-tab');
        if (activeTab) { $('#' + activeTab).tab('show'); }
    }

    // ACTIVE-NAV-ON-THE-ACCORDION
    // ================================================================================
    const currentUrl = window.location.href;
    let baseUrl = window.location.origin;
    let $matchingLinks = $('#sidenavAccordion a.nav-link[href="' + currentUrl + '"]');
    let segments = window.location.pathname.split('/');
    let lastSegment = segments[segments.length - 1];

    if ($matchingLinks.length > 0) {
        let $parentCollapse = $matchingLinks.closest('.collapse');
        $parentCollapse.addClass('show');
        $parentCollapse.prev().removeClass('collapsed');
        $parentCollapse.prev().addClass('active');

        let $grandParentCollapse = $parentCollapse.parent().closest('.collapse');
        $grandParentCollapse.addClass('show');
        $grandParentCollapse.prev().removeClass('collapsed');
        $grandParentCollapse.prev().addClass('active');
    } else {
        segments.pop();
        let parentUrl = baseUrl + segments.join('/');

        $('#sidenavAccordion a.nav-link').each(function() {
            let parentHref = $(this).attr('href');
            if (parentUrl == parentHref) {
                $(this).addClass('active');

                let $parentCollapse = $(this).closest('.collapse');
                $parentCollapse.addClass('show');
                $parentCollapse.prev().removeClass('collapsed');
                $parentCollapse.prev().addClass('active');

                let $grandparentCollapse = $parentCollapse.closest('.collapse');
                $grandparentCollapse.addClass('show');
                $grandParentCollapse.prev().removeClass('collapsed');
                $parentCollapse.prev().addClass('active');
            }
        });
    }

    /*
    const activeNav = window.location.href;
    const navLinks = document.body.querySelectorAll('#sidenavAccordion a.nav-link').forEach((link) => {
        let segments = window.location.pathname.split('/');
        let lastSegment = segments[segments.length - 1];
        if (link.href.toLowerCase() == activeNav && !/\d/.test(lastSegment)) {
            link.classList.add('active');
            if (link.closest('nav.nav')) {
                link.parentElement.parentElement.classList.add('show');
                link.parentElement.parentElement.previousElementSibling.classList.remove('collapsed');
                link.parentElement.parentElement.previousElementSibling.classList.add('active');
            }
        } else {
            if (activeNav.includes(link.href.toLowerCase()) && /\d/.test(lastSegment)) {
                link.classList.add('active');
                if (link.closest('nav.nav')) {
                    link.parentElement.parentElement.classList.add('show');
                    link.parentElement.parentElement.previousElementSibling.classList.remove('collapsed');
                    link.parentElement.parentElement.previousElementSibling.classList.add('active');
                }
            }
        }
    });
    */

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
    [...document.querySelectorAll('.editor')].map((item) => {
        CKEDITOR.replace(item);
    });

    // SELECT-2-FUCNTIONALITY
    // ================================================================================
    if ($('.select2-multiple')) {
        let multiDropdowns = [...document.body.querySelectorAll('.select2-multiple')];
        multiDropdowns.map((item) => {
            $(item).select2();
            $(item).select2('destroy');
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

    if ($('.select2-single')) {
        let singleDropdowns = [...document.body.querySelectorAll('.select2-single')];
        singleDropdowns.map((item) => {
            $(item).select2();
            $(item).select2('destroy');
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
        [...document.body.querySelectorAll('table.fetch')].map((item) => {
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
                    processing: "Mengambil data..."
                },
                createdRow: function(row, data, index) {
                    if (data.deleted_at) {
                        $(row).addClass('deleted');
                    }
                }
            });
        });
    }

    if ($('table.server-side')) {
        [...document.querySelectorAll('table.server-side')].map((item) => {
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
                                orderable: false,
                                searchable: false
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

                    $(item).DataTable({
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

    if ($('table.vacancy')) {
        [...document.body.querySelectorAll('table.vacancy')].map((item) => {
            $(item).DataTable({
                ajax: '/server/vacancies/fetch',
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                columns: [
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            let response = '';
                            if (row['active'] && new Date(row['closing_date']) > new Date()) {
                                response = '<span class="badge text-bg-success"><i class="bi bi-check-circle me-1"></i>Published</span>';
                            } else if (!row['active'] || new Date(row['closing_date']) > new Date()) {
                                response = '<span class="badge text-bg-primary"><i class="bi bi-info-circle me-1"></i>Draft</span>';
                            } else if (!row['active'] || new Date(row['closing_date']) < new Date()) {
                                response = '<span class="badge text-bg-danger"><i class="bi bi-x-circle me-1"></i>Expired</span>';
                            } else {
                                response = 'OK';
                            }
                            return response;
                        }
                    },
                    {
                        data: 'id',
                        name: 'project.project_number',
                        render: function(data, type, row) {
                            return '<a href="/vacancy/' + data + '" class="underlined"><strong>' + row['project']['project_number'].toUpperCase() + '</strong></a>';
                        }
                    },
                    {
                        data: 'project',
                        name: 'project.partner.name',
                        render: function(data, type, row) {
                            return data.partner.name.toUpperCase();
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: 'placement',
                        name: 'placement',
                        render: function(data, type, row) {
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        render: function(data, type, row) {
                            return '<strong>' + data + '</strong> ORANG';
                        }
                    },
                    {
                        data: 'candidates_count',
                        name: 'candidates_count',
                        render: function(data, type, row) {
                            return '<strong>' + data + '</strong> ORANG';
                        }
                    },
                    {
                        data: null,
                        name: 'id',
                        render: function(data, type, row) {
                            return '<a href="/vacancy/'+ row['id'] +'/edit" class="text-center"><i class="bi bi-pencil-square"></i></a>';
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'closing_date',
                        name: 'id',
                        render: function(data, type, row) {
                            let response = '-';
                            if (!row['active'] || (data == null || data == '')) {
                                response = '<a href="/vacancy/' + row['id'] + '/publish" class="dotted" data-bs-position="' + row['name'].toUpperCase() + '" data-bs-param="info" onclick="archiveOrPublish(event)">Terbitkan</a>';
                            }
                            return response;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'closing_date',
                        name: 'id',
                        render: function(data, type, row) {
                            let response = '-';
                            if (row['active'] && ((new Date(row['closing_date']) > new Date()) || (data == null || data == ''))) {
                                response = '<a href="/vacancy/' + row['id'] + '/archive" class="dotted" data-bs-position="' + row['name'].toUpperCase() + '" data-bs-param="warning" onclick="archiveOrPublish(event)">Arsipkan</a>';
                            }
                            return response;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
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
                    processing: "Mengambil data..."
                },
                createdRow: function(row, data, index) {
                    if (data.deleted_at) {
                        $(row).addClass('deleted');
                    }
                    $(row).find('td:eq(7)').addClass('text-center');
                },
                order: [[0, 'desc']]
            });
        });
    }

    // DELETE-FUNCTIONALITY
    // ================================================================================
    $(document).on('click', '.btn-delete', function(event) {
        event.preventDefault();

        let code = $(this).data('bsCode');
        let id = $(this).data('bsId');

        console.log(event, id, code);

        $('#vanisher').attr('action', '/master/' + code + '/delete/' + id);

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
                    console.log('Fetching initialized...');
                },
                success: (result) => {
                    $('#modalControlPlaceholders').html(result);
                },
                complete: () => {
                    // FLATPICKR-LIBRARY
                    $("input[type=date]").flatpickr({
                        allowInput: true,
                        dateFormat: 'Y-m-d',
                        altInputClass: 'flatpickr-hand form-control',
                        altInput: true,
                        altFormat: 'd F Y',
                        appendTo: modalControl,
                        locale: 'id'
                    });
                    $("input[type=time]").flatpickr({
                        altInputClass: 'flatpickr-hand form-control',
                        appendTo: modalControl,
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: 'H:i',
                        locale: 'id'
                    });

                    // ABLE-TO-DEFINE-NEW-ARTICLES
                    [...document.querySelectorAll('.select2-multiple-modal')].map((item) => {
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
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
                    });
                    [...document.querySelectorAll('.select2-multiple-server-modal')].map((item) => {
                        let table = $(item).data('bsTable');
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
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
                                                text: item.name.toUpperCase()
                                            }
                                        })
                                    };
                                },
                                cache: true
                            },
                            // minimumInputLength: 3,
                            tags: true,
                            cache: true,
                            allowClear: true,
                            placeholder: 'Ketikkan jika tidak ada',
                            dropdownParent: modalControl,
                            dropdownAutoWidth: true,
                            theme: 'bootstrap-5',
                            width: '100%',
                            debug: true
                        });
                    });

                    // INCAPABLE-OF-DEFINING-NEW-ARTICLES
                    [...document.querySelectorAll('.select2-single-modal')].map((item) => {
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
                            placeholder: 'Pilih satu',
                            theme: 'bootstrap-5',
                            width: '100%',
                            dropdownAutoWidth: true,
                            dropdownParent: modalControl,
                            cache: true,
                            allowClear: true,
                            debug: true
                        });
                    });
                    [...document.querySelectorAll('.select2-single-server-modal')].map((item) => {
                        let table = $(item).data('bsTable');
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
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
                                                text: item.name.toUpperCase()
                                            }
                                        })
                                    };
                                },
                                cache: true
                            },
                            // minimumInputLength: 3,
                            cache: true,
                            allowClear: true,
                            placeholder: 'Pilih satu',
                            dropdownParent: modalControl,
                            dropdownAutoWidth: true,
                            theme: 'bootstrap-5',
                            width: '100%',
                            debug: true
                        });
                    });

                    [...document.querySelectorAll('.editor-on-modal')].map((item) => {
                        CKEDITOR.replace(item);
                    });

                    // STATUS
                    console.log('Fetched successfully...');
                },
                timeout: 4296
            });
        });
    }

    // FLATPICKR
    // ====================================================================================
    $("input[type=date]").flatpickr({
        allowInput: true,
        dateFormat: 'Y-m-d',
        altInputClass: 'flatpickr-hand form-control',
        altInput: true,
        altFormat: 'd F Y',
        locale: 'id'
    });

    $("input[type=time]").flatpickr({
        altInputClass: 'flatpickr-hand form-control',
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        locale: 'id'
    });

    // SELECT-2-FUNCTIONALITY
    // ====================================================================================
    if ($('.select2-school')) {
        $('.select2-school').select2({
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
                    return 'https://api-sekolah-indonesia.vercel.app/sekolah/s?sekolah=' + params.term + '&perPage=10'
                },
                async: true,
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
    }

    if ($('.select2-multiple-server')) {
        let table = $('.select2-multiple-server').data('bsTable');
        [...document.querySelectorAll('.select2-multiple-server')].map((item) => {
            $(item).select2();
            $(item).select2('destroy');
            $(item).select2({
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
                },
                // minimumInputLength: 3,
                tags: true,
                cache: true,
                allowClear: true,
                placeholder: 'Pilih satu',
                dropdownAutoWidth: true,
                theme: 'bootstrap-5',
                width: '100%',
                debug: true
            });
        });
    }

    if ($('.select2-single-server')) {
        let table = $('.select2-single-server').data('bsTable');
        [...document.querySelectorAll('.select2-single-server')].map((item) => {
            $(item).select2();
            $(item).select2('destroy');
            $(item).select2({
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
                },
                // minimumInputLength: 3,
                cache: true,
                allowClear: true,
                placeholder: 'Pilih satu',
                dropdownAutoWidth: true,
                theme: 'bootstrap-5',
                width: '100%',
                debug: true
            });
        });
    }
    // END-OF-READY-ARTICLES
    // ====================================================================================
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
$('.check-parent').on('click', function() {
    $('.check-child').prop('checked', this.checked);
    let batch = $(this).data('bsBatch');
    updateParentCheckBoxState(batch);
});
$('.check-child').on('click', function() {
    let batch = $(this).data('bsBatch');
    updateParentCheckBoxState(batch);
});

function updateParentCheckBoxState(batch) {
    console.log(batch);
    let allChecked = $('.check-child:checked').length == $('.check-child').length;
    let anyChecked = $('.check-child:checked').length > 0;

    if (allChecked) {
        $('.check-parent').prop('checked', true);
        $('.check-parent').prop('indeterminate', false);
    } else if (anyChecked) {
        $('.check-parent').prop('checked', false);
        $('.check-parent').prop('indeterminate', true);
    } else {
        $('.check-parent').prop('checked', false);
        $('.check-parent').prop('indeterminate', false);
    }
}

// USER-DEFINED-FUCNTIONS
// ====================================================================================
function loadingOnSubmit(event) {
    event.preventDefault();
    $('#loader').fadeIn();
    event.target.submit();
}

function chooseResume() {
    $('#resumeOnModal').trigger('click');
}

// ON-CHANGE-FILE-INPUT
// ====================================================================================
/*
$("[type=file]").on("change", function() {
    let file = this.files[0].name;
    if($(this).val()!=""){ $(this).next().text(file); }
    else { $(this).next().text("Tidak ada berkas terpilih"); }
});
*/

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

function confirmDel(event) {
    event.preventDefault();

    let id = event.currentTarget.dataset['bsId'];
    let action = event.currentTarget.getAttribute('href');

    console.log(id, action)

    $('#vanisher').attr('action', action);

    Swal.fire({
        title: 'Hapus data ini?',
        text: id,
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
}

function applyJob(event) {
    event.preventDefault();
}

function numericOnly(event) {
    let input = event.target;
    let value = input.value;
    let sanitized = value.replace(/\D/g, '');
    input.value = sanitized;
}

function typingMoney(event) {
  $(event.currentTarget).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  });
}

function disableUntilNow(event) {
    if  (event.target.checked) {
        event.target.parentElement.previousElementSibling.setAttribute('disabled', true);
        event.target.parentElement.previousElementSibling.classList.remove('flatpickr-hand');
        event.target.parentElement.previousElementSibling.value = '';
    } else {
        event.target.parentElement.previousElementSibling.removeAttribute('disabled');
        event.target.parentElement.previousElementSibling.classList.add('flatpickr-hand');
    }
}

function clock() {
    const month = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Augustus", "September", "Oktober",
                    "November", "Desember" ];

    function harold(standIn) {
        if (standIn < 10) {
            standIn = '0' + standIn;
        } return standIn;
    }

    let time = new Date(),
        theDate = harold(time.getDate()) + ' ' + (month[time.getMonth()]) + ' ' + time.getFullYear(),
        hours = time.getHours(),
        minutes = time.getMinutes(),
        seconds = time.getSeconds();

    document.body.querySelector('#clock').innerHTML = theDate + ' ' + harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
}

if (document.querySelector('#clock')) {
    setInterval(clock, 1000);
}

let div = 0;
function cloneRecipient(event) {
    div++;
    let clonedInput = $('.recipients').first().clone(true);
    clonedInput.attr('id', 'recipient-' + div);
    clonedInput.val('');
    let container = $('<div class="d-flex mb-1 gap-1"></div>');
    clonedInput.appendTo(container);
    container.appendTo('#recipients-placeholder');
    $('<button type="button" class="btn btn-danger rounded-0" data-bs-target="#recipient-'+ div +'" onclick="removeThisObject(event)"><i class="bi bi-trash3"></i></button>').insertBefore('#recipient-'+ div);
}

function removeThisObject(event) {
    event.preventDefault();
    event.currentTarget.dataset['bsTarget'];
    event.currentTarget.parentElement.remove();
}

function capitalizeEachWord(string) {
  return string.replace(/\b\w/g, function(match) {
    return match.toUpperCase();
  });
}

function archiveOrPublish(event) {
    event.preventDefault();
    let param = event.currentTarget.dataset['bsParam'];
    let position = event.currentTarget.dataset['bsPosition'];
    let route = event.currentTarget.getAttribute('href');

    let word = 'Terbitkan';
    if (param == 'warning') { word = 'Arsipkan'; }

    Swal.fire({
        title: position,
        text: word + ' lowongan kerja ini?',
        icon: param,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
    }).then((response) => {
        if (response.isConfirmed) {
            $('#loader').fadeIn();
            window.location.href = route;
        }
    }).catch(swal.noop);
}