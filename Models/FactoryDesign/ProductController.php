<?php
class ProductController {
	/**
	 * 
	 * @param string $product_type
	 * @return string
	 */
	public function create ($product_type) {
		// Some post data validation logic here
		// Now we need to instantiate our product
		switch ($product_type) {
			case 'chair':
				$product = new Product_Chair($post['sku'], $post['name']);
				break;

			case 'table':
				$product = new Product_Table($post['sku'],$post['name']);
				break;
		}
		// Do something with the post data and save the product
		return $product->getType();
	}
}