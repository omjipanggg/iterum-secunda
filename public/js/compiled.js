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
                theme: 'bootstrap-5',
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
                theme: 'bootstrap-5',
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
                search: "",
                searchPlaceholder: "Pencarian",
                emptyTable: "Data tidak ditemukan"
            }
        });
        // $('.dataTables_length select').addClass('mb-2');
        // $('.dataTables_filter').addClass('mb-2');
    }

    // DELETE-FUNCTIONALITY
    // ================================================================================
    $('.btn-delete').click(function(event) {
        event.preventDefault();
        let form = $('#delete-form');
        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#delete-form').attr('action', '/user/' + id);

        Swal.fire({
            title: name,
            text: "Hapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form[0].submit();
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

            modalControl.querySelector('.modal-title').textContent = table + '   ·   ' + type;

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