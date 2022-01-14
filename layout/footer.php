<?php if(isset($_SESSION['username']) & $_SESSION['username'] === $config['username']){ ?> 
      <div class="modal inmodal" id="addVND" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                       <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Cộng tiền cho thành viên</h5>
                    </div>
                    <div class="ibox-content">
                <div class="form-group">
                  <input type="text"
                    class="form-control" id="un" placeholder="Tên đang nhập">
                </div>
                <div class="form-group">
                  <input type="text"
                    class="form-control" id="vnd" placeholder="Số tiền cần cộng">
                </div>
                <div class="form-group text-center">
                  <button type="button" class="btn btn-primary" id="admin_vnd">Cộng ngay</button>
                  <button type="button" class="btn btn-white" data-dismiss="modal">Đóng</button>
                </div> 
                    </div>
                </div>
                                    </div>
                                </div>
                            </div>
<script>
  $(function(){
    $('#admin_vnd').click(function(){
        var un = $('#un').val();
        var vnd = $('#vnd').val();
        if(!un || !vnd){
         alert('Vui lòng nhập đủ thông tin'); 
         return;
        }else{
          $.ajax({
            type: "POST",
            url: "../admin/api.html",
            data: {type:'admin_vnd',un,vnd},
            dataType: "text",
            success: function (response) {
              $('#ketqua').html(response);
            }
          });
        }
    });
  });
</script>
    <?php } ?>
   <?php if($_SESSION['username']){
    ?>
                </div>

</div>
<div class="footer">
    <div class="float-right">
      
    </div>
    <div>
       <center> <strong><?= $config['domain']; ?> &copy; 2020</strong>
  </center>
    </div>
</div>

</div>
</div>
<div id="ketqua"></div>
    <script src="/asset/js/plugins/dataTables/datatables.min.js"></script>
    <script src="/asset/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                ],
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                "language": {
		            "search": "Tìm Kiếm",
                    "zeroRecords": "Không tìm thấy kết quả",
		            "paginate": {
		                "first": "Về Đầu",
		                "last": "Về Cuối",
		                "next": "Tiến",
		                "previous": "Lùi"
		            },
		            "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
		            "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
		            "lengthMenu": "Hiển thị _MENU_ mục",
                    "infoFiltered": "(Được lọc từ _MAX_ Mục)",
		            "loadingRecords": "Đang tải...",
		            "emptyTable": "Không có gì để hiển thị"
		        }
            });

        });
        function wait(id, status, text = null) {
    if (!status) {
        return $(id).prop('disabled', true).html("<i class=\"fa fa-spinner fa-spin\"></i> Đang Xử Lý");
    } else {
        return $(id).prop('disabled', false).html(text);
    }
}
    </script>
    <?php
    }
    ?>
    <script src="/asset/js/popper.min.js"></script>
    <script src="/asset/js/bootstrap.js"></script>
    <script src="/asset/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/asset/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/asset/js/inspinia.js"></script>
    <script src="/asset/js/plugins/pace/pace.min.js"></script>

    <!-- Flot -->
    <script src="/asset/js/plugins/flot/jquery.flot.js"></script>
    <script src="/asset/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/asset/js/plugins/flot/jquery.flot.resize.js"></script>

    <!-- ChartJS-->
    <script src="/asset/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Peity -->
    <script src="/asset/js/plugins/peity/jquery.peity.min.js"></script>
    <!-- Peity demo -->
    <script src="/asset/js/demo/peity-demo.js"></script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</body>

</html>
