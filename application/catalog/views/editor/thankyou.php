<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mapift</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('css/createimage.css'); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
	<!--div class="loader">
    	<div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div-->
    <div ><h1 class="thank">Thank You</h1>
	<center>  
  <!-- INVOICE SECTION -->
  <table style="table-layout:fixed;margin:0 auto;mso-table-lspace:0pt;mso-table-rspace:0pt;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
      <tr>
        <td align="center"><table class="table600 bdr" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="618" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
              <tr>
                <td><table class="table600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="610" cellspacing="0" cellpadding="0" border="0" align="left">
                    <tbody>
                      <tr>
                        <td><table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="608" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                              <tr>
                                <td><table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border:1px solid #ffffff; border-radius:4px 4px 0 0;" width="608" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody>
                                      <tr>
                                        <td style="font-size:0;line-height:0;" height="15">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td><table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="608" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                            <tbody>
                                              <tr>
                                                <td class="wz" width="20"></td>
                                                <td><!--(BILLED TO) SECTION-->
                                                  <table class="table518c" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="270" cellspacing="0" cellpadding="0" border="0" align="right">
                                                    <tbody>
                                                      <tr> 
                                                        <!--BILLED TO-->
                                                        <td class="invInfoA" width="270"><strong>Billed To:</strong></td>
                                                      </tr>
                                                      <tr> 
                                                        <!--NAME-->
                                                        <td class="invInfoA"><?php echo ucfirst($order['name']); ?></td>
                                                      </tr>
                                                      <tr> 
                                                        <!-- ADDRESS-->
                                                        <td class="invInfoA">
                                                            <?php echo $order['address_line1']; ?>
                                                            <?php if($order['address_line2']!='')echo ', '.$order['address_line2']; ?><br/>
                                                            <?php echo $order['city'].', '.$order['zipcode']; ?><br/>
                                                            <?php echo $order['state'].', '.$order['country']; ?><br/>
                                                            <?php echo $order['email']; ?><br/>
                                                            <?php echo $order['phone']; ?><br/>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                 
                                                  <!--YOUR COMPANY'S INFORMATION-->
                                                  
                                                  <table class="table518c2" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="270" cellspacing="0" cellpadding="0" border="0" align="left">
                                                    <tbody>
                                                      <tr>
                                                        <td class="invInfoB" width="250"><?php echo $app_name; ?><br>
                                                          <?php echo nl2br($location) ?></td>
                                                        <td class="iconPdngErase" style="font-size:0;line-height:0;" width="20">&nbsp;</td>
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                                <td class="wz" width="20"></td>
                                              </tr>
                                              <tr>
                                                <td colspan="3" style="font-size:0;line-height:0;" height="15">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td class="wz" width="20"></td>
                                                <td><table class="table518c" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="270" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="right">
                                                    <tbody>
                                                      <tr> 
                                                        <!--INVOICE DATE-->
                                                        <td class="invInfoA" width="270"><a href="#"><strong>Invoice Date</strong>: <?php echo date('F j, Y',strtotime($order['created_datetime'])); ?></a></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                  <table class="table518c" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="270" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="left">
                                                    <tbody>
                                                      <tr> 
                                                        <!--INVOICE NO-->
                                                        <td class="invInfoB" width="250"><a href="#"><strong>Invoice No: </strong><?php echo $order['orderid']; ?></a></td>
                                                        <td class="iconPdngErase" width="20"></td>
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                                <td class="wz" width="20"></td>
                                              </tr>
                                            </tbody>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:0;line-height:0;" height="30">&nbsp;</td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                          </table>
                          <table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border:1px solid #ffffff; border-radius:0 0 4px 4px;" width="608" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                            <tbody>
                              <tr>
                                <td><table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td><table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="608" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                            <tbody>
                                              <tr>
                                                <td class="wz" width="20"></td>
                                                <td><table style="mso-table-lspace:0pt;mso-table-rspace:0pt;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                    <tbody>
                                                      <tr>
                                                        <td style="font-size:0;line-height:0;" height="20">&nbsp;</td>
                                                      </tr>
                                                      <tr> 
                                                        <!-- INVOICE LABEL -->
                                                        <td class="invoiceTD" width="564">Invoice</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="font-size:0;line-height:0;" height="20">&nbsp;</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                  
                                                  <!--= PRODUCT GROUP (you can copy and paste the entire section to duplicate)=-->
                                                  
                                                  <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                    <tbody>
                                                      <tr style="background-color:#f4f4f4;">
                                                        <th class="invReg" width="189" valign="middle" height="25">Maps</th>
                                                        <th class="invReg" width="189" valign="middle" height="25">Qty.</th>
                                                        <th class="invReg" width="189" valign="middle" height="25">Price</th>
                                                        <th class="invReg" width="189" valign="middle" height="25">Total</th>
                                                      </tr>
                                                      <?php foreach($maps as $map): ?>
                                                      <?php $property= json_decode(base64_decode($map['map_properties']),TRUE); ?>
                                                      <tr style="background-color:#f9f9f9;">
                                                        <td class="invReg" width="189" valign="middle" height="25">
																												<?php echo ucfirst($map['title']); ?>
																												</td>
                                                        <td class="invReg" width="189" valign="middle" height="25"><?php echo $map['qty']; ?></td>
                                                        <td class="invReg" width="189" valign="middle" height="25"><?php echo $map['price']; ?></td>
                                                        <td class="invReg" width="189" valign="middle" height="25"><?php echo number_format($map['price']*$map['qty'],2); ?></td>
                                                      </tr>
                                                      <?php endforeach; ?>
                                                      <tr>
                                                        <td colspan="3" style="font-size:0;line-height:0;" height="20">&nbsp;</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                  <!--================================ END PRODUCT GROUP =====-->
                                                  <!--============================ SUBTOTAL, TOTAL, VAT, ETC. ==-->
                                                  <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                    <!-- you can duplicate this group or delete it-->
                                                    <tbody>
                                                      <?php if($order['discount']!=0): ?>
                                                      <tr>
                                                        <td class="invReg" width="189"></td>
                                                        <td class="invReg" width="189"></td>
                                                        <td class="invReg" width="189" valign="middle" height="25">Subtotal</td>
                                                        <td class="invReg" width="189" valign="middle" height="25"><?php echo $order['subtotal']; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td class="invReg" width="189"></td>
                                                        <td class="invReg" width="189"></td>
                                                        <td class="invReg" width="189" valign="middle" height="25">Discount (<?php echo number_format($order['discount']); ?>%)</td>
                                                        <td class="invReg" width="189" valign="middle" height="25"><?php echo number_format($order['subtotal']*$order['discount']/100,2); ?></td>
                                                      </tr>
                                                      <?php endif; ?>
                                                      <tr>
                                                        <td class="invReg" width="189"></td>
                                                        <td class="invReg" width="189"></td>
                                                        <th class="invReg" width="189" valign="middle" height="25">Total</th>
                                                        <th class="invReg" width="189" valign="middle" height="25"><?php echo number_format($order['total_amount'],2); ?></th>
                                                      </tr>
                                                      <!-- end group -->
                                                    </tbody>
                                                  </table>
                                                  
                                                  <!--======================= END SUBTOTAL, TOTAL, VAT. GROUP =-->
                                                  
                                                  <table class="table518b" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="567" cellspacing="0" cellpadding="0" border="0" align="left">
                                                    <tbody>
                                                      <tr>
                                                        <td style="font-size:0;line-height:0;" height="40">&nbsp;</td>
                                                      </tr>
                                                      <tr> 
                                                        <!--SHIPPING ADDRESS AND Payment Method Information-->
                                                        <td class="RegularTextTD" height="20"><strong>Shipping Address</strong>:  
                                                           <?php echo $order['address_line1']; ?>
                                                            <?php if($order['address_line2']!='')echo ', '.$order['address_line2']; ?>&nbsp;
                                                            <?php echo $order['city'].', '.$order['zipcode']; ?>&nbsp;
                                                            <?php echo $order['state'].', '.$order['country']; ?>&nbsp;
                                                          
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                                <td class="wz" width="20"></td>
                                              </tr>
                                            </tbody>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:0;line-height:0;" height="15">&nbsp;</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td><table class="table608" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="608" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                            <tbody>
                                              <tr>
                                                <td align="center"><table style="border-radius:4px 4px 4px 4px;mso-table-lspace:0pt;mso-table-rspace:0pt;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                    <tbody>
                                                      <tr>
                                                        <td class="wz" width="20"></td>
                                                        <td><table class="table528Button" style="mso-table-lspace:0pt;mso-table-rspace:0pt;" width="528" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            <tbody>
                                                              <tr>
                                                                <td style="font-size:0;line-height:0;" height="8">&nbsp;</td>
                                                              </tr>
                                                              <tr> 
                                                                
                                                                <!--BUTTON--> 
                                                                
                                                                <!--Use shorter phrases , or the text jumps into an another line-->
                                                                
                                                                <td class="td528Button" width="528" align="center"><a href="#" target="_blank">Thank You For Your Order!</a></td>
                                                              </tr>
                                                              <tr>
                                                                <td style="font-size:0;line-height:0;" height="8">&nbsp;</td>
                                                              </tr>
                                                            </tbody>
                                                          </table></td>
                                                        <td class="wz" width="20"></td>
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                              </tr>
                                            </tbody>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td class="buttonVrt" style="font-size:0;line-height:0;" height="21">&nbsp;</td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                    </tbody>
                  </table></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
  <table style="table-layout:fixed;mso-table-lspace:0pt;mso-table-rspace:0pt;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ededed" align="center">
    <tbody>
      <tr>
        <td class="mvd" style="font-size:0;line-height:0;" width="610" bgcolor="#ededed" align="center" height="30">&nbsp;</td>
      </tr>
    </tbody>
  </table>
  
  
  <!--FOOTER ENDS HERE-->
</center></div>
</body>
</html>
