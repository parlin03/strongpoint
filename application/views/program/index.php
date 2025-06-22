   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <div class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6">
                       <h1 class="m-0 text-dark"><?= $title; ?></h1>
                   </div><!-- /.col -->
                   <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div>/.col -->
               </div><!-- /.row -->
           </div><!-- /.container-fluid -->
       </div>
       <!-- /.content-header -->

       <!-- Main content -->
       <section class="content">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-body">
                               <div class="row ">
                                   <div class="container" style="margin-top:20px">
                                       <div>
                                           <div class="panel panel-primary">
                                               <div class="panel-body">
                                                   <div id="container" style="min-width: 400px; height: 480px; margin: 0 auto"></div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <!-- /.card -->
                   </div>
                   <!-- /.col -->
               </div>
               <!-- /.row -->
           </div><!--/. container-fluid -->
       </section>
       <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

   <!-- load library jquery dan highcharts -->
   <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>
   <!-- end load library -->
   <script type="text/javascript">
       $(function() {
           var chart;
           $(document).ready(function() {
               $.getJSON("<?php echo site_url('program/jaring/Index_list'); ?>", function(json) {

                   chart0 = new Highcharts.Chart({
                       chart: {
                           renderTo: 'container',
                           type: 'column'
                       },
                       title: {
                           text: ''
                       },
                       xAxis: {
                           categories: ['Panakkukang', 'Biringkanaya', 'Manggala', 'Tamalanrea', 'unknown']
                       },
                       yAxis: {
                           title: {
                               text: 'Total DPT'
                           }
                       },
                       labels: {
                           items: [{
                               html: '',
                               style: {
                                   left: '50px',
                                   top: '18px',
                                   color: ( // theme
                                       Highcharts.defaultOptions.title.style &&
                                       Highcharts.defaultOptions.title.style.color
                                   ) || 'black'
                               }
                           }]
                       },
                       plotOptions: {
                           column: {
                               // stacking: 'percen',
                               dataLabels: {
                                   enabled: true,
                                   crop: false,
                                   overflow: 'none'
                               }
                           }
                       },





                       series: json
                   });;
               });

           });

       });
   </script>