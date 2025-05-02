<?php
if (get_option('show_banner') === 'on') {
	$btn_text = esc_html(get_option('banner_button_text', 'GIVE NOW'));
	$btn_url = esc_url(get_option('banner_button_url', 'https://give.camaservice.org'));
	$banner_msg = esc_html(get_option('banner_message', 'DONATE TO CALIFORNIA WILDFIRE RELIEF'));
	echo '<aside class="bg-secondary border-bottom">
                <strong class="text-white d-block lead mx-auto my-0 py-md-2 p-4" style="width: fit-content;">
                    ' . $banner_msg . ' 
                    <a class="btn btn-sm rounded btn-primary m-3 text-light" target="_blank" href="' . $btn_url . '">' . $btn_text . '</a>
                </strong>
            </aside>';
}
?>