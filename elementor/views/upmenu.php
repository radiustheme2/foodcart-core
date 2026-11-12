<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
?>
<?php if ( !empty( $data['upmenu_id'] ) ) { ?>
<script> window.upmenuSettings = { id: "<?php echo $data['upmenu_id']; ?>" }; </script>
<script src="https://cdn.upmenu.com/media/upmenu-widget.js"></script>
<div id="upmenu-widget"></div>
<?php } ?>