<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <section class="content">
    <div class="box">
        <div class="box-header with-border">
        <?php echo $__env->make('admin.layouts.partials._flashmsg', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <h1 class="box-title"><?php echo app('translator')->getFromJson('admincrud.Voucher Management'); ?></h1>
          <div class="top-action">
            <a href="<?php echo route('voucher.create'); ?>" title="Add New" class="btn mb15"><i class="fa fa-plus-circle"></i><?php echo app('translator')->getFromJson('admincommon.Add New'); ?></a>
          </div>
        </div> <!--box-header-->

        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
              <thead>
              <tr>
                  <th width="20"><?php echo app('translator')->getFromJson('admincommon.S.No'); ?></th>
                  <th><?php echo app('translator')->getFromJson('admincrud.Promo Code'); ?></th>
                  <th><?php echo app('translator')->getFromJson('admincrud.Value'); ?></th>
                  <th><?php echo app('translator')->getFromJson('admincrud.Promo Code For'); ?></th>
                  <th><?php echo app('translator')->getFromJson('admincrud.App Type'); ?></th>
                  <th class="status"><?php echo app('translator')->getFromJson('admincommon.Status'); ?></th>
                  <th class="action"><?php echo app('translator')->getFromJson('admincommon.Action'); ?></th>
              </tr>
              <tr>
                <th></th>
                <th>
                    <?php echo e(Form::text("promo_code", '', ['class' => 'form-control filterText', "placeholder" =>__('admincrud.Promo Code'), "data-name" => "1"])); ?>                         
                </th>
                <th>
                    <?php echo e(Form::text("value", '', ['class' => 'form-control filterText', "placeholder" =>__('admincrud.Value'), "data-name" => "2"])); ?>                         
                </th>
                <th>
                    <?php echo e(Form::select('apply_promo_for',$model->selectApplyPromo(), '' ,['class' => 'selectpicker filterSelect', 'placeholder' => __('admincommon.All'), "data-name" => "3"] )); ?>

                </th>
                <th>
                    <?php echo e(Form::select('app_type', $model->selectAppTypes(), '' ,['class' => 'selectpicker filterSelect', 'placeholder' => __('admincommon.All'), "data-name" => "4"] )); ?>

                </th>
                <th class="status">
                    <?php echo e(Form::select('status', Common::status(), '' ,['class' => 'selectpicker filterSelect', 'placeholder' => __('admincommon.All'), "data-name" => "5"] )); ?>

                </th>
                <th class="action"></th>
                </tr> 
              </thead>
            </table>
          </div>
        </div> <!--box-body-->
    </div> <!--box-->
  </section>
</div> <!--content-wrapper-->
<?php echo $__env->make('admin.layouts.partials._tableconfig', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
$(document).ready(function(){
    window.dataTable = $('#dataTable').dataTable({
        'ajax' : "<?php echo e(route('voucher.index')); ?>",
        'columns': [
            { 'data' : 'DT_RowIndex', 'name' : 'voucher_id', 'searchable' : false},
            { 'data' : 'promo_code', 'name' : 'promo_code'},
            { 'data' : 'value','sortable' : false},
            { 'data' : 'apply_promo_for'},
            { 'data' : 'app_type','name':'app_type','sortable' : false},
            { 'data' : 'status', 'sClass' : 'status', 'orderable' : false},
            { 'data' : 'action', 'sClass' : 'action', 'orderable' : false}
        ],      
    });    
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>