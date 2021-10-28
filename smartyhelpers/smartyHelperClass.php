<?php
class smartyHelperClass {

    public static function customCarrierMessage($params)
    {
        // check if data is set otherwise exit
        $data = isset($params['data'])?$params['data']:NULL;
        if ($data == NULL){
            return;
        }
        // Courier number to look for
        $courierNumber = 4;
        $courierProductList = array();
        // Decode data
        $array = json_decode($data,  true);
        // Check if our carrier is between the products.
        $ourCarrier = false;

        //for each in $data
        foreach ($array as $key => $value) {
            $this_product_list = $array[$key]['product_list'];
            foreach ($this_product_list as $plKey => $plValue) {

                // $this_product containes the carrier_list array
                $this_product = $this_product_list[$plKey];
                $is_carrier_product = false;

                $this_carrier = $this_product["carrier_list"];
                foreach($this_carrier as $cKey => $cValue) {
                    // Check for our courier number 
                    if ($cValue == $courierNumber) {
                        $ourCarrier = true;
                        $is_carrier_product = true;
                    }
                }

                // Check if this is a courier product and at it to the list
                if ($is_carrier_product){
                    array_push($courierProductList, $this_product["name"]);
                }

            }

        }

        // Exit if it isnt there
        if ($ourCarrier == false){
            return;
        }

        // Make courierProductList unique because we iterate every courier option.
        $productArray = array_unique($courierProductList);
        // Remove the last input from the array
        $last = array_pop($productArray);
        if (!empty($productArray)) {
            // Imlode array, paste the last input from the array behind it.
            $productString = implode(', ', $productArray) . ' en ' . $last;
        } else {
            // Only return the last if the array was empty after popping
            $productString = $last;
        }

        return '<p class="alert alert-warning" role="alert">
            De volgende producten kunnen niet met PostNL verzonden worden door andere producten in je winkelmandje: '. $productString .'.
        </p>';
    
    }

}