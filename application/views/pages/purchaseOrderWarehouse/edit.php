<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Purchase Order # <label class="text-danger"><?=$data->vendor_name?> - <?=$data->vendor_pic_name?> / <?=$data->quotation_number?></label></h2>
            <a href="<?=site_url('requestForQuotationVendor/index')?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <form id="form-po" method="post" class="form-horizontal form-label-left">
               <?php if(isset($quotation_vendor_id)): ?>
               <input type="hidden" name="PO[quotation_vendor_id]" value="<?=$quotation_vendor_id?>">
               <?php endif;?>
               <?php if(isset($pr_id)): ?>
               <input type="hidden" name="PO[pr_id]" value="<?=$pr_id?>">
               <?php endif;?>
               <?php if(isset($rfq_id)): ?>
               <input type="hidden" name="PO[rfq_id]" value="<?=$rfq_id?>">
               <input type="hidden" name="PO[pr_id]" value="<?=$data->pr_id?>">

               <?php endif;?>
               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Company</label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                     <input type="text" readonly class="form-control" value="<?=$data->company_name?>">
                     <input type="hidden" name="PO[company_id]" value="<?=$data->company_id?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">PO Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                     <input type="text" readonly class="form-control" name="PO[po_number]" value="<?=$data_po['po_number']?>">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Quotation Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                     <input type="text" readonly class="form-control" value="<?=$data->quotation_number?>">
                  </div>
               </div>
               <input type="hidden" name="PO[vendor_id]" value="<?=$data->vendor_id?>">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doc_date">Doc. Date <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="doc_date" required name="PO[doc_date]" value="<?=isset($data_po['doc_date']) ? $data_po['doc_date'] : '' ?>"  class="form-control col-md-7 col-xs-12 tanggal">
                  </div>
               </div>
               <?php if(isset($data->rfq_number)):?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">RFQ Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly class="form-control" value="<?=$data->rfq_number?>">
                  </div>
               </div>
               <?php endif; ?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Document Title</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly value="<?=$data->document_title?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Solicitation Type<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select  disabled class="form-control">
                        <?php 
                           $solicatation = SOLICITATION___TYPE;                           
                           foreach ($solicatation as $key => $value) {
                              $selected = "";
                              if(isset($data->solicatation_type) AND  $data->solicatation_type == $key)
                                 $selected="selected";

                              echo "<option ".$selected." value='".$key."'>".$value."</option>";
                           }
                        ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Currency<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select disabled class="form-control">
                        <?php 
                           $currency = CURRENCY;
                           
                           foreach ($currency as $key => $value) {
                              $selected = "";
                              if(isset($data->currency) AND  $data->currency == $key)
                                 $selected="selected";

                              echo "<option ".$selected." value='".$key."'>".$value."</option>";
                           }
                        ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Date</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control tanggal" readonly value="<?=isset($data->delivery_date) ? $data->delivery_date : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Expiration Date and Time</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" id="expired_date" readonly value="<?=isset($data->expired_date) ? $data->expired_date : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Address</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" readonly name="PO[address]"><?=isset($data->detail_delivery_address) ? $data->detail_delivery_address : '';?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" name="PO[term_day]" readonly value="<?=isset($data->term_day) ? $data->term_day : '';?>" style="width: 150px; float: left; margin-right: 10px;">
                     <label style="margin-top:8px;">After Invoice Received</label>
                  </div>
               </div>   
               <table align="center" class="table" style="margin:auto; width: 50%" >
                  <tbody id="term_body">
                     <?php if(isset($term)): ?>
                        <?php foreach($term as $item): ?>
                           <tr>
                              <td><input type="text" name="term[]" class="form-control" readonly placeholder="Term" value="<?=$item->term?>"></td>
                              <td><input type="text" name="cond[]" class="form-control" readonly placeholder="Condition" value="<?=$item->cond?>"></td>
                              <td style="text-align: right;"></td>
                           </tr>
                        <?php endforeach; ?>
                     <?php endif; ?>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td colspan="3" style="text-align: right;"><a style="cursor: pointer;" class="btn btn-primary btn-xs" id="add_term"><i class="fa fa-plus"></i> Add</a></td>
                     </tr>
                  </tfoot>
               </table>
               <div class="x_panel">
                  <div class="col-md-12">
                     <div class="x_content">
                        <h2>Material</h2>
                        <table class="table table-bordered">
                           <thead>
                             <tr>
                               <th style="width: 50px;">No</th>
                               <th>Item</th>
                               <th>QTY</th>
                               <th>Price List</th>
                               <th>Discount (%)</th>
                               <th>Price</th>
                             </tr>
                           </thead>
                           <tbody class="add-table-rfq-request">
                              <?php 
                                $vat = 0;
                                 if(isset($material) AND count($material) > 0)
                                 {
                                    $sub_total = 0;
                                    foreach ($material as $key => $item)
                                    { 
                                       echo '<tr>';
                                       echo '<td>'. ($key+1) .'</td>';
                                       echo '<td>'. $item->material .'</td>';
                                       echo '<td>'. $item->qty .'</td>';
                                       echo '<td>'. format_idr($item->price) .'</td>';
                                       echo '<td>'. $item->discount .'</td>';

                                       $discount = 0;
                                       if(!empty($item->discount))
                                       {
                                          $discount = $item->discount * $item->price / 100; 
                                       }

                                       $price = ($item->price - $discount) * $item->qty;

                                       echo '<td class="sub_total">'. format_idr($price) .'</td>';
                                       echo '</tr>';

                                       echo '<input type="hidden" name="Material['. $key .'][material_id]" value="'. $item->material_id .'" />';
                                       echo '<input type="hidden" name="Material['. $key .'][qty]" value="'. $item->qty .'" />';
                                       echo '<input type="hidden" name="Material['. $key .'][price]" value="'. $item->price .'" />';
                                       echo '<input type="hidden" name="Material['. $key .'][discount]" value="'. $item->discount .'" />';

                                       $sub_total += $price;
                                    }    
                                 }
                              ?>
                           </tbody>
                           <tfoot style="background: #fbfbfb;">
                              <tr>
                                 <th colspan="5" style="text-align: right;vertical-align: middle;">Sub Total</th>
                                 <td><?=format_idr($sub_total)?></td>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;vertical-align: middle;">
                                    <?=$data->vat_type == 1 ? 'PPH' : 'PPN'?>
                                 </th>
                                 <td>
                                    <?php $vat_idr = $sub_total * $data->vat / 100; ?>
                                    <?=$data->vat?>% (Rp <?=format_idr($vat_idr)?>)
                                 </td>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;vertical-align: middle;">Shipping Charge</th>
                                 <td><?=format_idr($data->shipping_charge)?></td>
                              </tr>
                              <tr>
                                 <td colspan="5" style="text-align: right;vertical-align: middle;">
                                    <b>Total</b>
                                 </td>
                                <td id="total"><?=format_idr($sub_total + $vat_idr - $discount_rp + $data->shipping_charge)?></td>
                              </tr>
                          </tfoot>
                        </table>
                        <input type="hidden" name="sub_total" value="<?=$sub_total?>">
                        <input type="hidden" name="PO[vat]" value="<?=$data->vat?>">
                        <input type="hidden" name="PO[shipping_charge]" value="<?=$data->shipping_charge?>">
                        <input type="hidden" name="total" value="<?=$sub_total + $vat_idr - $discount_rp + $data->shipping_charge?>">
                     </div>
                  </div>
               </div>
                <div class="form-group">
                  <div>
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                     <a class="btn btn-success btn-sm" onclick="_confirm_submit('Submit Purchase Order <?=$data->quotation_number?>', $('#form-po'))"><i class="fa fa-paper-plane"></i> Submit Purchase Order</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>