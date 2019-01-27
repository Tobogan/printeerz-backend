<!-- JAVASCRIPT
    ================================================== -->

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/ajax.js') }}"></script>
<script src="{{ asset('js/js.js') }}"></script>
<!-- Libs JS -->
<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('libs/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('libs/chart.js/Chart.extension.min.js') }}"></script>
<script src="{{ asset('libs/highlightjs/highlight.pack.min.js') }}"></script>
<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
<script src="{{ asset('libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('libs/list.js/dist/list.min.js') }}"></script>
<script src="{{ asset('libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/select2/dist/js/select2.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- Theme JS -->
<script src="{{ asset('js/theme.min.js') }}"></script>
<script>
    $("#tabs").tabs({
        classes: {
            "ui-tabs-tab": "nav-item",
            "ui-tabs-active": "active"
        },
        activate: function activeTab() {
            $('.ui-tabs-tab').each(function () {
                if ($(this).hasClass('ui-tabs-active')) {
                    $(this).children().addClass('active')
                } else(
                    $(this).children().removeClass('active')
                )
            });
        }
    });
</script>