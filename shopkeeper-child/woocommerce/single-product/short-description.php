<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
<div itemprop="description">

<?php
global $product;
$attributes = $product->get_attributes();
 
if($attributes)
{
	$out = '<ul class="product-page-attributes">';

	if (!empty($product->get_attribute('maerke')))
	{
		$out .= "<li><b>Mærke</b>: " . explode(",", $product->get_attribute( 'maerke' ))[0] . "</li>";
	}

	if (!empty($product->get_attribute('stoerrelse')))
	{
		$s = explode(",", $product->get_attribute( 'stoerrelse' ))[0];
		$out .= "<li><b>Størrelse</b>: " . $s . "</li>";
	}


	$tmp_attributes = array();
	foreach($attributes as $attribute)
	{
		if ($attribute["name"] == "pa_farve")
			$tmp_attributes[] = $attribute;
		
		if ($attribute["name"] == "pa_varens-stand")
			$tmp_attributes[] = $attribute;
		
		if ($attribute["name"] == "pa_materiale")
			$tmp_attributes[] = $attribute;
		
		if ($attribute["name"] == "pa_brystvidde")
			$tmp_attributes[] = $attribute;
		
		if ($attribute["name"] == "pa_livvidde")
			$tmp_attributes[] = $attribute;
		
		if ($attribute["name"] == "pa_laengde")
			$tmp_attributes[] = $attribute;
		
		if ($attribute["name"] == "pa_benlaengde-indvendig")
			$tmp_attributes[] = $attribute;
		
		if ($attribute["name"] == "pa_aermelaengde-indvendig")
			$tmp_attributes[] = $attribute;
	}

	foreach($tmp_attributes as $attribute)
	{

	    global $desired_att;
		if ($attribute["name"] == "pa_stoerrelse")
		{

		}
		else
		{
		    if ($attribute['is_taxonomy'])
		    {
		        // sanitize the desired attribute into a taxonomy slug
		        $tax_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $desired_att)));
		     
		        // if this is desired att, get value and label
		         
		            $terms = wp_get_post_terms( $product->get_id(), $attribute['name'], 'all' );
		            $tax = $terms[0]->taxonomy;
		            $tax_object = get_taxonomy($tax);
		             
		            if (isset($tax_object->labels->singular_name))
		            {
		                $tax_label = $tax_object->labels->singular_name;
		            }
		            elseif(isset($tax_object->label))
		            {
		                $tax_label = $tax_object->label;
		            }
		             
		            foreach($terms as $term)
		            {
		            	$out .= "<li>";
		                $out .= "<b>" . $tax_label . '</b>: ' . $term->name;
		            	$out .= "</li>";
		            }

		    }
		    else
		    {
		   		if ($attribute['name'] == $desired_att )
		   		{
		            $out .= "<li>";
		            $out .= "<b>" . $attribute['name'] . '</b>: ' . $attribute['value'];
		            $out .= "</li>";
		        }
		    }
		}    
	}
	$out .= '</ul>';
	$out .= '<br>';
echo $out;
}
?>


	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div>
