<?php
//session_start();
include "include/header.php";
$url = $URL . "Members_Payment/Installment_PaymentRead.php";
//$url = $URL . "plot/site_name_update";
$token=$_SESSION['token'];
$PurchaseInvoiceId=$_GET['PurchaseInvoiceId'];

$data = array( "PurchaseInvoiceId" =>$PurchaseInvoiceId);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
?>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
   <div class="col-md-12">
      <div class="invoice">
         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5">
            <i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
          <img src="image/logo.png" width="120" height="60"> <?php echo $CLIENT_NAME ?>  <div class="invoice-date">
               <small>Company Reg.</small>
               <small><?php echo $COMPANY_REG_NUM ?></small>
             </div> 
         </div>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
         <div class="invoice-header">
            <div class="invoice-from">
               <strong class="text-inverse">Company Detail</strong>
               <address class="m-t-5 m-b-5">
                  <?php echo $CLIENT_NAME ?><br>
                 <?php echo $ADDRESS?>
               </address>
            </div>
            <?php 
								     
                              foreach($result as $key => $value){
                              foreach($value as $key1 => $value1)
                               {
                            ?>
        
            <div class="invoice-to">
               <strong class="text-inverse">Customer Detial</strong>
               <address class="m-t-5 m-b-5">
                  <table>
                     <tr><td><small>Customer Id: </small></td><td><?php echo $value1->MemberId;?></td></tr>
                     <tr><td><small>Name: </td><td><?php echo ucfirst($value1->MemberName);?></td></tr>
                     <tr> <td><small>Father's Name: <small></td><td> <?php echo ucfirst($value1->FatherName);?><br></td></tr>
                     <tr> <td><small>Address: <small></td><td> <?php echo ucfirst($value1->MemberAddress);?><br></td></tr>
                     <tr> <td><small>Contact No: <small></td> <td> <?php echo $value1->MemberPhone;?> <br></td></tr>
                     <tr> <td><small>Agent Id: <small></td><td> <?php echo $value1->UserId;?><br></td></tr>
                     <tr> <td><small>Agent Name: <small></td><td> <?php echo ucfirst($value1->UserName);?><br></td></tr>
                  </table>
               </address>
            </div>
            <div class="invoice-to">
               <strong class="text-inverse">Plot Detail</strong>
               <address class="m-t-5 m-b-5">
                  <table>
                     <tr><td><small>Site Name :</small></td><td><?php echo ucfirst($value1->SiteName);?></td></tr>
                     <tr><td><small>Section/Plot No :</td><td> <?php echo ucfirst($value1->SiteSection);?>/<?php echo ucfirst($value1->PlotNo);?></small></td></tr>
                     <tr> <td><small>Area(sq.ft) : <small></td><td> <?php echo ucfirst($value1->SitePurchaseDepth);?> × <?php echo ucfirst($value1->SitePurchaseWidth);?> = <?php echo $value1->SitePurchaseDepth*$value1->SitePurchaseWidth; ?><br></td></tr>
                  </table>
               </address>
            </div>
            
           
       
            <div class="invoice-date">
               <strong class="text-inverse">Installment Invoice / Detail</strong>
               <div class="date text-inverse m-t-5">Invoice Date:<?php echo $time = date("d/m/Y h:i:s",$value1->PurchasedOn)?></div>
               <div class="date text-inverse m-t-5">Invoice Number: <?php echo $value1->PurchaseInvoiceId; ?></div>
               <div class="date text-inverse m-t-5">Receipt Number: <?php echo $value1->ReceiptNo; ?></div>
             </div>
           
             <?php
                               }
                            } 
            
            ?>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="table table-sm table-invoice">
                  <thead>
                     <tr>
                        <th>Sr No</th>
                        <th>Particular</th>
                        <th class="text-right" width="50%">Amount</th>

                     </tr>
                  </thead>
                  <tbody>
                  <?php 
								     
                      foreach($result as $key => $value){
                      foreach($value as $key1 => $value1)
                       {
                    ?>

                   <tr>
                   <td>
                           <span class="text-inverse">1.</span><br>
                          </td>
                        <td>
                           <span class="text-inverse">Plot Value</span><br>
                          </td>
                        <td class="text-right"><i class="fa fa-rupee text-muted" style="font-size:12px;"></i> <?php echo $value1->SiteTotalAmount?></td>
                   </tr>
                   <tr>
                     
                   <td>
                           <span class="text-inverse">2</span><br>
                          </td>
                        <td>
                           <span class="text-inverse">Corner/Perfecting Charges(<?php echo $value1->SitePurchaseCorner ?>%)</span><br>
                          </td>
                        <td class="text-right"><i class="fa fa-rupee text-muted" style="font-size:12px;"></i> <?php echo (($value1->SiteTotalAmount*$value1->SitePurchaseCorner)/100) ?></td>
                   </tr>
                   <tr>
                     
                     <td>
                             <span class="text-inverse">3</span><br>
                            </td>
                          <td>
                             <span class="text-inverse">Total Plot Value</span><br>
                            </td>
                          <td class="text-right"><i class="fa fa-rupee text-muted" style="font-size:12px;"></i> <?php echo $value1->SitePurchaseAmount + $value1->SitePurchaseDiscount ?></td>
                     </tr>
                   <tr>
                     
                     <td>
                             <span class="text-inverse">4</span><br>
                            </td>
                          <td>
                             <span class="text-inverse">Discount</span><br>
                            </td>
                          <td class="text-right"><i class="fa fa-rupee text-muted" style="font-size:12px;"></i> <?php echo $value1->SitePurchaseDiscount ?></td>
                     </tr>
                  
                  
                   <tr>
                     
                   <td>
                           <span class="text-inverse">5</span><br>
                          </td>
                        <td>
                           <span class="text-inverse">Payment Mode</span><br>
                          </td>
                        <td class="text-right"><i class="fa fa-credit-card"> </i> <?php echo strtoupper($value1->PurchaseModeName)?></td>
                   </tr>
                   <tr>
                     
                   <td>
                           <span class="text-inverse">6</span><br>
                          </td>
                        <td>
                           <span class="text-inverse">Current Payment</span><br>
                          </td>
                        <td class="text-right"><i class="fa fa-rupee text-muted" style="font-size:12px;"></i><?php echo $value1->TotalCommission; ?></td>
                   </tr>
                   <tr>
                     
                   <td>
                           <span class="text-inverse">7</span><br>
                          </td>
                        <td>
                           <span class="text-inverse">Current Payment in Words</span><br>
                          </td>
                          <?php 
                           $number=$value1->TotalCommission;
                           $no = floor($number);
                           $point = round($number - $no, 2) * 100;
                           $hundred = null;
                           $digits_1 = strlen($no);
                           $i = 0;
                           $str = array();
                           $words = array('0' => '', '1' => 'One', '2' => 'Two',
                           '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                           '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                           '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                           '13' => 'Thirteen', '14' => 'Fourteen',
                           '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                           '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
                           '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
                           '60' => 'Sixty', '70' => 'Seventy',
                           '80' => 'Eighty', '90' => 'Ninety');
                          $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                          while ($i < $digits_1) {
                            $divider = ($i == 2) ? 10 : 100;
                            $number = floor($no % $divider);
                            $no = floor($no / $divider);
                            $i += ($divider == 10) ? 1 : 2;
                            if ($number) {
                               $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                               $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                               $str [] = ($number < 21) ? $words[$number] .
                                   " " . $digits[$counter] . $plural . " " . $hundred
                                   :
                                   $words[floor($number / 10) * 10]
                                   . " " . $words[$number % 10] . " "
                                   . $digits[$counter] . $plural . " " . $hundred;
                            } else $str[] = null;
                         }
                         $str = array_reverse($str);
                         $result = implode('', $str);
                         $points = ($point) ?
                           "." . $words[$point / 10] . " " . 
                                 $words[$point = $point % 10] : '';
                        
                          ?>
                        <td class="text-right"><i class=""></i><?php  echo $result . "Rupees Only " ;  ?></td>
                   </tr>
                   <tr>
                     
                   <td>
                           <span class="text-inverse">8</span><br>
                          </td>
                        <td>
                           <span class="text-inverse">Outstanding Amount</span><br>
                          </td>
                        <td class="text-right">  <i class="fa fa-rupee text-muted" style="font-size:12px;"></i> <?php echo $value1->SitePurchaseAmount- $value1->PurchaseAmountPaid; ?></td>
                   </tr>
                   <?php
                     }
                    }
                   
                   ?> 
                  </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->
            <div class="invoice-price">
               <div class="invoice-price-left">
                  <div class="invoice-price-row">
                     <div class="sub-price">
                        <small>SUBTOTAL</small>
                        <i class="fa fa-rupee text-muted" style="font-size:16px;"></i> <span class="text-inverse"><?php echo $value1->SiteTotalAmount ?></span>
                     </div>
                     <div class="sub-price">
                        <i class="fa fa-plus text-muted"></i>
                     </div>
                     <div class="sub-price">
                    <small>CORNER CHARGES(<?php echo $value1->SitePurchaseCorner?>%)</small>
                        <i class="fa fa-rupee text-muted" style="font-size:16px;"></i> <span class="text-inverse"><?php echo (($value1->SiteTotalAmount*$value1->SitePurchaseCorner)/100) ?></span>
                     </div>
                     <div class="sub-price">
                        <i class="fa fa-minus text-muted"></i>
                     </div>
                     
                     <div class="sub-price">
                        <small>DISCOUNT</small>
                        <i class="fa fa-rupee text-muted" style="font-size:16px;"></i> <span class="text-inverse"><?php echo $value1->SitePurchaseDiscount; ?></span>
                     </div>
                  </div>
               </div>
               <div class="invoice-price invoice-price-right">
                  <small>GRAND TOTAL</small>
                  <i class="fa fa-rupee text-muted" style="font-size:23px;"></i> <span class="text-inverse"><?php echo $value1->SitePurchaseAmount; ?></span>
               </div>
               </div>
               
            <!-- end invoice-price -->
         </div>
         <div class="invoice-note mt-0">
         <h3>Terms & Conditions</h3>  
         * Development charges at the time of registry. 
         <br>
         * 10% extra charges for corner plots. 
         <br>
         * The company will fix the advance amount at the time of booking of the plot(s) according to plot size.
         <br>
         * Advance payment and the monthly installment must be paid as per the rules of the company.
         <br>
         * The agreement to sell will be executed on the rate fixed by the company
         <br>
         * The purchaser must pay the monthly installment of their respective plot(s) on or before 15th of every month. 
         <br>
         * Irregularity in releasing payments of 3 consecutive month's installments will lead to cancellation of the booking without any intimation to the purchaser. 25% of the total amount received till date will be deducted, remaining 75% will be refunded by cheque after 90 days. 
         <br>
         * No compaints will be entertained in respect of the plot(s) cancelled due to payment defautlting. 
         <br>
         * The company reserves the right to allot the plot(s) cancelled (due to defaulting) to any other prospective purchaser(s).
         <br>
         * In case the purchaser wants to transfer his/her plot to any other person then the sole responsibility of the said purchaser is to arrange a customer for the said plot. In that event, the purchaser has to pay 7.5% of the entire sale consideration towards changes to the company. The condition will be applicable only in case of regular payment of plot. 
         <br>
         * Variation in sizes of the plot due to changes in government policies or as per direction of the sanctioning authority shall be binding upon the purchaser. Differenece in such case will be adjusted at the booking rate vice-versa. 
         <br>
         * In the event of payment cheque cancellation / bouncing/ non-credit for any reason, a minimum charges of Rs. 1,000/- will be levied to / borne by the purchaser. The charges will be debited/dededucted from the customer's a/c. 
         <br>
         * The company reserves all rights to cancel the booking/ agreement of sale and/ or other relevant matters.
         <br>
         * Plot(s) can be purchased in joint names; however, the correspondence will be carried out in any one of the purchasers name. The purchaser can appoint nominee(s) on his / her behalf.
         <br>
         * In case of any changes in the postal address of the purchaser, he/ she must inform about his / her new address to the company immediately in writing at the earliest possible. Company will not be responsivle for any loss/ inconveniences caused due to delay in updating purchaser's address in company's office record. 
         <br> 
         * The purchaser should obtain the valid receipt from the office against the payment mode. 
         <br> 
         * It is the responsibility of every purchaser to visit company's office in person through company representative to update about his/her plot(s), agreed payment terms and conditions along with monthly installments schedules.
         <br> 
         * The purchaser shall be liable towards the expenses in respect of stamp duty, registration charges, legal expenses for agreement to sell, sale deed and other pocked expenses and the same shall be borne by the prospective plot purchasers.
         <br> 
         * The timeline/ deadline set for releasing payments shall remain one of the top most criteria to drive other conditions wherever is applicable as decided/set by the company. 
         <br> 
         *  For any other reasons cases that are not specified in this document, the decision of the company shall remain final and binding upon the purchaser. 
         <br> 
         * The purchaser shall pay @ Rs.25/- (Rupees Twenty Five Only) per square feet at the time of registry or as agreed under payment terms& conditions. This chage(lf paid at the time of registry) will be for 5 years from the date of registry against security & maintenance. Rs. 35/- per square feet at the time of registry/ Development for electrification. 
         <br> 
         * Basic development will be completed within 3 years and remaining special features of Township/ Colony development will be completed in next 3 years post basic development completion. 
         <br> 
         * Due to some unknown circumstances or other restrictions, the position of the plot may vary from the map you marked while booking. This can be resolved mutually between the company and customer. 
         <br> 
         * The purchaser should pay EMI at the cash/payment counter of company's office. The purchaser should not deal with any financial matter involng cash/ payment transactions with the company executive. The company shall no be responsible for any monetary loss or purchaser(s) due ot such dealing with company's execustive(s). 
         <br> 
         * The purchaser is allowed for correspondence with the company of its Registered Office address only jurisdiction only. That, in case of any dispute the decision of the company will be final and it will always be subject to Registered Office jurisdiction only. 
         <br> 
         * In case of dispute, the decision of the company shall supersede and subject to Delhi jurisdictionly only. 
         <br>
         <b>we have read all the above terms & conditions and1/ we shall abide by the same.</b>        
         </div>
         <br>
         <p class="text-center m-b-5 f-w-600">
         Customer Signture &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
               &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Admin Signture
   
            </p>
         <!-- end invoice-content -->
         <!-- begin invoice-note -->

         <!-- end invoice-note -->
         <!-- begin invoice-footer -->
         <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
               Contact Us
            </p>
            <p class="text-center">
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>pscityinfra.com/</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> +918840019424</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> info.pscity@gmail.com</span>
            </p>
         </div>
         <!-- end invoice-footer -->
      </div>
   </div>
</div>
<div id="non-printable">
<?php
include "include/footer.php";
?>
</div>