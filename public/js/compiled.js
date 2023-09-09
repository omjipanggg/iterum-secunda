/*
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
*/

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
        // let parentUrl = baseUrl + segments.join('/');
        let parentUrl = baseUrl + '/' + segments[1];

        $('#sidenavAccordion a.nav-link').each(function() {
            let parentHref = $(this).attr('href');
            if (parentUrl == parentHref) {
                $(this).addClass('active');

                let $parentCollapse = $(this).closest('.collapse');
                $parentCollapse.addClass('show');
                $parentCollapse.prev().removeClass('collapsed');
                $parentCollapse.prev().addClass('active');

                let $grandParentCollapse = $parentCollapse.closest('.collapse');
                $grandParentCollapse.addClass('show');
                $grandParentCollapse.prev().removeClass('collapsed');
                $grandParentCollapse.prev().addClass('active');
            }
            if (parentHref.includes(parentUrl)) {
                let $parentCollapse = $(this).closest('.collapse');
                $parentCollapse.addClass('show');
                $parentCollapse.prev().removeClass('collapsed');
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
        [...document.body.querySelectorAll('.select2-multiple')].map((item) => {
            $(item).select2();
            $(item).select2('destroy');
            $(item).select2({
                placeholder: 'Pilih atau ketikkan jika tidak ada',
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
        [...document.body.querySelectorAll('.select2-single')].map((item) => {
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
                        }
                        // RELATIONAL
                        /*
                        else if (columns[i].endsWith('_id')) {
                            columnDefs.push({
                                data: columns[i],
                                render: function(data, type, row, meta) {
                                    return data;
                                },
                                orderable: true,
                                searchable: true
                            });
                        }
                        */
                        else if (columns[i] == 'user_agent') {
                            columnDefs.push({
                                visible: false,
                                data: columns[i],
                                orderable: false,
                                searchable: false
                            });
                        }
                        else if (columns[i] == 'on_image' || columns[i] == 'off_image') {
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
                                    if (data == null || data == '') {
                                        return '<em>null</em>';
                                    }
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
                                    if (data == null || data == '') {
                                        return '<em>null</em>';
                                    }
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
                        createdRow: function(row, data, index) {
                            $(row).find('td:eq(0)').addClass('text-center');
                            $(row).find('td:eq(1)').addClass('text-center');
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

    if ($('table.table-vacancy')) {
        [...document.body.querySelectorAll('table.table-vacancy')].map((item) => {
            $(item).DataTable({
                ajax: '/server/vacancies/fetch',
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                columns: [
                    {
                        data: 'active',
                        name: 'active',
                        render: function(data, type, row) {
                            let response = '-';
                            if (row['active'] && new Date(row['closing_date']) > new Date()) {
                                response = '<span class="badge text-bg-success"><i class="bi bi-check-circle me-1"></i><a href="/portal/'+ row['slug'] +'" class="dotted text-white">Published</a></span>';
                            } else if (!row['active'] && new Date(row['closing_date']) > new Date()) {
                                response = '<span class="badge text-bg-primary"><i class="bi bi-info-circle me-1"></i>Draft</span>';
                            } else {
                                response = '<span class="badge text-bg-danger"><i class="bi bi-x-circle me-1"></i>Expired</span>';
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
                        data: 'region',
                        name: 'region.name',
                        render: function(data, type, row) {
                            /* MULTIPLE */
                            /*
                            let regions = [];
                            let rendered = '';

                            for (let i = 0; i < data.length; i++) {
                                regions.push(data[i]);
                            }

                            [...regions].map((item, i, row) => {
                                if ((i+1) === row.length) {
                                    rendered += '<strong>' + item.slug.toUpperCase() + '</strong>' ;
                                } else {
                                    rendered += '<strong>' + item.slug.toUpperCase() + ', </strong>' ;
                                }
                            });
                            return rendered;
                            */
                            /* SINGLE-REGION-RELATION */
                            if (data == null || data == '') {
                                return '<em>-</em>'
                            }
                            return '<strong>' + data.slug.toUpperCase() + '</strong>';
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
                        data: 'created_at',
                        name: 'created_at',
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
                            if ((!row['active'] && (new Date(data) > new Date())) || (data == null || data == '')) {
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
                            if ((row['active'] && (new Date(row['closing_date']) > new Date())) || (data == null || data == '')) {
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
                    $(row).find('td:eq(8)').addClass('text-center');
                },
                order: [[9, 'desc']]
            });
        });
    }

    if ($('table.table-candidates')) {
        const parameters = new URLSearchParams(window.location.search);
        [...document.body.querySelectorAll('table.table-candidates')].map((item) => {
            $(item).DataTable({
                ajax: '/server/candidates/fetch' + window.location.search,
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                columns: [
                    {
                        data: 'profile.name',
                        name: 'profile.name',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return '<em>null</em>';
                            }
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: 'profile.gender.name',
                        name: 'profile.gender.name',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return '<em>null</em>';
                            }
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: 'profile.city.name',
                        name: 'profile.city.name',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return '<em>null</em>';
                            }
                            return data.toUpperCase();
                        }
                    },
                    {
                        data: 'profile.date_of_birth',
                        name: 'profile.date_of_birth',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return '<em>null</em>';
                            }
                            return dateFormat(data).toUpperCase() + ' <strong>('+ calculateAge(data) +')</strong>';
                        }
                    },
                    {
                        data: 'profile.last_education',
                        name: 'profile.last_education.education.name',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return '<em>null</em>';
                            }

                            let education = '';
                            for (let i = 0; i < data.length; i++) {
                                education += '<span class="badge text-bg-dark rounded-0 me-1">' + data[i].education.name + '</span>';
                            }
                            return education;
                        }
                    },
                    {
                        data: 'expected_salary',
                        name: 'expected_salary',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return '<em>null</em>';
                            }
                            return 'Rp' + Intl.NumberFormat('id-ID').format(data) + ',-';
                        }
                    },
                    {
                        data: 'ready_to_work',
                        name: 'ready_to_work',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return '<em>null</em>';
                            }
                            return data.toUpperCase();
                        }
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
                // order: [[9, 'desc']],
                createdRow: function(row, data, index) {
                    if (data.deleted_at) {
                        $(row).addClass('deleted');
                    }
                    // $(row).find('td:eq(8)').addClass('text-center');
                }
            });
        });
    }

    // DELETE-FUNCTIONALITY
    // ================================================================================
    $(document).on('click', '.btn-delete', function(event) {
        event.preventDefault();

        let code = $(this).data('bsCode');
        let id = $(this).data('bsId');

        $('#vanisher').attr('action', '/master/' + code + '/delete/' + id);

        Swal.fire({
            title: 'Konfirmasi',
            text: `Hapus data ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Gak jadi',
            reverseButtons: true,
        }).then((response) => {
            if (response.isConfirmed) {
                $('#loader').fadeIn();
                $('#vanisher').submit();
            }
        });
    });

    // MONEY-FORMAT-ON-ANY-INPUT
    // ================================================================================
    [...document.querySelectorAll('input.form-money')].map((item) => {
        let originalMoney = $(item).val();
        let formattedMoney = originalMoney.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        $(item).val(formattedMoney)
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
                success: (response) => {
                    $('#modalControlPlaceholders').html(response);
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
                            placeholder: 'Pilih atau ketikkan jika tidak ada',
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
                        let order = $(item).data('bsOrder');
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
                            ajax: {
                                url: '/server/' + table,
                                data: function(params) {
                                    return {
                                        keyword: params.term,
                                        ordering: order
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
                            placeholder: 'Pilih atau ketikkan jika tidak ada',
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
                        let order = $(item).data('bsOrder');
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
                            ajax: {
                                url: '/server/' + table,
                                data: function(params) {
                                    return {
                                        keyword: params.term,
                                        ordering: order
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

    let modalFilter = document.getElementById('modalFilter');
    if (modalFilter) {
        modalFilter.addEventListener('show.bs.modal', function (event) {
            let btn = event.relatedTarget;
            let route = btn.getAttribute('href');
            let table = btn.getAttribute('data-bs-table');
            let type = btn.getAttribute('data-bs-type');

            modalFilter.querySelector('.modal-title').textContent = table + '—' + type;

            $.ajax({
                url: route,
                async: true,
                type: 'GET',
                beforeSend: () => {
                    console.log('Fetching initialized...');
                },
                success: (response) => {
                    $('#modalFilterPlaceholders').html(response);
                },
                complete: () => {
                    // FLATPICKR-LIBRARY
                    $("input[type=date]").flatpickr({
                        allowInput: true,
                        dateFormat: 'Y-m-d',
                        altInputClass: 'flatpickr-hand form-control',
                        altInput: true,
                        altFormat: 'd F Y',
                        appendTo: modalFilter,
                        locale: 'id'
                    });
                    $("input[type=time]").flatpickr({
                        altInputClass: 'flatpickr-hand form-control',
                        appendTo: modalFilter,
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
                            placeholder: 'Pilih atau ketikkan jika tidak ada',
                            tags: true,
                            theme: 'bootstrap-5',
                            width: '100%',
                            dropdownAutoWidth: true,
                            dropdownParent: modalFilter,
                            cache: true,
                            allowClear: true,
                            debug: true
                        });
                    });
                    [...document.querySelectorAll('.select2-multiple-server-modal')].map((item) => {
                        let table = $(item).data('bsTable');
                        let order = $(item).data('bsOrder');
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
                            ajax: {
                                url: '/server/' + table,
                                data: function(params) {
                                    return {
                                        keyword: params.term,
                                        ordering: order
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
                            placeholder: 'Pilih atau ketikkan jika tidak ada',
                            dropdownParent: modalFilter,
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
                            dropdownParent: modalFilter,
                            cache: true,
                            allowClear: true,
                            debug: true
                        });
                    });
                    [...document.querySelectorAll('.select2-single-server-modal')].map((item) => {
                        let table = $(item).data('bsTable');
                        let order = $(item).data('bsOrder');
                        $(item).select2();
                        $(item).select2('destroy');
                        $(item).select2({
                            ajax: {
                                url: '/server/' + table,
                                data: function(params) {
                                    return {
                                        keyword: params.term,
                                        ordering: order
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
                            dropdownParent: modalFilter,
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
        [...document.querySelectorAll('.select2-school')].map((item) => {
            $(item).select2({
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
        });
    }

    if ($('.select2-multiple-server')) {
        [...document.querySelectorAll('.select2-multiple-server')].map((item) => {
            let table = $(item).data('bsTable');
            let order = $(item).data('bsOrder');
            $(item).select2();
            $(item).select2('destroy');
            $(item).select2({
                ajax: {
                    url: '/server/' + table,
                    data: function(params) {
                        return {
                            keyword: params.term,
                            ordering: order
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
                placeholder: 'Pilih atau ketikkan jika tidak ada',
                dropdownAutoWidth: true,
                theme: 'bootstrap-5',
                width: '100%',
                debug: true
            });
        });
    }

    if ($('.select2-single-server')) {
        [...document.querySelectorAll('.select2-single-server')].map((item) => {
            let table = $(item).data('bsTable');
            let order = $(item).data('bsOrder');
            $(item).select2();
            $(item).select2('destroy');
            $(item).select2({
                ajax: {
                    url: '/server/' + table,
                    data: function(params) {
                        return {
                            keyword: params.term,
                            ordering: order
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

    $(document).on('submit', '#formAppendToSelect2', function (event) {
        event.preventDefault();

        let formData = $(this).serialize();

        let target = $(this).data('bsTarget');
        let route = $(this).attr('action');

        $.ajax({
            url: route,
            type: 'GET',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#loader').fadeIn();
            },
            success: function (response) {
                let newOption = $(`<option selected="" value="${response.data.id}">${response.data.name}</option>`);
                $(target).append(newOption).trigger('change');
            },
            complete: function(result) {
                $('#loader').fadeOut();
                if (result.code == 200) {
                    $('#modalControl').modal('hide');
                    Swal.fire("Sukses", "Data berhasil ditambahkan.", "success");
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
            timeout: 6000,
            cache: true
        });
    });

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

// CHECK-PARENT-AND-CHILDREN
// ====================================================================================
/*
$('.check-parent').on('change', function() {
    let batch = $(this).data('bsBatch');
    $(`.check-child-${batch}`).prop({
        checked: this.checked,
        disabled: true
    });

    $(`.check-grand-${batch}`).prop({
        checked: this.checked,
        disabled: true
    });

    if (!this.checked) {
        $(`.check-child-${batch}`).removeAttr('disabled');
        $(`.check-grand-${batch}`).removeAttr('disabled');
    }
});

$('.check-parent-double').on('change', function() {
    let batch = $(this).data('bsDoubleBatch');
    $(`.check-grand-${batch}`).prop({
        checked: this.checked,
        disabled: true
    });

    if (!this.checked) {
        $(`.check-grand-${batch}`).removeAttr('disabled');
    }
});

$('#formPrivileges').on('submit', function(event) {
    // event.preventDefault();
    $('.check-child, .check-grand').each(function() {
        let checkBoxInstance = $(this);
        if (checkBoxInstance.prop('checked')) {
            let hiddenInput = $('<input>')
                .attr({
                    type: 'text',
                    name: checkBoxInstance.attr('name')
                })
                .val(checkBoxInstance.val());
            $(this).after(hiddenInput);
        }
    });

    $('.check-child').each(function() {
    let checkBoxInstance = $(this);
    let hiddenInput = $('<input>')
        .attr('type', 'hidden')
        .attr('name', checkBoxInstance.attr('name'))
        .val(checkBoxInstance.prop('checked') ? checkBoxInstance.val() : '');
    $(this).after(hiddenInput);
    });
});
*/

/*
$('.check-child').on('change', function() {
    let batch = $(this).data('bsBatch');
    updateParentCheckBoxState(batch);
});

function updateParentCheckBoxState(batch) {
    let allChecked = $(`.check-child-${batch}:checked`).length == $(`.check-child-${batch}`).length;
    let anyChecked = $(`.check-child-${batch}:checked`).length > 0;

    if (allChecked) {
        $(`.check-parent-${batch}`).prop('checked', true);
        $(`.check-parent-${batch}`).prop('indeterminate', false);
    } else if (anyChecked) {
        $(`.check-parent-${batch}`).prop('checked', false);
        $(`.check-parent-${batch}`).prop('indeterminate', true);
    } else {
        $(`.check-parent-${batch}`).prop('checked', false);
        $(`.check-parent-${batch}`).prop('indeterminate', false);
    }
}
*/

// USER-DEFINED-FUCNTIONS
// ====================================================================================
// THIS-FUNCTION-SHOULD-BE-PUT-ON-THE-ON-SUBMIT-FORM
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

function underMaintenance(event) {
    event.preventDefault();
    Swal.fire('Tahap Pengembangan', 'Silakan mencoba kembali.', 'info');
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
    }).then((response) => {
        if (response.isConfirmed) {
            $('#loader').fadeIn();
            window.location.href = go;
        }
    });
}

function confirmDel(event) {
    event.preventDefault();

    let id = event.currentTarget.dataset['bsId'];
    let action = event.currentTarget.getAttribute('href');

    $('#vanisher').attr('action', action);

    Swal.fire({
        title: 'Hapus data ini?',
        text: id,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Gak jadi',
        reverseButtons: true,
    }).then((response) => {
        if (response.isConfirmed) {
            $('#loader').fadeIn();
            $('#vanisher').submit();
        }
    });
}

function applyJob(event) {
    event.preventDefault();
}

function showImageOnModal(event) {
    event.preventDefault();
    let route = event.currentTarget.href;
    $.ajax({
        url: route,
        method: 'GET',
        beforeSend: () => {
            $('#loader').fadeIn();
        },
        success: (response) => {
            Swal.fire({
                imageUrl: response.url
            });
        },
        complete: () => {
            $('#loader').fadeOut();
        }
    });
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

function putMoneyHolder(event, element) {
    $(element).val(event.currentTarget.value.replaceAll('.',''));
}

function disableUntilNow(event) {
    if (event.target.checked) {
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

// CLONE-FUNCTION
// ====================================================================================
let div = 1;
function cloneRecipient(event) {
    div++;
    let clonedInput = $('.recipients').first().clone(true);
    clonedInput.attr('id', 'recipient-' + div);
    clonedInput.val('');
    let container = $('<div class="d-flex mb-1 gap-1"></div>');
    clonedInput.appendTo(container);
    container.appendTo('#recipients-placeholder');
    $('<button type="button" class="btn btn-danger rounded-0" data-bs-target="#recipient-'+ div +'" onclick="removeThisObject(event);"><i class="bi bi-trash3"></i></button>').insertBefore('#recipient-'+ div);
}

function cloneQuestion(event) {
    div++;
    $('.select2-test-categories').select2('destroy');
    let cloned = $('.question').first().clone(true);
    let container = $('<div id="question-parent-'+ div +'"></div>')
    cloned.find('.question-container').attr('id', 'question-' + div)
    cloned.attr('id', 'question-block-' + div);
    cloned.find('select.select2-test-categories').attr('id', 'select2-question-' + div);
    cloned.find('input.test-name').attr('id', 'test-name-' + div).val('');
    cloned.find('input.test-limitation').attr('id', 'test-limitation-' + div).val('');
    cloned.find('input.test-duration').attr('id', 'test-duration-' + div).val('');
    cloned.find('.b-hide').hide();
    cloned.appendTo(container);
    container.appendTo('#question-holder');
    $('<button type="button" class="btn btn-danger px-4 rounded-0" data-bs-target="#question-block-' + div +'" onclick="removeThisObject(event);"><i class="bi bi-trash3"></i></button>').insertBefore('#question-'+ div);
    $(".select2-test-categories").select2({
        ajax: {
            url: '/server/test_categories',
            data: function(params) {
                return {
                    keyword: params.term,
                    ordering: 'asc'
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
    $("#select2-question-" + div).val('').trigger('change');
}

function removeThisObject(event) {
    event.preventDefault();
    let target = event.currentTarget.dataset['bsTarget'];
    $(target).parent().remove();
}

// CAPITALIZE
// ====================================================================================
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

// INSERT-NEW-RECORD-TO-CURRENT-LIST
// ================================================================================
function appendToCategories(event) {
    event.preventDefault();

    let route = event.target.form.action;
    let name = event.target.form.elements.name.value;

    $.ajax({
        url: route,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: name,
        },
        beforeSend: () => {
            $('#loader').fadeIn();
        },
        success: (response) => {
            let newList = $('<div class="form-check"><input class="form-check-input" type="checkbox" checked="" name="categories[]" value="'+ (response.id) +'" id="category-'+ (response.id + 814) +'"><label class="form-check-label" for="category-'+ (response.id + 814) +'">'+ capitalizeEachWord(response.name) +'</label></div>');
            $('#category-holder').append(newList);
        },
        complete: (result) => {
            if (result.status == 200) {
                $('#loader').fadeOut();
                $('#modalControl').modal('hide');
                Swal.fire({
                    title: "Sukses",
                    text: "Kategori baru berhasil ditambahkan.",
                    icon: "success"
                });
                $('#category-holder').animate({
                    scrollTop: $('#category-holder').height()
                }, 814);
            }
        }
    });
}

function appendToSelect2(event, element) {
    event.preventDefault();
    console.log(event);
    /*
    let url = event.target.form.action;
    let form = event.target.form.elements;

    $.post({
        url: url,
        data: {
            name: form.name.value,
            city_id: form.city_id.value,
            street_name: form.street_name.value,
            person_in_charge: form.person_in_charge.value,
            phone_number: form.phone_number.value,
            website: form.website.value,
            established_year: form.established_year.value,
            total_employees: form.total_employees.value,
            description: form.description.value,
            active: form.active.value
        },
        beforeSend: () => {
            $('#loader').fadeIn();
        },
        success: (response) => {
            if (response.code == 200) {
                let newOption = $('<option selected></option>');
                newOption.val(response.data.id);
                newOption.html(response.data.name)
                $('#vendorIdOnDetail').append(newOption);
            }
        },
        complete: (result) => {
            $('#loader').fadeOut();
            if (result.status == 200) {
                $('#modalControl').modal('hide');
                swal({
                    title: "Sukses",
                    text: "Mitra baru berhasil ditambahkan.",
                    icon: "success"
                });
            } else {
                swal({
                    title: "Gagal",
                    text: "Mitra gagal ditambahkan.",
                    icon: "error"
                });
            }
        }
    });

    $.ajax({
        url: route,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: name,
        },
        beforeSend: () => {
            $('#loader').fadeIn();
        },
        success: (response) => {
            let newList = $('<div class="form-check"><input class="form-check-input" type="checkbox" checked="" name="categories[]" value="'+ (response.id) +'" id="category-'+ (response.id + 814) +'"><label class="form-check-label" for="category-'+ (response.id + 814) +'">'+ capitalizeEachWord(response.name) +'</label></div>');
            $('#category-holder').append(newList);
        },
        complete: (result) => {
            if (result.status == 200) {
                $('#loader').fadeOut();
                $('#modalControl').modal('hide');
                Swal.fire({
                    title: "Sukses",
                    text: "Kategori baru berhasil ditambahkan.",
                    icon: "success"
                });
                $('#category-holder').animate({
                    scrollTop: $('#category-holder').height()
                }, 814);
            }
        }
    });
    */
}

function reloadCandidatesTable(event, element) {
    event.preventDefault();
    $('#candidates-filter-info').hide();
    $(element).DataTable().ajax.url('/server/candidates/fetch').load();
}

function calculateAge(date) {
    const today = new Date();
    const dateObj = new Date(date);
    const age = today.getFullYear() - dateObj.getFullYear() - (today.getMonth() < dateObj.getMonth() || (today.getMonth() === dateObj.getMonth() && today.getDate() < dateObj.getDate()));
    return age;
}

function appendToCategories(event) {
    event.preventDefault();

    let route = event.target.form.action;
    let name = event.target.form.elements.name.value;

    $.ajax({
        url: route,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: name,
        },
        beforeSend: () => {
            $('#loader').fadeIn();
        },
        success: (response) => {
            let newList = $('<div class="form-check"><input class="form-check-input" type="checkbox" checked="" name="categories[]" value="'+ (response.id) +'" id="category-'+ (response.id + 814) +'"><label class="form-check-label" for="category-'+ (response.id + 814) +'">'+ capitalizeEachWord(response.name) +'</label></div>');
            $('#category-holder').append(newList);
        },
        complete: (result) => {
            if (result.status == 200) {
                $('#loader').fadeOut();
                $('#modalControl').modal('hide');
                Swal.fire({
                    title: "Sukses",
                    text: "Kategori baru berhasil ditambahkan.",
                    icon: "success"
                });
                $('#category-holder').animate({
                    scrollTop: $('#category-holder').height()
                }, 814);
            }
        }
    });
}



// THIS-FUCNTIONS-ARE-UNUSED-YET
// ================================================================================
function uploadPrivy(event) {
    const name = event.currentTarget.dataset['name'];
    const file = event.currentTarget.previousElementSibling.files;
    const token = $("meta[name='csrf-token']").attr("content");

    if (file.length > 0) {
        swal({
            title: 'Konfirmasi',
            text: 'Unggah PRIVY.ID untuk '+name+'?',
            icon: 'info',
            buttons: {
                cancel: {
                    text: 'Batal',
                    visible: true,
                    closeModal: true
                },
                confirm: {
                    text: 'OK',
                    visible: true,
                },
            },
        }).then((confirm) => {
            event.target.form.submit();
        }).catch(swal.noop);
    } else {
        swal({
            title: 'Kesalahan',
            text: 'Mohon pilih dokumen.',
            icon: 'error',
            buttons: {
                confirm: {
                    text: 'OK',
                    visible: true
                }
            },
            timer: 1800
        })
    }
}
