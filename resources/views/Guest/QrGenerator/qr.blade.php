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

                <!-- Normal QR Code Display -->
                <div id="qr-code-display">
                    {!! $finalClient->final_client_qr !!}
                </div>

                <div class="box-footer">
                    <button type="button" class="btn btn-success" onclick="downloadQR()">
                        @lang('guest.download_qr_code')
                    </button>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadQR() {
        // Create a temporary container for download
        const tempContainer = document.createElement('div');
        tempContainer.style.width = '800px';
        tempContainer.style.height = '650px';
        tempContainer.style.backgroundColor = 'white';
        tempContainer.style.display = 'flex';
        tempContainer.style.alignItems = 'center';
        tempContainer.style.justifyContent = 'center';
        tempContainer.style.position = 'fixed';
        tempContainer.style.left = '-9999px';

        // Create QR code container with specific size
        const qrContainer = document.createElement('div');
        qrContainer.style.width = '570px';
        qrContainer.style.height = '570px';
        qrContainer.innerHTML = document.getElementById('qr-code-display').innerHTML;

        // Scale the SVG
        const svg = qrContainer.querySelector('svg');
        if (svg) {
            svg.style.width = '100%';
            svg.style.height = '100%';
        }

        // Build the structure
        tempContainer.appendChild(qrContainer);
        document.body.appendChild(tempContainer);

        // Capture and download
        html2canvas(tempContainer, {
            scale: 2,
            logging: false,
            useCORS: true,
            width: 800,
            height: 650,
            scrollX: 0,
            scrollY: 0
        }).then(canvas => {
            const link = document.createElement('a');
            const timestamp = new Date().toISOString().replace(/[:.]/g, '-');
            link.download = `qr-code-${timestamp}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();

            // Clean up
            document.body.removeChild(tempContainer);

            alert("@lang('guest.qr_code_downloaded')");
        }).catch(err => {
            console.error('Error:', err);
            document.body.removeChild(tempContainer);
            alert("@lang('guest.download_error')");
        });
    }
</script>
