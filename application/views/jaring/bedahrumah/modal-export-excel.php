<!-- Modal Export Excel -->
<div id="modalExport" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="<?= site_url('bpumbase/export_excel') ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export to Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Filter -->
                    <select id="filter" name="filter" class="form-control">
                        <option value="0">All Data</option>
                        <option value="1">Sekolah</option>
                    </select>

                    <!-- Date -->
                    <select id="filter-sekolah" name="filter-sekolah" class="form-control mt-3 d-none">
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="SMKS">SMKS</option>
                    </select>
                    <!-- <input id="filter-kec" name="text" value="panakukkang" class="form-control mt-3 d-none" type="text"> -->

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toggle Date Filter -->
<script>
    $(document).on('change', '#filter', function(e) {
        var optionSelected = $(this).find("option:selected");
        var valueSelected = optionSelected.val();
        var textSelected = optionSelected.text();

        if (valueSelected == 1) {
            $('#filter-sekolah').removeClass('d-none');
        } else {
            $('#filter-sekolah').addClass('d-none');
        }
    });
</script>