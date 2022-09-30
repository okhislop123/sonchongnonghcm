
    <script type="text/javascript" src="public/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="public/js/ajax.js"></script>
    <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/extra/select2/select2.full.js"></script>
    <script type="text/javascript" src="public/js/admin.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#check_all').change(function(){
                $('.table input:checkbox').prop('checked', this.checked);
            });
            $('#action').change(function(){
                $('#product_form').submit();
            });
            $('#search').keyup(function(e){
                if (e.which==13) {
                    $('#product_form').submit();
                }                
            });
			$('.select2').select2();
			// $("select").on("select2:close", function (e) {  
			// 	$(this).valid(); 
			// });	
        });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1, #datetimepicker2').datetimepicker({
                //format: 'DD/MM/YYYY/ h:m:s'
            });
        });
    </script>
</body>
</html>