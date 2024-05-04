<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<?php 
 global $wpdb;
 $secondary_buyers=$wpdb->prefix ."secondary_buyers";
 $raw_materials=$wpdb->prefix ."raw_materials";
 $buyer=$wpdb->get_results("SELECT * FROM $secondary_buyers");
 $material=$wpdb->get_results("SELECT * FROM $raw_materials");
?>
<h1>Insert Material Wastage Sale</h1>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <div class="card-body">
        <div class="row">


            <input type="hidden" name="action" value="save_wastage_material">


            <div class="col-6">
                <div class="form-group">
                    <label for="">Invoice No.</label>
                    <input type="text" name="invoice" value="<?php echo rand(1, 99999999) ?>" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Material Name</label>
                    <!-- <input type="text" name="material" class="form-control"> -->
                    <select name="material" id="" class="form-control">
                        <option value="">Select Material</option>
                        <?php foreach($material as $i=>$v){?>
                        <option value="<?php echo $v->id ?>"><?php echo $v->name?></option>
                       <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Buyer Name</label>
                    <!-- <input type="text" name="buyer" class="form-control"> -->
                    <select name="buyer" id="" class="form-control">
                        <option value="">Select Buyer</option>
                        <?php foreach($buyer as $i=>$v){?>
                        <option value="<?php echo $v->id ?>"><?php echo $v->name?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="text" name="quantity" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <br> <br>
    <div class="card-footer">
        <input type="submit" value="Submit" name="submit" class="btn btn-primary"></input>
    </div>
</form>