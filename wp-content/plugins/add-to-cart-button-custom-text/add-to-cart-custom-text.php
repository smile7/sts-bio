<?php
/*
Plugin Name: Add to Cart Button Custom Text
Plugin URI: https://wordpress.org/plugins/add-to-cart-button-custom-text/
Description: Allows to customize the "Add to Cart" button text in WooCommerce by product type in both archive and single product pages, including bookable products.
Author: Enrique J. Ros
Author URI: https://www.enriquejros.com/
Version: 2.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: add-to-cart-custom-text
Domain Path: /lang/
*/

/*
    Copyright 2017 Enrique J. Ros (email: enrique@enriquejros.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined ('ABSPATH') or exit;

//Core
function er_cambia_texto_boton () {

	global $product;
	$product_type = $product->get_type();

	//Cogemos el valor de la variable de la bd y si no por defecto
	$texto_single = 'Add to cart';
	$texto_externo = esc_attr (get_option ('add_to_cart_external', 'Buy product'));
	$texto_agrupado = esc_attr (get_option ('add_to_cart_grouped', 'View products'));
	$texto_simple = esc_attr (get_option ('add_to_cart_simple', 'Add to cart'));
	$texto_variable = esc_attr (get_option ('add_to_cart_variable', 'Select options'));
	$texto_bookable = esc_attr (get_option ('add_to_cart_bookable', 'Book now'));
	$texto_externo_single = esc_attr (get_option ('add_to_cart_external_single', $texto_externo));
	$texto_agrupado_single = esc_attr (get_option ('add_to_cart_grouped_single', $texto_single));
	$texto_simple_single = esc_attr (get_option ('add_to_cart_simple_single', $texto_single));
	$texto_variable_single = esc_attr (get_option ('add_to_cart_variable_single', $texto_single));
	$texto_bookable_single = esc_attr (get_option ('add_to_cart_bookable_single', $texto_bookable));

	if (is_product()) { //Para la página de producto

		switch ($product_type) {
       
			case 'external':
				return __($texto_externo_single, 'woocommerce');
				break;

			case 'grouped':
				return __($texto_agrupado_single, 'woocommerce');
				break;

			case 'simple':
				return __($texto_simple_single, 'woocommerce');
				break;

			case 'variable':
				return __($texto_variable_single, 'woocommerce');
				break;

			case 'booking':
				return __($texto_bookable_single, 'woocommerce-bookings');
				break;

			default:
				return __($texto_single, 'woocommerce');

			}
		}

	else { //Para las páginas de archivo

		switch ($product_type) {
       
			case 'external':
				return __($texto_externo, 'woocommerce');
				break;

			case 'grouped':
				return __($texto_agrupado, 'woocommerce');
				break;

			case 'simple':
				return __($texto_simple, 'woocommerce');
				break;

			case 'variable':
				return __($texto_variable, 'woocommerce');
				break;

			case 'booking':
				return __($texto_bookable, 'woocommerce-bookings');
				break;

			default:
				return __($texto_single, 'woocommerce');

			}
		}
	}
add_filter ('add_to_cart_text', 'er_cambia_texto_boton'); //Compatibilidad para WooCommerce <2.1
add_filter ('woocommerce_product_add_to_cart_text', 'er_cambia_texto_boton');
add_filter ('woocommerce_product_single_add_to_cart_text', 'er_cambia_texto_boton');
add_filter ('woocommerce_booking_single_add_to_cart_text', 'er_cambia_texto_boton'); //WooCommerce Bookings single product

//Creamos el menú de opciones
function er_crea_menu_opciones () {

	add_options_page ('Add to Cart Custom Text', 'Add to Cart Button', 'manage_options', 'add-to-cart', 'er_add_to_cart_opciones');
	}

//Registramos las opciones
function er_registra_opciones () {

	$opciones = array ('add_to_cart_external', 'add_to_cart_grouped', 'add_to_cart_simple', 'add_to_cart_variable', 'add_to_cart_external_single', 'add_to_cart_grouped_single', 'add_to_cart_simple_single', 'add_to_cart_variable_single');

	if (post_type_exists ('bookable_resource'))
		array_push ($opciones, 'add_to_cart_bookable', 'add_to_cart_bookable_single');

	foreach ($opciones as $opcion)
		register_setting ('addtocart-opciones', $opcion);

	}

if (is_admin()) {

	add_action ('admin_menu', 'er_crea_menu_opciones');
	add_action ('admin_init', 'er_registra_opciones');
	}

//Y creamos la página de opciones
function er_add_to_cart_opciones () {

	current_user_can ('manage_options') or wp_die (__('Sorry, you are not allowed to access this page.'));

	?>

	<div class="wrap">

        <h2><?php _e('Add to Cart Custom Text options', 'add-to-cart-custom-text'); ?></h2>

        <form method="post" action="options.php">

                <?php

                	settings_fields ('addtocart-opciones');
                	do_settings_sections ('addtocart-opciones');
					$idioma = get_locale();
					$general = substr ($idioma, 0, 2);

				?>

                <h3><?php _e('Button text in single product pages', 'add-to-cart-custom-text'); ?></h3>

                <p><?php printf(__('Custom text for the %s button in single product pages by product type', 'add-to-cart-custom-text'), '<em>'.__('Add to cart', 'woocommerce').'</em>'); ?></p>

                <table class="form-table">
        
                        <tr valign="top">
                                <th scope="row"><?php _e('Simple product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_simple_single" value="<?php _e(esc_attr (get_option ('add_to_cart_simple_single', 'Add to cart')), 'woocommerce'); ?>" /></td>
                        </tr>

                        <tr valign="top">
                                <th scope="row"><?php _e('External/Affiliate product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_external_single" value="<?php _e(esc_attr (get_option ('add_to_cart_external_single', 'Buy product')), 'woocommerce'); ?>" /></td>
                        </tr>
        
                        <tr valign="top">
                                <th scope="row"><?php _e('Variable product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_variable_single" value="<?php _e(esc_attr (get_option ('add_to_cart_variable_single', 'Add to cart')), 'woocommerce'); ?>" /></td>
                        </tr>
        
                        <tr valign="top">
                                <th scope="row"><?php _e('Grouped product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_grouped_single" value="<?php _e(esc_attr (get_option ('add_to_cart_grouped_single', 'Add to cart')), 'woocommerce'); ?>" /></td>
                        </tr>

			<?php if (post_type_exists ('bookable_resource')): ?>
        
                        	<tr valign="top">
                                	<th scope="row"><?php _e('Bookable product', 'woocommerce-bookings'); ?></th>
                                	<td><input type="text" name="add_to_cart_bookable_single" value="<?php _e(esc_attr (get_option ('add_to_cart_bookable_single', 'Book now')), 'woocommerce-bookings'); ?>" /></td>
                        	</tr>

			<?php endif; ?>

                </table>

                <hr />

                <h3><?php _e('Button text in archive pages', 'add-to-cart-custom-text'); ?></h3>

                <p><?php printf(__('Custom text for the %s button in archive pages (shop, category, tags...) by product type', 'add-to-cart-custom-text'), '<em>'.__('Add to cart', 'woocommerce').'</em>'); ?></p>

                <table class="form-table">
                        <tr valign="top">
                                <th scope="row"><?php _e('Simple product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_simple" value="<?php _e(esc_attr (get_option ('add_to_cart_simple', 'Add to cart')), 'woocommerce'); ?>" /></td>
                        </tr>

                        <tr valign="top">
                                <th scope="row"><?php _e('External/Affiliate product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_external" value="<?php _e(esc_attr (get_option ('add_to_cart_external', 'Buy product')), 'woocommerce'); ?>" /></td>
                        </tr>
        
                        <tr valign="top">
                                <th scope="row"><?php _e('Variable product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_variable" value="<?php _e(esc_attr (get_option ('add_to_cart_variable', 'Select options')), 'woocommerce'); ?>" /></td>
                        </tr>
        
                        <tr valign="top">
                                <th scope="row"><?php _e('Grouped product', 'woocommerce'); ?></th>
                                <td><input type="text" name="add_to_cart_grouped" value="<?php _e(esc_attr (get_option ('add_to_cart_grouped', 'View products')), 'woocommerce'); ?>" /></td>
                        </tr>

						<?php if (post_type_exists ('bookable_resource')): ?>
        
                        	<tr valign="top">
                                	<th scope="row"><?php _e('Bookable product', 'woocommerce-bookings'); ?></th>
                                	<td><input type="text" name="add_to_cart_bookable" value="<?php _e(esc_attr (get_option ('add_to_cart_bookable', 'Book now')), 'woocommerce-bookings'); ?>" /></td>
                        	</tr>

						<?php endif; ?>

                </table>
    
                <?php submit_button (); ?>

        </form>


	<?php if ($general == 'es') { ?>
	<div style="padding:10px 25px;border:2px solid #ec731e;border-radius:4px;">

		<h3>Otros plugins para WooCommerce que te pueden interesar</h3>

		<ul>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-personalizar-checkout-woocommerce/">Plugin para personalizar campos del checkout</a></li>
			<li><a target="_blank" href="https://www.enriquejros.com/downloads/plugin-zonas-envio-personalizadas-woocommerce/">Plugin para personalizar los estados/provincias/departamentos</a></li>
			<li><a target="_blank" href="https://www.enriquejros.com/downloads/plugin-insertar-pixel-facebook-woocommerce/">Plugin para insertar el píxel de Facebook en WooCommerce</a></li>
			<li><a target="_blank" href="https://www.enriquejros.com/downloads/plugin-pestanas-mi-cuenta-woocommerce/">Plugin para añadir pestañas personalizadas en la página <i>Mi cuenta</i></a></li>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-directo-checkout-sin-carrito/">Plugin para ir directo al checkout sin pasar por el carrito</a></li>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/quitar-intervalo-precios-productos-variables/">Plugin para quitar el intervalo de precios en productos variables</a></li>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-personalizar-producto-no-encontrado/">Plugin para personalizar página de producto no encontrado</a></li>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-envio-gratuito-woocommerce/">Plugin para ocultar las formas de envío si está disponible el envío gratuito</a></li>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-pedido-minimo-woocommerce/">Plugin para establecer un pedido mínimo</a></li>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-pestana-comentarios-woocommerce/">Plugin para quitar la pestaña de comentarios o valoraciones</a></li>
			<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-personalizar-gracias-pedido-completo/">Plugin para personalizar el mensaje de pedido recibido</a></li>

			<?php if ($idioma == 'es_ES' || $idioma == 'ca_ES') { ?>

				<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-provincias-envios-woocommerce/">Plugin para seleccionar a qué provincias se realizan envíos (España)</a></li>
				<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-pedir-nif-pedidos-woocommerce/">Plugin para pedir el NIF/CIF en los pedidos</a></li>

			<?php } elseif ($idioma == 'es_AR') { ?>

				<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-envio-provincias-argentina-woocommerce/">Plugin para seleccionar a qué provincias se realizan envíos (Argentina)</a></li>

			<?php } elseif ($idioma == 'es_MX') { ?>

				<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-envio-provincias-mexico-woocommerce/">Plugin para seleccionar a qué provincias se realizan envíos (México)</a></li>

			<?php } elseif ($idioma == 'es_CO') { ?>

				<li><a target="_blank" href="http://www.enriquejros.com/downloads/anadir-departamentos-colombia-woocommerce/">Añadir departamentos de Colombia a WooCommerce</a></li>

			<?php } elseif ($idioma == 'es_UY') { ?>

				<li><a target="_blank" href="http://www.enriquejros.com/downloads/plugin-anadir-los-departamentos-uruguay-woocommerce/">Añadir departamentos de Uruguay a WooCommerce</a></li>

			<?php } ?>

			
		</ul>

	</div>
	<?php } ?>

</div>

<?php   }

//Cargamos las traducciones
add_action ('plugins_loaded', function () {

	$locale = is_admin() && function_exists ('get_user_locale') ? get_user_locale() : get_locale();
	$locale = apply_filters ('plugin_locale', $locale, 'add-to-cart-custom-text');
	load_textdomain ('add-to-cart-custom-text', dirname (__FILE__).'/lang/add-to-cart-custom-text-'.$locale.'.mo');
	load_plugin_textdomain ('add-to-cart-custom-text', false, dirname (__FILE__).'/lang');
	});

//Los enlaces de acción
add_filter ('plugin_action_links', function ($damelinks, $plugin_file) {

	static $addtocart;
	isset ($addtocart) or $addtocart = plugin_basename (__FILE__);

	if ($addtocart == $plugin_file) {

		$enlaces['settings'] = '<a href="options-general.php?page=add-to-cart">'.__('Settings').'</a>';
		$enlaces['support'] = '<a href="http://www.enriquejros.com/" target="_blank">'.__('Support', 'add-to-cart-custom-text').'</a>';
		$enlaces['donate'] = '<a target="_blank" href="https://www.paypal.me/enriquejros?country.x=US&locale.x=en_US">'.__('Donate', 'add-to-cart-custom-text').'</a>';
		
		$damelinks = array_merge ($enlaces, $damelinks);
		}
		
	return $damelinks;
	}, 10, 2);