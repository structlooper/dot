<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data table</h4>
            

            <div class="row">
                <div class="col-12">
                    <?php if ($this->session->flashdata()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('demo'); ?>
                            <?php echo $this->session->flashdata('cancel'); ?>
                            <?php echo $this->session->flashdata('hapus'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Driver</th>
                                    <th>Service</th>
                                    <th>Pick Up</th>
                                    <th>Destination</th>
                                    <th>Price</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Assign Driver</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; 
                                foreach ($transaksi as $tr) {  ?>

                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $tr['fullnama'] ?> </td>
                                        <td><?= $tr['nama_driver'] ?></td>
                                        <td><?= $tr['fitur'] ?></td>
                                        <td style="max-width:300px;"><?= $tr['alamat_asal'] ?></td>
                                        <td style="max-width:300px;"><?= $tr['alamat_tujuan'] ?></td>
                                        <td><?= $currency['app_currency'] ?>
                                            <?= number_format($tr['biaya_akhir'] / 100, 2, ".", ".") ?></td>
                                        <td>
                                            <?php if ($tr['pakai_wallet'] == '0') {
                                                echo 'CASH';
                                            } else {
                                                echo 'WALLET';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($tr['status'] == '2') { ?>
                                                <label class="badge badge-primary"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                            <?php if ($tr['status'] == '3') { ?>
                                                <label class="badge badge-success"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                            <?php if ($tr['status'] == '5') { ?>
                                                <label class="badge badge-danger"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                            <?php if ($tr['status'] == '4') { ?>
                                                <label class="badge badge-info"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                            <?php if ($tr['status'] == '1') { ?>
                                                <label class="badge badge-info">Requested</label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($tr['status'] == '1' and $tr['status'] != '2' and $tr['status'] != '3' and $tr['status'] != '4') { ?>
                                            <button type="button" class="btn btn-primary btn-lg" onclick="functionAssign(<?= $tr['order_fitur']; ?>,<?= $tr['start_latitude']; ?>,<?= $tr['start_longitude']; ?>,<?= $tr['id_transaksi']; ?>);">Assign</button>
                                            <?php } ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>dashboard/detail/<?= $tr['id_transaksi']; ?>" class="btn btn-outline-primary">View</a>
                                            <a onclick="return confirm ('Are You Sure?')" href="<?= base_url(); ?>dashboard/delete/<?= $tr['id_transaksi']; ?>" class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                        <script>
                            function functionAssign(service_id,start_lat,start_lng,id_tans){
                                // alert('function called '+start_lng);
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>api/pelanggan/list_ride",
        dataType: "json",
        data: JSON.stringify({ 'fitur':service_id , 'latitude':start_lat ,'longitude':start_lng ,'_token':'{{ csrf_token() }}' }),
        
        success: function(result) {
            console.log(result.data)
            if(result.data.length > 0){
                $('#modal_body').html(`
                <form action="#" id="assignForm">
          <div class="form-group">
              <h6>Select driver</h6>
          </div>
          <div class="form-group">
              <select class="form-control" id="d_id">
              
              </select>
          </div>
          <div class="form-group text-right">
             <button class="btn btn-sm btn-success" type="button" onclick="functionAssnDeliveryBoy(${id_tans})" id="load_${id_tans}" >Assign</button>
          </div>
          </form>`
                
                ) 
            $.each(result.data, function( index, value ) {
              console.log( index + ": " + value.nama_driver );
                $('#d_id').append(`
               <option value="${value.id}" req="${value.reg_id}" >${value.nama_driver}</option>
            `
                
                )
            });
            }else{
                $('#modal_body').html(`        <p>Sorry!! no driver found in this area</p>
`)
            }
        },
        error: function(jqXHR) {
            console.log(jqXHR.responseText);
            alert('whoops some thing went wrong')
        }
    })
                                $('#myModalToassign').modal('show')
                            }
                            
                            
    function functionAssnDeliveryBoy(id){
        let req = $('option:selected', '#d_id').attr('req');
        // alert(req);
        $('#load_'+id).html('loding..');
        let driver_id = $('#d_id').val();
        // alert(driver_id);
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>api/driver/accept",
        dataType: "json",
        data: JSON.stringify({ 'id':driver_id , 'id_transaksi':id ,'_token':'{{ csrf_token() }}' }),
        
        success: function(result) {
            console.log(result)
            if(result.data == 'berhasil'){
                alert('driver assined successfully')
          
    $.ajax({        
            type : 'POST',
            url : "https://fcm.googleapis.com/fcm/send",
            headers : {
                Authorization : 'key=AAAAr_024qM:APA91bFkD6-AqtvbvTZ-9H8jtLSwSLnakSfbW8Vqcm_Yz2KXCEC8CADqBJefAHIsHIvuouDrEkrH7oRYZqpGqp4Lqe_WjuwzRaiz5ibiQ8fE3untIUiZnbBapTmc-MEqY5yK9z05ll4N'
            },
            contentType : 'application/json',
            dataType: 'json',
            data: JSON.stringify({"to": req, "notification": {"title":"New order arrived","body":"Order assined to you"}}),
            success : function(response) {
                console.log(req)
                console.log(response);
            },
            error : function(xhr, status, error) {
                console.log(xhr.error);   
                alert('some thing went wrong')
            }
        });
            }else{
                alert(result.message)
            }
          setTimeout(function(){
                window.location.reload(); 
            },2000); 
                
             
        },
        error: function(jqXHR) {
            console.log(jqXHR.responseText);
            alert('whoops some thing went wrong')
            $('#load_'+id).html('Assign');
        }
    })
        
    }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="myModalToassign">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assign Driver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-white" id="modal_body">
          <h4>Please wait!!</h4>
      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>