<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<?php
global $wpdb;
$table = $wpdb->prefix . "material_wastage_sale";
$secondary_buyers = $wpdb->prefix . "secondary_buyers";
$raw_materials = $wpdb->prefix . "raw_materials";
$buyer = $wpdb->get_results("SELECT * FROM $secondary_buyers");
$material = $wpdb->get_results("SELECT * FROM $raw_materials");
$data = $wpdb->get_row("select * from $table where id=" . $_GET['id']);
?>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <div class="card-body">
        <div class="row">

            <input type="hidden" name="id" value="<?php echo $data->id ?>">


            <input type="hidden" name="action" value="update_wastage_material">


            <div class="col-6">
                <div class="form-group">
                    <label for="">Invoice No.</label>
                    <input type="text" name="invoice" class="form-control" value="<?php echo $data->invoice_id ?>">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Material's Name</label>
                    <select name="material" id="" class="form-control">
                        <option value="">Select Material</option>
                        <?php foreach ($material as $i => $v) { ?>
                            <option value="<?php echo $v->id ?>" <?php if ($v->id == $data->material_id) {
                                                                echo "selected";
                                                            } ?>><?php echo $v->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Buyer's Name</label>
                    <select name="buyer" id="" class="form-control">
                        <option value="">Select Buyer</option>
                        <?php foreach ($buyer as $i => $v) { ?>
                            <option value="<?php echo $v->id ?>" <?php if ($v->id == $data->buyer_id) {
                                                                echo "selected";
                                                            } ?>><?php echo $v->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="text" name="quantity" class="form-control" value="<?php echo $data->quantity ?>">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo $data->date ?>">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card-footer">
        <input type="submit" value="Update" name="update" class="btn btn-primary"></input>
    </div>
</form>