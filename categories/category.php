<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 


  $select = $conn->query("SELECT * FROM props ORDER BY name DESC");
  $select->execute();

  $props = $select->fetchAll(PDO::FETCH_OBJ);

  if(isset($_GET['type'])) {
    $type = $_GET['type']; 

    $rent = $conn->query("SELECT * FROM props WHERE type='$type'");

    $rent->execute();

    $allListings = $rent->fetchAll(PDO::FETCH_OBJ);
  } else {
    echo "<script>window.location.href='".APPURL."/404.php' </script>";

  }

  if(isset($_GET['price'])) {
    $price = $_GET['price']; 

    $price_query = $conn->query("SELECT * FROM props ORDER BY price $price");

    $price_query->execute();

    $allListingsPrice = $price_query->fetchAll(PDO::FETCH_OBJ);

    //var_dump($allListingsPrice);
  } else {
    echo "<script>window.location.href='".APPURL."/404.php' </script>";

  }


  //displaying data based on category

  if(isset($_GET['name'])) {
    $name = $_GET['name']; 

    $singleCategory = $conn->query("SELECT * FROM props WHERE home_type = '$name'");

    $singleCategory->execute();

    $allSingleCategory = $singleCategory->fetchAll(PDO::FETCH_OBJ);

    //var_dump($allListingsPrice);
  } else {
    echo "<script>window.location.href='".APPURL."/404.php' </script>";

  }

  

?>
  
 

    <div class="slide-one-item home-slider owl-carousel">
     <?php foreach($props as $prop) : ?>

        <div class="site-blocks-cover overlay" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $prop->image; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
          <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                  <span class="d-inline-block bg-<?php if($prop->type == "rent") { echo "success"; } else { echo "danger"; }?> text-white px-3 mb-3 property-offer-type rounded"><?php echo $prop->type; ?></span>
                  <h1 class="mb-2"><?php echo $prop->name; ?></h1>
                  <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo $prop->price; ?></strong></p>
                  <p><a href="property-details.php?id=<?php echo $prop->id; ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
                </div>
            </div>
          </div>
        </div>  
      <?php endforeach; ?>

   

    </div>


    <div class="site-section site-section-sm pb-0">
      <div class="container">
        <div class="row">
          <form class="form-search col-md-12" method="POST" action="search.php" style="margin-top: -100px;">
            <div class="row  align-items-end">
              <div class="col-md-3">
                <label for="list-types">Listing Types</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="types" id="list-types" class="form-control d-block rounded-0">
                    <?php foreach($allCategories as $category) : ?>
                      <option value="<?php echo $category->name; ?>"><?php echo str_replace('-', ' ', $category->name); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="offer-types">Offer Type</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="offers" id="offer-types" class="form-control d-block rounded-0">
                    <option value="sale">sale</option>
                    <option value="rent">rent</option>
                    <option value="lease">lease</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="select-city">Select City</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="cities" id="select-city" class="form-control d-block rounded-0">
                    <option value="new york">New York</option>
                    <option value="brooklyn">Brooklyn</option>
                    <option value="london">London</option>
                    <option value="japan">Japan</option>
                    <option value="philippines">Philippines</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <input type="submit" name="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
              </div>
            </div>
          </form>
        </div>  

        <div class="row">
          <div class="col-md-12">
            <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
              <div class="mr-auto">
                <a href="index.php" class="icon-view view-module active"><span class="icon-view_module"></span></a>
                
              </div>
              <div class="ml-auto d-flex align-items-center">
                <div>
                  <a href="<?php echo APPURL; ?>" class="view-list px-3 border-right active">All</a>
                  <a href="rent.php?type=rent" class="view-list px-3 border-right">Rent</a>
                  <a href="sale.php?type=sale" class="view-list px-3">Sale</a>
                  <a href="price.php?price=ASC" class="view-list px-3">Price Ascending</a>
                  <a href="price.php?price=DESC" class="view-list px-3">Price Descending</a>
                </div>


               
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
      
        <div class="row mb-5">
          <?php foreach($allSingleCategory as $homeType) : ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="property-details.php?id=<?php echo $homeType->id; ?>" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-<?php if($homeType->type == "rent") { echo "success"; } else { echo "danger"; }?>"><?php echo $homeType->type; ?></span>
                </div>
                <img src="<?php echo APPURL; ?>/images/<?php echo $homeType->image; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <h2 class="property-title"><a href="property-details.php?id=<?php echo $homeType->id; ?>"><?php echo $homeType->name; ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo $homeType->location; ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $homeType->price; ?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?php echo $homeType->beds; ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number"><?php echo $homeType->baths; ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number"><?php echo $homeType->sq_ft; ?></span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>
          <?php endforeach; ?>

        </div>
     
        
      </div>
    </div>

   

    
   
<?php require "../includes/footer.php"; ?>
