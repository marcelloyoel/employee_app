<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Velzon.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Themesbrand
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- center modal -->
        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                        </lord-icon>
                        <div class="mt-4">
                            <h4 class="mb-3">Kamu Yakin Mau Log Out?</h4>
                            <p class="text-muted mb-4">Kalo kamu keluar, maka kamu harus log in lagi untuk melihat data - data yang ada disini.</p>
                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger" id="logOutFix">Log Out</a>
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-center" style="display:none;">
                            <span id="spinnerLoading"
                                class="spinner-border spinner-border-sm mt-15 text-black" role="status"
                                aria-hidden="true" style="width:1rem; height:1rem; display:none"></span>
                        </div>
                        <div class="mt-2" id="tulisDisini" style="display:none;"></div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</footer>
