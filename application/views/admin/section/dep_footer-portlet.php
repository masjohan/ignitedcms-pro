          
                    <?php $this->load->view('admin/footer-map'); ?>
                </section>        
            </section> 
        </section>
    </section>
    <!-- /.vbox -->
  </section>
  <!-- jquery -->
  <script src="<?php echo(base_url()."resources") ?>/js/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo(base_url()."resources") ?>/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
  <!-- Bootstrap -->
  <script src="<?php echo(base_url()."resources") ?>/js/bootstrap.js" type="text/javascript"></script>
  <!-- app -->
  <script src="<?php echo(base_url()."resources") ?>/js/app.js" type="text/javascript"></script>
  <script src="<?php echo(base_url()."resources") ?>/js/app.plugin.js" type="text/javascript"></script>
  <script src="<?php echo(base_url()."resources") ?>/js/app.data.js" type="text/javascript"></script>
  <!-- fuelux -->
  <script src="<?php echo(base_url()."resources") ?>/js/fuelux/fuelux.js" type="text/javascript"></script>
  <!-- datepicker -->
  <script src="<?php echo(base_url()."resources") ?>/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <!-- combodate -->
  <script src="<?php echo(base_url()."resources") ?>/js/libs/moment.min.js" type="text/javascript"></script>
  <script src="<?php echo(base_url()."resources") ?>/js/combodate/combodate.js" type="text/javascript"></script>

  <!-- parsley -->
  <script src="<?php echo(base_url()."resources") ?>/js/parsley/parsley.min.js" type="text/javascript"></script>
  <script src="<?php echo(base_url()."resources") ?>/js/parsley/parsley.extend.js" type="text/javascript"></script>

  
  <script src="<?php echo(base_url()."resources") ?>/js/jscolor/jscolor.js" type="text/javascript"></script>
  
  <!-- wysiwyg -->
  <script src="<?php echo(base_url()."resources") ?>/js/wysiwyg/jquery.hotkeys.js" type="text/javascript"></script>
  <script src="<?php echo(base_url()."resources") ?>/js/wysiwyg/bootstrap-wysiwyg.js" type="text/javascript" ></script>
  <script src="<?php echo(base_url()."resources") ?>/js/wysiwyg/demo.js" type="text/javascript"></script>
  <!-- markdown -->

   <!-- Sortable -->
  <script src="<?php echo(base_url()."resources") ?>/js/sortable/jquery.sortable.js"></script>
  

  


 <script type="text/javascript">
   
    $(document).ready(function (event) {

     $(function() {
    $( "#sortable1, #sortable2" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  });

     $("#k").click(function (event) {
       alert('clcicked');
     });
       
    
      

     
        
    });
</script>
</body>
</html>