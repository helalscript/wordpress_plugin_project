<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
</script>

<?php
global $wpdb;
$p_table = $wpdb->prefix . "purchase";
$r_table = $wpdb->prefix . "raw_materials";
$s_table = $wpdb->prefix . "suppliers";
$home_url= esc_url(admin_url('admin.php?page='));

$materials = $wpdb->get_results("select * from $r_table");
$supplier = $wpdb->get_results("select * from $s_table");
date_default_timezone_set('Asia/Dhaka');
$lenError = $qErr = $pErr = "";

function generateInvoiceId()
{
  // Base ID with timestamp and extra entropy (slightly shorter)
  $baseId = mt_rand(100000000, 999999999) . time() % 10;
  // Append a unique number to still maintain good randomness
  $uniqueNumber = mt_rand(0, 9); // Random digit
  $uniqueId = $baseId . $uniqueNumber;
  // Truncate to 10 digits consistently
  $uniqueId = substr($uniqueId, 0, 9);
  return $uniqueId;
}
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
           
          </ol>
        </div>
      </div>
      <div>
        <div class="card-primary">
          <div class="card-header " style="background-color:#563d7c">
            <h3 class="card-title text-light">Add Purchase</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
              <form id="purchase_form" onsubmit="return validate()" action="<?php echo esc_url(admin_url('admin-post.php')); ?> " method="post"
                enctype="multipart/form-data" required>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Invoice ID</label><span style="color: red;">
                          <?php echo "  " . $lenError; ?>
                        </span>
                        <input type="hidden" name="action" value="save_purchase">
                        <input readonly value="<?php echo generateInvoiceId() ?>" type="text" name="inid"
                          class="form-control" id="inv" placeholder="Enter title">
                        <span id="invoice_error"></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date</label>
                        <input value="<?php echo date('Y-m-d\TH:i:s'); ?>" type="datetime-local" name="date"
                          class="form-control" id="exampleInputEmail1" placeholder="Enter title">
                      </div> 
                    </div>
                  </div>
                  <div class="row">
                    <table class="container-fluid table  table-striped">
                      <thead class="bg-success text-light text-center">
                        <tr>
                          <th class="col-3">Materials</th>
                          <th class="col-3">Supplier</th>
                          <th class="col-3">Quantity</th>
                          <th class="col-2">Price</th>
                          <th class="col-1"></th>
                        </tr>
                      </thead>
                      <tbody id="purchase">
                        <tr>
                          <td>
                            <div class="form-group">
                              <select onblur="errchk('price1')" name="material[]" id="material1"
                                onchange="getprice((this.value),1), errchk('material1'), errchk('price1');"
                                class="form-control">
                                <option value="xxx">Select Material</option>
                                <?php foreach ($materials as $d) { ?>
                                  <option value="<?php echo $d->id ?>">
                                    <?php echo $d->name . " (" . $d->price . " Taka)" ?>
                                    </option>
                                <?php } ?>
                              </select>
                              <span id="material_error1"></span>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <select name="supplier[]" id="supplier1" class="form-control"
                                onchange="errchk('supplier1'), errchk('price1')">
                                <option value="xxx">Select Supplier</option>
                                <?php foreach ($supplier as $d) { ?>
                                  <option value="<?php echo $d->id ?>">
                                    <?php echo $d->company_name ?>
                                  </option>
                                <?php } ?>
                              </select>
                              <span id="supplier_error1"></span>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <input onblur="errchk('price1')" type="text" name="quantity[]"
                                onkeyup="getp2(1), errchk('quantity1'), errchk('price1')" class="form-control"
                                id="quantity1" placeholder="Enter quantity">
                              <span id="quantity_error1"></span>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <input type="text" name="price[]" onkeyup="errchk('price1')" class="form-control" id="price1"
                                placeholder="Enter title"><span id="price_error1"></span>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <!-- <button type="button" class="btn btn-danger delete-row">Delete</button> -->
                            </div>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>
                            <a href="#" onclick="addmore()" class="btn btn-primary">Add More</a>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
    </div>
    <!-- /.content-wrapper -->



    <script>
      let sl = 2;

      function addmore() {
        $(document).ready(function () {
          $('#purchase').on('click', '.delete-row', function () {
            $(this).closest('tr').remove();
          });
        });
        let newRow = `
                          <tr>
                            <td>
                              <div class="form-group">
                                <select onblur="errchk('price${sl}')" name="material[]" id="material${sl}" class="form-control" onchange="getprice(this.value, ${sl}), errchk('material${sl}'), errchk('price${sl}')">
                                  <option value="xxx">Select Material</option>
                                  <?php foreach ($materials as $d) { ?>
                                      <option value="<?php echo $d->id ?>"><?php echo $d->name . " " . $d->price . " Taka" ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <select onblur="errchk('price${sl}')" name="supplier[]" id="supplier${sl}" class="form-control" onchange="errchk('supplier${sl}'), errchk('price${sl}')">
                                  <option value="xxx">Select Supplier</option>
                                  <?php foreach ($supplier as $d) { ?>
                                      <option value="<?php echo $d->id ?>"><?php echo $d->company_name ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input onblur="errchk('price${sl}')" type="text" name="quantity[]" id="quantity${sl}" class="form-control" placeholder="Enter title" onkeyup="getp2(${sl}), errchk('quantity${sl}'), errchk('price${sl}')">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="text" name="price[]" id="price${sl}" class="form-control" placeholder="Enter title" onkeyup="errchk('price${sl}')">
                              </div>
                            </td>
                            <td>
                            <div class="form-group">
                              <button type="button" class="btn btn-danger delete-row">Delete</button>
                            </div>
                          </td>
                          </tr>
                        `;
        $("#purchase").append(newRow);
        sl++;
      }




      // ... your existing functions ...
      
  function getprice(id, eid) {
    if (id != "xxx") {
      $.get("<?php echo home_url( '/' ) ?>" + "wp-json/purchase_api/purchase/" + id)
        .done(function(data) {
          console.log(data);
          let p = parseFloat(data["price"]);
          let q = $("#quantity" + eid).val();
          console.log(id) +'here id';
          if (!isNaN(q)) {
            let price = p * q;
            $("#price" + eid).val(price);
          }
          console.log(p);
        })
        .fail(function(error) {
          console.error("Error fetching data:", error);
        });
    }
  }

  function getp2(f) {
    let x = $("#material" + f).val();
    if (x != "xxx") {
      $.get("<?php echo home_url( '/' ) ?>" + "wp-json/purchase_api/purchase/" + x)
        .done(function(data) {
          let p = parseFloat(data["price"]);
          let q = $("#quantity" + f).val();

          if (!isNaN(q)) {
            let price = p * q;
            $("#price" + f).val(price);
            console.log(p, q, price);
          }
        })
        .fail(function(error) {
          console.error("Error fetching data:", error);
        });
    }
  }


    </script>