<!-- Main content -->
<section class="content" style="text-align:center">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('guest.please_save_qr_code')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div id="qr-code-container">
                    {!! $finalClient->final_client_qr !!}
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success" onclick="downloadQR()">@lang('guest.submit')</button>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<!-- Your Blade template -->

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    function downloadQR() {
        const container = document.getElementById('qr-code-container');

        const now = new Date();
        const randomNum = Math.floor(Math.random() * 1000) + 1;

        html2canvas(container).then(canvas => {
            // Convert canvas to image and download
            const link = document.createElement('a');
            link.download = now + '-' + randomNum + '-qr-code.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });

        alert("تم حفظ الصورة بنجاح");
    }
</script>
