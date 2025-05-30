<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<div class="row mt-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="ratio ratio-16x9" style="margin-bottom: -20px;">
            <iframe src="<?php echo base_url('ventas/generaTicket/' . $idVenta); ?>" title="Ticket" id="ticketIframe"></iframe>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var iframe = document.getElementById('ticketIframe');
        iframe.onload = function() {
            iframe.contentWindow.print();
        };
    });
</script>
<?php $this->endSection(); ?>