<?php session_start(); ?>
 
<html>
	<head>
<title>Products</title>

<link rel="stylesheet" type="text/css" href="index.css">

        <style type="text/css">
        .style5 {color: #FF0000}
        </style>
	</head>
<body>
    
<?php

$filmsArray = array(); //create empty array for films list

include "db.php"; //connecting database


if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $user = $_SESSION['user']; //if user signin - get users data
} else
    $user = null;


if(isset($_GET['category'])) {
  switch($_GET['category']) {
    case 'action':
        $category = 'action';
        break;
    case 'adventure':
        $category = 'adventure';
        break;
    case 'comedy':
        $category = 'comedy';
        break;
    case 'thriller':
        $category = 'thriller';
        break;
  }
  $query = "SELECT * FROM films WHERE id IN (SELECT film_id FROM filmcategory WHERE category = '$category') ;"; // sql query to get films list
} else {
  $query = "SELECT * FROM films ;"; // sql query to get films list
}
$result = mysql_query($query); //submit query
while($row = mysql_fetch_assoc($result))
{
    $filmsArray[] = $row; //passes on result and add every row from the table to the films array
}

$divTop = 127;
$imTop = 133;
$i = 0;
$delta = 169; //numbers for calculating position of blocks on page

?>    
    
<div id="container">
  <div id="wb_Image1" 	style="margin:0;padding:0;position:absolute;left:0px;top:21px;width:772px;height:87px;text-align:left;z-index:25;"><span style="margin:0;padding:0;position:absolute;left:0px;top:1px;width:781px;height:87px;text-align:left;z-index:25;"><img src="header.gif" alt="" name="Image1" width="780" height="87" border="0" id="Image1" style="width:780px;height:87px;"></span></div>
  <div id="wb_Image4" 	style="margin:0; padding:0; position:absolute; left:0px; top:102px; width:781px; height:4155px; text-align:left; z-index:26; background-image: url(body.gif); layer-background-image: url(body.gif); border: 1px none #000000;"> <img src="body.gif" alt="" name="Image4" width="780" height="4" border="0" id="Image4" style="width:780px;height:671px;"></div>
  <div id="wb_Text2" 	style="margin:0;padding:0;position:absolute;left:101px;top:36px;width:582px;height:70px;text-align:left;z-index:28;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
    <div 				style="font-family:'Segoe UI';font-size:12px;color:#000000;">
      <div class="black"style="text-align:left">
        <div align="center" class="style1"><span 
						style="font-size:32px;color:#497DB2;"> ONLINE Film Rental Products</span></div>
      </div>
    </div>
  </div>
  <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
  <div class="wb_Error" style="margin: 0px;position: absolute;left: 183px;top: 90px;width: 552px;height: 18px;z-index: 28;border: 2px solid red;overflow-y: hidden;background-color: rgba(203, 23, 23, 0.12);color: red;padding: 5px;text-align: center;">
    <?php echo $_SESSION['error'];  $_SESSION['error'] = null; unset($_SESSION['error']); ?>
  </div>
  <?php endif; ?>
<?php foreach ($filmsArray as $film): ?>
  <div id="wb_Image6" 	style="margin:0;padding:0;position:absolute;left:185px;top:<?php echo $imTop+($i*$delta); //calculation of image position ?>;width:160px;height:123px;text-align:left;z-index:32;"> <a href="product.php?id=<?php echo $film['id']; ?>"><img src="<?php echo $film['image']; ?>" alt="Product1" name="Image6" width="276" height="183" border="0" id="Image6" style="width:160px;height:123px;" title="Product 1"></a></div>
  <div id="wb_Form1" 	style="position:absolute;left:389px;top:<?php echo $divTop+($i*$delta); $i++; //calculation of div block position ?>px;width:399px;height:286px;z-index:29;">
    <form name="frmProduct1" method="post" action="./cart.php" id="Form1">
      <input type="hidden" name="productcode" value="<?php echo $film['id']; ?>">
      <input type="hidden" name="productname" value="<?php echo $film['name']; ?>">
      <input type="hidden" name="price" value="<?php echo $film['price']; ?>">
      <div id="wb_Text5" style="margin:0;padding:0;position:absolute;left:15px;top:12px;width:414px;height:285px;text-align:left;z-index:0;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
        <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
          <div 			 style="text-align:left"><span style="font-family:'Times New Roman';font-size:19px;color:#497DB2;"><?php echo $film['name']; ?></span></div>
          <div 			 style="text-align:left"><span style="font-family:'Times New Roman';font-size:13px;"><?php echo $film['description']; ?></span></div>
          <div 			 style="text-align:left">
            <p 			 style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">&nbsp;</p>
            <p 			 style="font-family:'Times New Roman';font-size:13px;color:#0000FF;"><a href="product.php?id=<?php echo $film['id']; ?>" class="black">Find out more</a></p>
          </div>
        </div>
      </div>
      <div id="wb_Text4" style="margin:0;padding:0;position:absolute;left:21px;top:109px;width:64px;height:19px;text-align:left;z-index:1;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
        <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
          <div 			 style="text-align:left"><span 
						 style="font-family:'Times New Roman';font-size:16px;"><strong>Price:</strong></span></div>
        </div>
      </div>
      <div id="wb_Text6" style="margin:0;padding:0;position:absolute;left:106px;top:110px;width:92px;height:19px;text-align:left;z-index:2;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
        <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
          <div           style="text-align:left"><span 
						 style="font-family:'Times New Roman';font-size:16px;">&pound;<?php echo $film['price']; ?></span></div>
        </div>
      </div>
      <div id="wb_Text3" style="margin:0;padding:0;position:absolute;left:20px;top:138px;width:73px;height:19px;text-align:left;z-index:3;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
        <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
          <div 			 style="text-align:left"><span 
						 style="font-family:'Times New Roman';font-size:16px;"><strong>Quantity:</strong></span></div>
        </div>
      </div>
	  
	  <div id="layer6" style="margin:0;padding:0;position:absolute;left:344px;top:77px;width:80px;height:19px;text-align:left;z-index:1;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
          <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
            <div 			 style="text-align:left"><span 
						 style="font-family:'Times New Roman';font-size:16px;"><strong>Available</strong></span></div>
          </div>
      </div>
	  
	  <div id="layer4" style="margin:0;padding:0;position:absolute;left:145px;top:165px;width:64px;height:19px;text-align:left;z-index:1;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
          <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
            <div 			 style="text-align:left">
              <?php if($film['quantity'] > 0) { ?>
                <span style="font-family:'Times New Roman';font-size:16px;"><strong>Instock</strong></span>
              <?php } ?>
            </div>
          </div>
      </div>

	  <div id="layer5" style="margin:0;padding:0;position:absolute;left:229px;top:164px;width:107px;height:19px;text-align:left;z-index:3;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
          <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
            <div class="style5" 			 style="text-align:left">
              <?php if($film['quantity'] <= 0) { ?>
              <span  style="font-family:'Times New Roman';font-size:16px;">Out <span class="style5">of</span> stock</span>
              <?php } ?>
            </div>
          </div>
      </div>
		
		<div id="layer7" style="margin:0;padding:0;position:absolute;left:342px;top:102px;width:79px;height:19px;text-align:left;z-index:2;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
          <div 			 style="font-family:'Segoe UI';font-size:12px;color:#000000;">
            <div           style="text-align:left"><span 
						 style="font-family:'Times New Roman';font-size:16px;"><?php echo $film['quantity']; ?></span></div>
          </div>
        </div>
	  <!-- very important don't want cart going into negative values -->
      <input type="number" min="1" max='<?php echo $film['quantity']; ?>' id="Editbox1"
						 style="position:absolute;left:105px;top:139px;width:38px;height:20px;line-height:20px;z-index:4;" name="quantity" value="1">
      <input type="submit" id="Button1" name="addtocart2" value="Add to Cart" 
	    <?php if ($film['quantity'] <= 0) { ?> disabled <?php   } ?> 
						 style="position:absolute;left:154px;top:137px;width:89px;height:25px;z-index:5;">
    </form>
    <?php if($user['type'] == "admin"): ?>
    <form action="delete.php" method="get">
    <input type="hidden" name="productcode" value="<?php echo $film['id']; ?>">
    <input type="submit" id="addtocart2" value="Delete Product" style="position:absolute;left:254px;top:139px;width:102px;height:25px;z-index:5;">
    </form>
    <?php endif; ?>
  </div>
  <?php endforeach; ?>
  
  
  <div id="NavigationBar1" style="position:absolute;left:31px;top:132px;width:118px;height:99px;z-index:39;">
    <ul class="navbar">
      <li><a href="./index.php"  class="black"> Home</a></li>
      <li><a href="./products.php"class="black"> all Products</a></li>
      <li><a href="./customerdetails.php"class="black"> Details</a></li>

      <?php
      
      if (!empty($user) && $user['type'] == "admin") {
          echo '
      <li><a href="orders.php"class="black"> Orders</a></li>
          ';
      }
      
      if (!empty($user)) {
          echo '
      <li><a href="./cart.php"class="black"> Cart</a></li>
      <li><a href="signin.php?logout"class="black"> Logout</a></li>
          ';
      }
      
      ?>
    </ul>

    <h4>Categories</h4>
    <ul class="navbar">
      <li><a href="./products.php?category=action" class="black"> <button>Action</button></a></li>
      <li><a href="./products.php?category=adventure" class="black"> <button>Adventure</button></a></li>
      <li><a href="./products.php?category=comedy" class="black"> <button>Comedy</button></a></li>
      <li><a href="./products.php?category=thriller" class="black"> <button>Thriller</button></a></li>
    </ul>
  </div>
</div>
</div>
 <!--This is the products array admin only access-->
<?php if($user['type'] == "admin"):  ?>
<div 		id="layer3" 			style="margin:0;padding:0;position:absolute;left:1413px;top:173px;width:160px;height:116px;text-align:left;z-index:38;"><a href="product4.html"><img src="spanner.jpg" alt="imageaddarea" name="Image7" width="193" height="118" border="0" id="Image7" style="width:160px;height:116px;" title="image add area"></a></div>
<div 		id="layer" 				style="position:absolute;left:1028px;top:75px;width:759px;height:308px;z-index:37;">
  <form action="add.php" method="post" enctype="multipart/form-data">
    ADD PRODUCT ARRAY 
    <div 	id="layer2" 			style="margin:0;padding:0;position:absolute;left:98px;top:31px;width:629px;height:278px;text-align:left;z-index:18;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
      <div 							style="font-family:'Segoe UI';font-size:12px;color:#000000;">
        <div 						style="text-align:left">
          <p class="style4">add title</p>
          <p class="style4"><span class="style4">
            <label>
            <input type="text" name="title">
            </label>
          </span> 
            <label>   browse for image</label>
            <input type="file" name="image">
          </p>
        </div>
        <div 	                    style="text-align:left">
          <p><label>Category</label></p>
          <p class="style4"><span class="style4">
            <label></label>
          </span>
          <select  name="category">
        <option value="action">action</option>
        <option value="adventure">adventure</option>
        <option value="comedy">comedy</option>
        <option value="thriller">thriller</option>>
            </select></p>
        </div>
        <div 						style="text-align:left">
          <p 						style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">add descrtipion</p>
          <p 						style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">&nbsp;</p>
          <p 						style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">
            <label>
            <textarea name="description"></textarea>
            <br>
            </label>
          </p>
          <p 						style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">
            <label>Price</label><br>
            <input type="number" name="price" />
          </p>
          <p 						style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">&nbsp;</p>
          <p 						style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">Quantity</p>
          <p 						style="font-family:'Times New Roman';font-size:13px;color:#0000FF;">
            <input type="number" name="quantity2" />
          &nbsp;</p>
        </div>
      </div>
    </div>
    <input type="submit" id="addtocart52" name="addtocart52" value="Add Product" 
							style="position:absolute;left:385px;top:215px;width:97px;height:34px;z-index:23;">
  </form>  
</div>
<?php endif; ?>
</body>
</html>
